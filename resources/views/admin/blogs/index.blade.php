@extends('layouts.admin')

@section('admincontent')
<div class="container">
    <h2 class="mb-4">My Blogs</h2>

    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">
        + Create Blog
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>
                    <span class="badge bg-success">Published</span>
                </td>
                <td>{{ $blog->created_at->diffForHumans() }}</td>
                <td class="d-flex gap-2">
                    
                    <!-- EDIT -->
                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                    class="btn btn-sm btn-primary">
                        Edit ✏️
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('admin.blogs.destroy', $blog) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Delete 🗑
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
