@extends('layouts.admin')

@section('admincontent')
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Users</h6>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Blogs</h6>
                <h3>{{ $totalBlogs }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-warning">
                <h6>Pending Blogs</h6>
                <h3>{{ $pendingBlogs }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-success">
                <h6>Published Blogs</h6>
                <h3>{{ $publishedBlogs }}</h3>
            </div>
        </div>
    </div>

    <h4 class="mt-5">Recent Activity</h4>
    <ul class="list-group" id="activity-feed">
        {{-- JS will populate this --}}
    </ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const feed = document.getElementById('activity-feed');

    function fetchActivities() {
        fetch("{{ route('admin.activities.latest') }}")
            .then(res => res.json())
            .then(data => {
                feed.innerHTML = ''; // clear current feed
                data.forEach(item => {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `<strong>${item.title}</strong><br>
                                    <small>${item.description}</small><br>
                                    <small class="text-muted">${new Date(item.created_at).toLocaleTimeString()}</small>`;
                    feed.appendChild(li);
                });
            })
            .catch(err => console.error('Error fetching activities:', err));
    }

    // first fetch
    fetchActivities();

    // poll every 5 seconds
    setInterval(fetchActivities, 5000);
});
</script>

@endsection
