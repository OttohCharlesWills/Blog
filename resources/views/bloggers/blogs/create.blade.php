@extends('layouts.blogger')

@section('blogcontent')
<div class="container">
    <h2>Create Blog</h2>

    <form method="POST"
          action="{{ route('blogger.bloggers.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Image (optional)</label>
            <input
                type="file"
                name="cover_image"
                class="form-control"
                accept="image/*"
            >
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea
                name="content"
                id="content"
                class="form-control"
                rows="15"
            ></textarea>
        </div>

        <button class="btn btn-success">
            Submit for Approval 🚀
        </button>
    </form>
</div>

{{-- TinyMCE --}}
<script
    src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/8/tinymce.min.js"
    referrerpolicy="origin"
></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: 'lists link image table code preview fullscreen wordcount',
        toolbar:
            'undo redo | blocks | bold italic underline | ' +
            'alignleft aligncenter alignright | ' +
            'bullist numlist | link image table | ' +
            'code preview fullscreen',
        branding: false
    });
});
</script>
@endsection
