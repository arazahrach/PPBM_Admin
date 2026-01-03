@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')

  {{-- ===== TOP 3 PODIUM ===== --}}
  <div class="flex items-end justify-center gap-8 mt-4">

    {{-- #2 (kiri) --}}
    @php $p2 = $top3[1] ?? null; @endphp
    <div class="text-center">
      @if($p2)
        <div class="w-20 h-20 mx-auto rounded-2xl bg-white overflow-hidden flex items-center justify-center">
          @if(!empty($p2->profile_photo))
            <img class="w-full h-full object-cover" src="{{ $p2->avatarUrl() }}" alt="">
          @else
            <div class="w-full h-full bg-[#7F5099]/20"></div>
          @endif
        </div>

        <div class="mt-2 font-semibold text-white">
          {{ $p2->account_name }}

          {{-- BADGE ONLINE/OFFLINE --}}
          @if($p2->isOnline())
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
              Online
            </span>
          @else
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold">
              Offline
            </span>
          @endif
        </div>

        <div class="mt-3 bg-white rounded-2xl w-[210px] px-6 py-6 shadow-md">
          <div class="text-xs text-gray-500">Earn 2,000 points</div>
          <div class="mt-4 flex items-center justify-center gap-2">
            <span>💎</span>
            <span class="text-xl font-semibold">{{ number_format($p2->score) }}</span>
          </div>
          <div class="text-xs text-gray-500 mt-1">Prize</div>
        </div>
      @endif
    </div>

    {{-- #1 (tengah, lebih besar) --}}
    @php $p1 = $top3[0] ?? null; @endphp
    <div class="text-center -translate-y-3">
      @if($p1)
        <div class="w-24 h-24 mx-auto rounded-2xl bg-white overflow-hidden flex items-center justify-center">
          @if(!empty($p1->profile_photo))
            <img class="w-full h-full object-cover" src="{{ $p1->avatarUrl() }}" alt="">
          @else
            <div class="w-full h-full bg-[#7F5099]/20"></div>
          @endif
        </div>

        <div class="mt-2 font-semibold text-white">
          {{ $p1->account_name }}

          {{-- BADGE ONLINE/OFFLINE --}}
          @if($p1->isOnline())
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
              Online
            </span>
          @else
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold">
              Offline
            </span>
          @endif
        </div>

        <div class="mt-3 bg-white rounded-2xl w-[240px] px-6 py-7 shadow-md">
          <div class="flex items-center justify-center">
            <div class="w-10 h-10 rounded-xl bg-[#F6C400] flex items-center justify-center">🏆</div>
          </div>
          <div class="text-xs text-gray-500 mt-2">Earn 2,000 points</div>
          <div class="mt-4 flex items-center justify-center gap-2">
            <span>💎</span>
            <span class="text-2xl font-semibold">{{ number_format($p1->score) }}</span>
          </div>
          <div class="text-xs text-gray-500 mt-1">Prize</div>
        </div>
      @endif
    </div>

    {{-- #3 (kanan) --}}
    @php $p3 = $top3[2] ?? null; @endphp
    <div class="text-center">
      @if($p3)
        <div class="w-20 h-20 mx-auto rounded-2xl bg-white overflow-hidden flex items-center justify-center">
          @if(!empty($p3->profile_photo))
            <img class="w-full h-full object-cover" src="{{ $p3->avatarUrl() }}" alt="">
          @else
            <div class="w-full h-full bg-[#7F5099]/20"></div>
          @endif
        </div>

        <div class="mt-2 font-semibold text-white">
          {{ $p3->account_name }}

          {{-- BADGE ONLINE/OFFLINE --}}
          @if($p3->isOnline())
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
              Online
            </span>
          @else
            <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold">
              Offline
            </span>
          @endif
        </div>

        <div class="mt-3 bg-white rounded-2xl w-[210px] px-6 py-6 shadow-md">
          <div class="text-xs text-gray-500">Earn 2,000 points</div>
          <div class="mt-4 flex items-center justify-center gap-2">
            <span>💎</span>
            <span class="text-xl font-semibold">{{ number_format($p3->score) }}</span>
          </div>
          <div class="text-xs text-gray-500 mt-1">Prize</div>
        </div>
      @endif
    </div>

  </div>

  {{-- ===== SEARCH (4.2) ===== --}}
  <form method="GET" class="flex justify-end mt-8 mb-5">
    <input
      name="q"
      value="{{ $q ?? '' }}"
      placeholder="Search username/email"
      class="w-[260px] h-9 rounded-lg bg-white/95 px-3 text-sm text-gray-800 outline-none focus:ring-2 focus:ring-white/60"
    >
  </form>

  {{-- ===== TABLE (4.2 pagination) ===== --}}
  <div>
    <div class="grid grid-cols-5 text-white/70 text-sm px-6 mb-3">
      <div>Rank</div>
      <div>User name</div>
      <div>Total Match</div>
      <div>Point</div>
      <div class="text-right">Reward</div>
    </div>

    <div class="space-y-3">
      @foreach($table as $i => $p)
        @php $rank = $table->firstItem() + $i; @endphp

        <div class="bg-white rounded-xl shadow px-6 py-3">
          <div class="grid grid-cols-5 items-center text-sm text-gray-800">
            <div class="font-semibold">{{ $rank }}</div>

            <div class="flex items-center gap-3">
              <div class="w-7 h-7 rounded-full bg-[#7F5099]/15 overflow-hidden">
                @if(!empty($p->profile_photo))
                  <img class="w-full h-full object-cover" src="{{ $p->avatarUrl() }}" alt="">
                @endif
              </div>

              <div class="font-medium">
                {{ $p->account_name }}

                {{-- BADGE ONLINE/OFFLINE (3.3) --}}
                @if($p->isOnline())
                  <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                    Online
                  </span>
                @else
                  <span class="ml-2 text-[10px] px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold">
                    Offline
                  </span>
                @endif
              </div>
            </div>

            <div class="text-gray-500">{{ $p->total_match ?? '-' }}</div>

            <div class="font-semibold">{{ number_format($p->score) }}</div>

            <div class="text-right text-gray-700 font-semibold">
              💎 {{ number_format($p->rewardDiamonds()) }}
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- PAGINATION LINKS (4.2) --}}
    <div class="mt-6">
      {{ $table->links() }}
    </div>
  </div>

@endsection
