<section id="about" class="py-20 md:py-28">
  <div class="mx-auto max-w-6xl px-4">
    <div class="grid md:grid-cols-2 gap-10 items-start">
      <div>
        <p class="text-sm font-semibold text-slate-500 dark:text-slate-300 anim-about-text opacity-0">ABOUT</p>
        <h2 class="mt-3 text-3xl md:text-4xl font-semibold tracking-tight anim-about-text opacity-0">
          I build clean systems and polished UI.
        </h2>
        <p class="mt-5 text-slate-600 dark:text-slate-300 leading-relaxed anim-about-text opacity-0">
          Write your “developer story” here (you’ll make it editable in the admin panel in Step 7).
        </p>
      </div>

      {{-- Timeline --}}
      <div class="relative">
        <div class="absolute left-4 top-0 bottom-0 w-px bg-slate-200 dark:bg-white/10"></div>

        <div class="space-y-8">
          @foreach($milestones ?? [] as $m)
            <div class="relative pl-12 anim-timeline-item opacity-0">
              <div class="absolute left-[0.9rem] top-2 h-3 w-3 rounded-full bg-slate-900 dark:bg-white"></div>
              <p class="text-xs text-slate-500 dark:text-slate-400">
                {{ optional($m->date)->format('M Y') }}
              </p>
              <h3 class="mt-1 font-semibold">{{ $m->title }}</h3>
              @if($m->subtitle)
                <p class="text-sm text-slate-600 dark:text-slate-300">{{ $m->subtitle }}</p>
              @endif
              @if($m->description)
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $m->description }}</p>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Skills --}}
    <div class="mt-16">
      <h3 class="text-xl font-semibold anim-about-text opacity-0">Skills</h3>

      <div class="mt-6 grid md:grid-cols-2 gap-6">
        @foreach($skills ?? [] as $skill)
          <div class="rounded-2xl border border-slate-200 dark:border-white/10 p-5 anim-skill-card opacity-0 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-indigo-500/10 hover:border-indigo-500/30 transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
              <p class="font-medium">{{ $skill->name }}</p>
              <p class="text-sm text-slate-500 dark:text-slate-400">{{ $skill->level }}%</p>
            </div>

            <div class="mt-3 h-2 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
              <div class="skill-bar h-full rounded-full bg-slate-900 dark:bg-white w-0"
                   data-level="{{ $skill->level }}"></div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
