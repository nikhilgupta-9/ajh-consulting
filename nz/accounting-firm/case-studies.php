<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Practice Case Studies | Accounting Firm Outsourcing';
$metaDescription = 'Real case studies of New Zealand CA and CPA practices that scaled capacity, increased margins, and eliminated staff overtime with get-accountant.';
$pageHeading     = 'Case Studies';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';

$firmCases = [
    [
        'firm'     => 'Four-Partner CA Practice',
        'location' => 'Auckland Central',
        'profile'  => '650 SME Clients &bull; 14 In-House Staff',
        'metrics'  => [
            'Gross Margin'    => '+22% Increase',
            'Overtime'        => 'Zero in Peak Tax Season',
            'Review Time'     => 'Reduced to 10 min / file',
        ],
        'challenge' => 'Struggled with persistent turnover among 2nd and 3rd year intermediate accountants. In-house seniors spent half their time re-training new hires while partners worked 65-hour weeks during annual filing periods.',
        'solution'  => 'Integrated get-accountant as an invisible back-office production team. Offloaded 120 routine GST returns and 90 year-end compliance files inside Xero Practice Manager under standardized review templates.',
        'quote'     => 'Outsourcing routine compliance was the single most impactful commercial decision we made in the past five years. Our local team is refreshed, retention is at an all-time high, and our practice profitability surged.',
        'partner'   => 'Managing Partner, CA ANZ Member',
    ],
    [
        'firm'     => 'Regional Business Advisory & Tax Firm',
        'location' => 'Hamilton & Waikato',
        'profile'  => '380 Agribusiness & Commercial Clients',
        'metrics'  => [
            'Cost Savings'    => '44% on routine compliance',
            'Capacity Gained' => '400+ Hours / Quarter',
            'Advisory Revenue'=> '+$185,000 new ARR',
        ],
        'challenge' => 'Recruitment in the regional market had stalled for over 9 months. With growing client demand for virtual CFO advisory, senior staff were trapped in low-margin bookkeeping and GST preparation.',
        'solution'  => 'Transitioned all monthly bookkeeping reconciliations and GST workpapers to a dedicated get-accountant pod, freeing in-house seniors to launch structured quarterly advisory packages.',
        'quote'     => 'get-accountant gave us back our senior team’s brains. Instead of coding bank lines, our accountants are in the field advising clients on cash flow and succession planning. It doubled our advisory revenue.',
        'partner'   => 'Senior Partner, B.Com, CA',
    ],
    [
        'firm'     => 'Boutique Tech & Startup Advisory',
        'location' => 'Wellington',
        'profile'  => '180 Fast-Growing Tech Companies',
        'metrics'  => [
            'Turnaround'      => 'Within 48 hours',
            'Client Growth'   => 'Scaled 60% without new hires',
            'SLA Compliance'  => '99.5%',
        ],
        'challenge' => 'Fast client onboarding created severe workload spikes. In-house payroll and AP workflows were causing delivery bottlenecks that threatened service level agreements.',
        'solution'  => 'Deployed get-accountant for white-label payroll and accounts payable processing. Integrated Dext Prepare with strict approval workflows under the firm’s branding.',
        'quote'     => 'Our clients believe our team is in the next room. The white-label execution is seamless, accurate, and allows us to scale up our client intake without the dread of having to hire more staff.',
        'partner'   => 'Founding Partner, CPA',
    ],
];
?>

    <div class="rts-client-feedback rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Real Practice Impact</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">How New Zealand Firms Scale With Us</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Read detailed case studies showing how Kiwi accounting practices expanded margins and solved capacity constraints.
                    </p>
                </div>
            </div>

            <!-- Case Studies List -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($firmCases as $fc): ?>
                <div class="w-full px-[15px] pb--40">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 40px 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-left: 5px solid #0f172a;">
                        <div class="flex flex-wrap -mx-[15px] items-center justify-between" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; margin-bottom: 25px;">
                            <div class="xl:w-2/3 lg:w-2/3 px-[15px]">
                                <span style="font-size: 12px; font-weight: 700; color: #e53935; text-transform: uppercase; letter-spacing: 0.08em;"><?php echo e($fc['location']); ?> &bull; <?php echo e($fc['profile']); ?></span>
                                <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 4px 0 0;"><?php echo e($fc['firm']); ?></h3>
                            </div>
                            <div class="xl:w-1/3 lg:w-1/3 px-[15px] text-right mt_sm--15">
                                <span style="background: #0b1220; color: #fff; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px; border-left: 3px solid #e53935;">Firm Case Study</span>
                            </div>
                        </div>

                        <!-- Metrics Bar -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; background: #f8fafc; padding: 18px 24px; border-radius: 12px; margin-bottom: 25px;">
                            <?php foreach ($fc['metrics'] as $label => $val): ?>
                            <div>
                                <span style="font-size: 12px; color: #64748b; font-weight: 600; display: block;"><?php echo e($label); ?></span>
                                <span style="font-size: 20px; font-weight: 800; color: #0f172a;"><?php echo e($val); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="flex flex-wrap -mx-[15px]">
                            <div class="xl:w-1/2 lg:w-1/2 px-[15px]">
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">The Practice Challenge:</h4>
                                <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px;"><?php echo e($fc['challenge']); ?></p>
                            </div>
                            <div class="xl:w-1/2 lg:w-1/2 px-[15px]">
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">The Outsourced Solution:</h4>
                                <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px;"><?php echo e($fc['solution']); ?></p>
                            </div>
                        </div>

                        <div style="background: #f1f5f9; border-radius: 12px; padding: 22px 24px; border-left: 3px solid #0f172a; margin-top: 10px;">
                            <p style="font-style: italic; color: #1e293b; font-size: 15px; line-height: 1.6; margin-bottom: 8px;">
                                &ldquo;<?php echo e($fc['quote']); ?>&rdquo;
                            </p>
                            <span style="font-size: 13px; font-weight: 700; color: #475569;">&mdash; <?php echo e($fc['partner']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Ready to Scale Your Practice?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule a confidential consultation and request a pilot batch to test our output.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Practice Pilot <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
