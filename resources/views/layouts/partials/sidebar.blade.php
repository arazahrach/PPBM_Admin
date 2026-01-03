@php
  $activeClass = "bg-[#F6C400] text-black shadow";
  $baseClass   = "flex items-center gap-3 px-4 py-3 rounded-xl transition";
  $inactive    = "text-white/80 hover:bg-white/10 hover:text-white";
@endphp

<aside
  class="fixed left-0 top-0 h-dvh w-[260px] bg-[#4B1F73] text-white px-5 py-6 hidden md:flex flex-col overflow-y-auto"
>
  {{-- Brand --}}
  <div class="flex items-center gap-3 mb-8">
    <div class="h-11 w-11 rounded-xl bg-white/10 flex items-center justify-center overflow-hidden">
      <img src="{{ asset('assets/mindmatch/logo.png') }}" class="h-8" onerror="this.style.display='none'">
    </div>
    <div class="leading-tight">
      <div class="text-lg font-semibold">MindMatch</div>
      <div class="text-xs text-white/70">Admin Panel</div>
    </div>
  </div>

  {{-- Menu --}}
  <nav class="space-y-2 text-sm">
    <a href="{{ route('dashboard') }}"
       class="{{ $baseClass }} {{ request()->routeIs('dashboard') ? $activeClass : $inactive }}">
      <span class="inline-block h-2 w-2 rounded-full {{ request()->routeIs('dashboard') ? 'bg-black' : 'bg-white/40' }}"></span>
      <span class="font-medium">Dashboard</span>
    </a>

    <a href="{{ route('leaderboard.index') }}"
       class="{{ $baseClass }} {{ request()->routeIs('leaderboard.*') ? $activeClass : $inactive }}">
      <span class="inline-block h-2 w-2 rounded-full {{ request()->routeIs('leaderboard.*') ? 'bg-black' : 'bg-white/40' }}"></span>
      <span class="font-medium">Leaderboard</span>
      <span class="ml-auto text-white/60">›</span>
    </a>

    <a href="{{ route('players.index') }}"
       class="{{ $baseClass }} {{ request()->routeIs('players.*') ? $activeClass : $inactive }}">
      <span class="inline-block h-2 w-2 rounded-full {{ request()->routeIs('players.*') ? 'bg-black' : 'bg-white/40' }}"></span>
      <span class="font-medium">Players</span>
      <span class="ml-auto text-white/60">›</span>
    </a>
  </nav>

  {{-- Spacer biar profile bener2 di bawah --}}
  <div class="flex-1"></div>

  {{-- Profile bottom (dropdown logout) --}}
  <div class="pt-4" x-data="{ open: false }">
    <button
      type="button"
      @click="open = !open"
      class="w-full flex items-center gap-3 bg-white/10 hover:bg-white/15 rounded-2xl px-4 py-3 text-left"
    >
      <div class="w-10 h-10 rounded-full bg-white/20"></div>

      <div class="flex-1">
        <div class="text-white font-semibold leading-tight">
          {{ auth()->user()->name ?? 'Admin' }}
        </div>
        <div class="text-white/70 text-xs">Project Manager</div>
      </div>

      <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180' : ''"
           viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
              clip-rule="evenodd" />
      </svg>
    </button>

    <div x-show="open" x-transition class="mt-2 bg-white/10 rounded-2xl overflow-hidden">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-3 text-white hover:bg-white/10">
          Logout
        </button>
      </form>
    </div>
  </div>
</aside>
