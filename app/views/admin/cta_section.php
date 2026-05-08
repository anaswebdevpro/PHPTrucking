<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Manage CTA Section (Call To Action)</h1>
    <form action="<?= BASE_URL; ?>/cta-section" method="POST">
        <?= csrf_field(); ?>
        
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
            <textarea name="content" rows="4" required><?= htmlspecialchars($section['content'] ?? ''); ?></textarea>
        </div>
        <br>

        <p><i>Note: The phone number displayed in the CTA is pulled directly from the global Settings page.</i></p>

        <button type="submit" class="btn-primary">Save CTA Section</button>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
