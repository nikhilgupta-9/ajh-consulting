<?php
require_once __DIR__ . '/../../config/config.php';

$country     = 'nz';
$branch      = 'bookkeeping';
$pageTitle       = 'Accounting & Bookkeeping';
$metaDescription = 'Accurate, reliable bookkeeping and accounting support for small businesses across New Zealand.';
$pageHeading     = 'Accounting & Bookkeeping';

$introHeading = 'Smarter Bookkeeping for New Zealand Businesses';
$introText    = 'We help small and medium businesses across New Zealand simplify their day-to-day bookkeeping, tax and payroll — so you can focus on running your business, not chasing numbers.';

$whyHeading = 'Why Choose Us';
$whyPoints  = [
    'Dedicated bookkeeping support tailored to your business',
    'Accurate, on-time monthly and tax reporting',
    'Straightforward, transparent pricing',
    'Local New Zealand team who understand IRD requirements',
];

$steps = [
    ['step' => '1', 'title' => 'Free Consultation',  'desc' => 'We learn about your business and what support you need.'],
    ['step' => '2', 'title' => 'Onboarding',          'desc' => 'We connect to your existing accounting systems and records.'],
    ['step' => '3', 'title' => 'Ongoing Bookkeeping', 'desc' => 'We handle day-to-day bookkeeping, reconciliation and reporting.'],
    ['step' => '4', 'title' => 'Monthly Reporting',   'desc' => 'You receive clear, regular reports on where your business stands.'],
];

$ctaHeading = 'Ready to Simplify Your Books?';
$ctaText    = "Get in touch and we'll take bookkeeping off your plate.";

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
require __DIR__ . '/../../includes/branch-home.php';
require __DIR__ . '/../../includes/footer.php';
