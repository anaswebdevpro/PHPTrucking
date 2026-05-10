/**
 * Immersive Truck — Cinematic Scroll-Driven Frame Animation
 * Apple-style sticky canvas with scroll-linked frame sequencing
 */

(function () {
    'use strict';

    /* ---- CONFIGURATION ---- */
    const CONFIG = {
        frameCount: 192,
        framePath: (function () {
            const scripts = document.querySelectorAll('script[data-base-url]');
            const baseUrl = scripts.length
                ? scripts[scripts.length - 1].getAttribute('data-base-url')
                : '';
            return baseUrl + '/public/assets/frames/ezgif-frame-';
        })(),
        frameExtension: '.jpg',
        sectionSelector: '#immersive-truck',
        canvasSelector: '#immersive-canvas',
        overlays: [
            { start: 0.00, end: 0.18 },
            { start: 0.28, end: 0.48 },
            { start: 0.55, end: 0.75 },
            { start: 0.82, end: 0.97 },
        ],
    };

    /* ---- STATE ---- */
    let images = [];
    let loadedCount = 0;
    let currentFrame = -1;
    let canvas, ctx;
    let section;
    let ticking = false;
    let isReady = false;

    /* ---- HELPERS ---- */
    function padFrame(num) {
        return String(num).padStart(3, '0');
    }

    function getFramePath(index) {
        return CONFIG.framePath + padFrame(index + 1) + CONFIG.frameExtension;
    }

    function lerp(a, b, t) {
        return a + (b - a) * t;
    }

    /* ---- PRELOAD FRAMES ---- */
    function preloadFrames() {
        const loaderBar = document.querySelector('.immersive-loader-bar');
        const loader = document.querySelector('.immersive-loader');

        for (let i = 0; i < CONFIG.frameCount; i++) {
            const img = new Image();
            img.src = getFramePath(i);
            img.onload = img.onerror = function () {
                loadedCount++;
                const progress = (loadedCount / CONFIG.frameCount) * 100;
                if (loaderBar) {
                    loaderBar.style.width = progress + '%';
                }
                if (loadedCount >= CONFIG.frameCount) {
                    isReady = true;
                    if (loader) loader.classList.add('is-loaded');
                    drawFrame(0);
                    onScroll();
                }
            };
            images[i] = img;
        }
    }

    /* ---- DRAW FRAME ---- */
    function drawFrame(index) {
        index = Math.max(0, Math.min(CONFIG.frameCount - 1, index));
        if (index === currentFrame) return;
        currentFrame = index;

        const img = images[index];
        if (!img || !img.complete || !img.naturalWidth) return;

        const cw = canvas.width;
        const ch = canvas.height;
        const iw = img.naturalWidth;
        const ih = img.naturalHeight;

        // Cover — maintain aspect ratio
        const scale = Math.max(cw / iw, ch / ih);
        const dw = iw * scale;
        const dh = ih * scale;
        const dx = (cw - dw) / 2;
        const dy = (ch - dh) / 2;

        ctx.clearRect(0, 0, cw, ch);
        ctx.drawImage(img, dx, dy, dw, dh);
    }

    /* ---- RESIZE CANVAS ---- */
    function resizeCanvas() {
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        canvas.width = window.innerWidth * dpr;
        canvas.height = window.innerHeight * dpr;
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        ctx.setTransform(1, 0, 0, 1, 0, 0); // reset transforms
        if (currentFrame >= 0) {
            currentFrame = -1; // force redraw
            drawFrame(Math.max(0, currentFrame));
        }
    }

    /* ---- SCROLL HANDLER ---- */
    function onScroll() {
        if (!isReady) return;
        if (ticking) return;

        ticking = true;
        requestAnimationFrame(function () {
            ticking = false;
            updateScene();
        });
    }

    function updateScene() {
        const rect = section.getBoundingClientRect();
        const sectionHeight = section.offsetHeight - window.innerHeight;
        const scrolled = -rect.top;
        const progress = Math.max(0, Math.min(1, scrolled / sectionHeight));

        // Frame
        const frameIndex = Math.round(progress * (CONFIG.frameCount - 1));
        drawFrame(frameIndex);

        // Overlays
        const overlayEls = section.querySelectorAll('.immersive-overlay');
        const progressDots = section.querySelectorAll('.immersive-progress-dot');
        const scrollHint = section.querySelector('.immersive-scroll-hint');

        overlayEls.forEach(function (el, i) {
            const cfg = CONFIG.overlays[i];
            if (!cfg) return;

            const mid = (cfg.start + cfg.end) / 2;
            const fadeIn = cfg.start;
            const peakStart = lerp(cfg.start, mid, 0.6);
            const peakEnd = lerp(mid, cfg.end, 0.4);
            const fadeOut = cfg.end;

            let opacity = 0;
            if (progress >= fadeIn && progress <= peakStart) {
                opacity = (progress - fadeIn) / (peakStart - fadeIn);
            } else if (progress > peakStart && progress < peakEnd) {
                opacity = 1;
            } else if (progress >= peakEnd && progress <= fadeOut) {
                opacity = 1 - (progress - peakEnd) / (fadeOut - peakEnd);
            }

            el.style.opacity = opacity.toFixed(3);
            el.style.transform = 'translateY(' + ((1 - opacity) * 20).toFixed(1) + 'px)';
        });

        // Progress dots
        progressDots.forEach(function (dot, i) {
            const cfg = CONFIG.overlays[i];
            if (!cfg) return;
            const active = progress >= cfg.start && progress <= cfg.end;
            dot.classList.toggle('is-active', active);
        });

        // Scroll hint
        if (scrollHint) {
            scrollHint.classList.toggle('is-hidden', progress > 0.05);
        }
    }

    /* ---- INIT ---- */
    function init() {
        section = document.querySelector(CONFIG.sectionSelector);
        canvas = document.querySelector(CONFIG.canvasSelector);
        if (!section || !canvas) return;

        ctx = canvas.getContext('2d');

        resizeCanvas();
        preloadFrames();

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', function () {
            resizeCanvas();
            if (isReady) {
                const idx = currentFrame;
                currentFrame = -1;
                drawFrame(idx);
            }
        });
    }

    /* ---- DOM READY ---- */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
