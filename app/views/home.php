<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   HOME PAGE SPECIFIC STYLES
   ========================================= */

/* HERO SECTION */
.hero {
    position: relative;
    height: 100vh;
    min-height: 700px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--color-bg-dark);
    overflow: hidden;
    margin-top: -80px; /* Offset for fixed nav */
    padding-top: 80px;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    filter: brightness(0.4) contrast(1.1);
    transform: scale(1.05);
    animation: slowZoom 20s infinite alternate;
}

@keyframes slowZoom {
    0% { transform: scale(1.05); }
    100% { transform: scale(1.15); }
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: var(--text-light);
    max-width: 900px;
    padding: 0 20px;
    animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.hero-badge {
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

.hero h1 {
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    color: var(--text-light);
    margin-bottom: 24px;
    line-height: 1.1;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.hero p {
    font-size: clamp(1.1rem, 2vw, 1.3rem);
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 40px;
    max-width: 700px;
    margin-inline: auto;
}

.hero-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-large {
    padding: 16px 36px;
    font-size: 1.1rem;
}

/* STATS / FEATURES SECTION (OVERLAPPING HERO) */
.features-section {
    position: relative;
    z-index: 10;
    margin-top: -80px;
    padding-bottom: 80px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.feature-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: var(--radius-lg);
    padding: 40px 32px;
    box-shadow: var(--shadow-lg);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 64px;
    height: 64px;
    background: var(--color-primary);
    color: var(--color-secondary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 24px;
}

.feature-card h3 {
    font-size: 1.4rem;
    margin-bottom: 12px;
    color: var(--color-secondary);
}

.feature-card p {
    color: var(--text-muted);
    line-height: 1.6;
}

/* CATEGORIES SECTION */
.categories-section {
    padding: 80px 0 120px;
    background-color: var(--color-bg-light);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.category-card {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    height: 380px;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    group: category;
}

.category-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 50%, rgba(15, 23, 42, 0.1) 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 32px;
    transition: background 0.4s ease;
}

.category-card:hover .category-img {
    transform: scale(1.1);
}

.category-card:hover .category-overlay {
    background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.5) 50%, rgba(15, 23, 42, 0.2) 100%);
}

.category-number {
    font-family: var(--font-heading);
    font-size: 3rem;
    font-weight: 800;
    color: transparent;
    -webkit-text-stroke: 1px rgba(255,255,255,0.4);
    position: absolute;
    top: 24px;
    right: 24px;
    line-height: 1;
    transition: all 0.4s ease;
}

.category-card:hover .category-number {
    color: var(--color-primary);
    -webkit-text-stroke: 0px;
    transform: translateY(-5px);
}

.category-content h3 {
    color: var(--text-light);
    font-size: 1.6rem;
    margin-bottom: 8px;
    transform: translateY(20px);
    transition: transform 0.4s ease;
}

.category-content p {
    color: rgba(255,255,255,0.7);
    font-size: 1rem;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.category-card:hover .category-content h3 {
    transform: translateY(0);
}

.category-card:hover .category-content p {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.1s;
}

/* PREMIUM CTA SECTION */
.cta-premium {
    position: relative;
    padding: 100px 0;
    background: var(--color-secondary);
    overflow: hidden;
}

.cta-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 20px 20px, rgba(255, 193, 7, 0.05) 2px, transparent 0);
    background-size: 40px 40px;
    opacity: 0.5;
}

.cta-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.cta-content h2 {
    color: var(--text-light);
    font-size: 3rem;
    margin-bottom: 24px;
}

.cta-content p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.25rem;
    margin-bottom: 40px;
}

/* BRAND LOGOS MARQUEE */
.brands-section {
    padding: 60px 0;
    background: white;
    border-bottom: 1px solid #eee;
    overflow: hidden;
}

.brands-title {
    text-align: center;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--text-muted);
    margin-bottom: 30px;
    font-weight: 600;
}

.marquee-container {
    width: 100%;
    display: flex;
    overflow: hidden;
}

.marquee-content {
    display: flex;
    align-items: center;
    gap: 80px;
    animation: marquee 30s linear infinite;
    padding-right: 80px;
}

.marquee-content h4 {
    font-size: 1.5rem;
    color: #94a3b8;
    white-space: nowrap;
    transition: color 0.3s;
}

.marquee-content h4:hover {
    color: var(--color-secondary);
}

