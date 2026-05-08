<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Edit Service: <?= htmlspecialchars($service['title']); ?></h1>

<form action="<?= BASE_URL; ?>/edit-service/<?= $service['id']; ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($service['image'] ?? ''); ?>">

    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($service['title']); ?>" required style="width:100%; max-width:400px;">
    </div>
    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description" rows="6" style="width:100%; max-width:400px;"><?= htmlspecialchars($service['description']); ?></textarea>
    </div>
    <br>

    <div>
        <label>Service Image (Optional)</label><br>
        <?php if($service['image']): ?>
            <img src="<?= BASE_URL; ?>/public/uploads/<?= $service['image']; ?>" width="100" alt="img"><br>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">
    </div>
    <br>

    <button type="submit">Update Service</button>
    <a href="<?= BASE_URL; ?>/admin-services">Cancel</a>
</form>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
