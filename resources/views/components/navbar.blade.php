<div class="fixed top-4 inset-x-0 z-50 flex justify-center px-4">
  <nav x-data="{ mobileMenuOpen: false }" class="w-full max-w-5xl rounded-full border border-slate-200/50 dark:border-white/10 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl shadow-lg transition-all duration-300">
    <div class="px-5 sm:px-6 lg:px-8">
      <div class="flex h-14 items-center justify-between">
        
        {{-- Logo --}}
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="font-bold text-xl tracking-tight flex items-center gap-2 group">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-sky-400 text-white flex items-center justify-center font-bold text-sm shadow-md group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300">
              {{ substr(config('app.name'), 0, 1) }}
            </div>
            <span class="text-slate-800 dark:text-white">{{ config('app.name') }}</span>
          </a>
        </div>

        {{-- Desktop Navigation Links --}}
        <div class="hidden md:block">
          <div class="flex items-center space-x-2">
            <a href="/#about" class="px-4 py-2 rounded-full text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/50 dark:hover:bg-white/10 transition-all">About</a>
            <a href="/#portfolio" class="px-4 py-2 rounded-full text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/50 dark:hover:bg-white/10 transition-all">Portfolio</a>
            <a href="/#resume" class="px-4 py-2 rounded-full text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/50 dark:hover:bg-white/10 transition-all">Resume</a>
            <a href="/#blog" class="px-4 py-2 rounded-full text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100/50 dark:hover:bg-white/10 transition-all">Blog</a>
          </div>
        </div>

        {{-- Desktop Actions (Theme + CTA) --}}
        <div class="hidden md:flex items-center gap-3">
          <button id="theme-toggle" class="p-2 text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white rounded-full hover:bg-slate-100/50 dark:hover:bg-white/10 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
          </button>
          
          <a href="/#contact" class="group relative inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-white transition-all duration-200">
             <span class="absolute inset-0 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-sky-400 blur-[2px] opacity-70 group-hover:opacity-100 transition-opacity"></span>
             <span class="absolute inset-0 rounded-full bg-slate-900 dark:bg-white"></span>
             <span class="relative text-white dark:text-slate-900 group-hover:-translate-y-0.5 transition-transform">Hire Me</span>
          </a>
        </div>

        {{-- Mobile menu button --}}
        <div class="flex md:hidden items-center gap-2">
          <button id="theme-toggle-mobile" class="p-2 text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white rounded-full hover:bg-slate-100/50 dark:hover:bg-white/10 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
          </button>
          <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center rounded-full p-2 text-slate-500 hover:bg-slate-100/50 hover:text-slate-900 dark:hover:bg-white/10 dark:hover:text-white focus:outline-none transition">
            <span class="sr-only">Open main menu</span>
            {{-- Hamburger icon --}}
            <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            {{-- Close icon --}}
            <svg x-show="mobileMenuOpen" class="hidden h-6 w-6" :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

      </div>
    </div>

    {{-- Mobile menu, show/hide based on menu state. --}}
    <div x-show="mobileMenuOpen" x-collapse class="md:hidden mt-2 rounded-2xl border border-slate-200/50 dark:border-white/5 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl shadow-2xl" style="display: none;">
      <div class="space-y-1 px-4 pb-4 pt-2">
        <a @click="mobileMenuOpen = false" href="/#about" class="block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-slate-100/50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white transition">About</a>
        <a @click="mobileMenuOpen = false" href="/#portfolio" class="block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-slate-100/50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white transition">Portfolio</a>
        <a @click="mobileMenuOpen = false" href="/#resume" class="block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-slate-100/50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white transition">Resume</a>
        <a @click="mobileMenuOpen = false" href="/#blog" class="block rounded-xl px-4 py-3 text-base font-medium text-slate-700 hover:bg-slate-100/50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white transition">Blog</a>
        <div class="mt-4 pt-4 border-t border-slate-200/50 dark:border-white/10">
          <a @click="mobileMenuOpen = false" href="/#contact" class="block w-full text-center rounded-full bg-slate-900 dark:bg-white px-4 py-3 text-base font-medium text-white dark:text-slate-900 shadow-sm hover:shadow-md transition">
            Hire Me
          </a>
        </div>
      </div>
    </div>
  </nav>
</div>
