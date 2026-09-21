<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Outsourcing Services';
$metaDescription = 'Accounts payable, accounts receivable, payroll, GST returns and monthly accounting outsourcing for New Zealand accounting firms.';
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

    <!-- latest service area (compact photo cards) -->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <?php if (empty($services)): ?>
                <p class="disc text-center">Services will be listed here soon. Manage them from the admin panel &mdash; Services.</p>
            <?php else: ?>
                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--10">
                    <?php
                    $__photos = ['10', '11', '12', '13'];
                    $__i = 0;
                    foreach ($services as $service):
                        $__photo = $__photos[$__i % count($__photos)];
                        $__detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                        $__i++;
                    ?>
                    <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full pb--30">
                        <!-- single service start -->
                        <div class="rts-single-service-h2 inner" style="height:100%;">
                            <a class='thumbnail' href='<?php echo e($__detailUrl); ?>'>
                                <img src="<?php echo e($service['image'] ?: site_url('assets/images/service/' . $__photo . '.jpg')); ?>" alt="<?php echo e($service['title']); ?>">
                            </a>
                            <div class="body">
                                <a href='<?php echo e($__detailUrl); ?>'>
                                    <h3 class="title"><?php echo e($service['title']); ?></h3>
                                </a>
                                <?php if (!empty($service['short_description'])): ?>
                                    <p class="disc"><?php echo e($service['short_description']); ?></p>
                                <?php endif; ?>
                                <a class='btn-red-more' href='<?php echo e($__detailUrl); ?>'>Learn More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- single service End -->
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-wrap -mx-[15px] mt--20">
                <div class="w-full px-[15px] text-center">
                    <p class="disc" style="font-size:14px;color:#888;">All GST and PAYE filings are prepared in line with Inland Revenue (IRD) requirements. Final filing and sign-off remains with your firm.</p>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
