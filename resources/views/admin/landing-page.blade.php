@extends('layout.app')

@section('title', 'Landing Page Builder')

@section('content')
    <style>
        /* Animation for the reload button */
        .spin-loader {
            animation: rotate 0.8s linear;
            display: inline-block;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth transition for the iframe */
        #previewFrame {
            transition: opacity 0.3s ease;
        }

        .loading-iframe {
            opacity: 0.5;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4" style="height: calc(100vh - 120px); overflow-y: auto;">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 sticky-top">
                        <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Content tEditor</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Template</label>
                            <select id="template" class="form-select">
                                <option value="default" {{ $page->template == 'default' ? 'selected' : '' }}>default</option>
                                <option value="hero-left" {{ $page->template == 'hero-left' ? 'selected' : '' }}>Hero Left
                                </option>
                                <option value="hero-center" {{ $page->template == 'hero-center' ? 'selected' : '' }}>Hero
                                    Center</option>
                                <!-- <option value="split-layout" {{ $page->template == 'split-layout' ? 'selected' : '' }}>Split
                                                                    Layout</option> -->
                                <option value="hero-right" {{ $page->template == 'hero-right' ? 'selected' : '' }}>Hero Right
                                </option>
                                <option value="stacked" {{ $page->template == 'stacked' ? 'selected' : '' }}>Stacked</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Hero Image</label>
                            <input type="file" id="image" class="form-control" accept="image/*">
                            <div id="imagePreviewWrapper" class="mt-2 {{ $page->image ? '' : 'd-none' }}">
                                <img id="imgPreview" src="{{ $page->image ? asset('storage/' . $page->image) : '#' }}"
                                    class="img-thumbnail" style="max-height: 150px;">
                            </div>
                            <div class="form-text">Recommended: 800x600px or similar ratio.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Headline</label>
                            <input type="text" id="title" class="form-control" value="{{ $page->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Hero Description</label>
                            <textarea id="description" class="form-control" rows="3">{{ $page->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Button Text</label>
                            <input type="text" id="button" class="form-control" value="{{ $page->button }}">
                        </div>

                        <h6 class="fw-bold border-bottom pb-2 mb-3">Core Values</h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Mission</label>
                            <textarea id="mission" class="form-control" rows="5">{{ $page->mission }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Vision</label>
                            <textarea id="vision" class="form-control" rows="5">{{ $page->vision }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Strategic Goals</label>
                            <textarea id="goals" class="form-control" rows="6">{{ $page->goals }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Related Links</label>
                            <div id="relatedLinksWrapper"></div>
                            
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addLinkField()">
                                <i class="bi bi-plus"></i> Add Link
                            </button>
                        </div>

                        <button onclick="savePage(this)" class="btn btn-primary w-100 py-2 shadow-sm">
                            <i class="bi bi-cloud-arrow-up me-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden" style="height: calc(100vh - 120px);">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <span class="small fw-bold"><i class="bi bi-eye me-2"></i>PREVIEW MODE</span>
                        <button id="reloadBtn" onclick="manualReload()" class="btn btn-sm btn-outline-light border-0"
                            title="Refresh Preview">
                            <i id="reloadIcon" class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <iframe id="previewFrame" style="width: 100%; height: 100%; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = "{{ url('/') }}";
        const frame = document.getElementById('previewFrame');
        // Standard text fields
        const fields = ['template', 'title', 'description', 'button', 'mission', 'vision', 'goals'];

        /* ================= RELATED LINKS LOGIC ================= */
        const relatedLinksWrapper = document.getElementById('relatedLinksWrapper');

        /**
         * Adds a row with Title and URL inputs.
         * Accepts an object {title, url} or defaults to empty.
         */
        function addLinkField(data = { title: '', url: '' }) {
            const div = document.createElement('div');
            div.className = 'card p-2 mb-2 bg-light border';
            div.innerHTML = `
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                            <input type="text" class="form-control link-url" 
                                placeholder="example.com" 
                                value="${data.url || ''}" 
                                onblur="autoFetchTitle(this)">
                        </div>
                    </div>
                    <div class="col-10">
                        <input type="text" class="form-control form-control-sm link-title" 
                            placeholder="Link Title (Auto-filled)" 
                            value="${data.title || ''}">
                    </div>
                    <div class="col-2 text-end">
                        <button class="btn btn-sm btn-outline-danger w-100" type="button" onclick="removeLinkField(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            relatedLinksWrapper.appendChild(div);

            // Add listeners for realtime preview updates
            div.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', updatePreview);
            });
        }

        function removeLinkField(btn) {
            btn.closest('.card').remove();
            updatePreview();
        }

        // Collects all link data into an array of objects
        function getRelatedLinks() {
            const rows = document.querySelectorAll('#relatedLinksWrapper .card');
            return Array.from(rows).map(row => ({
                url: row.querySelector('.link-url').value.trim(),
                title: row.querySelector('.link-title').value.trim()
            })).filter(link => link.url !== ''); // Only keep if URL exists
        }

        /* ================= AUTO-FETCH TITLE (UPDATED) ================= */
        function autoFetchTitle(urlInput) {
            let url = urlInput.value.trim();
            const row = urlInput.closest('.row');
            const titleInput = row.querySelector('.link-title');

            // 1. Basic Validation: Don't run if empty
            if (!url) return;

            // 2. Auto-fix URL: Prepend https:// if missing
            if (!/^https?:\/\//i.test(url)) {
                url = 'https://' + url;
                urlInput.value = url; // Update the input box for the user
            }

            // 3. Status Update: Let the user know we are working
            const originalPlaceholder = titleInput.placeholder;
            titleInput.placeholder = "Fetching title...";
            titleInput.value = ""; // Clear current value to show loading state
            titleInput.disabled = true;

            console.log("Requesting metadata for:", url); // Debug log

            fetch(`${baseUrl}/api/landing/fetch-metadata`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ url: url })
            })
            .then(res => {
                if (!res.ok) throw new Error(`Server returned ${res.status}`);
                return res.json();
            })
            .then(data => {
                console.log("Data received:", data); // Debug log
                if (data.title) {
                    titleInput.value = data.title;
                    updatePreview(); // Refresh the iframe
                } else {
                    titleInput.placeholder = "Could not find title";
                }
            })
            .catch(err => {
                console.error('Metadata fetch failed:', err);
                titleInput.placeholder = "Error fetching title";
            })
            .finally(() => {
                titleInput.disabled = false;
                // Restore placeholder if still empty
                if (!titleInput.value) titleInput.placeholder = "Link Title"; 
            });
        }

        /* ================= PREVIEW LOGIC ================= */
        function updatePreview() {
            const params = new URLSearchParams();
            
            // Append standard fields
            fields.forEach(f => {
                params.append(f, document.getElementById(f).value);
            });

            // Append Links: We send them as a JSON string to keep the structure intact
            // The backend/preview endpoint must decode this JSON string.
            params.append('related_links', JSON.stringify(getRelatedLinks()));

            params.append('t', new Date().getTime()); // Cache busting

            frame.classList.add('loading-iframe');
            frame.src = `${baseUrl}/api/landing/preview?${params.toString()}`;

            frame.onload = () => {
                frame.classList.remove('loading-iframe');
            };
        }

        /* ================= SAVE LOGIC ================= */
        function savePage(btn) {
            const originalText = btn.innerHTML;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Saving...';
                btn.disabled = true;

                const formData = new FormData();
                fields.forEach(f => {
                    formData.append(f, document.getElementById(f).value);
                });

                // Send links as JSON string
                formData.append('related_links', JSON.stringify(getRelatedLinks()));

                const imageFile = document.getElementById('image').files[0];
                if (imageFile) {
                    formData.append('image', imageFile);
                }

                fetch(`${baseUrl}/api/landing/save`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    alert('Landing page updated!');
                    updatePreview();
                })
                .catch(() => alert('Save failed'))
                .finally(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }

        /* ================= INITIALIZATION ================= */
        // Image preview listener
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('imgPreview').src = event.target.result;
                    document.getElementById('imagePreviewWrapper').classList.remove('d-none');
                    updatePreview();
                };
                reader.readAsDataURL(file);
            }
        });

        // Input listeners
        fields.forEach(f => {
            document.getElementById(f).addEventListener('input', updatePreview);
        });

        // Load existing data
        // Note: Ensure your backend casts 'related_links' to an array/object before sending to view
        const existingLinks = @json($page->related_links ?? []);
        
        if (Array.isArray(existingLinks) && existingLinks.length) {
            existingLinks.forEach(link => {
                // Handle legacy data (string) vs new data (object)
                if (typeof link === 'string') {
                    addLinkField({ title: '', url: link });
                } else {
                    addLinkField(link);
                }
            });
        } else {
            addLinkField(); // Add one empty row by default
        }

        window.onload = updatePreview;
    </script>
@endsection