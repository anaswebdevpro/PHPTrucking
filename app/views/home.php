<?php require_once '../app/views/layouts/header.php'; ?>

<style>
/* =========================================
   HOME PAGE SPECIFIC STYLES
   ========================================= */

/* HERO SLIDER STYLES */
.hero {
    position: relative;
    height: 100vh;
    min-height: 700px;
    background-color: var(--color-bg-dark);
    overflow: hidden;
    margin-top: -80px; /* Offset for fixed nav */
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

.hero-slide.active .hero-bg {
    animation: slowZoom 20s infinite alternate;
}

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

.slider-controls {
    position: absolute;
    bottom: 120px;
    left: auto;
    right: 50px;
    z-index: 10;
    display: flex;
    gap: 12px;
}

.slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.slider-dot.active {
    background: var(--color-primary);
    transform: scale(1.3);
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
}

.hero-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.btn-large {
    padding: 16px 36px;
    font-size: 1.1rem;
}

/* STATS / FEATURES SECTION (OVERLAPPING HERO) */
.features-section {
    position: relative;
    z-index: 10;
    margin-top: -80px;
    padding-bottom: 80px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.feature-card {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 40%, #cbd5e1 100%);
    border: 1px solid #ffffff;
    border-radius: var(--radius-md);
    padding: 30px 24px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.3), inset 0 2px 15px rgba(255,255,255,0.8);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: transform var(--transition-normal);
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-header {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
}

.feature-icon {
    width: 32px;
    height: 32px;
    color: var(--color-secondary);
    border: 1.5px solid var(--color-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.feature-card h3 {
    font-size: 1.1rem;
    color: var(--color-secondary);
    margin: 0;
    line-height: 1.3;
}

.feature-card p {
    color: #475569;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 16px;
}

.learn-more {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-secondary);
    text-transform: uppercase;
}
.learn-more:hover {
    text-decoration: underline;
}

/* CATEGORIES SECTION */
.categories-section {
    padding: 80px 0 120px;
    background-color: #ffffff;
    background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
    background-size: 24px 24px;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-top: 50px;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.category-card {
    position: relative;
    border-radius: var(--radius-md);
    overflow: hidden;
    background: var(--color-secondary);
    height: 340px;
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow-md);
}

.category-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    padding: 0;
    transition: transform 0.4s ease;
}

.category-card:hover .category-img {
    transform: scale(1.05);
}

.category-title-bar {
    background: #0f1524;
    padding: 16px 20px;
    margin-top: auto;
}

.category-title-bar h3 {
    color: #ffffff;
    font-size: 1.2rem;
    margin: 0;
    text-align: left;
}

.category-number {
    font-family: var(--font-heading);
    font-size: 3rem;
    font-weight: 800;
    color: transparent;
    -webkit-text-stroke: 1px rgba(255,255,255,0.4);
    position: absolute;
    top: 24px;
    right: 24px;
    line-height: 1;
    transition: all 0.4s ease;
}

.category-card:hover .category-number {
    color: var(--color-primary);
    -webkit-text-stroke: 0px;
    transform: translateY(-5px);
}

.category-content h3 {
    color: var(--text-light);
    font-size: 1.6rem;
    margin-bottom: 8px;
    transform: translateY(20px);
    transition: transform 0.4s ease;
}

.category-content p {
    color: rgba(255,255,255,0.7);
    font-size: 1rem;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.category-card:hover .category-content h3 {
    transform: translateY(0);
}

.category-card:hover .category-content p {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.1s;
}

/* PREMIUM CTA SECTION */
.cta-premium {
    position: relative;
    padding: 100px 0;
    background: var(--color-secondary);
    overflow: hidden;
}

.cta-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 20px 20px, rgba(255, 193, 7, 0.05) 2px, transparent 0);
    background-size: 40px 40px;
    opacity: 0.5;
}

.cta-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.cta-content h2 {
    color: var(--text-light);
    font-size: 3rem;
    margin-bottom: 24px;
}

.cta-content p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.25rem;
    margin-bottom: 40px;
}

