<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Manage Hero Slider Banners</h1>
        <a href="<?= BASE_URL; ?>/add-hero-banner" class="btn-primary">Add New Banner</a>
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
            <?php foreach($banners as $banner): ?>
                <tr>
                    <td><?= $banner['display_order']; ?></td>
                    <td>
                        <img src="<?= htmlspecialchars((strpos($banner['image'], 'http') === 0) ? $banner['image'] : BASE_URL.'/public/uploads/'.$banner['image']); ?>" width="100" style="border-radius: 4px;">
                    </td>
                    <td><?= htmlspecialchars($banner['title']); ?></td>
                    <td><?= $banner['is_active'] ? 'Active' : 'Hidden'; ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>/edit-hero-banner/<?= $banner['id']; ?>" style="margin-right:10px;">Edit</a>
                        <a href="<?= BASE_URL; ?>/delete-hero-banner/<?= $banner['id']; ?>" class="btn-danger" onclick="return confirm('Delete this banner?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
