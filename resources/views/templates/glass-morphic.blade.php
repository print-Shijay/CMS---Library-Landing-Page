<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #06b6d4;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.8);
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #06b6d4 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #164e63 100%);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
            z-index: -1;
        }

        /* Glass Effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: 20px;
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navigation */
        .navbar {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.25rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.75rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0.1;
            transition: left 0.3s ease;
        }

        .nav-link:hover {
            color: var(--text-primary) !important;
        }

        .nav-link:hover::before {
            left: 0;
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: white !important;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
        }

        /* Hero Section */
        .hero-section {
            padding: 180px 0 120px;
            position: relative;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 20px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 2rem;
            background: linear-gradient(to right, #ffffff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Cards */
        .glass-card {
            background: var(--gradient-glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .glass-card:hover::before {
            opacity: 0.1;
        }

        .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            color: white;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        }

        /* Image Container */
        .hero-image-container {
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .hero-image-container:hover img {
            transform: scale(1.05);
        }

        /* Links Grid */
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .link-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }

        .link-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0.1;
            transition: left 0.3s ease;
        }

        .link-item:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
        }

        .link-item:hover::before {
            left: 0;
        }

        .link-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
            z-index: 1;
        }

        /* Button Styles */
        .btn-gradient {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.125rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(99, 102, 241, 0.4);
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-section {
                padding: 150px 0 80px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
                letter-spacing: -1px;
            }
            
            .glass-card {
                padding: 2rem;
            }
            
            .links-grid {
                grid-template-columns: 1fr;
            }
        }

        .page-content {
            padding-top: 100px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" onclick="loadPage('landing'); return false;">
                <i class="bi bi-gem me-2"></i>LIBRARY
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRes"
                aria-controls="navRes" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navRes">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @php
                        $navPages = \App\Models\Page::orderBy('order_index')->get();
                    @endphp

                    @foreach($navPages as $navPage)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->first) active @endif" href="#"
                                onclick="loadPage('{{ $navPage->slug }}'); return false;">
                                {{ $navPage->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main id="page-content-area" class="page-content">
        @include('templates.partials.glass-morphic_content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function loadPage(slug) {
            const contentArea = document.getElementById('page-content-area');
            const nav = document.getElementById('navRes');

            fetch(`/api/page/${slug}`)
                .then(res => res.text())
                .then(html => {
                    contentArea.innerHTML = html;
                    window.scrollTo({ top: 0, behavior: 'smooth' });

                    // Add floating animation to cards
                    setTimeout(() => {
                        const cards = contentArea.querySelectorAll('.glass-card');
                        cards.forEach(card => {
                            card.style.animationDelay = `${Math.random() * 2}s`;
                        });
                    }, 100);

                    const bsCollapse = bootstrap.Collapse.getInstance(nav);
                    if (bsCollapse) bsCollapse.hide();
                })
                .catch(err => console.error("Error loading page:", err));
        }

        // Load first page on initial load
        document.addEventListener('DOMContentLoaded', function() {
            const firstLink = document.querySelector('.nav-link.active');
            if (firstLink) {
                const slug = firstLink.getAttribute('onclick').match(/'([^']+)'/)[1];
                loadPage(slug);
            }
        });
    </script>
</body>
</html>