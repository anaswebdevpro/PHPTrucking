<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Manage Testimonials</h1>
        <a href="<?= BASE_URL; ?>/add-testimonial" class="btn-primary">Add New</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Author</th>
                <th>Role</th>
                <th>Stars</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($testimonials as $t): ?>
                <tr>
                    <td>
                        <?php if($t['avatar']): ?>
                            <img src="<?= htmlspecialchars((strpos($t['avatar'], 'http') === 0) ? $t['avatar'] : BASE_URL.'/public/uploads/'.$t['avatar']); ?>" width="50" alt="avatar" style="border-radius: 50%;">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($t['author_name']); ?></td>
                    <td><?= htmlspecialchars($t['author_role']); ?></td>
                    <td><?= $t['stars']; ?></td>
                    <td><?= $t['is_active'] ? 'Active' : 'Hidden'; ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>/edit-testimonial/<?= $t['id']; ?>" style="margin-right:10px;">Edit</a>
                        <a href="<?= BASE_URL; ?>/delete-testimonial/<?= $t['id']; ?>" class="btn-danger" onclick="return confirm('Delete this testimonial?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
