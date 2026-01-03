@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')

<div class="rounded-2xl border border-white/20 bg-white/10 backdrop-blur-md p-8 shadow-2xl">
  <div class="flex flex-col items-center">
    <img
      src="{{ asset('assets/mindmatch/logo.png') }}"
      alt="MindMatch"
      class="h-16 md:h-20 mb-4"
      onerror="this.style.display='none'"
    >

    <h2 class="text-[#F6C400] font-semibold text-lg mb-1">Forgot Password?</h2>
    <p class="text-white/80 text-sm mb-6 text-center">
      Enter your email and we’ll check for a match
    </p>
  </div>

  @if (session('status'))
    <div class="bg-green-500/20 text-white border border-green-300/30 p-3 rounded-xl mb-4 text-sm">
      {{ session('status') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="bg-red-500/20 text-white border border-red-300/30 p-3 rounded-xl mb-4 text-sm">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf

    <input
      type="email"
      name="email"
      value="{{ old('email') }}"
      placeholder="example@gmail.com"
      class="w-full rounded-full px-5 py-3 bg-white text-black placeholder:text-gray-400
             outline-none ring-2 ring-transparent focus:ring-sky-300"
      required
    >

    <button
        type="submit"
        class="w-full h-[52px] rounded-full
                bg-center bg-no-repeat bg-contain
                flex items-center justify-center
                text-white font-bold tracking-wide"
        style="background-image: url('{{ asset('assets/mindmatch/button_kuning.png') }}');"
        >
        SEND EMAIL
    </button>

    <div class="text-center pt-2">
      <a href="{{ route('login') }}" class="text-white/90 underline text-sm hover:text-white">
        Back
      </a>
    </div>
  </form>
</div>
@endsection
