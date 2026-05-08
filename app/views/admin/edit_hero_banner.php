<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Edit Hero Banner</h1>
    <form action="<?= BASE_URL; ?>/edit-hero-banner/<?= $banner['id']; ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($banner['image'] ?? ''); ?>">
        
        <div>
            <label>Title</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($banner['title']); ?>" required>
        </div>
        <br>
        
        <div>
            <label>Subtitle / Content</label><br>
            <textarea name="subtitle" rows="4"><?= htmlspecialchars($banner['subtitle']); ?></textarea>
        </div>
        <br>

        <div>
            <label>Background Image (Leave blank to keep current)</label><br>
            <?php if($banner['image']): ?>
                <img src="<?= htmlspecialchars((strpos($banner['image'], 'http') === 0) ? $banner['image'] : BASE_URL.'/public/uploads/'.$banner['image']); ?>" width="150" style="margin-bottom: 10px; border-radius: 4px;"><br>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*">
        </div>
        <br>

        <div>
            <label>Display Order</label><br>
            <input type="number" name="display_order" value="<?= $banner['display_order']; ?>" required>
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" <?= $banner['is_active'] == 1 ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= $banner['is_active'] == 0 ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Update Banner</button>
        <a href="<?= BASE_URL; ?>/hero-banners" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
