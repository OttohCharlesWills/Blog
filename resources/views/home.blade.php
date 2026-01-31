@extends('layouts.blogger')

@section('blogcontent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4">
    <h3>Welcome {{ Auth::user()->name }}</h3><br>

    {{-- Top Stat Cards with Icons --}}
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-primary">
                <div class="card-body text-primary">
                    <i class="bi bi-journal-text display-5"></i>
                    <h6 class="card-title mt-2">Total Blogs</h6>
                    <p class="display-6">{{ $totalBlogs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-warning">
                <div class="card-body text-warning">
                    <i class="bi bi-hourglass-split display-5"></i>
                    <h6 class="card-title mt-2">Pending</h6>
                    <p class="display-6">{{ $pendingBlogs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-success">
                <div class="card-body text-success">
                    <i class="bi bi-check-circle display-5"></i>
                    <h6 class="card-title mt-2">Published</h6>
                    <p class="display-6">{{ $publishedBlogs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-secondary">
                <div class="card-body text-secondary">
                    <i class="bi bi-pencil-square display-5"></i>
                    <h6 class="card-title mt-2">Drafts</h6>
                    <p class="display-6">{{ $draftBlogs ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-info">
                <div class="card-body text-info">
                    <i class="bi bi-eye display-5"></i>
                    <h6 class="card-title mt-2">Views</h6>
                    <p class="display-6">{{ $totalViews ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-center shadow-sm border-danger">
                <div class="card-body text-danger">
                    <i class="bi bi-chat-dots display-5"></i>
                    <h6 class="card-title mt-2">Comments</h6>
                    <p class="display-6">{{ $totalComments ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Middle Row: Recent Blogs & Mini Chart --}}
    <div class="row g-3">
        {{-- Recent Blogs --}}
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    <i class="bi bi-clock-history me-2"></i> Recent Blogs
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBlogs ?? [] as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @php
                                            $statusColor = match($blog->status) {
                                                'pending' => 'warning',
                                                'published' => 'success',
                                                'draft' => 'secondary',
                                                default => 'dark'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ ucfirst($blog->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $blog->views ?? 0 }}</td>
                                    <td>{{ $blog->created_at->format('d M Y') }}</td>
                                    {{-- <td>
                                        <a href="{{ route('blogger.blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                            @if(empty($recentBlogs) || count($recentBlogs) === 0)
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No recent blogs found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Mini Chart --}}
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    <i class="bi bi-bar-chart-line me-2"></i> Blog Stats (Last 7 Days)
                </div>
                <div class="card-body">
                    <canvas id="blogStatsChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FORCE FOCUS SELECTION --}}
@if(auth()->user()->focus === null)
    <div class="modal fade show" id="focusModal" tabindex="-1" style="display:block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <form method="POST" action="{{ route('blogger.profile.focus') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-stars me-2"></i> Choose Your Focus</h5>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-3">
                            This helps us tailor your blogging experience.
                        </p>
                        <select name="focus" id="focusSelect" class="form-select" required>
                            <option value="">Search & select a focus</option>
                            @foreach(config('focus.options') as $focus)
                                <option value="{{ $focus }}">
                                    {{ ucwords(str_replace('-', ' ', $focus)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <script>
        $(document).ready(function () {
            $('#focusSelect').select2({
                dropdownParent: $('#focusModal'),
                placeholder: 'Search & select a focus',
                allowClear: false,
                width: '100%'
            });
        });
    </script>
@endif

{{-- ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('blogStatsChart').getContext('2d');
    const blogStatsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($last7DaysLabels ?? []) !!},
            datasets: [{
                label: 'Blogs Published',
                data: {!! json_encode($last7DaysCounts ?? []) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
