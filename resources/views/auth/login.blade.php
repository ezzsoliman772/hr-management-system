@extends('layouts.guest')

@section('title', 'Sign in')

@section('content')
    <h1 class="font-display font-semibold text-2xl text-ink-950">Welcome back</h1>
    <p class="text-ink-500 text-sm mt-1.5 mb-8">Sign in to review balances and requests.</p>

    <x-alert />

    <form method="POST" action="{{ route('login') }}" class="space-y-5 mt-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-ink-900 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="you@company.com">
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-ink-900">Password</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-stamp hover:text-stamp-dark">Forgot?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="••••••••">
        </div>

        <label class="flex items-center gap-2.5 text-sm text-ink-700">
            <input type="checkbox" name="remember" class="rounded border-ink-900/25 text-stamp focus:ring-stamp">
            Keep me signed in
        </label>

        <button type="submit"
                class="w-full rounded-lg bg-ink-900 text-white text-sm font-semibold py-3 hover:bg-ink-800 transition-colors">
            Sign in
        </button>
    </form>

    @if(Route::has('register'))
        <p class="text-sm text-ink-500 text-center mt-8">
            New here? <a href="{{ route('register') }}" class="font-medium text-stamp hover:text-stamp-dark">Create an account</a>
        </p>
    @endif
@endsection
