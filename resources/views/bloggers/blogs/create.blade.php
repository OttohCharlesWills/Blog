@extends('layouts.blogger')

@section('blogcontent')
<div class="container">
    <h2>Create Blog</h2>

    <form method="POST"
          action="{{ route('blogger.bloggers.store') }}"
          enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label>
                Title 
                <span class="info-icon" title="Your main blog title, keep it catchy!">i</span>
            </label>
            <input type="text" name="title" class="form-control" required>
        </div>

        {{-- Sub-title --}}
        <div class="mb-3">
            <label class="label-with-info">
                <span class="label-text">Sub-Title</span>
                <span class="info-icon" title="Your sub-title must be at least 150 characters.">i</span>
            </label>
            <input type="text" name="sub_title" class="form-control" required>
        </div>


        {{-- Cover Image --}}
        <div class="mb-3">
            <label>
                Cover Image
                <span class="info-icon" title="Upload an image to represent your blog visually. Max 2MB.">i</span>
            </label>
            <input type="file" name="cover_image" class="form-control" accept="image/*" required>
        </div>

        {{-- Content --}}
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" id="content" class="form-control" rows="15"></textarea>
        </div>

        <button id="submitBtn" class="btn btn-success">
            Submit for Approval 🚀
        </button>
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
        branding: false
    });
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
