@extends('layouts.app')

@section('title', $project->title)
@section('meta_description', $project->excerpt)

@section('content')
  <section class="py-16 md:py-20">
    <div class="mx-auto max-w-4xl px-4">
      <a href="{{ url('/#portfolio') }}" class="text-sm text-slate-500 dark:text-slate-300 hover:underline">← Back</a>

      <h1 class="mt-4 text-3xl md:text-5xl font-semibold tracking-tight">{{ $project->title }}</h1>
      <p class="mt-4 text-slate-600 dark:text-slate-300">{{ $project->excerpt }}</p>

      <div class="mt-6 flex flex-wrap gap-3">
        @if($project->live_url)
          <a href="{{ $project->live_url }}" target="_blank"
             class="px-4 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-sm font-semibold">
            Live Demo
          </a>
        @endif
        @if($project->github_url)
          <a href="{{ $project->github_url }}" target="_blank"
             class="px-4 py-2 rounded-xl border border-slate-200 dark:border-white/10 text-sm font-semibold">
            GitHub
          </a>
        @endif
      </div>

      <div class="mt-10 space-y-6">
        @if($project->description)
          <div class="prose prose-slate dark:prose-invert max-w-none">
            {!! nl2br(e($project->description)) !!}
          </div>
        @endif

        @if($project->gallery_images)
          <div class="grid sm:grid-cols-2 gap-4">
            @foreach($project->gallery_images as $img)
              <img src="{{ asset('storage/'.$img) }}" class="rounded-2xl border border-slate-200 dark:border-white/10" loading="lazy" alt="">
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection
