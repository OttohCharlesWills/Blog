@extends('layouts.admin')

@section('admincontent')

<div class="container">

    <a href="{{ route('admin.blogs.index') }}"
       class="btn btn-secondary mb-3">
        ← Back
    </a>

    <h2>{{ $blog->title }}</h2>

    <p class="text-muted">
        By {{ $blog->user->name }} |
        {{ $blog->created_at->format('M d, Y') }}
    </p>

    @if($blog->cover_image)
        <img src="{{ $blog->cover_image }}"
             class="img-fluid rounded mb-4">
    @endif

    <div class="blog-content">
        {!! $blog->content !!}
    </div>

</div>

@endsection