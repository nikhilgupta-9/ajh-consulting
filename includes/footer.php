<?php
/**
 * Shared footer + scripts, included at the bottom of every public page.
 * Professional corporate-style footer: company info, quick links,
 * audience selector, contact details, latest insights, and a bottom
 * bar with country selector, legal links and social icons.
 */

$settings = site_settings();
$waLink = $settings['whatsapp_url'] ?: whatsapp_link($settings['whatsapp_number']);
$currentPage = $currentPage ?? basename($_SERVER['SCRIPT_NAME']);
$isBranchLocked = $isBranchLocked ?? (bool) preg_match('#/(nz|au)/#', parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '');

$recentPosts = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->query(
            "SELECT title, slug, image, created_at FROM blog_posts
             WHERE status = 'published' ORDER BY created_at DESC LIMIT 2"
        );
        $recentPosts = $stmt->fetchAll();
    } catch (Throwable $e) {
        $recentPosts = [];
    }
}

$socialLinks = array_filter([
    'facebook' => [$settings['facebook_url'] ?: 'https://www.facebook.com/', 'fa-facebook-f'],
    'twitter' => [$settings['twitter_url'] ?: 'https://twitter.com/', 'fa-twitter'],
    'instagram' => [$settings['instagram_url'] ?: 'https://www.instagram.com/', 'fa-instagram'],
    'linkedin' => [$settings['linkedin_url'] ?: 'https://www.linkedin.com/', 'fa-linkedin-in'],
    'youtube' => [$settings['youtube_url'] ?: 'https://www.youtube.com/', 'fa-youtube'],
], fn($s) => !empty($s[0]));
?>
<footer class="site-footer">

    <!-- top: brand, tagline, socials -->
    <div class="site-footer-top">
        <div class="container">
            <a href="<?php echo site_url("index.php"); ?>" class="site-footer-logo">
                <img src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>"
                    alt="<?php echo e($settings['company_name'] ?: APP_NAME); ?>">
            </a>
            <p class="site-footer-tagline"><?php echo e($settings['tagline'] ?: (APP_NAME . ' helps businesses grow with clear, practical accounting, tax and consulting advice.')); ?></p>
            
        </div>
    </div>

    <!-- main footer body -->
    <div class="site-footer-main">
        <div class="container">
            <div class="site-footer-grid">

                <!-- for accounting firms -->
                <details class="site-footer-col" open>
                    <summary><h4>For Accounting Firms</h4></summary>
                    <ul>
                        <li><a href="<?php echo site_url("nz/accounting-firm/"); ?>">Firm Outsourcing Support</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=bookkeeping-reconciliations"); ?>">White-Label Bookkeeping Pods</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=year-end-workpapers"); ?>">Year-End Workpaper Production</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=tax-gst-preparation"); ?>">Tax Return &amp; GST Preparation</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=payroll-support"); ?>">Practice Payroll Support</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=management-reporting"); ?>">Virtual CFO Advisory</a></li>
                    </ul>
                </details>

                <!-- for businesses -->
                <details class="site-footer-col" open>
                    <summary><h4>For Businesses</h4></summary>
                    <ul>
                        <li><a href="<?php echo site_url("nz/accounting/"); ?>">Accounting &amp; Bookkeeping</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=bookkeeping"); ?>">Cloud Bookkeeping &amp; Reconciliations</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=tax-returns-gst"); ?>">GST Lodgement &amp; Tax Compliance</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=payroll"); ?>">Payroll &amp; Wage Compliance</a></li>
                        <li><a href="<?php echo site_url("service-details.php?slug=business-reporting"); ?>">Cash Flow &amp; Financial Reporting</a></li>
                        <li><a href="<?php echo site_url("get-started.php"); ?>">Not sure? Get Started &rarr;</a></li>
                    </ul>
                </details>

                <!-- company & resources -->
                <details class="site-footer-col" open>
                    <summary><h4>Company &amp; Resources</h4></summary>
                    <ul>
                        <li><a href="<?php echo site_url("index.php"); ?>">Home</a></li>
                        <li><a href="<?php echo site_url("about-us.php"); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url("our-peoples.php"); ?>">Our Peoples</a></li>
                        <li><a href="<?php echo site_url("insight-resources.php"); ?>">Insight &amp; Resources</a></li>
                        <li><a href="<?php echo site_url("nz/accounting/faqs.php"); ?>">FAQs</a></li>
                    </ul>
                </details>

                <!-- get in touch -->
                <details class="site-footer-col" open>
                    <summary><h4>Contact</h4></summary>
                    <ul class="site-footer-contact">
                        <?php if ($settings['address']): ?>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo urlencode($settings['address']); ?>"
                                    target="_blank" rel="noopener"><?php echo e($settings['address']); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($settings['phone']): ?>
                            <li><i class="fas fa-phone-alt"></i> <a
                                    href="tel:<?php echo e($settings['phone']); ?>"><?php echo e($settings['phone']); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($settings['email']): ?>
                            <li><i class="fas fa-envelope"></i> <a
                                    href="mailto:<?php echo e($settings['email']); ?>"><?php echo e($settings['email']); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($waLink): ?>
                            <li><i class="fab fa-whatsapp"></i> <a href="<?php echo e($waLink); ?>" target="_blank"
                                    rel="noopener">Chat on WhatsApp</a></li>
                        <?php endif; ?>
                        <?php if ($settings['working_hours']): ?>
                            <li><i class="fas fa-clock"></i> <?php echo e($settings['working_hours']); ?></li>
                        <?php endif; ?>
                    </ul>
                    <?php if (!empty($socialLinks)): ?>
                        <div class="site-footer-social site-footer-contact-social">
                            <?php foreach ($socialLinks as $meta): ?>
                                <a href="<?php echo e($meta[0]); ?>" target="_blank" rel="noopener"
                                    aria-label="<?php echo e(ucfirst($meta[1])); ?>"><i
                                        class="fab <?php echo e($meta[1]); ?>"></i></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </details>

            </div>

            
        </div>
    </div>

    <!-- bottom bar -->
    <div class="site-footer-bottom">
        <div class="container">
            <div class="site-footer-bottom-inner">
                <p class="site-footer-copyright">&copy; <span class="current-year"></span>
                    <?php echo e($settings['copyright_text'] ?: (APP_NAME . '. All rights reserved.')); ?></p>

                <div class="site-footer-country" role="group" aria-label="Select your country">
                    <?php if ($isBranchLocked): ?>
                        <span class="is-active">New Zealand</span>
                    <?php else: ?>
                        <a href="<?php echo site_url("?country=nz"); ?>" class="<?php echo current_country() !== 'au' ? 'is-active' : ''; ?>">New Zealand</a>
                        <a href="<?php echo site_url("?country=au"); ?>" class="<?php echo current_country() === 'au' ? 'is-active' : ''; ?>">Australia</a>
                    <?php endif; ?>
                </div>

                <ul class="site-footer-legal">
                    <li><a href="<?php echo site_url("privacy-policy.php"); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo site_url("terms-of-use.php"); ?>">Terms of Use</a></li>
                    <li><a href="<?php echo site_url("sitemap.php"); ?>">Sitemap</a></li>
                </ul>

                <button type="button" class="site-footer-top-btn" aria-label="Scroll to top" onclick="window.scrollTo({top:0, behavior:'smooth'});">
                    <i class="fas fa-arrow-up"></i>
                </button>
            </div>
            <div class="site-footer-tagline-row">
                <p class="site-footer-tagline-row-text">People. Process. Possibility.™</p>
                <p class="site-footer-credit">Crafted by <a href="https://www.nikhilworks.com" target="_blank"
                    rel="noopener noreferrer">Nikhil Works</a></p>
            </div>
        </div>
    </div>
