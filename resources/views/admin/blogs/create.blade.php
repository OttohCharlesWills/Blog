@extends('layouts.admin')

@section('admincontent')
<div class="container">
    <h2 class="mb-4">Create Blog</h2>

    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Image (optional)</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="15"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Publish Blog 🚀</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/8/tinymce.min.js"
        referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: 'lists link image table code preview fullscreen wordcount',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code preview fullscreen',
        branding: false
    });
</script>
@endpush