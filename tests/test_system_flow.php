<?php
/**
 * Automated Test Suite for get-accountant System Architecture & Unified Homepage
 */

require_once __DIR__ . '/../config/config.php';

echo "====================================================\n";
echo "   RUNNING GET-ACCOUNTANT SYSTEM ARCHITECTURE TESTS\n";
echo "====================================================\n\n";

$passed = 0;
$failed = 0;

function assert_test(string $name, bool $condition, string $details = '') {
    global $passed, $failed;
    if ($condition) {
        echo " [PASS] $name\n";
        $passed++;
    } else {
        echo " [FAIL] $name: $details\n";
        $failed++;
    }
}

// -----------------------------------------------------------------
// Test 1: Database Connectivity & Services Integrity
// -----------------------------------------------------------------
$pdo = db();
assert_test("Database Connection", $pdo !== null, "Could not connect to database");

$stmt = $pdo->query("SELECT COUNT(*) FROM services WHERE branch = 'bookkeeping'");
$bizCount = (int) $stmt->fetchColumn();
assert_test("7 Authentic Business Services Seeded", $bizCount === 7, "Expected 7, found $bizCount");

$stmt = $pdo->query("SELECT COUNT(*) FROM services WHERE branch = 'firm_outsourcing'");
$firmCount = (int) $stmt->fetchColumn();
assert_test("6 Authentic Practice Workflows Seeded", $firmCount === 6, "Expected 6, found $firmCount");

// -----------------------------------------------------------------
// Test 2: Verify Slugs & Critical Fields
// -----------------------------------------------------------------
$requiredSlugs = [
    'bookkeeping',
    'tax-returns-gst',
    'annual-accounts',
    'payroll',
    'catch-up-accounting',
    'business-reporting',
    'tax-advice-planning',
    'bookkeeping-reconciliations',
    'year-end-workpapers',
    'tax-gst-preparation',
    'payroll-support',
    'catch-up-projects',
    'management-reporting'
];

$allSlugs = $pdo->query("SELECT slug FROM services")->fetchAll(PDO::FETCH_COLUMN);
$missingSlugs = array_diff($requiredSlugs, $allSlugs);
assert_test("All 13 Authentic Slugs Present", empty($missingSlugs), "Missing: " . implode(', ', $missingSlugs));

// -----------------------------------------------------------------
// Test 3: Regional Helper Functions (current_country, current_track)
// -----------------------------------------------------------------
$_COOKIE['ga_country'] = 'au';
assert_test("current_country() reads 'au' cookie", current_country() === 'au', "Expected 'au'");

$_COOKIE['ga_country'] = 'nz';
assert_test("current_track() defaults cleanly", in_array(current_track(), ['business', 'firm'], true), "Invalid track");

// -----------------------------------------------------------------
// Test 4: Service Detail Page Rendering For Slugs
// -----------------------------------------------------------------
$testSlugs = ['bookkeeping', 'year-end-workpapers', 'catch-up-accounting', 'management-reporting'];
foreach ($testSlugs as $slug) {
    $_GET['slug'] = $slug;
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['SCRIPT_NAME'] = '/service-details.php';
    $_SERVER['REQUEST_URI'] = '/service-details.php?slug=' . $slug;
    
    ob_start();
    include __DIR__ . '/../service-details.php';
    $out = ob_get_clean();
    
    assert_test("Service Detail renders successfully for '{$slug}'", strlen($out) > 20000 && strpos($out, 'Standardized Quality Process') !== false);
}

// Check Service Detail specific conversion elements on first slug
$_GET['slug'] = 'bookkeeping';
ob_start();
include __DIR__ . '/../service-details.php';
$sdHtml = ob_get_clean();

