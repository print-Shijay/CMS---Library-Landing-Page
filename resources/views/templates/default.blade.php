<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Redesign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --br-50: #eef5ff;
            --br-100: #d9e8ff;
            --br-200: #bcd8ff;
            --br-400: #599dff;
            --br-500: #2a71fe;
            --br-600: #1c56f4;
            --br-950: #142157;
            --bg-body: #f8faff;
            --bg-card: #ffffff;
            --text-main: var(--br-950);
            --text-muted: #64748b;
            --border-soft: var(--br-100);
            --shadow: 0 10px 30px -5px rgba(25, 51, 143, 0.08);
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            padding-top: 76px;
            /* Account for fixed navbar */
        }

        /* Navbar styling */
        nav.navbar {
            background-color: var(--bg-card);
            box-shadow: var(--shadow);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: var(--br-950) !important;
            font-size: 1.75rem;
        }

        .navbar-nav .nav-link {
            color: var(--text-muted);
            margin: 0 0.5rem;
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--br-600);
        }

        /* Hero section */
        .hero-section {
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 4rem;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-overlay {
            background: linear-gradient(to right, rgba(248, 250, 255, 0.95) 0%, rgba(248, 250, 255, 0.8) 100%);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .hero-content {
            max-width: 650px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--br-950);
        }

        .hero-description {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-btn {
            background-color: var(--br-500);
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .hero-btn:hover {
            background-color: var(--br-600);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(42, 113, 254, 0.3);
        }

        /* Content sections */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--br-950);
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        .card-custom {
            background-color: var(--bg-card);
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            box-shadow: var(--shadow);
            padding: 2rem;
            height: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px -10px rgba(25, 51, 143, 0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background-color: var(--br-50);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .card-icon i {
            font-size: 1.75rem;
            color: var(--br-500);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--br-950);
        }

        .card-text {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Related links */
        .link-preview-card {
            display: flex;
            background-color: var(--bg-card);
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
            height: 100%;
        }

        .link-preview-card:hover {
            border-color: var(--br-400);
            box-shadow: var(--shadow);
            transform: translateY(-3px);
        }

        .link-thumbnail {
            width: 60px;
            height: 60px;
            background-color: var(--br-50);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.25rem;
            flex-shrink: 0;
        }

        .link-thumbnail i {
            font-size: 1.5rem;
            color: var(--br-500);
        }

        .link-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--br-950);
            display: block;
            margin-bottom: 0.5rem;
        }

        .link-url {
            font-size: 0.875rem;
            color: var(--br-500);
            font-weight: 500;
        }

        /* Footer */
        .footer {
            background-color: var(--br-950);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 6rem;
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: var(--br-100);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
            color: var(--br-200);
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.75rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.25rem;
            }

            .hero-description {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="bi bi-hexagon-fill text-primary me-2"></i>KEEPER LIBRARY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRes">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navRes">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">
                    @php
                        $navPages = \App\Models\Page::orderBy('order_index')->get();
                    @endphp

                    @foreach($navPages as $navPage)
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="loadPage('{{ $navPage->slug }}'); return false;">
                                {{ $navPage->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>




    <div id="page-content-area">
        @include('templates.partials.default_content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function loadPage(slug) {
            const contentArea = document.getElementById('page-content-area');
            const nav = document.getElementById('navRes');

            fetch(`/api/page/${slug}`)
                .then(res => res.text())
                .then(html => {
                    contentArea.innerHTML = html;
                    window.scrollTo({ top: 0, behavior: 'smooth' });

                    const bsCollapse = bootstrap.Collapse.getInstance(nav);
                    if (bsCollapse) bsCollapse.hide();
                })
                .catch(err => console.error("Error loading page:", err));
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add active class to navbar links on scroll
        window.addEventListener('scroll', function () {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>