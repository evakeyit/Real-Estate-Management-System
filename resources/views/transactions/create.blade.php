@extends('layouts.app')
@section('title', 'New Transaction')
@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="mb-6 text-2xl font-bold">Record Transaction</h1>
    <form method="POST" action="{{ route('transactions.store') }}" class="card space-y-4">
        @csrf
        <div>
            <label class="form-label" for="client_id">Client</label>
            <select class="form-input" id="client_id" name="client_id" required>
                <option value="">Select client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}" @selected(old('client_id') == $client->client_id)>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" for="property_id">Property</label>
            <select class="form-input" id="property_id" name="property_id" required>
                <option value="">Select property</option>
                @foreach($properties as $property)
                    <option value="{{ $property->property_id }}" @selected(old('property_id') == $property->property_id)>
                        {{ $property->type }} — ${{ number_format($property->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" for="date">Date</label>
            <input class="form-input" id="date" name="date" type="date" value="{{ old('date', now()->toDateString()) }}" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Save Transaction</button>
            <a href="{{ route('transactions.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
