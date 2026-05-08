<?php 
$settings = getSettings(); 
$pageTitle = $pageTitle ?? $settings['site_name'];
$metaDesc = $metaDesc ?? "Professional trucking and logistics services.";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($metaDesc); ?>">
    <title><?= htmlspecialchars($pageTitle); ?></title>

    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/style.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #fdfdfd; color: #333; }
        nav { background: #fff; padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        nav .logo { display: flex; align-items: center; text-decoration: none; color: #333; font-weight: bold; font-size: 1.5rem; }
        nav .nav-links a { text-decoration: none; color: #555; margin-left: 20px; font-weight: 500; transition: color 0.3s; }
        nav .nav-links a:hover { color: #007bff; }
        footer { background: #333; color: #fff; text-align: center; padding: 20px; margin-top: 50px; }
    </style>
</head>

<body>

<nav>
    <a href="<?= BASE_URL; ?>/" class="logo">
    <?php if(!empty($settings['logo'])): ?>
        <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>" alt="<?= htmlspecialchars($settings['site_name']); ?>" height="40" style="margin-right:10px;">
    <?php endif; ?>
    <?= htmlspecialchars($settings['site_name']); ?>
    </a>
    
    <div class="nav-links">
        <a href="<?= BASE_URL; ?>/">Home</a>
        <a href="<?= BASE_URL; ?>/about">About</a>
        <a href="<?= BASE_URL; ?>/services">Services</a>
        <a href="<?= BASE_URL; ?>/contact">Contact</a>
    </div>
</nav>

<?php displayFlash(); ?>