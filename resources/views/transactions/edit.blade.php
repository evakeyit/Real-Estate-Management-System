@extends('layouts.app')
@section('title', 'Edit Transaction')
@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="mb-6 text-2xl font-bold">Edit Transaction #{{ $transaction->trans_id }}</h1>
    <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="card space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="form-label" for="client_id">Client</label>
            <select class="form-input" id="client_id" name="client_id" required>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}" @selected(old('client_id', $transaction->client_id) == $client->client_id)>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" for="property_id">Property</label>
            <select class="form-input" id="property_id" name="property_id" required>
                @foreach($properties as $property)
                    <option value="{{ $property->property_id }}" @selected(old('property_id', $transaction->property_id) == $property->property_id)>
                        {{ $property->type }} — ${{ number_format($property->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" for="date">Date</label>
            <input class="form-input" id="date" name="date" type="date" value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('transactions.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
