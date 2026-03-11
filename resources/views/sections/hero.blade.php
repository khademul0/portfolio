<section id="home" class="relative overflow-hidden">
  {{-- Background glow --}}
  <div class="absolute inset-0 pointer-events-none">
    <div class="bg-glow"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/30 to-white dark:via-slate-950/30 dark:to-slate-950"></div>
  </div>

  <div class="relative mx-auto max-w-6xl px-4 pt-16 pb-0 md:pt-20">
    <div class="flex flex-col-reverse md:flex-row items-start gap-8 md:gap-12">

      {{-- LEFT: Text Content --}}
      <div class="flex-1 pb-16 md:pb-24 text-center md:text-left self-center">
        <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-white/10 bg-white/60 dark:bg-white/5 px-4 py-1.5 text-sm font-medium backdrop-blur anim-hero-text opacity-0">
          👋 Hi, I'm <span class="font-semibold text-slate-900 dark:text-white">Khademul Islam</span>
        </p>

        <h1 class="mt-5 text-4xl md:text-6xl font-semibold tracking-tight leading-[1.08]">
          <span class="hero-line block opacity-0 anim-hero-text">{{ \App\Models\Setting::get('hero_tagline', 'Full-Stack Developer') }}</span>
          <span class="hero-line block opacity-0 text-gradient anim-hero-text">building fast, elegant web apps.</span>
        </h1>

        <p class="mt-6 text-lg text-slate-600 dark:text-slate-300 leading-relaxed anim-hero-text opacity-0">
          {{ \App\Models\Setting::get('hero_bio', 'I specialize in Laravel, modern UI, and scalable backends. I build products that look premium, load fast, and convert.') }}
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center md:justify-start anim-hero-buttons opacity-0">
          <a href="#contact"
             class="inline-flex items-center justify-center rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 px-6 py-3 text-sm font-semibold hover:-translate-y-1 hover:shadow-lg hover:shadow-slate-900/20 dark:hover:shadow-white/20 active:translate-y-0 transition-all duration-300">
            Contact Me
          </a>
          <a href="#portfolio"
             class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-white/10 px-6 py-3 text-sm font-semibold hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-white/10 hover:shadow-md active:translate-y-0 transition-all duration-300">
            View Projects
          </a>
        </div>

        <div class="mt-10 flex items-center gap-6 text-sm text-slate-500 dark:text-slate-300 justify-center md:justify-start anim-hero-text opacity-0">
          <span>PHP</span><span>Laravel</span><span>Tailwind</span><span>Node.js</span><span>MongoDB</span>
        </div>
      </div>

      {{-- RIGHT: Profile Photo — no border, blends into background --}}
      <div class="relative flex-shrink-0 anim-hero-image opacity-0 self-start">
        @if(!empty($heroImage))

          {{-- Floating Social Buttons --}}
          <div class="absolute inset-0 z-10 pointer-events-none hidden md:block">
            @if($github = \App\Models\Setting::get('social_github'))
              <a href="{{ $github }}" target="_blank" class="pointer-events-auto absolute top-[15%] -left-8 flex items-center justify-center w-12 h-12 rounded-2xl border border-slate-200/50 dark:border-white/10 bg-white/70 dark:bg-white/5 backdrop-blur-md shadow-xl hover:scale-[1.2] hover:-rotate-[10deg] hover:bg-white dark:hover:bg-white/20 hover:shadow-indigo-500/20 transition-all duration-300 text-slate-700 dark:text-slate-300" style="animation: floatMove 5s ease-in-out infinite;">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
              </a>
            @endif
            @if($linkedin = \App\Models\Setting::get('social_linkedin'))
              <a href="{{ $linkedin }}" target="_blank" class="pointer-events-auto absolute top-[30%] -right-8 lg:-right-12 flex items-center justify-center w-12 h-12 rounded-2xl border border-slate-200/50 dark:border-white/10 bg-white/70 dark:bg-white/5 backdrop-blur-md shadow-xl hover:scale-[1.2] hover:rotate-[10deg] hover:bg-white dark:hover:bg-white/20 hover:shadow-indigo-500/20 transition-all duration-300 text-slate-700 dark:text-slate-300" style="animation: floatMove 6s ease-in-out infinite 1s;">
                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
               </a>
             @endif
             @if($twitter = \App\Models\Setting::get('social_twitter'))
               <a href="{{ $twitter }}" target="_blank" class="pointer-events-auto absolute bottom-[35%] -left-6 lg:-left-12 flex items-center justify-center w-12 h-12 rounded-2xl border border-slate-200/50 dark:border-white/10 bg-white/70 dark:bg-white/5 backdrop-blur-md shadow-xl hover:scale-[1.2] hover:-rotate-[10deg] hover:bg-white dark:hover:bg-white/20 hover:shadow-indigo-500/20 transition-all duration-300 text-slate-700 dark:text-slate-300" style="animation: floatMove 7s ease-in-out infinite 2s;">
                 <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
               </a>
             @endif
             @if($facebook = \App\Models\Setting::get('social_facebook'))
               <a href="{{ $facebook }}" target="_blank" class="pointer-events-auto absolute bottom-[20%] -right-2 lg:-right-6 flex items-center justify-center w-12 h-12 rounded-2xl border border-slate-200/50 dark:border-white/10 bg-white/70 dark:bg-white/5 backdrop-blur-md shadow-xl hover:scale-[1.2] hover:rotate-[10deg] hover:bg-white dark:hover:bg-white/20 hover:shadow-indigo-500/20 transition-all duration-300 text-slate-700 dark:text-slate-300" style="animation: floatMove 5.5s ease-in-out infinite 1.5s;">
                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
               </a>
             @endif
          </div>

          <img
            src="{{ asset('storage/' . $heroImage) }}"
            alt="Khademul Islam"
            class="w-72 md:w-96 lg:w-[420px] object-contain object-bottom drop-shadow-none select-none"
            style="mask-image: linear-gradient(to top, transparent 0%, black 18%); -webkit-mask-image: linear-gradient(to top, transparent 0%, black 18%);"
          >
        @else
          {{-- Placeholder shown when no photo is uploaded yet --}}
          <div class="w-72 md:w-96 lg:w-[420px] h-[460px] flex flex-col items-center justify-center gap-3 text-slate-400 dark:text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <p class="text-xs text-center opacity-60">Upload your photo from<br>Admin → Site Settings → Profile Photo</p>
          </div>
        @endif
      </div>

    </div>
  </div>
</section>
