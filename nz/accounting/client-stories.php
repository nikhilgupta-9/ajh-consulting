<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Client Stories & Case Studies | get-accountant New Zealand';
$metaDescription = 'Real success stories from New Zealand business owners who simplified their bookkeeping, streamlined payroll, and mastered cash flow with get-accountant.';
$pageHeading     = 'Client Stories';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$testimonials = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'bookkeeping']);
        $testimonials = $stmt->fetchAll();
    } catch (Throwable $e) {
        $testimonials = [];
    }
}

$caseStudies = [
    [
        'client'   => 'Apex Construction & Civil',
        'location' => 'Christchurch',
        'industry' => 'Commercial Construction & Earthworks',
        'metrics'  => [
            'Hours Saved' => '16 hrs / week',
            'GST Status'  => 'Filed 10 days early',
            'Payroll Accuracy' => '100% Holidays Act',
        ],
        'challenge' => 'With 18 full-time carpenters and 25 subcontractors across multiple job sites, managing progress claims, subcontractor schedular tax (WT), and variable roster payroll was overwhelming the general manager.',
        'solution'  => 'get-accountant integrated Xero with Tradify and PaySauce. We instituted weekly bank reconciliations, automated Dext receipt capture for site foremen, and instituted proactive job costing reports.',
        'quote'     => 'get-accountant took the anxiety completely out of Friday payroll and GST deadlines. Invoicing goes out on time, and our gross margins are up 4% because every dollar of material is properly tracked.',
        'author'    => 'Callum Henderson, Managing Director',
    ],
    [
        'client'   => 'Lumina Retail & Lifestyle',
        'location' => 'Auckland CBD & Ponsonby',
        'industry' => 'Multi-Location Retail & E-commerce',
        'metrics'  => [
            'Time Saved'    => '12 hrs / week',
            'Reconciliation' => 'Daily automated',
            'Afterpay Reconciled' => '100% matched',
        ],
        'challenge' => 'Reconciling daily EFTPOS settlements, online Shopify orders, and Buy-Now-Pay-Later merchant disbursements across 2 physical stores and an online store created hundreds of unmatched transactions every month.',
        'solution'  => 'We reconfigured their Xero clearing accounts, established direct Shopify automated feeds, and implemented automated rule-matching for merchant payout batches and refund adjustments.',
        'quote'     => 'I used to spend every Sunday evening matching receipts. Now, our books are reconciled daily without me lifting a finger. Our cash flow forecasting has given us the courage to open our third store.',
        'author'    => 'Jessica Ward, Founder & CEO',
    ],
    [
        'client'   => 'Vanguard Digital Solutions',
        'location' => 'Wellington',
        'industry' => 'Software & Digital Agency',
        'metrics'  => [
            'Debtor Days'    => 'Reduced from 48 to 19',
            'WIP Tracking'   => 'Real-time dashboards',
            'Tax Saved'      => '$14,200 IRD deductions',
        ],
        'challenge' => 'Delayed client invoice payments and inconsistent work-in-progress tracking resulted in unpredictable cash dips, despite having a strong client pipeline.',
        'solution'  => 'get-accountant instituted automated invoice reminders, recurring credit card payment integrations, and monthly virtual CFO management packs analyzing project margin variances.',
        'quote'     => 'Our average debtor days dropped from 48 down to 19 days within three months. The clarity we now have over project profitability has transformed our business operations.',
        'author'    => 'Markus Thorne, Agency Director',
    ],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <div class="rts-client-feedback rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Measurable Results</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">How Kiwi Businesses Win With get-accountant</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Read how our dedicated accounting and bookkeeping support has helped New Zealand business owners regain their time and master their numbers.
                    </p>
                </div>
            </div>

            <!-- Case Studies Section -->
            <div class="flex flex-wrap -mx-[15px] mb--60">
                <?php foreach ($caseStudies as $cs): ?>
                <div class="w-full px-[15px] pb--40">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 40px 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-left: 5px solid #e53935;">
                        <div class="flex flex-wrap -mx-[15px] items-center justify-between" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 20px; margin-bottom: 25px;">
                            <div class="xl:w-2/3 lg:w-2/3 px-[15px]">
                                <span style="font-size: 12px; font-weight: 700; color: #e53935; text-transform: uppercase; letter-spacing: 0.08em;"><?php echo e($cs['location']); ?> &bull; <?php echo e($cs['industry']); ?></span>
                                <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 4px 0 0;"><?php echo e($cs['client']); ?></h3>
                            </div>
                            <div class="xl:w-1/3 lg:w-1/3 px-[15px] text-right mt_sm--15">
                                <span style="background: #fef2f2; color: #e53935; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px;">Verified Case Study</span>
                            </div>
                        </div>

                        <!-- Metrics Bar -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; background: #f8fafc; padding: 18px 24px; border-radius: 12px; margin-bottom: 25px;">
                            <?php foreach ($cs['metrics'] as $label => $val): ?>
                            <div>
                                <span style="font-size: 12px; color: #64748b; font-weight: 600; display: block;"><?php echo e($label); ?></span>
                                <span style="font-size: 20px; font-weight: 800; color: #0f172a;"><?php echo e($val); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="flex flex-wrap -mx-[15px]">
                            <div class="xl:w-1/2 lg:w-1/2 px-[15px]">
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">The Operational Challenge:</h4>
                                <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px;"><?php echo e($cs['challenge']); ?></p>
                            </div>
                            <div class="xl:w-1/2 lg:w-1/2 px-[15px]">
                                <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">The get-accountant Solution:</h4>
                                <p style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px;"><?php echo e($cs['solution']); ?></p>
                            </div>
                        </div>

                        <div style="background: #fff5f5; border-radius: 12px; padding: 22px 24px; border-left: 3px solid #e53935; margin-top: 10px;">
                            <p style="font-style: italic; color: #1e293b; font-size: 15px; line-height: 1.6; margin-bottom: 8px;">
                                &ldquo;<?php echo e($cs['quote']); ?>&rdquo;
                            </p>
                            <span style="font-size: 13px; font-weight: 700; color: #e53935;">&mdash; <?php echo e($cs['author']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Additional Client Review Quotes -->
            <?php if (!empty($testimonials)): ?>
            <div style="margin-top: 20px;">
                <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 30px;">More Reviews From Kiwi Entrepreneurs</h3>
                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($testimonials as $t): ?>
                    <div class="xl:w-1/2 px-[15px] pb--30">
                        <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 30px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                            <div style="color: #eab308; font-size: 15px; margin-bottom: 12px;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p style="color: #334155; font-size: 15px; line-height: 1.6; font-style: italic; margin-bottom: 18px;">
                                &ldquo;<?php echo e($t['quote']); ?>&rdquo;
                            </p>
                            <div style="display: flex; align-items: center; gap: 12px; border-top: 1px solid #f1f5f9; padding-top: 14px;">
                                <div style="width: 44px; height: 44px; border-radius: 50%; background: #fee2e2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 800;">
                                    <?php echo strtoupper(substr($t['client_name'], 0, 1)); ?>
                                </div>
                                <div>
                                    <h5 style="margin: 0 0 2px; font-size: 16px; font-weight: 700;"><?php echo e($t['client_name']); ?></h5>
                                    <span style="font-size: 12.5px; color: #64748b;"><?php echo e($t['client_role']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Ready to Write Your Own Success Story?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule your free 20-minute consultation with our New Zealand accounting team.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Get Started Now <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
