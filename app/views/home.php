<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   HOME PAGE SPECIFIC STYLES
   ========================================= */

/* HERO SLIDER STYLES */
.hero {
    position: relative;
    height: 100vh;
    min-height: 700px;
    background-color: var(--color-bg-dark);
    overflow: hidden;
    margin-top: -80px; /* Offset for fixed nav */
}

.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1.2s ease-in-out, visibility 1.2s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding-top: 80px;
}

.hero-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 2;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 1;
    filter: brightness(0.4) contrast(1.1);
    transform: scale(1.05);
}

.hero-slide.active .hero-bg {
    animation: slowZoom 20s infinite alternate;
}

@keyframes slowZoom {
    0% { transform: scale(1.05); }
    100% { transform: scale(1.15); }
}

.hero-content {
    position: relative;
    z-index: 3;
    text-align: left;
    width: 100%;
    max-width: 800px;
   
    margin-left:5vw;
    padding: 0 24px;
    opacity: 0;
    transform: translateY(30px);
    transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
}

.hero-slide.active .hero-content {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.3s;
}

.slider-controls {
    position: absolute;
    bottom: 120px;
    left: auto;
    right: 50px;
    z-index: 10;
    display: flex;
    gap: 12px;
}

.slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.slider-dot.active {
    background: var(--color-primary);
    transform: scale(1.3);
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
}

