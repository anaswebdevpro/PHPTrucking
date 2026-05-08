<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Manage FAQs</h1>
        <a href="<?= BASE_URL; ?>/add-faq" class="btn-primary">Add New FAQ</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>Question</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($faqs as $faq): ?>
                <tr>
                    <td><?= $faq['display_order']; ?></td>
                    <td><?= htmlspecialchars($faq['question']); ?></td>
                    <td><?= $faq['is_active'] ? 'Active' : 'Hidden'; ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>/edit-faq/<?= $faq['id']; ?>" style="margin-right:10px;">Edit</a>
                        <a href="<?= BASE_URL; ?>/delete-faq/<?= $faq['id']; ?>" class="btn-danger" onclick="return confirm('Delete this FAQ?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
