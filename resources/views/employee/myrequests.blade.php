{{-- My Requests for employee view file --}}
@extends('layouts.app')

@section('title', 'My Requests')

@section('content')

    <div class="bg-white rounded-2xl border border-ink-900/8 shadow-card overflow-hidden">

        <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-ink-900/8">
            <p class="font-display font-semibold text-lg text-ink-950">Request history</p>

            <div class="flex items-center gap-1.5 bg-paper rounded-lg p-1">
                @php $current = $statusFilter ?? 'all'; @endphp
                @foreach (['all' => 'All', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $key => $label)
                    <a href="{{ route('leaves.index', $key === 'all' ? [] : ['status' => $key]) }}"
                       class="px-3 py-1.5 rounded-md text-xs font-semibold transition-colors
                              {{ $current === $key ? 'bg-white text-ink-950 shadow-card' : 'text-ink-500 hover:text-ink-900' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-[0.06em] text-ink-500 border-b border-ink-900/8">
                        <th class="px-6 py-3 font-medium">Dates</th>
                        <th class="px-6 py-3 font-medium">Reason</th>
                        <th class="px-6 py-3 font-medium">Days</th>
                        <th class="px-6 py-3 font-medium">Submitted</th>
                        <th class="px-6 py-3 font-medium text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($requests ?? []) as $request)
                        <tr class="border-b border-ink-900/6 last:border-0 hover:bg-paper/60">
                            <td class="px-6 py-4 font-mono text-ink-900 whitespace-nowrap tabular-nums">
                                {{ \Illuminate\Support\Carbon::parse($request->start_date)->format('d M') }} &rarr; {{ \Illuminate\Support\Carbon::parse($request->end_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-ink-700 max-w-xs truncate">{{ $request->reason }}</td>
                            <td class="px-6 py-4 font-mono text-ink-900 tabular-nums">{{ $request->days ?? \Illuminate\Support\Carbon::parse($request->start_date)->diffInDays($request->end_date) + 1 }}</td>
                            <td class="px-6 py-4 text-ink-500 whitespace-nowrap">{{ \Illuminate\Support\Carbon::parse($request->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right"><x-status-stamp :status="$request->status" /></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <p class="font-display font-semibold text-ink-900">Nothing here yet</p>
                                <p class="text-sm text-ink-500 mt-1">Requests matching this filter will appear here.</p>
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

