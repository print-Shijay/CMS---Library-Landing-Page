<section class="hero-section" id="home">
    <div class="hero-bg-container">
        @if(!empty($image))
            <img src="{{ asset('storage/' . $image) }}" class="hero-bg-image hero-bg" alt="Background">
        @else
            <div class="hero-bg-image hero-bg" style="background: linear-gradient(135deg, var(--br-100), var(--br-300));"></div>
        @endif
        <div class="hero-bg-overlay"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="text-content-container">
                    <span class="section-tag">Library Services</span>
                    <h1 class="display-3 mb-4 text-center hero-title">
                        {{ $title ?? 'Build something that truly matters' }}
                    </h1>
                    <p class="lead text-center mb-5 hero-description">
                        {{ $description ?? 'Our platform provides the tools you need to build, scale, and manage your vision with unprecedented efficiency and style.' }}
                    </p>
                    <div class="d-flex gap-3 justify-content-center align-items-center flex-wrap">
                        <button class="btn btn-modern hero-btn">{{ $button ?? 'Get Started' }}</button>
                        <button class="btn btn-outline-modern">
                            View Demo <i class="bi bi-play-circle-fill ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mission-vision-section wave-container" id="about">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="circle-card">
                    <div class="circle-card-content">
                        <div class="circle-icon" style="color: var(--br-600);">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h3 class="fw-bold h4">Our Mission</h3>
                        <p class="text-muted mb-0" data-key="mission">
                            {{ $mission ?? 'We aim to redefine industry standards by providing high-performance tools for modern creators.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="circle-card">
                    <div class="circle-card-content">
                        <div class="circle-icon" style="color: var(--br-500);">
                            <i class="bi bi-command"></i>
                        </div>
                        <h3 class="fw-bold h4">Our Vision</h3>
                        <p class="text-muted mb-0" data-key="vision">
                            {{ $vision ?? 'Empowering every individual to turn their ideas into reality with zero technical friction.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="goals-section" id="goals">
    <div class="floating-circles">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center goals-content">
                <h2 class="display-5 fw-bold mb-4 wave-text-container">Strategic Goals</h2>
                <p class="fs-5 text-white-50 mb-5" data-key="goals">
                    {{ $goals ?? 'We focus on operational excellence, customer intimacy, and relentless product leadership to stay ahead of the curve.' }}
                </p>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-4 mb-4">
                        <div class="text-white">
                            <div class="circle-icon mx-auto mb-3" style="width: 80px; height: 80px; background: rgba(255,255,255,0.1);">
                                <i class="bi bi-graph-up-arrow fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Operational Excellence</h5>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-white">
                            <div class="circle-icon mx-auto mb-3" style="width: 80px; height: 80px; background: rgba(255,255,255,0.1);">
                                <i class="bi bi-people fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Customer Intimacy</h5>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-white">
                            <div class="circle-icon mx-auto mb-3" style="width: 80px; height: 80px; background: rgba(255,255,255,0.1);">
                                <i class="bi bi-rocket-takeoff fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Product Leadership</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="team">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Our Expert Team</h2>
        <div class="row g-4 justify-content-center" id="staff-container">
            @isset($staff)
                @foreach($staff->where('is_public', true) as $member)
                    <div class="col-lg-4 col-md-6">
                        <div class="circle-card text-center p-4">
                            <img src="{{ $member->profile_image ? asset('storage/'.$member->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&size=400' }}"
                                 style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" class="mb-3">
                            <h4 class="fw-bold mb-1">{{ $member->name }}</h4>
                            <p class="text-primary small mb-0">{{ $member->role ?? 'Staff Member' }}</p>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section class="py-5" id="announcement" style="background-color: var(--br-50);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Latest Updates</h2>
            <button onclick="loadPage('announcements')" class="btn btn-sm btn-modern">View News</button>
        </div>
        <div class="announcement-wrapper" id="announcement-list">
            @isset($news)
                @foreach($news as $item)
                    <div class="announcement-card">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/defaults/image-default.png') }}" class="ann-img">
                        <div class="ann-overlay">
                            <span class="ann-date">{{ $item->created_at->format('M d, Y') }}</span>
                            <h3 class="ann-title text-truncate">{{ $item->title }}</h3>
                            <p class="ann-content text-truncate">{{ $item->content }}</p>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<div class="container-fluid py-5 bg-white">
    @include('public.testimonials')
</div>

<section class="resources-section" id="resources">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold mb-2">Related Links & Resources</h2>
                <p class="text-muted mb-0">Everything you need to get started.</p>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">View All</a>
        </div>

        <div class="row g-4" id="related-links">
            @php
                $currentLinks = $related_links ?? [];
                $links = is_array($currentLinks) ? $currentLinks : json_decode($currentLinks, true);
                $links = $links ?? [];
            @endphp

            @foreach($links as $link)
                <div class="col-lg-4 col-md-6">
                    @php $url = str_contains($link, '://') ? $link : 'https://' . $link; @endphp
                    <a href="{{ $url }}" target="_blank" class="resource-card">
                        <div class="resource-icon-circle">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                        <div class="resource-content">
                            <span class="link-title">{{ ucfirst(explode('.', $link)[0]) }}</span>
                            <p class="small text-muted mb-2">Explore the tools and workflow integration.</p>
                            <span class="link-url">{{ $link }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="wave-footer" id="contact">
    <div class="footer-circles">
        <div class="footer-circle"></div>
        <div class="footer-circle"></div>
    </div>
    <div class="container">
        <div class="row align-items-center footer-content">
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <a href="#" class="navbar-brand mb-3 d-inline-block">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>KEEPER LIBRARY
                </a>
                <p class="text-muted small mb-0">&copy; 2025 Keeper Library Inc. Crafted with precision.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex gap-4 justify-content-center justify-content-md-end mb-4">
                    <a href="#" class="text-muted"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-github fs-5"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-youtube fs-5"></i></a>
                </div>
                <p class="text-muted small mb-0">
                    <a href="#" class="text-muted text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                </p>
            </div>
        </div>
    </div>
</footer>
