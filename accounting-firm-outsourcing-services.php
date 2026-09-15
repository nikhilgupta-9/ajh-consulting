<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Outsourcing Services';
$metaDescription = 'Accounts payable, accounts receivable, payroll, GST returns and monthly accounting outsourcing for New Zealand accounting firms.';
$pageHeading     = 'Outsourcing Services';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

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

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <?php if (empty($services)): ?>
                <p class="disc text-center">Services will be listed here soon. Manage them from the admin panel &mdash; Services.</p>
            <?php else: ?>
                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($services as $service): ?>
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--40">
                        <div class="single-service-home-six" style="height:100%;">
                            <div class="inner">
                                <h3 class="title"><?php echo e($service['title']); ?></h3>
                                <?php if (!empty($service['short_description'])): ?>
                                    <p class="disc"><?php echo e($service['short_description']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($service['description'])): ?>
                                    <div class="disc" style="margin-top:10px;"><?php echo $service['description']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
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

<?php require __DIR__ . '/includes/footer.php'; ?>
