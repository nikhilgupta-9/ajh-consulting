<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Australia | Accounting, Bookkeeping & Firm Outsourcing (Coming Soon)';
$metaDescription = 'get-accountant is launching soon for Australia. Pre-register for Australian ATO, BAS, Superannuation and firm outsourcing services.';
$currentPage     = 'australia.php';

$waitlistSuccess = false;
$waitlistError   = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $waitlistError = 'Security check failed. Please refresh and try again.';
    } else {
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $phone   = trim($_POST['phone'] ?? '');
        $persona = trim($_POST['persona'] ?? 'Australian Business');
        $notes   = trim($_POST['notes'] ?? '');

        if (empty($name) || empty($email)) {
            $waitlistError = 'Please provide your name and email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $waitlistError = 'Please provide a valid email address.';
        } else {
            if ($pdo = db()) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, message, status) 
                        VALUES ('contact', :name, :email, :phone, 'Australia Early Access Waitlist', :persona, :message, 'new')");
                    $stmt->execute([
                        'name'    => $name,
                        'email'   => $email,
                        'phone'   => $phone,
                        'persona' => $persona,
                        'message' => $notes,
                    ]);
                    $waitlistSuccess = true;
                } catch (Throwable $e) {
                    $waitlistError = 'Could not save your registration. Please try again.';
                }
            }
        }
    }
}

