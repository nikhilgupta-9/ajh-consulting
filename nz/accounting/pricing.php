<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Pricing Packages | New Zealand Accounting & Bookkeeping';
$metaDescription = 'Transparent, fixed monthly accounting and bookkeeping packages for New Zealand small businesses. No hidden fees or hourly rate surprises.';
$pageHeading     = 'Transparent Pricing';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';

$plans = [
    [
        'name'        => 'Starter / Sole Trader',
        'subtitle'    => 'For contractors, freelancers and early-stage ventures.',
        'price'       => '199',
        'period'      => '/month + GST',
        'is_featured' => false,
        'features'    => [
            'Up to 75 bank transactions / month',
            '1 Bank account & 1 credit card reconciled',
            'Bi-monthly or 6-monthly GST return filing',
            'Dext / Hubdoc receipt capture setup',
            'Dedicated bookkeeper contact',
            'Email support within 24 business hours',
        ],
        'not_included' => [
            'Payroll & payday filing',
            'Monthly cash flow forecasting',
            'Annual financial statements',
        ],
    ],
    [
        'name'        => 'Growth Business',
        'subtitle'    => 'Our most popular plan for active small and medium businesses.',
        'price'       => '399',
        'period'      => '/month + GST',
        'is_featured' => true,
        'badge'       => 'Most Popular',
        'features'    => [
            'Up to 250 bank transactions / month',
            'Up to 3 bank accounts & credit cards',
            'Bi-monthly GST returns prepared & filed',
            'Payroll processing for up to 5 staff',
            'Automated payday filing with IRD',
            'Dext automated receipt & invoice ingestion',
            'Monthly Profit & Loss and Balance Sheet pack',
            'Direct phone & email support',
        ],
        'not_included' => [
            '12-month rolling cash flow forecasting',
            'Annual company income tax return (IR4)',
        ],
    ],
    [
        'name'        => 'Comprehensive Enterprise',
        'subtitle'    => 'Full-service virtual finance team with annual tax included.',
        'price'       => '699',
        'period'      => '/month + GST',
        'is_featured' => false,
        'features'    => [
            'Up to 600 bank transactions / month',
            'Unlimited bank accounts & currencies',
            'Bi-monthly GST returns & audit trail',
            'Payroll processing for up to 15 staff',
            'Payday filing, KiwiSaver & leave management',
            'Monthly cash flow runway forecasting',
            'Annual Financial Statements & Notes',
            'Company Income Tax Return (IR4) filed',
            'Quarterly virtual advisory strategy session',
        ],
        'not_included' => [],
    ],
];
?>

    <div class="rts-pricing-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Clear &amp; Predictable</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Simple Fixed Monthly Pricing for Kiwi Businesses</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        No hourly billing surprises. Choose a transparent plan tailored to your business stage, with the flexibility to upgrade or cancel anytime.
                    </p>
                </div>
            </div>

            <!-- Pricing Cards Grid -->
            <div class="flex flex-wrap -mx-[15px] justify-center">
                <?php foreach ($plans as $p): ?>
                <div class="xl:w-1/3 lg:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border-radius: 18px; padding: 40px 30px; height: 100%; display: flex; flex-direction: column; position: relative; transition: all .3s; <?php echo $p['is_featured'] ? 'border: 2px solid #e53935; box-shadow: 0 20px 45px rgba(229,57,53,0.12);' : 'border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.04);'; ?>">
                        
                        <?php if (!empty($p['badge'])): ?>
                        <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: #e53935; color: #fff; font-size: 11px; font-weight: 800; padding: 4px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.08em; box-shadow: 0 4px 10px rgba(229,57,53,0.3);">
                            <?php echo e($p['badge']); ?>
                        </div>
                        <?php endif; ?>

                        <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 24px; margin-bottom: 24px; text-align: center;">
                            <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px;"><?php echo e($p['name']); ?></h3>
                            <p style="font-size: 13.5px; color: #64748b; margin-bottom: 20px; line-height: 1.5;"><?php echo e($p['subtitle']); ?></p>
                            <div style="display: flex; align-items: baseline; justify-content: center; gap: 4px;">
                                <span style="font-size: 22px; font-weight: 700; color: #0f172a;">NZ$</span>
                                <span style="font-size: 52px; font-weight: 800; color: #0f172a; line-height: 1;"><?php echo e($p['price']); ?></span>
                                <span style="font-size: 14px; color: #64748b; font-weight: 600;"><?php echo e($p['period']); ?></span>
                            </div>
                        </div>

                        <!-- Included Features -->
                        <div style="flex-grow: 1; margin-bottom: 30px;">
                            <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                                <?php foreach ($p['features'] as $f): ?>
                                <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #1e293b;">
                                    <i class="fas fa-check-circle" style="color: #22c55e; margin-top: 2px;"></i>
                                    <span><?php echo e($f); ?></span>
                                </li>
                                <?php endforeach; ?>

                                <?php foreach ($p['not_included'] as $nf): ?>
                                <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #94a3b8; text-decoration: line-through;">
                                    <i class="far fa-times-circle" style="color: #cbd5e1; margin-top: 2px;"></i>
                                    <span><?php echo e($nf); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div>
                            <a class="rts-btn <?php echo $p['is_featured'] ? 'btn-primary' : 'btn-primary-alta'; ?>" href="contact.php" style="width: 100%; text-align: center; padding: 14px; font-weight: 700; font-size: 15px; border-radius: 8px; text-decoration: none; <?php echo !$p['is_featured'] ? 'border: 2px solid #0f172a; color: #0f172a;' : ''; ?>">
                                Get Started on <?php echo e($p['name']); ?> <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Custom Add-ons & Notes -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 30px; margin-top: 30px;">
                <h4 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 16px;">Optional Add-Ons &amp; Catch-Up Bookkeeping:</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                        <h5 style="margin: 0 0 6px; font-size: 15px; font-weight: 700;">Additional Payroll Staff</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">$8 + GST per employee per pay run, including automated IRD payday filing.</p>
                    </div>
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                        <h5 style="margin: 0 0 6px; font-size: 15px; font-weight: 700;">Catch-Up Backlog Bookkeeping</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">Behind on your books? We clean up historical months from $150 + GST per un-reconciled month.</p>
                    </div>
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                        <h5 style="margin: 0 0 6px; font-size: 15px; font-weight: 700;">Virtual CFO Strategy Session</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">Deep-dive 60-minute quarterly financial roadmap and cash flow modeling ($250 + GST).</p>
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
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Need a Tailored Custom Package?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Have higher transaction volume or complex multi-entity group structure? Contact us for a custom quote.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Custom Proposal <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
