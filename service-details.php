<?php
require_once __DIR__ . '/config/config.php';

$allServices    = [];
$branchServices = [];
$service        = null;
$faqs           = [];
$contactSuccess = false;
$contactError   = null;

// Handle Sidebar Quick Consultation Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'service_lead') {
    if (!csrf_verify()) {
        $contactError = 'Security validation failed. Please refresh the page and try again.';
    } else {
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $phone   = trim($_POST['phone'] ?? '');
        $serviceName = trim($_POST['service'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if (empty($name) || empty($email)) {
            $contactError = 'Please provide your name and email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $contactError = 'Please provide a valid email address.';
        } else {
            if ($pdo = db()) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, message, status) 
                        VALUES ('contact', :name, :email, :phone, :subject, :service, :message, 'new')");
                    $stmt->execute([
                        'name'    => $name,
                        'email'   => $email,
                        'phone'   => $phone,
                        'subject' => 'Service Inquiry: ' . $serviceName,
                        'service' => $serviceName,
                        'message' => $message,
                    ]);
                    $contactSuccess = true;
                } catch (Throwable $e) {
                    $contactError = 'We could not save your request. Please email us directly at ' . BUSINESS_EMAIL;
                }
            }
        }
    }
}

if ($pdo = db()) {
    try {
        $allServices = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();

        $slug = $_GET['slug'] ?? null;
        if ($slug) {
            $stmt = $pdo->prepare('SELECT * FROM services WHERE slug = :slug LIMIT 1');
            $stmt->execute(['slug' => $slug]);
            $service = $stmt->fetch() ?: null;
        }
        if (!$service && !empty($allServices)) {
            $service = $allServices[0];
        }

        if ($service) {
            $bStmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC');
            $bStmt->execute(['b' => $service['branch']]);
            $branchServices = $bStmt->fetchAll();

            // First priority: FAQs specifically assigned to this exact service
            $fStmt = $pdo->prepare('SELECT * FROM faqs WHERE is_active = 1 AND service_id = :sid ORDER BY sort_order ASC, id ASC');
            $fStmt->execute(['sid' => (int) $service['id']]);
            $faqs = $fStmt->fetchAll();

            // If this service has fewer than 3 FAQs, supplement with general service details FAQs for this branch
            if (count($faqs) < 3) {
                $existingIds = array_column($faqs, 'id');
                $inClause = !empty($existingIds) ? 'AND id NOT IN (' . implode(',', array_map('intval', $existingIds)) . ')' : '';
                $needed = 5 - count($faqs);
                $suppStmt = $pdo->prepare("SELECT * FROM faqs WHERE is_active = 1 AND service_id IS NULL AND page IN ('service_details', 'all') AND branch = :b $inClause ORDER BY sort_order ASC, id ASC LIMIT $needed");
                $suppStmt->execute(['b' => $service['branch']]);
                $supplemental = $suppStmt->fetchAll();
                $faqs = array_merge($faqs, $supplemental);
            }
        }
    } catch (Throwable $e) {
        $allServices = [];
    }
}

if (!$service) {
    $service = [
        'title'             => 'Cloud Bookkeeping & Daily Reconciliations',
        'slug'              => 'bookkeeping',
        'branch'            => 'bookkeeping',
        'short_description' => 'Comprehensive accounting and compliance support for New Zealand businesses.',
        'description'       => '<p class="lead">We provide accurate, on-time accounting, payroll and tax filing across New Zealand.</p>',
        'image'             => 'assets/images/service/01.jpg',
    ];
    $branchServices = [$service];
}

$isFirm = ($service['branch'] === 'firm_outsourcing');
$branchName = $isFirm ? 'Accounting Practice Outsourcing' : 'Accounting & Bookkeeping';
$branchHubUrl = $isFirm ? site_url('nz/accounting-firm/services.php') : site_url('nz/accounting/services.php');

$pageTitle       = $service['title'] . ' | ' . $branchName . ' - get-accountant';
$metaDescription = $service['short_description'] ?? ('Explore ' . $service['title'] . ' by get-accountant.');

$settings = site_settings();

