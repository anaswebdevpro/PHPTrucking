<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">
    <h1>Add New Testimonial</h1>
    <form action="<?= BASE_URL; ?>/add-testimonial" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        
        <div>
            <label>Author Name</label><br>
            <input type="text" name="author_name" required>
        </div>
        <br>
        
        <div>
            <label>Author Role (e.g. Fleet Manager)</label><br>
            <input type="text" name="author_role" required>
        </div>
        <br>

        <div>
            <label>Review Content</label><br>
            <textarea name="content" rows="4" required></textarea>
        </div>
        <br>

        <div>
            <label>Stars (1-5)</label><br>
            <input type="number" name="stars" min="1" max="5" value="5" required>
        </div>
        <br>

        <div>
            <label>Avatar Image (Optional, Recommended 150x150)</label><br>
            <input type="file" name="avatar" accept="image/*">
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

        <button type="submit">Add Testimonial</button>
        <a href="<?= BASE_URL; ?>/testimonials" style="margin-left: 15px;">Cancel</a>
    </form>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
