<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'get-accountant | Accounting & Bookkeeping Services (New Zealand & Australia)';
$metaDescription = 'Professional accounting, bookkeeping and firm outsourcing services across New Zealand and Australia. People. Process. Possibility.™';
$currentPage     = 'index.php';

$recentPosts = [];
if ($pdo = db()) {
    try {
        $recentPosts = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
    } catch (Throwable $e) {}
}

require __DIR__ . '/includes/header.php';
?>

    <!-- 1. ENTRY / GATEWAY HERO BANNER WITH INTERACTIVE SELECTOR -->
    <div class="rts-banner-area rts-banner-one bg_image" style="background: linear-gradient(135deg, #070d17 0%, #0f1c30 100%); padding: 90px 0 110px; position: relative; overflow: hidden;">
        <div style="position: absolute; right: -5%; top: -10%; width: 550px; height: 550px; border-radius: 50%; background: radial-gradient(circle, rgba(229,57,53,0.18) 0%, rgba(229,57,53,0) 70%); pointer-events: none;"></div>
        <div style="position: absolute; left: -10%; bottom: -10%; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(37,99,235,0.1) 0%, rgba(37,99,235,0) 70%); pointer-events: none;"></div>

        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <!-- Left Hero Copy -->
                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full">
                    <div class="gateway-hero-content text-left">
                        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(229,57,53,0.12); border: 1px solid rgba(229,57,53,0.3); padding: 6px 16px; border-radius: 30px; margin-bottom: 22px;">
                            <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #e53935;"></span>
                            <span style="color: #ff6b6b; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">People. Process. Possibility.™</span>
                        </div>
                        <h1 class="title">
                            Modern Accounting &amp; Outsourcing <br>
                            <span>Tailored for Your Growth</span>
                        </h1>
                        <p class="disc">
                            Whether you run a growing business needing dependable bookkeeping and IRD tax filing, or an accounting firm seeking scalable white-label outsourcing capacity, <strong>get-accountant</strong> delivers precision, speed, and peace of mind.
                        </p>
                        
                        <!-- Quick Navigation Pills -->
                        <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                            <a class="rts-btn btn-primary" href="<?php echo site_url('nz/accounting/'); ?>" style="padding: 16px 28px; font-weight: 600;">
                                NZ Accounting &amp; Bookkeeping <i class="far fa-arrow-right"></i>
                            </a>
                            <a class="rts-btn btn-primary-alta" href="<?php echo site_url('nz/accounting-firm/'); ?>" style="background: rgba(255,255,255,0.08); color: #fff; border: 1px solid rgba(255,255,255,0.25); padding: 16px 28px; font-weight: 600;">
                                NZ Firm Outsourcing <i class="far fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Micro trust badges -->
                        <div style="margin-top: 35px; display: flex; gap: 20px; flex-wrap: wrap; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 22px;">
                            <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> New Zealand IRD Compliant
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Certified Xero &amp; MYOB Partners
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> 100% Data Confidentiality
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Guided 2-Step Decision Journey from Diagram -->
                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full mt_md--50 mt_sm--50">
                    <div style="background: #fff; border-radius: 20px; padding: 36px 30px; box-shadow: 0 25px 60px rgba(0,0,0,0.4); border-top: 5px solid #e53935; position: relative;">
                        <div style="text-align: center; margin-bottom: 25px;">
                            <span style="font-size: 12px; font-weight: 800; color: #e53935; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 5px;">Guided Selection</span>
                            <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0;">Find Your Tailored Solution</h3>
                            <p style="font-size: 14px; color: #64748b; margin: 6px 0 0;">Step through the 2 quick questions from our portal blueprint:</p>
                        </div>

                        <!-- Step 1: Location -->
                        <div id="selector-step-1" style="margin-bottom: 24px;">
                            <label style="display: block; font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">
                                1. Which location are you from?
                            </label>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                <button type="button" class="loc-btn active" data-loc="nz" style="padding: 14px 16px; border: 2px solid #e53935; background: #fff5f5; color: #e53935; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s;">
                                    <span style="font-size: 18px;">🇳🇿</span> New Zealand
                                </button>
                                <button type="button" class="loc-btn" data-loc="au" style="padding: 14px 16px; border: 2px solid #e2e8f0; background: #fff; color: #475569; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; position: relative;">
                                    <span style="font-size: 18px;">🇦🇺</span> Australia
                                    <span style="position: absolute; top: -8px; right: 8px; font-size: 9px; font-weight: 800; background: #e53935; color: #fff; padding: 1px 6px; border-radius: 10px; text-transform: uppercase;">Soon</span>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Persona -->
                        <div id="selector-step-2" style="margin-bottom: 28px;">
                            <label style="display: block; font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">
                                2. Are you an accountant or representing an accounting firm?
                            </label>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <button type="button" class="persona-btn active" data-persona="business" style="padding: 14px 18px; border: 2px solid #e53935; background: #fff5f5; color: #0f172a; border-radius: 10px; font-weight: 600; font-size: 14px; text-align: left; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all .2s;">
                                    <span><strong>No</strong> &mdash; Accounting &amp; Bookkeeping (For Businesses)</span>
                                    <i class="fas fa-check-circle" style="color: #e53935;"></i>
                                </button>
                                <button type="button" class="persona-btn" data-persona="firm" style="padding: 14px 18px; border: 2px solid #e2e8f0; background: #fff; color: #0f172a; border-radius: 10px; font-weight: 600; font-size: 14px; text-align: left; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all .2s;">
                                    <span><strong>Yes</strong> &mdash; Accounting Firm Outsourcing Support</span>
                                    <i class="far fa-circle" style="color: #cbd5e1;"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Submit / Redirect -->
                        <div>
                            <a id="selector-cta-btn" class="rts-btn btn-primary" href="<?php echo site_url('nz/accounting/'); ?>" style="display: block; text-align: center; padding: 16px; font-weight: 700; font-size: 16px; border-radius: 10px; text-decoration: none;">
                                Continue to Your Portal <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. THE TWO PRIMARY PILLARS SHOWCASE (NZ BOOKKEEPING VS FIRM OUTSOURCING) -->
    <div class="rts-service-area rts-section-gap" style="padding: 90px 0; background: #f8fafc;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 750px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Choose Your Track</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Two Specialized Pathways to Financial Clarity</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">Built to serve Kiwi small businesses and accounting practices with dedicated, international-standard capability.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <!-- Pillar 1: Small & Medium Businesses -->
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 18px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.06); height: 100%; border: 1px solid #e2e8f0; border-top: 5px solid #e53935; display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px;">
                            <div style="width: 55px; height: 55px; border-radius: 14px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <span style="font-size: 12px; font-weight: 800; color: #e53935; text-transform: uppercase; letter-spacing: 0.08em;">For Business Owners</span>
                                <h3 class="title h4" style="margin: 0; font-size: 24px;">New Zealand Accounting &amp; Bookkeeping</h3>
                            </div>
                        </div>
                        <p class="disc" style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 24px;">
                            Take the stress out of day-to-day accounts. We handle your daily bank reconciliations, GST returns, employee payroll, and year-end financials so you stay 100% compliant with Inland Revenue.
                        </p>
                        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px; flex-grow: 1;">
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Daily &amp; weekly bank reconciliation in Xero/MYOB
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Bi-monthly &amp; 6-monthly GST filing with IRD
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Payday payroll, KiwiSaver &amp; leave calculations
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Annual financial statements &amp; IR4/IR3 tax returns
                            </div>
                        </div>
                        <div>
                            <a class="rts-btn btn-primary" href="<?php echo site_url('nz/accounting/'); ?>" style="width: 100%; text-align: center; padding: 15px; font-weight: 700; font-size: 15px; text-decoration: none;">
                                Explore Bookkeeping Portal <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pillar 2: Accounting Firms Outsourcing -->
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 18px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.06); height: 100%; border: 1px solid #e2e8f0; border-top: 5px solid #0f172a; display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px;">
                            <div style="width: 55px; height: 55px; border-radius: 14px; background: #f1f5f9; color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div>
                                <span style="font-size: 12px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.08em;">For CA &amp; CPA Practices</span>
                                <h3 class="title h4" style="margin: 0; font-size: 24px;">Accounting Firm Outsourcing</h3>
                            </div>
                        </div>
                        <p class="disc" style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 24px;">
                            Overcome talent shortages and scale your firm's revenue. We act as your private, white-label production department, delivering standardized GST workpapers, accounts payable, payroll, and year-end tax files.
                        </p>
                        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px; flex-grow: 1;">
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Strict mutual NDA &amp; zero client poaching guarantee
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Audit-ready workpapers prepared to CA ANZ standards
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> Works directly inside XPM, CCH iFirm, MYOB &amp; Dext
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 14.5px; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #22c55e;"></i> 40-50% operational cost savings on compliance
                            </div>
                        </div>
                        <div>
                            <a class="rts-btn btn-primary-alta" href="<?php echo site_url('nz/accounting-firm/'); ?>" style="width: 100%; text-align: center; padding: 15px; font-weight: 700; font-size: 15px; text-decoration: none; border: 2px solid #0f172a; color: #0f172a;">
                                Explore Firm Outsourcing Portal <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. AUSTRALIA COMING SOON BANNER (MATCHING DIAGRAM) -->
    <div style="background: #0f172a; color: #fff; padding: 45px 0; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(229,57,53,0.12); border: 1px solid rgba(229,57,53,0.3); padding: 4px 12px; border-radius: 20px; margin-bottom: 10px;">
                        <span style="font-size: 14px;">🇦🇺</span>
                        <span style="color: #ff6b6b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Expanding Region</span>
                    </div>
                    <h3 style="color: #fff; font-size: 24px; margin: 0 0 6px;">Australia Accounting &amp; Bookkeeping &mdash; Launching Soon</h3>
                    <p style="color: #94a3b8; font-size: 15px; margin: 0;">We are preparing our Australian expansion (ATO compliance, BAS preparation, Superannuation &amp; STP). Register your interest today.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--20 mt_sm--20">
                    <a class="rts-btn btn-primary" href="<?php echo site_url('australia.php'); ?>" style="padding: 12px 24px; font-size: 14px; font-weight: 700;">
                        View Australia Details <i class="far fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. WHY GET-ACCOUNTANT (DIFFERENTIATORS) -->
    <div class="rts-about-area rts-section-gap" style="padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full">
                    <div style="position: relative; padding-right: 20px;">
                        <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            <img src="<?php echo site_url('assets/images/about/05.jpg'); ?>" alt="International Accounting Caliber" style="width: 100%;">
                        </div>
                        <div style="position: absolute; bottom: 30px; left: 30px; background: #e53935; color: #fff; padding: 22px 28px; border-radius: 14px; max-width: 260px;">
                            <span style="font-size: 32px; font-weight: 800; line-height: 1; display: block;">99.8%</span>
                            <span style="font-size: 13px; font-weight: 600; text-transform: uppercase;">Statutory Filing Accuracy</span>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full mt_md--40 mt_sm--40">
                    <div class="rts-title-area">
                        <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">The get-accountant Advantage</span>
                        <h2 class="title" style="font-size: 36px; margin: 12px 0 20px;">International Accounting Caliber, Local New Zealand Knowledge</h2>
                        <p class="disc" style="color: #475569; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                            Accounting should not be reactive or mysterious. At <strong>get-accountant</strong>, we combine disciplined international operating procedures with qualified New Zealand tax professionals who understand Inland Revenue regulations inside and out.
                        </p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Fast 24h Query Turnaround
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Zero Contract Lock-ins
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Bank-Grade 256-Bit SSL
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Proactive Tax Planning
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <a class="rts-btn btn-primary" href="<?php echo site_url('about-us.php'); ?>">Learn More About Us <i class="far fa-arrow-right"></i></a>
                            <a class="rts-read-more-two color-primary" href="<?php echo site_url('contactus.php'); ?>" style="font-weight: 700;">Contact Us <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. RECENT INSIGHTS & RESOURCES -->
    <?php if (!empty($recentPosts)): ?>
    <div class="rts-blog-area rts-section-gap" style="padding: 90px 0; background: #f8fafc;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom: 45px;">
                <div class="xl:w-2/3 lg:w-2/3 px-[15px]">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Latest Thinking</span>
                    <h2 class="title" style="font-size: 36px; margin-top: 10px;">Insights &amp; Practical Resources</h2>
                </div>
                <div class="xl:w-1/3 lg:w-1/3 px-[15px] text-right">
                    <a class="rts-read-more-two color-primary" href="<?php echo site_url('insight-resources.php'); ?>" style="font-weight: 700;">View All Insights <i class="far fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($recentPosts as $post): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.04); height: 100%; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                        <a href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($post['slug']); ?>" style="height: 200px; overflow: hidden; display: block;">
                            <img src="<?php echo site_url($post['image'] ?: 'assets/images/blog/01.jpg'); ?>" alt="<?php echo e($post['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                        <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                            <span style="font-size: 13px; color: #94a3b8; margin-bottom: 8px;"><i class="fal fa-calendar-alt"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                            <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px;">
                                <a href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($post['slug']); ?>" style="color: #0f172a; text-decoration: none;"><?php echo e($post['title']); ?></a>
                            </h3>
                            <p class="disc" style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 16px; flex-grow: 1;">
                                <?php echo e($post['excerpt']); ?>
                            </p>
                            <a class="rts-read-more color-primary" href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($post['slug']); ?>" style="font-weight: 700; font-size: 14px;">
                                Read Full Article <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedLoc = 'nz';
            var selectedPersona = 'business';
            var ctaBtn = document.getElementById('selector-cta-btn');
            var baseUrl = <?php echo json_encode(site_url()); ?>;

            function updateRoute() {
                var target = '';
                if (selectedLoc === 'nz') {
                    if (selectedPersona === 'business') {
                        target = baseUrl + 'nz/accounting/';
                        ctaBtn.textContent = 'Go to NZ Accounting & Bookkeeping';
                    } else {
                        target = baseUrl + 'nz/accounting-firm/';
                        ctaBtn.textContent = 'Go to NZ Firm Outsourcing';
                    }
                } else {
                    if (selectedPersona === 'business') {
                        target = baseUrl + 'au/accounting/';
                        ctaBtn.textContent = 'View Australia Bookkeeping (Coming Soon)';
                    } else {
                        target = baseUrl + 'au/accounting-firm/';
                        ctaBtn.textContent = 'View Australia Firm Support (Coming Soon)';
                    }
                }
                var icon = document.createElement('i');
                icon.className = 'far fa-arrow-right';
                icon.style.marginLeft = '8px';
                ctaBtn.appendChild(icon);
                ctaBtn.href = target;
            }

            // Location buttons
            document.querySelectorAll('.loc-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.loc-btn').forEach(function(b) {
                        b.classList.remove('active');
                        b.style.borderColor = '#e2e8f0';
                        b.style.background = '#fff';
                        b.style.color = '#475569';
                    });
                    btn.classList.add('active');
                    btn.style.borderColor = '#e53935';
                    btn.style.background = '#fff5f5';
                    btn.style.color = '#e53935';
                    selectedLoc = btn.getAttribute('data-loc');
                    updateRoute();
                });
            });

            // Persona buttons
            document.querySelectorAll('.persona-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.persona-btn').forEach(function(b) {
                        b.classList.remove('active');
                        b.style.borderColor = '#e2e8f0';
                        b.style.background = '#fff';
                        var icon = b.querySelector('i');
                        if (icon) {
                            icon.className = 'far fa-circle';
                            icon.style.color = '#cbd5e1';
                        }
                    });
                    btn.classList.add('active');
                    btn.style.borderColor = '#e53935';
                    btn.style.background = '#fff5f5';
                    var icon = btn.querySelector('i');
                    if (icon) {
                        icon.className = 'fas fa-check-circle';
                        icon.style.color = '#e53935';
                    }
                    selectedPersona = btn.getAttribute('data-persona');
                    updateRoute();
                });
            });

            updateRoute();
        });
    </script>

<?php require __DIR__ . '/includes/footer.php'; ?>
