<div class="flex items-center justify-between">
  <div class="text-white">
    <div class="text-lg font-semibold">
      Hello {{ auth()->user()->name ?? 'Astrmin' }} <span class="ml-1">👋</span>
    </div>
  </div>

  <div class="w-[260px]">
    <div class="relative">
      <input
        type="text"
        placeholder="Search"
        class="w-full h-9 rounded-lg bg-white/95 pl-10 pr-3 text-sm text-gray-800
               outline-none focus:ring-2 focus:ring-white/60"
      >
      <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
    </div>
  </div>
</div>
