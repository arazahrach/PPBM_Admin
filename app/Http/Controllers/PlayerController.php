<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $players = Player::query()
            ->when($q, fn($qq) => $qq->where('account_name', 'like', "%{$q}%")
                                   ->orWhere('email', 'like', "%{$q}%"))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('players.index', compact('players', 'q'));
    }

    public function create()
    {
        return view('players.form', [
            'player' => new Player(),
            'ranks' => Player::RANKS,
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account_name' => ['required','string','max:20','unique:players,account_name'],
            'email' => ['required','email','max:255','unique:players,email'],
            'password' => ['required','string','min:6'],
            'profile_photo' => ['nullable','string','max:255'],
            'rank' => ['required','integer','min:1','max:255'],
            'status' => ['required', Rule::in(['online','offline'])],
            'in_lobby' => ['nullable','boolean'],
            'score' => ['required','integer','min:0'],
        ]);

        Player::create([
            'account_name' => $data['account_name'],
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'profile_photo' => $data['profile_photo'] ?? null,
            'rank' => $data['rank'],
            'status' => $data['status'],
            'in_lobby' => (bool)($data['in_lobby'] ?? false),
            'score' => $data['score'],
        ]);

        return redirect()->route('players.index')->with('success', 'Player created.');

        $data = $request->validate([
    'account_name' => ['required','string','max:20'],
    'email' => ['required','email'],
    'password' => ['nullable','string'],
    'rank' => ['required','integer'],
    'status' => ['required','in:online,offline'],
    'in_lobby' => ['required','boolean'],
    'score' => ['required','integer'],
    'profile_photo' => ['nullable','image','max:2048'],
]);

if ($request->hasFile('profile_photo')) {
    $data['profile_photo'] = $request->file('profile_photo')->store('avatars', 'public');
}

if (!empty($data['password'])) {
    $data['password_hash'] = bcrypt($data['password']);
}
unset($data['password']);

Player::create($data);

    }

    public function edit(Player $player)
    {
        return view('players.form', [
            'player' => $player,
            'ranks' => Player::RANKS,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'account_name' => ['required','string','max:20', Rule::unique('players','account_name')->ignore($player->id)],
            'email' => ['required','email','max:255', Rule::unique('players','email')->ignore($player->id)],
            'password' => ['nullable','string','min:6'], // optional saat edit
            'profile_photo' => ['nullable','string','max:255'],
            'rank' => ['required','integer','min:1','max:255'],
            'status' => ['required', Rule::in(['online','offline'])],
            'in_lobby' => ['nullable','boolean'],
            'score' => ['required','integer','min:0'],
        ]);

        $player->account_name = $data['account_name'];
        $player->email = $data['email'];
        $player->profile_photo = $data['profile_photo'] ?? null;
        $player->rank = $data['rank'];
        $player->status = $data['status'];
        $player->in_lobby = (bool)($data['in_lobby'] ?? false);
        $player->score = $data['score'];

        if (!empty($data['password'])) {
            $player->password_hash = Hash::make($data['password']);
        }

        $player->save();

        return redirect()->route('players.index')->with('success', 'Player updated.');

        $data = $request->validate([
    'account_name' => ['required','string','max:20'],
    'email' => ['required','email'],
    'password' => ['nullable','string'],
    'rank' => ['required','integer'],
    'status' => ['required','in:online,offline'],
    'in_lobby' => ['required','boolean'],
    'score' => ['required','integer'],
    'profile_photo' => ['nullable','image','max:2048'],
]);

if ($request->hasFile('profile_photo')) {
    $data['profile_photo'] = $request->file('profile_photo')->store('avatars', 'public');
}

if (!empty($data['password'])) {
    $data['password_hash'] = bcrypt($data['password']);
}
unset($data['password']);

$player->update($data);

    }

    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player deleted.');
    }

    
}
