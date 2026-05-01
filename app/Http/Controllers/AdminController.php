<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchFee;
use App\Models\Payment;
use App\Models\Presence;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Dashboard Home
     */
    public function indexHome()
    {
        $user = Auth::user();
        $roleId = $user->role_id;
        $roleName = $user->role?->name ?? '';

        // Super Admin (role_id = 1) - melihat semua data
        if ($roleId == 1 || $roleName == 'super_admin') {
            $students = Student::all();
            $teachers = Teacher::all();
            $totalCenters = Branch::count();
            $totalFee = BranchFee::sum('course_fee');
            $totalPayments = Payment::sum('amount');
            $totalClasses = Classes::count();
            $totalPresence = Presence::count();
        }
        // Admin Cabang (role_id = 2)
        elseif ($roleId == 2 || $roleName == 'admin') {
            $branchId = $user->branch_id;
            if ($branchId) {
                $students = Student::where('branch_id', $branchId)->get();
                $teachers = Teacher::where('branch_id', $branchId)->get();
                $totalCenters = 1;
                $totalFee = BranchFee::where('branch_id', $branchId)->sum('course_fee');
                $totalPayments = Payment::whereHas('invoice', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                })->sum('amount');
                $totalClasses = Classes::where('branch_id', $branchId)->count();
                $totalPresence = Presence::whereHas('student', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                })->count();
            } else {
                $students = collect();
                $teachers = collect();
                $totalCenters = 0;
                $totalFee = 0;
                $totalPayments = 0;
                $totalClasses = 0;
                $totalPresence = 0;
            }
        }
        // Director (role_id = 3) - view all for reports
        elseif ($roleId == 3 || $roleName == 'director') {
            $students = Student::all();
            $teachers = Teacher::all();
            $totalCenters = Branch::count();
            $totalFee = BranchFee::sum('course_fee');
            $totalPayments = Payment::sum('amount');
            $totalClasses = Classes::count();
            $totalPresence = Presence::count();
        } else {
            $students = collect();
            $teachers = collect();
            $totalCenters = 0;
            $totalFee = 0;
            $totalPayments = 0;
            $totalClasses = 0;
            $totalPresence = 0;
        }

        $data = [
            'total_students' => $students->count(),
            'total_teachers' => $teachers->count(),
            'total_centers' => $totalCenters,
            'total_fee' => $totalFee,
            'total_payments' => $totalPayments,
            'total_classes' => $totalClasses,
            'total_presence' => $totalPresence,
            'recent_students' => $students->sortByDesc('created_at')->take(5),
            'recent_payments' => Payment::with('invoice.student')->latest()->take(5)->get(),
        ];

        return view('dashboard', $data); // ← HAPUS 'admin.'
    }

    /**
     * Role Management Page
     */
    public function indexRole()
    {
        $users = User::with('role', 'branch')->get();
        $roles = Role::all();
        $branches = Branch::where('is_active', 1)->get();

        $data = [
            'users' => $users,
            'roles' => $roles,
            'branches' => $branches,
        ];

        return view('role.index', $data); // ← HAPUS 'admin.'
    }

    /**
     * Create New Role
     */
    public function createRole(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50|unique:roles,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = new Role();
        $role->name = $request->name;
        $role->created_by = Auth::user()->name;
        $role->save();

        return back()->with('success', 'Successfully added new role: ' . $role->name);
    }

    /**
     * Show Give Access Form
     */
    public function giveAccess($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();
        $branches = Branch::where('is_active', 1)->get();

        $data = [
            'user' => $user,
            'roles' => $roles,
            'branches' => $branches,
        ];

        return view('role.give-access', $data); // ← HAPUS 'admin.'
    }

    /**
     * Remove User Access (Set role_id to null)
     */
    public function removeAccess($user_id)
    {
        $user = User::findOrFail($user_id);

        $user->role_id = null;
        $user->is_active = 0;
        $user->updated_by = Auth::user()->name;
        $user->save();

        return back()->with('success', 'Access removed for user: ' . $user->name);
    }

    /**
     * Show Edit User Form
     */
    public function editUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();
        $branches = Branch::where('is_active', 1)->get();

        $data = [
            'user' => $user,
            'roles' => $roles,
            'branches' => $branches,
        ];

        return view('role.edit', $data); // ← HAPUS 'admin.'
    }

    /**
     * Update User Role and Access
     */
    public function updateUser(Request $request, $user_id)
    {
        $rules = [
            'role_id' => 'required|exists:roles,id',
            'branch_id' => 'nullable|exists:branches,id',
            'is_active' => 'boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($user_id);
        $oldRole = $user->role->name ?? 'No Role';
        $newRole = Role::find($request->role_id)->name;

        $user->role_id = $request->role_id;
        $user->branch_id = $request->branch_id;
        $user->is_active = $request->is_active ?? 1;
        $user->updated_by = Auth::user()->name;
        $user->save();

        return redirect()
            ->route('role')
            ->with('success', "User {$user->name} updated. Role changed from {$oldRole} to {$newRole}");
    }

    /**
     * Delete User
     */
    public function deleteUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $username = $user->name;

        $user->delete();

        return back()->with('success', 'Successfully deleted user: ' . $username);
    }

    /**
     * Dashboard (Main)
     */
    public function dashboard()
    {
        return $this->indexHome();
    }

    /**
     * Admin Dashboard (role_id = 2 specific)
     */
    public function adminDashboard()
    {
        $branchId = Auth::user()->branch_id;

        $data = [
            'total_students' => Student::where('branch_id', $branchId)->count(),
            'total_teachers' => Teacher::where('branch_id', $branchId)->count(),
            'total_classes' => Classes::where('branch_id', $branchId)->count(),
            'monthly_payments' => Payment::whereMonth('payment_date', now()->month)
                ->whereHas('invoice', function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                })
                ->sum('amount'),
            'recent_attendance' => Presence::latest()->take(10)->get(),
        ];

        return view('dashboard', $data); // ← HAPUS 'admin.'
    }

    /**
     * Director Dashboard
     */
    public function directorDashboard()
    {
        $data = [
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_branches' => Branch::count(),
            'total_revenue' => Payment::sum('amount'),
            'monthly_revenue' => Payment::whereMonth('payment_date', now()->month)->sum('amount'),
            'yearly_revenue' => Payment::whereYear('payment_date', now()->year)->sum('amount'),
            'reports' => [
                'student_growth' => Student::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')->groupBy('month')->orderBy('month', 'desc')->limit(12)->get(),
                'revenue_by_branch' => Payment::selectRaw('branches.name as branch, SUM(payments.amount) as total')->join('invoices', 'payments.invoice_id', '=', 'invoices.id')->join('branches', 'invoices.branch_id', '=', 'branches.id')->groupBy('branches.name')->get(),
            ],
        ];

        return view('dashboard', $data); // ← HAPUS 'admin.'
    }

    /**
     * Settings Page
     */
    public function settings()
    {
        return view('settings.index'); // ← HAPUS 'admin.'
    }

    /**
     * Update Settings
     */
    public function updateSettings(Request $request)
    {
        return back()->with('success', 'Settings updated successfully');
    }

    /**
     * Backup Database
     */
    public function backup()
    {
        return back()->with('success', 'Backup completed');
    }

    /**
     * Activity Logs
     */
    public function logs()
    {
        return view('logs.index'); // ← HAPUS 'admin.'
    }

    /**
     * Export Excel Report
     */
    public function exportExcel(Request $request)
    {
        return back()->with('success', 'Export completed');
    }
}
