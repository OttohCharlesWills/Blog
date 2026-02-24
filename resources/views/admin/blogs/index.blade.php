
@extends('layouts.admin')

@section('admincontent')
<div class="container">
    <h2>All Blogs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Actions</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>
        @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>

                <td>
                    <span class="badge 
                        {{ $blog->status === 'published' ? 'bg-success' :
                           ($blog->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                        {{ ucfirst($blog->status) }}
                    </span>
                </td>

                <td>
                    {{ $blog->user->name }} <br>
                    <small>{{ $blog->user->email }}</small>
                </td>

                <td class="d-flex gap-2 flex-wrap">

                    {{-- VIEW --}}
                    <a href="{{ route('admin.blogs.show', $blog) }}"
                    class="btn btn-primary btn-sm">
                        View 👁
                    </a>

                    {{-- FEATURE / UNFEATURE --}}
                    @if(!$blog->is_featured)
                        <form method="POST"
                            action="{{ route('admin.blogs.feature', $blog) }}">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-warning btn-sm">
                                ⭐ Feature
                            </button>
                        </form>
                    @else
                        <form method="POST"
                            action="{{ route('admin.blogs.unfeature', $blog) }}">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-secondary btn-sm">
                                ❌ Remove Feature
                            </button>
                        </form>
                    @endif

                    {{-- REVOKE --}}
                    @if($blog->status !== 'revoked')
                        <a href="{{ route('admin.blogs.revoke.form', $blog) }}"
                        class="btn btn-warning btn-sm">
                            Revoke 🚫
                        </a>
                    @endif

                    {{-- DELETE --}}
                    <form method="POST"
                        action="{{ route('admin.blogs.destroy', $blog) }}"
                        onsubmit="return confirm('Delete permanently?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete 🗑
                        </button>
                    </form>

                </td>
                <td>{{ $blog->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

