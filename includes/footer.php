<?php
/**
 * Shared footer + scripts, included at the bottom of every public page.
 */

$settings = site_settings();
$waLink   = $settings['whatsapp_url'] ?: whatsapp_link($settings['whatsapp_number']);

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
?>
    <!-- rts footer area start -->
    <div class="rts-footer-area footer-one rts-section-gapTop bg-footer-one">
        <div class="container bg-shape-f1">
            <!-- footer call to action area -->
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-cta-wrapper">
                        <div class="background-cta">
                            <div class="flex flex-wrap -mx-[15px]">
                                <div class="lg:w-1/2 px-[15px]">
                                    <div class="cta-left-wrapepr">
                                        <p class="cta-disc">Latest Business Ideas</p>
                                        <h3 class="title">Sign Up Newsletter</h3>
                                    </div>
                                </div>
                                <div class="lg:w-1/2 px-[15px]">
                                    <form class="cta-input-arae" action="newsletter.php" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="email" name="email" placeholder="Enter Email Address" required>
                                        <button type="submit" class="rts-btn btn-primary">Subscribe Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer call to action area End -->
            <div class="flex flex-wrap -mx-[15px] pt--120 pt_sm--80 pb--80 pb_sm--40">
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="footer-one-single-wized">
                        <div class="wized-title">
                            <h3 class="title h5">Quick Links</h3>
                            <img src="assets/images/footer/under-title.png" alt="<?php echo e(APP_NAME); ?>">
                        </div>
                        <div class="quick-link-inner">
                            <ul class="links">
                                <li><a href='contactus.php'><i class="far fa-arrow-right"></i> Get Support</a></li>
                                <li><a href='pricing.php'><i class="far fa-arrow-right"></i> Pricing & Plans</a></li>
                                <li><a href='contactus.php'><i class="far fa-arrow-right"></i> Contact Us</a></li>
                                <li><a href='appoinment.php'><i class="far fa-arrow-right"></i> Book Appointment</a></li>
                            </ul>
                            <ul class="links margin-left-70">
                                <li><a href='about-us.php'><i class="far fa-arrow-right"></i> About Us</a></li>
                                <li><a href='about-us.php'><i class="far fa-arrow-right"></i>Our Company</a></li>
                                <li><a href='our-service.php'><i class="far fa-arrow-right"></i>Service</a></li>
                                <li><a href='team.php'><i class="far fa-arrow-right"></i>Our Team</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="footer-one-single-wized mid-bg">
                        <div class="wized-title">
                            <h3 class="title h5">Opening Hours</h3>
                            <img src="assets/images/footer/under-title.png" alt="<?php echo e(APP_NAME); ?>">
                        </div>
                        <div class="opening-time-inner">
                            <div class="single-opening">
                                <p class="day">Mon - Fri</p>
                                <p class="time">09:00 - 18:00</p>
                            </div>
                            <div class="single-opening">
                                <p class="day">Saturday</p>
                                <p class="time">10:00 - 15:00</p>
                            </div>
                            <div class="single-opening mb--30 mb_sm--10">
                                <p class="day">Sunday</p>
                                <p class="time">Closed</p>
                            </div>
                            <a class='rts-btn btn-primary contact-us' href='contactus.php'>Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="footer-one-single-wized margin-left-65">
                        <div class="wized-title">
                            <h3 class="title h5">Popular Updates</h3>
                            <img src="assets/images/footer/under-title.png" alt="<?php echo e(APP_NAME); ?>">
                        </div>
                        <div class="post-wrapper">
                            <?php if (!empty($recentPosts)): ?>
                                <?php foreach ($recentPosts as $post): ?>
                                    <div class="single-footer-post mb--30">
                                        <div class="left-thumbnail">
                                            <img src="<?php echo e($post['image'] ?: 'assets/images/footer/post/01.png'); ?>" alt="<?php echo e($post['title']); ?>">
                                        </div>
                                        <div class="post-right">
                                            <p><i class="fal fa-clock"></i> <?php echo date('jS F, Y', strtotime($post['created_at'])); ?></p>
                                            <a href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>
                                                <h3 class="title"><?php echo e($post['title']); ?></h3>
                                            </a>
                                            <a class='red-more' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>Read More<i class="far fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="single-footer-post">
                                    <div class="post-right">
                                        <a href='blog-list.php'>
                                            <h3 class="title">Visit our blog for the latest updates</h3>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rts-copyright-area">
            <div class="container">
                <div class="flex flex-wrap -mx-[15px]">
                    <div class="w-full px-[15px]">
                        <div class="text-center">
                            <p>&copy; <span class="current-year"></span> <?php echo e($settings['copyright_text'] ?: (APP_NAME . '. All rights reserved.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts footer area end -->

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
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/jqueryui.js"></script>
    <script src="assets/js/vendor/waypoint.js"></script>
    <script src="assets/js/vendor/waw.js"></script>
    <script src="assets/js/plugins/swiper.js"></script>
    <script src="assets/js/plugins/counterup.js"></script>
    <script src="assets/js/plugins/sal.min.js"></script>
    <script src="assets/js/plugins/contact.form.js"></script>
    <script src="assets/js/plugins/gsap.js"></script>
    <script src="assets/js/plugins/scroll-trigger.js"></script>
    <script src="assets/js/plugins/smooth-scroll.js"></script>
    <script src="assets/js/plugins/split-text.js"></script>
    <!-- main Js -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/inline.js"></script>
    <!-- scripts end form hear -->
</body>

</html>
