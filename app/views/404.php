<?php
$pageTitle = "404 - Page Not Found";
require_once '../app/views/layouts/header.php';
?>

<div style="text-align: center; padding: 100px 20px;">
    <h1 style="font-size: 4rem; color: #dc3545; margin-bottom: 20px;">404</h1>
    <h2>Oops! Page Not Found</h2>
    <p style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 20px auto;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
    <a href="<?= BASE_URL; ?>/" style="display: inline-block; padding: 12px 25px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px;">Return to Homepage</a>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
