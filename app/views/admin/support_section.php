<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Manage Support Section (24/7 Support)</h1>
    <form action="<?= BASE_URL; ?>/support-section" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($section['image'] ?? ''); ?>">
        
        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" <?= ($section['is_active'] ?? 1) == 1 ? 'selected' : ''; ?>>Active (Visible on Homepage)</option>
                <option value="0" <?= ($section['is_active'] ?? 1) == 0 ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </div>
        <br>

        <div>
            <label>Title</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($section['title'] ?? ''); ?>" required>
        </div>
        <br>
        
        <div>
            <label>Content</label><br>
            <textarea name="content" rows="6" required><?= htmlspecialchars($section['content'] ?? ''); ?></textarea>
        </div>
        <br>

        <div>
            <label>Side Image (Leave blank to keep current)</label><br>
            <?php if(!empty($section['image'])): ?>
                <img src="<?= htmlspecialchars((strpos($section['image'], 'http') === 0) ? $section['image'] : BASE_URL.'/public/uploads/'.$section['image']); ?>" width="200" style="margin-bottom: 10px; border-radius: 4px;"><br>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*">
        </div>
        <br>

        <button type="submit" class="btn-primary">Save Support Section</button>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
