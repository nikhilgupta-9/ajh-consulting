<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Case Studies';
$metaDescription = 'Case studies from accounting firms we work with in New Zealand.';
$pageHeading     = 'Case Studies';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:700px;margin:0 auto;">
                    <h2 class="title">Case Studies Coming Soon</h2>
                    <p class="disc mt--20">We're building out detailed case studies as we complete projects with New Zealand accounting firms. In the meantime, take a look at what our clients say in Client Stories, or get in touch to discuss your firm's specific needs.</p>
                    <a class='rts-btn btn-primary mt--20' href='contactus.php'>Talk to Us</a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
