<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Add New Service</h1>

<form action="<?= BASE_URL; ?>/add-service" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div>
        <label>Title</label><br>
        <input type="text" name="title" required style="width:100%; max-width:400px;">
    </div>
    <br>

    <div>
        <label>Description</label><br>
        <textarea name="description" rows="6" style="width:100%; max-width:400px;"></textarea>
    </div>
    <br>

    <div>
        <label>Service Image (Optional)</label><br>
        <input type="file" name="image" accept="image/*">
    </div>
    <br>

    <button type="submit">Add Service</button>
    <a href="<?= BASE_URL; ?>/admin-services">Cancel</a>
</form>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