// Desk Phone & Clean link
$deskPhone = !empty($settings['phone']) && $settings['phone'] !== '+64 00 000 0000' ? $settings['phone'] : '+64 9 801 0123';
$cleanDeskPhone = preg_replace('/[^0-9+]/', '', $deskPhone);

// WhatsApp Number & URL
$waNumber = !empty($settings['whatsapp_number']) ? $settings['whatsapp_number'] : (!empty($settings['phone']) ? $settings['phone'] : '6498010123');
$waDigits = preg_replace('/[^0-9]/', '', $waNumber);
if (empty($waDigits)) {
    $waDigits = '6498010123';
}
$waMessage = rawurlencode("Hi get-accountant, I am inquiring about {$service['title']} and would like more details / pricing.");
$waUrl = "https://wa.me/{$waDigits}?text={$waMessage}";

$pageHeading = $service['title'];
$breadcrumbParent = [
    'label' => $isFirm ? 'Accounting Practice Outsourcing' : 'Accounting & Bookkeeping',
    'url'   => $branchHubUrl,
];

require __DIR__ . '/includes/header.php';
?>
<!-- Dedicated Service Details Stylesheet (Sticky form, Mobile PPC, FAQ) -->
<link rel="stylesheet" href="<?php echo site_url('assets/css/service-details.css'); ?>">

    <!-- 1. HERO -->
    <div class="sd-hero">
        <div class="container" style="position: relative;">
            <nav class="sd-breadcrumb-simple" aria-label="Breadcrumb">
                <a href="<?php echo site_url('index.php'); ?>">Home</a>
                <i class="fas fa-chevron-right"></i>
                <a href="<?php echo e($branchHubUrl); ?>"><?php echo e($branchName); ?></a>
                <i class="fas fa-chevron-right"></i>
                <span><?php echo e($service['title']); ?></span>
            </nav>

            <h1 class="sd-hero-title"><?php echo e($service['title']); ?></h1>
            <?php if (!empty($service['short_description'])): ?>
                <p class="sd-hero-desc"><?php echo e($service['short_description']); ?></p>
            <?php endif; ?>

            <div class="sd-hero-trust">
                <span class="sd-hero-pill"><i class="fas fa-check-circle"></i> 100% NZ IRD Compliant</span>
                <span class="sd-hero-pill"><i class="fas fa-check-circle"></i> <?php echo $isFirm ? 'CA ANZ Audit-Ready Workpapers' : 'Chartered Accountant Reviewed'; ?></span>
                <span class="sd-hero-pill"><i class="fas fa-check-circle"></i> Certified Xero &amp; MYOB Practice</span>
                <span class="sd-hero-pill"><i class="fas fa-check-circle"></i> Dedicated Senior Account Manager</span>
            </div>

            <div class="sd-hero-actions">
                <?php if (!empty($service['starting_price'])): ?>
                <div class="sd-hero-pricing">
                    <span class="label">Starting</span>
                    <span class="price">NZ$<?php echo e($service['starting_price']); ?></span>
                    <span class="period"><?php echo $isFirm ? '/workflow + GST' : '/mo + GST'; ?></span>
                </div>
                <?php endif; ?>
                <a href="#consultation" class="rts-btn btn-primary">Book a Free Consultation <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- 2. SERVICE DETAILS MAIN AREA -->
    <div class="rts-service-details-area sd-main-area" style="padding: 60px 0 80px;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]" style="align-items: flex-start;">
                
                <!-- MAIN CONTENT (LEFT 8 COLUMNS) -->
                <div class="xl:w-2/3 lg:w-2/3 px-[15px] md:w-full sm:w-full w-full">
                    <div class="sd-content-col">
                        
                        <!-- Main Service Cover Image -->
                        <div class="sd-cover-wrap">
                            <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/01.jpg'); ?>" alt="<?php echo e($service['title']); ?>">
                            <div class="sd-cover-badge">
                                <i class="fas fa-check-circle"></i> Standard Operating Procedure Certified
                            </div>
                        </div>

                        <!-- Rich Description (Enriched Scope & What's Included) -->
                        <div class="service-rich-body">
                            <?php 
                            if (!empty($service['description'])) {
                                echo $service['description'];
                            } else {
                                echo '<p class="lead">At get-accountant, our dedicated team delivers this service with rigorous quality standards, on-time filing commitments, and proactive advice tailored to New Zealand regulations.</p>';
                            }
                            ?>
                        </div>

                        <!-- 4-Step Delivery Workflow Box (Standardized Quality Process) -->
                        <div class="sd-process-box">
                            <span class="sd-section-eyebrow">Standardized Quality Process</span>
                            <h3 class="sd-process-title">How We Deliver This Service</h3>
                            
                            <div class="sd-grid-2">
                                <div class="sd-step-card">
                                    <div class="sd-step-header">
                                        <span class="sd-step-number">1</span>
                                        <h4 class="sd-step-title">Scoping &amp; Integration</h4>
                                    </div>
                                    <p class="sd-step-desc">We establish secure cloud access, align on chart of accounts, and review your historical records.</p>
                                </div>
                                <div class="sd-step-card">
                                    <div class="sd-step-header">
                                        <span class="sd-step-number">2</span>
                                        <h4 class="sd-step-title">Processing &amp; Coding</h4>
                                    </div>
                                    <p class="sd-step-desc">Daily or weekly execution strictly adhering to standard operating procedures and NZ tax rules.</p>
                                </div>
                                <div class="sd-step-card">
                                    <div class="sd-step-header">
                                        <span class="sd-step-number">3</span>
                                        <h4 class="sd-step-title">Multi-Tier Quality Audit</h4>
                                    </div>
                                    <p class="sd-step-desc">Every file undergoes secondary review by a designated senior accountant before partner sign-off.</p>
                                </div>
                                <div class="sd-step-card">
                                    <div class="sd-step-header">
                                        <span class="sd-step-number">4</span>
                                        <h4 class="sd-step-title">Reporting &amp; Compliance</h4>
                                    </div>
                                    <p class="sd-step-desc">Clear client reports delivered on schedule, alongside proactive statutory IRD filing reminders.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Software & Technology Ecosystem -->
                        <div class="sd-tech-box">
                            <h3 style="font-size: 22px; color: #0f172a; margin-bottom: 8px; font-weight: 800;">Supported Software &amp; Tech Stack</h3>
                            <p style="color: #64748b; font-size: 14.5px; margin-bottom: 14px;">We seamlessly work directly inside your existing cloud tools with secure 2FA authentication:</p>
                            <div class="sd-tech-pills">
                                <div class="sd-tech-pill"><i class="fas fa-check"></i> Xero Certified Partner</div>
                                <div class="sd-tech-pill"><i class="fas fa-check"></i> MYOB Practice / Business</div>
                                <div class="sd-tech-pill"><i class="fas fa-check"></i> Dext Prepare &amp; Hubdoc</div>
                                <div class="sd-tech-pill"><i class="fas fa-check"></i> Inland Revenue myIR</div>
                                <div class="sd-tech-pill"><i class="fas fa-check"></i> CCH iFirm / Karbon</div>
                            </div>
                        </div>

                        <!-- What Changes Comparison -->
                        <div class="sd-comparison-box">
                            <h3 style="font-size: 22px; color: #0f172a; margin-bottom: 18px; font-weight: 800;">
                                What Changes With <?php echo $isFirm ? 'Outsourced Support' : 'get-accountant'; ?>?
                            </h3>
                            <div class="sd-grid-2">
                                <div class="sd-comp-card sd-comp-left">
                                    <span class="sd-comp-tag-left"><?php echo $isFirm ? 'In-House Production' : 'Doing It Yourself'; ?></span>
                                    <ul class="sd-comp-list">
                                        <?php foreach (($isFirm ? [
                                            'Senior staff pulled into data entry instead of advisory',
                                            'Capacity fixed to headcount — peak season creates backlogs',
                                            'Onboarding a new hire takes weeks before they are productive',
                                            'Staff resignations take institutional knowledge with them',
                                        ] : [
                                            'Hours spent on data entry instead of running the business',
                                            'Reconciliations and GST filing done in spare time, often late',
                                            'No second set of eyes before numbers are relied on',
                                            'Software setup and compliance changes tracked ad hoc',
                                        ]) as $pt): ?>
                                        <li>
                                            <i class="far fa-times-circle" style="color: #cbd5e1; margin-top: 3px; flex-shrink: 0;"></i>
                                            <span><?php echo e($pt); ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="sd-comp-card sd-comp-right">
                                    <span class="sd-comp-tag-right">With get-accountant</span>
                                    <ul class="sd-comp-list">
                                        <?php foreach (($isFirm ? [
                                            'Dedicated pod of senior accountants scoped to your firm SOPs',
                                            'Flexible capacity that scales up for March/April peak season',
                                            'Files ready for a 10-minute partner review, not a rebuild',
                                            'Consistent named team retained year over year',
                                        ] : [
                                            'Your time back to focus on customers and revenue growth',
                                            'GST returns and reconciliations filed on time, every period',
                                            'A dedicated bookkeeper reviewing your numbers monthly',
                                            'Proactive alerts on IRD deadlines and statutory changes',
                                        ]) as $pt): ?>
                                        <li>
                                            <i class="fas fa-check-circle" style="color: #22c55e; margin-top: 3px; flex-shrink: 0;"></i>
                                            <span><?php echo e($pt); ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Redesigned Service FAQs Accordion -->
                        <?php if (!empty($faqs)): ?>
                        <div class="sd-faq-section" id="faqs">
                            <div class="sd-faq-head">
                                <span class="sd-section-eyebrow">Clear Answers</span>
                                <h3>Frequently Asked Questions</h3>
                                <p>Answers about turnaround times, data security, software access, and onboarding.</p>
                            </div>
                            <div class="sd-faq-list">
                                <?php $sIdx = 0; foreach ($faqs as $sf): $sIdx++; ?>
                                <details class="sd-faq-item" <?php echo $sIdx === 1 ? 'open' : ''; ?>>
                                    <summary class="sd-faq-summary">
                                        <div class="sd-faq-qwrap">
                                            <span class="sd-faq-icon">Q<?php echo $sIdx; ?></span>
                                            <span><?php echo e($sf['question']); ?></span>
                                        </div>
                                        <span class="sd-faq-chevron"><i class="fas fa-chevron-down"></i></span>
                                    </summary>
                                    <div class="sd-faq-answer">
                                        <p><?php echo e($sf['answer']); ?></p>
                                    </div>
                                </details>
                                <?php endforeach; ?>
                            </div>
                            <div style="margin-top: 20px; padding: 16px 20px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                                <span style="font-size: 14px; color: #64748b; font-weight: 500;">
                                    Have a specific question about your accounting setup?
                                </span>
                                <a href="<?php echo e($waUrl); ?>" target="_blank" rel="noopener" style="font-size: 13.5px; font-weight: 700; color: #25D366; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="fab fa-whatsapp"></i> Ask directly on WhatsApp &rarr;
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- SIDEBAR (RIGHT 4 COLUMNS - STICKY / FLOATING ON DESKTOP) -->
                <div class="xl:w-1/3 lg:w-1/3 px-[15px] md:w-full sm:w-full w-full sd-sidebar-col">
                    <div class="service-sidebar-sticky">
                        <div class="service-sidebar">
                            
                            <!-- NAVIGATION MENU OF SAME-BRANCH SERVICES (TOP WIDGET) -->
                            <div class="sd-rel-card">
                                <h4 class="sd-rel-title">
                                    <span><?php echo $isFirm ? 'Other Practice Services' : 'Other Business Services'; ?></span>
                                    <a href="<?php echo e($branchHubUrl); ?>" style="font-size: 12.5px; color: var(--color-primary, #fd5f00); text-decoration: none; font-weight: 700;">View All &rarr;</a>
                                </h4>
                                <ul class="sd-rel-list">
                                    <?php foreach ($branchServices as $bs): 
                                        $isActive = ($bs['id'] === $service['id']);
                                        $bsUrl = site_url('service-details.php') . '?slug=' . urlencode($bs['slug']);
                                    ?>
                                    <li class="sd-rel-item">
                                        <a href="<?php echo e($bsUrl); ?>" class="<?php echo $isActive ? 'active' : ''; ?>">
                                            <span><?php echo e($bs['title']); ?></span>
                                            <i class="far fa-chevron-right" style="font-size: 11px;"></i>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- CONSULTATION & SCOPE FORM CARD (STICKY / ACTION CARD) -->
                            <div id="consultation" class="sd-form-card" style="scroll-margin-top: 100px;">
                                <span class="sd-form-badge">
                                    <i class="fas fa-bolt"></i> FAST CONSULTATION &amp; SCOPE
                                </span>
                                <h3 class="sd-form-title">Inquire About This Service</h3>
                                <p class="sd-form-desc">
                                    Get a transparent quote, tailored SOP, and SLA details within 1 business day.
                                </p>

                                <?php if ($contactSuccess): ?>
                                    <div style="background: #22c55e; color: #fff; padding: 12px 14px; border-radius: 8px; font-size: 13.5px; font-weight: 600; margin-bottom: 14px;">
                                        ✓ Thank you! Your inquiry has been received. Our senior advisor will contact you within 1 business day.
                                    </div>
                                <?php endif; ?>

                                <?php if ($contactError): ?>
                                    <div style="background: #ef4444; color: #fff; padding: 12px 14px; border-radius: 8px; font-size: 13.5px; margin-bottom: 14px;">
                                        ✕ <?php echo e($contactError); ?>
                                    </div>
                                <?php endif; ?>

                                <form action="#consultation" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="action" value="service_lead">
                                    <input type="hidden" name="service" value="<?php echo e($service['title']); ?>">

                                    <div class="sd-form-group">
                                        <input type="text" name="name" placeholder="Your Full Name *" required>
                                    </div>
                                    <div class="sd-form-group">
                                        <input type="email" name="email" placeholder="Your Email Address *" required>
                                    </div>
                                    <div class="sd-form-group">
                                        <input type="tel" name="phone" placeholder="Phone Number (e.g. 021 123 4567)">
                                    </div>
                                    <div class="sd-form-group">
                                        <textarea name="message" rows="3" placeholder="Tell us briefly about your business, transaction volume, or software..."></textarea>
                                    </div>
                                    <button type="submit" class="sd-form-submit-btn">
                                        Submit Consultation Request <i class="far fa-arrow-right"></i>
                                    </button>
                                </form>

                                <div class="sd-form-trust-note">
                                    <i class="fas fa-lock"></i> 100% Confidential &bull; No-Obligation Initial Audit
                                </div>

                                <!-- QUICK ACCESS ACTION BUTTONS (WHATSAPP & CALL) DIRECTLY UNDER FORM -->
                                <div class="sd-action-buttons-wrap">
                                    <span class="sd-action-label">Or Connect Instantly</span>

                                    <!-- WhatsApp Action Button -->
                                    <a href="<?php echo e($waUrl); ?>" target="_blank" rel="noopener" class="sd-action-btn sd-btn-whatsapp">
                                        <span class="sd-btn-icon"><i class="fab fa-whatsapp"></i></span>
                                        <div class="sd-btn-info">
                                            <strong>Chat on WhatsApp</strong>
                                            <small>Instant reply &bull; Direct to Advisor</small>
                                        </div>
                                        <i class="far fa-arrow-right sd-btn-chevron"></i>
                                    </a>

                                    <!-- Call Action Button -->
                                    <a href="tel:<?php echo e($cleanDeskPhone); ?>" class="sd-action-btn sd-btn-call">
                                        <span class="sd-btn-icon"><i class="fas fa-phone-alt"></i></span>
                                        <div class="sd-btn-info">
                                            <strong>Call Advisory Desk</strong>
                                            <small><?php echo e($deskPhone); ?> &bull; Mon-Fri</small>
                                        </div>
                                        <i class="far fa-arrow-right sd-btn-chevron"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
