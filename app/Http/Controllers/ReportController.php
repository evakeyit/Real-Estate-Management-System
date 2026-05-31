<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $transactions = Transaction::with(['client', 'property'])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();

        $totalValue = $transactions->sum(fn ($t) => $t->property?->price ?? 0);

        return view('reports.index', compact('transactions', 'startDate', 'endDate', 'totalValue'));
    }
}
