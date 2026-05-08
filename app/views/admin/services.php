<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Manage Services</h1>

<a href="<?= BASE_URL; ?>/add-service" style="display:inline-block; margin-bottom:15px; padding:10px; background:#28a745; color:#fff; text-decoration:none;">Add New Service</a>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($services as $service): ?>
            <tr>
                <td><?= $service['id']; ?></td>
                <td><?= htmlspecialchars($service['title']); ?></td>
                <td>
                    <?php if($service['image']): ?>
                        <img src="<?= BASE_URL; ?>/public/uploads/<?= $service['image']; ?>" width="50" alt="img">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= BASE_URL; ?>/edit-service/<?= $service['id']; ?>">Edit</a> | 
                    <a href="<?= BASE_URL; ?>/delete-service/<?= $service['id']; ?>" onclick="return confirm('Are you sure?');" style="color:red;">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
