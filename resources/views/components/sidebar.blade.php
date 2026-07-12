@php
    $role = auth()->user()->role ?? 'employee';
    $nav = $role === 'admin'
        ? [
            ['label' => 'Overview', 'route' => 'admin.dashboard', 'icon' => 'grid'],
            ['label' => 'Employees', 'route' => 'admin.employees.index', 'icon' => 'users'],
            ['label' => 'Requests', 'route' => 'admin.leave-requests.index', 'icon' => 'clock'],
          ]
        : [
            ['label' => 'Overview', 'route' => 'employee.dashboard', 'icon' => 'grid'],
            ['label' => 'New Request', 'route' => 'leave-requests.create', 'icon' => 'plus'],
            ['label' => 'My Requests', 'route' => 'leaves.index', 'icon' => 'clock'],
          ];
@endphp

<div x-data="{ open: false }" class="lg:hidden fixed top-0 left-0 right-0 z-40 flex items-center justify-between bg-ink-900 px-4 h-14">
    <span class="font-display font-semibold text-white tracking-tight">ProductPulse <span class="text-stamp font-normal">HR</span></span>
    <button @click="open = true" class="text-ink-300 p-2 -mr-2" aria-label="Open menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 bg-ink-950/60" @click="open = false"></div>
    <aside x-cloak x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
           class="fixed top-0 left-0 bottom-0 w-72 bg-ink-900 z-50 flex flex-col">
        @include('components._sidebar-inner')
    </aside>
</div>

<aside class="hidden lg:flex lg:fixed lg:inset-y-0 lg:left-0 lg:w-64 bg-ink-900 flex-col">
    @include('components._sidebar-inner')
</aside>
