<section class="hero-section">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="section-tag mb-3 d-block" style="background: rgba(142, 192, 255, 0.2);">Welcome to the future</span>

                <h1 class="display-3 fw-bold mb-4" style="letter-spacing: -1px;">
                    {{ $title ?? 'Default Title' }}
                </h1>

                <p class="lead text-muted mb-5" style="max-width: 90%;">
                    {{ $description ?? 'Default Description text goes here.' }}
                </p>

                <div class="d-flex gap-3">
                    <button class="btn btn-modern shadow-lg">
                        {{ $button ?? 'Get Started' }}
                    </button>
                    <button class="btn btn-link text-dark fw-semibold text-decoration-none">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="floating-image hero-card">
                    <div class="hero-img-container">
                        @if(!empty($image))
                            <img src="{{ asset('storage/' . $image) }}" alt="Hero Image">
                        @else
                            <div style="background: var(--primary-gradient); height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-rocket-takeoff text-white" style="font-size: 10rem; opacity: 0.2;"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Mission & Vision --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-feature shadow-sm">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mb-3">
                        <i class="bi bi-lightning-charge-fill fs-4"></i>
                    </div>
                    <h3 class="fw-bold">Our Mission</h3>
                    <p>
                        {{ $mission ?? 'We aim to redefine the industry standards through innovation.' }}
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-feature shadow-sm">
                    <div class="icon-box bg-success bg-opacity-10 text-success mb-3">
                        <i class="bi bi-eye-fill fs-4"></i>
                    </div>
                    <h3 class="fw-bold">Our Vision</h3>
                    <p>
                        {{ $vision ?? 'To be the global leader in sustainable solutions.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Strategic Goals --}}
<section class="goals-section py-5">
    <div class="container text-center">
        <h2 class="display-6 fw-bold mb-3">
            Strategic Goals
        </h2>
        <p class="fs-5 mx-auto" style="max-width: 700px;">
            {{ $goals ?? 'Operational Excellence, Customer Intimacy, and Product Leadership.' }}
        </p>
    </div>
</section>

<section class="staff-section" id="team">
    <div class="container">
        <h2 class="section-title text-center" style="color: var(--text-main);">Meet Our Team</h2>
        <p class="section-subtitle text-center mb-5" style="color: var(--text-muted);">Dedicated professionals committed
            to supporting your learning journey.</p>

        <div class="row g-4 justify-content-center">
            @if (isset($staff))
                @foreach($staff->where('is_public', true) as $member)
                    <div class="col-lg-4 col-md-6">
                        <div class="staff-card">
                            <div class="staff-image-container">
                                <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=400' }}"
                                    class="staff-image" alt="{{ $member->name }}">
                            </div>

                            <div class="staff-info">
                                <div class="staff-role">{{ $member->role ?? 'Administrator' }}</div>
                                <h3 class="staff-name">{{ $member->name }}</h3>
                                <p style="color: var(--text-muted); font-size: 0.9rem;">Driving innovation through expertise and
                                    commitment to quality.</p>

                                <div class="staff-social-links">
                                    @php
                                        $socialData = is_string($member->social_media) ? json_decode($member->social_media, true) : $member->social_media;
                                        $iconMap = [
                                            'facebook' => ['icon' => 'fab fa-facebook-f', 'class' => 'link-facebook'],
                                            'twitter' => ['icon' => 'fab fa-x-twitter', 'class' => 'link-twitter'],
                                            'instagram' => ['icon' => 'fab fa-instagram', 'class' => 'link-instagram'],
                                            'linkedin' => ['icon' => 'fab fa-linkedin-in', 'class' => 'link-linkedin']
                                        ];
                                    @endphp

                                    @if(!empty($socialData) && is_array($socialData))
                                        @foreach($socialData as $platform => $url)
                                            @if(!empty($url) && $url !== 'null' && isset($iconMap[$platform]) && filter_var($url, FILTER_VALIDATE_URL))
                                                @php $config = $iconMap[$platform]; @endphp
                                                <a href="{{ $url }}" target="_blank" class="social-icon-link {{ $config['class'] }}"
                                                    title="{{ ucfirst($platform) }}" rel="noopener noreferrer">
                                                    <i class="{{ $config['icon'] }}"></i>
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="view-all-container text-center">
            <a class="btn-view-all" href="#" onclick="loadPage('{{ 'staff-page'}}'); return false;">
                View All Team Members <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>



<section class="py-5" id="announcement" style="background-color: var(--br-50);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="section-title mb-0" style="color: var(--text-main);">Latest News</h2>
                <p class="text-muted mb-0">Stay updated with our community updates.</p>
            </div>
            {{-- Optional: Scroll buttons or link to all --}}
            <a href="#" onclick="loadPage('{{ 'announcements'}}'); return false;" class="btn-view-all py-2 px-4"
                style="font-size: 0.8rem; border-width: 1px;">
                View All
            </a>
        </div>

        <div class="announcement-wrapper">
            @if (isset($news))
                @forelse($news as $item)
                    <div class="announcement-card">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/defaults/image-default.png') }}"
                            class="ann-img" alt="{{ $item->title }}">

                        <div class="ann-overlay">
                            <span class="ann-date">{{ $item->created_at->format('M d, Y') }}</span>
                            <h3 class="ann-title">{{ $item->title }}</h3>
                            <p class="ann-content">{{ $item->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center w-100 py-5">
                        <p class="text-muted">No announcement available at the moment.</p>
                    </div>
                @endforelse
            @endif

        </div>
    </div>
</section>

{{-- Related Resources --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="fw-bold m-0">Related Resources</h2>
            <span class="badge bg-light text-dark border">External Links</span>
        </div>

        <div class="row g-4">
            @php
                $links = is_array($related_links ?? [])
                    ? ($related_links ?? [])
                    : json_decode($related_links, true);
            @endphp

            @forelse($links ?? [] as $link)
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="link-preview-card">
                        <div class="link-thumbnail">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <div class="link-content">
                            <span class="link-title">{{ $link }}</span>
                            <span class="link-description">
                                Explore resources regarding {{ $link }}.
                            </span>
                            <span class="link-url">
                                https://resource.link/{{ Str::slug($link) }}
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    No related resources available.
                </div>
            @endforelse
        </div>
    </div>
</section>

<footer class="py-4 border-top">
    <div class="container text-center text-muted small">
        &copy; 2025 Your Modern Site. All rights reserved.
    </div>
</footer>
