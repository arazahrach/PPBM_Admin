<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Auth')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#5B2B82] flex items-center justify-center px-4">
  {{-- background lembut --}}
  <div class="absolute inset-0 opacity-10 pointer-events-none"
       style="background-image: radial-gradient(circle at 20% 10%, #ffffff 0, transparent 40%),
              radial-gradient(circle at 80% 90%, #ffffff 0, transparent 40%);">
  </div>

  <main class="relative w-full max-w-[520px]">
    @yield('content')
  </main>
</body>
</html>
