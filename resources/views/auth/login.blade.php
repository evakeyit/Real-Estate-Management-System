<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1d4ed8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <title>Login — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full items-center justify-center bg-gradient-to-br from-brand-900 via-brand-800 to-slate-900 px-4">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center text-white">
            <h1 class="text-3xl font-bold">Peace Realty</h1>
            <p class="mt-2 text-brand-100">Real Estate Management System</p>
        </div>

        <div class="card">
            <h2 class="mb-6 text-xl font-semibold text-slate-800">Sign in to your account</h2>

            @if($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus class="form-input">
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" required class="form-input">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    Remember me
                </label>
                <button type="submit" class="btn-primary w-full">Sign in</button>
            </form>

            <p class="mt-6 text-center text-xs text-slate-500">
                Demo: <code class="rounded bg-slate-100 px-1">admin</code> / <code class="rounded bg-slate-100 px-1">password123</code>
            </p>
        </div>
    </div>
</body>
</html>
