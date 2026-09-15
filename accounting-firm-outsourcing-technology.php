<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Technology & Systems';
$metaDescription = 'The accounting software and data security practices we use when working with New Zealand accounting firms.';
$pageHeading     = 'Technology & Systems';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';

$systems = [
    ['name' => 'Xero',              'desc' => 'Cloud-based accounting, widely used across New Zealand accounting practices.'],
    ['name' => 'MYOB',              'desc' => 'Payroll and accounting support for firms running MYOB.'],
    ['name' => 'IRD myIR',          'desc' => 'GST and PAYE data prepared ready for filing through myIR.'],
    ['name' => 'Secure File Sharing', 'desc' => 'Client data is exchanged only through secure, access-controlled channels.'],
];
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:800px;margin:0 auto 30px;">
                    <p class="disc">We work inside the systems your firm already uses &mdash; no need to change your existing setup.</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($systems as $s): ?>
                <div class="xl:w-1/4 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <div class="single-service-home-six" style="height:100%;">
                        <div class="inner">
                            <h3 class="title" style="font-size:18px;"><?php echo e($s['name']); ?></h3>
                            <p class="disc"><?php echo e($s['desc']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="flex flex-wrap -mx-[15px] mt--20">
                <div class="w-full px-[15px] text-center">
                    <p class="disc" style="font-size:14px;color:#888;">Client data is handled in line with the Privacy Act 2020, with access limited to the team working on your files.</p>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
