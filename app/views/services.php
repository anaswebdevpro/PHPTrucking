<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   SERVICES PAGE SPECIFIC STYLES
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
    background-image: url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?auto=format&fit=crop&w=1920&q=80');
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

/* SERVICES GRID SECTION */
.services-page-section {
    padding: 100px 0;
    background-color: var(--color-bg-light);
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
}

.service-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
    display: flex;
    flex-direction: column;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.service-img-wrapper {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.service-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover .service-img {
    transform: scale(1.05);
}

.service-content {
    padding: 32px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.service-content h3 {
    font-size: 1.5rem;
    margin-bottom: 16px;
    color: var(--color-secondary);
}

.service-content p {
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 24px;
    flex-grow: 1;
}

.service-action {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--color-primary-dark);
    font-weight: 600;
    transition: color var(--transition-fast);
}

.service-action i {
    transition: transform var(--transition-fast);
}

.service-card:hover .service-action {
    color: var(--color-primary);
}

.service-card:hover .service-action i {
    transform: translateX(5px);
}

/* CTA BANNER */
.services-cta {
    background: var(--color-secondary);
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.services-cta-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 20px 20px, rgba(255, 193, 7, 0.05) 2px, transparent 0);
    background-size: 40px 40px;
    opacity: 0.5;
}

.services-cta-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
    margin: 0 auto;
}

.services-cta h2 {
    color: white;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.services-cta p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.2rem;
    margin-bottom: 30px;
}
</style>

<!-- HERO SECTION -->
<section class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="ph-fill ph-wrench"></i>
            Professional Services
        </div>
        <h1>Our Expert Services</h1>
        <p>Comprehensive maintenance and repair services to keep your heavy-duty fleet operating at peak performance.</p>
    </div>
</section>

<!-- SERVICES SECTION -->
<section class="services-page-section">
    <div class="container">
        <?php if(!empty($services)): ?>
            <div class="services-grid">
                <?php foreach($services as $index => $service): ?>
                <div class="service-card animate-on-scroll" style="transition-delay: <?= ($index % 3) * 0.1 ?>s;">
                    <div class="service-img-wrapper">
                        <?php $serviceImg = $service['image'] ?: 'https://images.unsplash.com/photo-1504222490345-c075b6008014?auto=format&fit=crop&w=800&q=80'; ?>
                        <img src="<?= htmlspecialchars((strpos($serviceImg, 'http') === 0) ? $serviceImg : BASE_URL.'/public/uploads/'.$serviceImg); ?>" alt="<?= htmlspecialchars($service['title']); ?>" class="service-img">
                    </div>
                    <div class="service-content">
                        <h3><?= htmlspecialchars($service['title']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($service['description'])); ?></p>
                        <a href="<?= BASE_URL; ?>/contact" class="service-action">
                            Book Service <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center" style="text-align: center; padding: 40px 0;">
                <h2>Our Services</h2>
                <p style="color: var(--text-muted);">No services are currently listed. Please check back later.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA SECTION -->
<section class="services-cta">
    <div class="services-cta-pattern"></div>
    <div class="container">
        <div class="services-cta-content animate-on-scroll">
            <h2>Need Immediate Assistance?</h2>
            <p>Our certified technicians are ready to handle any repair or maintenance job. Contact us today to schedule your service.</p>
            <a href="<?= BASE_URL; ?>/contact" class="btn btn-primary btn-large">
                Contact Our Service Team
            </a>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
