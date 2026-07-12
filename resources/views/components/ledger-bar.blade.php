@props(['total' => 0, 'used' => 0])

@php
    $total = max((int) $total, 0);
    $used = min(max((int) $used, 0), $total ?: $used);
    $remaining = max($total - $used, 0);
    $usedPct = $total > 0 ? round(($used / $total) * 100, 2) : 0;
@endphp

<div>
    <div class="flex items-end justify-between mb-3">
        <div>
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-ink-500">Days remaining</p>
            <p class="font-mono text-4xl font-semibold text-ink-950 tabular-nums leading-none mt-1.5">{{ $remaining }}<span class="text-lg text-ink-500 font-medium">/{{ $total }}</span></p>
        </div>
        <div class="text-right">
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-ink-500">Used</p>
            <p class="font-mono text-lg font-semibold text-stamp tabular-nums mt-1.5">{{ $used }} days</p>
        </div>
    </div>

    {{-- Ledger strip: one ruled tick per day, filled left-to-right for days used --}}
    <div class="relative h-10 rounded-lg bg-ink-900/5 border border-ink-900/8 overflow-hidden">
        <div class="absolute inset-y-0 left-0 bg-stamp/90 transition-all" style="width: {{ $usedPct }}%"></div>
        @if($total > 0 && $total <= 40)
            <div class="absolute inset-0 flex">
                @for ($i = 1; $i < $total; $i++)
                    <div class="flex-1 border-r border-paper/70 last:border-r-0"></div>
                @endfor
            </div>
        @endif
    </div>
    <div class="flex justify-between mt-1.5 font-mono text-[10px] text-ink-500 tracking-wide">
        <span>0</span>
        <span>{{ $total }} days / year</span>
    </div>
</div>
