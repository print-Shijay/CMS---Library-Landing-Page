<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | {{ config('app.name', 'Digital Library') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/library-coming-soon.css') }}" rel="stylesheet">

    <style>
        /* Simple preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .book-loader {
            width: 60px;
            height: 80px;
            position: relative;
            animation: bookFlip 1.2s infinite ease-in-out;
        }

        @keyframes bookFlip {
            0%, 100% { transform: perspective(120px) rotateY(0deg); }
            50% { transform: perspective(120px) rotateY(-180deg); }
        }

        /* Base Styles for Library Theme */
:root {
    --library-primary: #2c3e50;
    --library-secondary: #3498db;
    --library-accent: #e74c3c;
    --library-light: #f8f9fa;
    --library-muted: #95a5a6;
    --library-border: #e0e0e0;
    --library-shadow: rgba(44, 62, 80, 0.1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Source Sans Pro', sans-serif;
    background-color: var(--library-light);
    color: var(--library-primary);
    line-height: 1.6;
    overflow-x: hidden;
}

/* Preloader Animation */
.book-loader {
    position: relative;
}

.book-loader .book-cover {
    position: absolute;
    width: 100%;
    height: 100%;
    background: var(--library-secondary);
    border-radius: 3px 8px 8px 3px;
    transform-origin: left;
}

.book-loader .book-pages {
    position: absolute;
    width: 95%;
    height: 95%;
    background: white;
    top: 2.5%;
    left: 2.5%;
    border-radius: 3px 7px 7px 3px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
}

/* Main Container */
.library-coming-soon {
    padding: 2rem 1rem;
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    z-index: 1;
}

/* Header Styles */
.library-logo h1 {
    font-family: 'Crimson Pro', serif;
    color: var(--library-primary);
    letter-spacing: 0.5px;
}

.divider {
    width: 100px;
    height: 4px;
    background: linear-gradient(to right, var(--library-secondary), var(--library-accent));
    margin: 1rem auto;
    border-radius: 2px;
}

/* Progress Bar */
.library-progress {
    max-width: 600px;
    margin: 0 auto;
    padding: 1.5rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px var(--library-shadow);
    border: 1px solid var(--library-border);
}

.progress {
    background-color: #ecf0f1;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    background: linear-gradient(90deg, var(--library-secondary), #2980b9);
    transition: width 1s ease-in-out;
    position: relative;
}

.progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.4),
        transparent
    );
    animation: progressShine 2s infinite;
}

@keyframes progressShine {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Countdown Timer */
.countdown-simple {
    max-width: 500px;
    margin: 0 auto;
}

.time-box {
    padding: 1rem 1.5rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 3px 10px var(--library-shadow);
    min-width: 90px;
    border: 1px solid var(--library-border);
    transition: all 0.3s ease;
}

.time-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px var(--library-shadow);
    border-color: var(--library-secondary);
}

.time-number {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--library-primary);
    transition: all 0.3s ease;
}

