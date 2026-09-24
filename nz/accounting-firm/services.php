<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Outsourcing Services for Accounting Practices | get-accountant';
$metaDescription = 'White-label accounts payable, receivable, payroll, GST workpapers, and year-end compliance outsourcing for New Zealand CA and CPA firms.';
$pageHeading     = 'Outsourcing Services';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

$services = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'firm_outsourcing']);
        $services = $stmt->fetchAll();
    } catch (Throwable $e) {
        $services = [];
    }
}

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-service-area rts-section-gapTop" style="padding-top: 70px;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Specialized Practice Solutions</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">White-Label Production Services for Accounting Practices</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Expand your firm's billable capacity without the overhead of local recruitment, office space, or payroll tax. We deliver audit-ready working papers ready for partner sign-off.
                    </p>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php if (empty($services)): ?>
                    <p class="disc text-center w-full">Services are currently being loaded.</p>
                <?php else: ?>
                    <?php foreach ($services as $service): 
                        $detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                    ?>
                    <div class="xl:w-1/3 lg:w-1/2 md:w-1/2 px-[15px] pb--35">
                        <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); height: 100%; display: flex; flex-direction: column; border: 1px solid #e2e8f0; transition: transform .3s, box-shadow .3s;">
                            <div style="height: 200px; overflow: hidden; position: relative;">
                                <img src="<?php echo site_url($service['image'] ?: 'assets/images/service/10.jpg'); ?>" alt="<?php echo e($service['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 15px; right: 15px; background: #0b1220; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; border-left: 3px solid #e53935;">
                                    White-Label Delivery
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
                                        Deliverables &amp; Workflow <i class="far fa-arrow-right" style="margin-left: 6px;"></i>
                                    </a>
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">CA ANZ Standard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Practice Compliance Note -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px 24px; margin-top: 20px; text-align: center;">
                <p style="margin: 0; font-size: 14px; color: #64748b;">
                    <i class="fas fa-info-circle" style="color: #e53935; margin-right: 6px;"></i>
                    All GST and PAYE workpapers are prepared in strict accordance with Inland Revenue (IRD) requirements. Final review, approval and filing remain with your authorized firm partners.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0; margin-top: 60px;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Test Our Workpaper Caliber on a Pilot Job</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">We invite firm partners to trial 2-3 sample GST returns or year-end jobs under complete NDA.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Pilot Batch <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