/* BRAND LOGOS MARQUEE */
.brands-section {
    padding: 60px 0;
    background: var(--color-bg-light);
    border-bottom: 1px solid #e2e8f0;
    overflow: hidden;
}

.brands-title {
    text-align: center;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--text-muted);
    margin-bottom: 30px;
    font-weight: 600;
}

.marquee-container {
    width: 100%;
    display: flex;
    overflow: hidden;
}

.marquee-content {
    display: flex;
    align-items: center;
    gap: 80px;
    animation: marquee 30s linear infinite;
    padding-right: 80px;
}

.marquee-content h4 {
    font-size: 1.5rem;
    color: #94a3b8;
    white-space: nowrap;
    transition: color 0.3s;
}

.marquee-content h4:hover {
    color: var(--color-secondary);
}

@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* SUPPORT SECTION - FULL BLEED BACKGROUND */
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
    .support-section {
        min-height: auto;
    }
    .support-bg {
        display: none;
    }
    .support-overlay {
        background: var(--color-bg-dark);
    }
    .support-inner {
        justify-content: center;
    }
    .support-content {
        max-width: 100%;
    }
}

/* TESTIMONIALS SECTION - NEW LAYOUT */
.testimonials-section {
    padding: 100px 0;
    background: #111424; 
    position: relative;
    overflow: hidden;
}

.test-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 50px;
}

.test-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    min-height: 550px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    transition: transform 0.3s ease;
}

.test-card:hover {
    transform: translateY(-5px);
}

.test-bg-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 65%;
    object-fit: cover;
    z-index: 1;
}

.test-gradient {
    position: absolute;
    inset: 0;
    z-index: 2;
}

.test-content {
    position: relative;
    z-index: 3;
    padding: 40px 24px 24px;
    display: flex;
    flex-direction: column;
    margin-top: auto;
}

.test-author {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.test-avatar-icon {
    width: 32px;
    height: 32px;
    background: #ffffff;
    color: var(--color-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.test-author-text h4 {
    color: #ffffff;
    font-size: 0.95rem;
    font-weight: 700;
    margin: 0;
}

.test-author-text p {
    color: rgba(255,255,255,0.7);
    font-size: 0.85rem;
    margin: 0;
}

.test-quote {
    color: #ffffff;
    font-size: 1.4rem;
    line-height: 1.3;
    font-weight: 700;
    margin: 0 0 30px 0;
}

.test-read-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 14px;
    background: rgba(255,255,255,0.08);
    color: #ffffff;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: background 0.2s ease;
    margin-top: auto;
}

.test-read-btn:hover {
    background: rgba(255,255,255,0.15);
}

@media (max-width: 1024px) {
    .test-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .test-grid {
        grid-template-columns: 1fr;
    }
}

/* FAQ SECTION */
.faq-section {
    padding: 100px 0;
    background: var(--color-bg-dark);
}

.faq-section .section-title {
    color: var(--text-light);
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    margin-bottom: 16px;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-md);
    overflow: hidden;
}

.faq-item details {
    width: 100%;
}

.faq-item summary {
    padding: 20px 24px;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--color-secondary);
    background: var(--color-surface);
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background var(--transition-fast);
}

.faq-item summary::-webkit-details-marker {
    display: none;
}

.faq-item summary:after {
    content: '\25BC';
    font-size: 0.9rem;
    color: var(--color-primary);
    transition: transform var(--transition-normal);
}

.faq-item details[open] summary:after {
    transform: rotate(180deg);
}

