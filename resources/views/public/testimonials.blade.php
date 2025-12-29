<div id="testimonials-list"></div>

<div id="auth-section">
    <a href="https://keeper.ccs-octa.com/api/auth/google" class="btn-google">
        Sign in with Google to Post
    </a>
</div>

<form id="testimonial-form" style="display:none;">
    <textarea id="content" placeholder="Write a review..." required></textarea>
    <select id="rating">
        <option value="5">5 Stars</option>
        <option value="4">4 Stars</option>
    </select>
    <button type="submit">Submit</button>
    <button type="button" onclick="logout()">Logout</button>
</form>

<script>
    const API_URL = 'http://localhost:8000/api';
    let token = localStorage.getItem('api_token');

    // 1. Check for Token in URL (Handle Redirect Return)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('token')) {
        token = urlParams.get('token');
        localStorage.setItem('api_token', token);
        // Clean URL
        window.history.replaceState({}, document.title, "/");
    }

    // 2. Initialize
    document.addEventListener('DOMContentLoaded', () => {
        loadTestimonials();
        checkAuth();
    });

    // 3. UI Logic
    function checkAuth() {
        if (token) {
            document.getElementById('auth-section').style.display = 'none';
            document.getElementById('testimonial-form').style.display = 'block';
        }
    }

    function logout() {
        localStorage.removeItem('api_token');
        location.reload();
    }

    // 4. Fetch Testimonials
    async function loadTestimonials() {
        const res = await fetch(`${API_URL}/testimonials`);
        const data = await res.json();
        
        const container = document.getElementById('testimonials-list');
        container.innerHTML = data.map(t => `
            <div class="review-card">
                <img src="${t.user.avatar}" width="30">
                <strong>${t.user.name}</strong> (${t.rating} ★)
                <p>${t.content}</p>
            </div>
        `).join('');
    }

    // 5. Post Testimonial
    document.getElementById('testimonial-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const content = document.getElementById('content').value;
        const rating = document.getElementById('rating').value;

        const res = await fetch(`${API_URL}/testimonials`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({ content, rating })
        });

        if (res.ok) {
            alert('Review posted!');
            loadTestimonials(); // Refresh list
            e.target.reset();
        } else {
            alert('Error posting review');
        }
    });
</script>