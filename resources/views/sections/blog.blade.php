<section id="blog" class="py-20 md:py-28">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex items-start justify-between gap-6 flex-col md:flex-row">
      <div>
        <p class="text-sm font-semibold text-slate-500 dark:text-slate-300 gs-reveal">BLOG</p>
        <h2 class="mt-3 text-3xl md:text-4xl font-semibold tracking-tight gs-reveal">
          Latest writings.
        </h2>
      </div>
      
      <a href="#" class="text-sm font-semibold hover:underline text-slate-600 dark:text-slate-300 gs-reveal">
        View all posts →
      </a>
    </div>

    @if(empty($latestPosts) || count($latestPosts) === 0)
      <div class="mt-10 rounded-2xl border border-dashed border-slate-300 dark:border-white/20 p-12 text-center gs-reveal">
        <p class="text-slate-500 dark:text-slate-400">No blog posts published yet. Stay tuned!</p>
      </div>
    @else
      <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-6 gs-stagger-group">
        @foreach($latestPosts as $post)
          {{-- Blog post card --}}
          <a href="/blog/{{ $post->slug }}" class="group block rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden hover:-translate-y-1 transition duration-300 bg-white dark:bg-slate-950/30 gs-stagger-item">
            @if($post->cover_image)
              <div class="h-48 w-full overflow-hidden">
                 <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
              </div>
            @endif
            <div class="p-5">
              <h3 class="font-semibold text-lg tracking-tight group-hover:text-amber-500 transition">{{ $post->title }}</h3>
              @if($post->summary)
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-3">
                  {{ $post->summary }}
                </p>
              @endif
              <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                <span>{{ $post->created_at->format('M d, Y') }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</section>
