<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::all();

        $data = [
            'transactions' => $transactions
        ];

        return view('transaction.index', $data);
    }
}
