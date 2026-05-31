@extends('layouts.app')
@section('title', 'Properties')
@section('content')
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold">Properties</h1>
        <p class="text-slate-600">Manage property listings</p>
    </div>
    <a href="{{ route('properties.create') }}" class="btn-primary">Add Property</a>
</div>
<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Location</th>
                    <th class="px-4 py-3 text-right">Price</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($properties as $property)
                    <tr>
                        <td class="px-4 py-3">#{{ $property->property_id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $property->type }}</td>
                        <td class="px-4 py-3">{{ $property->location }}</td>
                        <td class="px-4 py-3 text-right">${{ number_format($property->price, 2) }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('properties.edit', $property) }}" class="text-brand-600 hover:underline">Edit</a>
                            <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Delete this property?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="ml-3 text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No properties found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($properties->hasPages())
        <div class="border-t border-slate-200 px-4 py-3">{{ $properties->links() }}</div>
    @endif
</div>
@endsection
