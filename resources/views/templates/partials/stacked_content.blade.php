<section class="hero-container" id="home">
    <div class="hero-content">
        <div class="subtitle">LIBRARY SERVICES</div>
        {{-- Added hero-title class --}}
        <h1 class="main-title hero-title">
            {{ $title ?? 'Welcome to Our Library' }}<span class="dot">.</span>
        </h1>
        {{-- Added hero-description class --}}
        <p class="description hero-description">
            {{ $description ?? 'Discover a world of knowledge with our comprehensive library services. Access millions of resources, expert assistance, and state-of-the-art facilities designed to support your academic and personal growth.' }}
        </p>
        {{-- Added hero-btn class to a potential button if needed, or just standard flow --}}
        <div class="hero-cta mt-4">
            <button class="btn btn-primary hero-btn px-4 py-2">{{ $button ?? 'Explore Now' }}</button>
        </div>
    </div>
    <div class="hero-image">
        {{-- Added hero-bg class for JS replacement --}}
        @if(!empty($image))
            <img src="{{ asset('storage/' . $image) }}" alt="Library Image" id="heroImage" class="hero-bg">
        @else
            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1200&auto=format&fit=crop&q=80" alt="Modern Library Interior" id="heroImage" class="hero-bg">
        @endif
    </div>
</section>

<section class="mission-vision-container" id="about">
    <div class="illustration-box">
        <div class="planet-illustration">
            <div class="orbit orbit-1"></div>
            <div class="orbit orbit-2"></div>
            <div class="orbit orbit-3"></div>
            <div class="planet-dot dot-1"></div>
            <div class="planet-dot dot-2"></div>
            <div class="planet-dot dot-3"></div>
        </div>
    </div>

    <div class="mission-vision-section">
        <div class="section-header">
            <div class="section-badge">OUR PURPOSE</div>
        </div>

        <div class="mv-container">
            <div class="mv-card mission-card">
                <div class="mv-card-header">
                    <div class="mv-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3>OUR MISSION</h3>
                    <div class="mv-divider"></div>
                </div>
                <div class="mv-card-body">
                    {{-- Added data-key="mission" --}}
                    <p data-key="mission">{{ $mission ?? 'To democratize access to knowledge through innovative digital solutions...' }}</p>
                </div>
            </div>

            <div class="mv-card vision-card">
                <div class="mv-card-header">
                    <div class="mv-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3>OUR VISION</h3>
                    <div class="mv-divider"></div>
                </div>
                <div class="mv-card-body">
                    {{-- Added data-key="vision" --}}
                    <p data-key="vision">{{ $vision ?? 'To become the leading digital-first knowledge ecosystem...' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="strategic-goals-section" id="goals">
    <div class="goals-container">
        <h2 class="section-title" style="text-align: center; margin-bottom: 60px; font-size: 2.8rem; color: var(--deep-blue);">Strategic Goals</h2>

        <div class="hexagon-row">
            <div class="hexagon-item">
                <div class="hexagon-wrapper">
                    <svg viewBox="0 0 100 100" class="hexagon-svg">
                        <polygon points="50,10 90,30 90,70 50,90 10,70 10,30" fill="#4a7cb8" opacity="0.8"/>
                        <polygon points="50,25 75,40 75,60 50,75 25,60 25,40" fill="#6ba3d8"/>
                    </svg>
                </div>
            </div>
            <div class="hexagon-item">
                <div class="hexagon-wrapper">
                    <svg viewBox="0 0 100 100" class="hexagon-svg">
                        <polygon points="50,10 90,30 90,70 50,90 10,70 10,30" fill="#4a7cb8" opacity="0.8"/>
                        <polygon points="50,25 75,40 75,60 50,75 25,60 25,40" fill="#6ba3d8"/>
                    </svg>
                </div>
            </div>
            <div class="hexagon-item">
                <div class="hexagon-wrapper">
                    <svg viewBox="0 0 100 100" class="hexagon-svg">
                        <polygon points="50,10 90,30 90,70 50,90 10,70 10,30" fill="#4a7cb8" opacity="0.8"/>
                        <polygon points="50,25 75,40 75,60 50,75 25,60 25,40" fill="#6ba3d8"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Added data-key="goals" --}}
        <p class="goals-description" data-key="goals">
            {{ $goals ?? 'Our strategic goals focus on expanding digital access, community engagement, and lifelong learning.' }}
        </p>
    </div>
</section>

<section class="py-5" id="team" style="background: #fdfdfd;">
    <div class="container">
        <h2 class="section-title text-center mb-5" style="color: var(--deep-blue);">Library Staff</h2>
        <div class="row g-4" id="staff-container">
            @isset($staff)
                @foreach($staff->where('is_public', true) as $member)
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mv-card p-4 h-100">
                            <img src="{{ $member->profile_image ? asset('storage/'.$member->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&size=200' }}"
                                 class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f0f4f8;">
                            <h5 class="fw-bold">{{ $member->name }}</h5>
                            <span class="text-muted small">{{ $member->role ?? 'Staff' }}</span>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section class="py-5" id="announcement" style="background: #f0f4f8;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="section-title m-0" style="color: var(--deep-blue);">News & Updates</h2>
            <button onclick="loadPage('announcements')" class="btn btn-outline-dark btn-sm rounded-pill">View All</button>
        </div>
        <div class="announcement-wrapper d-flex gap-4 overflow-auto pb-4" id="announcement-list">
            @isset($news)
                @foreach($news as $item)
                    <div class="announcement-card bg-white p-3 rounded-4 shadow-sm" style="min-width: 280px;">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/defaults/image-default.png') }}" class="w-100 rounded-3 mb-3" style="height: 150px; object-fit: cover;">
                        <h6 class="fw-bold text-truncate">{{ $item->title }}</h6>
                        <p class="small text-muted text-truncate">{{ $item->content }}</p>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        @include('public.testimonials')
    </div>
</section>

<section class="resources-section" id="resources">
    <div class="resources-content">
        <h2 class="resources-title">Featured Resources</h2>

        <div class="resources-grid" id="related-links">
            @php
                $links = is_array($related_links ?? null) ? ($related_links ?? []) : json_decode($related_links ?? '[]', true);
                if (empty($links)) {
                    $links = ['Digital Collections', 'Research Databases', 'Online Learning', 'Special Archives'];
                }
            @endphp

            @foreach($links as $link)
                @php $url = str_contains($link, '://') ? $link : '#'; @endphp
                <a href="{{ $url }}" class="resource-card">
                    <div class="resource-card-inner">
                        <span class="resource-text">{{ $link }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
