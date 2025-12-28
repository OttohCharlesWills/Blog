@extends('layouts.admin')

@section('admincontent')
<div class="container">
    <h2>Edit Blog</h2>

    <form method="POST"
          action="{{ route('admin.blogs.update', $blog) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ $blog->title }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea id="content"
                      name="content"
                      class="form-control"
                      rows="15">{{ $blog->content }}</textarea>
        </div>

        <button class="btn btn-primary">
            Update Blog 💾
        </button>
    </form>
</div>

@include('components.head.tinymce-config')
@endsection
