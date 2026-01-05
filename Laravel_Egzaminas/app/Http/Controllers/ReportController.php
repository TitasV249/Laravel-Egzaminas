<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $from = $validated['from'] ?? null;
        $to   = $validated['to'] ?? null;

        $query = Transaction::with('category')
            ->where('user_id', auth()->id())
            ->when($from && $to, function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to]);
            });

        $transactions = (clone $query)
            ->orderBy('date', 'desc')
            ->get();

        $byCategory = (clone $query)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();

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

    /**
     * PDF eksportas
     */
    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to'   => 'nullable|date|after_or_equal:from',
        ]);

        $from = $validated['from'] ?? null;
        $to   = $validated['to'] ?? null;

        $query = Transaction::with('category')
            ->where('user_id', auth()->id())
            ->when($from && $to, function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to]);
            });

        $transactions = (clone $query)
            ->orderBy('date', 'desc')
            ->get();

        $byCategory = (clone $query)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $stats = (clone $query)
            ->selectRaw('
                MIN(amount) as min_amount,
                MAX(amount) as max_amount,
                AVG(amount) as avg_amount
            ')
            ->first();

        $pdf = Pdf::loadView('reports.pdf', compact(
            'transactions',
            'byCategory',
            'stats',
            'from',
            'to'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('ataskaita.pdf');
        // jei nori atidaryti naršyklėje: return $pdf->stream('ataskaita.pdf');
    }
}
