<?php require_once '../app/views/layouts/header.php'; ?>

<h1>Banner Management</h1>

<form
    action="<?= BASE_URL; ?>/banners"
    method="POST"
    enctype="multipart/form-data"
>

    <div>
        <label>Banner Title</label><br>

        <input
            type="text"
            name="title"
            required
        >
    </div>

    <br>

    <div>
        <label>Banner Image</label><br>

        <input
            type="file"
            name="image"
            required
        >
    </div>

    <br>

    <button type="submit">
        Upload Banner
    </button>

</form>

<hr>

<h2>All Banners</h2>

<?php foreach($banners as $banner): ?>

    <div style="margin-bottom:30px;">

        <h3><?= $banner['title']; ?></h3>

        <img
            src="<?= BASE_URL; ?>/public/uploads/<?= $banner['image']; ?>"
            width="300"
        >
        <br><br>

<a
    href="<?= BASE_URL; ?>/delete-banner/<?= $banner['id']; ?>"
    onclick="return confirm('Delete this banner?')"
>
    Delete Banner
</a>

    </div>

<?php endforeach; ?>

<?php require_once '../app/views/layouts/footer.php'; ?>