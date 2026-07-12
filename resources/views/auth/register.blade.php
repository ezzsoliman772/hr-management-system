@extends('layouts.guest')

@section('title', 'Create account')

@section('content')
    <h1 class="font-display font-semibold text-2xl text-ink-950">Create your account</h1>
    <p class="text-ink-500 text-sm mt-1.5 mb-8">New employees start with a balance set by HR.</p>

    <x-alert />

    <form method="POST" action="{{ route('register') }}" class="space-y-5 mt-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-ink-900 mb-1.5">Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="Jordan Ali">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-ink-900 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="you@company.com">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-ink-900 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="••••••••">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-ink-900 mb-1.5">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow"
                   placeholder="••••••••">
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-ink-900 text-white text-sm font-semibold py-3 hover:bg-ink-800 transition-colors">
            Create account
        </button>
    </form>

    <p class="text-sm text-ink-500 text-center mt-8">
        Already have an account? <a href="{{ route('login') }}" class="font-medium text-stamp hover:text-stamp-dark">Sign in</a>
    </p>
@endsection
