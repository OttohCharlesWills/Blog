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

{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

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
        branding: false,
        setup: function (editor) {
            editor.on('keyup', function () {
                const text = editor.getContent({ format: 'text' });
                const time = calculateReadTime(text);
                document.getElementById('readTime').innerText = time;
            });
        }
    });
});
</script>
@endsection
