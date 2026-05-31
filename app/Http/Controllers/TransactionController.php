<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['client', 'property'])
            ->latest('date')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $properties = Property::orderBy('type')->get();

        return view('transactions.create', compact('clients', 'properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'property_id' => ['required', 'exists:properties,property_id'],
            'date' => ['required', 'date'],
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $clients = Client::orderBy('name')->get();
        $properties = Property::orderBy('type')->get();

        return view('transactions.edit', compact('transaction', 'clients', 'properties'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,client_id'],
            'property_id' => ['required', 'exists:properties,property_id'],
            'date' => ['required', 'date'],
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
