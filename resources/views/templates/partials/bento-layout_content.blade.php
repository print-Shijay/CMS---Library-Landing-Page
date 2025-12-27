{{-- BENTO LAYOUT TEMPLATE - LIBRARY --}}
{{-- All content comes from user inputs --}}

{{-- HERO SECTION --}}
<div class="bento-grid">
    <!-- Main Content Bento -->
    <div class="bento-item bento-large">
        <div class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill mb-4">
            LIBRARY SERVICES
        </div>
        
        <h1 class="display-4 fw-bold mb-4">
            {{ $title ?? 'Library Portal' }}
        </h1>
        
        <p class="lead mb-5" style="color: #cbd5e1; font-size: 1.25rem;">
            {{ $description ?? 'Access our comprehensive library resources and digital collections.' }}
        </p>
        
        @if(!empty($button))
        <button class="btn btn-primary px-4 py-2 rounded-pill fw-semibold mt-auto">
            {{ $button }}
        </button>
        @endif
    </div>

    <!-- Image Bento -->
    <div class="bento-item bento-small">
        <div class="image-container rounded overflow-hidden" style="height: 100%; min-height: 300px;">
            @if(!empty($image))
                @php
                    // Check if it's a full URL
                    if (Str::startsWith($image, ['http://', 'https://'])) {
                        $imageSrc = $image;
                    } else {
                        // For storage paths, use the storage URL helper
                        if (Str::startsWith($image, 'landing/')) {
                            // This is likely from storage
                            $imageSrc = asset('storage/' . $image);
                        } else {
                            // Try various common patterns
                            $imageSrc = asset($image);
                        }
                    }
                @endphp
                
                <img src="{{ $imageSrc }}" 
                     alt="{{ $title ?? 'Library' }}" 
                     class="img-fluid w-100 h-100" 
                     style="object-fit: cover;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                
            @else
                <div class="h-100 w-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
                    <div class="text-center">
                        <i class="bi bi-book text-primary mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="text-muted mb-0">Upload an image</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- MISSION & VISION --}}
<div class="bento-grid">
    <!-- Mission -->
    <div class="bento-item bento-medium d-flex flex-column">
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                <i class="bi bi-compass text-primary fs-4"></i>
            </div>
            <h2 class="fw-bold mb-0">Mission</h2>
        </div>
        <div class="flex-grow-1 d-flex align-items-center">
            <p class="mb-0" style="color: #cbd5e1;">
                {{ $mission ?? 'To provide accessible and innovative library services that support learning and research.' }}
            </p>
        </div>
    </div>

    <!-- Vision -->
    <div class="bento-item bento-medium d-flex flex-column">
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                <i class="bi bi-eye text-success fs-4"></i>
            </div>
            <h2 class="fw-bold mb-0">Vision</h2>
        </div>
        <div class="flex-grow-1 d-flex align-items-center">
            <p class="mb-0" style="color: #cbd5e1;">
                {{ $vision ?? 'To be the leading center for knowledge and learning in our community.' }}
            </p>
        </div>
    </div>
</div>

{{-- STRATEGIC GOALS --}}
<div class="bento-item bento-full mb-4" style="background: linear-gradient(135deg, rgba(26, 35, 126, 0.3), rgba(26, 34, 54, 0.8)); border-color: rgba(57, 73, 171, 0.4);">
    <div class="row align-items-center">
        <div class="col-lg-4 mb-3 mb-lg-0">
            <div class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill mb-2">
                OUR FOCUS
            </div>
            <h2 class="fw-bold">Strategic Goals</h2>
        </div>
        <div class="col-lg-8">
            <div class="p-4 rounded" style="background: rgba(255, 255, 255, 0.05);">
                <p class="lead mb-0" style="color: #e2e8f0;">
                    {{ $goals ?? 'Enhancing digital collections, expanding access, and supporting academic success through innovative library services.' }}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- RELATED LINKS --}}
