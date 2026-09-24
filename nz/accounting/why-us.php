<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Why Choose Us | get-accountant New Zealand';
$metaDescription = 'Why Kiwi small businesses choose get-accountant: dedicated bookkeepers, fixed monthly pricing, 100% IRD compliance, and Xero certified experts.';
$pageHeading     = 'Why Choose Us';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';

$reasons = [
    [
        'title' => 'Dedicated New Zealand Bookkeeper',
        'desc'  => 'You work with a named, qualified specialist who learns your business, answers your calls, and reconciles your accounts proactively every week.',
        'icon'  => 'fa-user-tie',
    ],
    [
        'title' => 'Transparent Fixed Monthly Pricing',
        'desc'  => 'No surprise hourly bills or fees for quick phone questions. All our packages are transparent and predictable, billed on a simple monthly basis.',
        'icon'  => 'fa-tags',
    ],
    [
        'title' => '100% On-Time IRD Filing Guarantee',
        'desc'  => 'We schedule and prepare your GST returns, payday payroll filing, and annual accounts well ahead of statutory deadlines to eliminate penalty stress.',
        'icon'  => 'fa-shield-check',
    ],
    [
        'title' => 'Xero & MYOB Certified Experts',
        'desc'  => 'We maximize automation in your cloud accounting software, setting up bank feeds, receipt capture, and app integrations to save you hours every week.',
        'icon'  => 'fa-cloud-upload',
    ],
    [
        'title' => 'Bank-Grade Data Security',
        'desc'  => 'Your financial information is safeguarded with 256-bit encryption, strict access controls, and full compliance with the New Zealand Privacy Act 2020.',
        'icon'  => 'fa-lock',
    ],
    [
        'title' => 'Proactive Business Advisory',
        'desc'  => 'We don’t just record past transactions — we provide forward-looking cash flow projections, budget variance analysis, and tax minimization advice.',
        'icon'  => 'fa-chart-line',
    ],
];
?>

    <div class="rts-about-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">The get-accountant Difference</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Accounting Built Around Your Peace of Mind</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        We believe small business owners should have total confidence in their numbers without the dread of tax season or confusing invoices.
                    </p>
                </div>
            </div>

            <!-- 6 Feature Cards Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($reasons as $r): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px 28px; height: 100%; box-shadow: 0 10px 25px rgba(0,0,0,0.04); transition: transform .3s; display: flex; flex-direction: column;">
                        <div style="width: 52px; height: 52px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 20px;">
                            <i class="fas <?php echo $r['icon']; ?>"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px; color: #0f172a;"><?php echo e($r['title']); ?></h3>
                        <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin: 0; flex-grow: 1;">
                            <?php echo e($r['desc']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Comparison Table: Traditional vs get-accountant -->
            <div style="margin-top: 60px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 40px 35px;">
                <div class="text-center mb--35">
                    <h3 style="font-size: 26px; color: #0f172a; margin-bottom: 8px; font-weight: 800;">Traditional Accounting vs. get-accountant</h3>
                    <p style="color: #64748b; font-size: 15px; margin: 0;">See how our modern model saves you time, money, and anxiety.</p>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #cbd5e1; text-align: left;">
                                <th style="padding: 14px 18px; font-size: 15px; color: #475569;">Key Feature</th>
                                <th style="padding: 14px 18px; font-size: 15px; color: #64748b; background: #f1f5f9; width: 35%;">Traditional Firm</th>
                                <th style="padding: 14px 18px; font-size: 15px; color: #e53935; background: #fff5f5; width: 35%;">get-accountant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Pricing Model</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">Hourly billing, unpredictable invoices</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;"><i class="fas fa-check" style="color: #22c55e; margin-right: 6px;"></i> Fixed, transparent monthly subscription</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Frequency of Work</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">Once a year at tax season (reactive)</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;"><i class="fas fa-check" style="color: #22c55e; margin-right: 6px;"></i> Weekly &amp; monthly proactive reconciliation</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">IRD Filing Reminders</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">Last-minute rush before deadline</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;"><i class="fas fa-check" style="color: #22c55e; margin-right: 6px;"></i> Prepared &amp; reviewed 10 days early</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Communication</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">Junior clerks or slow email responses</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;"><i class="fas fa-check" style="color: #22c55e; margin-right: 6px;"></i> Dedicated bookkeeper with direct phone/email</td>
                            </tr>
                            <tr>
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Software Utilization</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">Manual spreadsheets or paper shoeboxes</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;"><i class="fas fa-check" style="color: #22c55e; margin-right: 6px;"></i> 100% paperless cloud sync (Xero, Dext, MYOB)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Stats Bar -->
            <div style="background: #0b1220; color: #fff; border-radius: 16px; padding: 45px 30px; margin-top: 50px;">
                <div class="flex flex-wrap -mx-[15px] text-center">
                    <div class="xl:w-1/3 md:w-1/3 px-[15px] py--10">
                        <div style="font-size: 38px; font-weight: 800; color: #e53935; line-height: 1; margin-bottom: 6px;">99.8%</div>
                        <div style="font-size: 14px; color: #cbd5e1; font-weight: 600;">On-Time IRD Filing Record</div>
                    </div>
                    <div class="xl:w-1/3 md:w-1/3 px-[15px] py--10">
                        <div style="font-size: 38px; font-weight: 800; color: #e53935; line-height: 1; margin-bottom: 6px;">250+</div>
                        <div style="font-size: 14px; color: #cbd5e1; font-weight: 600;">Kiwi Businesses Supported</div>
                    </div>
                    <div class="xl:w-1/3 md:w-1/3 px-[15px] py--10">
                        <div style="font-size: 38px; font-weight: 800; color: #e53935; line-height: 1; margin-bottom: 6px;">5.0 / 5.0</div>
                        <div style="font-size: 14px; color: #cbd5e1; font-weight: 600;">Client Satisfaction Rating</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Experience the Difference for Yourself</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule a free 20-minute consultation with our New Zealand accounting team.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Get Started Today <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
