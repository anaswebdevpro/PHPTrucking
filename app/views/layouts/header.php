<?php 
$settings = getSettings(); 
$pageTitle = $pageTitle ?? $settings['site_name'] ?? 'Premium Truck Service';
$metaDesc = $metaDesc ?? "Professional trucking, logistics, and heavy-duty parts.";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($metaDesc); ?>">
    <title><?= htmlspecialchars($pageTitle); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/immersive-truck.css">
</head>

<body>

<nav class="premium-nav" id="main-nav">
    <div class="nav-container">
        <a href="<?= BASE_URL; ?>/" class="logo">
            <?php 
                $branding = $settings['display_branding'] ?? 'both';
                $hasLogo = !empty($settings['logo']);
            ?>
            
            <?php if(($branding === 'logo' || $branding === 'both') && $hasLogo): ?>
                <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'Transportation Corporation of Canada'); ?>" style="height: 40px; margin-right: 10px;">
            <?php endif; ?>

            <?php if($branding === 'text' || $branding === 'both' || !$hasLogo): ?>
                <!-- <i class="ph-fill ph-truck"></i> -->
                <span><?= htmlspecialchars($settings['site_name'] ?? 'Transportation Corporation of Canada'); ?></span>
            <?php endif; ?>
        </a>
        
        <div class="nav-links">
            <a href="<?= BASE_URL; ?>/">Home</a>
            <a href="<?= BASE_URL; ?>/transportation">Transportation</a>
            <a href="<?= BASE_URL; ?>/services">Services</a>
            <a href="<?= BASE_URL; ?>/about">About</a>
            <a href="<?= BASE_URL; ?>/contact">Contact</a>
        </div>

        <div class="nav-actions">
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+18005550199'); ?>" class="phone-link">
                <i class="ph ph-phone"></i>
                <span class="phone-number"><?= htmlspecialchars($settings['phone'] ?? '1-800-555-0199'); ?></span>
            </a>
            <a href="<?= BASE_URL; ?>/quote" class="btn btn-primary">Get a Quote</a>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Open menu">
                <i class="ph ph-list"></i>
            </button>
        </div>
    </div>
</nav>

<!-- MOBILE DRAWER -->
<div class="mobile-drawer" id="mobile-drawer">
    <div class="mobile-drawer-overlay" id="drawer-overlay"></div>
    <div class="mobile-drawer-panel">
        
        <div class="mobile-drawer-header">
            <a href="<?= BASE_URL; ?>/" class="logo">
                <?php if(($branding === 'logo' || $branding === 'both') && $hasLogo): ?>
                    <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'Transportation Corporation of Canada'); ?>" style="height: 35px;">
                <?php else: ?>
                    <i class="ph-fill ph-truck"></i>
                    <span style="font-size:1.3rem;"><?= htmlspecialchars($settings['site_name'] ?? 'Transportation Corporation of Canada'); ?></span>
                <?php endif; ?>
            </a>
            <button class="mobile-drawer-close" id="drawer-close" aria-label="Close menu">
                <i class="ph ph-x"></i>
            </button>
        </div>

        <nav class="mobile-drawer-links">
            <a href="<?= BASE_URL; ?>/"><i class="ph-fill ph-house"></i> Home</a>
            <a href="<?= BASE_URL; ?>/transportation"><i class="ph-fill ph-truck"></i> Transportation</a>
            <a href="<?= BASE_URL; ?>/services"><i class="ph-fill ph-wrench"></i> Services</a>
            <a href="<?= BASE_URL; ?>/about"><i class="ph-fill ph-info"></i> About</a>
            <a href="<?= BASE_URL; ?>/contact"><i class="ph-fill ph-envelope"></i> Contact</a>
        </nav>

        <div class="mobile-drawer-footer">
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+18005550199'); ?>" class="mobile-drawer-phone">
                <i class="ph-fill ph-phone"></i>
                <?= htmlspecialchars($settings['phone'] ?? '1-800-555-0199'); ?>
            </a>
            <a href="<?= BASE_URL; ?>/quote" class="btn btn-primary" style="justify-content:center;">
                Get a Quote
            </a>
        </div>

    </div>
</div>

<script>
(function() {
    const btn    = document.getElementById('mobile-menu-btn');
    const drawer = document.getElementById('mobile-drawer');
    const overlay = document.getElementById('drawer-overlay');
    const close  = document.getElementById('drawer-close');

    function openDrawer() {
        drawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    if (btn) btn.addEventListener('click', openDrawer);
    if (close) close.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDrawer();
    });
})();
</script>

<?php displayFlash(); ?>