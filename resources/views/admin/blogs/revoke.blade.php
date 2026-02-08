@extends('layouts.admin')

@section('admincontent')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg col-md-7 border-0">

        {{-- HEADER --}}
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">
                🚫 Revoke Blog
            </h4>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            {{-- BLOG INFO --}}
            <div class="alert alert-warning">
                <h5 class="mb-1">Blog Title: {{ $blog->title }}</h5>
                <small>
                    Author: <strong>{{ $blog->user->name }}</strong> <br>
                    Email: {{ $blog->user->email }}
                </small>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('admin.blogs.revoke.send', $blog) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Reason for revocation
                    </label>
                    <textarea name="reason"
                              class="form-control border-danger"
                              rows="6"
                              placeholder="Explain clearly why this blog is being revoked..."
                              required></textarea>
                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('admin.blogs.index') }}"
                       class="btn btn-outline-secondary">
                        ← Cancel
                    </a>

                    <button class="btn btn-danger px-4">
                        Send & Revoke 🚫
                    </button>
                </div>
            </form>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer text-muted small text-center">
            This action will immediately revoke the blog and notify the author via email.
        </div>

    </div>
</div>
@endsection
