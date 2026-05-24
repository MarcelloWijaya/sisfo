<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchPricingController extends Controller
{
    // INDEX - Hanya Super Admin & Branch Admin (Director TIDAK BISA)
    public function index(Request $request)
    {
        $user = Auth::user();

        // Director tidak boleh akses index
        if ($user->hasRole('director')) {
            abort(403, 'Director cannot access pricing list.');
        }

        // Hanya super_admin dan branch_admin yang bisa
        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin')) {
            abort(403);
        }

        $branchId = $user->hasRole('super_admin') ? $request->get('branch_id') : $user->branch_id;

        $query = BranchPricing::with(['branch', 'creator', 'updater']);

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('payment_type')) {
            $query->where('payment_type', $request->payment_type);
        }

        $pricings = $query->orderBy('academic_year', 'desc')->paginate(15);

        $branches = Branch::where('status', 'active')->get();
        $academicYears = $this->getAcademicYears();
        $paymentTypes = BranchPricing::getPaymentTypes();

        return view('branch-pricings.index', compact('pricings', 'branches', 'academicYears', 'paymentTypes', 'branchId'));
    }

    // CREATE - Hanya Super Admin & Branch Admin
    public function create()
    {
        $user = Auth::user();

        // Director tidak boleh create
        if ($user->hasRole('director')) {
            abort(403, 'Director cannot create pricing.');
        }

        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin')) {
            abort(403);
        }

        $branchId = $user->hasRole('super_admin') ? null : $user->branch_id;

        $branches = Branch::where('status', 'active')->get();
        $academicYears = $this->getAcademicYears();
        $paymentTypes = BranchPricing::getPaymentTypes();

        return view('branch-pricings.create', compact('branches', 'academicYears', 'paymentTypes', 'branchId'));
    }

    // STORE - Hanya Super Admin & Branch Admin
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('director')) {
            abort(403);
        }

        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin')) {
            abort(403);
        }

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'academic_year' => 'required|string|size:9',
            'payment_type' => 'required|in:monthly,quarterly,semester,yearly',
            'registration_fee' => 'nullable|integer|min:0',
            'equipment_fee' => 'nullable|integer|min:0',
            'course_fee' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // Cek apakah sudah ada data untuk branch + academic year + payment type
        $exists = BranchPricing::where('branch_id', $request->branch_id)->where('academic_year', $request->academic_year)->where('payment_type', $request->payment_type)->exists();

        if ($exists) {
            return back()
                ->withErrors(['payment_type' => __('all.pricing_already_exists')])
                ->withInput();
        }

        BranchPricing::create([...$request->all(), 'created_by' => Auth::id(), 'updated_by' => Auth::id()]);

        return redirect()->route('branch-pricings.index')->with('success', __('all.pricing_created'));
    }

    // SHOW - Semua role bisa lihat (Super Admin, Branch Admin, Director)
    public function show(BranchPricing $branchPricing)
    {
        $user = Auth::user();

        // Director, Super Admin, Branch Admin semua bisa lihat
        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin') && !$user->hasRole('director')) {
            abort(403);
        }

        $isDirector = $user->hasRole('director');
        $branchPricing->load(['branch', 'creator', 'updater']);

        return view('branch-pricings.show', compact('branchPricing', 'isDirector'));
    }

    // EDIT - Hanya Super Admin & Branch Admin
    public function edit(BranchPricing $branchPricing)
    {
        $user = Auth::user();

        if ($user->hasRole('director')) {
            abort(403, 'Director cannot edit pricing.');
        }

        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin')) {
            abort(403);
        }

        // Branch admin hanya bisa edit pricing di cabangnya sendiri
        if ($user->hasRole('branch_admin') && $branchPricing->branch_id != $user->branch_id) {
            abort(403, 'You can only edit pricing for your own branch.');
        }

        $branches = Branch::where('status', 'active')->get();
        $academicYears = $this->getAcademicYears();
        $paymentTypes = BranchPricing::getPaymentTypes();

        return view('branch-pricings.edit', compact('branchPricing', 'branches', 'academicYears', 'paymentTypes'));
    }

    // UPDATE - Hanya Super Admin & Branch Admin
    public function update(Request $request, BranchPricing $branchPricing)
    {
        $user = Auth::user();

        if ($user->hasRole('director')) {
            abort(403);
        }

        if (!$user->hasRole('super_admin') && !$user->hasRole('branch_admin')) {
            abort(403);
        }

        // Branch admin hanya bisa update pricing di cabangnya sendiri
        if ($user->hasRole('branch_admin') && $branchPricing->branch_id != $user->branch_id) {
            abort(403);
        }

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'academic_year' => 'required|string|size:9',
            'payment_type' => 'required|in:monthly,quarterly,semester,yearly',
            'registration_fee' => 'nullable|integer|min:0',
            'equipment_fee' => 'nullable|integer|min:0',
            'course_fee' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        // Cek duplicate exclude current
        $exists = BranchPricing::where('branch_id', $request->branch_id)->where('academic_year', $request->academic_year)->where('payment_type', $request->payment_type)->where('id', '!=', $branchPricing->id)->exists();

        if ($exists) {
            return back()
                ->withErrors(['payment_type' => __('all.pricing_already_exists')])
                ->withInput();
        }

        $branchPricing->update([...$request->all(), 'updated_by' => Auth::id()]);

        return redirect()->route('branch-pricings.index')->with('success', __('all.pricing_updated'));
    }

    // DESTROY - Hanya Super Admin (Branch Admin tidak bisa hapus)
    public function destroy(BranchPricing $branchPricing)
    {
        $user = Auth::user();

        // Hanya Super Admin yang bisa hapus
        if (!$user->hasRole('super_admin')) {
            abort(403, 'Only Super Admin can delete pricing.');
        }

        $branchPricing->delete();

        return redirect()->route('branch-pricings.index')->with('success', __('all.pricing_deleted'));
    }

    // DIRECTOR INDEX - Hanya untuk director memilih pricing
    public function directorIndex()
    {
        $user = Auth::user();

        if (!$user->hasRole('director')) {
            abort(403);
        }

        $pricings = BranchPricing::with('branch')->orderBy('academic_year', 'desc')->get();
        $branches = Branch::where('status', 'active')->get();

        return view('branch-pricings.director-index', compact('pricings', 'branches'));
    }

    private function getAcademicYears()
    {
        $currentYear = date('Y');
        $years = [];

        for ($i = -2; $i <= 2; $i++) {
            $year = $currentYear + $i;
            $years[$year . '/' . ($year + 1)] = $year . '/' . ($year + 1);
        }

        return $years;
    }
}
