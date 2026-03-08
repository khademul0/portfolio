<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', \App\Models\Setting::get('meta_title', config('app.name', 'Portfolio')))</title>
  <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'Full-stack developer portfolio showcasing modern web applications and UI/UX design.'))">
  <link rel="canonical" href="{{ url()->current() }}">

  {{-- Open Graph --}}
  <meta property="og:title" content="@yield('og_title', \App\Models\Setting::get('meta_title', config('app.name', 'Portfolio')))">
  <meta property="og:description" content="@yield('og_description', \App\Models\Setting::get('meta_description', 'Full-stack developer portfolio showcasing modern web applications and UI/UX design.'))">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="{{ config('app.name', 'Portfolio') }}">
  <meta property="og:image" content="@yield('og_image', \App\Models\Setting::get('hero_image') ? asset('storage/' . \App\Models\Setting::get('hero_image')) : asset('storage/default-og.jpg'))">

  {{-- Twitter Card --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('title', \App\Models\Setting::get('meta_title', config('app.name', 'Portfolio')))">
  <meta name="twitter:description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'Full-stack developer portfolio showcasing modern web applications and UI/UX design.'))">
  <meta name="twitter:image" content="@yield('og_image', \App\Models\Setting::get('hero_image') ? asset('storage/' . \App\Models\Setting::get('hero_image')) : asset('storage/default-og.jpg'))">

  {{-- Avoid dark-mode flash (FOUC) --}}
  <script>
    (() => {
      const theme = localStorage.getItem('theme');
      if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="min-h-screen">
  {{-- Navbar --}}
  <x-navbar />

  {{-- Page content --}}
  <main>
    {{ $slot ?? '' }}
    @yield('content')
  </main>

  {{-- Footer --}}
  <x-footer />

  @livewireScripts
</body>
</html>
