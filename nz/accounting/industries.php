<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Industries We Support';
$metaDescription = 'Bookkeeping and accounting support across retail, hospitality, trades and professional services in New Zealand.';
$pageHeading     = 'Industries We Support';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';

$industries = [
    ['name' => 'Retail',                    'desc' => 'Inventory-aware bookkeeping and GST support for retail businesses.'],
    ['name' => 'Hospitality',               'desc' => 'Cash flow and payroll support built around hospitality rosters.'],
    ['name' => 'Trades & Construction',     'desc' => 'Job costing, invoicing and GST for trades and construction businesses.'],
    ['name' => 'Professional Services',     'desc' => 'Bookkeeping for consultants, agencies and service-based businesses.'],
    ['name' => 'Health & Wellness',         'desc' => 'Support for clinics, practitioners and wellness businesses.'],
    ['name' => 'E-commerce',                'desc' => 'Bookkeeping that keeps up with online sales and multiple channels.'],
];
// NOTE: placeholder list — update once Anubhav shares the final target industries.
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:750px;margin:0 auto 30px;">
                    <p class="disc">We work with small and medium businesses across a wide range of industries in New Zealand.</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($industries as $industry): ?>
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <div class="single-service-home-six" style="height:100%;">
                        <div class="inner">
                            <h3 class="title" style="font-size:19px;"><?php echo e($industry['name']); ?></h3>
                            <p class="disc"><?php echo e($industry['desc']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
