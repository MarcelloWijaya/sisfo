<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function indexCenter()
    {
        $centers = Branch::All();

        $data = [
            'centers' => $centers
        ];

        return view('branch.detail', $data);
    }
}
