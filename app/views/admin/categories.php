<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Manage Parts Categories</h1>
        <a href="<?= BASE_URL; ?>/add-category" class="btn-primary">Add New Category</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $cat): ?>
                <tr>
                    <td><?= $cat['display_order']; ?></td>
                    <td>
                        <?php if($cat['image']): ?>
                            <img src="<?= htmlspecialchars((strpos($cat['image'], 'http') === 0) ? $cat['image'] : BASE_URL.'/public/uploads/'.$cat['image']); ?>" width="100" style="border-radius: 4px;">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($cat['title']); ?></td>
                    <td><?= $cat['is_active'] ? 'Active' : 'Hidden'; ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>/edit-category/<?= $cat['id']; ?>" style="margin-right:10px;">Edit</a>
                        <a href="<?= BASE_URL; ?>/delete-category/<?= $cat['id']; ?>" class="btn-danger" onclick="return confirm('Delete this category?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