.hero-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-start;
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
    <?php if(!empty($banners)): ?>
        <?php foreach($banners as $index => $banner): ?>
            <div class="hero-slide <?= $index === 0 ? 'active' : '' ?>">
                <div class="hero-bg" style="background-image: url('<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($banner['image']); ?>');"></div>
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="ph-fill ph-star"></i>
                        Top Rated Parts Supplier
                    </div>
                    <h1><?= htmlspecialchars($banner['title']); ?></h1>
                    <p><?= nl2br(htmlspecialchars($sections['hero']['content'] ?? 'Your trusted source for premium heavy-duty semi truck and trailer parts.')); ?></p>
                    <div class="hero-actions">
                        <a href="<?= BASE_URL; ?>/parts" class="btn btn-primary btn-large">Browse Parts</a>
                        <a href="<?= BASE_URL; ?>/quote" class="btn btn-outline btn-large">Get a Quote</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if(count($banners) > 1): ?>
        <div class="slider-controls">
            <?php foreach($banners as $index => $banner): ?>
                <button class="slider-dot <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>" aria-label="Go to slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    <?php elseif(count($banners) > 0): ?>
        <!-- Single fallback using banners -->
        <div class="hero-slide active">
            <div class="hero-bg" style="background-image: url('<?= htmlspecialchars((strpos($banners[0]['image'], 'http') === 0) ? $banners[0]['image'] : BASE_URL.'/public/uploads/'.$banners[0]['image']); ?>');"></div>
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="ph-fill ph-star"></i>
                    Top Rated Parts Supplier
                </div>
                <h1><?= htmlspecialchars($banners[0]['title']); ?></h1>
                <p><?= nl2br(htmlspecialchars($banners[0]['subtitle'] ?? 'Your trusted source for premium heavy-duty semi truck and trailer parts.')); ?></p>
                <div class="hero-actions">
                    <a href="<?= BASE_URL; ?>/parts" class="btn btn-primary btn-large">Browse Parts</a>
                    <a href="<?= BASE_URL; ?>/quote" class="btn btn-outline btn-large">Get a Quote</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Hero Slider Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    const slideInterval = 6000; // 6 seconds per slide
    let timer;

    if(slides.length <= 1) return; // No need for slider if only 1 slide

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        if(dots.length) dots[currentSlide].classList.remove('active');
        
        currentSlide = index;
        
        slides[currentSlide].classList.add('active');
        if(dots.length) dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        goToSlide(next);
    }

    function startTimer() {
        timer = setInterval(nextSlide, slideInterval);
    }

    function resetTimer() {
        clearInterval(timer);
        startTimer();
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            goToSlide(index);
            resetTimer();
        });
    });

    startTimer();
});
</script>

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
<?php if(!empty($categories)): ?>
<section class="categories-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Parts For Every Component</h2>
        <div class="categories-grid">
            
            <?php foreach($categories as $index => $cat): ?>
            <div class="category-card animate-on-scroll" style="transition-delay: <?= ($index % 3) * 0.1 ?>s;">
                <?php $catImg = $cat['image'] ?: 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=1000&q=80'; ?>
                <img src="<?= htmlspecialchars((strpos($catImg, 'http') === 0) ? $catImg : BASE_URL.'/public/uploads/'.$catImg); ?>" alt="<?= htmlspecialchars($cat['title']); ?>" class="category-img">
                <div class="category-overlay">
                    <span class="category-number"><?= sprintf("%02d", $index + 1); ?></span>
                    <div class="category-content">
                        <h3><?= htmlspecialchars($cat['title']); ?></h3>
                        <p><?= htmlspecialchars($cat['description']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- SUPPORT SECTION -->
<?php if(isset($support_section) && $support_section['is_active']): ?>
<section class="support-section">
    <div class="container">
        <div class="support-grid">
            <div class="support-image-container animate-on-scroll">
                <?php $supportImage = $support_section['image'] ?: 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=1000&q=80'; ?>
                <img src="<?= htmlspecialchars((strpos($supportImage, 'http') === 0) ? $supportImage : BASE_URL.'/public/uploads/'.$supportImage); ?>" alt="Customer Support Agent">
            </div>
            <div class="support-content animate-on-scroll" style="transition-delay: 0.2s;">
                <h2><?= htmlspecialchars($support_section['title']); ?></h2>
                <p><?= nl2br(htmlspecialchars($support_section['content'])); ?></p>
                
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
<?php endif; ?>

<!-- TESTIMONIALS SECTION -->
<?php if(!empty($testimonials)): ?>
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Real Reviews From Real Customers</h2>
        <div class="testimonials-slider animate-on-scroll">
            
            <?php foreach($testimonials as $testimonial): ?>
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <?php for($i=0; $i<$testimonial['stars']; $i++): ?>
                        <i class="ph-fill ph-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"<?= htmlspecialchars($testimonial['content']); ?>"</p>
                <div class="testimonial-author">
                    <?php $avatarImg = $testimonial['avatar'] ?: 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?auto=format&fit=crop&w=150&q=80'; ?>
                    <img src="<?= htmlspecialchars((strpos($avatarImg, 'http') === 0) ? $avatarImg : BASE_URL.'/public/uploads/'.$avatarImg); ?>" alt="Customer" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4><?= htmlspecialchars($testimonial['author_name']); ?></h4>
                        <p><?= htmlspecialchars($testimonial['author_role']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>



<!-- CALL TO ACTION -->
<?php if(isset($cta_section) && $cta_section['is_active']): ?>
<section class="cta-premium">
    <div class="cta-pattern"></div>
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2><?= htmlspecialchars($cta_section['title']); ?></h2>
            <p><?= nl2br(htmlspecialchars($cta_section['content'])); ?></p>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+18005550199'); ?>" class="btn btn-primary btn-large">
                <i class="ph-fill ph-phone-call"></i> Call Us Now: <?= htmlspecialchars($settings['phone'] ?? '1-800-555-0199'); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ SECTION -->
<?php if(!empty($faqs)): ?>
<section class="faq-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Frequently Asked Questions</h2>
        <div class="faq-container animate-on-scroll">
            
            <?php foreach($faqs as $faq): ?>
            <div class="faq-item">
                <details>
                    <summary><?= htmlspecialchars($faq['question']); ?></summary>
                    <div class="faq-answer">
                        <?= nl2br(htmlspecialchars($faq['answer'])); ?>
                    </div>
                </details>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once '../app/views/layouts/footer.php'; ?>