require __DIR__ . '/includes/header.php';
?>

    <!-- Australia Hero Banner -->
    <div class="rts-banner-area bg_image" style="background: linear-gradient(135deg, #070d17 0%, #0f1c30 100%); padding: 90px 0 100px; color: #fff; position: relative; overflow: hidden;">
        <!-- Ambient decorative shapes -->
        <div style="position: absolute; right: -5%; top: -10%; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(229,57,53,0.18) 0%, rgba(229,57,53,0) 70%); pointer-events: none;"></div>
        <div style="position: absolute; left: -10%; bottom: -10%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(229,57,53,0.08) 0%, rgba(229,57,53,0) 70%); pointer-events: none;"></div>

        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-7/12 lg:w-7/12 px-[15px] w-full">
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(229,57,53,0.12); border: 1px solid rgba(229,57,53,0.3); padding: 6px 16px; border-radius: 30px; margin-bottom: 22px;">
                        <span style="font-size: 16px;">🇦🇺</span>
                        <span style="color: #ff6b6b; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;">Australian Expansion &bull; Launching Soon</span>
                    </div>
                    <h1 class="title" style="color: #fff; font-size: 44px; font-weight: 800; line-height: 1.2; margin-bottom: 18px;">
                        World-Class Accounting &amp; Outsourcing <br>
                        <span style="color: #e53935; font-style: italic; font-weight: 300;">Coming Soon to Australia</span>
                    </h1>
                    <p class="disc" style="color: #cbd5e1; font-size: 16.5px; line-height: 1.6; margin-bottom: 30px; max-width: 580px;">
                        We currently serve hundreds of businesses and accounting practices across New Zealand. Our specialized Australian division &mdash; covering ATO compliance, BAS lodgments, Superannuation Guarantee, and CPA practice outsourcing &mdash; is launching soon.
                    </p>
                    <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <a class="rts-btn btn-primary" href="<?php echo site_url('index.php'); ?>" style="padding: 16px 28px; font-weight: 600;">
                            Explore Active NZ Site <i class="far fa-arrow-right"></i>
                        </a>
                        <a class="rts-btn btn-primary-alta" href="#waitlist" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.25); color: #fff; padding: 16px 28px; font-weight: 600;">
                            Join Australia Waitlist
                        </a>
                    </div>
                    <!-- Trust badges -->
                    <div style="margin-top: 35px; display: flex; gap: 20px; flex-wrap: wrap; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 22px;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> ATO &amp; BAS Ready
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> STP Phase 2 Compliant
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13.5px;">
                            <i class="fas fa-check-circle" style="color: #22c55e;"></i> White-Label CPA Support
                        </div>
                    </div>
                </div>

                <div class="xl:w-5/12 lg:w-5/12 px-[15px] w-full mt_md--50 mt_sm--50" id="waitlist">
                    <div style="background: #fff; border-radius: 20px; padding: 36px 30px; box-shadow: 0 25px 60px rgba(0,0,0,0.4); border-top: 5px solid #e53935; position: relative;">
                        <span style="font-size: 12px; font-weight: 800; color: #e53935; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 5px;">Priority Early Access</span>
                        <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Register for Early Access</h3>
                        <p style="font-size: 14px; color: #64748b; margin-bottom: 22px;">Be the first to know when our Australian portal opens, and receive exclusive founding-client rates.</p>

                        <?php if ($waitlistSuccess): ?>
                            <div style="background: #22c55e; color: #fff; padding: 16px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 20px;">
                                <i class="fas fa-check-circle" style="margin-right: 6px;"></i> Thank you! You are on our Australian priority access list.
                            </div>
                        <?php endif; ?>

                        <?php if ($waitlistError): ?>
                            <div style="background: #ef4444; color: #fff; padding: 16px; border-radius: 8px; font-size: 14px; margin-bottom: 20px;">
                                <?php echo e($waitlistError); ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <div style="margin-bottom: 14px;">
                                <input type="text" name="name" placeholder="Your Name / Firm Name *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 14px;">
                                <input type="email" name="email" placeholder="Business Email *" required style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 14px;">
                                <input type="tel" name="phone" placeholder="Phone Number" style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px;">
                            </div>
                            <div style="margin-bottom: 16px;">
                                <select name="persona" style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; background: #fff;">
                                    <option value="Australian Business">I am an Australian Business</option>
                                    <option value="Australian Accounting Firm">I represent an Australian Accounting Firm</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <textarea name="notes" rows="2" placeholder="Briefly what are you looking for..." style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; resize: vertical;"></textarea>
                            </div>
                            <button type="submit" class="rts-btn btn-primary" style="width: 100%; padding: 15px; font-weight: 700; border-radius: 8px; font-size: 15px;">
                                Join Priority Waitlist <i class="far fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Value Strip for Early Registrants -->
    <div class="rts-feature-area" style="margin-top: -40px; position: relative; z-index: 10;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 30px 26px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935;">
                        <div style="width: 50px; height: 50px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 16px;">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 8px; font-size: 18px;">Founding Client Pricing</h3>
                        <p class="disc" style="color: #64748b; font-size: 14px; margin: 0;">Waitlist members lock in exclusive launch pricing discounted for their first 12 months of service.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 30px 26px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #0f172a;">
                        <div style="width: 50px; height: 50px; border-radius: 12px; background: #f1f5f9; color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 16px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 8px; font-size: 18px;">Dedicated Account Lead</h3>
                        <p class="disc" style="color: #64748b; font-size: 14px; margin: 0;">Get paired with a senior accountant specialized in Australian ATO and state payroll taxes.</p>
                    </div>
                </div>
                <div class="xl:w-1/3 md:w-1/3 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 30px 26px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); height: 100%; border-bottom: 4px solid #e53935;">
                        <div style="width: 50px; height: 50px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 16px;">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 8px; font-size: 18px;">Priority System Onboarding</h3>
                        <p class="disc" style="color: #64748b; font-size: 14px; margin: 0;">Direct migration from your current bookkeeping setup with zero downtime or business disruption.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Upcoming Australian Pillars Preview -->
    <div class="rts-service-area rts-section-gap" style="padding: 70px 0 90px; background: #f8fafc;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 750px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 12.5px;">Upcoming Capabilities</span>
                    <h2 class="title" style="font-size: 34px; margin: 8px 0 14px;">Two Dedicated Australian Divisions</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">Preview the exact services launching for the Australian market.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <!-- Pillar 1: SME Bookkeeping -->
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 36px; border: 1px solid #e2e8f0; height: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border-top: 5px solid #e53935; display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <span style="font-size: 12px; font-weight: 800; color: #e53935; text-transform: uppercase; letter-spacing: 0.08em;">For Businesses</span>
                                <h3 style="font-size: 22px; font-weight: 800; margin: 0;">Australia Accounting &amp; Bookkeeping</h3>
                            </div>
                        </div>
                        <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                            Designed for Australian small and medium businesses needing end-to-end bookkeeping, Single Touch Payroll (STP Phase 2), and Business Activity Statement (BAS) preparation.
                        </p>
                        <ul style="list-style: none; margin: 0 0 24px; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> BAS &amp; IAS Preparation and ATO lodgment</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Single Touch Payroll (STP 2) &amp; Superannuation</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Xero &amp; MYOB Australia cloud bank reconciliations</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Clean month-end P&amp;L and Balance Sheet reports</li>
                        </ul>
                        <div>
                            <a class="rts-read-more color-primary" href="<?php echo site_url('au/accounting/'); ?>" style="font-weight: 700; font-size: 14.5px; text-decoration: none;">
                                Preview Bookkeeping Details <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pillar 2: Firm Outsourcing -->
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border-radius: 16px; padding: 36px; border: 1px solid #e2e8f0; height: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border-top: 5px solid #0f172a; display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 18px;">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f1f5f9; color: #0f172a; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                <i class="fas fa-building"></i>
                            </div>
                            <div>
                                <span style="font-size: 12px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.08em;">For CPA &amp; CA Firms</span>
                                <h3 style="font-size: 22px; font-weight: 800; margin: 0;">Australia Firm Outsourcing Support</h3>
                            </div>
                        </div>
                        <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                            Dedicated white-label production capacity for Australian CPA and CA ANZ practices facing intense local labor shortages and margin compression.
                        </p>
                        <ul style="list-style: none; margin: 0 0 24px; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Strict mutual NDA &amp; non-solicitation guarantees</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Standardized trial balance lead schedules &amp; workpapers</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> Compatible with XPM, HandiLedger, APS &amp; MYOB Practice</li>
                            <li style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #1e293b;"><i class="fas fa-check-circle" style="color: #22c55e;"></i> 40&ndash;50% operational cost savings on compliance</li>
                        </ul>
                        <div>
                            <a class="rts-read-more color-primary" href="<?php echo site_url('au/accounting-firm/'); ?>" style="font-weight: 700; font-size: 14.5px; text-decoration: none;">
                                Preview Firm Outsourcing Details <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