.faq-item details[open] summary {
    color: var(--text-light);
    background: var(--color-surface-dark);
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.faq-answer {
    padding: 24px;
    background: var(--color-surface-dark);
    color: var(--text-muted);
    line-height: 1.6;
    font-size: 1.05rem;
}

/* TIMELINE SECTION */
.timeline-section {
    padding: 100px 0;
    background: #ffffff;
    text-align: center;
}

.timeline-section h2 {
    font-size: 2rem;
    color: var(--color-secondary);
    margin-bottom: 12px;
}

.timeline-section p {
    color: var(--text-muted);
    font-size: 1rem;
    margin-bottom: 60px;
}

.timeline-container {
    position: relative;
    max-width: 1000px;
    margin: 60px auto 60px;
    height: 300px;
}

.timeline-line {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 2px;
    background: #e2e8f0;
    margin-top: -1px;
    z-index: 1;
    display: block;
}

.timeline-grid {
    display: flex;
    justify-content: space-between;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    z-index: 2;
}

.timeline-item {
    position: relative;
    width: 20%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.timeline-dot {
    width: 12px;
    height: 12px;
    background: var(--color-primary);
    border-radius: 50%;
    box-shadow: 0 0 0 4px #ffffff, 0 0 0 5px var(--color-primary);
    z-index: 5;
}

.t-content {
    position: absolute;
    width: 200px;
    text-align: center;
    left: 50%;
    transform: translateX(-50%);
    background: #ffffff;
    padding: 10px;
}

.top-text .t-content {
    bottom: 30px;
}

.bottom-text .t-content {
    top: 30px;
}

.t-content h4 {
    font-size: 0.95rem;
    color: var(--color-secondary);
    margin-bottom: 6px;
    font-weight: 700;
}

.t-content p {
    font-size: 0.75rem;
    color: #64748b;
    line-height: 1.4;
}

@media (max-width: 768px) {
    .support-grid {
        grid-template-columns: 1fr;
    }
    .testimonial-card {
        min-width: 300px;
    }
    .timeline-container { display: none; }
}

/* AL FEATURE SECTION */
.al-feature-section {
    margin: 10vh 0;
    position: relative;
    width: 100%;
    min-height: 800px;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 60px 0;
}

.al-feature-bg-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    clip-path: polygon(35% 0, 85% 0, 100% 50%, 85% 100%, 35% 100%, 50% 50%);
    z-index: 1;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);  
}

.al-feature-bg {
    position: absolute;
    top: -5%;
    left: -5%;
    width: 110%;
    height: 110%;
    background-image: url('<?= BASE_URL; ?>/public/uploads/road.png');
    background-size: cover;
    background-position: center;
    /* opacity: 0.4; */
    animation: alSlowZoom 25s infinite alternate ease-in-out;
}

.al-feature-truck-3d {
    position: absolute;
    top: 50%;
    left: 68%;
    transform: translate(-50%, -45%);
    width: 55%;
    max-width: 900px;
    z-index: 2;
    filter: drop-shadow(-20px 30px 25px rgba(0,0,0,0.5));
    opacity: 0;
    animation: alTruckEntrance 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards, alTruckPopOut 6s ease-in-out infinite 1.5s;
    pointer-events: none;
}

@keyframes alTruckEntrance {
    from {
        opacity: 0;
        transform: translate(-30%, -45%) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -45%) scale(1);
    }
}

@keyframes alTruckPopOut {
    0%, 100% { transform: translate(-50%, -45%) scale(1); filter: drop-shadow(-20px 30px 25px rgba(0,0,0,0.5)); }
    50% { transform: translate(-50%, -48%) scale(1.02); filter: drop-shadow(-30px 40px 35px rgba(0,0,0,0.35)); }
}

@keyframes alSlowZoom {
    0% { transform: scale(1); }
    100% { transform: scale(1.15); }
}

@keyframes alFadeUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.al-animate-fade {
    opacity: 0;
    transform: translateY(40px);
}

