@extends('layouts.app')
@section('title', 'Reports')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Transaction Reports</h1>
    <p class="text-slate-600">Filter transactions by date range</p>
</div>

<form method="GET" action="{{ route('reports.index') }}" class="card mb-6">
    <div class="grid gap-4 sm:grid-cols-3">
        <div>
            <label class="form-label" for="start_date">Start Date</label>
            <input class="form-input" type="date" id="start_date" name="start_date" value="{{ $startDate }}" required>
        </div>
        <div>
            <label class="form-label" for="end_date">End Date</label>
            <input class="form-input" type="date" id="end_date" name="end_date" value="{{ $endDate }}" required>
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary w-full sm:w-auto">Generate Report</button>
        </div>
    </div>
</form>

<div class="mb-4 grid gap-4 sm:grid-cols-2">
    <div class="card">
        <p class="text-sm text-slate-500">Transactions in range</p>
        <p class="text-2xl font-bold text-brand-700">{{ $transactions->count() }}</p>
    </div>
    <div class="card">
        <p class="text-sm text-slate-500">Total property value</p>
        <p class="text-2xl font-bold text-emerald-700">${{ number_format($totalValue, 2) }}</p>
    </div>
</div>

<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Property</th>
                    <th class="px-4 py-3 text-left">Location</th>
                    <th class="px-4 py-3 text-right">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="px-4 py-3">{{ $transaction->date->format('M d, Y') }}</td>
                        <td class="px-4 py-3">{{ $transaction->client->name }}</td>
                        <td class="px-4 py-3">{{ $transaction->property->type }}</td>
                        <td class="px-4 py-3">{{ $transaction->property->location }}</td>
                        <td class="px-4 py-3 text-right font-medium">${{ number_format($transaction->property->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                            No transactions found between {{ $startDate }} and {{ $endDate }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
