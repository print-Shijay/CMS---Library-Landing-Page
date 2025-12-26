<!-- Hero Header -->
<section class="hero-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="section-tag">Featured Content</span>
                <h1 class="display-4 fw-bold mb-4">{{ $title ?? 'Library Resources' }}</h1>
                <p class="lead text-muted mb-4">
                    {{ $description ?? 'Explore our comprehensive collection of resources, tools, and services designed to support your learning journey.' }}
                </p>
                @if(!empty($button))
                <button class="btn btn-primary">{{ $button }}</button>
                @endif
            </div>
            <div class="col-lg-6">
                @if(!empty($image))
                <div class="main-card">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $title ?? 'Library' }}" class="card-image">
                    <div class="card-body">
                        <h4 class="fw-bold mb-2">Featured Resource</h4>
                        <p class="text-muted">Access premium content and exclusive materials</p>
                    </div>
                </div>
                @else
                <div class="main-card">
                    <div class="card-image d-flex align-items-center justify-content-center bg-light">
                        <i class="bi bi-image text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold mb-2">Featured Resource</h4>
                        <p class="text-muted">Upload an image to showcase featured content</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-compass"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Mission</h3>
                    <p class="text-muted">
                        {{ $mission ?? 'To provide accessible, innovative library services that empower learning, research, and community engagement through curated resources and expert support.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-card">
                    <div class="feature-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Vision</h3>
                    <p class="text-muted">
                        {{ $vision ?? 'To be the leading knowledge hub that inspires lifelong learning, fosters innovation, and connects communities through exceptional library experiences and digital resources.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Strategic Goals -->
<section class="goals-section">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="section-tag" style="background: rgba(255,255,255,0.1); color: #c7d2fe;">Our Strategy</span>
                <h2 class="display-5 fw-bold mb-4">Strategic Goals</h2>
                <p class="fs-5 text-white-50 mb-0">
                    {{ $goals ?? 'Enhancing digital accessibility, expanding community outreach, developing innovative learning spaces, and preserving cultural heritage through sustainable library practices.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Related Links -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-2">Related Resources</h2>
                <p class="text-muted mb-0">Quick access to essential links and materials</p>
            </div>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                @php
                    $links = is_array($related_links ?? []) ? ($related_links ?? []) : json_decode($related_links ?? '[]', true);
                    echo count($links) . ' Resources';
                @endphp
            </span>
        </div>

        <div class="links-grid">
            @php
                $icons = ['bi-book', 'bi-journal-text', 'bi-database', 'bi-file-earmark-text', 'bi-film', 'bi-headphones'];
                $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
            @endphp
            
            @forelse($links as $index => $link)
            @php
                $icon = $icons[$index % count($icons)] ?? 'bi-link';
                $color = $colors[$index % count($colors)] ?? 'primary';
            @endphp
            <a href="#" class="link-card">
                <div class="link-icon">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div>
                    <h5 class="fw-semibold mb-1">{{ $link }}</h5>
                    <p class="text-muted small mb-0">Access this resource for more information</p>
                </div>
            </a>
            @empty
            <div class="col-12 text-center py-5">
                <div class="feature-icon bg-light text-muted mx-auto mb-3">
                    <i class="bi bi-link-45deg"></i>
                </div>
                <h4 class="fw-bold mb-2">No Resources Added</h4>
                <p class="text-muted">Add related links to display them here</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4 border-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted small mb-0">&copy; 2025 Library Management System. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                    <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>