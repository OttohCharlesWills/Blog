@extends('layouts.admin')

@section('admincontent')
<h3 class="mb-4">Pending Blog Reviews</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Blogger</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->user->name }}</td>
                <td>{{ $blog->created_at->diffForHumans() }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.blogs.approve', $blog) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <form method="POST" action="{{ route('admin.blogs.revoke', $blog) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No pending blogs 🎉</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
