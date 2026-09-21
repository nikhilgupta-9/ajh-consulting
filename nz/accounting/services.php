<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Bookkeeping Services';
$metaDescription = 'Bookkeeping, tax returns, payroll and accounting services for New Zealand small businesses.';
$pageHeading     = 'Services';
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

    <!-- rts service post area Start (icon cards) -->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <?php if (empty($services)): ?>
                <p class="disc text-center">Services will be listed here soon. Manage them from the admin panel &mdash; Services.</p>
            <?php else: ?>
                <div class="w-full px-[15px] service-main plr--120-service mt--10 plr_md--0 pl_sm--0 pr_sm--0">
                    <div class="background-service flex flex-wrap -mx-[15px]">
                        <?php
                        $__icons = ['01', '02', '03', '04', '05', '06', '07', '08'];
                        $__variants = ['one', 'two', 'three', 'four'];
                        $__i = 0;
                        foreach ($services as $service):
                            $__icon = $__icons[$__i % count($__icons)];
                            $__variant = $__variants[$__i % count($__variants)];
                            $__detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                            $__i++;
                        ?>
                        <!-- start single Service -->
                        <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full pb--30">
                            <div class="service-one-inner <?php echo e($__variant); ?>" style="height:100%;">
                                <div class="thumbnail">
                                    <img src="<?php echo site_url('assets/images/service/icon/' . $__icon . '.svg'); ?>" alt="<?php echo e($service['title']); ?>">
                                </div>
                                <div class="service-details">
                                    <a href='<?php echo e($__detailUrl); ?>'>
                                        <h3 class="title h5"><?php echo e($service['title']); ?></h3>
                                    </a>
                                    <?php if (!empty($service['short_description'])): ?>
                                        <p class="disc"><?php echo e($service['short_description']); ?></p>
                                    <?php endif; ?>
                                    <a class='rts-read-more btn-primary' href='<?php echo e($__detailUrl); ?>'><i class="far fa-arrow-right"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                        <!-- end single Services -->
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- rts service post area End -->

<?php require __DIR__ . '/../../includes/footer.php'; ?>
