<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'New Zealand Accounting & Bookkeeping Services';
$metaDescription = 'Explore our full suite of accounting, bookkeeping, GST returns, payroll and tax advisory services for New Zealand businesses.';
$pageHeading     = 'Our Services';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$services = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'bookkeeping']);
        $services = $stmt->fetchAll();
    } catch (Throwable $e) {
        $services = [];
    }
}

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <!-- Services Header Introduction -->
    <div class="rts-service-area rts-section-gapTop" style="padding-top: 70px;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--40">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Full Suite of Accounting Solutions</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Complete Financial Services for Kiwi Businesses</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        From day-to-day transaction coding to strategic tax planning, get-accountant provides everything you need to keep your records spotless and Inland Revenue satisfied.
                    </p>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php if (empty($services)): ?>
                    <p class="disc text-center w-full">Services will be listed here soon.</p>
                <?php else: ?>
                    <?php foreach ($services as $service): 
                        $detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                    ?>
                    <div class="xl:w-1/3 lg:w-1/2 md:w-1/2 px-[15px] pb--35">
                        <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); height: 100%; display: flex; flex-direction: column; border: 1px solid #e2e8f0; transition: transform .3s, box-shadow .3s;">
                            <div style="height: 200px; overflow: hidden; position: relative;">
                                <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/01.jpg'); ?>" alt="<?php echo e($service['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 15px; right: 15px; background: rgba(11,18,32,0.85); color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.05em;">
                                    NZ IRD Compliant
                                </div>
                            </div>
                            <div style="padding: 30px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                                <h3 class="title h5" style="margin-bottom: 12px; font-size: 20px;">
                                    <a href="<?php echo e($detailUrl); ?>" style="color: #0f172a; text-decoration: none;"><?php echo e($service['title']); ?></a>
                                </h3>
                                <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 22px; flex-grow: 1;">
                                    <?php echo e($service['short_description']); ?>
                                </p>
                                <div style="border-top: 1px solid #f1f5f9; padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                                    <a class="rts-read-more color-primary" href="<?php echo e($detailUrl); ?>" style="font-weight: 700; font-size: 14px; text-decoration: none;">
                                        View Full Scope &amp; Details <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0; margin-top: 60px;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Not Sure Which Services You Need?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Book a complimentary 20-minute consultation. We will audit your current setup and recommend the right package.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Talk to an Accountant <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
