<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column -->
            <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
                <span class="section-tag">{{ $left_tag ?? 'Next Generation Platform' }}</span>
                <h1 class="display-3 mb-4">{{ $left_title ?? 'Build something that truly matters' }}</h1>
                <p class="lead text-muted mb-5" style="line-height: 1.6;">
                    {{ $left_description ?? 'Our platform provides the tools you need to build, scale, and manage your vision efficiently.' }}
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start align-items-center">
                    <button class="btn btn-modern">{{ $left_button ?? 'Start Building' }}</button>
                    <button class="btn btn-link text-dark fw-bold text-decoration-none px-4">
                        View Demo <i class="bi bi-play-circle-fill ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6 text-center text-lg-start">
                <span class="section-tag">{{ $right_tag ?? 'Your Vision, Your Way' }}</span>
                <h1 class="display-3 mb-4">{{ $right_title ?? 'Collaborate and Create' }}</h1>
                <p class="lead text-muted mb-5" style="line-height: 1.6;">
                    {{ $right_description ?? 'Collaborate seamlessly and achieve your goals with our powerful tools and ecosystem.' }}
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start align-items-center">
                    <button class="btn btn-modern">{{ $right_button ?? 'Learn More' }}</button>
                    <button class="btn btn-link text-dark fw-bold text-decoration-none px-4">
                        Explore <i class="bi bi-play-circle-fill ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Optional Floating Image -->
            <div class="col-12 mt-4">
                <div class="hero-img-container mx-auto" style="max-width: 900px;">
                    @if(!empty($image))
                        <img src="{{ asset('storage/' . $image) }}" class="w-100 rounded" alt="Hero">
                    @else
                        <div style="background: var(--primary-gradient); height: 540px; display: flex; align-items: center; justify-content: center; border-radius: 32px;">
                            <i class="bi bi-layers-half text-white" style="font-size: 10rem; opacity: 0.15;"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-feature">
                    <div class="icon-box bg-indigo-50 text-primary" style="background: #eef2ff;">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h3 class="fw-bold h4">Our Mission</h3>
                    <p class="text-muted mb-0">
                        {{ $mission ?? 'We aim to redefine industry standards by providing high-performance tools for modern creators.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-feature">
                    <div class="icon-box bg-emerald-50 text-success" style="background: #ecfdf5;">
                        <i class="bi bi-command"></i>
                    </div>
                    <h3 class="fw-bold h4">Our Vision</h3>
                    <p class="text-muted mb-0">
                        {{ $vision ?? 'Empowering every individual to turn their ideas into reality with zero technical friction.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="goals-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2 class="display-5 fw-bold mb-4">Strategic Goals</h2>
                <p class="fs-5 text-white-50">
                    {{ $goals ?? 'We focus on operational excellence, customer intimacy, and relentless product leadership to stay ahead of the curve.' }}
                </p>
            </div>
        </div>
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

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold mb-0">Resources</h2>
                <p class="text-muted mb-0">Everything you need to get started.</p>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill">View All</a>
        </div>

        <div class="row g-4">
            @php
                $links = is_array($related_links ?? []) ? $related_links : json_decode($related_links ?? '[]', true);
            @endphp

            @forelse($links ?? ['Documentation', 'API Reference', 'Community'] as $link)
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="link-preview-card">
                        <div class="link-thumbnail">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                        <div>
                            <span class="link-title">{{ $link }}</span>
                            <p class="small text-muted mb-2">Deep dive into our ecosystem and master the workflow.</p>
                            <span class="link-url">docs.brand.io/{{ Str::slug($link) }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No resources available.</div>
            @endforelse
        </div>
    </div>
</section>

<footer class="py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted small mb-0">&copy; 2025 BRAND Inc. Crafted with precision.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex gap-4 justify-content-center justify-content-md-end mt-3 mt-md-0">
                    <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>