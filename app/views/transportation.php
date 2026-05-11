<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   TRANSPORTATION (LTL) PAGE SPECIFIC STYLES
   ========================================= */

/* HERO SLIDER STYLES (From Home Page) */
.hero {
    position: relative;
    height: 100vh;
    min-height: 700px;
    background-color: var(--color-bg-dark);
    overflow: hidden;
    margin-top: -80px; 
}

.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1.2s ease-in-out, visibility 1.2s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding-top: 80px;
}

.hero-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 2;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 1;
    filter: brightness(0.4) contrast(1.1);
    transform: scale(1.05);
}

.hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    filter: brightness(0.4) contrast(1.1);
    transform: scale(1.05);
}

.hero-slide.active .hero-bg,
.hero-slide.active .hero-video {
    animation: slowZoom 20s infinite alternate;
}

@keyframes slowZoom {
    0% { transform: scale(1.05); }
    100% { transform: scale(1.15); }
}

.hero-content {
    position: relative;
    z-index: 3;
    text-align: left;
    width: 100%;
    max-width: 800px;
    margin-left:5vw;
    padding: 0 24px;
    opacity: 0;
    transform: translateY(30px);
    transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
}

.hero-slide.active .hero-content {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.3s;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 16px;
    color: var(--color-primary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero h1 {
    font-size: clamp(2rem, 5vw, 4rem);
    color: var(--text-light);
    margin-bottom: 16px;
    line-height: 1.05;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.hero p {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 24px;
    max-width: 700px;
    line-height: 1.6;
}

/* LTL SECTIONS */
.breadcrumbs {
    padding: 40px 0 20px;
    font-size: 0.9rem;
    color: var(--text-muted);
}
.breadcrumbs a {
    color: var(--color-secondary);
    text-decoration: none;
    font-weight: 500;
}
.breadcrumbs a:hover {
    color: var(--color-primary);
}
.breadcrumbs span {
    margin: 0 8px;
}

.ltl-content-section {
    padding: 40px 0 80px;
    background: #ffffff;
}

.ltl-content-section h2 {
    font-size: 2.2rem;
    color: var(--color-secondary);
    margin-bottom: 24px;
    line-height: 1.2;
}

.ltl-content-section p {
    font-size: 1.1rem;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 24px;
}

.benefits-grid, .services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.benefit-card, .service-card {
    background: var(--color-bg-light);
    padding: 32px;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    transition: transform 0.3s ease;
    border: 1px solid #e2e8f0;
}
.benefit-card:hover, .service-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.benefit-card h3, .service-card h3 {
    font-size: 1.4rem;
    color: var(--color-secondary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.benefit-card h3 i, .service-card h3 i {
    color: var(--color-primary);
    font-size: 1.8rem;
}

.benefit-card p, .service-card p {
    font-size: 1rem;
    margin-bottom: 0;
    color: #475569;
    line-height: 1.6;
}

.why-choose-list {
    list-style: none;
    padding: 0;
}
.why-choose-list li {
    position: relative;
    padding-left: 32px;
    margin-bottom: 16px;
    font-size: 1.1rem;
    color: #475569;
    line-height: 1.6;
}
.why-choose-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    top: 2px;
    color: var(--color-primary);
    font-weight: bold;
    font-size: 1.2rem;
}

.cta-banner {
    position: relative;
    background-image: url('<?= BASE_URL; ?>/public/uploads/ftl-transportation.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;
    text-align: center;
    padding: 80px 40px;
    border-radius: var(--radius-lg);
    margin: 80px 0;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

.cta-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(15, 20, 30, 0.95) 0%, rgba(15, 20, 30, 0.7) 100%);
    z-index: 1;
}

.cta-banner-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
    margin: 0 auto;
}

.cta-banner h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: white;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -0.5px;
}

.cta-banner p {
    font-size: 1.25rem;
    margin-bottom: 35px;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
}

.cta-banner .btn {
    padding: 16px 40px;
    font-size: 1.1rem;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.cta-banner .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
}

/* FAQ STYLES */
.faq-section {
    padding: 80px 0;
    background: var(--color-bg-light);
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    margin-bottom: 16px;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-md);
    overflow: hidden;
}

.faq-item summary {
    padding: 20px 24px;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--color-secondary);
    background: white;
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.faq-item summary::-webkit-details-marker { display: none; }
.faq-item summary:after {
    content: '\25BC';
    font-size: 0.9rem;
    color: var(--color-primary);
    transition: transform 0.3s ease;
}
.faq-item details[open] summary:after { transform: rotate(180deg); }
.faq-item details[open] summary { 
    background: var(--color-bg-light); 
    border-bottom: 1px solid #e2e8f0;
}

.faq-answer {
    padding: 24px;
    background: white;
    color: #475569;
    line-height: 1.6;
    font-size: 1.05rem;
}

/* HOME PAGE SUPPORT SECTION STYLES */
.support-section {
    position: relative;
    padding: 0;
    min-height: 600px;
    display: flex;
    align-items: stretch;
    overflow: hidden;
}

.support-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center left;
    z-index: 1;
}

