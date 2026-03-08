<section id="contact" class="py-20 md:py-28 bg-slate-50/60 dark:bg-white/5">
  <div class="mx-auto max-w-6xl px-4">
    <p class="text-sm font-semibold text-slate-500 dark:text-slate-300 gs-reveal">CONTACT</p>
    <h2 class="mt-3 text-3xl md:text-4xl font-semibold tracking-tight gs-reveal">
      Let’s build something together.
    </h2>

    <div class="mt-12 grid md:grid-cols-2 gap-12 items-start">
      <div class="space-y-4 gs-reveal">
        <a href="mailto:{{ \App\Models\Setting::get('contact_email', 'hello@example.com') }}" class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 dark:border-white/10 hover:bg-white dark:hover:bg-white/5 transition">
          <div class="grid place-items-center w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10">
            <svg class="w-5 h-5 text-slate-700 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
          </div>
          <div>
            <p class="font-medium">Email</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ \App\Models\Setting::get('contact_email', 'hello@example.com') }}</p>
          </div>
        </a>

        @if($linkedin = \App\Models\Setting::get('social_linkedin'))
        <a href="{{ $linkedin }}" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 dark:border-white/10 hover:bg-white dark:hover:bg-white/5 transition">
          <div class="grid place-items-center w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10">
            <svg class="w-5 h-5 text-slate-700 dark:text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
          </div>
          <div>
            <p class="font-medium">LinkedIn</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ str_replace(['https://www.', 'https://'], '', $linkedin) }}</p>
          </div>
        </a>
        @endif

        @if($phone = \App\Models\Setting::get('contact_phone'))
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 dark:border-white/10 hover:bg-white dark:hover:bg-white/5 transition">
          <div class="grid place-items-center w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10">
            <svg class="w-5 h-5 text-slate-700 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
          </div>
          <div>
            <p class="font-medium">Phone</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $phone }}</p>
          </div>
        </a>
        @endif

        @if($location = \App\Models\Setting::get('contact_location'))
        <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 dark:border-white/10 bg-white/50 dark:bg-white/5 transition">
          <div class="grid place-items-center w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10">
            <svg class="w-5 h-5 text-slate-700 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          </div>
          <div>
            <p class="font-medium">Location</p>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $location }}</p>
          </div>
        </div>
        @endif
      </div>

      <div class="gs-reveal">
        <div class="rounded-2xl border border-slate-200 dark:border-white/10 p-6 md:p-8 bg-white dark:bg-slate-950/20 shadow-sm">
          <livewire:contact.contact-form />
        </div>
      </div>
    </div>
  </div>
</section>
