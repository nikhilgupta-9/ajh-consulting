<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Pricing';
$metaDescription = 'Transparent, tailored bookkeeping pricing for New Zealand businesses.';
$pageHeading     = 'Pricing';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';

$factors = [
    'Volume of monthly transactions',
    'Number of accounts and bank feeds',
    'Frequency of reporting you need',
    'Payroll and GST filing requirements',
];
?>

    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:750px;margin:0 auto;">
                    <h2 class="title">Straightforward, Transparent Pricing</h2>
                    <p class="disc mt--20">Every business is different, so we tailor a package to fit yours rather than a one-size-fits-all plan. Pricing depends on a few simple factors:</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px] mt--30 justify-center">
                <div class="xl:w-1/2 px-[15px]">
                    <ul style="list-style:none;padding:0;">
                        <?php foreach ($factors as $factor): ?>
                        <li style="padding:10px 0;border-bottom:1px solid #eee;">
                            <i class="far fa-check-circle color-primary" style="margin-right:10px;"></i><?php echo e($factor); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px] mt--40">
                <div class="w-full px-[15px] text-center">
                    <a class='rts-btn btn-primary' href='contactus.php'>Get a Free Quote</a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
