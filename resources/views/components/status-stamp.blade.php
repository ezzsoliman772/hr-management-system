@props(['status'])

@php
    $status = strtolower($status);
    $map = [
        'approved' => ['text' => 'Approved', 'color' => 'text-approve', 'border' => 'border-approve'],
        'rejected' => ['text' => 'Rejected', 'color' => 'text-reject', 'border' => 'border-reject'],
        'pending'  => ['text' => 'Pending',  'color' => 'text-pending', 'border' => 'border-pending'],
    ];
    $s = $map[$status] ?? $map['pending'];
@endphp

<span class="stamp inline-flex items-center justify-center px-3 py-1 rounded-md border-2 border-dashed {{ $s['border'] }} {{ $s['color'] }} font-display text-[11px] font-bold uppercase tracking-[0.12em] select-none">
    {{ $s['text'] }}
</span>
