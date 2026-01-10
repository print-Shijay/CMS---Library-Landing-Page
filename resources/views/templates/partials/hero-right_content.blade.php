<section class="section-padding position-relative" id="home" style="background: #f6f9ff;">
    <div class="floating-shape floating-shape-1"></div>
    <div class="floating-shape floating-shape-2"></div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-1">
                <div class="hero-image-container position-relative">
                    <div class="position-relative z-2" style="height: 500px;">
                        {{-- Hybrid Image Logic --}}
                        <img src="{{ isset($image) ? asset('storage/' . $image) : asset('images/defaults/landing-default.png') }}"
                             alt="Digital Library Platform"
                             class="img-fluid w-100 h-100 hero-bg"
                             id="hero-image-element"
                             style="{{ !isset($image) ? 'display:none;' : 'display:block; object-fit: cover; border-radius: 20px;' }}">

                        {{-- Placeholder for modern layout --}}
                        @if(!isset($image))
                            <div id="hero-placeholder-icon" class="d-flex flex-column align-items-center justify-content-center h-100 text-white"
                                 style="background-color: #2A71FE; border-radius: 20px;">
                                <i class="bi bi-book" style="font-size: 5rem; opacity: .2;"></i>
                                <p class="mt-3 opacity-75">Digital Library Platform</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-2">
                <div class="position-relative z-1">
                    <span class="badge rounded-pill px-4 py-2 mb-3"
                        style="background-color: rgba(42, 113, 254, 0.1); color: #2A71FE; font-weight: 600;">
                        <i class="bi bi-book me-2"></i> Welcome to Our Digital Library
                    </span>

                    {{-- Logic Classes Applied --}}
                    <h1 class="hero-title fw-bold mb-4">
                        {{ $title ?? 'Discover Limitless Knowledge' }}
                    </h1>

                    <p class="hero-description text-muted fs-5 mb-4" style="line-height: 1.8;">
                        {{ $description ?? 'Access thousands of digital books, academic journals, and research materials from anywhere, anytime. Our modern library platform connects you with the world of knowledge.' }}
                    </p>

                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <button class="btn gradient-btn text-white hero-btn">
                            {{ $button ?? 'Browse Collection' }}
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white position-relative" id="about">
    <div class="container">
        <h2 class="text-center section-title fw-bold">Our Library Values</h2>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="stat-card h-100">
                    <div class="icon-container">
                        <i class="bi bi-book-half fs-3" style="color: #2A71FE;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Mission</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;" data-key="mission">
                        {{ $mission ?? 'To provide universal access to knowledge and information through our digital library platform, empowering lifelong learning, research, and intellectual growth for all.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="stat-card h-100">
                    <div class="icon-container">
                        <i class="bi bi-eye fs-3" style="color: #2A71FE;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Our Vision</h4>
                    <p class="text-muted mb-0" style="line-height: 1.8;" data-key="vision">
                        {{ $vision ?? 'To become the premier digital library platform that bridges knowledge gaps, fosters innovation, and creates a global community of learners and researchers.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding goals-section position-relative" id="goals">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="text-uppercase opacity-75 mb-3" style="letter-spacing: 2px; font-size: 0.9rem;">
                    <i class="bi bi-bullseye me-2"></i> Library Strategy
                </div>
                <h2 class="fw-bold text-white mb-4">Library Strategic Goals</h2>
                <p class="text-white-50 mb-4" data-key="goals">
                    {{ $goals ?? 'Our strategic roadmap focuses on digital excellence and inclusive access.' }}
                </p>
                <a href="#" class="btn btn-outline-light rounded-pill px-4">
                    Learn More <i class="bi bi-arrow-up-right ms-1"></i>
                </a>
            </div>

            <div class="col-lg-8">
                <div class="bg-white rounded-4 p-4 p-md-5">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <i class="bi bi-collection feature-icon"></i>
                            <h5 class="fw-bold mb-3">Collection Development</h5>
                            <p class="text-muted small mb-0">Expand and diversify our digital collection with relevant, high-quality resources.</p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <i class="bi bi-people feature-icon"></i>
                            <h5 class="fw-bold mb-3">User Engagement</h5>
                            <p class="text-muted small mb-0">Enhance library services and user experience through innovative programs.</p>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-0">
                            <i class="bi bi-search feature-icon"></i>
                            <h5 class="fw-bold mb-3">Research Excellence</h5>
                            <p class="text-muted small mb-0">Provide comprehensive research support and access to scholarly resources.</p>
                        </div>
                        <div class="col-md-6">
                            <i class="bi bi-globe2 feature-icon"></i>
                            <h5 class="fw-bold mb-3">Global Accessibility</h5>
                            <p class="text-muted small mb-0">Make library resources accessible to communities worldwide.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white" id="team">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Professional Librarians</h2>
            <p class="text-muted">Experts dedicated to organizing and preserving knowledge.</p>
        </div>
        <div class="row g-4" id="staff-container">
            @isset($staff)
                @foreach($staff->where('is_public', true) as $member)
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card text-center p-4">
                            <img src="{{ $member->profile_image ? asset('storage/'.$member->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&size=200' }}"
                                 class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f6f9ff;">
                            <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                            <small class="text-primary fw-semibold">{{ $member->role ?? 'Librarian' }}</small>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section class="section-padding" style="background: #f6f9ff;" id="announcement">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold m-0">Library News & Events</h2>
            <button onclick="loadPage('announcements')" class="btn btn-outline-primary rounded-pill btn-sm px-4">View All News</button>
        </div>
        <div class="announcement-wrapper" id="announcement-list">
            @isset($news)
                @foreach($news as $item)
                    <div class="announcement-card bg-white rounded-4 shadow-sm overflow-hidden" style="min-width: 300px; border: 1px solid #eee;">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/defaults/image-default.png') }}" class="w-100" style="height: 180px; object-fit: cover;">
                        <div class="p-3">
                            <span class="badge bg-light text-primary mb-2">{{ $item->created_at->format('M d, Y') }}</span>
                            <h5 class="fw-bold text-truncate">{{ $item->title }}</h5>
                            <p class="text-muted small text-truncate-2">{{ $item->content }}</p>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        @include('public.testimonials')
    </div>
</section>

<section class="section-padding bg-light" id="resources">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-3">Library Resources</h3>
            <p class="text-muted mb-0">Explore our curated collection of digital resources and references</p>
        </div>

        <div class="row g-4" id="related-links">
            @php
                // Use ?? [] to ensure that if the variable is missing, it defaults to an empty array
                $currentLinks = $related_links ?? [];
                $links = is_array($currentLinks) ? $currentLinks : json_decode($currentLinks, true);

                // Ensure $links is an array so the @foreach doesn't crash either
                $links = $links ?? [];
                $icons = ['bi-book', 'bi-journal-text', 'bi-database', 'bi-play-btn', 'bi-journal-bookmark', 'bi-archive'];
            @endphp

            @foreach($links as $index => $link)
                <div class="col-lg-4 col-md-6">
                    @php
                        // Detect if data is New Format (Array) or Old Format (String)
                        if (is_array($link)) {
                            $rawUrl = $link['url'] ?? '#';
                            // Use stored title, or fallback to parsing the URL if title is missing
                            $titleText = !empty($link['title']) ? $link['title'] : ucfirst(explode('.', $rawUrl)[0]);
                        } else {
                            // Legacy Format handling
                            $rawUrl = $link;
                            $titleText = ucfirst(explode('.', $link)[0]);
                        }

                        // Ensure URL has protocol (http/https) for the clickable href
                        $href = str_contains($rawUrl, '://') ? $rawUrl : 'https://' . $rawUrl;
                    @endphp
                    <a href="{{ $href }}" class="resource-card d-block text-decoration-none bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-container me-3" style="width: 50px; height: 50px; background: rgba(42, 113, 254, 0.05); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi {{ $icons[$index % 6] }} fs-5" style="color: #2A71FE;"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0 text-truncate">{{ str_replace(['http://', 'https://'], '', $rawUrl) }}</h6>
                        </div>
                        <p class="text-muted small mb-3">{{ $titleText }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Updated regularly</small>
                            <i class="bi bi-arrow-right-circle" style="color: #2A71FE;"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="py-5 border-top" style="background: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="d-flex align-items-center">
                    <div class="icon-container me-3" style="width: 40px; height: 40px; background: rgba(42, 113, 254, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-book" style="color: #2A71FE;"></i>
                    </div>
                    <span class="fw-bold fs-5">Digital<span class="text-primary">Library</span></span>
                </div>
                <p class="text-muted small mt-3 mb-0">
                    &copy; 2025 Digital Library Platform. All rights reserved.<br>
                    Empowering minds through accessible knowledge.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-md-end gap-3">
                    <a href="#" class="text-decoration-none text-muted small">Library Policies</a>
                    <a href="#" class="text-decoration-none text-muted small">Terms of Use</a>
                </div>
                <div class="mt-3">
                    <a href="#" class="text-decoration-none me-3"><i class="bi bi-twitter" style="color: #2A71FE;"></i></a>
                    <a href="#" class="text-decoration-none me-3"><i class="bi bi-linkedin" style="color: #2A71FE;"></i></a>
                    <a href="#" class="text-decoration-none me-3"><i class="bi bi-facebook" style="color: #2A71FE;"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-envelope" style="color: #2A71FE;"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
