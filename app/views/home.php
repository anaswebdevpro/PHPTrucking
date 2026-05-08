<?php require_once '../app/views/layouts/header.php'; ?>

<style>
.banner-slider {
    position: relative;
    width: 100%;
    max-height: 500px;
    overflow: hidden;
    background: #000;
}
.banner-slide {
    display: none;
    position: relative;
    text-align: center;
}
.banner-slide.active {
    display: block;
}
.banner-img {
    width: 100%;
    height: auto;
    object-fit: cover;
    max-height: 500px;
    opacity: 0.8;
}
.banner-title {
    position: absolute;
    bottom: 20%;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-size: 2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
    background: rgba(0,0,0,0.5);
    padding: 10px 20px;
    border-radius: 5px;
}
.slider-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}
.slider-nav button {
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    padding: 15px;
    cursor: pointer;
    font-size: 1.5rem;
}
.slider-nav button:hover {
    background: rgba(0,0,0,0.8);
}
</style>

<?php if(!empty($banners)): ?>
<div class="banner-slider" id="bannerSlider">
    <?php foreach($banners as $index => $banner): ?>
        <div class="banner-slide <?= $index === 0 ? 'active' : '' ?>">
            <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($banner['image']); ?>" class="banner-img" alt="<?= htmlspecialchars($banner['title']); ?>">
            <h2 class="banner-title"><?= htmlspecialchars($banner['title']); ?></h2>
        </div>
    <?php endforeach; ?>
    
    <?php if(count($banners) > 1): ?>
        <div class="slider-nav">
            <button onclick="changeSlide(-1)">&#10094;</button>
            <button onclick="changeSlide(1)">&#10095;</button>
        </div>
    <?php endif; ?>
</div>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.banner-slide');

function changeSlide(direction) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + direction + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}

// Auto slide
if(slides.length > 1) {
    setInterval(() => changeSlide(1), 5000);
}
</script>
<?php endif; ?>

<style>
.section { padding: 60px 20px; text-align: center; }
.section-title { font-size: 2.5rem; margin-bottom: 20px; }
.section-content { max-width: 800px; margin: 0 auto; font-size: 1.2rem; line-height: 1.6; }
.section-img { max-width: 100%; height: auto; margin-top: 20px; border-radius: 8px; }
.bg-light { background-color: #f9f9f9; }
.cta-section { background: #333; color: #fff; padding: 50px 20px; text-align: center; }
.cta-section h2 { margin-bottom: 15px; }
.cta-button { background: #ffcc00; color: #333; padding: 15px 30px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block; margin-top: 20px; }
</style>

<?php if(!empty($sections['hero'])): ?>
<div class="section" style="background: #eef;">
    <h2 class="section-title"><?= htmlspecialchars($sections['hero']['title']); ?></h2>
    <div class="section-content"><?= nl2br(htmlspecialchars($sections['hero']['content'])); ?></div>
    <?php if($sections['hero']['image']): ?>
        <img src="<?= BASE_URL; ?>/public/uploads/<?= $sections['hero']['image']; ?>" class="section-img" alt="Hero">
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(!empty($sections['about'])): ?>
<div class="section bg-light">
    <h2 class="section-title"><?= htmlspecialchars($sections['about']['title']); ?></h2>
    <div class="section-content"><?= nl2br(htmlspecialchars($sections['about']['content'])); ?></div>
    <?php if($sections['about']['image']): ?>
        <img src="<?= BASE_URL; ?>/public/uploads/<?= $sections['about']['image']; ?>" class="section-img" alt="About">
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(!empty($sections['services'])): ?>
<div class="section">
    <h2 class="section-title"><?= htmlspecialchars($sections['services']['title']); ?></h2>
    <div class="section-content"><?= nl2br(htmlspecialchars($sections['services']['content'])); ?></div>
    <?php if($sections['services']['image']): ?>
        <img src="<?= BASE_URL; ?>/public/uploads/<?= $sections['services']['image']; ?>" class="section-img" alt="Services">
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(!empty($sections['why_choose_us'])): ?>
<div class="section bg-light">
    <h2 class="section-title"><?= htmlspecialchars($sections['why_choose_us']['title']); ?></h2>
    <div class="section-content"><?= nl2br(htmlspecialchars($sections['why_choose_us']['content'])); ?></div>
    <?php if($sections['why_choose_us']['image']): ?>
        <img src="<?= BASE_URL; ?>/public/uploads/<?= $sections['why_choose_us']['image']; ?>" class="section-img" alt="Why Choose Us">
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if(!empty($sections['cta'])): ?>
<div class="cta-section">
    <h2><?= htmlspecialchars($sections['cta']['title']); ?></h2>
    <div class="section-content" style="color:#eee;"><?= nl2br(htmlspecialchars($sections['cta']['content'])); ?></div>
    <a href="<?= BASE_URL; ?>/contact" class="cta-button">Contact Us Now</a>
</div>
<?php endif; ?>

<?php require_once '../app/views/layouts/footer.php'; ?>