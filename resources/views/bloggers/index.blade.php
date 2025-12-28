@extends('layouts.blogger')

@section('blogcontent')
<div class="container">
    <h2>My Blogs</h2>

    <a href="{{ route('blogger.bloggers.create') }}" class="btn btn-primary mb-3">
        + New Blog
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('blogger.bloggers.edit', $blog) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form method="POST"
                              action="{{ route('blogger.bloggers.destroy', $blog) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this blog?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No blogs yet 😶</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
