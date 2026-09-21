<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Why Choose Us';
$metaDescription = 'Why New Zealand small businesses choose get-accountant for bookkeeping support.';
$pageHeading     = 'Why Choose Us';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';

$whyPoints = [
    'Dedicated bookkeeping support tailored to your business',
    'Accurate, on-time monthly and tax reporting',
    'Straightforward, transparent pricing',
    'Local New Zealand team who understand IRD requirements',
    'Support across retail, hospitality, trades and professional services',
    'Easy handover — we work with the systems you already use',
];
?>

    <div class="rts-about-area rts-section-gap bg-team-color">
        <div class="container ptb--60">
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($whyPoints as $point): ?>
                <div class="xl:w-1/2 px-[15px] pb--20">
                    <div class="single-business-solution">
                        <i class="far fa-check-circle color-primary" style="margin-right:12px;font-size:20px;"></i>
                        <p style="margin:0;display:inline;"><?php echo e($point); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
