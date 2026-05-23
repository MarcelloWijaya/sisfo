<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('director')) {
            return redirect()->route('director.dashboard');
        }

        if ($user->hasRole('branch_admin')) {
            return redirect()->route('branch.dashboard');
        }

        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->hasRole('student')) {
            return redirect()->route('student.dashboard');
        }

        if ($user->hasRole('parent')) {
            return redirect()->route('parent.dashboard');
        }

        // fallback
        return redirect()->route('login');
    }
}
