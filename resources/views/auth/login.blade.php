@extends('layouts.auth')
@section('title', 'Log In')

@section('content')

<div class="rounded-2xl border border-white/20 bg-white/10 backdrop-blur-md p-8 shadow-2xl">
  <div class="flex flex-col items-center">
    {{-- Logo --}}
    <img
      src="{{ asset('assets/mindmatch/logo.png') }}"
      alt="MindMatch"
      class="h-16 md:h-20 mb-2"
      onerror="this.style.display='none'"
    >
    <p class="text-white/90 text-sm mb-6">Welcome back!</p>
  </div>

  @if ($errors->any())
    <div class="bg-red-500/20 text-white border border-red-300/30 p-3 rounded-xl mb-4 text-sm">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}" class="space-y-3">
    @csrf

    <div>
      <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="Email"
        class="w-full rounded-full px-5 py-3 bg-white text-black placeholder:text-gray-400
               outline-none ring-2 ring-transparent focus:ring-yellow-300"
        required
      >
    </div>

    <div>
      <input
        type="password"
        name="password"
        placeholder="Password"
        class="w-full rounded-full px-5 py-3 bg-white text-black placeholder:text-gray-400
               outline-none ring-2 ring-transparent focus:ring-yellow-300"
        required
      >
    </div>

    <button
        type="submit"
        class="w-full h-[52px] rounded-full
                bg-center bg-no-repeat bg-contain
                flex items-center justify-center
                text-white font-bold tracking-wide"
        style="background-image: url('{{ asset('assets/mindmatch/button_kuning.png') }}');"
        >
        LOGIN
    </button>


    <div class="text-center pt-2">
      <a href="{{ route('password.request') }}" class="text-white/90 underline text-sm hover:text-white">
        Forgot Password?
      </a>
    </div>
  </form>
</div>
@endsection
