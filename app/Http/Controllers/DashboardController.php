<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            return redirect('/admin/dashboard');
        }

        if ($user->hasRole('director')) {
            return redirect('/director/dashboard');
        }

        if ($user->hasRole('branch_admin')) {
            return redirect('/branch/dashboard');
        }

        if ($user->hasRole('teacher')) {
            return redirect('/teacher/dashboard');
        }

        if ($user->hasRole('student')) {
            return redirect('/student/dashboard');
        }

        if ($user->hasRole('parent')) {
            return redirect('/parent/dashboard');
        }

        abort(403);
    }
}
