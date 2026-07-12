{{-- All Leave Requests for admin view file --}}

@extends('layouts.app')

@section('title', 'All Leave Requests')

@section('content')

    <x-leave-requests-table
        :requests="$requests"
        title="All leave requests"
        :show-employee="true"
        :show-actions="true"
        empty-title="No matching requests"
        empty-message="Try a different search term or status filter."
    >
        <x-slot:headerActions>
            <span class="font-mono text-xs text-ink-500 tabular-nums">
                {{ $requests->total() }} {{ Str::plural('result', $requests->total()) }}
            </span>
        </x-slot:headerActions>

        <x-slot:filters>
            {{-- Search + sort submit together; status is a separate quick-filter link so it applies instantly --}}
            <form method="GET" action="{{ route('admin.leave-requests.index') }}" class="flex flex-wrap items-center gap-3 flex-1">
                @if($status)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif

                <div class="relative flex-1 min-w-[220px] max-w-sm">
                    <svg class="w-4 h-4 text-ink-300 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/></svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search name, email, or reason..."
                           class="w-full rounded-lg border border-ink-900/15 bg-white pl-9 pr-3 py-2 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow">
                </div>

                <select name="sort" onchange="this.form.submit()"
                        class="rounded-lg border border-ink-900/15 bg-white px-3 py-2 text-sm text-ink-900 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow">
                    <option value="newest" @selected($sort === 'newest')>Newest first</option>
                    <option value="oldest" @selected($sort === 'oldest')>Oldest first</option>
                </select>

                <button type="submit" class="rounded-lg bg-ink-900 text-white text-sm font-semibold px-4 py-2 hover:bg-ink-800 transition-colors">
                    Search
                </button>

                @if($search)
                    <a href="{{ route('admin.leave-requests.index', array_filter(['status' => $status, 'sort' => $sort])) }}"
                       class="text-sm font-medium text-ink-500 hover:text-ink-900">Clear</a>
                @endif
            </form>

            <div class="flex items-center gap-1.5 bg-white border border-ink-900/8 rounded-lg p-1">
                @foreach (['' => 'All', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $key => $label)
                    <a href="{{ route('admin.leave-requests.index', array_filter(['status' => $key ?: null, 'search' => $search, 'sort' => $sort])) }}"
                       class="px-3 py-1.5 rounded-md text-xs font-semibold transition-colors whitespace-nowrap
                              {{ (string) $status === $key ? 'bg-paper text-ink-950' : 'text-ink-500 hover:text-ink-900' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </x-slot:filters>
    </x-leave-requests-table>

@endsection
