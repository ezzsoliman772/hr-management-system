@props(['label', 'value', 'suffix' => null, 'accent' => 'stamp', 'icon' => null])

@php
    $accents = [
        'stamp'   => 'bg-stamp-light text-stamp',
        'approve' => 'bg-approve-light text-approve',
        'reject'  => 'bg-reject-light text-reject',
        'pending' => 'bg-pending-light text-pending',
        'ink'     => 'bg-ink-900/5 text-ink-900',
    ];
@endphp

<div class="bg-white rounded-2xl border border-ink-900/8 shadow-card p-5 flex items-start justify-between">
    <div>
        <p class="text-xs font-medium uppercase tracking-[0.08em] text-ink-500">{{ $label }}</p>
        <p class="font-mono text-3xl font-semibold text-ink-950 mt-2 tabular-nums">
            {{ $value }}@if($suffix)<span class="text-base font-medium text-ink-500 ml-1">{{ $suffix }}</span>@endif
        </p>
    </div>
    @if($icon)
        <div class="w-10 h-10 rounded-xl {{ $accents[$accent] }} flex items-center justify-center shrink-0">
            {!! $icon !!}
        </div>
    @endif
</div>
