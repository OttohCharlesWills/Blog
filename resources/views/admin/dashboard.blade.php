@extends('layouts.admin')

@section('admincontent')

    <h3>Welcome {{ Auth::user()->name }}</h3><br>

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
document.addEventListener('DOMContentLoaded', function () {
    const feed = document.getElementById('activity-feed');

    function fetchActivities() {
        fetch("{{ route('admin.activities.latest') }}", {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            feed.innerHTML = '';

            data.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex align-items-center justify-content-between';

                li.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <strong>${item.title}</strong>
                        <span class="text-muted">— ${item.description}</span>
                    </div>
                    <small class="text-muted">
                        ${new Date(item.created_at).toLocaleTimeString()}
                    </small>
                `;

                feed.appendChild(li);
            });
        })
        .catch(err => console.error('Activity fetch error:', err));
    }

    fetchActivities();
    setInterval(fetchActivities, 5000);
});
</script>


@endsection
