<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Ataskaitos:
     * - pagal periodą
     * - pagal kategorijas (suminė)
     * - analizė (min, max, avg)
     */
    public function index(Request $request)
    {
        // Validacija
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $from = $validated['from'] ?? null;
        $to   = $validated['to'] ?? null;

        /**
         * Bazinė užklausa:
         * – tik prisijungusio vartotojo duomenys
         * – su kategorijomis
         * – su periodu (jei pasirinktas)
         */
        $query = Transaction::with('category')
            ->where('user_id', auth()->id())
            ->when($from && $to, function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to]);
            });

        // 1️⃣ Visų įrašų ataskaita
        $transactions = (clone $query)
            ->orderBy('date', 'desc')
            ->get();

        // 2️⃣ Suminė ataskaita pagal kategorijas
        $byCategory = (clone $query)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // 3️⃣ Analizė: min / max / avg
        $stats = (clone $query)
            ->selectRaw('
                MIN(amount) as min_amount,
                MAX(amount) as max_amount,
                AVG(amount) as avg_amount
            ')
            ->first();

        return view('reports.index', compact(
            'transactions',
            'byCategory',
            'stats',
            'from',
            'to'
        ));
    }
}
