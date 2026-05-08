<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Edit FAQ</h1>
    <form action="<?= BASE_URL; ?>/edit-faq/<?= $faq['id']; ?>" method="POST">
        <?= csrf_field(); ?>
        
        <div>
            <label>Question</label><br>
            <input type="text" name="question" value="<?= htmlspecialchars($faq['question']); ?>" required>
        </div>
        <br>
        
        <div>
            <label>Answer</label><br>
            <textarea name="answer" rows="4" required><?= htmlspecialchars($faq['answer']); ?></textarea>
        </div>
        <br>

        <div>
            <label>Display Order</label><br>
            <input type="number" name="display_order" value="<?= $faq['display_order']; ?>" required>
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1" <?= $faq['is_active'] == 1 ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= $faq['is_active'] == 0 ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Update FAQ</button>
        <a href="<?= BASE_URL; ?>/faqs" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
