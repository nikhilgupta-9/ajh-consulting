<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Why Partner With Us | Accounting Firm Outsourcing Advantage';
$metaDescription = 'Why New Zealand accounting practices partner with get-accountant: 40-50% cost savings, elimination of talent bottlenecks, and zero poaching guarantee.';
$pageHeading     = 'Why Partner With Us';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';

$benefits = [
    [
        'title' => '40% - 50% Operational Cost Savings',
        'desc'  => 'Slash the direct labor cost of routine compliance work. Transform high-cost overhead into flexible, high-margin production capacity.',
        'icon'  => 'fa-percentage',
    ],
    [
        'title' => 'Overcome the Accounting Staff Shortage',
        'desc'  => 'No more losing sleep over unfilled intermediate accountant vacancies or paying exorbitant 20% recruiter fees for talent that leaves in 12 months.',
        'icon'  => 'fa-users',
    ],
    [
        'title' => 'Eliminate Tax-Season Overtime Burnout',
        'desc'  => 'Scale capacity instantly when March 31 and GST deadlines approach. Protect your in-house managers from 70-hour workweeks.',
        'icon'  => 'fa-battery-full',
    ],
    [
        'title' => 'Shift Your Team to High-Margin Advisory',
        'desc'  => 'Free your senior local staff to deliver lucrative virtual CFO, tax planning, and strategic business advisory services that clients willingly pay premium rates for.',
        'icon'  => 'fa-chart-pie',
    ],
    [
        'title' => 'CA ANZ Standard Workpaper Quality',
        'desc'  => 'Workpapers completed to 95% following standardized trial balance lead schedules, cross-referenced and ready for partner sign-off in minutes.',
        'icon'  => 'fa-check-double',
    ],
    [
        'title' => 'Zero Client Solicitation Guarantee',
        'desc'  => 'Enforceable non-solicitation covenants embedded into every agreement. We serve purely as your invisible back-office engine.',
        'icon'  => 'fa-handshake',
    ],
];
?>

    <div class="rts-about-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Strategic Advantage</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Built Exclusively for New Zealand Accounting Practices</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        The traditional model of hiring local intermediate accountants for low-margin compliance is broken. Discover how forward-thinking Kiwi firms are growing faster.
                    </p>
                </div>
            </div>

            <!-- 6 Key Benefits Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($benefits as $b): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px 28px; height: 100%; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
                        <div style="width: 52px; height: 52px; border-radius: 12px; background: #0b1220; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 20px;">
                            <i class="fas <?php echo $b['icon']; ?>"></i>
                        </div>
                        <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px; color: #0f172a;"><?php echo e($b['title']); ?></h3>
                        <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin: 0; flex-grow: 1;">
                            <?php echo e($b['desc']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Financial Comparison Matrix -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 40px 35px; margin-top: 50px;">
                <div class="text-center mb--35">
                    <h3 style="font-size: 26px; color: #0f172a; margin-bottom: 8px; font-weight: 800;">The Economics of In-House vs Outsourced Production</h3>
                    <p style="color: #64748b; font-size: 15px; margin: 0;">Annual cost analysis for an intermediate compliance accountant in New Zealand.</p>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #cbd5e1; text-align: left;">
                                <th style="padding: 14px 18px; font-size: 15px; color: #475569;">Cost Component</th>
                                <th style="padding: 14px 18px; font-size: 15px; color: #64748b; background: #f1f5f9; width: 35%;">In-House NZ Accountant</th>
                                <th style="padding: 14px 18px; font-size: 15px; color: #e53935; background: #fff5f5; width: 35%;">get-accountant Dedicated Model</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Base Salary + KiwiSaver</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">$75,000 - $88,000 NZD / yr</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;">Included in flat service agreement</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Recruitment Commission</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">$12,000 - $16,000 (15-20%)</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #22c55e; background: #fff9f9;">$0 (Zero placement fees)</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Hardware, Software &amp; Desk Space</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">$10,000 - $15,000 / yr</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #22c55e; background: #fff9f9;">$0 (Fully equipped infrastructure)</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 16px 18px; font-weight: 600; color: #1e293b;">Leave Cover &amp; Idle Time</td>
                                <td style="padding: 16px 18px; color: #64748b; background: #f8fafc;">4 weeks annual leave + sick days</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; background: #fff9f9;">Continuous delivery with backup cover</td>
                            </tr>
                            <tr style="background: #f1f5f9; font-weight: 800;">
                                <td style="padding: 18px; font-size: 16px; color: #0f172a;">Estimated Total Cost</td>
                                <td style="padding: 18px; font-size: 16px; color: #e53935;">$100,000+ NZD / yr</td>
                                <td style="padding: 18px; font-size: 16px; color: #22c55e; background: #fef2f2;">Up to 50% Lower Net Cost</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Ready to Explore Practice Margins?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule a partner-to-partner consultation under full NDA.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Schedule Partner Meeting <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
