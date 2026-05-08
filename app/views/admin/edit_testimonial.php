<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Edit Testimonial</h1>
    <form action="<?= BASE_URL; ?>/edit-testimonial/<?= $testimonial['id']; ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="existing_avatar" value="<?= htmlspecialchars($testimonial['avatar'] ?? ''); ?>">
        
        <div>
            <label>Author Name</label><br>
            <input type="text" name="author_name" value="<?= htmlspecialchars($testimonial['author_name']); ?>" required>
        </div>
        <br>
        
        <div>
            <label>Author Role</label><br>
            <input type="text" name="author_role" value="<?= htmlspecialchars($testimonial['author_role']); ?>" required>
        </div>
        <br>

        <div>
            <label>Review Content</label><br>
            <textarea name="content" rows="4" required><?= htmlspecialchars($testimonial['content']); ?></textarea>
        </div>
        <br>

        <div>
            <label>Stars (1-5)</label><br>
            <input type="number" name="stars" min="1" max="5" value="<?= $testimonial['stars']; ?>" required>
        </div>
        <br>

        <div>
            <label>Avatar Image (Optional, Recommended 150x150)</label><br>
            <?php if($testimonial['avatar']): ?>
                <img src="<?= htmlspecialchars((strpos($testimonial['avatar'], 'http') === 0) ? $testimonial['avatar'] : BASE_URL.'/public/uploads/'.$testimonial['avatar']); ?>" width="80" style="border-radius:50%;"><br>
            <?php endif; ?>
            <input type="file" name="avatar" accept="image/*">
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" <?= $testimonial['is_active'] == 1 ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= $testimonial['is_active'] == 0 ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Update Testimonial</button>
        <a href="<?= BASE_URL; ?>/testimonials" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
