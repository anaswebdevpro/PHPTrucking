<?php require_once '../app/views/layouts/header.php'; ?>

<h1>Website Settings</h1>

<form action="<?= BASE_URL; ?>/settings" method="POST">

    <div>
        <label>Site Name</label><br>
        <input type="text"
               name="site_name"
               value="<?= $settings['site_name']; ?>">
    </div>

    <br>

    <div>
        <label>Phone</label><br>
        <input type="text"
               name="phone"
               value="<?= $settings['phone']; ?>">
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input type="text"
               name="email"
               value="<?= $settings['email']; ?>">
    </div>

    <br>

    <div>
        <label>Address</label><br>
        <textarea name="address"><?= $settings['address']; ?></textarea>
    </div>

    <br>

    <div>
        <label>Facebook</label><br>
        <input type="text"
               name="facebook"
               value="<?= $settings['facebook']; ?>">
    </div>

    <br>

    <div>
        <label>Instagram</label><br>
        <input type="text"
               name="instagram"
               value="<?= $settings['instagram']; ?>">
    </div>

    <br>

    <button type="submit">
        Update Settings
    </button>

</form>

<?php require_once '../app/views/layouts/footer.php'; ?>