<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
<body>
    <div id="admin-wrapper">

        @auth
            @if(auth()->user()->role === 'blogger')
                @include('includes.bloggersidebar')
            @endif
        @endauth

        <main class="blogger-content py-4">
            @yield('blogcontent')
        </main>
    </div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const blogToggle = document.getElementById('blogToggle');

    blogToggle.addEventListener('click', function () {
        this.closest('.has-sub').classList.toggle('open');
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('closeSidebar');

    if (!sidebar || !toggleBtn) {
        console.log('Sidebar or toggle button not found');
        return;
    }

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('open');
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            sidebar.classList.remove('open');
        });
    }

});
</script>
</html>
