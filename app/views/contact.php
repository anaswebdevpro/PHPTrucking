<?php require_once '../app/views/layouts/header.php'; ?>

<style>
.contact-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.contact-container h1 {
    text-align: center;
    margin-bottom: 20px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-submit {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 1.1rem;
}
.btn-submit:hover {
    background: #0056b3;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}
.alert-success { background: #d4edda; color: #155724; }
.alert-error { background: #f8d7da; color: #721c24; }
</style>

<div class="contact-container">
    <h1>Contact Us</h1>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Your message has been sent successfully. We will get back to you soon.</div>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-error">Please fill in all required fields correctly.</div>
    <?php endif; ?>

    <form action="<?= BASE_URL; ?>/contact" method="POST">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject">
        </div>
        <div class="form-group">
            <label>Message *</label>
            <textarea name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Send Message</button>
    </form>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>