@props(['title' => 'Dashboard', 'pendingCount' => null])

<header class="h-16 lg:h-20 flex items-center justify-between px-4 sm:px-6 lg:px-10 border-b border-ink-900/10 bg-paper/80 backdrop-blur sticky top-14 lg:top-0 z-20 mt-14 lg:mt-0">
    <div>
        <p class="font-mono text-[11px] uppercase tracking-[0.14em] text-ink-500">{{ now()->format('l, d M Y') }}</p>
        <h1 class="font-display font-semibold text-xl sm:text-2xl text-ink-950 -mt-0.5">{{ $title }}</h1>
    </div>

    <div class="flex items-center gap-3">
        @if((auth()->user()->role ?? '') === 'admin')
            <a href="{{ route('admin.dashboard') }}#pending" class="relative w-10 h-10 rounded-full bg-white border border-ink-900/10 shadow-card flex items-center justify-center text-ink-700 hover:text-stamp transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4a5 5 0 0 0-5 5v3.2c0 .6-.2 1.2-.6 1.7L5 15.5h14l-1.4-1.6a2.5 2.5 0 0 1-.6-1.7V9a5 5 0 0 0-5-5Z"/><path stroke-linecap="round" d="M10 18.5a2 2 0 0 0 4 0"/></svg>
                @isset($pendingCount)
                    @if($pendingCount > 0)
                        <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-reject text-white text-[10px] font-mono font-semibold flex items-center justify-center">{{ $pendingCount }}</span>
                    @endif
                @endisset
            </a>
        @endif
        <div class="hidden sm:flex items-center gap-2.5 pl-3 border-l border-ink-900/10">
            <div class="w-9 h-9 rounded-full bg-ink-900 text-white flex items-center justify-center font-display text-xs font-semibold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <span class="text-sm font-medium text-ink-900">{{ auth()->user()->name ?? 'User' }}</span>
        </div>
    </div>
</header>
