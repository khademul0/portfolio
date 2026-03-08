@extends('layouts.app')

@section('title', $post->title . ' - Blog')
@section('meta_description', $post->summary ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 150))

@section('content')
<main class="pt-24 pb-20 md:pt-32 bg-white dark:bg-slate-950 min-h-screen">
  <article class="mx-auto max-w-3xl px-4">
    
    {{-- Back Link --}}
    <a href="{{ route('home') }}#blog" class="inline-flex items-center gap-1 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition group mb-10">
      <svg class="w-4 h-4 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
      Back to Posts
    </a>

    {{-- Header --}}
    <header class="mb-10 text-center md:text-left gs-reveal">
      <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-slate-900 dark:text-white leading-[1.15]">
        {{ $post->title }}
      </h1>
      <div class="mt-6 flex items-center justify-center md:justify-start gap-4 text-sm text-slate-500 dark:text-slate-400">
        <time datetime="{{ $post->created_at->toIso8601String() }}">
          {{ $post->created_at->format('F d, Y') }}
        </time>
        <span>•</span>
        <span>By {{ \App\Models\Setting::get('APP_NAME', 'Khademul Islam') }}</span>
      </div>
    </header>

    {{-- Optional Cover Image --}}
    @if($post->cover_image)
      <figure class="mb-12 rounded-3xl overflow-hidden border border-slate-200 dark:border-white/10 gs-reveal">
        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]">
      </figure>
    @endif

    {{-- Content --}}
    <div class="prose prose-lg dark:prose-invert max-w-none gs-reveal prose-a:text-indigo-500 hover:prose-a:text-indigo-400 prose-img:rounded-2xl">
      {!! $post->content !!}
    </div>

  </article>
</main>
@endsection
