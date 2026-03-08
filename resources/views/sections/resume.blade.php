<section id="resume" class="py-20 md:py-28">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex items-start justify-between gap-6 flex-col md:flex-row">
      <div>
        <p class="text-sm font-semibold text-slate-500 dark:text-slate-300 gs-reveal">RESUME</p>
        <h2 class="mt-3 text-3xl md:text-4xl font-semibold tracking-tight gs-reveal">
          Experience & Achievements
        </h2>
      </div>

      @if($cvUrl = \App\Models\Setting::get('cv_file'))
      <a href="{{ asset('storage/' . $cvUrl) }}" download
         class="inline-flex items-center justify-center rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 px-5 py-3 text-sm font-semibold hover:opacity-90 transition gs-reveal">
        {{ \App\Models\Setting::get('resume_cta_text', 'Download CV') }}
      </a>
      @endif
    </div>

    <div class="mt-10 grid md:grid-cols-2 gap-6 gs-stagger-group">
      @foreach($experiences ?? [] as $e)
        <div class="rounded-2xl border border-slate-200 dark:border-white/10 p-6 hover:-translate-y-1 transition duration-300 gs-stagger-item">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="font-semibold">{{ $e->role }}</h3>
              <p class="text-sm text-slate-600 dark:text-slate-300">{{ $e->company }}</p>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">
              {{ optional($e->start_date)->format('M Y') }}
              —
              {{ $e->end_date ? \Carbon\Carbon::parse($e->end_date)->format('M Y') : 'Present' }}
            </p>
          </div>

          @if($e->description)
            <p class="mt-4 text-sm text-slate-600 dark:text-slate-300">{{ $e->description }}</p>
          @endif

          @if($e->highlights)
            @php
              $highlights = is_array($e->highlights)
                ? $e->highlights
                : array_filter(array_map('trim', explode(',', $e->highlights)));
            @endphp
            <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300 list-disc pl-5">
              @foreach($highlights as $h)
                <li>{{ $h }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
