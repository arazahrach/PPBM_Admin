@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-xl">
    <h2 class="text-lg font-semibold mb-4">
        {{ $mode === 'create' ? 'Add Player' : 'Edit Player' }}
    </h2>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $mode === 'create' ? route('players.store') : route('players.update', $player) }}">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="mb-3">
            <label class="block mb-1">Account Name (max 20)</label>
            <input name="account_name" value="{{ old('account_name', $player->account_name) }}"
                   class="border rounded w-full px-3 py-2" required maxlength="20">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Email</label>
            <input name="email" value="{{ old('email', $player->email) }}"
                   class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">
                Password {{ $mode === 'edit' ? '(leave blank if no change)' : '' }}
            </label>
            <input type="password" name="password" class="border rounded w-full px-3 py-2"
                   {{ $mode === 'create' ? 'required' : '' }}>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Profile Photo (path/url)</label>
            <input name="profile_photo" value="{{ old('profile_photo', $player->profile_photo) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Rank</label>
            <select name="rank" class="border rounded w-full px-3 py-2" required>
                @foreach($ranks as $k => $label)
                    <option value="{{ $k }}" @selected((int)old('rank', $player->rank) === (int)$k)>
                        {{ $k }} - {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Status</label>
            <select name="status" class="border rounded w-full px-3 py-2" required>
                <option value="offline" @selected(old('status', $player->status) === 'offline')>offline</option>
                <option value="online" @selected(old('status', $player->status) === 'online')>online</option>
            </select>
        </div>

        <div class="mb-3 flex items-center gap-2">
            <input type="checkbox" name="in_lobby" value="1"
                   @checked((bool)old('in_lobby', $player->in_lobby))>
            <label>In lobby</label>
        </div>

        <div class="mb-5">
            <label class="block mb-1">Score</label>
            <input type="number" name="score" min="0"
                   value="{{ old('score', $player->score ?? 0) }}"
                   class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded bg-blue-600 text-white">
                {{ $mode === 'create' ? 'Create' : 'Update' }}
            </button>
            <a href="{{ route('players.index') }}" class="px-4 py-2 rounded border">Cancel</a>
        </div>
    </form>
</div>
@endsection
