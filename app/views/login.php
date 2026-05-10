<?php require_once 'layouts/header.php'; ?>

<style>
/* =========================================
   LOGIN PAGE - PREMIUM SPLIT-SCREEN DESIGN
   ========================================= */

/* Override body background for login page */
body.login-page {
    background-color: var(--color-secondary);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

body.login-page .premium-footer,
body.login-page .premium-nav {
    display: none;
}

.login-wrapper {
    display: flex;
    min-height: 100vh;
    width: 100%;
}

/* LEFT PANEL — Brand / Hero */
.login-brand-panel {
    flex: 1;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 48px;
    overflow: hidden;
    background: var(--color-secondary);
}

.login-brand-bg {
    position: absolute;
    inset: 0;
    background-image: url('https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1200&q=80');
    background-size: cover;
    background-position: center;
    filter: brightness(0.25);
    z-index: 0;
}

.login-brand-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 80%, rgba(255, 193, 7, 0.12) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.08) 0%, transparent 50%);
    z-index: 1;
}

.login-brand-top,
.login-brand-bottom {
    position: relative;
    z-index: 2;
}

.login-brand-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.login-brand-logo i {
    font-size: 2.8rem;
    color: var(--color-primary);
}

.login-brand-logo span {
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-light);
    letter-spacing: -0.5px;
}

.login-brand-logo span em {
    color: var(--color-primary);
    font-style: normal;
}

.login-brand-tagline {
    position: relative;
    z-index: 2;
    margin-top: auto;
    padding-top: 48px;
}

.login-brand-tagline h2 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    color: var(--text-light);
    line-height: 1.15;
    margin-bottom: 16px;
}

.login-brand-tagline h2 span {
    color: var(--color-primary);
}

.login-brand-tagline p {
    color: rgba(255, 255, 255, 0.55);
    font-size: 1.05rem;
    line-height: 1.6;
    max-width: 380px;
}

.login-brand-stats {
    display: flex;
    gap: 40px;
    margin-top: 40px;
}

.login-stat strong {
    display: block;
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 800;
    color: var(--color-primary);
}

.login-stat span {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.45);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* RIGHT PANEL — Form */
.login-form-panel {
    width: 480px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    padding: 48px;
}

.login-form-box {
    width: 100%;
    max-width: 380px;
}

.login-form-header {
    margin-bottom: 36px;
}

.login-form-header h1 {
    font-size: 2rem;
    color: var(--color-secondary);
    margin-bottom: 8px;
    line-height: 1.2;
}

.login-form-header p {
    color: var(--text-muted);
    font-size: 0.95rem;
}

/* Alert for errors */
.login-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border-radius: var(--radius-md);
    background: #fff1f2;
    border: 1px solid #fecdd3;
    color: #be123c;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 24px;
}

.login-alert i {
    font-size: 1.2rem;
    flex-shrink: 0;
}

/* Form fields */
.login-field {
    margin-bottom: 20px;
}

.login-field label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-secondary);
    margin-bottom: 8px;
    letter-spacing: 0.2px;
}

.login-input-wrap {
    position: relative;
}

.login-input-wrap i.field-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    color: var(--text-muted);
    pointer-events: none;
    transition: color 0.2s;
}

.login-input-wrap input {
    width: 100%;
    padding: 13px 14px 13px 42px;
    border: 1.5px solid #e2e8f0;
    border-radius: var(--radius-md);
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--color-secondary);
    background: var(--color-bg-light);
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    outline: none;
}

.login-input-wrap input:focus {
    border-color: var(--color-primary);
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.15);
}

.login-input-wrap input:focus + i.field-icon,
.login-input-wrap:focus-within i.field-icon {
    color: var(--color-primary-dark);
}

/* Password toggle */
.login-input-wrap input[type="password"] {
    padding-right: 44px;
}

.toggle-password {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    font-size: 1.2rem;
    padding: 0;
    transition: color 0.2s;
}

.toggle-password:hover {
    color: var(--color-secondary);
}

/* Submit button */
.login-submit-btn {
    width: 100%;
    padding: 14px;
    background: var(--color-secondary);
    color: var(--text-light);
    border: none;
    border-radius: var(--radius-md);
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.25s ease;
    margin-top: 8px;
    position: relative;
    overflow: hidden;
}

.login-submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--color-primary);
    transform: translateX(-100%);
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 0;
}

.login-submit-btn:hover::before {
    transform: translateX(0);
}

.login-submit-btn:hover {
    color: var(--color-secondary);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.login-submit-btn span,
.login-submit-btn i {
    position: relative;
    z-index: 1;
}

/* Divider */
.login-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 24px 0;
    color: var(--text-muted);
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.login-divider::before,
.login-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e2e8f0;
}

