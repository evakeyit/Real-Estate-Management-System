<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1d4ed8">
    <meta name="description" content="Real Estate Management System - manage properties, clients, and transactions">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon.svg') }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <aside class="hidden min-h-screen w-64 flex-shrink-0 flex-col border-r border-slate-200 bg-white lg:flex">
            <div class="flex h-16 items-center border-b border-slate-200 px-6">
                <span class="text-lg font-bold text-brand-700">Peace Realty</span>
            </div>
            <nav class="flex-1 space-y-1 p-4">
                @foreach([
                    ['dashboard', 'Dashboard', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['properties.index', 'Properties', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['clients.index', 'Clients', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['transactions.index', 'Transactions', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['reports.index', 'Reports', 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ] as [$route, $label, $icon])
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs(str_replace('.index', '.*', $route)) || request()->routeIs($route) ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
            <div class="border-t border-slate-200 p-4">
                <div class="mb-3 text-sm text-slate-600">Signed in as <strong>{{ auth()->user()->username }}</strong></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary w-full">Logout</button>
                </form>
            </div>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="sticky top-0 z-10 border-b border-slate-200 bg-white/95 backdrop-blur lg:hidden">
                <div class="flex h-14 items-center justify-between px-4">
                    <span class="font-bold text-brand-700">Peace Realty</span>
                    <details class="relative">
                        <summary class="cursor-pointer list-none rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Menu</summary>
                        <div class="absolute right-0 mt-2 w-48 rounded-lg border border-slate-200 bg-white py-2 shadow-lg">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">Dashboard</a>
                            <a href="{{ route('properties.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">Properties</a>
                            <a href="{{ route('clients.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">Clients</a>
                            <a href="{{ route('transactions.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">Transactions</a>
                            <a href="{{ route('reports.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">Reports</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 px-4 pt-2">
                                @csrf
                                <button type="submit" class="w-full py-2 text-left text-sm text-red-600">Logout</button>
                            </form>
                        </div>
                    </details>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