.al-animate-fade.visible {
    animation: alFadeUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.al-delay-1 { animation-delay: 0.15s; }
.al-delay-2 { animation-delay: 0.3s; }

.al-feature-container {
    position: relative;
    z-index: 3;
    width: 100%;
    max-width: 1400px;
    margin: 10px auto;
    display: flex;
    justify-content: space-between;
    height: 80vh;
    padding: 0 24px;
    pointer-events: none;
}

.al-left, .al-right {
    pointer-events: auto;
    display: flex;
    flex-direction: column;
}

.al-left {
    width: 35%;
    padding-top: 20px;
    padding-bottom: 20px;
}

.al-right {
    width: 25%;
    align-items: flex-end;
    padding-top: 20px;
    padding-bottom: 20px;
    justify-content: space-between;
}

.al-logo {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 1.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 120px;
    letter-spacing: 2px;
}

.al-logo i {
    color: #387b8f;
    font-size: 1.4rem;
}

.al-text-content {
    margin-bottom: 80px;
}

.al-title {
    color: #387b8f;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.al-subtitle {
    color: #64748b;
    font-size: 1.25rem;
    margin-bottom: 10px;
}

.al-heading {
    font-size: 3.5rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
    margin-bottom: 30px;
    letter-spacing: -1px;
    text-transform: uppercase;
}

.al-desc {
    color: #64748b;
    font-size: 0.95rem;
    line-height: 1.8;
    max-width: 95%;
}

.al-desc strong {
    color: #0f172a;
    font-weight: 600;
}

.al-links {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: auto;
}

.al-link-item {
    display: inline-flex;
    align-items: center;
    gap: 16px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #64748b;
    letter-spacing: 2px;
    cursor: pointer;
    transition: color 0.3s;
    width: fit-content;
}

.al-link-item:hover {
    color: #387b8f;
}

.al-link-item .al-line {
    width: 30px;
    height: 1px;
    background-color: #cbd5e1;
    transition: width 0.3s, background-color 0.3s;
}

.al-link-item:hover .al-line {
    width: 45px;
    background-color: #387b8f;
}

.al-menu-icon {
    display: flex;
    flex-direction: column;
    gap: 6px;
    cursor: pointer;
    padding: 10px;
}

.al-menu-icon span {
    display: block;
    width: 30px;
    height: 2px;
    background-color: #64748b;
    transition: width 0.3s, background-color 0.3s;
}

.al-menu-icon span:last-child {
    width: 20px;
    align-self: flex-end;
}

.al-menu-icon:hover span {
    background-color: #0f172a;
}
.al-menu-icon:hover span:last-child {
    width: 30px;
}

.al-nav-links {
    display: flex;
    flex-direction: column;
    gap: 40px;
    margin-top: auto;
    margin-bottom: 120px;
}

.al-nav-item {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 16px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #94a3b8;
    letter-spacing: 2px;
    cursor: pointer;
    transition: color 0.3s;
}

.al-nav-item:hover {
    color: #1e293b;
}

.al-nav-item .al-line {
    width: 30px;
    height: 1px;
    background-color: #e2e8f0;
    transition: width 0.3s, background-color 0.3s;
}

.al-nav-item:hover .al-line {
    width: 45px;
    background-color: #1e293b;
}

.al-copyright {
    font-size: 0.7rem;
    color: #94a3b8;
    text-align: right;
    letter-spacing: 0.5px;
}

@media (max-width: 1024px) {
    .al-feature-section {
        flex-direction: column;
        padding: 100px 0 40px;
    }
    .al-feature-bg-wrapper {
        clip-path: none;
        opacity: 0.05;
    }
    .al-feature-truck-3d {
        position: relative;
        top: 0;
        left: 0;
        transform: none;
        width: 90%;
        animation: none;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
        margin: 20px auto;
        opacity: 1;
    }
    .al-feature-container {
        flex-direction: column;
        justify-content: flex-start;
        padding: 40px 24px;
        height: auto;
    }
    .al-left {
        width: 100%;
        margin-bottom: 40px;
    }
    .al-right {
        width: 100%;
        align-items: flex-start;
        padding-top: 0;
    }
    .al-nav-item {
        justify-content: flex-start;
        flex-direction: row-reverse;
    }
    .al-copyright {
        text-align: left;
        margin-top: 40px;
    }
    .al-menu-icon {
        display: none;
    }
}
</style>

<!-- HERO SECTION -->
<section class="hero">
    <?php if(!empty($banners)): ?>
        <?php foreach($banners as $index => $banner): ?>
            <div class="hero-slide <?= $index === 0 ? 'active' : '' ?>">
                <?php 
                    $heroMedia = !empty($banner['image']) ? $banner['image'] : 'engine_hero_bg.png';
                    $mediaSrc = (strpos($heroMedia, 'http') === 0) ? $heroMedia : BASE_URL.'/public/uploads/'.$heroMedia;
                    $mediaExt = strtolower(pathinfo($heroMedia, PATHINFO_EXTENSION));
                    $isVideo = in_array($mediaExt, ['mp4', 'webm', 'ogg']);
                ?>
                <?php if($isVideo): ?>
                    <video class="hero-video" autoplay muted loop playsinline>
                        <source src="<?= htmlspecialchars($mediaSrc); ?>" type="video/<?= $mediaExt; ?>">
                    </video>
                <?php else: ?>
                    <div class="hero-bg" style="background-image: url('<?= htmlspecialchars($mediaSrc); ?>');"></div>
                <?php endif; ?>
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="ph-fill ph-star"></i>
                        Top Rated Trasport Services                            
                    </div>
                    <h1><?= htmlspecialchars($banner['title']); ?></h1>
                    <p><?= nl2br(htmlspecialchars($sections['hero']['content'] ?? 'Your trusted source for premium heavy-duty semi truck and trailer parts.')); ?></p>
                    <div class="hero-actions">
                        <a href="<?= BASE_URL; ?>/parts" class="btn btn-primary btn-large">Browse Parts</a>
                        <a href="<?= BASE_URL; ?>/quote" class="btn btn-outline btn-large">Get a Quote</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if(count($banners) > 1): ?>
        <div class="slider-controls">
            <?php foreach($banners as $index => $banner): ?>
                <button class="slider-dot <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>" aria-label="Go to slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    <?php elseif(count($banners) > 0): ?>
        <!-- Single fallback using banners -->
        <div class="hero-slide active">
            <?php 
                $heroMedia = !empty($banners[0]['image']) ? $banners[0]['image'] : 'engine_hero_bg.png';
                $mediaSrc = (strpos($heroMedia, 'http') === 0) ? $heroMedia : BASE_URL.'/public/uploads/'.$heroMedia;
                $mediaExt = strtolower(pathinfo($heroMedia, PATHINFO_EXTENSION));
                $isVideo = in_array($mediaExt, ['mp4', 'webm', 'ogg']);
            ?>
            <?php if($isVideo): ?>
                <video class="hero-video" autoplay muted loop playsinline>
                    <source src="<?= htmlspecialchars($mediaSrc); ?>" type="video/<?= $mediaExt; ?>">
                </video>
            <?php else: ?>
                <div class="hero-bg" style="background-image: url('<?= htmlspecialchars($mediaSrc); ?>');"></div>
            <?php endif; ?>
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="ph-fill ph-star"></i>
                    Top Rated Transport Service
                </div>
                <h1><?= htmlspecialchars($banners[0]['title']); ?></h1>
                <p><?= nl2br(htmlspecialchars($banners[0]['subtitle'] ?? 'Your trusted source for premium heavy-duty semi truck and trailer parts.')); ?></p>
                <div class="hero-actions">
                    <a href="<?= BASE_URL; ?>/parts" class="btn btn-primary btn-large">Browse Parts</a>
                    <a href="<?= BASE_URL; ?>/quote" class="btn btn-outline btn-large">Get a Quote</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Hero Slider Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    const slideInterval = 6000; // 6 seconds per slide
    let timer;

    if(slides.length <= 1) return; // No need for slider if only 1 slide

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        if(dots.length) dots[currentSlide].classList.remove('active');
        
        currentSlide = index;
        
        slides[currentSlide].classList.add('active');
        if(dots.length) dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        goToSlide(next);
    }

    function startTimer() {
        timer = setInterval(nextSlide, slideInterval);
    }

    function resetTimer() {
        clearInterval(timer);
        startTimer();
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            goToSlide(index);
            resetTimer();
        });
    });

    startTimer();
});
</script>

