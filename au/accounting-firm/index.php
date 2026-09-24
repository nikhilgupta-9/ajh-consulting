<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Australia Accounting Firm Outsourcing (Launching Soon) | get-accountant';
$metaDescription = 'Dedicated white-label outsourcing support for Australian CPA and CA ANZ accounting practices launching soon.';
$currentPage     = 'index.php';

$waitlistSaved = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (csrf_verify()) {
        $firmName = trim($_POST['firm_name'] ?? '');
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');

        if (!empty($name) && !empty($email)) {
            if ($pdo = db()) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, status) 
                        VALUES ('contact', :name, :email, :phone, 'AU Firm Outsourcing Waitlist', 'Australia Firm Outsourcing', 'new')");
                    $stmt->execute(['name' => $name . ($firmName ? " ($firmName)" : ""), 'email' => $email, 'phone' => $phone]);
                    $waitlistSaved = true;
                } catch (Throwable $e) {}
            }
        }
    }
}

require __DIR__ . '/../../includes/header.php';
?>

    <div class="rts-breadcrumb-area breadcrumb-bg bg_image" style="background: linear-gradient(135deg, #070d17 0%, #0f1c30 100%); padding: 80px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-2/3 px-[15px] lg:w-2/3 md:w-2/3 sm:w-full w-full breadcrumb-1">
                    <div style="display: inline-block; background: rgba(229,57,53,0.12); border: 1px solid rgba(229,57,53,0.3); color: #ff6b6b; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 12px;">
                        Australia Expansion &bull; Launching Soon
                    </div>
                    <h1 class="title" style="color: #fff; font-size: 38px; margin: 0;">Australia Accounting Firm Outsourcing</h1>
                </div>
                <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/3 sm:w-full w-full text-right mt_sm--20">
                    <div class="bread-tag" style="color: #cbd5e1; font-size: 14px;">
                        <a href="<?php echo site_url('index.php'); ?>" style="color: #cbd5e1;">Home</a>
                        <span> / </span>
                        <span class="active" style="color: #e53935; font-weight: 600;">Australia Firm Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rts-service-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-7/12 lg:w-7/12 px-[15px]">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; font-size: 13px; letter-spacing: 0.08em;">For Australian Practices</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 20px;">Dedicated Back-Office Capacity for Australian CPA &amp; CA Firms</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 25px;">
                        We are bringing our proven, white-label outsourcing model to Australian accounting practices. Solve the acute staffing crunch and expand your practice margins with dedicated offshore teams.
                    </p>
                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 30px;">
                        <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; color: #1e293b;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> <strong>Standardized Australian Workpapers:</strong> Prepared to CA ANZ and CPA Australia audit-ready guidelines.
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; color: #1e293b;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> <strong>Software Compatibility:</strong> XPM, HandiSoft / HandiLedger, MYOB Practice, and APS.
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; font-size: 15px; color: #1e293b;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> <strong>Strict Non-Disclosure:</strong> Legally binding bilateral NDA and non-solicitation guarantees.
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                        <a class="rts-btn btn-primary" href="<?php echo site_url('nz/accounting-firm/'); ?>">
                            Explore New Zealand Firm Model <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="xl:w-5/12 lg:w-5/12 px-[15px] mt_md--50 mt_sm--50">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 35px 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); border-top: 5px solid #e53935;">
                        <span style="font-size: 12px; font-weight: 800; color: #e53935; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 4px;">Firm Registration</span>
                        <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Register Your Practice</h3>
                        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 20px;">Receive priority notification and founding partner commercial terms.</p>

                        <?php if ($waitlistSaved): ?>
                            <div style="background: #22c55e; color: #fff; padding: 14px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 16px;">
                                <i class="fas fa-check-circle"></i> Thank you! Your firm has been registered for Australian early access.
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div style="margin-bottom: 14px;">
                                <input type="text" name="firm_name" placeholder="Accounting Firm Name *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 14px;">
                                <input type="text" name="name" placeholder="Partner / Contact Name *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 14px;">
                                <input type="email" name="email" placeholder="Practice Email *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 18px;">
                                <input type="tel" name="phone" placeholder="Direct Phone Number" style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <button type="submit" class="rts-btn btn-primary" style="width: 100%; padding: 14px; font-weight: 700; border-radius: 8px;">
                                Register Practice Interest <i class="far fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
