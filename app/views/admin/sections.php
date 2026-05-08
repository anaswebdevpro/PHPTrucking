<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Manage Homepage Sections</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Key</th>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($sections as $section): ?>
            <tr>
                <td><?= htmlspecialchars($section['section_key']); ?></td>
                <td><?= htmlspecialchars($section['title']); ?></td>
                <td>
                    <?php if($section['image']): ?>
                        <img src="<?= BASE_URL; ?>/public/uploads/<?= $section['image']; ?>" width="50" alt="img">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= BASE_URL; ?>/edit-section/<?= $section['id']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
