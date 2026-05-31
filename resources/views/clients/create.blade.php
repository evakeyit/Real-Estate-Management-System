@extends('layouts.app')
@section('title', 'Add Client')
@section('content')
<div class="mx-auto max-w-xl">
    <h1 class="mb-6 text-2xl font-bold">Add Client</h1>
    <form method="POST" action="{{ route('clients.store') }}" class="card space-y-4">
        @csrf
        <div>
            <label class="form-label" for="name">Name</label>
            <input class="form-input" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label class="form-label" for="phone">Phone</label>
            <input class="form-input" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Save Client</button>
            <a href="{{ route('clients.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
