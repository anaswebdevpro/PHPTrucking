<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Website Settings</h1>

<form action="<?= BASE_URL; ?>/settings" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <div>
        <label>Current Logo</label><br>
        <?php if(!empty($settings['logo'])): ?>
            <img src="<?= BASE_URL; ?>/public/uploads/<?= $settings['logo']; ?>" alt="Logo" width="150"><br><br>
        <?php else: ?>
            <p>No logo uploaded yet.</p>
        <?php endif; ?>
    </div>

    <div>
        <label>Upload New Logo <small>(Recommended: 200x50 PNG, Max 2MB)</small></label><br>
        <input type="file" name="logo" accept="image/*">
    </div>

    <br>

    <div>
        <label>Site Name</label><br>
        <input type="text"
               name="site_name"
               value="<?= htmlspecialchars($settings['site_name'] ?? ''); ?>">
    </div>

    <br>

    <div>
        <label>Display Branding (Logo vs Name)</label><br>
        <select name="display_branding">
            <option value="both" <?= ($settings['display_branding'] ?? 'both') == 'both' ? 'selected' : ''; ?>>Show Both Logo and Name</option>
            <option value="logo" <?= ($settings['display_branding'] ?? '') == 'logo' ? 'selected' : ''; ?>>Show Logo Only (If uploaded)</option>
            <option value="text" <?= ($settings['display_branding'] ?? '') == 'text' ? 'selected' : ''; ?>>Show Text Name Only</option>
        </select>
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
               value="<?= htmlspecialchars($settings['instagram'] ?? ''); ?>">
    </div>

    <br>

    <div>
        <label>Twitter (X)</label><br>
        <input type="text"
               name="twitter"
               value="<?= htmlspecialchars($settings['twitter'] ?? ''); ?>">
    </div>

    <br>

    <div>
        <label>LinkedIn</label><br>
        <input type="text"
               name="linkedin"
               value="<?= htmlspecialchars($settings['linkedin'] ?? ''); ?>">
    </div>

    <br>

    <button type="submit">
        Update Settings
    </button>

</form>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>