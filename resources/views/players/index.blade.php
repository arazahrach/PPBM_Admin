@extends('layouts.app')

@section('title', 'Players')
@section('breadcrumb', 'Admin')
@section('header', 'Players')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-5">
  <form method="GET" class="flex gap-2 w-full md:w-auto">
    <input name="q" value="{{ request('q') }}" placeholder="Search name/email"
      class="w-full md:w-80 bg-white rounded-2xl border border-gray-200 px-4 py-3
             outline-none focus:ring-2 focus:ring-purple-200">
    <button class="px-5 py-3 rounded-2xl bg-[#4B1F73] text-white font-semibold">
      Search
    </button>
  </form>

  <div class="w-full md:w-[220px]">
    @include('layouts.partials.button-image', [
      'img' => asset('assets/mindmatch/btn-yellow.png'),
      'text' => '+ Add Player',
      'textColor' => 'text-black',
    ])
  </div>
</div>

<div class="bg-white rounded-[28px] shadow overflow-x-auto">
  <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
    <div class="font-semibold text-gray-800">Player List</div>
    <div class="text-sm text-gray-400">Total: {{ $players->total() ?? $players->count() }}</div>
  </div>

  <table class="w-full text-sm">
    <thead class="text-gray-500">
      <tr>
        <th class="px-6 py-4 text-left font-semibold">Name</th>
        <th class="px-6 py-4 text-left font-semibold">Email</th>
        <th class="px-6 py-4 text-left font-semibold">Rank</th>
        <th class="px-6 py-4 text-left font-semibold">Status</th>
        <th class="px-6 py-4 text-left font-semibold">Lobby</th>
        <th class="px-6 py-4 text-left font-semibold">Score</th>
        <th class="px-6 py-4 text-left font-semibold">Action</th>
      </tr>
    </thead>

    <tbody class="text-gray-800">
      @forelse($players as $p)
      <tr class="border-t border-gray-100">
        <td class="px-6 py-4 font-semibold">{{ $p->account_name }}</td>
        <td class="px-6 py-4">{{ $p->email }}</td>
        <td class="px-6 py-4">{{ $p->rankLabel() }}</td>
        <td class="px-6 py-4">
          <span class="px-3 py-1 rounded-full text-xs font-semibold
            {{ $p->status === 'online' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
            {{ $p->status }}
          </span>
        </td>
        <td class="px-6 py-4">{{ $p->in_lobby ? 'in lobby' : 'not in lobby' }}</td>
        <td class="px-6 py-4">{{ $p->score }}</td>
        <td class="px-6 py-4 flex gap-3">
          <a class="text-[#4B1F73] font-semibold" href="{{ route('players.edit', $p) }}">Edit</a>
          <form method="POST" action="{{ route('players.destroy', $p) }}"
                onsubmit="return confirm('Delete player?')">
            @csrf @method('DELETE')
            <button class="text-red-600 font-semibold">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td class="px-6 py-10 text-center text-gray-500" colspan="7">No players found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-5">
  {{ $players->links() }}
</div>
@endsection
