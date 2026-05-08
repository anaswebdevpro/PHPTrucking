<footer class="premium-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?= BASE_URL; ?>" class="logo">
                    <i class="ph-fill ph-truck"></i>
                    <span><?= htmlspecialchars($settings['site_name'] ?? 'TRUCKZONE'); ?></span>
                </a>
                <p>Your trusted source for premium heavy-duty semi truck and trailer parts. Keeping fleets moving across the country with reliable parts and expert service.</p>
                <div class="social-links">
                    <a href="#"><i class="ph-fill ph-facebook-logo"></i></a>
                    <a href="#"><i class="ph-fill ph-instagram-logo"></i></a>
                    <a href="#"><i class="ph-fill ph-linkedin-logo"></i></a>
                    <a href="#"><i class="ph-fill ph-twitter-logo"></i></a>
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
                    <span>2362 46th Ave, Lachine,<br>QC H8T 2P3</span>
                </div>
                <div class="footer-contact-item">
                    <i class="ph-fill ph-phone"></i>
                    <span>(514) 802-9999<br>1-800-555-0199</span>
                </div>
                <div class="footer-contact-item">
                    <i class="ph-fill ph-envelope-simple"></i>
                    <span>info@truckzone.ca</span>
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