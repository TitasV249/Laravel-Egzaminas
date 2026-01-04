<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $income = Transaction::where('user_id', auth()->id())
            ->whereHas('category', fn ($q) =>
                $q->where('type', 'income')
            )
            ->sum('amount');

        $expense = Transaction::where('user_id', auth()->id())
            ->whereHas('category', fn ($q) =>
                $q->where('type', 'expense')
            )
            ->sum('amount');

        return view('dashboard.index', [
            'income'  => $income,
            'expense' => $expense,
            'balance' => $income - $expense,
        ]);
    }
}
