@php
  $value = $value ?? '0';
@endphp

<div class="bg-white rounded-2xl shadow-md p-6">
  <div class="flex items-start justify-between">
    <div>
      <div class="text-sm font-semibold text-gray-800">Sign-ups</div>
      <div class="text-3xl font-semibold mt-2 text-gray-900">{{ $value }}</div>
      <div class="text-xs text-gray-500 mt-1">past 30 days</div>
    </div>

    <div class="text-xs text-gray-500">
      <div class="flex items-center gap-2">
        <span class="inline-block h-2 w-2 rounded-full bg-purple-500"></span>
        Last Month
      </div>
      <div class="flex items-center gap-2 mt-2">
        <span class="inline-block h-2 w-2 rounded-full bg-pink-400"></span>
        This Month
      </div>
    </div>
  </div>

  <div class="mt-5 rounded-xl bg-gray-50 border border-gray-100 p-4">
    <div class="h-40 w-full flex items-end gap-2">
      @for($i=0;$i<14;$i++)
        <div class="flex-1 rounded-lg bg-pink-300/40" style="height: {{ 18 + (($i*7)%60) }}px"></div>
      @endfor
    </div>

    <div class="mt-3 flex justify-between text-[10px] text-gray-400">
      <span>Week 1</span><span>Week 2</span><span>Week 3</span><span>Week 4</span>
    </div>
  </div>
</div>
