<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Accounting & Bookkeeping';
$metaDescription = 'Accurate, reliable bookkeeping and accounting support for small businesses across New Zealand.';
$pageHeading     = 'Accounting & Bookkeeping';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';

$hubCards = [
    ['title' => 'Services',                'url' => 'accounting-bookkeeping-services.php',       'desc' => 'Bookkeeping, tax returns, payroll and more.'],
    ['title' => 'Industries We Support',    'url' => 'accounting-bookkeeping-industries.php',     'desc' => 'Retail, hospitality, trades, professional services.'],
    ['title' => 'Why Choose Us',            'url' => 'accounting-bookkeeping-why-us.php',         'desc' => 'What makes our support different.'],
    ['title' => 'How It Works',             'url' => 'accounting-bookkeeping-how-it-works.php',   'desc' => 'Our simple onboarding-to-reporting process.'],
    ['title' => 'Pricing',                  'url' => 'accounting-bookkeeping-pricing.php',        'desc' => 'Straightforward, transparent pricing.'],
    ['title' => 'FAQs',                     'url' => 'accounting-bookkeeping-faqs.php',           'desc' => 'Answers to common questions.'],
    ['title' => 'Client Stories',           'url' => 'accounting-bookkeeping-client-stories.php', 'desc' => 'What our clients say about us.'],
    ['title' => 'Insights & Resources',     'url' => 'accounting-bookkeeping-insights.php',       'desc' => 'Guides and articles for NZ businesses.'],
];
?>

    <!-- intro area -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:800px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; New Zealand</span>
                    <h2 class="title mt--10">Smarter Bookkeeping for New Zealand Businesses</h2>
                    <p class="disc mt--20">We help small and medium businesses across New Zealand simplify their day-to-day bookkeeping, tax and payroll &mdash; so you can focus on running your business, not chasing numbers.</p>
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
                                <h3 class="title" style="font-size:19px;"><?php echo e($card['title']); ?></h3>
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
                    <h3 class="title">Ready to Simplify Your Books?</h3>
                    <p class="disc" style="color:#fff;">Get in touch and we'll take bookkeeping off your plate.</p>
                </div>
                <div class="cta-right">
                    <a class='rts-btn btn-primary' style="background:#fff;color:var(--color-primary);" href='contactus.php'>Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end cta area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
