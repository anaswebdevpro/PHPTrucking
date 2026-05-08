<?php require_once 'layouts/header.php'; ?>

<h1>Admin Login</h1>

<form action="<?= BASE_URL; ?>/login" method="POST">
    <?= csrf_field(); ?>
    <div>
        <label>Username</label><br>
        <input type="text" name="username" required>
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit">Login</button>

</form>

<?php require_once 'layouts/footer.php'; ?>