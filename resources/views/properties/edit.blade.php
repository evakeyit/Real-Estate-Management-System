@extends('layouts.app')
@section('title', 'Edit Property')
@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="mb-6 text-2xl font-bold">Edit Property #{{ $property->property_id }}</h1>
    <form method="POST" action="{{ route('properties.update', $property) }}" class="card space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="form-label" for="type">Type</label>
            <input class="form-input" id="type" name="type" value="{{ old('type', $property->type) }}" required>
        </div>
        <div>
            <label class="form-label" for="price">Price ($)</label>
            <input class="form-input" id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $property->price) }}" required>
        </div>
        <div>
            <label class="form-label" for="location">Location</label>
            <input class="form-input" id="location" name="location" value="{{ old('location', $property->location) }}" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('properties.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
