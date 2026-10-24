<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Pricing Packages | New Zealand Accounting & Bookkeeping';
$metaDescription = 'Transparent, fixed monthly accounting and bookkeeping packages for New Zealand small businesses. No hidden fees or hourly rate surprises.';
$pageHeading     = 'Transparent Pricing';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$plans = [];
if ($pdo = db()) {
    try {
        $plans = $pdo->query(
            "SELECT * FROM pricing_plans WHERE status = 'published' ORDER BY sort_order ASC, id ASC"
        )->fetchAll();
    } catch (Throwable $e) {
        $plans = [];
    }
}

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/pricing.css'); ?>">

    <div class="pricing-wrap">
        <div class="container">
            <div class="pricing-head">
                <span class="sub color-primary">Clear &amp; Predictable</span>
                <h2 class="title">Simple Fixed Monthly Pricing for Kiwi Businesses</h2>
                <p>No hourly billing surprises. Choose a transparent plan tailored to your business stage, with the flexibility to upgrade or cancel anytime.</p>
            </div>

            <?php if (empty($plans)): ?>
                <p class="disc text-center">Pricing plans will be listed here soon. Add them from Admin &rarr; Pricing Plans.</p>
            <?php else: ?>
                <div class="pricing-grid">
                    <?php foreach ($plans as $p):
                        $features    = array_filter(array_map('trim', explode("\n", (string) $p['features'])));
                        $notIncluded = array_filter(array_map('trim', explode("\n", (string) $p['not_included'])));
                    ?>
                    <div class="pricing-card<?php echo $p['is_featured'] ? ' is-featured' : ''; ?>">
                        <?php if (!empty($p['badge'])): ?>
                            <div class="pricing-badge"><?php echo e($p['badge']); ?></div>
                        <?php endif; ?>

                        <div class="pricing-card-head">
                            <h3><?php echo e($p['name']); ?></h3>
                            <p><?php echo e($p['subtitle']); ?></p>
                            <div class="pricing-amount">
                                <span class="pricing-currency">NZ$</span>
                                <span class="pricing-number"><?php echo e($p['price']); ?></span>
                                <span class="pricing-period"><?php echo e($p['period']); ?></span>
                            </div>
                        </div>

                        <ul class="pricing-features">
                            <?php foreach ($features as $f): ?>
                                <li><i class="fas fa-check-circle"></i> <span><?php echo e($f); ?></span></li>
                            <?php endforeach; ?>
                            <?php foreach ($notIncluded as $nf): ?>
                                <li class="is-excluded"><i class="far fa-times-circle"></i> <span><?php echo e($nf); ?></span></li>
                            <?php endforeach; ?>
                        </ul>

                        <a class="rts-btn <?php echo $p['is_featured'] ? 'btn-primary' : 'btn-primary-alta'; ?> pricing-cta" href="contact.php">
                            Get Started on <?php echo e($p['name']); ?> <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Add-ons -->
            <div class="pricing-addons">
                <h4>Optional Add-Ons &amp; Catch-Up Bookkeeping:</h4>
                <div class="pricing-addons-grid">
                    <div class="pricing-addon-card">
                        <h5>Additional Payroll Staff</h5>
                        <p>$8 + GST per employee per pay run, including automated IRD payday filing.</p>
                    </div>
                    <div class="pricing-addon-card">
                        <h5>Catch-Up Backlog Bookkeeping</h5>
                        <p>Behind on your books? We clean up historical months from $150 + GST per un-reconciled month.</p>
                    </div>
                    <div class="pricing-addon-card">
                        <h5>Virtual CFO Strategy Session</h5>
                        <p>Deep-dive 60-minute quarterly financial roadmap and cash flow modeling ($250 + GST).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 70px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 28px; margin: 0 0 10px;">Need a Tailored Custom Package?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 15.5px; margin: 0;">Have higher transaction volume or complex multi-entity group structure? Contact us for a custom quote.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Custom Proposal <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