assert_test("Service Detail includes improved Breadcrumb Trail", strpos($sdHtml, 'sd-breadcrumb-nav') !== false);
assert_test("Service Detail includes Desktop Sticky Floating Sidebar", strpos($sdHtml, 'service-sidebar-sticky') !== false);
assert_test("Service Detail includes WhatsApp Instant Chat Button", strpos($sdHtml, 'sd-btn-whatsapp') !== false && strpos($sdHtml, 'wa.me') !== false);
assert_test("Service Detail includes Direct Call Desk Button", strpos($sdHtml, 'sd-btn-call') !== false && strpos($sdHtml, 'tel:') !== false);
assert_test("Service Detail includes Redesigned Interactive FAQ Accordion", strpos($sdHtml, 'sd-faq-section') !== false && strpos($sdHtml, 'sd-faq-item') !== false);

// -----------------------------------------------------------------
// Test 5: Homepage (index.php) Structure - Finbiz Theme + Indian Muneem Flow
// -----------------------------------------------------------------
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['REQUEST_URI'] = '/index.php';
unset($_GET['slug']);

ob_start();
include __DIR__ . '/../index.php';
$hp = ob_get_clean();

assert_test("Homepage includes Finbiz Hero Slider Banner", strpos($hp, 'rts-banner-area') !== false);
assert_test("Homepage includes Stats (99.8%)", strpos($hp, '99.8%') !== false);
assert_test("Homepage includes Who We Serve (Dual Track)", strpos($hp, 'Built for Two') !== false);
assert_test("Homepage includes 13-Services Tabs Grid", strpos($hp, 'data-bl-tab="bookkeeping"') !== false);
assert_test("Homepage does not include Key Partners", strpos($hp, 'Key <em>Partners</em>') === false);
assert_test("Homepage includes Sector-Specific Expertise", strpos($hp, 'Trades &amp; Construction') !== false);
assert_test("Homepage includes Why Choose Us Section", strpos($hp, 'Why Smart Businesses Choose') !== false);
assert_test("Homepage includes 3-Phase Delivery Workflow", strpos($hp, 'Phase 1: Discovery') !== false);
assert_test("Homepage includes Accounting Software", strpos($hp, 'Accounting <em>Software</em>') !== false);
assert_test("Homepage renders Accounting Software Logos", strpos($hp, 'assets/images/software/xero.png') !== false && strpos($hp, 'assets/images/software/myob.png') !== false);
assert_test("Homepage includes Client Testimonials", strpos($hp, 'Trusted by Our Clients') !== false);
assert_test("Homepage includes Certifications & Standards section", strpos($hp, 'Certifications &amp; <em>Standards</em>') !== false);
assert_test("Homepage includes ISO 27001 and SOC 2 Type II", strpos($hp, 'ISO 27001:2022') !== false && strpos($hp, 'SOC 2 Type II') !== false);

// -----------------------------------------------------------------
// Test 5b: Verify Navbar Dynamic DB Connection & Homepage Redirection
// -----------------------------------------------------------------
assert_test("Navbar Services includes dynamically queried Business Services", strpos($hp, 'service-details.php?slug=bookkeeping') !== false && strpos($hp, 'Cloud Bookkeeping &amp; Daily Reconciliations') !== false);
assert_test("Navbar Services includes dynamically queried Firm Services", strpos($hp, 'service-details.php?slug=year-end-workpapers') !== false && strpos($hp, 'Audit-Ready Year-End Working Paper Production') !== false);
assert_test("Navbar Services includes View All links", strpos($hp, 'View All Business Services') !== false && strpos($hp, 'View All Firm Solutions') !== false);
assert_test("Navbar includes dedicated navbar.css styling", strpos($hp, 'assets/css/navbar.css') !== false);
assert_test("Navbar Services includes enterprise 2-column mega menu & trust bar", strpos($hp, 'mega-columns-wrap') !== false && strpos($hp, 'mega-bottom-trust') !== false);
assert_test("Navbar Company submenu includes micro-icons", strpos($hp, 'fa-building') !== false && strpos($hp, 'fa-user-friends') !== false);


// Verify "Explore Business Services" CTA redirects to nz/accounting/services.php
$exploreBtnMatch = preg_match('/<a[^>]+href="([^"]+)"[^>]*>\s*Explore Business Services/i', $hp, $btnMatches);
assert_test("Homepage 'Explore Business Services' links to accounting services page", $exploreBtnMatch && strpos($btnMatches[1], 'nz/accounting/services.php') !== false);

