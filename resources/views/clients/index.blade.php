@extends('layouts.app')
@section('title', 'Clients')
@section('content')
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold">Clients</h1>
        <p class="text-slate-600">Manage client records</p>
    </div>
    <a href="{{ route('clients.create') }}" class="btn-primary">Add Client</a>
</div>
<div class="card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Phone</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($clients as $client)
                    <tr>
                        <td class="px-4 py-3">#{{ $client->client_id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $client->name }}</td>
                        <td class="px-4 py-3">{{ $client->phone }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('clients.edit', $client) }}" class="text-brand-600 hover:underline">Edit</a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Delete this client?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="ml-3 text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No clients found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($clients->hasPages())
        <div class="border-t border-slate-200 px-4 py-3">{{ $clients->links() }}</div>
    @endif
</div>
@endsection
