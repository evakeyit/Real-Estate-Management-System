<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1d4ed8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <title>Create account — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full items-center justify-center bg-gradient-to-br from-brand-900 via-brand-800 to-slate-900 px-4">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center text-white">
            <h1 class="text-3xl font-bold">Peace Realty</h1>
            <p class="mt-2 text-brand-100">Real Estate Management System</p>
        </div>

        <div class="card">
            <h2 class="mb-6 text-xl font-semibold text-slate-800">Create your account</h2>

            @if($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus class="form-input" autocomplete="username">
                    <p class="mt-1 text-xs text-slate-500">Letters, numbers, dashes, and underscores only.</p>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" required class="form-input" autocomplete="new-password">
                    <p class="mt-1 text-xs text-slate-500">At least 8 characters.</p>
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="form-input" autocomplete="new-password">
                </div>
                <button type="submit" class="btn-primary w-full">Create account</button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-brand-600 hover:text-brand-700">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
