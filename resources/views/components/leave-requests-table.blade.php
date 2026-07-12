{{--
    Single source of truth for rendering a list of leave requests.
    Used by:
    - resources/views/employee/dashboard.blade.php   ("Recent requests")
    - resources/views/leaves/index.blade.php          ("Request history")
    - resources/views/admin/leave-requests/index.blade.php ("All Leave Requests")
    so pages can never visually drift apart again.

    Props:
    requests           iterable|LengthAwarePaginator   required
    title               string   card heading, e.g. "Request history" / "Recent requests"
    showHeader          bool     show the <thead> column header row            (default true)
    showPagination      bool     render $requests->links() if paginator        (default true)
    compact             bool     tighter row padding (py-2.5 instead of py-4)  (default false)
    showEmployee        bool     prepend Employee Name / Employee Email columns (default false)
                                 requires $request->user to be eager-loaded
    showActions         bool     append an Actions column with existing
                                 Approve/Reject forms for pending requests      (default false)
                                 reuses admin.requests.approve / admin.requests.reject —
                                 no new routes, no new logic
    emptyTitle          string   heading shown when $requests is empty
    emptyMessage        string   supporting line shown when $requests is empty
    emptyActionRoute    string|null   optional CTA link href for the empty state
    emptyActionLabel    string|null   optional CTA link label for the empty state

    Slots:
    headerActions   optional content right-aligned in the title bar
                    (e.g. filter pills, a "View all" link, a result count)
    filters         optional content rendered as its own row below the title bar
                    (e.g. search box, status pills, sort select)
--}}
@props([
    'requests' => [],
    'title' => 'Requests',
    'showHeader' => true,
    'showPagination' => true,
    'compact' => false,
    'showEmployee' => false,
    'showActions' => false,
    'emptyTitle' => 'Nothing here yet',
    'emptyMessage' => 'Requests will appear here.',
    'emptyActionRoute' => null,
    'emptyActionLabel' => null,
])

@php
    $cellPad = $compact ? 'py-2.5' : 'py-4';
    $colspan = 5 + ($showEmployee ? 2 : 0) + ($showActions ? 1 : 0);
@endphp

<div class="bg-white rounded-2xl border border-ink-900/8 shadow-card overflow-hidden">

    <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-ink-900/8">
        <p class="font-display font-semibold text-lg text-ink-950">{{ $title }}</p>
        @isset($headerActions)
            {{ $headerActions }}
        @endisset
    </div>

    @isset($filters)
        <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-ink-900/8 bg-paper/40">
            {{ $filters }}
        </div>
    @endisset

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            @if($showHeader)
                <thead>
                    <tr class="text-left text-xs uppercase tracking-[0.06em] text-ink-500 border-b border-ink-900/8">
                        @if($showEmployee)
                            <th class="px-6 py-3 font-medium">Employee Name</th>
                            <th class="px-6 py-3 font-medium">Employee Email</th>
                        @endif
                        <th class="px-6 py-3 font-medium">Dates</th>
                        <th class="px-6 py-3 font-medium">Reason</th>
                        <th class="px-6 py-3 font-medium">Days</th>
                        <th class="px-6 py-3 font-medium">Submitted</th>
                        <th class="px-6 py-3 font-medium {{ $showActions ? '' : 'text-right' }}">Status</th>
                        @if($showActions)
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse ($requests as $request)
                    <tr class="border-b border-ink-900/6 last:border-0 hover:bg-paper/60">
                        @if($showEmployee)
                            <td class="px-6 {{ $cellPad }} text-ink-900 font-medium whitespace-nowrap">{{ $request->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 {{ $cellPad }} text-ink-500 whitespace-nowrap">{{ $request->user->email ?? '—' }}</td>
                        @endif
                        <td class="px-6 {{ $cellPad }} font-mono text-ink-900 whitespace-nowrap tabular-nums">
                            {{ \Illuminate\Support\Carbon::parse($request->start_date)->format('d M') }}
                            &rarr;
                            {{ \Illuminate\Support\Carbon::parse($request->end_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 {{ $cellPad }} text-ink-700 max-w-xs truncate">{{ $request->reason }}</td>
                        <td class="px-6 {{ $cellPad }} font-mono text-ink-900 tabular-nums">
                            {{ $request->days ?? \Illuminate\Support\Carbon::parse($request->start_date)->diffInDays($request->end_date) + 1 }}
                        </td>
                        <td class="px-6 {{ $cellPad }} text-ink-500 whitespace-nowrap">
                            {{ \Illuminate\Support\Carbon::parse($request->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 {{ $cellPad }} {{ $showActions ? '' : 'text-right' }}"><x-status-stamp :status="$request->status" /></td>
                        @if($showActions)
                            <td class="px-6 {{ $cellPad }} text-right">
                                @if(strtolower($request->status) === 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        <form method="POST" action="{{ route('admin.requests.approve', $request->id) }}">
                                            @csrf
                                            <button type="submit" class="rounded-md bg-approve text-white text-xs font-semibold px-3 py-1.5 hover:bg-approve/90 transition-colors">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.requests.reject', $request->id) }}">
                                            @csrf
                                            <button type="submit" class="rounded-md border border-reject text-reject text-xs font-semibold px-3 py-1.5 hover:bg-reject-light transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <p class="text-right text-xs text-ink-300 font-mono">— decided —</p>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $colspan }}" class="px-6 py-14 text-center">
                            <p class="font-display font-semibold text-ink-900">{{ $emptyTitle }}</p>
                            <p class="text-sm text-ink-500 mt-1">{{ $emptyMessage }}</p>
                            @if($emptyActionRoute && $emptyActionLabel)
                                <a href="{{ $emptyActionRoute }}" class="inline-block mt-4 text-sm font-medium text-stamp hover:text-stamp-dark">
                                    {{ $emptyActionLabel }} &rarr;
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($showPagination && isset($requests) && method_exists($requests, 'links'))
        <div class="px-6 py-4 border-t border-ink-900/8">
            {{ $requests->links() }}
        </div>
    @endif
</div>

