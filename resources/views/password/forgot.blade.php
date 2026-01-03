@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<div class="text-white mb-6">
  <h1 class="text-xl font-semibold">Forgot Password?</h1>
  <p class="text-sm text-white/80">Enter your email and we’ll send reset link.</p>
</div>

@if (session('status'))
  <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('status') }}
  </div>
@endif

@if ($errors->any())
  <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
    {{ $errors->first() }}
  </div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="space-y-3">
  @csrf

  <input
    type="email"
    name="email"
    value="{{ old('email') }}"
    placeholder="example@gmail.com"
    class="w-full rounded px-4 py-2 text-black"
    required
  >

  <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded py-2">
    Send Email
  </button>

  <div class="text-center mt-2">
    <a href="{{ route('login') }}" class="text-white/90 underline text-sm">Back to Login</a>
  </div>
</form>
@endsection