// Verify dynamic reflection of admin service additions
$pdo->exec("INSERT INTO services (title, slug, branch, sort_order) VALUES ('_Automated Dynamic Test Service_', 'test-dyn-srv', 'bookkeeping', 99)");
ob_start();
include __DIR__ . '/../index.php';
$hpWithNewSrv = ob_get_clean();
assert_test("Admin-added service dynamically appears in navbar", strpos($hpWithNewSrv, 'test-dyn-srv') !== false && strpos($hpWithNewSrv, '_Automated Dynamic Test Service_') !== false);
// Cleanup
$pdo->exec("DELETE FROM services WHERE slug = 'test-dyn-srv'");


// -----------------------------------------------------------------
// Test 6: Verify Duplicate Index Redirection in Subdirectories
// -----------------------------------------------------------------
// Verify duplicate index redirects
$nzAccountingContent = file_get_contents(__DIR__ . '/../nz/accounting/index.php');
assert_test("nz/accounting/index.php redirects to services catalog", strpos($nzAccountingContent, 'nz/accounting/services.php') !== false);

$nzFirmContent = file_get_contents(__DIR__ . '/../nz/accounting-firm/index.php');
assert_test("nz/accounting-firm/index.php redirects to services catalog", strpos($nzFirmContent, 'nz/accounting-firm/services.php') !== false);

// -----------------------------------------------------------------
// Test 7: Verify Subnav Cleanups (Removed How it Works, Client Stories, Pricing)
// -----------------------------------------------------------------
$_SERVER['REQUEST_URI'] = '/nz/accounting/services.php';
$_SERVER['SCRIPT_NAME'] = '/nz/accounting/services.php';
ob_start();
include __DIR__ . '/../nz/accounting/services.php';
$srvPage = ob_get_clean();

assert_test("Subnav removes How It Works link", strpos($srvPage, 'how-it-works.php') === false);
assert_test("Subnav removes Client Stories link", strpos($srvPage, 'client-stories.php') === false);
assert_test("Subnav removes Pricing link", strpos($srvPage, 'pricing.php') === false);

$subnavFile = file_get_contents(__DIR__ . '/../includes/bookkeeping-subnav.php');
assert_test("bookkeeping-subnav.php does not contain pricing, client-stories, or how-it-works", 
    strpos($subnavFile, 'pricing.php') === false && 
    strpos($subnavFile, 'client-stories.php') === false && 
    strpos($subnavFile, 'how-it-works.php') === false
);

$firmSubnavFile = file_get_contents(__DIR__ . '/../includes/firm-outsourcing-subnav.php');
assert_test("firm-outsourcing-subnav.php does not contain how-we-work or case-studies", 
    strpos($firmSubnavFile, 'how-we-work.php') === false && 
    strpos($firmSubnavFile, 'case-studies.php') === false
);

$headerFile = file_get_contents(__DIR__ . '/../includes/header.php');
assert_test("Header navbar does not contain pricing link", strpos($headerFile, 'pricing.php') === false);

$footerFile = file_get_contents(__DIR__ . '/../includes/footer.php');
assert_test("Footer does not contain pricing link", strpos($footerFile, 'pricing.php') === false);

// -----------------------------------------------------------------
// Test 8: Verify Admin-Controlled & Page/Service-Specific FAQ System
// -----------------------------------------------------------------
$faqCols = $pdo->query("SHOW COLUMNS FROM faqs")->fetchAll(PDO::FETCH_COLUMN);
assert_test("faqs table has service_id column", in_array('service_id', $faqCols, true));
assert_test("faqs table has page column", in_array('page', $faqCols, true));
assert_test("faqs table has category column", in_array('category', $faqCols, true));
assert_test("faqs table has is_active column", in_array('is_active', $faqCols, true));

