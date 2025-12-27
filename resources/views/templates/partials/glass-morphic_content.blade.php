<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mb-5">
                    <span class="hero-badge floating">
                        <i class="bi bi-stars me-2"></i>Library Content
                    </span>
                    <h1 class="hero-title">{{ $title ?? 'Digital Library Hub' }}</h1>
                    <p class="lead text-secondary mb-5" style="font-size: 1.25rem;">
                        {{ $description ?? 'Experience the future of digital learning with our immersive glass-morphic interface. Access premium resources in a visually stunning environment.' }}
                    </p>
                    @if(!empty($button))
                    <button class="btn-gradient">
                        {{ $button }} <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-container floating" style="height: 500px;">
                    @if(!empty($image))
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $title ?? 'Library' }}" 
                         onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'h-100 w-100 d-flex align-items-center justify-content-center glass-light\'><div class=\'text-center p-5\'><i class=\'bi bi-image text-primary mb-4\' style=\'font-size: 4rem; opacity: 0.5;\'></i><h4 class=\'fw-bold mb-2\'>Featured Content</h4><p class=\'text-secondary mb-0\'>Visual showcase area</p></div></div>';">
                    @else
                    <div class="h-100 w-100 d-flex align-items-center justify-content-center glass-light">
                        <div class="text-center p-5">
                            <div class="card-icon mx-auto mb-4">
                                <i class="bi bi-camera"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Visual Showcase</h4>
                            <p class="text-secondary mb-0">Upload an image to feature here</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="glass-card">
                    <div class="card-icon">
                        <i class="bi bi-compass"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Mission</h3>
                    <p class="text-secondary">
                        {{ $mission ?? 'To revolutionize digital learning through cutting-edge design, seamless accessibility, and curated knowledge that inspires innovation and personal growth.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card">
                    <div class="card-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Vision</h3>
                    <p class="text-secondary">
                        {{ $vision ?? 'To create a world where knowledge is not just accessible but beautifully presented, where learning becomes an immersive experience that captivates and empowers.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Strategic Goals -->
<section class="py-5">
    <div class="container">
        <div class="glass-card p-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="hero-badge mb-4">STRATEGIC FOCUS</span>
                    <h2 class="display-5 fw-bold mb-4">Our Strategic Goals</h2>
                    <p class="lead text-secondary mb-5">
                        {{ $goals ?? 'Driving innovation in digital education through immersive interfaces, comprehensive resource development, and community-driven learning experiences that set new standards for accessibility and engagement.' }}
                    </p>
                    
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="glass-light p-4 rounded-3">
                                <div class="card-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-cpu"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Tech Innovation</h5>
                                <p class="text-secondary small">Advanced digital infrastructure</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-light p-4 rounded-3">
                                <div class="card-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Community Growth</h5>
                                <p class="text-secondary small">Expanding user engagement</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-light p-4 rounded-3">
                                <div class="card-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Continuous Evolution</h5>
                                <p class="text-secondary small">Ongoing improvement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Links -->
<section class="py-5">
    <div class="container">
        <div class="mb-5">
            <h2 class="display-5 fw-bold mb-3">Related Links</h2>
            <p class="lead text-secondary">Quick access to resources</p>
        </div>

        <div class="links-grid">
            @php
                $links = is_array($related_links ?? []) ? ($related_links ?? []) : json_decode($related_links ?? '[]', true);
                $icons = ['bi-book', 'bi-journal-text', 'bi-database', 'bi-file-earmark-text', 'bi-camera-video', 'bi-music-note'];
                $colors = ['primary', 'secondary', 'accent'];
            @endphp
            
            @forelse($links as $index => $link)
            <a href="#" class="link-item">
                <div class="link-icon">
                    <i class="bi {{ $icons[$index % count($icons)] ?? 'bi-link' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-1">{{ $link }}</h5>
                    <p class="text-secondary small mb-0">Related {{ strtolower($link) }} links</p>
                </div>
                <div class="ms-auto">
                    <i class="bi bi-chevron-right text-primary"></i>
                </div>
            </a>
            @empty
            <div class="col-12">
                <div class="glass-card text-center py-5">
                    <div class="card-icon mx-auto mb-4" style="background: var(--gradient-glass); color: var(--primary-color);">
                        <i class="bi bi-folder-plus"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Add Resources</h4>
                    <p class="text-secondary mb-0">Quick access to resources</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="glass-light p-4 rounded-3">
                    <h5 class="fw-bold mb-3">Library</h5>
                    <p class="text-secondary small mb-0">Where knowledge meets design. Experience the future of digital learning.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-light p-4 rounded-3">
                    <div class="d-flex justify-content-center justify-content-md-end gap-4">
                        <a href="#" class="text-secondary hover-lift">
                            <i class="bi bi-twitter fs-5"></i>
                        </a>
                        <a href="#" class="text-secondary hover-lift">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="#" class="text-secondary hover-lift">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                        <a href="#" class="text-secondary hover-lift">
                            <i class="bi bi-discord fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 pt-5 text-center">
            <p class="text-secondary small mb-0">© 2025 Library Management.</p>
        </div>
    </div>
</footer>

<style>
    .hover-lift {
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .hover-lift:hover {
        transform: translateY(-3px);
        color: var(--primary-color) !important;
    }
    
    .text-primary {
        color: var(--primary-color) !important;
    }
    
    .text-secondary {
        color: var(--text-secondary) !important;
    }
</style>

<script>
    // Add floating animation to elements
    document.addEventListener('DOMContentLoaded', function() {
        const floatingElements = document.querySelectorAll('.floating');
        floatingElements.forEach(el => {
            el.style.animationDelay = `${Math.random() * 2}s`;
        });
        
        // Add hover effect to glass cards
        const cards = document.querySelectorAll('.glass-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) rotateX(5deg)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) rotateX(0)';
            });
        });
    });
</script>