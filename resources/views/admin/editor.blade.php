<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer | {{ $page->title }}</title>

    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>

    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        /* Custom Toolbar */
        .editor-header {
            height: 45px;
            background: #1e293b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
            border-bottom: 1px solid #334155;
        }

        .btn-save {
            background: #6366f1;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        #gjs {
            border: none;
        }

        /* Fixes for the UI Panels */
        .gjs-cv-canvas {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <div class="editor-header">
        <div>
            <a href="{{ route('admin.dashboard') }}" style="color: #94a3b8; text-decoration: none; font-size: 13px;">←
                Exit</a>
            <span style="margin-left: 10px; font-size: 14px;">{{ $page->title }}</span>
        </div>
        <button id="save-btn" class="btn-save">Save Design</button>
    </div>

    <div id="gjs">
        {!! $page->html_content !!}
        <style>
            {!! $page->css_content !!}
        </style>
    </div>

    <script>
        const editor = grapesjs.init({
            container: '#gjs',
            height: 'calc(100vh - 45px)',
            fromElement: true,
            storageManager: false,

            // Load the webpage preset
            plugins: ['gjs-preset-webpage'],

            // MANUALLY DEFINE BLOCKS (This fixes the empty sidebar)
            blockManager: {
                blocks: [

                    /* =========================
                       HERO SECTIONS
                    ========================== */

                    {
                        id: 'hero-left-image',
                        label: 'Hero – Image Right',
                        category: 'Sections',
                        content: `
      <section class="py-5 bg-light">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h1 class="fw-bold">Your Main Heading</h1>
              <p class="lead">A short description that explains your product or service.</p>
              <a href="#" class="btn btn-primary">Get Started</a>
            </div>
            <div class="col-md-6 text-center">
              <img src="https://via.placeholder.com/500x350" class="img-fluid rounded">
            </div>
          </div>
        </div>
      </section>`
                    },

                          {
                        id: 'hero-gradient',
                        label: 'Hero – Gradient Split',
                        category: 'Hero Sections',
                        content: `
      <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 650px; display: flex; align-items: center;">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 text-white">
              <span class="badge bg-white text-primary mb-3">New Launch 2025</span>
              <h1 class="fw-bold display-3 mb-4">Transform Your Digital Presence</h1>
              <p class="lead mb-4">Build stunning websites with our modern page builder. No coding required.</p>
              <div class="d-flex gap-3 flex-wrap">
                <a href="#" class="btn btn-light btn-lg px-4">Get Started Free</a>
                <a href="#" class="btn btn-outline-light btn-lg px-4">Watch Demo</a>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 text-center">
              <div class="p-4 bg-white rounded-4 shadow-lg">
                <img src="https://via.placeholder.com/550x400" class="img-fluid rounded">
              </div>
            </div>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'hero-video-overlay',
                        label: 'Hero – Dark Overlay',
                        category: 'Hero Sections',
                        content: `
      <section class="position-relative text-white" style="min-height: 700px; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x1080') center/cover; display: flex; align-items: center;">
        <div class="container text-center">
          <h1 class="fw-bold display-2 mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Create. Build. Launch.</h1>
          <p class="lead mb-5 fs-3 mx-auto" style="max-width: 700px;">The most powerful page builder for modern websites and landing pages.</p>
          <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#" class="btn btn-primary btn-lg px-5 py-3">Start Building Now</a>
            <a href="#" class="btn btn-outline-light btn-lg px-5 py-3">View Examples</a>
          </div>
          <div class="mt-5">
            <small class="text-white-50">No credit card required • Free forever plan</small>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'hero-app-showcase',
                        label: 'Hero – App Showcase',
                        category: 'Hero Sections',
                        content: `
      <section class="py-5 bg-light" style="min-height: 600px;">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
              <div class="badge bg-primary text-white mb-3 px-3 py-2">🚀 LAUNCHING SOON</div>
              <h1 class="fw-bold display-4 mb-4">Your Business, Simplified</h1>
              <p class="lead text-muted mb-4">Manage everything from one powerful dashboard. Built for teams who move fast.</p>
              <ul class="list-unstyled mb-4">
                <li class="mb-2"><strong>✓</strong> Real-time collaboration</li>
                <li class="mb-2"><strong>✓</strong> Cloud-based storage</li>
                <li class="mb-2"><strong>✓</strong> 24/7 customer support</li>
              </ul>
              <div class="d-flex gap-3 flex-wrap">
                <a href="#" class="btn btn-primary btn-lg">Try Free for 14 Days</a>
                <a href="#" class="btn btn-outline-primary btn-lg">Schedule Demo</a>
              </div>
            </div>
            <div class="col-lg-7 col-md-12">
              <img src="https://via.placeholder.com/700x500" class="img-fluid rounded-4 shadow-lg">
            </div>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'hero-minimal-centered',
                        label: 'Hero – Minimal Center',
                        category: 'Hero Sections',
                        content: `
      <section class="py-5 bg-white" style="min-height: 600px; display: flex; align-items: center;">
        <div class="container">
          <div class="text-center mx-auto" style="max-width: 800px;">
            <h1 class="fw-bold display-1 mb-4" style="letter-spacing: -2px;">Design Better.</h1>
            <p class="lead fs-4 text-muted mb-5">Create stunning websites without limits. Professional tools for creative minds.</p>
            <a href="#" class="btn btn-dark btn-lg px-5 py-3 rounded-pill">Get Started for Free →</a>
            <div class="mt-5 d-flex justify-content-center gap-5 flex-wrap text-muted">
              <div><small>✓ No credit card</small></div>
              <div><small>✓ Cancel anytime</small></div>
              <div><small>✓ 500+ templates</small></div>
            </div>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'hero-split-color',
                        label: 'Hero – Split Background',
                        category: 'Hero Sections',
                        content: `
      <section class="position-relative overflow-hidden" style="min-height: 650px;">
        <div style="position: absolute; top: 0; left: 0; width: 50%; height: 100%; background: #6366f1;"></div>
        <div style="position: absolute; top: 0; right: 0; width: 50%; height: 100%; background: #f8fafc;"></div>
        <div class="container position-relative" style="padding-top: 120px;">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 text-white">
              <h1 class="fw-bold display-4 mb-4">Modern Solutions for Modern Problems</h1>
              <p class="fs-5 mb-4 opacity-90">Join 50,000+ businesses already using our platform to grow their online presence.</p>
              <a href="#" class="btn btn-light btn-lg px-5">Start Your Journey</a>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="bg-white p-4 rounded-4 shadow-lg">
                <img src="https://via.placeholder.com/500x350" class="img-fluid rounded">
              </div>
            </div>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'hero-centered',
                        label: 'Hero – Centered',
                        category: 'Sections',
                        content: `
      <section class="py-5 text-center bg-dark text-white">
        <div class="container">
          <h1 class="fw-bold">Welcome to Our Website</h1>
          <p class="lead mt-3">We create meaningful digital experiences.</p>
          <div class="mt-4">
            <a href="#" class="btn btn-primary me-2">Get Started</a>
            <a href="#" class="btn btn-outline-light">Learn More</a>
          </div>
        </div>
      </section>`
                    },

                    {
                        id: 'image-gallery-3',
                        label: '3 Image Gallery',
                        category: 'Sections',
                        content: `
      <section class="py-5">
        <div class="container">
          <div class="row g-3">
            <div class="col-md-4">
              <img src="https://via.placeholder.com/400x300" class="img-fluid rounded">
            </div>
            <div class="col-md-4">
              <img src="https://via.placeholder.com/400x300" class="img-fluid rounded">
            </div>
            <div class="col-md-4">
              <img src="https://via.placeholder.com/400x300" class="img-fluid rounded">
            </div>
          </div>
        </div>
      </section>`
                    },
{
  id: 'features-3',
  label: '3 Features',
  category: 'Sections',
  content: `
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center mb-4">
      <h2 class="fw-bold">Our Features</h2>
      <p class="text-muted">What makes us different</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="fw-bold">Fast</h5>
            <p>Optimized for speed and performance.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="fw-bold">Responsive</h5>
            <p>Looks great on all screen sizes.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="fw-bold">Customizable</h5>
            <p>Edit everything using the builder.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>`
},
{
  id: 'cta-section',
  label: 'Call To Action',
  category: 'Sections',
  content: `
<section class="py-5 bg-primary text-white text-center">
  <div class="container">
    <h2 class="fw-bold">Ready to start your project?</h2>
    <p class="mt-2">Let’s build something amazing together.</p>
    <a href="#" class="btn btn-light mt-3">Contact Us</a>
  </div>
</section>`
},

{
  id: 'testimonials',
  label: 'Testimonials',
  category: 'Sections',
  content: `
<section class="py-5">
  <div class="container">
    <div class="row text-center mb-4">
      <h2 class="fw-bold">What Clients Say</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="border rounded p-4 h-100">
          <p>"Amazing service and support."</p>
          <strong>- John D.</strong>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-4 h-100">
          <p>"Professional and reliable."</p>
          <strong>- Maria S.</strong>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-4 h-100">
          <p>"Highly recommended."</p>
          <strong>- Alex R.</strong>
        </div>
      </div>
    </div>
  </div>
</section>`
},

{
  id: 'pricing',
  label: 'Pricing Plans',
  category: 'Sections',
  content: `
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center mb-4">
      <h2 class="fw-bold">Pricing Plans</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card text-center h-100">
          <div class="card-header fw-bold">Basic</div>
          <div class="card-body">
            <h3>$19</h3>
            <p>Simple landing page</p>
            <a href="#" class="btn btn-outline-primary">Choose</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center h-100 shadow">
          <div class="card-header fw-bold">Pro</div>
          <div class="card-body">
            <h3>$49</h3>
            <p>Business website</p>
            <a href="#" class="btn btn-primary">Choose</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center h-100">
          <div class="card-header fw-bold">Enterprise</div>
          <div class="card-body">
            <h3>$99</h3>
            <p>Custom solutions</p>
            <a href="#" class="btn btn-outline-primary">Choose</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>`
},

            /* =========================
               Layouts
            ========================== */

{
  id: 'layout-modern-2cards',
  label: 'Layout – Modern 2 Cards',
  category: 'Layout',
  content: `
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="p-4 bg-white rounded shadow h-100">Column One</div>
      </div>
      <div class="col-md-6">
        <div class="p-4 bg-white rounded shadow h-100">Column Two</div>
      </div>
    </div>
  </div>
</section>`
},
{
  id: 'layout-modern-3grid',
  label: 'Layout – Modern 3 Grid',
  category: 'Layout',
  content: `
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4"><div class="p-4 bg-light rounded shadow-sm">Grid 1</div></div>
      <div class="col-md-4"><div class="p-4 bg-light rounded shadow-sm">Grid 2</div></div>
      <div class="col-md-4"><div class="p-4 bg-light rounded shadow-sm">Grid 3</div></div>
    </div>
  </div>
</section>`
},
{
  id: 'layout-modern-sidebar-left',
  label: 'Layout – Sidebar Left',
  category: 'Layout',
  content: `
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 bg-white rounded shadow">Sidebar</div>
      </div>
      <div class="col-md-8">
        <div class="p-4 bg-white rounded shadow">Main Content</div>
      </div>
    </div>
  </div>
</section>`
},

{
  id: 'layout-modern-sidebar-right',
  label: 'Layout – Sidebar Right',
  category: 'Layout',
  content: `
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-8">
        <div class="p-4 bg-white rounded shadow">Main Content</div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-white rounded shadow">Sidebar</div>
      </div>
    </div>
  </div>
</section>`
},

{
  id: 'layout-modern-full-split',
  label: 'Layout – Full Width Split',
  category: 'Layout',
  content: `
<section class="py-5 text-white"
style="background:linear-gradient(135deg,#0f172a,#334155);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">Left Content</div>
      <div class="col-md-6">Right Content</div>
    </div>
  </div>
</section>`
},

{
  id: 'layout-minimal-1col',
  label: 'Layout – Minimal 1 Column',
  category: 'Layout',
  content: `
<section class="py-5">
  <div class="container">
    Content goes here
  </div>
</section>`
},

{
  id: 'layout-minimal-2col',
  label: 'Layout – Minimal 2 Columns',
  category: 'Layout',
  content: `
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">Left</div>
      <div class="col-md-6">Right</div>
    </div>
  </div>
</section>`
},

                    /* =========================
                       Hero Titles
                    ========================== */
                    {
                        id: 'image-text',
                        label: 'Image + Text',
                        category: 'Hero Titles',
                        content: `
      <section class="py-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 text-center">
              <img src="https://via.placeholder.com/450x300" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
              <h2>Section Title</h2>
              <p>This section is perfect for describing features or content with an image.</p>
            </div>
          </div>
        </div>
      </section>`
                    },

                    {
  id: 'hero-big-center',
  label: 'Big Bold Center w black bg',
  category: 'Hero Titles',
  content: `
<section class="py-5 text-center bg-dark text-white">
  <div class="container">
    <h1 class="display-3 fw-bold">Build Your Website Faster</h1>
    <p class="lead mt-3">Powerful drag & drop page builder</p>
    <div class="mt-4">
      <a href="#" class="btn btn-primary me-2">Get Started</a>
      <a href="#" class="btn btn-outline-light">Learn More</a>
    </div>
  </div>
</section>`
},

{
  id: 'hero-gradient',
  label: 'Hero – Gradient',
  category: 'Hero Titles',
  content: `
<section class="min-vh-100 d-flex align-items-center text-white"
  style="background:linear-gradient(135deg,#6366f1,#22c55e);">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Modern Page Builder</h1>
    <p class="lead mt-3">Drag. Drop. Customize.</p>
    <a href="#" class="btn btn-light mt-4">Explore Features</a>
  </div>
</section>`
},
{
  id: 'hero-image-overlay',
  label: 'Hero – Image Overlay',
  category: 'Hero Titles',
  content: `
<section class="py-5 text-white"
  style="background:url('https://via.placeholder.com/1600x700') center/cover;">
  <div style="background:rgba(0,0,0,0.6); padding:100px 0;">
    <div class="container text-center">
      <h1 class="fw-bold">Create Beautiful Experiences</h1>
      <p class="lead mt-3">Fully customizable layouts</p>
      <a href="#" class="btn btn-primary mt-3">Get Started</a>
    </div>
  </div>
</section>`
},

{
  id: 'hero-minimal',
  label: 'Hero – Minimal',
  category: 'Hero Titles',
  content: `
<section class="py-5 bg-light">
  <div class="container text-center">
    <h1 class="fw-bold">Simple. Clean. Powerful.</h1>
    <p class="text-muted mt-2">Perfect for any type of website</p>
    <a href="#" class="btn btn-outline-primary mt-3">Learn More</a>
  </div>
</section>`
},

{
  id: 'hero-left-text',
  label: 'Hero – Left Text',
  category: 'Hero Titles',
  content: `
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1 class="fw-bold">Design. Build. Launch.</h1>
        <p class="lead text-muted">Create stunning pages without writing code.</p>
        <a href="#" class="btn btn-primary mt-3">Start Now</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="https://via.placeholder.com/500x350" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>`
},
                    /* =========================
                       FOOTERS
                    ========================== */

                    {
                        id: 'footer-simple',
                        label: 'Footer – Simple',
                        category: 'Footers',
                        content: `
      <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
          <p class="mb-0">© 2025 Your Company. All rights reserved.</p>
        </div>
      </footer>`
                    },

                    {
  id: 'footer-simple-centered',
  label: 'Footer – Simple Centered',
  category: 'Footers',
  content: `
<footer class="py-4 bg-dark text-white text-center">
  <div class="container">
    <p class="mb-1 fw-bold">Your Website</p>
    <p class="mb-0 small">© 2025 All rights reserved.</p>
  </div>
</footer>`
},

                    {
                        id: 'footer-links',
                        label: 'Footer – With Links',
                        category: 'Footers',
                        content: `
      <footer class="py-5 bg-dark text-white">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h5>Your Company</h5>
              <p>Building modern and scalable web solutions.</p>
            </div>
            <div class="col-md-6">
              <h5>Quick Links</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                <li><a href="#" class="text-white text-decoration-none">About</a></li>
                <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>`
                    },

                    {
  id: 'footer-links-about',
  label: 'Footer – About & Links',
  category: 'Footers',
  content: `
<footer class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-3">
        <h5 class="fw-bold">About Us</h5>
        <p class="text-muted">Build modern websites using drag & drop sections.</p>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="fw-bold">Pages</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Home</a></li>
          <li><a href="#" class="text-decoration-none">About</a></li>
          <li><a href="#" class="text-decoration-none">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h6 class="fw-bold">Support</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Help</a></li>
          <li><a href="#" class="text-decoration-none">Privacy</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>`
},

{
  id: 'footer-dark-modern',
  label: 'Footer – Dark Modern',
  category: 'Footers',
  content: `
<footer class="py-5 bg-dark text-white">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <h5 class="fw-bold">Brand</h5>
        <p class="small">Create beautiful websites easily.</p>
      </div>
      <div class="col-md-4">
        <h6 class="fw-bold">Quick Links</h6>
        <ul class="list-unstyled small">
          <li><a href="#" class="text-white text-decoration-none">Features</a></li>
          <li><a href="#" class="text-white text-decoration-none">Pricing</a></li>
          <li><a href="#" class="text-white text-decoration-none">Blog</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6 class="fw-bold">Contact</h6>
        <p class="small mb-1">email@example.com</p>
        <p class="small mb-0">+63 900 000 0000</p>
      </div>
    </div>
  </div>
</footer>`
},

{
  id: 'footer-newsletter',
  label: 'Footer – Newsletter',
  category: 'Footers',
  content: `
<footer class="py-5 bg-primary text-white">
  <div class="container text-center">
    <h5 class="fw-bold">Subscribe to our Newsletter</h5>
    <p class="small">Get updates and news</p>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <input type="email" class="form-control mb-2" placeholder="Enter your email">
        <button class="btn btn-light w-100">Subscribe</button>
      </div>
    </div>
    <p class="small mt-3 mb-0">© 2025 Your Website</p>
  </div>
</footer>`
},

{
  id: 'footer-minimal-clean',
  label: 'Footer – Minimal Clean',
  category: 'Footers',
  content: `
<footer class="py-3 border-top">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
    <span class="small">© 2025 Your Brand</span>
    <div>
      <a href="#" class="me-3 text-decoration-none small">Privacy</a>
      <a href="#" class="text-decoration-none small">Terms</a>
    </div>
  </div>
</footer>`
},

                ]
            },


            canvas: {
                styles: [
                    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'
                ]
            }
        });

        // Save Logic
        document.getElementById('save-btn').onclick = function () {
            const btn = this;
            btn.innerHTML = 'Saving...';

            const html = editor.getHtml();
            const css = editor.getCss();

            fetch("{{ route('admin.editor.save', $page->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ html, css })
            })
                .then(res => res.json())
                .then(data => {
                    btn.innerHTML = 'Save Design';
                    if (data.success) alert('Saved!');
                })
                .catch(err => {
                    btn.innerHTML = 'Save Design';
                    console.error(err);
                });
        };
    </script>
</body>

</html>
