@extends('layout.app')

@section('title', 'Web Traffic Analytics')

@section('content')
<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Traffic Overview</h2>
        
        <div class="btn-group shadow-sm" role="group">
            <a href="{{ route('admin.analytics', ['range' => '24h']) }}" 
               class="btn btn-outline-primary {{ $range === '24h' ? 'active' : '' }}">
               24 Hours
            </a>
            <a href="{{ route('admin.analytics', ['range' => '7d']) }}" 
               class="btn btn-outline-primary {{ $range === '7d' ? 'active' : '' }}">
               7 Days
            </a>
            <a href="{{ route('admin.analytics', ['range' => '30d']) }}" 
               class="btn btn-outline-primary {{ $range === '30d' ? 'active' : '' }}">
               30 Days
            </a>
        </div>
    </div>

    <div class="row g-4 mb-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-globe text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Requests</h6>
                        <h3 class="fw-bold text-primary mb-0">{{ number_format(array_sum($requests)) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-people text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Unique Visitors</h6>
                        <h3 class="fw-bold text-success mb-0">{{ number_format(array_sum($visitors)) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <canvas id="trafficChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Unique Visitors',
                    data: @json($visitors),
                    borderColor: '#10b981', 
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: {{ $range === '24h' ? 2 : 4 }} // Smaller dots for 24h view
                },
                {
                    label: 'Total Requests',
                    data: @json($requests),
                    borderColor: '#3b82f6', 
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: {{ $range === '24h' ? 2 : 4 }}
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection