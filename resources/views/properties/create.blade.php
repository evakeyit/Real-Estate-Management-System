@extends('layouts.app')
@section('title', 'Add Property')
@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="mb-6 text-2xl font-bold">Add Property</h1>
    <form method="POST" action="{{ route('properties.store') }}" class="card space-y-4">
        @csrf
        <div>
            <label class="form-label" for="type">Type</label>
            <input class="form-input" id="type" name="type" value="{{ old('type') }}" required placeholder="Apartment, House, Villa...">
        </div>
        <div>
            <label class="form-label" for="price">Price ($)</label>
            <input class="form-input" id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" required>
        </div>
        <div>
            <label class="form-label" for="location">Location</label>
            <input class="form-input" id="location" name="location" value="{{ old('location') }}" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Save Property</button>
            <a href="{{ route('properties.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
