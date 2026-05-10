<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Add Hero Banner</h1>
    <form action="<?= BASE_URL; ?>/add-hero-banner" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        
        <div>
            <label>Title</label><br>
            <input type="text" name="title" required>
        </div>
        <br>
        
        <div>
            <label>Subtitle / Content</label><br>
            <textarea name="subtitle" rows="4"></textarea>
        </div>
        <br>

        <div>
            <label>Background Image or Video (Required)</label><br>
            <small style="color:#64748b;">Supports: JPG, PNG, WEBP images or MP4, WEBM videos (16:9 recommended)</small><br>
            <input type="file" name="image" accept="image/*,video/mp4,video/webm,video/ogg" required>
        </div>
        <br>

        <div>
            <label>Display Order (Lower numbers appear first)</label><br>
            <input type="number" name="display_order" value="0" required>
        </div>
        <br>

        <button type="submit">Add Banner</button>
        <a href="<?= BASE_URL; ?>/hero-banners" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
