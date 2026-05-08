<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Edit Parts Category</h1>
    <form action="<?= BASE_URL; ?>/edit-category/<?= $category['id']; ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($category['image'] ?? ''); ?>">
        
        <div>
            <label>Category Title</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($category['title']); ?>" required>
        </div>
        <br>
        
        <div>
            <label>Description</label><br>
            <textarea name="description" rows="4"><?= htmlspecialchars($category['description']); ?></textarea>
        </div>
        <br>

        <div>
            <label>Image (Leave blank to keep current)</label><br>
            <?php if($category['image']): ?>
                <img src="<?= htmlspecialchars((strpos($category['image'], 'http') === 0) ? $category['image'] : BASE_URL.'/public/uploads/'.$category['image']); ?>" width="150" style="margin-bottom: 10px; border-radius: 4px;"><br>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*">
        </div>
        <br>

        <div>
            <label>Display Order</label><br>
            <input type="number" name="display_order" value="<?= $category['display_order']; ?>" required>
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" <?= $category['is_active'] == 1 ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= $category['is_active'] == 0 ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Update Category</button>
        <a href="<?= BASE_URL; ?>/categories" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
