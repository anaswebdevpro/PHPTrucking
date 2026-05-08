<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   ABOUT PAGE SPECIFIC STYLES
   ========================================= */

/* HERO SECTION */
.page-hero {
    position: relative;
    height: 100vh;
    min-height: 700px;
    background-color: var(--color-bg-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-top: -80px; /* Offset for fixed nav */
    overflow: hidden;
}

.page-hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center;
    z-index: 1;
    filter: brightness(0.3) contrast(1.1);
}

.page-hero-content {
    position: relative;
    z-index: 2;
    padding: 0 24px;
    max-width: 800px;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s forwards 0.2s;
}

.page-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 24px;
    color: var(--color-primary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.page-hero h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    color: var(--text-light);
    margin-bottom: 16px;
    line-height: 1.1;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.page-hero p {
    font-size: clamp(1.1rem, 2vw, 1.3rem);
    color: rgba(255, 255, 255, 0.85);
}

/* ABOUT CONTENT SECTION */
.about-section {
    padding: 100px 0;
    background: white;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.about-image {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.about-image img {
    width: 100%;
    height: auto;
    display: block;
}

.about-content h2 {
    font-size: 2.5rem;
    margin-bottom: 24px;
}

.about-content p {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin-bottom: 20px;
    line-height: 1.8;
}

/* VALUES SECTION */
.values-section {
    padding: 100px 0;
    background: var(--color-bg-light);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.value-card {
    background: white;
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    text-align: center;
}

.value-icon {
    width: 80px;
    height: 80px;
    background: var(--color-bg-light);
    color: var(--color-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 24px;
}

.value-card h3 {
    margin-bottom: 16px;
    font-size: 1.4rem;
}

.value-card p {
    color: var(--text-muted);
}

@media (max-width: 768px) {
    .about-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- HERO SECTION -->
<section class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="ph-fill ph-info"></i>
            Our Story
        </div>
        <h1>About TruckZone</h1>
        <p>Dedicated to keeping the trucking industry moving forward with premium parts and unmatched expertise.</p>
    </div>
</section>

<!-- ABOUT CONTENT -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-content animate-on-scroll">
                <h2>A Legacy of Reliability</h2>
                <p>Founded with a vision to provide the highest quality heavy-duty truck and trailer parts, TruckZone has grown into a leading supplier trusted by fleets across the country. Our deep understanding of the transportation industry allows us to anticipate the needs of our customers and provide solutions that keep them on the road.</p>
                <p>We believe that downtime is the enemy of progress. That's why we maintain an extensive inventory of over 10,000 active SKUs, ensuring that when you need a critical component, we have it ready for immediate pickup or delivery.</p>
                <p>Our team of fitment experts brings decades of combined experience. We don't just sell parts; we provide the technical knowledge necessary to ensure you get the exact match for your specific rig, the first time.</p>
            </div>
            <div class="about-image animate-on-scroll" style="transition-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1000&q=80" alt="Truck mechanics working">
            </div>
        </div>
    </div>
</section>

<!-- CORE VALUES -->
<section class="values-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Our Core Values</h2>
        <div class="values-grid">
            
            <div class="value-card animate-on-scroll">
                <div class="value-icon"><i class="ph-fill ph-shield-check"></i></div>
                <h3>Uncompromising Quality</h3>
                <p>We source our products only from trusted OEMs and reputable aftermarket manufacturers to ensure maximum durability and safety.</p>
            </div>
            
            <div class="value-card animate-on-scroll" style="transition-delay: 0.1s;">
                <div class="value-icon"><i class="ph-fill ph-clock"></i></div>
                <h3>Speed & Efficiency</h3>
                <p>We understand that time is money in the logistics industry. Our streamlined operations ensure fast processing and quick dispatch.</p>
            </div>
            
            <div class="value-card animate-on-scroll" style="transition-delay: 0.2s;">
                <div class="value-icon"><i class="ph-fill ph-handshake"></i></div>
                <h3>Customer First</h3>
                <p>Your success is our success. We build long-term partnerships by consistently delivering reliable parts and honest advice.</p>
            </div>
            
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>