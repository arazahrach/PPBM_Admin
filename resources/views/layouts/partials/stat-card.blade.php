@props([
  'label' => 'Label',
  'value' => '0',
  'hint'  => null,
])

<div class="bg-white rounded-[24px] shadow px-6 py-6">
  <div class="text-sm text-gray-500">{{ $label }}</div>
  <div class="text-3xl font-semibold text-gray-900 mt-2">{{ $value }}</div>
  @if($hint)
    <div class="text-xs text-gray-400 mt-2">{{ $hint }}</div>
  @endif
</div>
