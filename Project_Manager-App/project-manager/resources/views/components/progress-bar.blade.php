
@props(['start', 'end'])

@php
    $startDate = \Carbon\Carbon::parse($start);
    $endDate = \Carbon\Carbon::parse($end);
    $totalDays = $endDate->diffInDays($startDate);
    $elapsedDays = now()->diffInDays($startDate);
    $progress = min(100, max(0, ($elapsedDays / $totalDays) * 100));
@endphp

<div class="progress">
    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="d-flex justify-content-between text-muted mt-2">
    <span> {{ $startDate->format('M d, Y') }}</span>
    <span> {{ $endDate->format('M d, Y') }}</span>
</div>
