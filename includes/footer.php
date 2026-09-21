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
    'facebook' => [$settings['facebook_url'], 'fa-facebook-f'],
    'twitter' => [$settings['twitter_url'], 'fa-twitter'],
    'instagram' => [$settings['instagram_url'], 'fa-instagram'],
    'linkedin' => [$settings['linkedin_url'], 'fa-linkedin-in'],
    'youtube' => [$settings['youtube_url'], 'fa-youtube'],
], fn($s) => !empty($s[0]));
?>
<footer class="site-footer">

    <!-- newsletter strip -->
    <!-- <div class="site-footer-newsletter">
        <div class="container">
            <div class="site-footer-newsletter-inner">
                <div>
                    <p class="eyebrow">Stay Informed</p>
                    <h3>Sign up for our newsletter</h3>
                </div>
                <form action="newsletter.php" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </div> -->

    <!-- main footer body -->
    <div class="site-footer-main">
        <div class="container">
            <div class="site-footer-grid">

                <!-- company -->
                <div class="site-footer-col site-footer-company">
                    <a href="<?php echo site_url("index.php"); ?>" class="site-footer-logo">
                        <img src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>"
                            alt="<?php echo e($settings['company_name'] ?: APP_NAME); ?>">
                    </a>
                    <p><?php echo e($settings['tagline'] ?: (APP_NAME . ' helps businesses grow with clear, practical accounting, tax and consulting advice.')); ?>
                    </p>
                    <?php if (!empty($socialLinks)): ?>
                        <div class="site-footer-social">
                            <?php foreach ($socialLinks as $url => $meta): ?>
                                <a href="<?php echo e($url); ?>" target="_blank" rel="noopener"
                                    aria-label="<?php echo e(ucfirst($meta[1])); ?>"><i
                                        class="fab <?php echo e($meta[1]); ?>"></i></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- quick links -->
                <div class="site-footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo site_url("index.php"); ?>">Home</a></li>
                        <li><a href="<?php echo site_url("about-us.php"); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url("how-we-work.php"); ?>">How We Work</a></li>
                        <li><a href="<?php echo site_url("our-peoples.php"); ?>">Our Peoples</a></li>
                        <li><a href="<?php echo site_url("insight-resources.php"); ?>">Insight &amp; Resources</a></li>
                        <li><a href="<?php echo site_url("our-service.php"); ?>">Our Services</a></li>
                        <li><a href="<?php echo site_url("pricing.php"); ?>">Pricing</a></li>
                    </ul>
                </div>

                <!-- audience selector -->
                <div class="site-footer-col">
                    <h4>I'm Looking For&hellip;</h4>
                    <ul class="site-footer-audience">
                        <li>
                            <a href="<?php echo site_url("nz/accounting/"); ?>">
                                <span class="site-footer-audience-title">A Business</span>
                                <span class="site-footer-audience-sub">Accounting &amp; Bookkeeping</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("nz/accounting-firm/"); ?>">
                                <span class="site-footer-audience-title">An Accounting Firm</span>
                                <span class="site-footer-audience-sub">Firm Outsourcing Support</span>
                            </a>
                        </li>
                        <li><a href="<?php echo site_url("get-started.php"); ?>">Not sure? Get Started &rarr;</a></li>
                        <li><a href="<?php echo site_url("appoinment.php"); ?>">Book an Appointment</a></li>
                    </ul>
                </div>

                <!-- get in touch -->
                <div class="site-footer-col">
                    <h4>Get In Touch</h4>
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
                </div>

            </div>

            <?php if (!empty($recentPosts)): ?>
                <!-- latest insights -->
                <div class="site-footer-insights">
                    <h4>Latest Insights</h4>
                    <div class="site-footer-insights-grid">
                        <?php foreach ($recentPosts as $post): ?>
                            <a class="site-footer-insight" href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($post['slug']); ?>">
                                <img src="<?php echo e($post['image'] ?: site_url('assets/images/footer/post/01.png')); ?>"
                                    alt="<?php echo e($post['title']); ?>">
                                <span>
                                    <em><?php echo date('jS F, Y', strtotime($post['created_at'])); ?></em>
                                    <strong><?php echo e($post['title']); ?></strong>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- bottom bar -->
    <div class="site-footer-bottom">
        <div class="container">
            <div class="site-footer-bottom-inner">
                <p class="site-footer-copyright">&copy; <span class="current-year"></span>
                    <?php echo e($settings['copyright_text'] ?: (APP_NAME . '. All rights reserved.')); ?></p>

                <div class="site-footer-country" role="group" aria-label="Select your country">
                    <a href="<?php echo site_url("index.php"); ?>" class="<?php echo $currentPage !== 'australia.php' ? 'is-active' : ''; ?>">New
                        Zealand</a>
                    <a href="<?php echo site_url("australia.php"); ?>"
                        class="<?php echo $currentPage === 'australia.php' ? 'is-active' : ''; ?>">Australia</a>
                </div>

                <ul class="site-footer-legal">
                    <li><a href="<?php echo site_url("privacy-policy.php"); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo site_url("terms-of-use.php"); ?>">Terms of Use</a></li>
                    <li><a href="<?php echo site_url("sitemap.php"); ?>">Sitemap</a></li>
                </ul>
            </div>
            <p class="site-footer-credit">Crafted by <a href="https://www.nikhilworks.com" target="_blank"
                    rel="noopener noreferrer">Nikhil Works</a></p>
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
        max-width: 1290px;
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

    .site-footer-main {
        padding: 60px 0 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .site-footer-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr;
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
        padding: 22px 0;
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

    .site-footer-credit {
        margin: 16px 0 0;
        text-align: center;
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
            align-items: flex-start;
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
<script src="<?php echo site_url("assets/js/main.js"); ?>"></script>
<script src="<?php echo site_url("assets/js/inline.js"); ?>"></script>
<!-- scripts end form hear -->
</body>

</html>