<!-- FEATURES SECTION (Overlapping Hero) -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <div class="feature-header">
                    <div class="feature-icon"><i class="ph ph-shield-check"></i></div>
                    <h3>SUPERIOR COMPONENT<br>QUALITY</h3>
                </div>
                <p>Top-tier components built to last. Trusted OEM-grade and aftermarket options to meet different fleet budgets and timelines.</p>
                <a href="#" class="learn-more">Learn More &gt;</a>
            </div>
            <div class="feature-card animate-on-scroll" style="transition-delay: 0.1s;">
                <div class="feature-header">
                    <div class="feature-icon"><i class="ph ph-clock"></i></div>
                    <h3>INSTANT PART<br>VISIBILITY</h3>
                </div>
                <p>Over 10,000 fast-moving wear items and specialized components always in stock with real-time tracking across our 3 locations.</p>
                <a href="#" class="learn-more">Learn More &gt;</a>
            </div>
            <div class="feature-card animate-on-scroll" style="transition-delay: 0.2s;">
                <div class="feature-header">
                    <div class="feature-icon"><i class="ph ph-wrench"></i></div>
                    <h3>EXPERT APPLICATION<br>ENGINE</h3>
                </div>
                <p>Share your VIN, unit number, or part number and our team will verify the correct match. No guesswork, no returns.</p>
                <a href="#" class="learn-more">Learn More &gt;</a>
            </div>
        </div>
    </div>
