<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#5D2F77]">
  <div class="min-h-dvh">

    {{-- Sidebar (fixed) --}}
    @include('layouts.partials.sidebar')

    {{-- Main content (geser kanan sebesar sidebar di md+) --}}
    <div class="md:ml-[260px] min-h-dvh">
      {{-- kalau kamu punya topbar --}}
      @includeIf('layouts.partials.topbar')

      <main class="p-6">
        @yield('content')
      </main>
    </div>

  </div>
</body>
</html>
