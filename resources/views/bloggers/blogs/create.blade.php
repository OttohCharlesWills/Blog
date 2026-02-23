@extends('layouts.blogger')

@section('blogcontent')
<div class="container">
    <h2>Create Blog</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST"
          action="{{ route('blogger.bloggers.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="blog-form-grid">

            {{-- LEFT SIDE --}}
            <div class="left-panel">

                {{-- Title --}}
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                {{-- Sub-title --}}
                <div class="mb-3">
                    <label>Sub-Title 
                        <span class="info-icon" title="Your sub-title must be at least 150 characters.">i</span>
                    </label>
                    <input type="text" name="sub_title" class="form-control" required>
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" id="content" class="form-control" rows="15"></textarea>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="right-panel">

                {{-- Cover Image --}}
                <div class="mb-3">
                    <label>Cover Image
                        <span class="info-icon" title="Upload A Cover Image">i</span>
                    </label>
                    <input type="file" name="cover_image"  class="form-control" accept="image/*">
                </div>

                {{-- Excerpt --}}
                <div class="mb-3">
                    <label>
                        Excerpt
                        <span class="info-icon" title="Short summary (300 Words)">i</span>
                    </label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="4" maxlength="600"></textarea>

                    <div class="text-muted small">
                        <span id="excerptWords">0</span> words • 
                        <span id="excerptChars">0</span>/600 characters
                    </div>

                </div>

                <div class="mb-3 hint-box">
                    ⏱ Estimated reading time: <strong><span id="readTime">0</span> min read</strong>
                </div>


                {{-- Reading Time (auto note) --}}
                <div class="mb-3 hint-box">
                    ⏱ Reading time is auto-calculated from content
                </div>

                <button class="btn btn-success w-100">
                    Submit for Approval 🚀
                </button>

            </div>

        </div>
    </form>
</div>

{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

<script>
function calculateReadTime(text) {
    const wordsPerMinute = 200;
    const words = text.trim().split(/\s+/).length;
    return Math.max(1, Math.ceil(words / wordsPerMinute));
}

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
<script>
const excerpt = document.getElementById('excerpt');
const wordsEl = document.getElementById('excerptWords');
const charsEl = document.getElementById('excerptChars');

excerpt.addEventListener('input', () => {
    const text = excerpt.value.trim();

    const words = text === '' ? 0 : text.split(/\s+/).length;
    const chars = text.length;

    wordsEl.innerText = words;
    charsEl.innerText = chars;
});
</script>


<style>
.info-icon {
    color: red;
    display: inline-flex;       /* only affects the i, not the label text */
    align-items: center;        /* vertical center inside the circle */
    /* justify-content: center;    horizontal center inside the circle */
    font-weight: bold;
    cursor: pointer;
    margin-left: 4px;
    margin-bottom: 4px;
    border: 1px solid red;
    border-radius: 50%;
    width: 16px;                /* fixed circle size */
    height: 16px;
    padding-left: 6px;
    font-size: 0.6rem;   
    line-height: 1;
    vertical-align: middle;          /* keeps the i centered */
    background-color: transparent;
    transition: all 0.2s ease;
}

.info-icon:hover {
    background-color: red;
    color: white;
}


/* Optional: if you want a tooltip style instead of native title */
.info-icon[title]:hover::after {
    content: attr(title);
    position: absolute;
    background: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8rem;
    white-space: nowrap;
    margin-left: 5px;
    z-index: 100;
}
</style>
@endsection