</section>


<!-- BRANDS MARQUEE -->
<section class="brands-section">
    <div class="container">
        <div class="brands-title">Trusted Brands We Carry</div>
    </div>
    <div class="marquee-container">
        <div class="marquee-content">
            <!-- Duplicated for seamless loop -->
            <h4>CUMMINS</h4>
            <h4>PETERBILT</h4>
            <h4>KENWORTH</h4>
            <h4>FREIGHTLINER</h4>
            <h4>VOLVO</h4>
            <h4>MACK</h4>
            <h4>BENDIX</h4>
            <h4>MERITOR</h4>
            
            <h4>CUMMINS</h4>
            <h4>PETERBILT</h4>
            <h4>KENWORTH</h4>
            <h4>FREIGHTLINER</h4>
            <h4>VOLVO</h4>
            <h4>MACK</h4>
            <h4>BENDIX</h4>
            <h4>MERITOR</h4>
        </div>
    </div>
</section>

<!-- CATEGORIES SECTION -->
<section class="categories-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Services We Offer</h2>
        <div class="categories-grid">
            
            <div class="category-card animate-on-scroll">
                <img src="<?= BASE_URL; ?>/public/uploads/medium-shot-man-carrying-box.jpg" alt="Engine & Drivetrain" class="category-img">
                <div class="category-title-bar">
                    <h3>Storage Service</h3>
                </div>
            </div>
            
            <div class="category-card animate-on-scroll" style="transition-delay: 0.1s;">
                <img src="<?= BASE_URL; ?>/public/uploads/refrigerated-controlled-transport.jpg" alt="Brakes & Wheel End" class="category-img">
                <div class="category-title-bar">
                    <h3>Refrigerated Controlled Transport</h3>
                </div>
            </div>

            <div class="category-card animate-on-scroll" style="transition-delay: 0.2s;">
                <img src="<?= BASE_URL; ?>/public/uploads/ftl-transportation.jpg" alt="Suspension & Chassis" class="category-img">
                <div class="category-title-bar">
                    <h3>Flatbed Trucking</h3>
                </div>
            </div>
            
            <div class="category-card animate-on-scroll" style="transition-delay: 0.3s;">
                <img src="<?= BASE_URL; ?>/public/uploads/flatbed-trucking.jpg" alt="Lighting & Electrical" class="category-img">
                <div class="category-title-bar">
                    <h3>LIGHTING & ELECTRICAL</h3>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SUPPORT SECTION -->
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

