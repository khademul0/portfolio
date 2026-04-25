<div>
  {{-- Filters --}}
  <div class="flex flex-wrap items-center gap-2">
    <button wire:click="setCategory(null)"
            class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 active:scale-95 {{ is_null($category) ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-md' : 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/10 hover:shadow' }}">
      All
    </button>
    @foreach($categories as $cat)
      <button wire:click="setCategory('{{ $cat->slug }}')"
              class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 active:scale-95 {{ $category === $cat->slug ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-md' : 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/10 hover:shadow' }}">
        {{ $cat->name }}
      </button>
    @endforeach
  </div>

  {{-- Grid --}}
  <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-50 transition">
    @foreach($projects as $index => $project)
      <a href="{{ route('projects.show', $project->slug) }}"
         class="group block relative overflow-hidden rounded-2xl bg-white dark:bg-slate-950/30 border border-slate-200 dark:border-white/10 hover:border-slate-300 dark:hover:border-white/20 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/10 hover:ring-1 hover:ring-indigo-500/20 transition-all duration-500 anim-project-card">
        
        <div class="aspect-video w-full overflow-hidden bg-slate-100 dark:bg-slate-900">
          @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-700">
          @elseif($project->gallery_images && count($project->gallery_images) > 0)
            <img src="{{ asset('storage/' . $project->gallery_images[0]) }}" alt="{{ $project->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-700">
          @else
            <div class="flex h-full w-full items-center justify-center text-slate-400">No Image</div>
          @endif
        </div>

        <div class="p-5">
          <p class="text-xs font-semibold text-emerald-500">{{ $project->category?->name ?? 'Uncategorized' }}</p>
          <h3 class="mt-2 text-lg font-semibold tracking-tight group-hover:text-amber-500 transition">{{ $project->title }}</h3>
          <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2">
            {{ $project->excerpt ?? Str::limit($project->description, 100) }}
          </p>
          
          @if($project->tech_stack)
            @php
              $techStack = is_array($project->tech_stack)
                ? $project->tech_stack
                : array_filter(array_map('trim', explode(',', $project->tech_stack)));
            @endphp
            <div class="mt-4 flex flex-wrap gap-2">
              @foreach(array_slice($techStack, 0, 3) as $tech)
                <span class="inline-block rounded bg-slate-100 dark:bg-white/10 px-2 py-1 text-[10px] font-medium tracking-wide uppercase text-slate-500 dark:text-slate-400">
                  {{ $tech }}
                </span>
              @endforeach
            </div>
          @endif
        </div>
      </a>
    @endforeach
  </div>

  <div class="mt-10">
    {{ $projects->links() }}
  </div>
</div>
