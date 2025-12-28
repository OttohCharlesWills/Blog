<script
  src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/8/tinymce.min.js"
  referrerpolicy="origin"
></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: 'textarea#content',
        height: 500,
        menubar: true,
        plugins: 'lists link image table code preview fullscreen',
        toolbar:
            'undo redo | blocks | bold italic underline | ' +
            'alignleft aligncenter alignright | ' +
            'bullist numlist | link image table | code preview fullscreen',
        branding: false
    });
});
</script>