<div class="bento-item bento-full">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Related Links</h2>
            <p class="text-muted mb-0">Quick access to resources</p>
        </div>
        <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 px-3 py-2">
            @php
                // Process user links
                $links = [];
                if (isset($related_links)) {
                    if (is_array($related_links)) {
                        $links = $related_links;
                    } elseif (is_string($related_links)) {
                        $decoded = json_decode($related_links, true);
                        $links = is_array($decoded) ? $decoded : explode(',', $related_links);
                    }
                }
                echo count($links) . ' Links';
            @endphp
        </span>
    </div>

    <div class="bento-grid">
        @forelse($links as $index => $link)
            @php
                $link = trim($link);
                $icons = ['bi-book', 'bi-journal-text', 'bi-database', 'bi-link-45deg', 'bi-file-earmark-text'];
                $icon = $icons[$index % count($icons)] ?? 'bi-link';
                $colors = ['primary', 'success', 'warning', 'info'];
                $color = $colors[$index % count($colors)] ?? 'primary';
            @endphp
            
            <div class="bento-item bento-xsmall">
                <div class="d-flex align-items-start h-100">
                    <div class="rounded bg-{{ $color }} bg-opacity-10 p-2 me-3 flex-shrink-0">
                        <i class="bi {{ $icon }} text-{{ $color }} fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-1">{{ $link }}</h5>
                        <p class="text-muted small mb-0">Access {{ $link }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bento-item bento-full text-center py-4">
                <i class="bi bi-link-45deg text-muted mb-3" style="font-size: 2.5rem; opacity: 0.5;"></i>
                <p class="text-muted mb-0">No links added yet</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* Content-specific styles */
    .image-container {
        position: relative;
    }
    
    .image-container img {
        transition: transform 0.3s ease;
    }
    
    .image-container:hover img {
        transform: scale(1.02);
    }
    
    /* Text colors for better readability */
    h1, h2, h3, h4, h5, h6 {
        color: #ffffff !important;
    }
    
    .text-muted {
        color: #94a3b8 !important;
    }
    
    .lead {
        color: #cbd5e1 !important;
    }
    
    /* Button styles */
    .btn-primary {
        background: linear-gradient(135deg, #1a237e, #3949ab);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #3949ab, #1a237e);
        transform: translateY(-2px);
    }
    
    /* Mission & Vision alignment */
    .bento-medium {
        min-height: 200px; /* Ensure equal height */
        display: flex;
        flex-direction: column;
    }
    
    .bento-medium .flex-grow-1 {
        display: flex;
        align-items: center;
    }
    
    /* Bento Grid improvements */
    .bento-grid {
        display: grid;
        gap: 1.25rem;
        grid-template-columns: repeat(12, 1fr);
        grid-auto-rows: minmax(auto, 1fr); /* Allow rows to grow equally */
        align-items: stretch; /* Stretch items to fill row height */
    }
    
    .bento-item {
        background: var(--bento-card);
        border: 2px solid var(--bento-border);
        border-radius: 0.75rem;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.2s ease;
        height: 100%; /* Fill grid cell */
    }
    
    .bento-item:hover {
        border-color: var(--bento-accent);
        transform: translateY(-2px);
    }
    
    .bento-large { 
        grid-column: span 8; 
        min-height: 300px; /* Match image height */
    }
    
    .bento-medium { 
        grid-column: span 6; 
    }
    
    .bento-small { 
        grid-column: span 4; 
        min-height: 300px; /* Fixed height for image */
    }
    
    .bento-xsmall { 
        grid-column: span 3; 
    }
    
    .bento-full { 
        grid-column: 1 / -1; 
    }
    
    /* Make sure image fills container */
    .bento-small .image-container {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .bento-small .image-container img {
        flex: 1;
    }
    
    /* Responsive tweaks */
    @media (max-width: 992px) {
        .bento-large { 
            grid-column: span 12; 
            min-height: auto;
        }
        
        .bento-medium { 
            grid-column: span 12; 
            min-height: auto;
            margin-bottom: 1rem;
        }
        
        .bento-small { 
            grid-column: span 12; 
            min-height: 300px;
        }
        
        .bento-xsmall { 
            grid-column: span 6; 
        }
    }
    
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }
        
        .image-container {
            min-height: 250px;
        }
        
        .bento-small,
        .bento-xsmall {
            grid-column: span 12;
        }
        
        .bento-medium {
            min-height: 180px;
        }
    }
</style>

<script>
    // Debug image paths
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Raw image path from CMS:', "{{ $image ?? 'No image' }}");
        console.log('Processed image path:', "{{ $imageSrc ?? 'Not processed' }}");
        
        // Log all image sources on page load
        setTimeout(() => {
            document.querySelectorAll('img').forEach(img => {
                console.log('Image element src:', img.src);
                console.log('Image natural dimensions:', img.naturalWidth, 'x', img.naturalHeight);
            });
        }, 500);
    });
</script>

<footer class="py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted small mb-0">&copy; 2025 Library Management</p>
            </div>
            
        </div>
    </div>
</footer>