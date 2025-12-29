<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Split Layout' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #818cf8;
            --accent: #c084fc;
            --primary-gradient: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass: rgba(15, 23, 42, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-dark);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .navbar {
            backdrop-filter: blur(12px);
            background: var(--glass);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .nav-link {
            color: var(--text-main) !important;
        }

        .hero-section {
            padding: 140px 0 60px;
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.15), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.05), transparent);
            text-align: center;
        }

        .section-tag {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(129, 140, 248, 0.15);
            color: var(--primary);
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .display-3 {
            font-weight: 800;
            letter-spacing: -0.04em;
            background: linear-gradient(to bottom right, #ffffff 30%, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-modern {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            font-weight: 600;
        }

        .card-feature {
            border: 1px solid var(--border-color);
            border-radius: 28px;
            padding: 40px;
            background: var(--bg-card);
            transition: all 0.4s ease;
            height: 100%;
        }

        .card-feature:hover {
            border-color: var(--primary);
            transform: translateY(-8px);
            background: #243049;
        }

        .hero-img-container {
            max-width: 900px;
            margin: 0 auto;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
            background: var(--bg-card);
        }

        .link-preview-card {
            display: flex;
            gap: 16px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            color: var(--text-main);
        }

        .link-preview-card:hover {
            background: #2d3a4f;
            color: var(--primary);
            border-color: var(--primary);
        }

        .link-thumbnail {
            background: rgba(255, 255, 255, 0.05);
            color: var(--primary);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Staff Section - Theme Matched */
        .staff-section {
            padding: 80px 0;
            background-color: var(--bg-body);
            /* Matches your body background */
        }

        .staff-card {
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            background: var(--bg-card);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: var(--shadow);
            height: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .staff-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(25, 51, 143, 0.15);
            border-color: var(--br-200);
        }

        .staff-image-container {
            padding: 15px 15px 0 15px;
        }

        .staff-image {
            height: 280px;
            width: 100%;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.7s ease;
        }

        .staff-card:hover .staff-image {
            transform: scale(1.05);
        }

        .staff-info {
            padding: 1.75rem 1.5rem;
            text-align: center;
            flex-grow: 1;
        }

        .staff-role {
            color: var(--br-600);
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 1px;
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: var(--br-50);
            border: 1px solid var(--br-100);
            border-radius: 50px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .staff-name {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            /* Using your br-950 variable */
        }

        .staff-social-links {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
            min-height: 40px;
        }

        .social-icon-link {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--br-50);
            color: var(--br-600);
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 1px solid transparent;
        }

        /* Brand Colors on Hover */
        .social-icon-link:hover {
            transform: translateY(-3px);
            color: white !important;
            border-color: transparent;
        }

        .link-facebook:hover {
            background-color: #1877f2;
        }

        .link-twitter:hover {
            background-color: #000000;
        }

        .link-instagram:hover {
            background-color: #e4405f;
        }

        .link-linkedin:hover {
            background-color: #0a66c2;
        }

        /* View All Button - Theme Matched */
        .view-all-container {
            margin-top: 4rem;
        }

        .btn-view-all {
            padding: 12px 35px;
            border-radius: 50px;
            border: 2px solid var(--br-500);
            color: var(--br-600);
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            background: transparent;
        }

        .btn-view-all:hover {
            background: var(--br-600);
            border-color: var(--br-600);
            color: white !important;
        }

        /* Announcement Section Styles */
        #announcement {
            padding: 60px 0;
            background-color: var(--br-50);
            overflow: hidden;
        }

        .announcement-wrapper {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding-bottom: 20px;
            /* Custom Scrollbar for Chrome/Safari */
            scrollbar-width: thin;
            scrollbar-color: var(--br-200) transparent;
        }

        .announcement-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .announcement-wrapper::-webkit-scrollbar-thumb {
            background: var(--br-200);
            border-radius: 10px;
        }

        .announcement-card {
            flex: 0 0 400px;
            /* Fixed width for the film frame */
            height: 30vh;
            /* Your requested height */
            min-height: 250px;
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background-color: var(--br-950);
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .announcement-card:hover {
            transform: scale(1.02);
        }

        .ann-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
            /* Darkens image for text readability */
            transition: opacity 0.3s ease;
        }

        .announcement-card:hover .ann-img {
            opacity: 0.5;
        }

        .ann-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(transparent, rgba(20, 33, 87, 0.9));
            /* br-950 gradient */
            color: white;
        }

        .ann-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ann-content {
            font-size: 0.85rem;
            opacity: 0.9;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .ann-date {
            font-size: 0.75rem;
            color: var(--br-400);
            font-weight: 600;
            text-transform: uppercase;
        }
        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 text-white" href="#">
                <i class="bi bi-hexagon-fill text-primary me-2"></i>LIBRARY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRes">
                <span class="navbar-toggler-icon navbar-dark"></span>
            </button>
            <div class="collapse navbar-collapse" id="navRes">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @php $navPages = \App\Models\Page::orderBy('order_index')->get(); @endphp
                    @foreach($navPages as $navPage)
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#">{{ $navPage->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-area">
        @include('templates.partials.split-layout_content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>