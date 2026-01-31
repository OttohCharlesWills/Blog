@extends('layouts.blogger')

@section('blogcontent')
<div class="container">
    <h2>Edit Blog</h2>

    <form method="POST" action="{{ route('blogger.bloggers.update', $blog) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text"
                   name="title"
                   value="{{ $blog->title }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content"
                      id="content"
                      class="form-control"
                      rows="15">{{ $blog->content }}</textarea>
        </div>

        <button class="btn btn-primary">Update Blog ✏️</button>
    </form>
</div>
@endsection
