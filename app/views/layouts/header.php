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
</head>

<body>

<nav class="premium-nav">
    <div class="nav-container">
        <a href="<?= BASE_URL; ?>/" class="logo">
            <?php 
                $branding = $settings['display_branding'] ?? 'both';
                $hasLogo = !empty($settings['logo']);
            ?>
            
            <?php if(($branding === 'logo' || $branding === 'both') && $hasLogo): ?>
                <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'TRUCKZONE'); ?>" style="height: 40px; margin-right: 10px;">
            <?php endif; ?>

            <?php if($branding === 'text' || $branding === 'both' || !$hasLogo): ?>
                <i class="ph-fill ph-truck"></i>
                <span><?= htmlspecialchars($settings['site_name'] ?? 'TRUCKZONE'); ?></span>
            <?php endif; ?>
        </a>
        
        <div class="nav-links">
            <a href="<?= BASE_URL; ?>/" class="active">Home</a>
            <a href="<?= BASE_URL; ?>/parts">Parts</a>
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
            <button class="mobile-menu-btn">
                <i class="ph ph-list"></i>
            </button>
        </div>
    </div>
</nav>

<?php displayFlash(); ?>