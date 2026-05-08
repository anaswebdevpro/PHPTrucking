<footer class="premium-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?= BASE_URL; ?>" class="logo">
                    <?php 
                        $branding = $settings['display_branding'] ?? 'both';
                        $hasLogo = !empty($settings['logo']);
                    ?>
                    
                    <?php if(($branding === 'logo' || $branding === 'both') && $hasLogo): ?>
                        <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'TRUCKZONE'); ?>" style="height: 50px; margin-right: 10px;">
                    <?php endif; ?>

                    <?php if($branding === 'text' || $branding === 'both' || !$hasLogo): ?>
                        <i class="ph-fill ph-truck"></i>
                        <span><?= htmlspecialchars($settings['site_name'] ?? 'TRUCKZONE'); ?></span>
                    <?php endif; ?>
                </a>
                <p>Your trusted source for premium heavy-duty semi truck and trailer parts. Keeping fleets moving across the country with reliable parts and expert service.</p>
                <div class="social-links">
                    <?php if(!empty($settings['facebook'])): ?>
                        <a href="<?= htmlspecialchars($settings['facebook']); ?>" target="_blank"><i class="ph-fill ph-facebook-logo"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['instagram'])): ?>
                        <a href="<?= htmlspecialchars($settings['instagram']); ?>" target="_blank"><i class="ph-fill ph-instagram-logo"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['linkedin'])): ?>
                        <a href="<?= htmlspecialchars($settings['linkedin']); ?>" target="_blank"><i class="ph-fill ph-linkedin-logo"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($settings['twitter'])): ?>
                        <a href="<?= htmlspecialchars($settings['twitter']); ?>" target="_blank"><i class="ph-fill ph-twitter-logo"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?= BASE_URL; ?>/about">About Us</a></li>
                    <li><a href="<?= BASE_URL; ?>/parts">Our Parts</a></li>
                    <li><a href="<?= BASE_URL; ?>/services">Services</a></li>
                    <li><a href="<?= BASE_URL; ?>/locations">Locations</a></li>
                    <li><a href="<?= BASE_URL; ?>/contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Parts Categories</h4>
                <ul>
                    <li><a href="<?= BASE_URL; ?>/parts/engine">Engine & Emissions</a></li>
                    <li><a href="<?= BASE_URL; ?>/parts/brakes">Air Brakes & Drums</a></li>
                    <li><a href="<?= BASE_URL; ?>/parts/suspension">Suspension</a></li>
                    <li><a href="<?= BASE_URL; ?>/parts/electrical">Electrical & Lighting</a></li>
                    <li><a href="<?= BASE_URL; ?>/parts/drivetrain">Drivetrain</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <div class="footer-contact-item">
                    <i class="ph-fill ph-map-pin"></i>
                    <span><?= nl2br(htmlspecialchars($settings['address'] ?? '2362 46th Ave, Lachine, QC H8T 2P3')); ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="ph-fill ph-phone"></i>
                    <span><?= nl2br(htmlspecialchars($settings['phone'] ?? '(514) 802-9999')); ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="ph-fill ph-envelope-simple"></i>
                    <span><?= htmlspecialchars($settings['email'] ?? 'info@truckzone.ca'); ?></span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y'); ?> <?= htmlspecialchars($settings['site_name'] ?? 'Truck Zone'); ?>. All Rights Reserved.</p>
            <div class="footer-legal">
                <a href="<?= BASE_URL; ?>/privacy">Privacy Policy</a>
                <a href="<?= BASE_URL; ?>/terms">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Intersection Observer for Scroll Animations -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.animate-on-scroll').forEach((elem) => {
        observer.observe(elem);
    });
});
</script>

</body>
</html>