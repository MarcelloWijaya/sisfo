<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function indexHome()
    {
        return view('homepage');
    }
}
