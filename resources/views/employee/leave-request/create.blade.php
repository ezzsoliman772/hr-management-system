{{--
    Expected variables from LeaveRequestController@create:
    $remainingDays   int   employee's current remaining balance, shown as a guardrail
--}}
@extends('layouts.app')

@section('title', 'New request')

@section('content')

    <div class="grid lg:grid-cols-3 gap-6">

        <form method="POST" action="{{ route('leave-requests.store') }}" x-data="leaveForm()" class="lg:col-span-2 bg-white rounded-2xl border border-ink-900/8 shadow-card p-6 sm:p-7 space-y-6">
            @csrf

            <div>
                <p class="font-display font-semibold text-lg text-ink-950">Submit a leave request</p>
                <p class="text-ink-500 text-sm mt-1">Pick your dates and give a short reason. HR will review it from here.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-ink-900 mb-1.5">Start date</label>
                    <input type="date" id="start_date" name="start_date" x-model="start" required
                           value="{{ old('start_date') }}"
                           class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm font-mono text-ink-900 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-ink-900 mb-1.5">End date</label>
                    <input type="date" id="end_date" name="end_date" x-model="end" required
                           value="{{ old('end_date') }}"
                           class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm font-mono text-ink-900 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow">
                </div>
            </div>

            <div>
                <label for="reason" class="block text-sm font-medium text-ink-900 mb-1.5">Reason</label>
                <textarea id="reason" name="reason" rows="4" required
                          placeholder="e.g. Family trip, medical appointment, personal time..."
                          class="w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900 placeholder:text-ink-300 focus:outline-none focus:ring-2 focus:ring-stamp focus:border-stamp transition-shadow resize-none">{{ old('reason') }}</textarea>
            </div>

            {{-- Live day count --}}
            <div class="flex items-center justify-between rounded-lg bg-paper border border-ink-900/8 px-4 py-3.5">
                <span class="text-sm text-ink-700">Duration</span>
                <span class="font-mono text-sm font-semibold text-ink-950" x-text="days + ' day' + (days === 1 ? '' : 's')"></span>
            </div>

            <template x-if="remaining !== null && days > remaining">
                <div class="flex items-start gap-2.5 rounded-lg bg-reject-light border border-reject/20 px-4 py-3 text-sm text-reject">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                    <span>This request exceeds your remaining balance of <span x-text="remaining"></span> days.</span>
                </div>
            </template>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-ink-900 text-white text-sm font-semibold px-6 py-2.5 hover:bg-ink-800 transition-colors">
                    Submit request
                </button>
                <a href="{{ route('employee.dashboard') }}" class="text-sm font-medium text-ink-500 hover:text-ink-900">Cancel</a>
            </div>
        </form>

        {{-- Balance reference --}}
        <div class="bg-ink-900 rounded-2xl p-6 text-white h-fit">
            <p class="text-xs font-medium uppercase tracking-[0.08em] text-ink-300">Remaining balance</p>
            <p class="font-mono text-4xl font-semibold mt-2 tabular-nums">{{ $remainingDays ?? 0 }}<span class="text-base text-ink-300 font-medium"> days</span></p>
            <p class="text-sm text-ink-300 mt-3 leading-relaxed">Days are only deducted once your request is approved. You can track its status from My Requests.</p>
        </div>
    </div>

    @push('styles')
    <script>
        function leaveForm() {
            return {
                start: '{{ old('start_date') }}',
                end: '{{ old('end_date') }}',
                remaining: {{ isset($remainingDays) ? (int) $remainingDays : 'null' }},
                get days() {
                    if (!this.start || !this.end) return 0;
                    const s = new Date(this.start);
                    const e = new Date(this.end);
                    const diff = Math.round((e - s) / 86400000) + 1;
                    return diff > 0 ? diff : 0;
                }
            }
        }
    </script>
    @endpush
@endsection