</footer>

<style>
    .site-footer {
        background: #0b1220;
        color: #c9cedb;
        font-size: 14px;
    }

    .site-footer a {
        color: inherit;
        text-decoration: none;
    }

    .site-footer h3,
    .site-footer h4 {
        color: #fff;
        margin: 0 0 18px;
    }

    .site-footer .container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .site-footer-newsletter {
        background: var(--color-primary);
    }

    .site-footer-newsletter-inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 28px 0;
    }

    .site-footer-newsletter .eyebrow {
        margin: 0 0 4px;
        text-transform: uppercase;
        letter-spacing: .08em;
        font-size: 12px;
        color: rgba(255, 255, 255, .85);
    }

    .site-footer-newsletter h3 {
        margin: 0;
        color: #fff;
        font-size: 22px;
    }

    .site-footer-newsletter form {
        display: flex;
        gap: 0;
        flex: 0 0 auto;
        width: 100%;
        max-width: 440px;
    }

    .site-footer-newsletter input {
        flex: 1;
        padding: 12px 16px;
        border: none;
        border-radius: 6px 0 0 6px;
        font-size: 14px;
    }

    .site-footer-newsletter button {
        padding: 12px 24px;
        border: none;
        border-radius: 0 6px 6px 0;
        background: #0b1220;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .site-footer-newsletter button:hover {
        background: #000;
    }

    .site-footer-top {
        padding: 44px 0 36px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .site-footer-top .site-footer-logo {
        margin-bottom: 14px;
    }

    .site-footer-tagline {
        max-width: 560px;
        margin: 0 auto 18px;
        color: #9aa1b4;
        line-height: 1.7;
    }

    .site-footer-top .site-footer-social {
        justify-content: center;
    }

    .site-footer-main {
        padding: 50px 0 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .site-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 36px;
    }

    .site-footer-company p {
        line-height: 1.7;
        color: #9aa1b4;
        margin: 0 0 20px;
    }

    .site-footer-logo {
        display: inline-block;
        margin-bottom: 18px;
    }

    .site-footer-logo img {
        max-height: 44px;
        width: auto;
        /* filter: brightness(0) invert(1); */
    }

    .site-footer-social {
        display: flex;
        gap: 10px;
    }

    .site-footer-social a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
    }

    .site-footer-social a:hover {
        background: var(--color-primary);
    }

    .site-footer-col ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .site-footer-col li {
        margin-bottom: 12px;
    }

    .site-footer-col>ul>li>a:hover {
        color: var(--color-primary);
    }

    .site-footer-col summary {
        list-style: none;
        cursor: default;
    }

    .site-footer-col summary::-webkit-details-marker {
        display: none;
    }

    .site-footer-col summary::marker {
        content: '';
    }

    .site-footer-col summary h4 {
        display: inline-block;
    }

    .site-footer-audience li a {
        display: block;
        padding: 12px 14px;
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 8px;
        transition: .2s;
    }

    .site-footer-audience li a:hover {
        border-color: var(--color-primary);
        background: rgba(255, 255, 255, .03);
    }

    .site-footer-audience-title {
        display: block;
        color: #fff;
        font-weight: 600;
    }

    .site-footer-audience-sub {
        display: block;
        font-size: 12px;
        color: #9aa1b4;
        margin-top: 2px;
    }

    .site-footer-contact li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #9aa1b4;
    }

    .site-footer-contact li i {
        margin-top: 3px;
        color: var(--color-primary);
        width: 14px;
    }

    .site-footer-contact li a:hover {
        color: #fff;
    }

    .site-footer-contact-social {
        margin-top: 18px;
    }

    .site-footer-insights {
        margin-top: 44px;
        padding-top: 36px;
        border-top: 1px solid rgba(255, 255, 255, .08);
    }

    .site-footer-insights-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-top: 6px;
    }

    .site-footer-insight {
        display: flex;
        gap: 14px;
        align-items: center;
    }

    .site-footer-insight img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 8px;
        flex: none;
    }

    .site-footer-insight em {
        display: block;
        font-style: normal;
        font-size: 12px;
        color: #7d8496;
        margin-bottom: 4px;
    }

    .site-footer-insight strong {
        display: block;
        color: #fff;
        font-weight: 600;
        line-height: 1.4;
    }

    .site-footer-insight:hover strong {
        color: var(--color-primary);
    }

    .site-footer-bottom {
        padding: 14px 0;
    }

    .site-footer-bottom-inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .site-footer-copyright {
        margin: 0;
        color: #7d8496;
    }

    .site-footer-country {
        display: flex;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 20px;
        overflow: hidden;
    }

    .site-footer-country a {
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #9aa1b4;
    }

    .site-footer-country a.is-active {
        background: var(--color-primary);
        color: #fff;
    }

    .site-footer-legal {
        list-style: none;
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
    }

    .site-footer-legal a:hover {
        color: #fff;
    }

    .site-footer-top-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .15);
        background: rgba(255, 255, 255, .06);
        color: #c9cedb;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .2s;
        flex: none;
    }

    .site-footer-top-btn:hover {
        background: var(--color-primary);
        border-color: var(--color-primary);
        color: #fff;
    }

    .site-footer-tagline-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(255, 255, 255, .06);
    }

    .site-footer-tagline-row-text {
        margin: 0;
        font-size: 12px;
        font-weight: 700;
        color: #ff6b6b;
        letter-spacing: 0.05em;
    }

    .site-footer-credit {
        margin: 0;
        font-size: 12px;
        color: #5a6070;
    }

    .site-footer-credit a {
        color: #9aa1b4;
    }

    .site-footer-credit a:hover {
        color: #fff;
    }

    @media (max-width:991px) {
        .site-footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:767px) {
        .site-footer-top {
            padding: 32px 0 28px;
        }

        .site-footer-tagline {
            text-align: left;
            margin: 0 0 16px;
            max-width: 100%;
        }

        .site-footer-top .site-footer-social {
            justify-content: flex-start;
        }

        .site-footer-main {
            padding: 8px 0 8px;
        }

        .site-footer-grid {
            grid-template-columns: 1fr;
            gap: 0;
            text-align: left;
        }

        .site-footer-col {
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .site-footer-col summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 2px;
        }

        .site-footer-col summary h4 {
            margin: 0;
            font-size: 15px;
        }

        .site-footer-col summary::after {
            content: '\f078';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 12px;
            color: #9aa1b4;
            transition: transform .2s;
            flex: none;
            margin-left: 12px;
        }

        .site-footer-col[open] summary::after {
            transform: rotate(180deg);
        }

        .site-footer-col ul {
            padding: 0 2px 18px;
        }

        .site-footer-col li {
            margin-bottom: 14px;
        }

        .site-footer-contact-social {
            padding: 0 2px 18px;
        }

        .site-footer-insights {
            margin-top: 8px;
            padding-top: 24px;
        }
    }

    @media (max-width:576px) {
        .site-footer-grid {
            grid-template-columns: 1fr;
        }

        .site-footer-insights-grid {
            grid-template-columns: 1fr;
        }

        .site-footer-newsletter-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .site-footer-newsletter form {
            max-width: 100%;
        }

        .site-footer-bottom-inner {
            flex-direction: column;
            align-items: center;
            gap: 12px;
            text-align: center;
        }

        .site-footer-legal {
            justify-content: center;
        }

        .site-footer-top-btn {
            margin-top: 4px;
        }

        .site-footer-tagline-row {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<?php if ($waLink): ?>
    <!-- floating WhatsApp chat button -->
    <a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat on WhatsApp"
        style="position:fixed; right:22px; bottom:22px; z-index:999; width:56px; height:56px; border-radius:50%; background:#25D366; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 14px rgba(0,0,0,.25);">
        <i class="fab fa-whatsapp" style="color:#fff; font-size:28px;"></i>
    </a>
<?php endif; ?>

<!-- start loader -->
<div class="loader-wrapper">
    <div class="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End loader -->

<!-- progress Back to top -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- progress Back to top End -->

<!-- scripts start form hear -->
<script src="<?php echo site_url("assets/js/vendor/jquery.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/vendor/jqueryui.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/vendor/waypoint.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/vendor/waw.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/swiper.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/counterup.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/sal.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/contact.form.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/gsap.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/scroll-trigger.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/smooth-scroll.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/plugins/split-text.js"); ?>"></script>
<!-- main Js -->
<script src="<?php echo site_url("assets/js/main.js?v=3"); ?>"></script>
<script src="<?php echo site_url("assets/js/inline.js"); ?>"></script>
<!-- scripts end form hear -->
</body>

</html>