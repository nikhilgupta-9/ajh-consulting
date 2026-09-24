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

            $fStmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 4');
            $fStmt->execute(['b' => $service['branch']]);
            $faqs = $fStmt->fetchAll();
        }
    } catch (Throwable $e) {
        $allServices = [];
    }
}

if (!$service) {
    $service = [
        'title'             => 'Accounting & Bookkeeping',
        'slug'              => 'bookkeeping-bank-reconciliation',
        'branch'            => 'bookkeeping',
        'short_description' => 'Comprehensive accounting and compliance support for New Zealand businesses.',
        'description'       => '<p>We provide accurate, on-time accounting, payroll and tax filing across New Zealand.</p>',
        'image'             => 'assets/images/service/01.jpg',
    ];
    $branchServices = [$service];
}

$isFirm = ($service['branch'] === 'firm_outsourcing');
$branchName = $isFirm ? 'Accounting Firm Outsourcing' : 'Accounting & Bookkeeping';
$branchHubUrl = $isFirm ? site_url('nz/accounting-firm/') : site_url('nz/accounting/');

$pageTitle       = $service['title'] . ' | ' . $branchName;
$metaDescription = $service['short_description'] ?? ('Explore ' . $service['title'] . ' by get-accountant.');

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); padding: 80px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-2/3 px-[15px] lg:w-2/3 md:w-2/3 sm:w-full w-full breadcrumb-1">
                    <div style="display: inline-block; background: rgba(229,57,53,0.15); border: 1px solid rgba(229,57,53,0.3); color: #ff6b6b; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 12px;">
                        <?php echo e($branchName); ?>
                    </div>
                    <h1 class="title" style="color: #fff; font-size: 38px; margin: 0;"><?php echo e($service['title']); ?></h1>
                </div>
                <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/3 sm:w-full w-full text-right mt_sm--20">
                    <div class="bread-tag" style="color: #cbd5e1; font-size: 14px;">
                        <a href="<?php echo site_url('index.php'); ?>" style="color: #cbd5e1;">Home</a>
                        <span> / </span>
                        <a href="<?php echo e($branchHubUrl); ?>" style="color: #cbd5e1;"><?php echo $isFirm ? 'Firm Support' : 'Bookkeeping'; ?></a>
                        <span> / </span>
                        <span class="active" style="color: #e53935; font-weight: 600;"><?php echo e($service['title']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap" style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                
                <!-- MAIN CONTENT (LEFT 8 COLUMNS) -->
                <div class="xl:w-2/3 lg:w-2/3 px-[15px] md:w-full sm:w-full w-full">
                    <div class="service-details-content-step" style="padding-right: 20px;">
                        
                        <!-- Main Service Cover Image -->
                        <div style="border-radius: 16px; overflow: hidden; margin-bottom: 35px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); max-height: 420px;">
                            <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/01.jpg'); ?>" alt="<?php echo e($service['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Service Title & Subtitle -->
                        <h2 class="title" style="font-size: 32px; color: #0f172a; margin-bottom: 15px; font-weight: 800;">
                            <?php echo e($service['title']); ?>
                        </h2>

                        <?php if (!empty($service['short_description'])): ?>
                        <div style="background: #f8fafc; border-left: 4px solid #e53935; padding: 20px 24px; border-radius: 0 10px 10px 0; margin-bottom: 30px;">
                            <p style="margin: 0; font-size: 16.5px; line-height: 1.6; color: #334155; font-weight: 500;">
                                <?php echo e($service['short_description']); ?>
                            </p>
                        </div>
                        <?php endif; ?>

                        <!-- Rich Description -->
                        <div class="service-rich-body" style="color: #475569; font-size: 15.5px; line-height: 1.8; margin-bottom: 40px;">
                            <?php 
                            if (!empty($service['description'])) {
                                echo $service['description'];
                            } else {
                                echo '<p>At get-accountant, our dedicated team delivers this service with rigorous quality standards, on-time filing commitments, and proactive advice tailored to New Zealand regulations.</p>';
                            }
                            ?>
                        </div>

                        <!-- 4-Step Delivery Workflow Box -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 30px; margin-bottom: 45px;">
                            <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 12.5px;">Standardized Quality Process</span>
                            <h3 style="font-size: 24px; color: #0f172a; margin: 8px 0 25px; font-weight: 700;">How We Deliver This Service</h3>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <span style="width: 32px; height: 32px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">1</span>
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Scoping &amp; Integration</h4>
                                    </div>
                                    <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">We establish secure cloud access, align on chart of accounts, and review your historical records.</p>
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <span style="width: 32px; height: 32px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">2</span>
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Processing &amp; Coding</h4>
                                    </div>
                                    <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">Daily or weekly execution strictly adhering to standard operating procedures and tax rules.</p>
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <span style="width: 32px; height: 32px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">3</span>
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Multi-Tier Quality Audit</h4>
                                    </div>
                                    <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">Every file undergoes secondary review by a designated senior accountant before sign-off.</p>
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <span style="width: 32px; height: 32px; border-radius: 50%; background: #e53935; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">4</span>
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">Reporting &amp; Compliance</h4>
                                    </div>
                                    <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">Clear client reports delivered on schedule, alongside proactive statutory IRD filing reminders.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Software & Technology Ecosystem -->
                        <div style="margin-bottom: 45px;">
                            <h3 style="font-size: 22px; color: #0f172a; margin-bottom: 18px; font-weight: 700;">Supported Software &amp; Tech Stack</h3>
                            <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check" style="color: #22c55e;"></i> Xero Certified Partner
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check" style="color: #22c55e;"></i> MYOB Practice / Business
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check" style="color: #22c55e;"></i> Dext Prepare &amp; Hubdoc
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check" style="color: #22c55e;"></i> Inland Revenue myIR
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check" style="color: #22c55e;"></i> CCH iFirm / Karbon
                                </div>
                            </div>
                        </div>

                        <!-- Service FAQs Accordion -->
                        <?php if (!empty($faqs)): ?>
                        <div style="margin-bottom: 30px;">
                            <h3 style="font-size: 22px; color: #0f172a; margin-bottom: 20px; font-weight: 700;">Common Questions About This Service</h3>
                            <div class="accordion" id="serviceFaqAccordion" style="display: flex; flex-direction: column; gap: 12px;">
                                <?php $sIdx = 0; foreach ($faqs as $sf): $sIdx++; ?>
                                <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff;">
                                    <h4 class="accordion-header" id="headingS<?php echo $sIdx; ?>" style="margin: 0;">
                                        <button class="accordion-button <?php echo $sIdx !== 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS<?php echo $sIdx; ?>" aria-expanded="<?php echo $sIdx === 1 ? 'true' : 'false'; ?>" style="padding: 18px 20px; font-weight: 700; font-size: 15px; color: #0f172a; width: 100%; text-align: left; display: flex; justify-content: space-between; align-items: center; border: none; background: #fff; cursor: pointer;">
                                            <span><?php echo e($sf['question']); ?></span>
                                            <i class="fas fa-chevron-down" style="font-size: 12px; color: #e53935;"></i>
                                        </button>
                                    </h4>
                                    <div id="collapseS<?php echo $sIdx; ?>" class="accordion-collapse collapse <?php echo $sIdx === 1 ? 'show' : ''; ?>" aria-labelledby="headingS<?php echo $sIdx; ?>" style="padding: 0 20px 18px; color: #64748b; font-size: 14.5px; line-height: 1.6;">
                                        <div class="accordion-body">
                                            <?php echo e($sf['answer']); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- SIDEBAR (RIGHT 4 COLUMNS) -->
                <div class="xl:w-1/3 lg:w-1/3 px-[15px] md:w-full sm:w-full w-full mt_md--50 mt_sm--50">
                    <div class="service-sidebar" style="display: flex; flex-direction: column; gap: 30px;">
                        
                        <!-- Navigation Menu of Same-Branch Services -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 28px 24px;">
                            <h4 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 18px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px;">
                                <?php echo $isFirm ? 'Firm Outsourcing Services' : 'Bookkeeping Services'; ?>
                            </h4>
                            <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 8px;">
                                <?php foreach ($branchServices as $bs): 
                                    $isActive = ($bs['id'] === $service['id']);
                                    $bsUrl = site_url('service-details.php') . '?slug=' . urlencode($bs['slug']);
                                ?>
                                <li>
                                    <a href="<?php echo e($bsUrl); ?>" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; border-radius: 8px; font-size: 14.5px; font-weight: 600; text-decoration: none; transition: all .2s; <?php echo $isActive ? 'background: #e53935; color: #fff;' : 'background: #fff; color: #1e293b; border: 1px solid #e2e8f0;'; ?>">
                                        <span><?php echo e($bs['title']); ?></span>
                                        <i class="far fa-arrow-right" style="font-size: 12px; <?php echo $isActive ? 'color: #fff;' : 'color: #94a3b8;'; ?>"></i>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Sidebar Quick Consultation Form -->
                        <div style="background: #0b1220; color: #fff; border-radius: 16px; padding: 32px 26px; box-shadow: 0 15px 35px rgba(0,0,0,0.15);">
                            <span style="color: #ff6b6b; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 6px;">
                                Consultation Request
                            </span>
                            <h4 style="color: #fff; font-size: 20px; font-weight: 800; margin: 0 0 12px;">
                                Inquire About <?php echo e($service['title']); ?>
                            </h4>
                            <p style="color: #94a3b8; font-size: 13.5px; margin-bottom: 20px; line-height: 1.5;">
                                Tell us about your current requirements and our team will get back to you within 1 business day.
                            </p>

                            <?php if ($contactSuccess): ?>
                                <div style="background: #22c55e; color: #fff; padding: 14px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 16px;">
                                    Thank you! Your inquiry has been received. Our team will contact you shortly.
                                </div>
                            <?php endif; ?>

                            <?php if ($contactError): ?>
                                <div style="background: #ef4444; color: #fff; padding: 14px; border-radius: 8px; font-size: 14px; margin-bottom: 16px;">
                                    <?php echo e($contactError); ?>
                                </div>
                            <?php endif; ?>

                            <form action="" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="action" value="service_lead">
                                <input type="hidden" name="service" value="<?php echo e($service['title']); ?>">

                                <div style="margin-bottom: 14px;">
                                    <input type="text" name="name" placeholder="Your Full Name *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.06); color: #fff; font-size: 14px;">
                                </div>
                                <div style="margin-bottom: 14px;">
                                    <input type="email" name="email" placeholder="Your Email Address *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.06); color: #fff; font-size: 14px;">
                                </div>
                                <div style="margin-bottom: 14px;">
                                    <input type="tel" name="phone" placeholder="Phone Number (e.g. 021...)" style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.06); color: #fff; font-size: 14px;">
                                </div>
                                <div style="margin-bottom: 18px;">
                                    <textarea name="message" rows="3" placeholder="Brief details about your business or practice..." style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.06); color: #fff; font-size: 14px; resize: vertical;"></textarea>
                                </div>
                                <button type="submit" class="rts-btn btn-primary" style="width: 100%; padding: 14px; font-weight: 700; font-size: 15px; border-radius: 8px;">
                                    Submit Consultation Request <i class="far fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Direct Help Contact Widget -->
                        <div style="background: #fff; border: 2px dashed #cbd5e1; border-radius: 14px; padding: 24px; text-align: center;">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; margin: 0 auto 12px;">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h5 style="margin: 0 0 6px; font-size: 17px; font-weight: 700;">Need Immediate Advice?</h5>
                            <p style="font-size: 13.5px; color: #64748b; margin-bottom: 15px;">Speak directly with our Auckland accounting advisory desk:</p>
                            <a href="tel:+6498010123" style="font-size: 18px; font-weight: 800; color: #e53935; text-decoration: none; display: block; margin-bottom: 8px;">
                                +64 9 801 0123
                            </a>
                            <span style="font-size: 12px; color: #94a3b8;">Mon - Fri: 8:30am - 5:30pm NZDT</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
