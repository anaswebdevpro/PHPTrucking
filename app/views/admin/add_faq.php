<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Add New FAQ</h1>
    <form action="<?= BASE_URL; ?>/add-faq" method="POST">
        <?= csrf_field(); ?>
        
        <div>
            <label>Question</label><br>
            <input type="text" name="question" required>
        </div>
        <br>
        
        <div>
            <label>Answer</label><br>
            <textarea name="answer" rows="4" required></textarea>
        </div>
        <br>

        <div>
            <label>Display Order (Lower numbers appear first)</label><br>
            <input type="number" name="display_order" value="0" required>
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1">Active</option>
                <option value="0">Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Add FAQ</button>
        <a href="<?= BASE_URL; ?>/faqs" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
