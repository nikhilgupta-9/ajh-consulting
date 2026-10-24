<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'About Us';
$metaDescription = 'get-accountant provides outsourced accounting and bookkeeping for New Zealand businesses, and dedicated outsourcing capacity for accounting firms.';

require __DIR__ . '/includes/header.php';

// Admin-editable hero content (Admin > Page Content > About).
$aboutContent = ['heading' => '', 'subheading' => '', 'body' => '', 'image' => ''];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'about']);
        $found = $stmt->fetch();
        if ($found) {
            $aboutContent = $found;
        }
    } catch (Throwable $e) {
        // page_content not migrated yet — fall back to the defaults below.
    }
}

// Pull real team members from Admin > Team (falls back to an empty list if none yet).
$teamMembers = [];
if ($pdo) {
    try {
        $teamMembers = $pdo->query('SELECT * FROM team_members ORDER BY id ASC LIMIT 3')->fetchAll();
    } catch (Throwable $e) {
        $teamMembers = [];
    }
}
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/about.css'); ?>">

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">About Us</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='<?php echo site_url('index.php'); ?>'>Home</a>
                        <span> / </span>
                        <a class='active' href='#'>About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- ===== Who we are ===== -->
    <div class="about-intro">
        <div class="container">
            <div class="about-intro-grid">
                <div class="about-intro-image">
                    <img src="<?php echo e($aboutContent['image'] ?: site_url('assets/images/about/main/about-03.jpg')); ?>" alt="get-accountant team">
                </div>
                <div class="about-intro-copy">
                    <span class="about-eyebrow"><?php echo e($aboutContent['subheading'] ?: 'WHO WE ARE'); ?></span>
                    <h2><?php echo e($aboutContent['heading'] ?: 'Outsourced Accounting Built for Two Kinds of Clients'); ?></h2>
                    <p><?php echo e($aboutContent['body'] ?: 'get-accountant exists to solve two very different problems with one disciplined team: business owners who need accurate books and tax compliance without hiring in-house, and accounting firms that need extra qualified capacity during peak season without the overhead of a new hire.'); ?></p>
                    <ul class="about-intro-points">
                        <li><i class="fas fa-check-circle"></i> Dedicated New Zealand &amp; Australia focused team</li>
                        <li><i class="fas fa-check-circle"></i> Direct integration with Xero, MYOB &amp; CCH iFirm</li>
                        <li><i class="fas fa-check-circle"></i> Fixed, transparent monthly pricing — no surprises</li>
                    </ul>
                    <a class="rts-btn btn-primary" href="<?php echo site_url('contactus.php'); ?>">Talk to Our Team</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== The two paths we serve ===== -->
    <div class="about-paths">
        <div class="container">
            <div class="about-section-head">
                <p class="pre-title">Our Purpose</p>
                <h2 class="title">One Team. Two Ways We Help.</h2>
                <p class="about-section-sub">Whichever side of accounting you're on, our job is the same: give you accurate numbers and time back.</p>
            </div>
            <div class="about-paths-grid">
                <a class="about-path-card" href="<?php echo site_url('nz/accounting/'); ?>">
                    <div class="about-path-icon"><i class="fas fa-building"></i></div>
                    <h3>For Businesses</h3>
                    <p>Day-to-day bookkeeping, GST returns, payroll and management reporting — so you can run your business instead of your spreadsheets.</p>
                    <span class="about-path-link">Explore Business Services <i class="far fa-arrow-right"></i></span>
                </a>
                <a class="about-path-card" href="<?php echo site_url('nz/accounting-firm/'); ?>">
                    <div class="about-path-icon"><i class="fas fa-user-tie"></i></div>
                    <h3>For Accounting Firms</h3>
                    <p>Outsourced capacity for CA &amp; CPA practices — bookkeeping, year-end workpapers, financial statements and tax return preparation under your review.</p>
                    <span class="about-path-link">Explore Firm Outsourcing <i class="far fa-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>

    <!-- ===== Why choose us ===== -->
    <div class="about-values">
        <div class="container">
            <div class="about-section-head">
                <p class="pre-title">Why Choose Us</p>
                <h2 class="title">What Makes Us Dependable</h2>
            </div>
            <div class="about-values-grid">
                <div class="about-value-card">
                    <div class="about-value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4>Compliance First</h4>
                    <p>Every deliverable is built around NZ tax, GST and Holidays Act requirements — reviewed and signed off, not just filed.</p>
                </div>
                <div class="about-value-card">
                    <div class="about-value-icon"><i class="fas fa-users"></i></div>
                    <h4>A Dedicated Team</h4>
                    <p>You work with the same people every month, not a rotating queue — so context never gets lost between periods.</p>
                </div>
                <div class="about-value-card">
                    <div class="about-value-icon"><i class="fas fa-cloud"></i></div>
                    <h4>Modern Cloud Tools</h4>
                    <p>We work directly inside your existing Xero, MYOB or CCH iFirm setup — no migrations, no disruption to your workflow.</p>
                </div>
                <div class="about-value-card">
                    <div class="about-value-icon"><i class="fas fa-lock"></i></div>
                    <h4>Confidentiality by Design</h4>
                    <p>Encrypted systems, bilateral NDAs and strict access controls protect your data and your clients' data at every step.</p>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($teamMembers)): ?>
    <!-- ===== Leadership team ===== -->
    <div class="rts-team-area rts-section-gapBottom appoinment-team team-two">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-title-area team text-center">
                        <p class="pre-title">Our Leadership</p>
                        <h2 class="title">The People Behind the Numbers</h2>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--15 mt_sm--0">
                <?php foreach ($teamMembers as $member): ?>
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="team-inner-two">
                        <a class='thumbnail' href='<?php echo site_url('our-peoples.php'); ?>'>
                            <img src="<?php echo e($member['photo'] ?: site_url('assets/images/team/tm/lg-01.jpg')); ?>" alt="<?php echo e($member['name']); ?>">
                        </a>
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='<?php echo site_url('our-peoples.php'); ?>'>
                                    <h3 class="title h5"><?php echo e($member['name']); ?></h3>
                                </a>
                                <span><?php echo e($member['designation']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ===== FAQ ===== -->
    <div class="rts-faq-section rts-section-gap rts-faq-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="lg:w-1/2 px-[15px]">
                    <div class="faq-two-inner">
                        <div class="title-area-faq">
                            <span class="sub">FREQUENTLY ASKED QUESTIONS</span>
                            <h2 class="title">Clear Answers to Common Questions</h2>
                        </div>
                        <div class="faq-accordion-area">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span>01. </span> How does get-accountant work with our existing software?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            We connect directly into your existing Xero, MYOB, or CCH iFirm software. You do not need to migrate systems or change your chart of accounts. We adapt to your standard operating procedures.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span>02. </span> Are your services fully compliant with New Zealand regulations?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Yes. All deliverables are built around the New Zealand Tax Administration Act, Goods and Services Tax Act 1985, and Holidays Act 2003, with strict adherence to the NZ Privacy Act 2020.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <span>03. </span> How do you protect practice client confidentiality?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            We operate under comprehensive bilateral NDAs. Our staff work on secure, encrypted virtual machines with zero local data storage, multi-factor authentication, and IP-restricted cloud access.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 px-[15px]">
                    <div class="thumbnail-faq-four">
                        <img src="assets/images/faq/02.png" alt="FAQ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts faq section area End -->

    <!-- ===== Testimonials ===== -->
    <div class="rts-customer-feedback-area rts-section-gap bg-customer-feedback">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="rts-title-area feedback team text-center">
                    <p class="pre-title">Client Trust</p>
                    <h2 class="title">What Our New Zealand Clients Say</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--20">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/02.png" alt="Liam Gallagher">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">Liam Gallagher</h3>
                                <span class="designation">Managing Director, Auckland Trade Services</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                "get-accountant eliminated our end-of-month reconciliation headaches. Our GST returns are filed on time every period, and we finally have reliable monthly cashflow dashboards."
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/03.png" alt="Sarah Jenkins">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">Sarah Jenkins</h3>
                                <span class="designation">Principal CA, Christchurch Advisory Practice</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                "Partnering with get-accountant solved our senior staffing bottleneck during the peak March tax rush. Their workpapers are clean, indexed, and ready for partner review immediately."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customers feed back area end -->

    

<?php require __DIR__ . '/includes/footer.php'; ?>
