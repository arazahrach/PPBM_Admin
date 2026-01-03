@php
  $title = $title ?? 'Statistics';
  $label = $label ?? 'Realtime users';
  $value = $value ?? '0';
  $delta = $delta ?? '+0%';
  $deltaUp = $deltaUp ?? true;
@endphp

<div class="bg-white rounded-2xl shadow-md px-6 py-5">
  <div class="text-xs text-gray-400">{{ $title }}</div>

  <div class="mt-2 flex items-start justify-between gap-4">
    <div>
      <div class="text-sm font-semibold text-gray-800">{{ $label }}</div>
      <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $value }}</div>

      <div class="mt-1 text-xs font-semibold {{ $deltaUp ? 'text-green-600' : 'text-red-500' }}">
        {{ $delta }}
      </div>
    </div>

    <svg viewBox="0 0 120 50" class="w-28 h-12">
      <polyline
        fill="none"
        stroke="currentColor"
        stroke-width="3"
        class="{{ $deltaUp ? 'text-blue-500' : 'text-red-500' }}"
        points="0,35 15,30 30,34 45,18 60,22 75,10 90,18 105,8 120,14"
      />
    </svg>
  </div>
</div>