/* Back to site link */
.login-back-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: var(--text-muted);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
    padding: 10px;
    border-radius: var(--radius-md);
    border: 1.5px solid #e2e8f0;
    transition: all 0.2s;
}

.login-back-link:hover {
    color: var(--color-secondary);
    border-color: var(--color-secondary);
    background: var(--color-bg-light);
}

/* Responsive */
@media (max-width: 900px) {
    .login-brand-panel {
        display: none;
    }
    .login-form-panel {
        width: 100%;
        min-height: 100vh;
    }
}

@media (max-width: 480px) {
    .login-form-panel {
        padding: 32px 24px;
    }
}
</style>

<script>
// Add login-page class to body to override nav/footer display
document.body.classList.add('login-page');
</script>

<div class="login-wrapper">

    <!-- LEFT: Brand Panel -->
    <div class="login-brand-panel">
        <div class="login-brand-bg"></div>
        <div class="login-brand-pattern"></div>

        <div class="login-brand-top">
            <a href="<?= BASE_URL; ?>" class="login-brand-logo">
                <?php
                    $branding  = $settings['display_branding'] ?? 'both';
                    $hasLogo   = !empty($settings['logo']);
                ?>
                <?php if(($branding === 'logo' || $branding === 'both') && $hasLogo): ?>
                    <img src="<?= BASE_URL; ?>/public/uploads/<?= htmlspecialchars($settings['logo']); ?>"
                         alt="<?= htmlspecialchars($settings['site_name'] ?? 'TruckMania'); ?>"
                         style="height: 48px; object-fit: contain;">
                <?php endif; ?>
                <?php if($branding === 'text' || $branding === 'both' || !$hasLogo): ?>
                    <!-- <i class="ph-fill ph-truck"></i> -->
                    <span><?= htmlspecialchars($settings['site_name'] ?? 'TruckMania'); ?></span>
                <?php endif; ?>
            </a>
        </div>

        <div class="login-brand-tagline">
            <h2>Manage Your <span>Fleet Parts</span> Business</h2>
            <p>Access the admin dashboard to manage inventory, banners, testimonials, FAQs, and all site content in one place.</p>
            <div class="login-brand-stats">
                <div class="login-stat">
                    <strong>10K+</strong>
                    <span>Parts Listed</span>
                </div>
                <div class="login-stat">
                    <strong>3</strong>
                    <span>Locations</span>
                </div>
                <div class="login-stat">
                    <strong>24/7</strong>
                    <span>Support</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Login Form -->
    <div class="login-form-panel">
        <div class="login-form-box">

            <div class="login-form-header">
                <h1>Welcome Back 👋</h1>
                <p>Sign in to your admin account to continue</p>
            </div>

            <?php if(isset($error)): ?>
            <div class="login-alert">
                <i class="ph-fill ph-warning-circle"></i>
                <?= htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <form action="<?= BASE_URL; ?>/login" method="POST" id="loginForm">
                <?= csrf_field(); ?>

                <div class="login-field">
                    <label for="login-username">Username</label>
                    <div class="login-input-wrap">
                        <input
                            type="text"
                            id="login-username"
                            name="username"
                            placeholder="Enter your username"
                            value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>"
                            required
                            autocomplete="username"
                        >
                        <i class="ph ph-user field-icon"></i>
                    </div>
                </div>

                <div class="login-field">
                    <label for="login-password">Password</label>
                    <div class="login-input-wrap">
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <i class="ph ph-lock field-icon"></i>
                        <button type="button" class="toggle-password" id="togglePwd" aria-label="Toggle password visibility">
                            <i class="ph ph-eye" id="togglePwdIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-submit-btn" id="loginBtn">
                    <i class="ph-fill ph-sign-in"></i>
                    <span>Sign In to Dashboard</span>
                </button>
            </form>

            <div class="login-divider">or</div>

            <a href="<?= BASE_URL; ?>" class="login-back-link">
                <i class="ph ph-arrow-left"></i>
                Back to Main Site
            </a>

        </div>
    </div>

</div>

<script>
// Password visibility toggle
document.getElementById('togglePwd').addEventListener('click', function() {
    const input = document.getElementById('login-password');
    const icon = document.getElementById('togglePwdIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'ph ph-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'ph ph-eye';
    }
});

// Button loading state on submit
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.innerHTML = '<i class="ph ph-circle-notch" style="animation: spin 0.8s linear infinite;"></i><span>Signing In...</span>';
    btn.disabled = true;
});
</script>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<?php require_once 'layouts/footer.php'; ?>