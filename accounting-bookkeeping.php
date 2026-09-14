<?php
require_once __DIR__ . '/config/config.php';

$branch          = 'bookkeeping';
$pageHeading     = 'Accounting & Bookkeeping';
$pageTitle       = 'Accounting & Bookkeeping';
$metaDescription = 'Accurate, reliable bookkeeping and accounting support for small businesses across New Zealand.';

$introHeading = 'Smarter Bookkeeping for New Zealand Businesses';
$introText    = "We help small and medium businesses across New Zealand simplify their day-to-day bookkeeping, tax and payroll — so you can focus on running your business, not chasing numbers.\nOur team works with the accounting systems you already use, and keeps things simple, accurate and on time.";

$whyHeading = 'Why Choose Us';
$whyPoints = [
    'Dedicated bookkeeping support tailored to your business',
    'Accurate, on-time monthly and tax reporting',
    'Straightforward, transparent pricing',
    'Local New Zealand team who understand IRD requirements',
    'Support across retail, hospitality, trades and professional services',
    'Easy handover — we work with the systems you already use',
];

$ctaHeading = 'Ready to Simplify Your Books?';
$ctaText    = "Get in touch and we'll take bookkeeping off your plate.";

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/branch-page.php';
require __DIR__ . '/includes/footer.php';
