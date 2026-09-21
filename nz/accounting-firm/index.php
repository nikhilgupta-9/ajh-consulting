<?php
require_once __DIR__ . '/../../config/config.php';

$country     = 'nz';
$branch      = 'firm_outsourcing';
$pageTitle       = 'Accounting Firm Outsourcing';
$metaDescription = 'Outsourcing support for accounting firms in New Zealand — accounts payable, receivable, payroll, GST and monthly accounting, aligned with IRD and Companies Office requirements.';
$pageHeading     = 'Accounting Firm Outsourcing';

$introHeading = 'Smarter Outsourcing Solutions for Accounting Firms';
$introText    = "We deliver reliable, professional outsourcing services that help New Zealand accounting firms streamline operations and free up partner and senior staff time. Our team works within the compliance framework NZ accounting practices operate under — including IRD filing requirements, the Companies Act 1993 and the Privacy Act 2020 — for a fixed monthly fee, so your costs stay predictable.";

$whyHeading = 'Why Firms Partner With Us';
$whyPoints  = [
    'Reduce your staffing requirements during busy periods',
    'Fixed, predictable monthly outsourcing fees',
    'Work delivered under your firm\'s own branding and processes',
    'A team that understands NZ compliance requirements',
];

$steps = [
    ['step' => '1', 'title' => 'Discovery Call',   'desc' => "We learn about your firm's workflow and where support is needed."],
    ['step' => '2', 'title' => 'Onboarding',       'desc' => 'We integrate with your systems and agree on scope and SLAs.'],
    ['step' => '3', 'title' => 'Delivery',         'desc' => 'Our team processes work under your review and sign-off.'],
    ['step' => '4', 'title' => 'Ongoing Support',  'desc' => 'A dedicated point of contact and regular reporting on progress.'],
];

$ctaHeading = 'Ready to Outsource Smarter?';
$ctaText    = 'Contact us today to explore how our outsourcing services can reduce your operational burden.';

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';
require __DIR__ . '/../../includes/branch-home.php';
require __DIR__ . '/../../includes/footer.php';
