@php
  $title = $title ?? 'Active users';
  $subtitle = $subtitle ?? '0';
  $rightNote = $rightNote ?? '';
@endphp

<div class="bg-white rounded-2xl shadow-md p-6">
  <div class="flex items-start justify-between">
    <div>
      <div class="text-sm font-semibold text-gray-800">{{ $title }}</div>
      <div class="text-3xl font-semibold mt-2 text-gray-900">{{ $subtitle }}</div>
    </div>
    <div class="text-xs text-gray-500 mt-1">{{ $rightNote }}</div>
  </div>

  <div class="mt-5 rounded-xl bg-gray-50 border border-gray-100 p-4">
    <div class="h-40 w-full flex items-end gap-2">
      @for($i=0;$i<12;$i++)
        <div class="flex-1 rounded-lg bg-[#7F5099]/15" style="height: {{ 20 + ($i%5)*18 }}px"></div>
      @endfor
    </div>
    <div class="mt-3 flex justify-between text-[10px] text-gray-400">
      <span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span>
    </div>
  </div>
</div>