// Test Payroll specific FAQ load
$_GET['slug'] = 'payroll';
$_SERVER['REQUEST_URI'] = '/service-details.php?slug=payroll';
ob_start();
include __DIR__ . '/../service-details.php';
$prHtml = ob_get_clean();
assert_test("Payroll service page displays payroll-specific FAQs (Holidays Act)", strpos($prHtml, 'Holidays Act 2003') !== false);

// Test GST specific FAQ load
$_GET['slug'] = 'tax-returns-gst';
$_SERVER['REQUEST_URI'] = '/service-details.php?slug=tax-returns-gst';
ob_start();
include __DIR__ . '/../service-details.php';
$gstHtml = ob_get_clean();
assert_test("GST service page displays GST-specific FAQs (Inland Revenue filing)", strpos($gstHtml, 'file our GST returns directly with Inland Revenue') !== false);

// Test Firm Workpapers specific FAQ load
$_GET['slug'] = 'year-end-workpapers';
$_SERVER['REQUEST_URI'] = '/service-details.php?slug=year-end-workpapers';
ob_start();
include __DIR__ . '/../service-details.php';
$wpHtml = ob_get_clean();
assert_test("Workpapers service page displays workpaper-specific FAQs (APS, CCH iFirm)", strpos($wpHtml, 'APS, CCH iFirm, Xero Workpapers') !== false);

// Test Accounting FAQs page dynamic categories
$_SERVER['REQUEST_URI'] = '/nz/accounting/faqs.php';
$_SERVER['SCRIPT_NAME'] = '/nz/accounting/faqs.php';
ob_start();
include __DIR__ . '/../nz/accounting/faqs.php';
$faqsPage = ob_get_clean();
assert_test("Dedicated FAQs page dynamically loads categories from DB", strpos($faqsPage, 'Bookkeeping &amp; Reconciliations') !== false && strpos($faqsPage, 'GST &amp; Tax Compliance') !== false);

// Test Admin FAQs Manager Search and Pagination
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['admin_id'] = 1;
$_SESSION['admin_name'] = 'Admin';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/admin/faqs.php';
$_SERVER['QUERY_STRING'] = '';
$_GET = [];
ob_start();
include __DIR__ . '/../admin/faqs.php';
$adminFaqP1 = ob_get_clean();
assert_test("Admin FAQs manager renders pagination controls and 10 items/page", strpos($adminFaqP1, 'Showing <strong>1</strong> to <strong>10</strong> of <strong>45</strong>') !== false && strpos($adminFaqP1, 'Next &raquo;') !== false);

// Test Admin FAQs Manager Page 2
$_SERVER['REQUEST_URI'] = '/admin/faqs.php?page=2';
$_SERVER['QUERY_STRING'] = 'page=2';
$_GET = ['page' => '2'];
ob_start();
include __DIR__ . '/../admin/faqs.php';
$adminFaqP2 = ob_get_clean();
assert_test("Admin FAQs manager page 2 shows items 11-20 and active previous link", strpos($adminFaqP2, 'Showing <strong>11</strong> to <strong>20</strong> of <strong>45</strong>') !== false && strpos($adminFaqP2, 'title="Previous page"') !== false);

// Test Admin FAQs Manager Search
$_SERVER['REQUEST_URI'] = '/admin/faqs.php?q=payroll';
$_SERVER['QUERY_STRING'] = 'q=payroll';
$_GET = ['q' => 'payroll'];
ob_start();
include __DIR__ . '/../admin/faqs.php';
$adminFaqSearch = ob_get_clean();
assert_test("Admin FAQs manager search filters correctly and highlights keyword", strpos($adminFaqSearch, 'Search: "<strong>payroll</strong>"') !== false && strpos($adminFaqSearch, '<mark') !== false);




// -----------------------------------------------------------------
// Summary
// -----------------------------------------------------------------
echo "\n====================================================\n";
echo " TEST RESULTS: $passed PASSED | $failed FAILED\n";
echo "====================================================\n";

exit($failed === 0 ? 0 : 1);
