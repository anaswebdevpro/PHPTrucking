<?php $settings = getSettings(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Truck Service</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; height: 100vh; background: #f4f6f9; }
        .sidebar { width: 250px; background: #343a40; color: #fff; display: flex; flex-direction: column; }
        .sidebar-header { padding: 20px; font-size: 1.5rem; font-weight: bold; background: #23272b; text-align: center; border-bottom: 1px solid #4f5962; }
        .nav-link { padding: 15px 20px; color: #c2c7d0; text-decoration: none; border-bottom: 1px solid #4f5962; display: block; transition: all 0.3s; }
        .nav-link:hover, .nav-link.active { background: #007bff; color: #fff; }
        .main-content { flex: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .topbar { background: #fff; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: flex-end; align-items: center; }
        .content-area { padding: 20px; flex: 1; }
        .btn-logout { background: #dc3545; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
        .btn-logout:hover { background: #c82333; }
        
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        h1 { margin-top: 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 5px; }
        button[type="submit"] { background: #28a745; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; font-size: 1rem; }
        button[type="submit"]:hover { background: #218838; }
        .btn-primary { background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px; }
        .btn-primary:hover { background: #0056b3; }
        .btn-danger { color: #dc3545; text-decoration: none; font-weight: bold; }
        .btn-danger:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">Truck Service Admin</div>
    <?php $current_page = basename($_SERVER['REQUEST_URI']); ?>
    <a href="<?= BASE_URL; ?>/dashboard" class="nav-link <?= $current_page == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
    <a href="<?= BASE_URL; ?>/hero-banners" class="nav-link <?= strpos($current_page, 'hero-banner') !== false ? 'active' : '' ?>">Hero Slider</a>
    <a href="<?= BASE_URL; ?>/support-section" class="nav-link <?= strpos($current_page, 'support-section') !== false ? 'active' : '' ?>">Support Section</a>
    <a href="<?= BASE_URL; ?>/cta-section" class="nav-link <?= strpos($current_page, 'cta-section') !== false ? 'active' : '' ?>">CTA Section</a>
    <a href="<?= BASE_URL; ?>/categories" class="nav-link <?= strpos($current_page, 'categor') !== false ? 'active' : '' ?>">Parts Categories</a>
    <a href="<?= BASE_URL; ?>/admin-services" class="nav-link <?= strpos($current_page, 'service') !== false ? 'active' : '' ?>">Services</a>
    <a href="<?= BASE_URL; ?>/testimonials" class="nav-link <?= strpos($current_page, 'testimonial') !== false ? 'active' : '' ?>">Testimonials</a>
    <a href="<?= BASE_URL; ?>/faqs" class="nav-link <?= strpos($current_page, 'faq') !== false ? 'active' : '' ?>">FAQs</a>
    <a href="<?= BASE_URL; ?>/messages" class="nav-link <?= strpos($current_page, 'message') !== false ? 'active' : '' ?>">Messages</a>
    <a href="<?= BASE_URL; ?>/settings" class="nav-link <?= $current_page == 'settings' ? 'active' : '' ?>">Settings</a>
</div>

<div class="main-content">
    <div class="topbar">
        <span>Welcome, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?> &nbsp;</span>
        <a href="<?= BASE_URL; ?>/" target="_blank" style="margin-right:15px; color:#007bff;">View Site</a>
        <a href="<?= BASE_URL; ?>/logout" class="btn-logout">Logout</a>
    </div>
    
    <div class="content-area">
        <?php displayFlash(); ?>
