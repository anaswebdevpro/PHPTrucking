<?php require_once '../app/views/layouts/header.php'; ?>

<style>
.services-header {
    text-align: center;
    padding: 50px 20px;
    background: #eef;
}
.services-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}
.service-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 300px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
}
.service-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.service-info {
    padding: 20px;
}
.service-title {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #333;
}
.service-desc {
    font-size: 1rem;
    color: #666;
    line-height: 1.5;
}
</style>

<div class="services-header">
    <h1>Our Services</h1>
    <p>We offer a wide range of trucking solutions to meet your needs.</p>
</div>

<div class="services-container">
    <?php if(!empty($services)): ?>
        <?php foreach($services as $service): ?>
            <div class="service-card">
                <?php if($service['image']): ?>
                    <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($service['image']); ?>" class="service-img" alt="<?= htmlspecialchars($service['title']); ?>">
                <?php else: ?>
                    <div style="width:100%; height:200px; background:#ccc; display:flex; align-items:center; justify-content:center;">No Image</div>
                <?php endif; ?>
                <div class="service-info">
                    <h2 class="service-title"><?= htmlspecialchars($service['title']); ?></h2>
                    <p class="service-desc"><?= nl2br(htmlspecialchars($service['description'])); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No services available at the moment.</p>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
