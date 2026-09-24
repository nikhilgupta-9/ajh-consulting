<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Partner With Us | Accounting Firm Outsourcing Inquiry';
$metaDescription = 'Schedule a confidential practice capacity scoping discussion or request a pilot batch for your New Zealand accounting firm.';
$pageHeading     = 'Contact Practice Team';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

$leadSaved = false;
$errorMsg  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $errorMsg = 'Security validation failed. Please refresh the page and try again.';
    } else {
        $firmName    = trim($_POST['firm_name'] ?? '');
        $partnerName = trim($_POST['name'] ?? '');
        $email       = trim($_POST['email'] ?? '');
        $phone       = trim($_POST['phone'] ?? '');
        $software    = trim($_POST['software'] ?? '');
        $serviceArea = trim($_POST['service'] ?? 'General Firm Outsourcing');
        $message     = trim($_POST['message'] ?? '');

        if (empty($partnerName) || empty($email)) {
            $errorMsg = 'Please enter your partner name and email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = 'Please provide a valid business email address.';
        } else {
            if ($pdo = db()) {
                try {
                    $combinedMessage = "Firm Name: " . $firmName . "\nPractice Suite: " . $software . "\n\n" . $message;
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, message, status) 
                        VALUES ('contact', :name, :email, :phone, 'Firm Outsourcing Inquiry', :service, :message, 'new')");
                    $stmt->execute([
                        'name'    => $partnerName . ($firmName ? " ($firmName)" : ""),
                        'email'   => $email,
                        'phone'   => $phone,
                        'service' => $serviceArea,
                        'message' => $combinedMessage,
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
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-contact-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                
                <!-- Contact Details (Left 5 Columns) -->
                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Firm Partnerships</span>
                    <h2 class="title" style="font-size: 34px; margin: 10px 0 20px;">Confidential Practice Scoping</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 35px;">
                        Discuss your practice’s capacity requirements, explore SOP integration, or request our standard mutual NDA before testing a pilot batch.
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #0b1220; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">Partnership Desk</h4>
                                <p style="margin: 0; font-size: 14.5px; color: #64748b;">Direct line to our practice integration director for CA ANZ and CPA partners.</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #0b1220; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">Direct Practice Line</h4>
                                <a href="tel:+6498010123" style="font-size: 15.5px; font-weight: 700; color: #e53935; text-decoration: none;">+64 9 801 0123</a>
                                <span style="display: block; font-size: 13px; color: #94a3b8;">Mon - Fri: 8:30am - 5:30pm NZDT</span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #0b1220; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 4px; font-size: 16px; font-weight: 700; color: #0f172a;">Partner Inquiries</h4>
                                <a href="mailto:partners@get-accountant.com" style="font-size: 15px; color: #334155; text-decoration: none;">partners@get-accountant.com</a>
                            </div>
                        </div>
                    </div>

                    <div style="background: #f8fafc; border-radius: 14px; padding: 22px; margin-top: 35px; border-left: 4px solid #0f172a;">
                        <h5 style="margin: 0 0 4px; font-size: 15px; font-weight: 700; color: #0f172a;">100% Confidentiality Assured</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">All discussions and pilot evaluations are protected by mutual non-disclosure.</p>
                    </div>
                </div>

                <!-- Contact Form (Right 7 Columns) -->
                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full mt_md--50 mt_sm--50">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.06);">
                        <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Schedule Practice Assessment</h3>
                        <p style="color: #64748b; font-size: 15px; margin-bottom: 25px;">Tell us about your practice and our director will contact you directly.</p>

                        <?php if ($leadSaved): ?>
                            <div style="background: #22c55e; color: #fff; padding: 18px 22px; border-radius: 10px; font-size: 15px; font-weight: 600; margin-bottom: 24px;">
                                <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
                                Thank you! Your practice inquiry has been received. Our partnership director will contact you shortly under strict confidentiality.
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
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Accounting Firm Name *</label>
                                    <input type="text" name="firm_name" placeholder="e.g. Miller &amp; Associates CA" required style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Partner / Manager Name *</label>
                                    <input type="text" name="name" placeholder="e.g. David Miller" required style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Practice Email *</label>
                                    <input type="email" name="email" placeholder="partner@firm.co.nz" required style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Phone Number</label>
                                    <input type="tel" name="phone" placeholder="021 987 6543" style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;">
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Primary Practice Suite</label>
                                    <select name="software" style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px; background: #fff;">
                                        <option value="Xero Practice Manager (XPM)">Xero Practice Manager (XPM)</option>
                                        <option value="CCH iFirm">CCH iFirm</option>
                                        <option value="MYOB Practice Solutions">MYOB Practice Solutions</option>
                                        <option value="APS / Reckon">APS / Reckon</option>
                                        <option value="Other">Other / Mixed</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Primary Need</label>
                                    <select name="service" style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px; background: #fff;">
                                        <option value="GST Workpapers &amp; Compliance">GST Workpapers &amp; Compliance</option>
                                        <option value="Year-End Compliance Files">Year-End Compliance Files</option>
                                        <option value="Full AP &amp; AR Bookkeeping Outsourcing">Full AP &amp; AR Bookkeeping Outsourcing</option>
                                        <option value="White-Label Payroll">White-Label Payroll</option>
                                        <option value="Trial Pilot Batch">Trial Pilot Batch</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-bottom: 24px;">
                                <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Practice Overview / Requirements</label>
                                <textarea name="message" rows="4" placeholder="Briefly describe your firm size, client volume, and current capacity bottlenecks..." style="width: 100%; padding: 13px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14.5px; resize: vertical;"></textarea>
                            </div>

                            <button type="submit" class="rts-btn btn-primary" style="padding: 16px 36px; font-weight: 700; font-size: 15px; border-radius: 8px; cursor: pointer;">
                                Submit Confidential Inquiry <i class="far fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
