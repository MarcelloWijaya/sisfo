<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\StudentAttendance;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DirectorController extends Controller
{
    public function dashboard()
    {
        // Stats
        $totalBranches = Branch::count();
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = Classroom::count();

        // Today's attendance
        $today = date('Y-m-d');
        $todayAttendance = StudentAttendance::where('attendance_date', $today)->count();
        $todayPresent = StudentAttendance::where('attendance_date', $today)->where('status', 'present')->count();

        // Recent pending payments (ganti total_amount dengan kolom yang ada)
        $pendingInvoices = Invoice::where('status', 'pending')->count();

        // Total revenue - coba cek kolom yang tersedia
        // Opsi 1: Jika kolomnya 'amount'
        $totalRevenue = Invoice::where('status', 'paid')->sum('amount');

        // Opsi 2: Jika kolomnya 'grand_total'
        // $totalRevenue = Invoice::where('status', 'paid')->sum('grand_total');

        // Opsi 3: Jika kolomnya 'total'
        // $totalRevenue = Invoice::where('status', 'paid')->sum('total');

        // Recent students
        $recentStudents = Student::with('branch')->latest()->limit(5)->get();

        // Recent teachers
        $recentTeachers = Teacher::with('branch')->latest()->limit(5)->get();

        // Upcoming classes today
        $todayName = date('l');
        $todayClasses = Classroom::with(['teacher', 'branch'])
            ->where('day', $todayName)
            ->where('status', 'active')
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        return view('director.dashboard', compact('totalBranches', 'totalStudents', 'totalTeachers', 'totalClasses', 'todayAttendance', 'todayPresent', 'pendingInvoices', 'totalRevenue', 'recentStudents', 'recentTeachers', 'todayClasses'));
    }
}
