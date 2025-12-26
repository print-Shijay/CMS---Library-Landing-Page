<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bento-dark: #0a0f1e;
            --bento-blue: #1a237e;
            --bento-light-blue: #283593;
            --bento-accent: #3949ab;
            --bento-border: #1c2539;
            --bento-bg: #121827;
            --bento-card: #1a2236;
            --text-white: #ffffff;
            --text-light: #e2e8f0;
            --text-gray: #94a3b8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bento-dark);
            color: var(--text-white);
            margin: 0;
            padding: 0;
        }

        /* Bento Grid System */
        .bento-grid {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(12, 1fr);
            margin-bottom: 2rem;
        }

        .bento-item {
            background: var(--bento-card);
            border: 2px solid var(--bento-border);
            border-radius: 0.75rem;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .bento-item:hover {
            border-color: var(--bento-accent);
            transform: translateY(-2px);
        }

        /* Bento Sizes */
        .bento-large { grid-column: span 8; }
        .bento-medium { grid-column: span 6; }
        .bento-small { grid-column: span 4; }
        .bento-xsmall { grid-column: span 3; }
        .bento-full { grid-column: 1 / -1; }

        /* Navbar */
        .navbar {
            background-color: var(--bento-bg) !important;
            border-bottom: 2px solid var(--bento-border);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-white);
        }

        .navbar-nav .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--text-white) !important;
            background-color: rgba(57, 73, 171, 0.1);
        }

        .navbar-nav .nav-link.active {
            color: var(--text-white) !important;
            background-color: rgba(57, 73, 171, 0.2);
        }

        .page-content {
            padding-top: 80px;
        }

        @media (max-width: 992px) {
            .bento-large { grid-column: span 12; }
            .bento-medium { grid-column: span 12; }
            .bento-small { grid-column: span 6; }
            .bento-xsmall { grid-column: span 6; }
        }

        @media (max-width: 768px) {
            .bento-small,
            .bento-xsmall {
                grid-column: span 12;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" onclick="loadPage('landing'); return false;">
                LIBRARY
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRes"
                aria-controls="navRes" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navRes">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @php
                        $navPages = \App\Models\Page::orderBy('order_index')->get();
                    @endphp

                    @foreach($navPages as $navPage)
                        <li class="nav-item">
                            <a class="nav-link fw-semibold @if($loop->first) active @endif" href="#"
                                onclick="loadPage('{{ $navPage->slug }}'); return false;">
                                {{ $navPage->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="page-content">
        <div id="page-content-area" class="container py-4">
            <!-- Content will be loaded here -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function loadPage(slug) {
            const contentArea = document.getElementById('page-content-area');
            
            try {
                const response = await fetch(`/api/page/${slug}`);
                const html = await response.text();
                contentArea.innerHTML = html;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                // Close mobile menu
                const nav = document.getElementById('navRes');
                const bsCollapse = bootstrap.Collapse.getInstance(nav);
                if (bsCollapse) bsCollapse.hide();
                
            } catch (error) {
                console.error("Error loading page:", error);
                contentArea.innerHTML = `
                    <div class="bento-item bento-full text-center py-5">
                        <div class="display-6 mb-3">Unable to Load Content</div>
                        <p class="text-gray">Please try again later.</p>
                    </div>
                `;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const firstLink = document.querySelector('.nav-link');
            if (firstLink) {
                const slug = firstLink.getAttribute('onclick').match(/'([^']+)'/)[1];
                loadPage(slug);
            }
        });
    </script>
</body>

</html>