<?php
require_once __DIR__ . '/config/config.php';

$country         = current_country();
$branch          = 'bookkeeping';
$pageTitle       = 'New Zealand & Australia Accounting & Bookkeeping Services';
$metaDescription = 'Accurate, stress-free bookkeeping, IRD GST filing, ATO BAS, payroll, and financial clarity from qualified accountants.';
$currentPage     = 'index.php';

// All copy for the common homepage; layout lives in includes/branch-landing.php.
$L = [
    'hero' => [
        'eyebrow'  => ($country === 'au' ? 'Australia' : 'New Zealand') . ' Accounting & Bookkeeping',
        'title'    => 'Smarter <em>Bookkeeping</em> for Growing Businesses',
        'text'     => 'Accurate bank reconciliations, on-time statutory GST & tax returns, payday payroll, and clear financial visibility from qualified accountants. We handle the paperwork so you can grow with total confidence.',
        'cta'      => 'Get Free Consultation',
        'badges'   => ['100% Statutory Compliant', 'Xero & MYOB Certified', 'Fixed Monthly Fees'],
        'image'    => 'assets/images/about/01.jpg',
        'imageAlt' => 'Accountants reviewing a client’s books together',
    ],
    'serve' => [
        [
            'current' => true,
            'tag'     => 'For Businesses',
            'title'   => 'Outsource Your Finance Function, Focus on Growth',
            'text'    => 'A named, qualified accountant who knows your business, keeps your books current and files with tax authorities on time.',
            'points'  => ['Bookkeeping & bank reconciliations', 'GST returns & statutory filing', 'Payday payroll & super/KiwiSaver', 'Annual accounts & tax returns', 'Catch-up accounting clean-up', 'Monthly management reports'],
            'cta'     => 'Explore Business Services',
            'url'     => site_url('nz/accounting/services.php'),
        ],
        [
            'current' => false,
            'tag'     => 'For CA/CPA Firms',
            'title'   => 'Scale Your Practice Without Adding Overhead',
            'text'    => 'White-label bookkeeping, workpapers and tax preparation for accounting firms — delivered inside your own practice software.',
            'points'  => ['White-label bookkeeping', 'Year-end workpapers', 'Tax return preparation', 'Payroll processing support', 'Catch-up backlog projects', 'Management reporting packs'],
            'cta'     => 'See Firm Solutions',
            'url'     => site_url('nz/accounting-firm/services.php'),
        ],
    ],
    'stats' => [
        ['99.8%', 'On-time statutory filing'],
        ['250+', 'Businesses supported'],
        ['40+', 'Hours saved per month'],
        ['100%', 'Strict NDA & Privacy Act protected'],
    ],
    'servicesTitle' => 'Everything Your <em>Finance Function</em> Needs',
    'industriesText' => 'We understand the specific tax rules, payroll requirements, and cash flow cycles across key industry sectors.',
    'industries' => [
        ['Trades & Construction', 'Job costing, subcontractor PAYE, retentions, and progress payment reconciliations in Fergus & Tradify.', 'fa-hard-hat'],
        ['Retail & E-commerce', 'Shopify, POS and WooCommerce daily sync, inventory tracking, and multi-channel GST reconciliation.', 'fa-shopping-cart'],
        ['Hospitality & Cafes', 'Shift payroll under employment standards, supplier bill scheduling, and daily takings tracking.', 'fa-utensils'],
        ['Professional Services', 'WIP tracking, retainer billing, time-and-materials invoicing, and cash flow runway forecasting.', 'fa-briefcase'],
        ['Healthcare & Medical', 'Patient fee reconciliations, clinic expense allocations, and compliant partner drawings tracking.', 'fa-user-md'],
        ['Transport & Logistics', 'Fleet fuel tax credits, asset financing schedules, RUC expense coding, and driver payroll.', 'fa-truck'],
    ],
    'whyTitle' => 'Why Smart Businesses Choose <em>Us</em>',
    'whyText'  => 'Our philosophy is People. Process. Possibility.™ Business owners should spend their time growing sales and delighting customers — not wrestling with bank feeds and tax compliance.',
    'why' => [
        ['Dedicated qualified accountant', 'a named specialist who answers your calls and reconciles your accounts proactively'],
        ['Zero tax surprises', 'GST, PAYE and provisional tax computed and scheduled in advance'],
        ['Cloud automation', 'integrated with Xero, MYOB, Dext and your bank feeds for paperless receipts'],
        ['Fixed monthly fees', 'one transparent price, no surprise invoices'],
    ],
    'formServices' => ['Full Bookkeeping & GST', 'Payroll & PAYE / STP', 'Annual Financial Statements', 'Tax Returns & Advice', 'Catch-Up Backlog Cleanup', 'Firm Outsourcing / Workpapers'],
    'phases' => [
        ['icon' => 'fa-comments', 'title' => 'Phase 1: Discovery', 'steps' => [
            ['Free consultation', 'We review your current setup, volume and tax requirements.'],
            ['Fixed monthly plan', 'You get a clear plan and price before anything starts.'],
        ]],
        ['icon' => 'fa-plug', 'title' => 'Phase 2: Onboarding', 'steps' => [
            ['System connection', 'Invite our team to your Xero or MYOB account.'],
            ['Clean-up & feeds', 'We configure automated bank feeds and tidy up historical accounts.'],
        ]],
        ['icon' => 'fa-chart-bar', 'title' => 'Phase 3: Ongoing Delivery', 'steps' => [
            ['Routine processing', 'Invoices processed, bank lines reconciled, payday payroll run.'],
            ['Monthly reporting & GST', 'Clear monthly summaries plus on-time GST preparation and tax submission.'],
        ]],
    ],
    'software' => [
        ['name' => 'Xero', 'note' => 'Cloud Accounting', 'logo' => 'assets/images/software/xero.png'],
        ['name' => 'MYOB', 'note' => 'Practice & Business', 'logo' => 'assets/images/software/myob.png'],
        ['name' => 'QuickBooks', 'note' => 'Online & Desktop', 'logo' => 'assets/images/software/quickbooks.png'],
        ['name' => 'Crystal Payroll', 'note' => 'NZ Payday Filing', 'logo' => 'assets/images/software/crystal-payroll.svg'],
        ['name' => 'Fathom', 'note' => 'Financial Analysis', 'logo' => 'assets/images/software/fathom.svg'],
        ['name' => 'Spotlight Reporting', 'note' => 'Advisory Packs', 'logo' => 'assets/images/software/spotlight-reporting.svg'],
        ['name' => 'APS', 'note' => 'Practice Suite', 'logo' => 'assets/images/software/aps.svg'],
        ['name' => 'Zoho Books', 'note' => 'Cloud ERP', 'logo' => 'assets/images/software/zoho.png'],
        ['name' => 'Sage', 'note' => 'Business Accounting', 'logo' => 'assets/images/software/sage.png'],
        ['name' => 'Oracle NetSuite', 'note' => 'Cloud Financials', 'logo' => 'assets/images/software/netsuite.png'],
        ['name' => 'Wolters Kluwer', 'note' => 'CCH iFirm Tax', 'logo' => 'assets/images/software/wolters-kluwer.png'],
        ['name' => 'FreshBooks', 'note' => 'Invoicing & Expenses', 'logo' => 'assets/images/software/freshbooks.png'],
    ],
    'reviewsText' => 'Real feedback from business owners and practice partners we work with.',
    'reviewsCta'  => 'Book a Consultation',
    'reviewsUrl'  => site_url('contactus.php'),
    'certificationsTitle' => 'Certifications &amp; <em>Standards</em>',
    'certificationsText'  => 'We maintain the highest global benchmarks for quality, confidentiality, and information security across New Zealand and Australia.',
    'certifications' => [
        [
            'code'  => 'ISO 9001:2015',
            'title' => 'Quality Management System',
            'desc'  => 'Standardized multi-tier review workflows ensuring error-free accounts, reconciliations, and statutory filings.',
            'icon'  => 'fa-award',
            'badge' => 'Quality Assured',
        ],
        [
            'code'  => 'ISO 27001:2022',
            'title' => 'Information Security System',
            'desc'  => 'Enterprise-grade encryption, role-based access controls, and secure offshore infrastructure protecting client data.',
            'icon'  => 'fa-shield-alt',
            'badge' => 'Information Security',
        ],
        [
            'code'  => 'SOC 2 Type II',
            'title' => 'Security & Confidentiality',
            'desc'  => 'Independent third-party audits confirming continuous security, processing integrity, and data confidentiality.',
            'icon'  => 'fa-user-shield',
            'badge' => 'Audited Controls',
        ],
        [
            'code'  => 'Privacy Act & GDPR',
            'title' => 'Statutory Privacy Compliance',
            'desc'  => 'Full compliance with the New Zealand Privacy Act 2020, Australian Privacy Principles (APPs), and strict bilateral NDAs.',
            'icon'  => 'fa-file-shield',
            'badge' => '100% Data Protection',
        ],
    ],
    'ctaTitle'    => 'Ready to take bookkeeping off your plate?',
    'ctaText'     => 'Book a free consultation and get a fixed monthly plan for your business.',
];

$heroFile = __DIR__ . '/_hero.php'; // Finbiz theme hero slider

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/branch-landing.php';
require __DIR__ . '/includes/footer.php';
