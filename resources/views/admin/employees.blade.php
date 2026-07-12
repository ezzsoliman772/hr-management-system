{{-- Employee Balances for admin view file --}}
@extends('layouts.app')

@section('title', 'Employees')

@section('content')

    <div class="bg-white rounded-2xl border border-ink-900/8 shadow-card overflow-hidden">
        <div class="px-6 py-5 border-b border-ink-900/8">
            <p class="font-display font-semibold text-lg text-ink-950">Employee balances</p>
            <p class="text-sm text-ink-500 mt-0.5">Set each employee's annual allowance. Used days update automatically as requests are approved.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs uppercase tracking-[0.06em] text-ink-500 border-b border-ink-900/8">
                        <th class="px-6 py-3 font-medium">Employee</th>
                        <th class="px-6 py-3 font-medium">Used</th>
                        <th class="px-6 py-3 font-medium">Remaining</th>
                        <th class="px-6 py-3 font-medium">Annual allowance</th>
                        <th class="px-6 py-3 font-medium text-right">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($employees ?? []) as $employee)
                        @php
                            $used = $employee->used_days ?? 0;
                            $total = $employee->annual_leave_allowance ?? 0;
                            $remaining = max($total - $used, 0);
                        @endphp
                        <tr class="border-b border-ink-900/6 last:border-0 hover:bg-paper/60">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-ink-900 text-white flex items-center justify-center font-display text-xs font-semibold shrink-0">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink-900 truncate">{{ $employee->name }}</p>
                                        <p class="text-xs text-ink-500 truncate">{{ $employee->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-mono text-ink-900 tabular-nums">{{ $used }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-ink-950 tabular-nums">{{ $remaining }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="leave_balance" min="0" max="365" value="{{ $total }}"
                                           class="w-20 rounded-lg border border-ink-900/15 bg-white px-3 py-1.5 text-sm font-mono text-ink-900 tabular-nums focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow">
                                    <button type="submit" class="rounded-md bg-ink-900 text-white text-xs font-semibold px-3 py-2 hover:bg-ink-800 transition-colors">Save</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs font-mono text-ink-300">#{{ str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <p class="font-display font-semibold text-ink-900">No employees yet</p>
                                <p class="text-sm text-ink-500 mt-1">Employees appear here once they register.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (isset($employees) && method_exists($employees, 'links'))
            <div class="px-6 py-4 border-t border-ink-900/8">
                {{ $employees->links() }}
            </div>
        @endif
    </div>

@endsection