.time-label {
    font-size: 0.9rem;
    color: var(--library-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 0.5rem;
}

/* Features Cards */
.feature-card {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--library-border);
    transition: all 0.3s ease;
    height: 100%;
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.feature-card i {
    transition: transform 0.3s ease;
}

.feature-card:hover i {
    transform: scale(1.2);
}

.feature-card h6 {
    color: var(--library-primary);
    margin-bottom: 0.5rem;
    font-weight: 600;
}

/* Newsletter Form */
.newsletter-section .card {
    border-radius: 10px;
    background: white;
    transition: transform 0.3s ease;
}

.newsletter-section .card:hover {
    transform: translateY(-5px);
}

.form-control {
    border: 1px solid var(--library-border);
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--library-secondary);
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

.btn-primary {
    background: var(--library-secondary);
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}

/* Floating Books */
.floating-books {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
}

.floating-book {
    position: absolute;
    color: rgba(52, 152, 219, 0.1);
    font-size: 2rem;
    animation: floatBook 15s infinite ease-in-out;
}

.book-1 {
    top: 10%;
    left: 5%;
    animation-delay: 0s;
}

.book-2 {
    top: 70%;
    right: 10%;
    animation-delay: 5s;
}

.book-3 {
    bottom: 20%;
    left: 15%;
    animation-delay: 10s;
}

@keyframes floatBook {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    33% {
        transform: translateY(-20px) rotate(10deg);
    }
    66% {
        transform: translateY(10px) rotate(-10deg);
    }
}

/* Footer */
footer {
    color: var(--library-muted);
    font-size: 0.95rem;
}

footer i {
    color: var(--library-secondary);
    width: 20px;
}

/* Form Checkbox Custom */
.form-check-input:checked {
    background-color: var(--library-secondary);
    border-color: var(--library-secondary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .library-logo h1 {
        font-size: 2.5rem;
    }

    .time-box {
        padding: 0.75rem 1rem;
        min-width: 70px;
    }

    .time-number {
        font-size: 1.8rem;
    }

    .feature-card {
        min-height: 160px;
        padding: 1.5rem 1rem !important;
    }

    .floating-book {
        display: none;
    }
}

@media (max-width: 576px) {
    .library-coming-soon {
        padding: 1rem;
    }

    .time-box {
        margin-bottom: 1rem;
    }

    .newsletter-section .card-body {
        padding: 1.5rem !important;
    }
}

    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="book-loader">
            <div class="book-cover"></div>
            <div class="book-pages"></div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid library-coming-soon">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">

                <!-- Header -->
                <header class="text-center mb-5">
                    <div class="library-logo mb-4">
                        <i class="fas fa-book-open fa-3x text-primary mb-3"></i>
                        <h1 class="display-4 fw-bold text-dark mb-2">{{ config('app.name', 'Digital Library') }}</h1>
                        <div class="divider mx-auto"></div>
                    </div>

                    <h2 class="display-6 mb-4 text-muted">Our Digital Library is Coming Soon</h2>
                    <p class="lead">We're building an extensive collection of digital resources, e-books, and research materials for our community.</p>
                </header>

                <!-- Progress Section -->
                <div class="library-progress mb-5">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Catalog Progress</span>
                        <span class="fw-semibold text-primary">65%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted">Currently cataloging: 12,543 books of 19,300 total</small>
                </div>

                <!-- Countdown -->
                <div class="countdown-simple mb-5">
                    <h5 class="text-center mb-4">Launching in:</h5>
                    <div class="row justify-content-center">
                        <div class="col-auto text-center">
                            <div class="time-box">
                                <div class="time-number" id="simpleDays">00</div>
                                <div class="time-label">Days</div>
                            </div>
                        </div>
                        <div class="col-auto text-center">
                            <div class="time-box">
                                <div class="time-number" id="simpleHours">00</div>
                                <div class="time-label">Hours</div>
                            </div>
                        </div>
                        <div class="col-auto text-center">
                            <div class="time-box">
                                <div class="time-number" id="simpleMinutes">00</div>
                                <div class="time-label">Minutes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Preview -->
                <div class="features-preview mb-5">
                    <h5 class="text-center mb-4">What to Expect:</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-book fa-2x text-primary mb-3"></i>
                                <h6>Digital Collection</h6>
                                <p class="small text-muted">10,000+ e-books & journals</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-search fa-2x text-primary mb-3"></i>
                                <h6>Advanced Search</h6>
                                <p class="small text-muted">Smart catalog & filters</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-users fa-2x text-primary mb-3"></i>
                                <h6>Community Features</h6>
                                <p class="small text-muted">Reading groups & reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="newsletter-section">
                    <div class="card border-light shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Get Early Access</h5>
                            <p class="card-text mb-4">Be the first to know when we launch and get early access to premium features.</p>

                            <form id="librarySubscribe" class="row g-3">
                                <div class="col-md-8">
                                    <input type="email" class="form-control" placeholder="Your email address" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-envelope me-2"></i>Notify Me
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletterCheck" checked>
                                        <label class="form-check-label small text-muted" for="newsletterCheck">
                                            Also subscribe to our monthly newsletter
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <footer class="text-center mt-5 pt-4 border-top">
                    <p class="text-muted mb-2">
                        <i class="fas fa-envelope me-2"></i>contact@library.example.com
                    </p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-phone me-2"></i>(123) 456-7890
                    </p>
                    <p class="small text-muted mt-3">&copy; {{ date('Y') }} {{ config('app.name', 'Digital Library') }}. All rights reserved.</p>
                </footer>

            </div>
        </div>
    </div>

    <!-- Floating Book Elements -->
    <div class="floating-books">
        <div class="floating-book book-1"><i class="fas fa-book"></i></div>
        <div class="floating-book book-2"><i class="fas fa-bookmark"></i></div>
        <div class="floating-book book-3"><i class="fas fa-book-open"></i></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Preloader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('preloader').style.display = 'none';
                }, 500);
            }, 800);
        });

        // Simple Countdown (14 days from now)
        const launchDate = new Date();
        launchDate.setDate(launchDate.getDate() + 14);

        function updateSimpleCountdown() {
            const now = new Date();
            const timeRemaining = launchDate - now;

            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));

            document.getElementById('simpleDays').textContent = days.toString().padStart(2, '0');
            document.getElementById('simpleHours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('simpleMinutes').textContent = minutes.toString().padStart(2, '0');

            // Animate number change
            animateNumberChange('simpleDays', days);
            animateNumberChange('simpleHours', hours);
            animateNumberChange('simpleMinutes', minutes);
        }

        function animateNumberChange(elementId, newValue) {
            const element = document.getElementById(elementId);
            if (element.textContent !== newValue.toString().padStart(2, '0')) {
                element.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        }

        // Update countdown every minute
        setInterval(updateSimpleCountdown, 60000);
        updateSimpleCountdown(); // Initial call

        // Animated progress bar
        const progressBar = document.querySelector('.progress-bar');
        let progress = 65;

        const progressInterval = setInterval(() => {
            if (progress < 100) {
                progress += 0.05;
                progressBar.style.width = progress + '%';
                progressBar.setAttribute('aria-valuenow', Math.floor(progress));

                // Update text
                const progressText = document.querySelector('.fw-semibold.text-primary');
                if (progressText) {
                    progressText.textContent = Math.floor(progress) + '%';
                }
            }
        }, 3000);

        // Form submission
        document.getElementById('librarySubscribe').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success
                submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Subscribed!';
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-success');

                // Reset form
                this.reset();

                // Reset button after 3 seconds
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-primary');
                    submitBtn.disabled = false;
                }, 3000);
            }, 1500);
        });

        // Feature cards hover effect
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // Animate floating books
        const floatingBooks = document.querySelectorAll('.floating-book');
        floatingBooks.forEach((book, index) => {
            book.style.animationDelay = `${index * 1.5}s`;
        });
    </script>
</body>
</html>
