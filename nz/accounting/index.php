<?php
require_once __DIR__ . '/../../config/config.php';

$country         = 'nz';
$branch          = 'bookkeeping';
$pageTitle       = 'New Zealand Accounting & Bookkeeping Services';
$metaDescription = 'Accurate, stress-free bookkeeping, IRD GST filing, payroll, and financial clarity from qualified New Zealand accountants.';
$currentPage     = 'index.php';

$services = [];
$faqs = [];
$testimonials = [];

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => $branch]);
        $services = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 5');
        $stmt->execute(['b' => $branch]);
        $faqs = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 3');
        $stmt->execute(['b' => $branch]);
        $testimonials = $stmt->fetchAll();
    } catch (Throwable $e) {
        // Fallback
    }
}

require __DIR__ . '/../../includes/header.php';
?>

    <!-- 1. AUTHENTIC FINBIZ THEME HERO BANNER AREA -->
    <div class="rts-banner-area rts-banner-one">
        <div class="swiper mySwiper banner-one">
            <div class="swiper-wrapper">
                <!-- Slide 1: Primary Value Proposition -->
                <div class="swiper-slide">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>NEW ZEALAND</span> ACCOUNTING &amp; BOOKKEEPING
                        </p>
                        <h1 class="title">
                            Smarter <span>Bookkeeping</span> <br>
                            For Kiwi Businesses
                        </h1>
                        <p class="disc banner-para">
                            Accurate bank reconciliations, on-time IRD GST returns, payday payroll, and clear financial visibility from qualified New Zealand accountants. We handle the paperwork so you can grow with total confidence.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='contact.php' style="padding: 16px 32px; font-weight: 600;">Get Free Consultation <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='services.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">Explore Services</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> 100% IRD Compliant</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Xero &amp; MYOB Certified</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Fixed Monthly Fees</span>
                        </div>
                        <img class="shape-img one" src="<?php echo site_url('assets/images/banner/shape/01.png'); ?>" alt="banner_shape">
                    </div>
                </div>

                <!-- Slide 2: Zero IRD Surprises -->
                <div class="swiper-slide two">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>100% IRD COMPLIANT</span> ZERO PENALTIES
                        </p>
                        <h1 class="title">
                            Effortless <span>GST &amp; Payroll</span> <br>
                            Filed On Time, Always
                        </h1>
                        <p class="disc banner-para">
                            Say goodbye to late IRD filing stress and provisional tax surprises. We schedule, compute, and lodge all your returns ahead of time with comprehensive workpaper backing.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='pricing.php' style="padding: 16px 32px; font-weight: 600;">View Pricing Plans <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='how-it-works.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">How It Works</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Bi-Monthly &amp; 6-Month GST</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Payday Filing &amp; KiwiSaver</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Tax Pooling Support</span>
                        </div>
                        <img class="shape-img one" src="<?php echo site_url('assets/images/banner/shape/01.png'); ?>" alt="banner_shape">
                    </div>
                </div>

                <!-- Slide 3: Cloud Automation & Real-Time Clarity -->
                <div class="swiper-slide three">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>CLOUD AUTOMATION</span> XERO &amp; MYOB GOLD
                        </p>
                        <h1 class="title">
                            Real-Time <span>Financial Clarity</span> <br>
                            At Your Fingertips
                        </h1>
                        <p class="disc banner-para">
                            Automate receipt processing with Dext, connect live bank feeds, and receive monthly management reports that reveal exactly where your cash flow and profits are heading.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='contact.php' style="padding: 16px 32px; font-weight: 600;">Book Free Consultation <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='client-stories.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">Client Stories</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Automated Receipt Capture</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Cash Flow Runway Alerts</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Dedicated Client Manager</span>
                        </div>
                        <img class="shape-img one" src="<?php echo site_url('assets/images/banner/shape/01.png'); ?>" alt="banner_shape">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="animation-img">
            <img class="shape-img two" src="<?php echo site_url('assets/images/banner/shape/02.png'); ?>" alt="banner_business">
            <img class="shape-img three" src="<?php echo site_url('assets/images/banner/shape/03.png'); ?>" alt="banner_business">
        </div>
    </div>

    <!-- 2. VALUE PROPOSITION STRIP (3 CARDS) -->
    <div class="rts-feature-area" style="margin-top: -50px; position: relative; z-index: 10;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Dedicated NZ Bookkeeper</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">You get a named, qualified specialist who knows your business, answers your calls, and reconciles your accounts proactively.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #0f172a; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #f1f5f9; color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Zero IRD Surprises</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">We compute and schedule GST, PAYE, and provisional tax in advance so you never face late penalties or cash crunches.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-cloud-check"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Cloud Automation</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">Seamlessly integrated with Xero, MYOB, Dext and your bank feeds for paperless receipt capture and real-time mobile reports.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/../../includes/bookkeeping-subnav.php'; ?>

    <!-- 3. ABOUT SECTION -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full">
                    <div style="position: relative; padding-right: 20px;">
                        <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            <img src="<?php echo site_url('assets/images/about/02.jpg'); ?>" alt="About get-accountant" style="width: 100%;">
                        </div>
                        <div style="position: absolute; bottom: 30px; left: 30px; background: #e53935; color: #fff; padding: 24px 30px; border-radius: 14px; max-width: 260px;">
                            <span style="font-size: 38px; font-weight: 800; line-height: 1; display: block;">10+</span>
                            <span style="font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Years Supporting Kiwi Businesses</span>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full mt_md--40 mt_sm--40">
                    <div class="rts-title-area">
                        <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Who We Are</span>
                        <h2 class="title" style="font-size: 36px; margin: 12px 0 20px;">Your Trusted Financial Partners in New Zealand</h2>
                        <p class="disc" style="color: #475569; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                            At <strong>get-accountant</strong>, our philosophy is anchored in <em>People. Process. Possibility.™</em> We believe small business owners should spend their time growing sales and delighting customers — not wrestling with bank feeds and tax compliance.
                        </p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> IRD Registered Agents
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Xero Gold Certified
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Transparent Fixed Monthly Fees
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> NZ Privacy Act Protected
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <a class="rts-btn btn-primary" href="why-us.php">Why Choose Us <i class="far fa-arrow-right"></i></a>
                            <a class="rts-read-more-two color-primary" href="how-it-works.php" style="font-weight: 700;">See How It Works <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. CORE SERVICES SECTION (DYNAMIC FROM DB) -->
    <div class="rts-service-area rts-section-gap bg-service-h2" style="background: #f8fafc; padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom: 50px;">
                <div class="xl:w-2/3 lg:w-2/3 px-[15px]">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">What We Offer</span>
                    <h2 class="title" style="font-size: 36px; margin-top: 10px;">Comprehensive NZ Accounting Services</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; margin: 0;">Everything your business needs from routine weekly reconciliation to year-end accounts and strategic advisory.</p>
                </div>
                <div class="xl:w-1/3 lg:w-1/3 px-[15px] text-right">
                    <a class="rts-btn btn-primary-alta" href="services.php" style="border: 2px solid #e53935; color: #e53935; background: transparent; padding: 12px 24px;">View All Services <i class="far fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php if (empty($services)): ?>
                    <p class="disc text-center w-full">Services are being loaded from the database.</p>
                <?php else: ?>
                    <?php foreach ($services as $service): 
                        $detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                        $iconNum = !empty($service['icon']) ? $service['icon'] : '01';
                    ?>
                    <div class="xl:w-1/3 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                        <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column; border: 1px solid #e2e8f0; transition: transform .3s, box-shadow .3s;">
                            <div style="height: 180px; overflow: hidden; position: relative;">
                                <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/01.jpg'); ?>" alt="<?php echo e($service['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; bottom: 15px; left: 20px; width: 48px; height: 48px; border-radius: 12px; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 8px 16px rgba(229,57,53,0.3);">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                            <div style="padding: 28px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                                <h3 class="title h5" style="margin-bottom: 12px; font-size: 20px;">
                                    <a href="<?php echo e($detailUrl); ?>" style="color: #0f172a; text-decoration: none;"><?php echo e($service['title']); ?></a>
                                </h3>
                                <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                                    <?php echo e($service['short_description']); ?>
                                </p>
                                <div style="border-top: 1px solid #f1f5f9; padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                                    <a class="rts-read-more color-primary" href="<?php echo e($detailUrl); ?>" style="font-weight: 700; font-size: 14px; text-decoration: none;">
                                        Read More <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                                    </a>
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">NZ IRD Compliant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 5. INDUSTRIES WE SUPPORT PREVIEW -->
    <div class="rts-industry-area rts-section-gap" style="padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 750px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Specialized Expertise</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Tailored Accounting for Key NZ Industries</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">We understand the specific tax rules, payroll requirements, and cash flow cycles of New Zealand sectors.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php 
                $industriesList = [
                    ['title' => 'Trades & Construction', 'desc' => 'Job costing, subcontractor PAYE, retentions, and progress payment reconciliations in Fergus & Tradify.', 'icon' => 'fa-hard-hat'],
                    ['title' => 'Retail & E-commerce', 'desc' => 'Shopify, POS and WooCommerce daily sync, inventory tracking, and multi-channel GST reconciliation.', 'icon' => 'fa-shopping-cart'],
                    ['title' => 'Hospitality & Cafes', 'desc' => 'Fast-paced shift payroll under the Holidays Act, supplier bill scheduling, and daily takings tracking.', 'icon' => 'fa-utensils'],
                    ['title' => 'Professional Services', 'desc' => 'WIP tracking, retainer billing, time-and-materials invoicing, and cash flow runway forecasting.', 'icon' => 'fa-briefcase'],
                    ['title' => 'Healthcare & Medical', 'desc' => 'Patient fee reconciliations, clinic expense allocations, and compliant partner drawings tracking.', 'icon' => 'fa-user-md'],
                    ['title' => 'Transport & Logistics', 'desc' => 'Fleet fuel tax credits, asset financing schedules, RUC expense coding, and driver payroll.', 'icon' => 'fa-truck'],
                ];
                foreach ($industriesList as $ind):
                ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: transform .2s;">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            <div style="width: 46px; height: 46px; border-radius: 10px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                <i class="fas <?php echo $ind['icon']; ?>"></i>
                            </div>
                            <h3 class="title h5" style="margin: 0; font-size: 19px;"><?php echo e($ind['title']); ?></h3>
                        </div>
                        <p class="disc" style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;"><?php echo e($ind['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt--20">
                <a class="rts-btn btn-primary" href="industries.php">Explore All Industries We Support <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- 6. HOW IT WORKS / WORKING PROCESS -->
    <div class="working-process-area rts-section-gap working-process-bg" style="background: #0b1220; color: #fff; padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 700px;">
                    <span style="color: #ff6b6b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Simple 4-Step Process</span>
                    <h2 class="title" style="color: #fff; font-size: 36px; margin: 10px 0 15px;">How We Take Bookkeeping Off Your Plate</h2>
                    <p class="disc" style="color: #94a3b8; font-size: 16px;">A hassle-free onboarding process designed to get your books up to date without disrupting your business.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-1/4 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 800; margin: 0 auto 20px;">1</div>
                        <h3 class="title h5" style="color: #fff; margin-bottom: 12px;">Free Consultation</h3>
                        <p class="disc" style="color: #94a3b8; font-size: 14px; margin: 0;">We review your current setup, volume, and tax requirements to recommend a clear, fixed monthly plan.</p>
                    </div>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 800; margin: 0 auto 20px;">2</div>
                        <h3 class="title h5" style="color: #fff; margin-bottom: 12px;">System Connection</h3>
                        <p class="disc" style="color: #94a3b8; font-size: 14px; margin: 0;">Invite our team to your Xero or MYOB account. We configure automated feeds and clean up historical accounts.</p>
                    </div>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 800; margin: 0 auto 20px;">3</div>
                        <h3 class="title h5" style="color: #fff; margin-bottom: 12px;">Routine Processing</h3>
                        <p class="disc" style="color: #94a3b8; font-size: 14px; margin: 0;">Your dedicated bookkeeper processes invoices, reconciles bank lines, and runs payday payroll seamlessly.</p>
                    </div>
                </div>
                <div class="xl:w-1/4 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px 24px; text-align: center; height: 100%;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 800; margin: 0 auto 20px;">4</div>
                        <h3 class="title h5" style="color: #fff; margin-bottom: 12px;">Monthly Reporting &amp; GST</h3>
                        <p class="disc" style="color: #94a3b8; font-size: 14px; margin: 0;">Receive clear monthly performance summaries, plus on-time GST preparation and direct IRD submission.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. STATS COUNTER -->
    <div style="background: #e53935; color: #fff; padding: 50px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] text-center">
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">99.8%</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">On-Time IRD Filing</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">250+</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">NZ Businesses Supported</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">40+</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">Hours Saved Per Month</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">100%</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">NZ Privacy Act Protected</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. CLIENT STORIES / TESTIMONIALS -->
    <div class="rts-client-feedback rts-section-gap" style="padding: 90px 0; background: #f8fafc;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 700px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Client Stories</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Trusted by Business Owners Across New Zealand</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">Here is how get-accountant helps Kiwi business owners sleep better at night.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php if (!empty($testimonials)): ?>
                    <?php foreach ($testimonials as $t): ?>
                    <div class="xl:w-1/2 px-[15px] pb--30">
                        <div style="background: #fff; border-radius: 16px; padding: 36px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                            <div style="color: #eab308; font-size: 16px; margin-bottom: 16px;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p style="color: #334155; font-size: 16px; line-height: 1.7; font-style: italic; margin-bottom: 24px; flex-grow: 1;">
                                &ldquo;<?php echo e($t['quote']); ?>&rdquo;
                            </p>
                            <div style="display: flex; align-items: center; gap: 14px; border-top: 1px solid #f1f5f9; padding-top: 18px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: #fee2e2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800;">
                                    <?php echo strtoupper(substr($t['client_name'], 0, 1)); ?>
                                </div>
                                <div>
                                    <h4 class="title" style="font-size: 17px; font-weight: 700; margin: 0 0 4px;"><?php echo e($t['client_name']); ?></h4>
                                    <span style="font-size: 13px; color: #64748b; font-weight: 500;"><?php echo e($t['client_role']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt--20">
                <a class="rts-read-more-two color-primary" href="client-stories.php" style="font-weight: 700;">Read More Client Case Studies <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- 9. FREQUENTLY ASKED QUESTIONS ACCORDION -->
    <div class="rts-faq-section rts-section-gap" style="padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Clear Answers</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 20px;">Frequently Asked Questions</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                        Have questions about switching accountants, software setup, or IRD deadlines? Here are the top questions Kiwi business owners ask us.
                    </p>
                    <div style="background: #f8fafc; border-radius: 12px; padding: 20px 24px; border-left: 4px solid #e53935;">
                        <h4 style="font-size: 16px; margin: 0 0 6px;">Have a specific question?</h4>
                        <p style="margin: 0; font-size: 14px; color: #64748b;">Reach out to our Auckland team anytime at <a href="mailto:info@get-accountant.com" style="color: #e53935; font-weight: 600;">info@get-accountant.com</a></p>
                    </div>
                    <div style="margin-top: 25px;">
                        <a class="rts-btn btn-primary" href="faqs.php">View All FAQs <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full mt_md--40 mt_sm--40">
                    <div class="accordion" id="accordionExample" style="display: flex; flex-direction: column; gap: 15px;">
                        <?php if (!empty($faqs)): ?>
                            <?php $fIdx = 0; foreach ($faqs as $f): $fIdx++; ?>
                            <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff;">
                                <h3 class="accordion-header" id="heading<?php echo $fIdx; ?>" style="margin: 0;">
                                    <button class="accordion-button <?php echo $fIdx !== 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $fIdx; ?>" aria-expanded="<?php echo $fIdx === 1 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $fIdx; ?>" style="padding: 20px 24px; font-weight: 700; font-size: 16px; color: #0f172a; width: 100%; text-align: left; display: flex; justify-content: space-between; align-items: center; border: none; background: #fff; cursor: pointer;">
                                        <span><?php echo e($f['question']); ?></span>
                                        <i class="fas fa-chevron-down" style="font-size: 13px; color: #e53935;"></i>
                                    </button>
                                </h3>
                                <div id="collapse<?php echo $fIdx; ?>" class="accordion-collapse collapse <?php echo $fIdx === 1 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $fIdx; ?>" style="padding: 0 24px 20px; color: #64748b; font-size: 15px; line-height: 1.6;">
                                    <div class="accordion-body">
                                        <?php echo e($f['answer']); ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 10. CALL TO ACTION BANNER -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <span style="color: #ff6b6b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 13px;">Ready to Get Your Weekends Back?</span>
                    <h2 class="title" style="color: #fff; font-size: 34px; margin: 10px 0 10px;">Let’s Simplify Your Bookkeeping &amp; Taxes Today</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Book a zero-obligation 20-minute consultation with our New Zealand team.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700; font-size: 16px;">Schedule Free Consultation <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
