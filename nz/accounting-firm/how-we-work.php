<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'How We Work with Firms';
$metaDescription = 'How our outsourcing process works alongside New Zealand accounting firms, from onboarding to ongoing delivery.';
$pageHeading     = 'How We Work with Firms';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';

$steps = [
    ['step' => '1', 'title' => 'Scoping Call',           'desc' => 'We discuss your firm\'s workflow, client base and which tasks you want to outsource.'],
    ['step' => '2', 'title' => 'Confidentiality Agreement', 'desc' => 'A signed confidentiality agreement is in place before any client data is shared, consistent with the Privacy Act 2020.'],
    ['step' => '3', 'title' => 'System Access & Onboarding', 'desc' => 'We work inside your existing accounting software under your firm\'s controls and processes.'],
    ['step' => '4', 'title' => 'Ongoing Processing',      'desc' => 'We handle the day-to-day work; your firm retains full oversight and professional sign-off on client accounts.'],
    ['step' => '5', 'title' => 'Reporting & Review',      'desc' => 'Regular status updates and working papers, ready for your review before filing.'],
];
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:800px;margin:0 auto 40px;">
                    <p class="disc">We work as an extension of your team &mdash; your firm stays in control of client relationships, review and final sign-off at every stage.</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($steps as $s): ?>
                <div class="xl:w-1/5 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <div class="single-service-home-six text-center" style="height:100%;">
                        <div class="inner">
                            <span class="color-primary" style="font-size:28px;font-weight:800;">0<?php echo e($s['step']); ?></span>
                            <h3 class="title" style="font-size:16px;margin-top:10px;"><?php echo e($s['title']); ?></h3>
                            <p class="disc" style="font-size:14px;"><?php echo e($s['desc']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
