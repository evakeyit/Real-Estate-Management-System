@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
    <p class="text-slate-600">Overview of your real estate operations</p>
</div>

<div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach([
        ['Properties', $stats['properties'], 'text-brand-600', 'bg-brand-50'],
        ['Clients', $stats['clients'], 'text-emerald-600', 'bg-emerald-50'],
        ['Transactions', $stats['transactions'], 'text-violet-600', 'bg-violet-50'],
        ['Portfolio Value', '$'.number_format($stats['revenue'], 2), 'text-amber-600', 'bg-amber-50'],
    ] as [$label, $value, $text, $bg])
        <div class="card">
            <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold {{ $text }}">{{ $value }}</p>
            <div class="mt-3 h-1 w-12 rounded {{ $bg }}"></div>
        </div>
    @endforeach
</div>

<div class="card overflow-hidden">
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Recent Transactions</h2>
        <a href="{{ route('transactions.create') }}" class="btn-primary">New Transaction</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Date</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Client</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Property</th>
                    <th class="px-4 py-3 text-right font-medium text-slate-600">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentTransactions as $transaction)
                    <tr>
                        <td class="px-4 py-3">{{ $transaction->date->format('M d, Y') }}</td>
                        <td class="px-4 py-3">{{ $transaction->client->name }}</td>
                        <td class="px-4 py-3">{{ $transaction->property->type }} — {{ $transaction->property->location }}</td>
                        <td class="px-4 py-3 text-right font-medium">${{ number_format($transaction->property->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">No transactions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
