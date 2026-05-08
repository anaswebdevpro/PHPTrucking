<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Add Parts Category</h1>
    <form action="<?= BASE_URL; ?>/add-category" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        
        <div>
            <label>Category Title</label><br>
            <input type="text" name="title" required>
        </div>
        <br>
        
        <div>
            <label>Description</label><br>
            <textarea name="description" rows="4"></textarea>
        </div>
        <br>

        <div>
            <label>Image</label><br>
            <input type="file" name="image" accept="image/*">
        </div>
        <br>

        <div>
            <label>Display Order (Lower numbers appear first)</label><br>
            <input type="number" name="display_order" value="0" required>
        </div>
        <br>

        <div>
            <label>Status</label><br>
            <select name="is_active">
                <option value="1">Active</option>
                <option value="0">Hidden</option>
            </select>
        </div>
        <br>

        <button type="submit">Add Category</button>
        <a href="<?= BASE_URL; ?>/categories" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
