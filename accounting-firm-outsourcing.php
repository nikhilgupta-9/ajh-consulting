<?php
require_once __DIR__ . '/config/config.php';

$branch          = 'firm_outsourcing';
$pageHeading     = 'Accounting Firm Outsourcing';
$pageTitle       = 'Accounting Firm Outsourcing';
$metaDescription = 'Reliable outsourcing support for accounting firms across New Zealand — accounts payable, receivable, payroll, GST and monthly accounting.';

$introHeading = 'Smarter Outsourcing Solutions for Accounting Firms';
$introText    = "We deliver reliable, professional outsourcing services that help accounting firms streamline operations, enhance efficiency and unlock new growth opportunities.\nWhether you need support with accounts payable, payroll, debtor management or compliance reporting, our solutions are designed to lighten your workload while keeping you in control — for a fixed monthly fee, so you know your costs moving forward.";

$whyHeading = 'Why Outsource With Us';
$whyPoints = [
    'Experienced accounting and bookkeeping expertise',
    'Reduce your staffing requirements',
    'Turn fixed staff costs into variable costs',
    'Transparent, fixed-fee options',
    'Flexible, scalable services as your firm grows',
    'Enhanced security and confidentiality',
];

$ctaHeading = 'Ready to Outsource Smarter?';
$ctaText    = "Contact us today to explore how our outsourcing services can reduce your operational burden and drive growth.";

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/branch-page.php';
require __DIR__ . '/includes/footer.php';
