<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['client', 'property'])->latest('date');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'property_id' => ['required', 'exists:properties,property_id'],
            'date' => ['required', 'date'],
        ]);

        $transaction = Transaction::create($validated)->load(['client', 'property']);

        return response()->json($transaction, 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json($transaction->load(['client', 'property']));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'property_id' => ['required', 'exists:properties,property_id'],
            'date' => ['required', 'date'],
        ]);

        $transaction->update($validated);

        return response()->json($transaction->load(['client', 'property']));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully.']);
    }

    public function report(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $transactions = Transaction::with(['client', 'property'])
            ->whereBetween('date', [$validated['start_date'], $validated['end_date']])
            ->orderBy('date')
            ->get();

        $totalValue = $transactions->sum(fn ($t) => $t->property?->price ?? 0);

        return response()->json([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'count' => $transactions->count(),
            'total_value' => $totalValue,
            'transactions' => $transactions,
        ]);
    }
}
