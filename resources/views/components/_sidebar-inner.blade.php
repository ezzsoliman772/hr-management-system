<div class="h-16 flex items-center px-6 shrink-0">
    <a href="{{ $role === 'admin' ? route('admin.dashboard') : route('employee.dashboard') }}" class="font-display font-semibold text-white text-lg tracking-tight">
        ProductPulse <span class="text-stamp font-normal">HR</span>
    </a>
</div>

<div class="px-6 pb-4">
    <span class="text-[11px] uppercase tracking-[0.14em] font-mono text-ink-500">{{ $role === 'admin' ? 'Admin panel' : 'Employee panel' }}</span>
</div>

<nav class="flex-1 px-3 space-y-0.5">
    @foreach ($nav as $item)
        @php $active = request()->routeIs($item['route']); @endphp
        <a href="{{ route($item['route']) }}"
           class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                  {{ $active ? 'bg-stamp text-white' : 'text-ink-300 hover:bg-ink-800 hover:text-white' }}">
            <span class="w-5 h-5 shrink-0">
                @switch($item['icon'])
                    @case('grid')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="3.5" width="7" height="7" rx="1.3"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.3"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.3"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.3"/></svg>
                        @break
                    @case('plus')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="4.5" width="17" height="16" rx="2"/><path stroke-linecap="round" d="M8 9h8M12 6.5v9"/></svg>
                        @break
                    @case('clock')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5V12l3 2"/></svg>
                        @break
                    @case('users')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8.5" r="3"/><path stroke-linecap="round" d="M3.5 19c0-3 2.5-5 5.5-5s5.5 2 5.5 5"/><path stroke-linecap="round" d="M15.5 6.2c1.4.4 2.4 1.6 2.4 3.1 0 1.5-1 2.7-2.4 3.1M18 14.3c2 .5 3.5 2.2 3.5 4.4"/></svg>
                        @break
                @endswitch
            </span>
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>

<div class="p-3 mt-auto border-t border-ink-800">
    <div class="flex items-center gap-3 px-3 py-3">
        <div class="w-8 h-8 rounded-full bg-stamp/20 text-stamp-light flex items-center justify-center font-display text-xs font-semibold text-white shrink-0">
            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
        </div>
        <div class="min-w-0">
            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
            <p class="text-xs text-ink-500 truncate">{{ ucfirst($role) }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-ink-300 hover:bg-ink-800 hover:text-white transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.5 8V6a2 2 0 0 0-2-2h-7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2M10.5 12h10m0 0-3-3m3 3-3 3"/></svg>
            Sign out
        </button>
    </form>
</div>
