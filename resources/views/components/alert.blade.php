@if(session('success'))
    <div class="flex items-start gap-3 rounded-xl border border-approve/20 bg-approve-light px-4 py-3.5">
        <svg class="w-5 h-5 text-approve shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
        <p class="text-sm text-ink-900">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="flex items-start gap-3 rounded-xl border border-reject/20 bg-reject-light px-4 py-3.5">
        <svg class="w-5 h-5 text-reject shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
        <p class="text-sm text-ink-900">{{ session('error') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="rounded-xl border border-reject/20 bg-reject-light px-4 py-3.5">
        <p class="text-sm font-semibold text-reject mb-1.5">Please fix the following:</p>
        <ul class="text-sm text-ink-900 space-y-0.5 list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