<!-- AL FEATURE SECTION -->
<section class="al-feature-section">
    <div class="al-feature-bg-wrapper">
        <div class="al-feature-bg"></div>
    </div>
    
    <!-- 3D Pop-out Truck Image -->
    <img src="<?= BASE_URL; ?>/public/uploads/feature_truck.png" class="al-feature-truck-3d" alt="Premium Truck Logistics">

    <div class="al-feature-container">
        <!-- Left Side -->
        <div class="al-left">
            <!-- <div class="al-logo al-animate-fade">
                <i class="ph-fill ph-truck"></i> Transportation corporation of canada
            </div> -->
            <div class="al-text-content al-animate-fade al-delay-1">
                <h3 class="al-title">Seamless logistics</h3>
                <p class="al-subtitle">and secure warehousing for</p>
                <h2 class="al-heading">your supply chain.</h2>
                <p class="al-desc">
                    Transportation corporation of canada provides comprehensive transportation and warehouse services across North America. Our dedicated team ensures your freight is handled with efficiency and care, offering end-to-end logistics solutions tailored to your business needs.
                </p>
            </div>
            <div class="al-links al-animate-fade al-delay-2">
                <div class="al-link-item"><span class="al-line"></span> OUR SERVICES</div>
                <div class="al-link-item"><span class="al-line"></span> WAREHOUSE LOCATIONS</div>
            </div>
        </div>
        
        <!-- Right Side -->
        <div class="al-right">
            <div class="al-menu-icon al-animate-fade">
                <span></span>
                <span></span>
            </div>
            <!-- <div class="al-nav-links al-animate-fade al-delay-1">
                <div class="al-nav-item">OUR OFFICES <span class="al-line"></span></div>
                <div class="al-nav-item">NEWS <span class="al-line"></span></div>
                <div class="al-nav-item">CAREERS <span class="al-line"></span></div>
            </div>
            <div class="al-copyright al-animate-fade al-delay-2">
                &copy; Transportation corporation of canada Transportation &nbsp;|&nbsp; Terms & Legal
            </div> -->
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const alObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                alObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.al-animate-fade').forEach(el => alObserver.observe(el));
});
</script>

<!-- IMMERSIVE TRUCK SECTION -->
<?php include __DIR__ . '/components/immersive-truck.php'; ?>

<!-- TIMELINE SECTION -->
<section class="timeline-section">
    <div class="container">
        <h2 class="animate-on-scroll">FROM THE FOUNDRY TO THE ROAD</h2>
        <p class="animate-on-scroll">Tracking quality in the essential early formation that puts your part quality to more automated and testability to the road.</p>
        
        <div class="timeline-container animate-on-scroll">
            <div class="timeline-line"></div>
            <div class="timeline-grid">
                
                <div class="timeline-item top-text">
                    <div class="t-content">
                        <h4>Overkum Service</h4>
                        <p>We work responsibly from casting and hardbase materials onwards.</p>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item bottom-text">
                    <div class="timeline-dot"></div>
                    <div class="t-content">
                        <h4>Air Quality</h4>
                        <p>The best air quality automation and discoverable tested traits.</p>
                    </div>
                </div>

                <div class="timeline-item top-text">
                    <div class="t-content">
                        <h4>Quality Past Quality</h4>
                        <p>Our standards foster outstanding execution for your unique quality.</p>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item bottom-text">
                    <div class="timeline-dot"></div>
                    <div class="t-content">
                        <h4>Conscionable to the Road</h4>
                        <p>We test conscious profiling that aligns fun non-combustible profiles on our brakes.</p>
                    </div>
                </div>

                <div class="timeline-item top-text">
                    <div class="t-content">
                        <h4>Steel Quality</h4>
                        <p>We test affirmations with high-quality and tested road-wear quality.</p>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SECTION -->
