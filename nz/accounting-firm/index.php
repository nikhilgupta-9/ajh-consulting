<?php
require_once __DIR__ . '/../../config/config.php';

$country         = 'nz';
$branch          = 'firm_outsourcing';
$pageTitle       = 'New Zealand Accounting Firm Outsourcing Services';
$metaDescription = 'Dedicated white-label outsourcing for New Zealand CA and CPA firms: AP/AR processing, payroll, GST workpapers, and year-end compliance.';
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
                <!-- Slide 1: Primary Value Proposition for Firms -->
                <div class="swiper-slide">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>NEW ZEALAND</span> FIRM OUTSOURCING PARTNER
                        </p>
                        <h1 class="title">
                            Scale Your <span>Accounting Firm</span> <br>
                            Without Hiring Pains
                        </h1>
                        <p class="disc banner-para">
                            Expand your practice capacity with dedicated, white-label offshore accountants trained in NZ GAAP, IRD tax compliance, Xero, and MYOB Practice Manager. Retain 100% client ownership and eliminate bottlenecks.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='contact.php' style="padding: 16px 32px; font-weight: 600;">Schedule Practice Assessment <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='services.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">Outsourcing Services</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-shield-alt" style="color: #22c55e;"></i> Strict Mutual NDA</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> CA ANZ Standard Workpapers</span>
                            <span><i class="fas fa-lock" style="color: #22c55e;"></i> 100% White-Label Delivery</span>
                        </div>
                        <img class="shape-img one" src="<?php echo site_url('assets/images/banner/shape/01.png'); ?>" alt="banner_shape">
                    </div>
                </div>

                <!-- Slide 2: Security & Confidentiality -->
                <div class="swiper-slide two">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>ENTERPRISE SECURITY</span> SOC 2 &amp; ISO 27001
                        </p>
                        <h1 class="title">
                            Bank-Grade <span>Data Security</span> <br>
                            &amp; Strict Confidentiality
                        </h1>
                        <p class="disc banner-para">
                            Work directly inside your firm's cloud environment. Zero local data storage, multi-factor authentication, non-disclosure agreements, and strict New Zealand Privacy Act compliance.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='technology.php' style="padding: 16px 32px; font-weight: 600;">Explore Security Protocols <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='why-partner.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">Why Partner with Us</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> NZ Privacy Act Protected</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Zero Local Data Download</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> VPN &amp; MFA Remote Access</span>
                        </div>
                        <img class="shape-img one" src="<?php echo site_url('assets/images/banner/shape/01.png'); ?>" alt="banner_shape">
                    </div>
                </div>

                <!-- Slide 3: Practice Growth & Capacity -->
                <div class="swiper-slide three">
                    <div class="banner-one-inner text-left">
                        <p class="pre-title">
                            <span>PROVEN PRACTICE CAPACITY</span> 40-50% COST SAVINGS
                        </p>
                        <h1 class="title">
                            Supercharge <span>Firm Margins</span> <br>
                            &amp; Eliminate Burnout
                        </h1>
                        <p class="disc banner-para">
                            Eliminate tax season crunch. From annual workpapers and GST review to trial balance and client tax returns, our skilled accountants act as your seamless back-office team.
                        </p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; margin-top: 30px;">
                            <a class='rts-btn btn-primary color-h-black' href='contact.php' style="padding: 16px 32px; font-weight: 600;">Request Scoping Call <i class="far fa-arrow-right"></i></a>
                            <a class='rts-btn btn-primary-alta' href='case-studies.php' style="background: rgba(255,255,255,0.9); color: #1c2539; border: 1px solid #cbd5e1; padding: 16px 28px; font-weight: 600;">Firm Case Studies</a>
                        </div>
                        <div class="hero-trust-badges-light">
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> 30+ Hours Saved / Week</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> 40-50% Overhead Reduction</span>
                            <span><i class="fas fa-check-circle" style="color: #22c55e;"></i> Scalable On Demand</span>
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

    <!-- 2. FIRM VALUE PROPOSITION STRIP (3 CARDS) -->
    <div class="rts-feature-area" style="margin-top: -50px; position: relative; z-index: 10;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Solve Talent Shortages</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">Access experienced, pre-trained accounting professionals instantly without exorbitant recruitment commissions or months of training.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #0f172a; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #f1f5f9; color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-file-check"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Audit-Ready Workpapers</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">Completed to 95% following your firm's templates and CA ANZ standards, allowing partners to review and sign off in 5 minutes.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 32px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935; transition: transform .3s;">
                        <div style="width: 55px; height: 55px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px;">Zero Client Poaching Guarantee</h3>
                        <p class="disc" style="color: #64748b; font-size: 15px; margin: 0;">Guaranteed by legally enforceable non-solicitation contracts. We exist purely as your firm's private back-office production team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/../../includes/firm-outsourcing-subnav.php'; ?>

    <!-- 3. ABOUT FIRM PARTNERSHIP MODEL -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full">
                    <div style="position: relative; padding-right: 20px;">
                        <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            <img src="<?php echo site_url('assets/images/about/04.jpg'); ?>" alt="Accounting Firm Partnership" style="width: 100%;">
                        </div>
                        <div style="position: absolute; bottom: 30px; left: 30px; background: #0b1220; color: #fff; padding: 24px 30px; border-radius: 14px; max-width: 280px; border-left: 4px solid #e53935;">
                            <span style="font-size: 36px; font-weight: 800; line-height: 1; display: block; color: #e53935;">100%</span>
                            <span style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #cbd5e1;">White-Label Integration Into Your Firm</span>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] w-full mt_md--40 mt_sm--40">
                    <div class="rts-title-area">
                        <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Why Partner With Us</span>
                        <h2 class="title" style="font-size: 36px; margin: 12px 0 20px;">Your Firm's Scalable Back-Office Production Unit</h2>
                        <p class="disc" style="color: #475569; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                            Modern accounting firm partners want to focus on high-value advisory, tax strategy, and client relationships. But routine compliance, bank reconciliations, and payroll consume up to 70% of your staff hours. <strong>get-accountant</strong> solves this operational dilemma.
                        </p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px;">
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Works in Your Practice Suite
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Follows Your Firm’s SOPs
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> Dedicated Named Accountants
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #1e293b;">
                                <i class="fas fa-check-circle" style="color: #e53935;"></i> NZ Privacy Act 2020 Compliant
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <a class="rts-btn btn-primary" href="why-partner.php">Why Partner With Us <i class="far fa-arrow-right"></i></a>
                            <a class="rts-read-more-two color-primary" href="how-we-work.php" style="font-weight: 700;">How We Work With Firms <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. FIRM OUTSOURCING SERVICES (DYNAMIC FROM DB) -->
    <div class="rts-service-area rts-section-gap bg-service-h2" style="background: #f8fafc; padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom: 50px;">
                <div class="xl:w-2/3 lg:w-2/3 px-[15px]">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">B2B Firm Solutions</span>
                    <h2 class="title" style="font-size: 36px; margin-top: 10px;">Outsourcing Services for Accounting Practices</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; margin: 0;">Outsource routine compliance workflows end-to-end or offload specific bottlenecks during peak tax season.</p>
                </div>
                <div class="xl:w-1/3 lg:w-1/3 px-[15px] text-right">
                    <a class="rts-btn btn-primary-alta" href="services.php" style="border: 2px solid #e53935; color: #e53935; background: transparent; padding: 12px 24px;">View All Firm Services <i class="far fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php if (empty($services)): ?>
                    <p class="disc text-center w-full">Services are being loaded from the database.</p>
                <?php else: ?>
                    <?php foreach ($services as $service): 
                        $detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                    ?>
                    <div class="xl:w-1/3 lg:w-1/2 md:w-1/2 px-[15px] pb--30">
                        <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column; border: 1px solid #e2e8f0; transition: transform .3s, box-shadow .3s;">
                            <div style="height: 180px; overflow: hidden; position: relative;">
                                <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/10.jpg'); ?>" alt="<?php echo e($service['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; bottom: 15px; left: 20px; width: 48px; height: 48px; border-radius: 12px; background: #0b1220; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; border-left: 3px solid #e53935; box-shadow: 0 8px 16px rgba(0,0,0,0.3);">
                                    <i class="fas fa-briefcase"></i>
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
                                        Service Scope &amp; Deliverables <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                                    </a>
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">White-Label</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 5. PRACTICE SOFTWARE & SECURITY INTEGRATION -->
    <div class="rts-tech-area rts-section-gap" style="padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 750px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Zero Friction Setup</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Compatible With Your Existing Practice Suite</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">We do not ask your firm to adopt new software. We log into your existing systems and follow your established templates.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px] justify-center">
                <?php 
                $techPlatforms = [
                    ['name' => 'Xero Practice Manager', 'role' => 'XPM Jobs & Workpapers', 'desc' => 'Job milestone tracking, workpapers compilation, and direct tax return drafts.'],
                    ['name' => 'CCH iFirm', 'role' => 'Practice Management', 'desc' => 'Seamless timesheet, task assignment, and compliance ledger production.'],
                    ['name' => 'MYOB Practice Solutions', 'role' => 'Compliance & Tax', 'desc' => 'Multi-entity ledger processing, depreciation registers, and tax reporting.'],
                    ['name' => 'Dext Prepare & Hubdoc', 'role' => 'Document Extraction', 'desc' => 'Receipt OCR extraction, rule setting, and auto-publishing to client ledgers.'],
                    ['name' => 'Karbon & FYI Docs', 'role' => 'Practice Workflow & DMS', 'desc' => 'Automated workpaper filing, task statuses, and client email trails.'],
                    ['name' => 'Inland Revenue (myIR)', 'role' => 'Direct Tax Submissions', 'desc' => 'Preparing draft GST, PAYE and annual returns ready for authorized partner filing.'],
                ];
                foreach ($techPlatforms as $tp):
                ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <h3 class="title h5" style="margin: 0; font-size: 19px; color: #0f172a;"><?php echo e($tp['name']); ?></h3>
                            <span style="font-size: 11px; font-weight: 700; color: #e53935; background: #fef2f2; padding: 3px 8px; border-radius: 6px; text-transform: uppercase;"><?php echo e($tp['role']); ?></span>
                        </div>
                        <p class="disc" style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0;"><?php echo e($tp['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt--20">
                <a class="rts-btn btn-primary" href="technology.php">Explore Our Technology &amp; Security Stack <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- 6. PRACTICE INTEGRATION PROCESS (5 STEPS) -->
    <div class="working-process-area rts-section-gap working-process-bg" style="background: #0b1220; color: #fff; padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 750px;">
                    <span style="color: #ff6b6b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Seamless Onboarding</span>
                    <h2 class="title" style="color: #fff; font-size: 36px; margin: 10px 0 15px;">How We Integrate With Your Accounting Practice</h2>
                    <p class="disc" style="color: #94a3b8; font-size: 16px;">A structured 5-step integration framework ensuring zero disruption and complete peace of mind.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-1/5 md:w-1/3 sm:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 26px 18px; text-align: center; height: 100%;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; margin: 0 auto 16px;">1</div>
                        <h4 style="color: #fff; font-size: 17px; margin-bottom: 8px;">Mutual NDA</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Binding non-disclosure and non-solicitation agreement signed before any scoping.</p>
                    </div>
                </div>
                <div class="xl:w-1/5 md:w-1/3 sm:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 26px 18px; text-align: center; height: 100%;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; margin: 0 auto 16px;">2</div>
                        <h4 style="color: #fff; font-size: 17px; margin-bottom: 8px;">SOP Alignment</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">We review your firm’s chart of accounts, workpaper templates, and quality checklists.</p>
                    </div>
                </div>
                <div class="xl:w-1/5 md:w-1/3 sm:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 26px 18px; text-align: center; height: 100%;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; margin: 0 auto 16px;">3</div>
                        <h4 style="color: #fff; font-size: 17px; margin-bottom: 8px;">Pilot Batch</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">We complete 2 to 3 sample jobs or GST returns so you can inspect workpaper caliber firsthand.</p>
                    </div>
                </div>
                <div class="xl:w-1/5 md:w-1/3 sm:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 26px 18px; text-align: center; height: 100%;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; margin: 0 auto 16px;">4</div>
                        <h4 style="color: #fff; font-size: 17px; margin-bottom: 8px;">Dedicated Team</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Named senior accountants allocated to your account, ensuring continuity of firm knowledge.</p>
                    </div>
                </div>
                <div class="xl:w-1/5 md:w-1/3 sm:w-1/2 px-[15px] pb--30">
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 26px 18px; text-align: center; height: 100%;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; margin: 0 auto 16px;">5</div>
                        <h4 style="color: #fff; font-size: 17px; margin-bottom: 8px;">Partner Review</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Work delivered to 95% completion ready for partner sign-off and client filing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. PRACTICE STATS COUNTER -->
    <div style="background: #e53935; color: #fff; padding: 50px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] text-center">
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">45%</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">Avg. Practice Cost Reduction</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">30+</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">Partner Hours Saved Weekly</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">100%</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">White-Label Delivery Guarantee</div>
                </div>
                <div class="xl:w-1/4 md:w-1/2 px-[15px] py--15">
                    <div style="font-size: 44px; font-weight: 800; line-height: 1; margin-bottom: 8px;">0%</div>
                    <div style="font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9;">Client Poaching Guarantee</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. PRACTICE CASE STUDIES & PARTNER TESTIMONIALS -->
    <div class="rts-client-feedback rts-section-gap" style="padding: 90px 0; background: #f8fafc;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 700px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Proven Practice Results</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">What New Zealand CA Partners Say</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">Real feedback from practice owners who transformed their margins through get-accountant.</p>
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
                <a class="rts-read-more-two color-primary" href="case-studies.php" style="font-weight: 700;">Read Accounting Practice Case Studies <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- 9. PRACTICE FREQUENTLY ASKED QUESTIONS -->
    <div class="rts-faq-section rts-section-gap" style="padding: 90px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Firm Partner FAQs</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 20px;">Questions from Practice Partners</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                        Partnering with an outsourcing unit requires total trust. Here is how we ensure strict confidentiality, compliance, and seamless execution for your firm.
                    </p>
                    <div style="background: #f8fafc; border-radius: 12px; padding: 20px 24px; border-left: 4px solid #e53935;">
                        <h4 style="font-size: 16px; margin: 0 0 6px;">Want to review our mutual NDA?</h4>
                        <p style="margin: 0; font-size: 14px; color: #64748b;">Contact our partnership director at <a href="mailto:partners@get-accountant.com" style="color: #e53935; font-weight: 600;">partners@get-accountant.com</a></p>
                    </div>
                    <div style="margin-top: 25px;">
                        <a class="rts-btn btn-primary" href="faqs.php">View All Practice FAQs <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full mt_md--40 mt_sm--40">
                    <div class="accordion" id="accordionExample2" style="display: flex; flex-direction: column; gap: 15px;">
                        <?php if (!empty($faqs)): ?>
                            <?php $fIdx = 0; foreach ($faqs as $f): $fIdx++; ?>
                            <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff;">
                                <h3 class="accordion-header" id="headingFo<?php echo $fIdx; ?>" style="margin: 0;">
                                    <button class="accordion-button <?php echo $fIdx !== 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFo<?php echo $fIdx; ?>" aria-expanded="<?php echo $fIdx === 1 ? 'true' : 'false'; ?>" aria-controls="collapseFo<?php echo $fIdx; ?>" style="padding: 20px 24px; font-weight: 700; font-size: 16px; color: #0f172a; width: 100%; text-align: left; display: flex; justify-content: space-between; align-items: center; border: none; background: #fff; cursor: pointer;">
                                        <span><?php echo e($f['question']); ?></span>
                                        <i class="fas fa-chevron-down" style="font-size: 13px; color: #e53935;"></i>
                                    </button>
                                </h3>
                                <div id="collapseFo<?php echo $fIdx; ?>" class="accordion-collapse collapse <?php echo $fIdx === 1 ? 'show' : ''; ?>" aria-labelledby="headingFo<?php echo $fIdx; ?>" style="padding: 0 24px 20px; color: #64748b; font-size: 15px; line-height: 1.6;">
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
                    <span style="color: #ff6b6b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 13px;">Ready to Scale Your Accounting Firm?</span>
                    <h2 class="title" style="color: #fff; font-size: 34px; margin: 10px 0 10px;">Schedule a 30-Minute Confidential Capacity Assessment</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Discuss your firm’s current bottleneck, workflow volume, and test a pilot batch under full NDA.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700; font-size: 16px;">Schedule Assessment <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
