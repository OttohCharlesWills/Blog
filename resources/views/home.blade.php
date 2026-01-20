@extends('layouts.blogger')

@section('blogcontent')
<div class="container py-4">
    <h3>Welcome {{ Auth::user()->name }}</h3><br>

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row g-3">
                {{-- Total Blogs --}}
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Blogs</h5>
                            <p class="display-6">{{ $totalBlogs }}</p>
                        </div>
                    </div>
                </div>

                {{-- Pending Blogs --}}
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pending Blogs</h5>
                            <p class="display-6">{{ $pendingBlogs }}</p>
                        </div>
                    </div>
                </div>

                {{-- Published Blogs --}}
                <div class="col-md-4">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Published Blogs</h5>
                            <p class="display-6">{{ $publishedBlogs }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
