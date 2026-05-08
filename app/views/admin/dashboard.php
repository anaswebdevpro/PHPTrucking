<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="card">
    <h1>Dashboard</h1>
    <p>Welcome to the admin dashboard. Use the sidebar to manage your website content.</p>
    
    <div style="display:flex; gap:20px; margin-top:30px;">
        <div style="flex:1; background:#17a2b8; color:#fff; padding:20px; border-radius:8px; text-align:center;">
            <h3>CMS Sections</h3>
            <p>Manage Homepage</p>
            <a href="<?= BASE_URL; ?>/sections" style="color:#fff; text-decoration:underline;">View</a>
        </div>
        <div style="flex:1; background:#28a745; color:#fff; padding:20px; border-radius:8px; text-align:center;">
            <h3>Services</h3>
            <p>Manage Offerings</p>
            <a href="<?= BASE_URL; ?>/admin-services" style="color:#fff; text-decoration:underline;">View</a>
        </div>
        <div style="flex:1; background:#ffc107; color:#333; padding:20px; border-radius:8px; text-align:center;">
            <h3>Messages</h3>
            <p>View Contact Form</p>
            <a href="<?= BASE_URL; ?>/messages" style="color:#333; text-decoration:underline;">View</a>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
