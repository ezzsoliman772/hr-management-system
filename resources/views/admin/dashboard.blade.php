{{-- Admin Dashboard for admin view file --}}

@extends('layouts.app')

@section('title', 'Overview')

@section('content')

    {{-- Stats --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card label="Employees" :value="$totalEmployees ?? 0" accent="ink"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8.5" r="3"/><path stroke-linecap="round" d="M3.5 19c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/></svg>' />
        <x-stat-card label="Pending" :value="$pendingCount ?? 0" accent="pending"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5V12l3 2"/></svg>' />
        <x-stat-card label="Approved this month" :value="$approvedThisMonth ?? 0" accent="approve"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>' />
        <x-stat-card label="Rejected" :value="$rejectedCount ?? 0" accent="reject"
            icon='<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18"/></svg>' />
    </div>

    {{-- Moderation queue --}}
    <div id="pending" class="bg-white rounded-2xl border border-ink-900/8 shadow-card overflow-hidden scroll-mt-24">
        <div class="px-6 py-5 border-b border-ink-900/8">
            <p class="font-display font-semibold text-lg text-ink-950">Recent requests</p>
            <p class="text-sm text-ink-500 mt-0.5">Review pending requests first — approving deducts days automatically.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-[0.06em] text-ink-500 border-b border-ink-900/8">
                        <th class="px-6 py-3 font-medium">Employee</th>
                        <th class="px-6 py-3 font-medium">Dates</th>
                        <th class="px-6 py-3 font-medium">Reason</th>
                        <th class="px-6 py-3 font-medium">Days</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($requests ?? []) as $request)
                        <tr class="border-b border-ink-900/6 last:border-0 hover:bg-paper/60">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-ink-900 text-white flex items-center justify-center font-display text-[11px] font-semibold shrink-0">
                                        {{ strtoupper(substr($request->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-ink-900 whitespace-nowrap">{{ $request->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-mono text-ink-900 whitespace-nowrap tabular-nums">
                                {{ \Illuminate\Support\Carbon::parse($request->start_date)->format('d M') }} &rarr; {{ \Illuminate\Support\Carbon::parse($request->end_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-ink-700 max-w-[220px] truncate">{{ $request->reason }}</td>
                            <td class="px-6 py-4 font-mono text-ink-900 tabular-nums">{{ $request->days ?? \Illuminate\Support\Carbon::parse($request->start_date)->diffInDays($request->end_date) + 1 }}</td>
                            <td class="px-6 py-4"><x-status-stamp :status="$request->status" /></td>
                            <td class="px-6 py-4">
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <p class="font-display font-semibold text-ink-900">No requests yet</p>
                                <p class="text-sm text-ink-500 mt-1">Employee submissions will land here for review.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (isset($requests) && method_exists($requests, 'links'))
            <div class="px-6 py-4 border-t border-ink-900/8">
                {{ $requests->links() }}
            </div>
        @endif
    </div>

@endsection
