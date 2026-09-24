<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Contact Our New Zealand Bookkeeping Team | get-accountant';
$metaDescription = 'Get in touch with our New Zealand accounting and bookkeeping team. Schedule a free consultation in Auckland or via video call.';
$pageHeading     = 'Contact Us';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$leadSaved = false;
$errorMsg  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $errorMsg = 'Security validation failed. Please refresh the page and try again.';
    } else {
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $phone   = trim($_POST['phone'] ?? '');
        $service = trim($_POST['service'] ?? 'Accounting & Bookkeeping');
        $message = trim($_POST['message'] ?? '');

        if (empty($name) || empty($email)) {
            $errorMsg = 'Please enter your full name and email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = 'Please provide a valid email address.';
        } else {
            if ($pdo = db()) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, message, status) 
                        VALUES ('contact', :name, :email, :phone, 'NZ Bookkeeping Inquiry', :service, :message, 'new')");
                    $stmt->execute([
                        'name'    => $name,
                        'email'   => $email,
                        'phone'   => $phone,
                        'service' => $service,
                        'message' => $message,
                    ]);
                    $leadSaved = true;
                } catch (Throwable $e) {
                    $errorMsg = 'Failed to submit enquiry. Please email us directly at ' . BUSINESS_EMAIL;
                }
            }
        }
    }
}

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <div class="rts-contact-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                
                <!-- Contact Details (Left 5 Columns) -->
                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Get in Touch</span>
                    <h2 class="title" style="font-size: 34px; margin: 10px 0 20px;">Let’s Talk About Your Numbers</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 35px;">
                        Have questions about our fixed monthly bookkeeping packages, software setup, or IRD compliance? Our Auckland-based team is here to assist.
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">New Zealand Office</h4>
                                <p style="margin: 0; font-size: 14.5px; color: #64748b;">188 Quay Street, Auckland CBD, Auckland 1010, New Zealand</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">Direct Phone</h4>
                                <a href="tel:+6498010123" style="font-size: 15.5px; font-weight: 700; color: #e53935; text-decoration: none;">+64 9 801 0123</a>
                                <span style="display: block; font-size: 13px; color: #94a3b8;">Mon - Fri: 8:30am - 5:30pm NZDT</span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">Email Inquiries</h4>
                                <a href="mailto:info@get-accountant.com" style="font-size: 15px; color: #334155; text-decoration: none;">info@get-accountant.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="background: #f8fafc; border-radius: 14px; padding: 22px; margin-top: 35px; border-left: 4px solid #22c55e;">
                        <h5 style="margin: 0 0 4px; font-size: 15px; font-weight: 700; color: #0f172a;">Fast Response Guarantee</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">All inquiries receive a personalized response within 1 business day.</p>
                    </div>
                </div>

                <!-- Contact Form (Right 7 Columns) -->
                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full mt_md--50 mt_sm--50">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.06);">
                        <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Schedule a Consultation</h3>
                        <p style="color: #64748b; font-size: 15px; margin-bottom: 25px;">Fill out this quick form and we’ll contact you to arrange a suitable time.</p>

                        <?php if ($leadSaved): ?>
                            <div style="background: #22c55e; color: #fff; padding: 18px 22px; border-radius: 10px; font-size: 15px; font-weight: 600; margin-bottom: 24px;">
                                <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
                                Thank you! Your consultation request has been submitted. Our team will contact you shortly.
                            </div>
                        <?php endif; ?>

                        <?php if ($errorMsg): ?>
                            <div style="background: #ef4444; color: #fff; padding: 18px 22px; border-radius: 10px; font-size: 15px; margin-bottom: 24px;">
                                <?php echo e($errorMsg); ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Your Name *</label>
                                    <input type="text" name="name" placeholder="John Smith" required style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Your Email *</label>
                                    <input type="email" name="email" placeholder="john@example.co.nz" required style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Phone Number</label>
                                    <input type="tel" name="phone" placeholder="021 123 4567" style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Service Required</label>
                                    <select name="service" style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px; background: #fff;">
                                        <option value="Full Bookkeeping &amp; GST">Full Bookkeeping &amp; GST</option>
                                        <option value="Payroll &amp; PAYE">Payroll &amp; PAYE Compliance</option>
                                        <option value="Annual Financial Statements">Annual Financial Statements</option>
                                        <option value="Xero Setup &amp; Training">Xero Setup &amp; Training</option>
                                        <option value="Catch-Up Backlog">Catch-Up Backlog Clean-Up</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Your Message / Requirements</label>
                                <textarea name="message" rows="4" placeholder="Briefly describe your business, current software, and what you need help with..." style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px; resize: vertical;"></textarea>
                            </div>

                            <button type="submit" class="rts-btn btn-primary" style="padding: 16px 36px; font-weight: 700; font-size: 15px; border-radius: 8px; cursor: pointer;">
                                Send Consultation Request <i class="far fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
