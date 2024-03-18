@props(['status'])

<span class="badge rounded-pill text-bg-{{ match ($status) {
    'completed' => 'success',
    'active' => 'primary',
    'paused' => 'secondary',
    'pending' => 'warning',
    default => 'secondary'
} }}">{{ ucfirst($status) }}</span>