@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* SUPPORT SECTION */
.support-section {
    padding: 100px 0;
    background: white;
}

.support-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.support-content h2 {
    font-size: 2.5rem;
    margin-bottom: 24px;
}

.support-content p {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.support-features {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 40px;
}

.support-feature {
    display: flex;
    align-items: center;
    gap: 16px;
}

.support-feature i {
    font-size: 2rem;
    color: var(--color-primary);
    background: var(--color-bg-light);
    padding: 12px;
    border-radius: var(--radius-md);
}

.support-feature h4 {
    font-size: 1.2rem;
    color: var(--color-secondary);
    margin: 0;
}

.support-feature p {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-muted);
}

.support-image-container {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.support-image-container img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform var(--transition-slow);
}

.support-image-container:hover img {
    transform: scale(1.05);
}

/* TESTIMONIALS SECTION */
.testimonials-section {
    padding: 100px 0;
    background: var(--color-bg-light);
    overflow: hidden;
}

.testimonials-slider {
    display: flex;
    gap: 30px;
    overflow-x: auto;
    padding: 20px 0 40px;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.testimonials-slider::-webkit-scrollbar {
    display: none;
}

.testimonial-card {
    min-width: 400px;
    background: white;
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    scroll-snap-align: start;
    border: 1px solid rgba(0,0,0,0.05);
    transition: transform var(--transition-normal);
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.testimonial-stars {
    color: var(--color-primary);
    font-size: 1.2rem;
    margin-bottom: 20px;
    display: flex;
    gap: 4px;
}

.testimonial-text {
    font-size: 1.1rem;
    color: var(--text-main);
    font-style: italic;
    margin-bottom: 24px;
    line-height: 1.6;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 16px;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.testimonial-author-info h4 {
    font-size: 1.1rem;
    color: var(--color-secondary);
    margin: 0 0 4px 0;
}

.testimonial-author-info p {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin: 0;
}

/* FAQ SECTION */
.faq-section {
    padding: 100px 0;
    background: white;
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    margin-bottom: 16px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: var(--radius-md);
    overflow: hidden;
}

.faq-item details {
    width: 100%;
}

.faq-item summary {
    padding: 20px 24px;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--color-secondary);
    background: var(--color-bg-light);
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background var(--transition-fast);
}

.faq-item summary::-webkit-details-marker {
    display: none;
}

.faq-item summary:after {
    content: '\25BC';
    font-size: 0.9rem;
    color: var(--color-primary);
    transition: transform var(--transition-normal);
}

.faq-item details[open] summary:after {
    transform: rotate(180deg);
}

.faq-item details[open] summary {
    background: white;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.faq-answer {
    padding: 24px;
    background: white;
    color: var(--text-muted);
    line-height: 1.6;
    font-size: 1.05rem;
}

@media (max-width: 768px) {
    .support-grid {
        grid-template-columns: 1fr;
    }
    .testimonial-card {
        min-width: 300px;
    }
}

</style>

<!-- HERO SECTION -->
<section class="hero">
    <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=2070&q=80" alt="Premium Semi Truck" class="hero-bg">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="ph-fill ph-star"></i>
            Top Rated Parts Supplier
        </div>
        <h1>THE PARTS YOU NEED.<br>THE SERVICE YOU DESERVE.</h1>
        <p>Your trusted source for premium heavy-duty semi truck and trailer parts. With 3 locations and over 10,000+ parts in stock, we keep your fleet moving with fast turnaround and expert fitment.</p>
        <div class="hero-actions">
            <a href="<?= BASE_URL; ?>/parts" class="btn btn-primary btn-large">Browse Parts</a>
            <a href="<?= BASE_URL; ?>/quote" class="btn btn-outline btn-large">Get a Quote</a>
        </div>
    </div>
</section>

<!-- FEATURES SECTION (Overlapping Hero) -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">
                    <i class="ph ph-shield-check"></i>
                </div>
                <h3>OEM & Aftermarket</h3>
                <p>Trusted OEM-grade and aftermarket options to meet different fleet budgets and timelines. Only the best quality for your rig.</p>
            </div>
            <div class="feature-card animate-on-scroll" style="transition-delay: 0.1s;">
                <div class="feature-icon">
                    <i class="ph ph-clock"></i>
                </div>
                <h3>Same-Day Pickup</h3>
                <p>Over 10,000 fast-moving wear items and specialized components always in stock with local delivery available across our 3 locations.</p>
            </div>
            <div class="feature-card animate-on-scroll" style="transition-delay: 0.2s;">
                <div class="feature-icon">
                    <i class="ph ph-wrench"></i>
                </div>
                <h3>Fitment Experts</h3>
                <p>Share your VIN, unit number, or part number and our team will verify the correct match. No guesswork, no returns.</p>
            </div>
        </div>
    </div>
</section>

<!-- BRANDS MARQUEE -->
<section class="brands-section">
    <div class="container">
        <div class="brands-title">Trusted Brands We Carry</div>
    </div>
    <div class="marquee-container">
        <div class="marquee-content">
            <!-- Duplicated for seamless loop -->
            <h4>CUMMINS</h4>
            <h4>PETERBILT</h4>
            <h4>KENWORTH</h4>
            <h4>FREIGHTLINER</h4>
            <h4>VOLVO</h4>
            <h4>MACK</h4>
            <h4>BENDIX</h4>
            <h4>MERITOR</h4>
            
            <h4>CUMMINS</h4>
            <h4>PETERBILT</h4>
            <h4>KENWORTH</h4>
            <h4>FREIGHTLINER</h4>
            <h4>VOLVO</h4>
            <h4>MACK</h4>
            <h4>BENDIX</h4>
            <h4>MERITOR</h4>
        </div>
    </div>
</section>

<!-- CATEGORIES SECTION -->
<section class="categories-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Parts For Every Component</h2>
        <div class="categories-grid">
            
            <!-- Engine -->
            <div class="category-card animate-on-scroll">
                <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=1000&q=80" alt="Engine Parts" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">01</span>
                    <div class="category-content">
                        <h3>Engine & Emissions</h3>
                        <p>Gaskets, filters, sensors, exhaust components, and complete engine rebuild kits for all major diesel engines.</p>
                    </div>
                </div>
            </div>

            <!-- Brakes -->
            <div class="category-card animate-on-scroll" style="transition-delay: 0.1s;">
                <img src="https://images.unsplash.com/photo-1542323565-d0c0f91bb816?auto=format&fit=crop&w=1000&q=80" alt="Brakes & Wheels" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">02</span>
                    <div class="category-content">
                        <h3>Air Brakes & Drums</h3>
                        <p>Air brake components, drums, rotors, wheels, chambers, slack adjusters, and complete brake kits.</p>
                    </div>
                </div>
            </div>

            <!-- Suspension -->
            <div class="category-card animate-on-scroll" style="transition-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1530046339160-ce3e530c7d2f?auto=format&fit=crop&w=1000&q=80" alt="Suspension Parts" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">03</span>
                    <div class="category-content">
                        <h3>Suspension</h3>
                        <p>Air springs, shock absorbers, leaf springs, bushings, and complete suspension assemblies.</p>
                    </div>
                </div>
            </div>

            <!-- Electrical -->
            <div class="category-card animate-on-scroll">
                <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=1000&q=80" alt="Electrical Parts" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">04</span>
                    <div class="category-content">
                        <h3>Electrical & Lighting</h3>
                        <p>Starters, alternators, wiring, LEDs, signal lights, and complete electrical systems.</p>
                    </div>
                </div>
            </div>

            <!-- Trailer -->
            <div class="category-card animate-on-scroll" style="transition-delay: 0.1s;">
                <img src="https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?auto=format&fit=crop&w=1000&q=80" alt="Trailer Parts" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">05</span>
                    <div class="category-content">
                        <h3>Trailer Parts</h3>
                        <p>Landing gear, door hardware, king pins, lighting, mud flaps, and all trailer maintenance components.</p>
                    </div>
                </div>
            </div>

            <!-- Drivetrain -->
            <div class="category-card animate-on-scroll" style="transition-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1616788484674-67f78810e206?auto=format&fit=crop&w=1000&q=80" alt="Drivetrain" class="category-img">
                <div class="category-overlay">
                    <span class="category-number">06</span>
                    <div class="category-content">
                        <h3>Drivetrain</h3>
                        <p>Transmission, clutch, driveline essentials, axle components, and complete drivetrain assemblies.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SUPPORT SECTION -->
<section class="support-section">
    <div class="container">
        <div class="support-grid">
            <div class="support-image-container animate-on-scroll">
                <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=1000&q=80" alt="Customer Support Agent">
            </div>
            <div class="support-content animate-on-scroll" style="transition-delay: 0.2s;">
                <h2>24/7 Dedicated Fleet Support</h2>
                <p>Downtime costs you money. Our expert fitment and support team is dedicated to getting your fleet back on the road as quickly as possible. Whether you need a simple filter or a complete engine rebuild kit, we have you covered.</p>
                
                <div class="support-features">
                    <div class="support-feature">
                        <i class="ph-fill ph-headset"></i>
                        <div>
                            <h4>Expert Fitment Verification</h4>
                            <p>We cross-reference your VIN or part number to ensure exact fit.</p>
                        </div>
                    </div>
                    <div class="support-feature">
                        <i class="ph-fill ph-truck"></i>
                        <div>
                            <h4>Nationwide Delivery Network</h4>
                            <p>Fast, reliable delivery straight to your shop or depot.</p>
                        </div>
                    </div>
                    <div class="support-feature">
                        <i class="ph-fill ph-storefront"></i>
                        <div>
                            <h4>Local Pickup Available</h4>
                            <p>Pick up parts on the same day at any of our 3 locations.</p>
                        </div>
                    </div>
                </div>
                
                <a href="<?= BASE_URL; ?>/contact" class="btn btn-outline" style="color:var(--color-secondary); border-color:var(--color-secondary);">Contact Support</a>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SECTION -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Real Reviews From Real Customers</h2>
        <div class="testimonials-slider animate-on-scroll">
            
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-text">"The truck zone, best shop in Montreal. The manager helped me get all the parts for my truck. Best price for all parts. Everyone who works there are very professional and do their job exceptional."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?auto=format&fit=crop&w=150&q=80" alt="Customer" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4>Jaspreet Singh</h4>
                        <p>Owner Operator</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-text">"Excellent fast and efficient service. Great wide inventory and very competitive pricing. Thanks for helping us guys! Always get a good service over there and would highly recommend them."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" alt="Customer" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4>Umer Javed</h4>
                        <p>Fleet Manager</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-text">"Truck Zone offers a great selection of heavy truck parts for brands like Peterbilt, International, Volvo, and Freightliner. Their prices are competitive, and the service is excellent."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80" alt="Customer" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4>Fa W ad</h4>
                        <p>Independent Driver</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-text">"I am big rig school owner and I always buy parts from here. They always give me great price and service. Unmatched service, honest people, and true professionals who treat you like family."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Customer" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4>Aisha Ozor</h4>
                        <p>Driving School Owner</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Frequently Asked Questions</h2>
        <div class="faq-container animate-on-scroll">
            
            <div class="faq-item">
                <details>
                    <summary>Do you carry both OEM and aftermarket parts?</summary>
                    <div class="faq-answer">
                        Yes, we offer both OEM-grade and high-quality aftermarket options to accommodate your budget and fleet requirements. Our experts can advise you on the best choice for your specific repair.
                    </div>
                </details>
            </div>

            <div class="faq-item">
                <details>
                    <summary>How quickly can I get my parts?</summary>
                    <div class="faq-answer">
                        With over 10,000 items in stock across our 3 locations, many parts are available for same-day local pickup. For items requiring shipping, we utilize expedited regional carriers to minimize your downtime.
                    </div>
                </details>
            </div>

            <div class="faq-item">
                <details>
                    <summary>How do I make sure the part fits my truck?</summary>
                    <div class="faq-answer">
                        Simply provide our team with your truck's VIN, the engine serial number, or the original part number. Our fitment experts will cross-reference our database to guarantee you get the exact right part the first time.
                    </div>
                </details>
            </div>

            <div class="faq-item">
                <details>
                    <summary>Do you offer specialized pricing for large fleets?</summary>
                    <div class="faq-answer">
                        Absolutely. We offer competitive fleet accounts with volume-based pricing structures. Contact our sales team directly to set up an account and discuss your fleet's specific maintenance needs.
                    </div>
                </details>
            </div>

        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="cta-premium">
    <div class="cta-pattern"></div>
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2>CAN'T FIND WHAT YOU NEED?</h2>
            <p>Our team can source any part for any make and model. Give us a call and we'll track it down for you instantly with our nationwide network.</p>
            <a href="tel:+18005550199" class="btn btn-primary btn-large">
                <i class="ph-fill ph-phone-call"></i> Call Us Now: 1-800-555-0199
            </a>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>