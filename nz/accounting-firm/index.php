<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Accounting Firm Outsourcing';
$metaDescription = 'Outsourcing support for accounting firms in New Zealand — accounts payable, receivable, payroll, GST and monthly accounting, aligned with IRD and Companies Office requirements.';
$pageHeading     = 'Accounting Firm Outsourcing';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';

$hubCards = [
    ['title' => 'Outsourcing Services',            'url' => 'accounting-firm-outsourcing-services.php',     'desc' => 'Accounts payable, receivable, payroll, GST and monthly accounting.'],
    ['title' => 'How We Work with Firms',          'url' => 'accounting-firm-outsourcing-how-we-work.php',  'desc' => 'Our process for working alongside your firm.'],
    ['title' => 'Technology & Systems',            'url' => 'accounting-firm-outsourcing-technology.php',   'desc' => 'The software and security we work with.'],
    ['title' => 'Why Partner with Us',             'url' => 'accounting-firm-outsourcing-why-partner.php',  'desc' => 'What makes us a reliable outsourcing partner.'],
    ['title' => 'Case Studies',                    'url' => 'accounting-firm-outsourcing-case-studies.php', 'desc' => 'How we\'ve supported other accounting firms.'],
    ['title' => 'FAQs',                            'url' => 'accounting-firm-outsourcing-faqs.php',         'desc' => 'Answers to common questions from firms.'],
    ['title' => 'Insights for Accounting Firms',   'url' => 'accounting-firm-outsourcing-insights.php',     'desc' => 'Articles and resources for practice owners.'],
];
?>

    <!-- intro area -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:850px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; New Zealand</span>
                    <h2 class="title mt--10">Smarter Outsourcing Solutions for Accounting Firms</h2>
                    <p class="disc mt--20">We deliver reliable, professional outsourcing services that help New Zealand accounting firms streamline operations and free up partner and senior staff time. Our team works within the compliance framework NZ accounting practices operate under &mdash; including IRD filing requirements, the Companies Act 1993 and the Privacy Act 2020 &mdash; for a fixed monthly fee, so your costs stay predictable.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end intro area -->

    <!-- hub links area -->
    <div class="rts-service-area rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($hubCards as $card): ?>
                <div class="xl:w-1/4 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <a href="<?php echo e($card['url']); ?>" style="display:block;height:100%;">
                        <div class="single-service-home-six" style="height:100%;">
                            <div class="inner">
                                <h3 class="title" style="font-size:18px;"><?php echo e($card['title']); ?></h3>
                                <p class="disc"><?php echo e($card['desc']); ?></p>
                                <span class="color-primary" style="font-weight:600;">View <i class="far fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- end hub links area -->

    <!-- cta area -->
    <div class="rts-cta-bg cta-one-bg">
        <div class="container">
            <div class="cta-one-inner">
                <div class="cta-left">
                    <h3 class="title">Ready to Outsource Smarter?</h3>
                    <p class="disc" style="color:#fff;">Contact us today to explore how our outsourcing services can reduce your operational burden.</p>
                </div>
                <div class="cta-right">
                    <a class='rts-btn btn-primary' style="background:#fff;color:var(--color-primary);" href='contactus.php'>Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end cta area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