.support-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.15) 0%, rgba(15,20,30,0.75) 40%, rgba(15,20,30,0.95) 60%, rgba(15,20,30,1) 80%);
    z-index: 2;
}

.support-inner {
    position: relative;
    z-index: 3;
    width: 100%;
    max-width: var(--container-width);
    margin: 0 auto;
    padding: 80px 24px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.support-content {
    max-width: 560px;
}

.support-content h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: var(--text-light);
    line-height: 1.15;
    text-transform: uppercase;
    font-weight: 800;
}

.support-content > p {
    color: rgba(255,255,255,0.7);
    font-size: 1rem;
    margin-bottom: 35px;
    line-height: 1.6;
}

.support-features {
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-bottom: 40px;
}

.support-feature {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px 20px;
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.08);
}

.support-feature i {
    font-size: 1.4rem;
    color: var(--color-primary);
    background: transparent;
    padding: 10px;
    border-radius: 50%;
    border: 1.5px solid var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.support-feature h4 {
    font-size: 1.1rem;
    color: var(--text-light);
    margin: 0 0 4px 0;
    font-weight: 700;
}

.support-feature p {
    margin: 0;
    font-size: 0.9rem;
    color: rgba(255,255,255,0.6);
    line-height: 1.5;
}

@media (max-width: 768px) {
    .support-section { min-height: auto; }
    .support-bg { display: none; }
    .support-overlay { background: var(--color-bg-dark); }
    .support-inner { justify-content: center; }
    .support-content { max-width: 100%; }
}
</style>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-slide active">
        <!-- Using a default image from uploads or fallback -->
        <div class="hero-bg" style="background-image: url('<?= BASE_URL; ?>/public/uploads/1778428419_6a00aa032a331.jpg');"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="ph-fill ph-truck"></i>
                LTL Delivery
            </div>
            <h1> Transportation</h1>
            <p>Less-than-truckload (LTL) shipments consist of goods that occupy only a portion of a trailer. .</p>
            <div class="hero-actions">
                <a href="#ltl-info" class="btn btn-primary btn-large">Discover LTL</a>
            </div>
        </div>
    </div>
</section>

<div class="container" id="ltl-info">
    <div class="breadcrumbs animate-on-scroll">
        <a href="<?= BASE_URL; ?>/">Home</a> <span>&gt;</span>
        <a href="<?= BASE_URL; ?>/services">Services</a> <span>&gt;</span>
        <a href="<?= BASE_URL; ?>/transportation">Transport</a> <span>&gt;</span>
        <a href="#">Road transport</a> <span>&gt;</span>
        <span style="color:var(--color-primary); font-weight:600;">LTL</span>
    </div>
</div>

<section class="ltl-content-section">
    <div class="container">
        <!-- Intro Section -->
        <div class="row animate-on-scroll" style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center;">
            <div style="flex: 1; min-width: 300px;">
                <h2>Tailored transport for smaller shipments with LTL logistics</h2>
                <p>For shipment sizes between consolidated freight and full loads, part-load (LTL) shipments by our team are the fastest, most flexible, efficient and cost-effective solution. Freight consolidation offers better shipping rates and minimises costs. Combining your shipments with other companies and sharing a truck also reduces your environmental impact alongside an optimised supply chain.</p>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <img src="<?= BASE_URL; ?>/public/uploads/1778428465_6a00aa31339d9.jpg" alt="Truck on the road" style="width: 100%; max-height: 50vh; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
            </div>
        </div>

        <!-- Benefits -->
        <h2 class="animate-on-scroll" style="margin-top: 80px; text-align: center;">Your benefits with LTL delivery</h2>
        <div class="benefits-grid animate-on-scroll">
            <div class="benefit-card">
                <h3><i class="ph-fill ph-piggy-bank"></i> Cost savings</h3>
                <p>Freight consolidation offers better shipping rates and minimises costs as partial shipments are consolidated in one truck and directly transported to the point of use.</p>
            </div>
            <div class="benefit-card">
                <h3><i class="ph-fill ph-lightning"></i> Efficiency</h3>
                <p>Benefit from shorter shipping times since you alone are not responsible for filling the truck to capacity.</p>
            </div>
            <div class="benefit-card">
                <h3><i class="ph-fill ph-arrows-out"></i> Flexibility</h3>
                <p>LTL logistics offers you a great deal of flexibility for your individual needs, but also lets you react quickly to the needs of your customers.</p>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="row animate-on-scroll" style="display: flex; flex-wrap: wrap; gap: 40px; margin-top: 80px; align-items: center;">
            <div style="flex: 1; min-width: 300px; order: 2;">
                <h2>Why choose us for LTL delivery</h2>
                <ul class="why-choose-list">
                    <li>With our international partner network and daily truck routes, we ensure your shipments arrive fast and dependably.</li>
                    <li>Take advantage of our one-stop services, from consulting to customs services, to save time and money.</li>
                    <li>With years of experience in transporting goods with special requirements, such as temperature-controlled goods or time-sensitive shipments, we handle these tasks with ease.</li>
                    <li>Our customer service and online tracking provide full transparency and control throughout your LTL logistics operations.</li>
                </ul>
            </div>
            <div style="flex: 1; min-width: 300px; order: 1;">
                <img src="<?= BASE_URL; ?>/public/uploads/flatbed-trucking.jpg" alt="Aerial view of a forest road" style="width: 100%; max-height: 50vh; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
            </div>
        </div>

        <!-- Value Added Services -->
        <h2 class="animate-on-scroll" style="margin-top: 80px; text-align: center;">Your value-added services for LTL delivery</h2>
        <div class="services-grid animate-on-scroll">
            <div class="service-card">
                <h3><i class="ph-fill ph-file-text"></i> Customs clearance</h3>
                <p>With our expertise in customs clearance, we ensure compliance with local authorities, guaranteeing that your LTL delivery meets all customs requirements and passes customs smoothly.</p>
            </div>
            <div class="service-card">
                <h3><i class="ph-fill ph-warning-circle"></i> Dangerous goods</h3>
                <p>Our dedicated Dangerous Goods Officers train our team to handle hazardous items securely, monitor transport operations and ensure compliance with all safety regulations.</p>
            </div>
            <div class="service-card">
                <h3><i class="ph-fill ph-thermometer"></i> Temperature control</h3>
                <p>We specialise in transporting temperature-sensitive goods like chemicals or pharmaceuticals, using thermal vehicles with air-conditioned and cooling systems.</p>
            </div>
            <div class="service-card">
                <h3><i class="ph-fill ph-shield-check"></i> Transport insurance</h3>
                <p>For your protection against potential costs in LTL logistics, we recommend additional insurance coverage, including “all risks” policies for peace of mind.</p>
            </div>
            <div class="service-card">
                <h3><i class="ph-fill ph-rocket"></i> Express shipment</h3>
                <p>Our express services offer personalised solutions for all your shipping needs, ensuring your shipment arrives on time at your chosen destination.</p>
            </div>
            <div class="service-card">
                <h3><i class="ph-fill ph-desktop"></i> Digital services</h3>
                <p>Take advantage of our online tools to access your shipment information anytime, with track & trace features to monitor every step of the journey.</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-banner animate-on-scroll">
            <div class="cta-banner-content">
                <h2>Save on the cost of transporting your goods now!</h2>
                <p>Our LTL trucking experts are just a click away. Together we will find the best solution for you.</p>
                <a href="<?= BASE_URL; ?>/contact" class="btn btn-primary btn-large">Contact Us Now</a>
            </div>
        </div>
    </div>
</section>

<!-- SUPPORT SECTION FROM HOME PAGE -->
<?php if(isset($support_section) && $support_section['is_active']): ?>
<?php 
    $supportImage = !empty($support_section['image']) ? $support_section['image'] : 'technician_portrait.png';
    $supportImgSrc = (strpos($supportImage, 'http') === 0) ? $supportImage : BASE_URL.'/public/uploads/'.$supportImage;
?>
<section class="support-section">
    <div class="support-bg" style="background-image: url('<?= htmlspecialchars($supportImgSrc); ?>');"></div>
    <div class="support-overlay"></div>
    
    <div class="support-inner">
        <div class="support-content animate-on-scroll">
            <h2><?= htmlspecialchars($support_section['title']); ?></h2>
            <p><?= nl2br(htmlspecialchars($support_section['content'])); ?></p>
            
            <div class="support-features">
                <div class="support-feature">
                    <i class="ph-fill ph-headset"></i>
                    <div>
                        <h4>Expert Fitment & Notification</h4>
                        <p>We cross-reference your VIN or part number to ensure exact fit, proactively notifying you of matching confirmations.</p>
                    </div>
                </div>
                <div class="support-feature">
                    <i class="ph-fill ph-truck"></i>
                    <div>
                        <h4>Delivery Delivery with GPS</h4>
                        <p>We accommodate traditional commercial and customized delivery services, always.</p>
                    </div>
                </div>
                <div class="support-feature">
                    <i class="ph-fill ph-storefront"></i>
                    <div>
                        <h4>Local Pickup Available</h4>
                        <p>We don't pickup available to anywhere, currently your customers' doorstep.</p>
                    </div>
                </div>
            </div>
            
            <a href="<?= BASE_URL; ?>/contact" class="btn btn-primary btn-large">Contact Support</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ SECTION -->
<section class="faq-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll" style="text-align: center; margin-bottom: 40px; color: var(--color-secondary);">Frequently Asked Questions</h2>
        <div class="faq-container animate-on-scroll">
            
            <div class="faq-item">
                <details>
                    <summary>What does LTL freight mean and when should I choose it?</summary>
                    <div class="faq-answer">
                        LTL stands for Less-Than-Truckload. It refers to the transportation of products or goods that do not require a full truckload. You should choose LTL when your freight is relatively small and can be shipped alongside other businesses' cargo, helping you save significantly on transportation costs.
                    </div>
                </details>
            </div>
            
            <div class="faq-item">
                <details>
                    <summary>What are the advantages of LTL delivery compared to full-truck-load (FTL) shipping?</summary>
                    <div class="faq-answer">
                        The primary advantage of LTL shipping is cost-efficiency. Because you share the truck's space with other shippers, you only pay for the portion of the trailer your freight occupies. It also offers more flexibility and is more environmentally friendly by consolidating shipments and reducing the number of trucks on the road.
                    </div>
                </details>
            </div>
            
            <div class="faq-item">
                <details>
                    <summary>Are there any disadvantages when it comes to LTL service?</summary>
                    <div class="faq-answer">
                        Since LTL shipments are combined with others, transit times can be slightly longer than FTL because the truck may make multiple stops to load and unload other cargo. Additional handling of the freight at terminals may also slightly increase the risk of damage, though proper packaging and our expert handling mitigate this risk.
                    </div>
                </details>
            </div>
            
            <div class="faq-item">
                <details>
                    <summary>How is the price for a less-than-truckload service calculated and what factors influence the costs?</summary>
                    <div class="faq-answer">
                        LTL pricing is primarily based on the freight class (which considers density, stowability, handling, and liability), the weight of the shipment, and the distance it needs to travel. Additional factors include fuel surcharges, any required accessorial services (like liftgates or inside delivery), and the specific origin/destination zip codes.
                    </div>
                </details>
            </div>

        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>
