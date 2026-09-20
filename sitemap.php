<?php
/**
 * Human-readable HTML sitemap. Kept as a plain grouped link list here —
 * it mirrors the site's actual page structure, so there is nothing extra
 * for the admin to maintain separately (a new page just needs adding here
 * when it's added to the nav).
 */
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Sitemap';
$metaDescription = 'A complete overview of every page on the ' . APP_NAME . ' website.';

$sitemap = [
    'Main' => [
        'index.php'          => 'Home',
        'get-started.php'    => 'Get Started',
        'our-service.php'    => 'Our Services',
        'service-details.php' => 'Service Details',
        'pricing.php'        => 'Pricing',
        'team.php'           => 'Our Team',
        'project.php'        => 'Portfolio',
        'about-us.php'       => 'About Us',
        'appoinment.php'     => 'Book an Appointment',
        'contactus.php'      => 'Contact Us',
        'blog-list.php'      => 'Blog',
    ],
    'Accounting & Bookkeeping (New Zealand)' => [
        'accounting-bookkeeping.php'                => 'Overview',
        'accounting-bookkeeping-services.php'       => 'Services',
        'accounting-bookkeeping-industries.php'     => 'Industries',
        'accounting-bookkeeping-why-us.php'         => 'Why Us',
        'accounting-bookkeeping-how-it-works.php'   => 'How It Works',
        'accounting-bookkeeping-pricing.php'        => 'Pricing',
        'accounting-bookkeeping-faqs.php'           => 'FAQs',
        'accounting-bookkeeping-client-stories.php' => 'Client Stories',
        'accounting-bookkeeping-insights.php'       => 'Insights',
    ],
    'Accounting Firm Outsourcing (New Zealand)' => [
        'accounting-firm-outsourcing.php'                => 'Overview',
        'accounting-firm-outsourcing-services.php'       => 'Services',
        'accounting-firm-outsourcing-why-partner.php'    => 'Why Partner With Us',
        'accounting-firm-outsourcing-how-we-work.php'    => 'How We Work',
        'accounting-firm-outsourcing-technology.php'     => 'Technology',
        'accounting-firm-outsourcing-case-studies.php'   => 'Case Studies',
        'accounting-firm-outsourcing-faqs.php'           => 'FAQs',
        'accounting-firm-outsourcing-insights.php'       => 'Insights',
    ],
    'Australia' => [
        'australia.php' => 'Australia (Coming Soon)',
    ],
    'Legal' => [
        'privacy-policy.php' => 'Privacy Policy',
        'terms-of-use.php'   => 'Terms of Use',
        'sitemap.php'        => 'Sitemap',
    ],
];

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Sitemap</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='sitemap.php'>Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <div class="rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <?php foreach ($sitemap as $section => $links): ?>
                    <div class="lg:w-1/3 md:w-1/2 w-full px-[15px] mb--40">
                        <h3 class="title h5" style="margin-bottom:18px;"><?php echo e($section); ?></h3>
                        <ul style="list-style:none; padding:0; margin:0;">
                            <?php foreach ($links as $url => $label): ?>
                                <li style="margin-bottom:12px;">
                                    <a href="<?php echo e($url); ?>" style="color:inherit;">
                                        <i class="far fa-arrow-right" style="margin-right:8px; color:var(--color-primary);"></i><?php echo e($label); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
