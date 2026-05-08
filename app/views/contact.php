<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   CONTACT PAGE SPECIFIC STYLES
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
    background-image: url('https://images.unsplash.com/photo-1516387938699-a93567ec168e?auto=format&fit=crop&w=1920&q=80');
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

/* CONTACT SECTION */
.contact-section {
    padding: 100px 0;
    background-color: var(--color-bg-light);
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 60px;
}

@media (max-width: 900px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}

.contact-info-card {
    background: var(--color-secondary);
    color: var(--text-light);
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
}

.contact-info-card h3 {
    color: var(--color-primary);
    margin-bottom: 30px;
    font-size: 1.8rem;
}

.info-item {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}

.info-item i {
    font-size: 1.8rem;
    color: var(--color-primary);
}

.info-item h4 {
    color: var(--text-light);
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.info-item p {
    color: rgba(255,255,255,0.7);
    line-height: 1.5;
}

.contact-form-wrapper {
    background: white;
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
}

.contact-form-wrapper h3 {
    margin-bottom: 30px;
    font-size: 1.8rem;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-main);
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: var(--radius-sm);
    font-family: inherit;
    font-size: 1rem;
    transition: border-color var(--transition-fast);
}

.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
}

.btn-submit {
    width: 100%;
    padding: 16px;
    font-size: 1.1rem;
}
</style>

<!-- HERO SECTION -->
<section class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="ph-fill ph-envelope"></i>
            Get In Touch
        </div>
        <h1>Contact Us</h1>
        <p>Our team is ready to answer your questions and provide the support you need.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            
            <div class="contact-info-card animate-on-scroll">
                <h3>Contact Information</h3>
                
                <div class="info-item">
                    <i class="ph-fill ph-map-pin"></i>
                    <div>
                        <h4>Our Address</h4>
                        <p><?= nl2br(htmlspecialchars($settings['address'] ?? '2362 46th Ave, Lachine, QC H8T 2P3')); ?></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="ph-fill ph-phone"></i>
                    <div>
                        <h4>Phone Number</h4>
                        <p><?= nl2br(htmlspecialchars($settings['phone'] ?? '(514) 802-9999')); ?></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="ph-fill ph-envelope-simple"></i>
                    <div>
                        <h4>Email Address</h4>
                        <p><?= htmlspecialchars($settings['email'] ?? 'info@truckzone.ca'); ?></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="ph-fill ph-clock"></i>
                    <div>
                        <h4>Business Hours</h4>
                        <p>Monday - Friday: 8am - 6pm<br>Saturday: 9am - 1pm<br>Sunday: Closed</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper animate-on-scroll" style="transition-delay: 0.2s;">
                <h3>Send Us A Message</h3>
                
                <form action="<?= BASE_URL; ?>/contact" method="POST">
                    <?= csrf_field(); ?>
                    
                    <div class="form-group">
                        <label>Your Name *</label>
                        <input type="text" name="name" required placeholder="John Doe">
                    </div>
                    
                    <div class="form-group">
                        <label>Your Email *</label>
                        <input type="email" name="email" required placeholder="john@example.com">
                    </div>
                    
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" placeholder="How can we help?">
                    </div>
                    
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" rows="5" required placeholder="Write your message here..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-submit">Send Message <i class="ph-bold ph-paper-plane-right"></i></button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>