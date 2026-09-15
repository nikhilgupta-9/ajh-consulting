<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'How It Works';
$metaDescription = 'How our bookkeeping onboarding and ongoing support process works for New Zealand businesses.';
$pageHeading     = 'How It Works';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';

$steps = [
    ['step' => '1', 'title' => 'Free Consultation',   'desc' => 'We learn about your business and what support you need.'],
    ['step' => '2', 'title' => 'Onboarding',           'desc' => 'We connect to your existing accounting systems and records.'],
    ['step' => '3', 'title' => 'Ongoing Bookkeeping',  'desc' => 'We handle day-to-day bookkeeping, reconciliation and reporting.'],
    ['step' => '4', 'title' => 'Monthly Reporting',    'desc' => 'You receive clear, regular reports on where your business stands.'],
];
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($steps as $s): ?>
                <div class="xl:w-1/4 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <div class="single-service-home-six text-center" style="height:100%;">
                        <div class="inner">
                            <span class="color-primary" style="font-size:32px;font-weight:800;">0<?php echo e($s['step']); ?></span>
                            <h3 class="title" style="font-size:19px;margin-top:10px;"><?php echo e($s['title']); ?></h3>
                            <p class="disc"><?php echo e($s['desc']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
