<style>
    /* Featured Card */
    .featured-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        background: #fff;
        transition: transform 0.3s ease;
        height: 100%;
    }
    .featured-card:hover { transform: translateY(-5px); }
    .featured-image-container {
        height: 250px;
        position: relative;
        overflow: hidden;
        width: 100%;
    }
    .featured-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease;
    }
    .featured-card:hover .featured-image { transform: scale(1.05); }

    /* Sidebar Recent Items */
    .sidebar-item {
        transition: all 0.2s ease;
        cursor: pointer;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
    }
    .sidebar-item:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
    .sidebar-img {
        width: 90px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }

    /* Grid Cards */
    .news-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .news-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    .news-card-img-top { height: 220px; object-fit: cover; width: 100%; }
    .news-meta { font-size: 0.75rem; color: #6c757d; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
    .news-title { font-weight: 700; font-size: 1.2rem; line-height: 1.4; color: #212529; }
</style>

@php
    $allAnnouncements = $announcements ?? \App\Models\Announcement::latest()->get();

    $featured = null;
    $recent = collect([]);
    $older = collect([]);

    if(request()->has('preview') && request()->has('title')) {
        // Preview Mode: Create a fake object for the featured spot
        $featured = (object)[
            'id' => 'preview',
            'title' => request('title'),
            'content' => request('content'),
            'created_at' => request('created_at') ? \Carbon\Carbon::parse(request('created_at')) : now(),
            'image' => request('image'), // path string
            'is_preview' => true
        ];
        // Show existing DB announcements as recent/older
        $recent = $allAnnouncements->take(4);
        $older = $allAnnouncements->slice(4);
    } elseif($allAnnouncements->count() > 0) {
        // Normal Mode: First item is featured
        $featured = $allAnnouncements->first();
        $remaining = $allAnnouncements->slice(1);
        $recent = $remaining->take(4);
        $older = $remaining->slice(4);
    }
@endphp

<div class="container py-5">
    @if(!$featured && $recent->isEmpty() && $older->isEmpty())
        <div class="text-center py-5 text-muted">No announcements found.</div>
    @else
        <div class="row g-5 mb-5">
            <!-- Left Column: Huge Featured Article -->
            <div class="col-lg-7">
                @if($featured)
                <div class="featured-card">
                    <div class="featured-image-container">
                    @php
                        $featImg = '';
                        if(isset($featured->is_preview) && $featured->is_preview) {
                            $featImg = $featured->image ? asset('storage/' . $featured->image) : '';
                        } elseif($featured->image) {
                            $featImg = asset('storage/' . $featured->image);
                        }
                    @endphp
                    <img id="{{ isset($featured->is_preview) ? 'preview-img-tag' : '' }}"
                         src="{{ $featImg ?: 'https://placehold.co/800x600/f8f9fa/dee2e6?text=Featured+Update' }}"
                         class="featured-image {{ ($featImg || isset($featured->is_preview)) ? '' : 'd-none' }}"
                         alt="Featured">
                    </div>
                    <div class="card-body p-4">
                        <div class="news-meta mb-2">
                            <i class="far fa-clock me-2"></i>{{ $featured->created_at->format('F d, Y') }}
                            @if(isset($featured->is_preview)) <span class="badge bg-warning text-dark ms-2">PREVIEW</span> @endif
                        </div>
                        <h3 class="fw-bold mb-3 display-6">{{ $featured->title }}</h3>
                        <p class="text-muted mb-4 text-break">{{ \Illuminate\Support\Str::limit($featured->content, 250) }}</p>
                        <button class="btn btn-primary align-self-start" data-bs-toggle="modal" data-bs-target="#modal-{{ $featured->id }}">Read More </button>
                    </div>
                </div>

                <!-- Modal for Featured -->
                <div class="modal fade" id="modal-{{ $featured->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 p-lg-5">
                                @if($featured->image)
                                    <img src="{{ asset('storage/' . $featured->image) }}" class="img-fluid rounded-3 mb-4 w-100" alt="{{ $featured->title }}">
                                @endif
                                <div class="text-muted small fw-bold mb-2">{{ $featured->created_at->format('F d, Y') }}</div>
                                <h2 class="fw-bold mb-4">{{ $featured->title }}</h2>
                                <div class="text-muted text-break" style="white-space: pre-wrap; line-height: 1.8;">{{ $featured->content }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Recent News List -->
            <div class="col-lg-5">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Recent Announcements</h4>
                <div class="d-flex flex-column gap-3">
                    @foreach($recent as $item)
                        <div class="d-flex gap-3 sidebar-item p-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://placehold.co/200x200/f8f9fa/dee2e6?text=News' }}"
                                 class="sidebar-img" alt="Thumbnail">
                            <div class="grow">
                                <h6 class="fw-bold mb-1 text-dark" style="line-height: 1.3;">{{ $item->title }}</h6>
                                <div class="text-muted small mb-1">{{ $item->created_at->format('M d, Y') }}</div>
                                <p class="text-muted small mb-0 lh-sm text-break">{{ \Illuminate\Support\Str::limit($item->content, 50) }}</p>
                            </div>
                        </div>

                        <!-- Modal for Recent Item -->
                        <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 p-lg-5">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded-3 mb-4 w-100" alt="{{ $item->title }}">
                                        @endif
                                        <div class="text-muted small fw-bold mb-2">{{ $item->created_at->format('F d, Y') }}</div>
                                        <h2 class="fw-bold mb-4">{{ $item->title }}</h2>
                                        <div class="text-muted text-break" style="white-space: pre-wrap; line-height: 1.8;">{{ $item->content }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Section: Older Announcements -->
        @if($older->count() > 0)
        <div class="d-flex align-items-center mb-4">
            <h3 class="fw-bold mb-0 me-3">Older Announcements</h3>
            <div class="grow border-bottom"></div>
        </div>

        <div class="row g-4">
            @foreach($older as $announcement)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $announcement->image ? asset('storage/' . $announcement->image) : 'https://placehold.co/600x400/f8f9fa/dee2e6?text=News' }}"
                                 class="news-card-img-top" alt="{{ $announcement->title }}">
                        </div>
                        <div class="card-body p-4 d-flex flex-column grow">
                            <div class="news-meta mb-2">{{ $announcement->created_at->format('M d, Y') }}</div>
                            <h5 class="news-title mb-3">{{ $announcement->title }}</h5>
                            <p class="text-muted small mb-4 grow text-break">{{ \Illuminate\Support\Str::limit($announcement->content, 120) }}</p>
                            <div class="mt-auto pt-3 border-top">
                                <button class="btn btn-link text-primary p-0 text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#modal-{{ $announcement->id }}">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-{{ $announcement->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 p-lg-5">
                                @if($announcement->image)
                                    <img src="{{ asset('storage/' . $announcement->image) }}" class="img-fluid rounded-3 mb-4 w-100" alt="{{ $announcement->title }}">
                                @endif
                                <div class="text-muted small fw-bold mb-2">{{ $announcement->created_at->format('F d, Y') }}</div>
                                <h2 class="fw-bold mb-4">{{ $announcement->title }}</h2>
                                <div class="text-muted text-break" style="white-space: pre-wrap; line-height: 1.8;">{{ $announcement->content }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    @endif
</div>

@if(request()->has('preview'))
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @if(isset($featured->is_preview))
    <script>
        // Check if we should load a temporary new image from LocalStorage (for live preview of uploads)
        if("{{ request('use_temp_image') }}" === "true") {
            const tempImg = localStorage.getItem('preview_temp_image');
            if(tempImg) {
                const imgTag = document.getElementById('preview-img-tag');
                if(imgTag) {
                    imgTag.src = tempImg;
                    imgTag.classList.remove('d-none');
                }
            }
        }
    </script>
    @endif
@endif

@if(request()->has('preview'))
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endif
