<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Why Partner with Us';
$metaDescription = 'Why New Zealand accounting firms partner with get-accountant for outsourcing support.';
$pageHeading     = 'Why Partner with Us';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';

$whyPoints = [
    'Experienced accounting and bookkeeping expertise',
    'Reduce your staffing requirements during busy periods',
    'Turn fixed staff costs into variable, scalable costs',
    'Transparent, fixed-fee pricing',
    'Flexible support that scales as your firm grows',
    'Data handled under confidentiality agreements aligned with the Privacy Act 2020',
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
