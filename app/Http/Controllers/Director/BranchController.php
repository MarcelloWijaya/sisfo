<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id;

        if (!$branchId) {
            abort(403, 'Anda tidak memiliki cabang yang ditugaskan.');
        }

        $branch = Branch::withCount(['students', 'teachers'])
            ->with(['students', 'teachers']) // Hapus 'classrooms' sementara
            ->findOrFail($branchId);

        $totalStudents = $branch->students->count();
        $totalTeachers = $branch->teachers->count();
        $totalClasses = $branch->classrooms()->count(); // Gunakan relasi, bukan eager loading

        return view('branches.show', compact('branch', 'totalStudents', 'totalTeachers', 'totalClasses'));
    }

    public function show($id)
    {
        $branchId = Auth::user()->branch_id;

        if ($branchId != $id) {
            abort(403, 'Anda tidak memiliki akses ke cabang ini.');
        }

        $branch = Branch::withCount(['students', 'teachers'])
            ->with(['students', 'teachers'])
            ->findOrFail($id);

        $totalStudents = $branch->students->count();
        $totalTeachers = $branch->teachers->count();
        $totalClasses = $branch->classrooms()->count();

        return view('branches.show', compact('branch', 'totalStudents', 'totalTeachers', 'totalClasses'));
    }
}
