<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Edit Section: <?= htmlspecialchars($section['section_key']); ?></h1>

<form action="<?= BASE_URL; ?>/edit-section/<?= $section['id']; ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($section['image'] ?? ''); ?>">

    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($section['title']); ?>" style="width:100%; max-width:400px;">
    </div>
    <br>

    <div>
        <label>Content</label><br>
        <textarea name="content" rows="6" style="width:100%; max-width:400px;"><?= htmlspecialchars($section['content']); ?></textarea>
    </div>
    <br>

    <div>
        <label>Section Image (Optional)</label><br>
        <?php if($section['image']): ?>
            <img src="<?= BASE_URL; ?>/public/uploads/<?= $section['image']; ?>" width="100" alt="img"><br>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">
    </div>
    <br>

    <button type="submit">Update Section</button>
    <a href="<?= BASE_URL; ?>/sections">Cancel</a>
</form>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
