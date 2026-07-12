{{-- dashboard of employee --}}

@extends('layouts.app')

@section('title', 'Overview')

@section('content')

    {{-- Balance ledger --}}
    <div class="bg-white rounded-2xl border border-ink-900/8 shadow-card p-6 sm:p-7">
        <div class="flex items-center justify-between mb-1">
            <p class="font-display font-semibold text-lg text-ink-950">Your leave balance <span class="text-stamp">{{ $remainingBalance }} </span>days</p>
            <a href="{{ route('leave-requests.create') }}"
               class="inline-flex items-center gap-1.5 rounded-lg bg-stamp text-white text-sm font-semibold px-4 py-2 hover:bg-stamp-dark transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                New request
            </a>
        </div>
        <p class="text-ink-500 text-sm mb-6">Annual allowance renews every January.</p>

        <x-ledger-bar :total="$totalAllowance ?? 20" :used="$usedDays ?? 0" />
    </div>

    {{-- Stats --}}
    <div class="grid sm:grid-cols-3 gap-4">
        <x-stat-card label="Pending" :value="$pendingCount ?? 0" accent="pending"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5V12l3 2"/></svg>' />
        <x-stat-card label="Approved" :value="$approvedCount ?? 0" accent="approve"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>' />
        <x-stat-card label="Rejected" :value="$rejectedCount ?? 0" accent="reject"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18"/></svg>' />
    </div>

    {{-- Recent requests --}}
    <x-leave-requests-table
        :requests="$recentRequests ?? []"
        title="Recent requests"
        :show-pagination="false"
        empty-title="No requests yet"
        empty-message="When you submit a leave request, it'll show up here."
        :empty-action-route="route('leave-requests.create')"
        empty-action-label="Submit your first request"
    >
        <x-slot:headerActions>
            <a href="{{ route('employee.dashboard') }}" class="text-sm font-medium text-stamp hover:text-stamp-dark">View all</a>
        </x-slot:headerActions>
    </x-leave-requests-table>

@endsection