<?php if(!empty($testimonials)): ?>
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll" style="color: var(--text-light); margin-bottom: 10px;">Perfect fit for every journey</h2>
        <p class="section-subtitle animate-on-scroll" style="color: rgba(255,255,255,0.7); text-align: center; max-width: 800px; margin: 0 auto 50px; font-size: 1.1rem; line-height: 1.6;">
            Whether you work solo, with clients or with a team. Transportation Corporation of Canada is incredibly flexible to fit your unique needs. Check out our partners showcased below for example, they all do a different kind of work in their own unique ways.
        </p>

        <div class="test-grid animate-on-scroll">
            <?php foreach(array_slice($testimonials, 0, 3) as $index => $testimonial): ?>
            <?php 
                $avatarImg = $testimonial['avatar'] ?: 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?auto=format&fit=crop&w=600&q=80'; 
                $imgSrc = (strpos($avatarImg, 'http') === 0) ? $avatarImg : BASE_URL.'/public/uploads/'.$avatarImg;
                
                $colors = ['#1e2335', '#5a2a3b', '#6b4e3d'];
                $bgColor = $colors[$index % 3];
            ?>
            <div class="test-card" style="background-color: <?= $bgColor; ?>;">
                <img src="<?= htmlspecialchars($imgSrc); ?>" alt="Customer" class="test-bg-img">
                <div class="test-gradient" style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.4) 35%, <?= $bgColor; ?> 65%, <?= $bgColor; ?> 100%);"></div>
                
                <div class="test-content">
                    <div class="test-author">
                        <div class="test-avatar-icon">
                            <i class="ph-fill ph-user"></i>
                        </div>
                        <div class="test-author-text">
                            <h4><?= htmlspecialchars($testimonial['author_name']); ?></h4>
                            <p><?= htmlspecialchars($testimonial['author_role']); ?></p>
                        </div>
                    </div>
                    
                    <h3 class="test-quote">"<?= htmlspecialchars($testimonial['content']); ?>"</h3>
                    
                    <a href="#" class="test-read-btn">Read Story <i class="ph ph-arrow-up-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>



<!-- CALL TO ACTION -->
<?php if(isset($cta_section) && $cta_section['is_active']): ?>
<section class="cta-premium">
    <div class="cta-pattern"></div>
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2><?= htmlspecialchars($cta_section['title']); ?></h2>
            <p><?= nl2br(htmlspecialchars($cta_section['content'])); ?></p>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone'] ?? '+18005550199'); ?>" class="btn btn-primary btn-large">
                <i class="ph-fill ph-phone-call"></i> Call Us Now: <?= htmlspecialchars($settings['phone'] ?? '1-800-555-0199'); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ SECTION -->
<?php if(!empty($faqs)): ?>
<section class="faq-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Frequently Asked Questions</h2>
        <div class="faq-container animate-on-scroll">
            
            <?php foreach($faqs as $faq): ?>
            <div class="faq-item">
                <details>
                    <summary><?= htmlspecialchars($faq['question']); ?></summary>
                    <div class="faq-answer">
                        <?= nl2br(htmlspecialchars($faq['answer'])); ?>
                    </div>
                </details>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- Immersive Truck Script -->
<script src="<?= BASE_URL; ?>/public/assets/js/immersive-truck.js" data-base-url="<?= BASE_URL; ?>" defer></script>

<?php require_once '../app/views/layouts/footer.php'; ?>