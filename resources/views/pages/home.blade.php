@extends('layouts.app')

@section('title', 'Khademul Islam | Full‑Stack Developer Portfolio')

@section('content')
  @include('sections.hero')
  @include('sections.about')
  @include('sections.portfolio')
  @include('sections.resume')
  @include('sections.blog')
  @include('sections.contact')
@endsection
