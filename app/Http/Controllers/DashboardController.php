<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Property;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'properties' => Property::count(),
            'clients' => Client::count(),
            'transactions' => Transaction::count(),
            'revenue' => Transaction::query()
                ->join('properties', 'transactions.property_id', '=', 'properties.property_id')
                ->sum('properties.price'),
        ];

        $recentTransactions = Transaction::with(['client', 'property'])
            ->latest('date')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentTransactions'));
    }
}
