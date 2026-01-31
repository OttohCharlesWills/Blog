@extends('layouts.blogger')

@section('blogcontent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4">
    <h3>Pending Blogs</h3><br>

    <div class="row g-3">
        @forelse($pendingBlogs as $blog)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    @if($blog->cover_image)
                        <img src="{{ $blog->cover_image }}" class="card-img-top" alt="{{ $blog->title }}" style="height:180px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/400x180?text=No+Image" class="card-img-top" alt="No image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="mb-2">
                            <span class="badge bg-warning text-dark">Pending</span>
                        </p>
                        <p class="text-muted small mb-3">
                            Submitted: {{ $blog->created_at->format('d M Y') }}
                        </p>
                        {{-- <a href="{{ route('blogger.bloggers.edit', $blog) }}{{ route('blogger.blog.edit', $blog->id) }}" class="btn btn-outline-primary mt-auto">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No pending blogs</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
