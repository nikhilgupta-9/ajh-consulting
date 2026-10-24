<?php
/**
 * Migration 012: Upgraded, Distinctive Services & Rich Content
 * Tailored for New Zealand & Australia (Not generic Indian Muneem clones)
 */
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) die("Database connection failed.\n");

$services = [
    // ==========================================
    // TRACK 1: FOR BUSINESSES (branch: bookkeeping)
    // ==========================================
    [
        'title'             => 'Cloud Bookkeeping & Daily Reconciliations',
        'slug'              => 'bookkeeping',
        'branch'            => 'bookkeeping',
        'short_description' => 'Keep your bank feeds reconciled, supplier bills coded, and ledgers spotless with real-time cloud precision.',
        'description'       => '<p class="lead">Stop spending your evenings matching receipts and wrestling with bank feeds. Our dedicated business bookkeeping team ensures every transaction is accurately coded, supplier bills are processed on time, and your accounts remain audit-ready all year round.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Daily &amp; Weekly Bank Reconciliations:</strong> Live matching of bank transactions in Xero, MYOB, or QBO with zero ledger variance.</li>
    <li><strong>Accounts Payable &amp; Receipt Processing:</strong> Automated bill capture using Dext Prepare and Hubdoc with duplicate checks.</li>
    <li><strong>Accounts Receivable &amp; Invoicing:</strong> Timely customer invoicing, payment allocations, and debtor ledger maintenance.</li>
    <li><strong>Credit Card &amp; Loan Reconciliations:</strong> Complete reconciliation of commercial credit cards, director loans, and hire purchase agreements.</li>
    <li><strong>Month-End Ledger Verification:</strong> Comprehensive month-end close including balance sheet reconciliations and trial balance audits.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>With an experienced bookkeeper managing your books, you eliminate costly end-of-year accountant cleanup bills, avoid missed supplier discounts, and always know your true cash position before making major business investments.</p>',
        'icon'              => 'fa-calculator',
        'starting_price'    => '199',
        'image'             => 'assets/images/service/01.jpg',
        'sort_order'        => 1,
    ],
    [
        'title'             => 'GST Lodgement & Statutory Tax Compliance',
        'slug'              => 'tax-returns-gst',
        'branch'            => 'bookkeeping',
        'short_description' => 'Accurate draft calculations, GST returns, and timely lodgement with Inland Revenue (IRD) & ATO to eliminate penalties.',
        'description'       => '<p class="lead">Tax compliance shouldn\'t be a source of stress or unexpected cash flow shocks. We handle your complete statutory filing calendar—reconciling sales, expenses, and capital acquisitions to lodge 100% compliant returns ahead of every statutory deadline.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Bi-Monthly &amp; 6-Monthly GST Returns:</strong> Accurate reconciliation of standard, invoice, and payment basis GST returns.</li>
    <li><strong>Input Tax Credit &amp; Expense Auditing:</strong> Verification of valid tax invoices and identification of deductible business expenses.</li>
    <li><strong>Provisional Tax Planning &amp; Calculations:</strong> Accurate forecasting of upcoming provisional tax obligations to prevent year-end cash shocks.</li>
    <li><strong>Fringe Benefit Tax (FBT) &amp; Withholding Taxes:</strong> Calculation and scheduling of non-cash employee benefit returns and resident withholding tax.</li>
    <li><strong>Direct IRD / ATO Portal Lodgement:</strong> Electronic filing through authorized tax agent channels with verifiable audit trails.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Zero late filing penalties, zero interest surcharges, and total confidence that your returns are backed by audit-ready working papers if Inland Revenue or the ATO requests supporting documentation.</p>',
        'icon'              => 'fa-file-invoice-dollar',
        'starting_price'    => '249',
        'image'             => 'assets/images/service/02.jpg',
        'sort_order'        => 2,
    ],
    [
        'title'             => 'Annual Financial Accounts & Year-End Reporting',
        'slug'              => 'annual-accounts',
        'branch'            => 'bookkeeping',
        'short_description' => 'Statutory financial statements, balance sheets, and company income tax returns prepared to GAAP standards.',
        'description'       => '<p class="lead">Transform your year-end compliance from a stressful scramble into a structured strategic milestone. We compile comprehensive, GAAP-compliant annual financial statements that satisfy banks, investors, and statutory revenue authorities.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Full Financial Statement Compilation:</strong> Balance Sheet, Profit &amp; Loss Statement, Statement of Changes in Equity, and Notes to Accounts.</li>
    <li><strong>Fixed Asset Depreciation Schedules:</strong> Tax and accounting depreciation computations, asset additions, write-offs, and disposals.</li>
    <li><strong>Shareholder Current Account Management:</strong> Tracking director drawings, shareholder loan balances, and compliance with market interest rules.</li>
    <li><strong>Company Income Tax Returns (IR4 / Company Return):</strong> Precise calculation of taxable income, tax credits, and imputation/franking credit accounts.</li>
    <li><strong>Executive Performance Briefing:</strong> Summary of year-on-year trading performance and key balance sheet ratios for business owners.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Clean, professional financial reports that enhance credibility with lenders, streamline financing approvals, and clearly communicate your company\'s financial strength.</p>',
        'icon'              => 'fa-chart-pie',
        'starting_price'    => '499',
        'image'             => 'assets/images/service/03.jpg',
        'sort_order'        => 3,
    ],
    [
        'title'             => 'Payday Payroll & Wage Compliance Management',
        'slug'              => 'payroll',
        'branch'            => 'bookkeeping',
        'short_description' => 'Reliable pay runs, employee wage records, KiwiSaver/Super, and compliant Payday Filing.',
        'description'       => '<p class="lead">Navigating the Holidays Act, fluctuating shift hours, and statutory Payday Filing can be a legal minefield. Our payroll specialists run your pay cycles with surgical precision, ensuring staff are paid accurately and filings reach Inland Revenue / ATO on time, every time.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Weekly, Fortnightly &amp; Monthly Pay Runs:</strong> Precise gross-to-net pay computations across salaried and hourly workforces.</li>
    <li><strong>Statutory Leave &amp; Holidays Act Auditing:</strong> Flawless calculation of Annual Leave, Sick Leave, Bereavement Leave, and Public Holiday rates.</li>
    <li><strong>Automated Payday Filing / STP Phase 2:</strong> Electronic transmission of employment information to IRD or ATO immediately after each pay cycle.</li>
    <li><strong>KiwiSaver, Superannuation &amp; Deductions:</strong> Processing employee and employer retirement contributions, student loan deductions, and child support.</li>
    <li><strong>Digital Pay Slips &amp; End-of-Year Reconciliations:</strong> Automated delivery of secure electronic pay slips and comprehensive payroll variance reporting.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Eliminate costly Holidays Act non-compliance fines, keep employees happy with consistent on-time pay slips, and remove the pressure of weekly payroll deadlines from your shoulders.</p>',
        'icon'              => 'fa-users-cog',
        'starting_price'    => '149',
        'image'             => 'assets/images/service/04.jpg',
        'sort_order'        => 4,
    ],
    [
        'title'             => 'Catch-Up Accounting & Historical Cleanup',
        'slug'              => 'catch-up-accounting',
        'branch'            => 'bookkeeping',
        'short_description' => 'Fast, confidential cleanup of overdue bookkeeping, unreconciled transactions, and back tax files.',
        'description'       => '<p class="lead">If your business has fallen behind on bookkeeping by several months or even years, you are not alone. Our specialized catch-up accounting pod steps in without judgment, untangles messy records, and reconstructs your books rapidly so you can regain control of your business.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Historical Diagnostic &amp; Scope Audit:</strong> Full assessment of neglected bank accounts, missing supplier records, and overdue filing periods.</li>
    <li><strong>Bank Feed Rebuilding &amp; Data Extraction:</strong> Electronic conversion of PDF bank statements and receipt extraction into your cloud accounting software.</li>
    <li><strong>Bulk Ledger Reclassifications:</strong> Systemic correction of misallocated expenses, suspense account balances, and duplicate transactions.</li>
    <li><strong>Overdue GST &amp; Tax Reconciliations:</strong> Preparation of outstanding GST, PAYE, and income tax schedules ready for lodgement.</li>
    <li><strong>Fresh Starting Trial Balance:</strong> Delivery of a clean, fully reconciled set of accounts ready for ongoing maintenance.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Resolve looming statutory audit threats, regain peace of mind, unlock overdue tax refunds, and present accurate financials to your bank or mortgage broker.</p>',
        'icon'              => 'fa-history',
        'starting_price'    => '599',
        'image'             => 'assets/images/service/02.jpg',
        'sort_order'        => 5,
    ],
    [
        'title'             => 'Strategic Financial Reporting & Cash Flow Advisory',
        'slug'              => 'business-reporting',
        'branch'            => 'bookkeeping',
        'short_description' => 'Actionable monthly management packs, cash flow forecasts, and KPI tracking to grow profit.',
        'description'       => '<p class="lead">Running a business using just your bank balance is like driving with your eyes closed. We transform raw accounting numbers into executive decision-making tools that reveal profit margins, cash runway, and growth bottlenecks.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Executive Management Reporting Pack:</strong> Monthly Profit &amp; Loss, Balance Sheet, and Working Capital summaries delivered within days of month-end.</li>
    <li><strong>13-Week Rolling Cash Flow Forecast:</strong> Dynamic cash runway modeling that predicts cash shortfalls weeks before they occur.</li>
    <li><strong>Department &amp; Project Profitability Tracking:</strong> Job costing, gross margin per product/service, and customer contribution analysis.</li>
    <li><strong>Budget vs. Actual Variance Analysis:</strong> Clear graphical commentary identifying operational cost overruns and revenue trends.</li>
    <li><strong>Virtual CFO Strategy Review Meetings:</strong> Regular consultative review calls to discuss findings and align financial metrics with business objectives.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Make confident hiring and capital purchasing decisions, spot margin leakage early, and manage working capital proactively rather than reacting to surprises.</p>',
        'icon'              => 'fa-chart-line',
        'starting_price'    => '349',
        'image'             => 'assets/images/service/03.jpg',
        'sort_order'        => 6,
    ],
    [
        'title'             => 'Proactive Tax Advisory & Structural Planning',
        'slug'              => 'tax-advice-planning',
        'branch'            => 'bookkeeping',
        'short_description' => 'Strategic tax advice, deductible expense reviews, and provisional tax cash-flow planning.',
        'description'       => '<p class="lead">Proactive tax planning prevents expensive mistakes before the financial year closes. We review your commercial structures, verify deduction eligibility, and optimize shareholder distributions to ensure you retain maximum profit lawfully.</p>
<h4>What’s Included in This Service:</h4>
<ul>
    <li><strong>Pre-Year-End Tax Minimization Reviews:</strong> Actionable strategies implemented prior to March 31 (NZ) or June 30 (AU) balance dates.</li>
    <li><strong>Entity Structuring &amp; Asset Protection:</strong> Objective advice on Companies, Family Trusts, Partnerships, and Look-Through Companies (LTC).</li>
    <li><strong>Director Salary vs. Dividend Optimization:</strong> Balancing tax brackets, imputation credits, and shareholder drawing accounts.</li>
    <li><strong>Provisional Tax Cash Management:</strong> Strategic utilization of standard, estimation, or tax pooling methods (e.g. Tax Management NZ).</li>
    <li><strong>Statutory Revenue Audit Representation:</strong> Professional defense and liaison during Inland Revenue (IRD) or ATO inquiries.</li>
</ul>
<h4>Key Business Benefits:</h4>
<p>Legally minimize your statutory tax liability, protect business and family assets from commercial risk, and eliminate provisional tax surprises.</p>',
        'icon'              => 'fa-shield-alt',
        'starting_price'    => '299',
        'image'             => 'assets/images/service/01.jpg',
        'sort_order'        => 7,
    ],

    // ==========================================
    // TRACK 2: FOR ACCOUNTING FIRMS (branch: firm_outsourcing)
    // ==========================================
    [
        'title'             => 'White-Label Back-Office Bookkeeping Pods',
        'slug'              => 'bookkeeping-reconciliations',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Dedicated offshore production capacity built directly into your practice workflow under your brand.',
        'description'       => '<p class="lead">Expand your practice capacity without adding local headcount, payroll taxes, or office overhead. Our qualified accounting pods integrate directly into your practice systems, processing high-volume routine bookkeeping following your firm\'s custom SOPs.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>Dedicated Named Offshore Pod:</strong> Consistent senior bookkeepers trained on your practice templates, naming conventions, and software stack.</li>
    <li><strong>Direct Work in Practice Cloud:</strong> Work conducted directly inside your firm\'s Xero HQ, MYOB Practice Manager, or QBO accountant portal.</li>
    <li><strong>Routine Processing &amp; Bank Feeds:</strong> Daily/weekly transaction coding, AP/AR processing, and bank statement clearing.</li>
    <li><strong>Zero Client Contact Guarantee:</strong> 100% white-label service under a strict mutual NDA—we never communicate with your clients directly.</li>
    <li><strong>Structured Query Management:</strong> Clean spreadsheet handover detailing missing invoices and items requiring your firm\'s advice.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Free your onshore senior accountants from low-margin data entry, improve practice gross margins by 40-50%, and accept more business clients with complete confidence.</p>',
        'icon'              => 'fa-handshake',
        'starting_price'    => '15/hr',
        'image'             => 'assets/images/service/04.jpg',
        'sort_order'        => 8,
    ],
    [
        'title'             => 'Audit-Ready Year-End Working Paper Production',
        'slug'              => 'year-end-workpapers',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Fully indexed working paper files prepared to CA ANZ standards, ready for rapid 10-minute partner sign-off.',
        'description'       => '<p class="lead">Eliminate the grueling March/April and June busy-season bottlenecks. Our specialized year-end production team delivers meticulously indexed, hyperlinked working paper files built to CA ANZ standards, ready for a rapid partner review.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>Standardized Workpaper Indexing:</strong> Structured lead schedules, trial balance reconciliations, and hyperlinked source documents.</li>
    <li><strong>Depreciation &amp; Fixed Asset Schedules:</strong> Tax vs. accounting depreciation, asset additions, write-offs, and motor vehicle adjustments.</li>
    <li><strong>Draft Compilation Accounts:</strong> Draft Balance Sheet, Profit &amp; Loss, and statutory Notes to Accounts prepared to GAAP standards.</li>
    <li><strong>Review Query Sheet &amp; Proposed Journals:</strong> Transparent summary of proposed year-end journals, accruals, prepayments, and open partner queries.</li>
    <li><strong>Compatibility with Practice Workpapers:</strong> Full integration with CCH iFirm, Workpapers.com, Karbon, and custom Excel workpaper suites.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Turn a 3-hour file compilation job into a 15-minute partner review, clear client workpaper backlogs weeks ahead of deadlines, and end seasonal burnout across your team.</p>',
        'icon'              => 'fa-file-signature',
        'starting_price'    => '18/hr',
        'image'             => 'assets/images/service/01.jpg',
        'sort_order'        => 9,
    ],
    [
        'title'             => 'Tax Return & GST Preparation Assistance',
        'slug'              => 'tax-gst-preparation',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Draft tax returns, supporting schedules, and calculations ready for your firm\'s partner sign-off.',
        'description'       => '<p class="lead">Scale your firm\'s tax compliance volume without the cost and risk of hiring seasonal local contractors. Our tax preparation specialists draft company, trust, partnership, and individual returns backed by verifiable working paper reconciliations.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>Company &amp; Trust Income Tax Returns:</strong> Draft IR4 / IR7 (NZ) or Company/Trust Returns (AU) with taxable income adjustments.</li>
    <li><strong>Individual Tax Return Preparation:</strong> Draft IR3 / Individual returns covering rental properties, dividend imputation, and foreign income.</li>
    <li><strong>GST &amp; BAS Preparation Workpapers:</strong> Cross-checks reconciling annual sales in the draft accounts with lodged GST/BAS returns.</li>
    <li><strong>Tax Summary Client Deliverables:</strong> Prepared tax payment schedules and tax summary letters for your firm to send to your clients.</li>
    <li><strong>Partner Review Control:</strong> We never file directly—all final positions, lodgements, and technical judgments remain with your authorized partner.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Lower your production cost per tax return by over 45%, accelerate turnaround times for client lodgements, and maintain 100% compliance quality.</p>',
        'icon'              => 'fa-percentage',
        'starting_price'    => '18/hr',
        'image'             => 'assets/images/service/02.jpg',
        'sort_order'        => 10,
    ],
    [
        'title'             => 'Practice Payroll Processing & Payday Filing Support',
        'slug'              => 'payroll-support',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'White-label pay run preparation, leave liability calculations, and draft Payday Filing / STP lodgements.',
        'description'       => '<p class="lead">Provide a comprehensive payroll bureau service to your accounting clients without tying up your staff in repetitive pay run calculations. We prepare employee pay cycles, reconcile statutory deductions, and compile draft Payday Filing batches for partner sign-off.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>End-to-End Pay Run Preparation:</strong> Processing pay across Xero Payroll, MYOB PayGlobal, Smartly, or Employment Hero.</li>
    <li><strong>Leave Entitlement &amp; Accrual Reconciliations:</strong> Verification of statutory leave liabilities under the Holidays Act and employment agreements.</li>
    <li><strong>Statutory Deduction Reconciliations:</strong> Tracking PAYE, KiwiSaver, Superannuation guarantee, student loans, and court deductions.</li>
    <li><strong>Bank Batch File (ABA) Preparation:</strong> Generating secure ABA or bank payment files ready for client authorization.</li>
    <li><strong>Segregation of Duties:</strong> We prepare all calculations and reports but never hold authority to release funds from client bank accounts.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Turn client payroll into a reliable, recurring monthly revenue stream with zero operational headache and zero staffing dependencies.</p>',
        'icon'              => 'fa-user-check',
        'starting_price'    => '15/hr',
        'image'             => 'assets/images/service/03.jpg',
        'sort_order'        => 11,
    ],
    [
        'title'             => 'Emergency Client Cleanup & Catch-Up Projects',
        'slug'              => 'catch-up-projects',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Tackle messy client onboarding files and multi-year bookkeeping backlogs on a fixed-fee or hourly project basis.',
        'description'       => '<p class="lead">Onboarding new practice clients often comes with months of messy, neglected bookkeeping that paralyzes your team\'s workflow. Hand over messy onboarding files or neglected client ledgers to our dedicated catch-up pod on a project basis.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>Diagnostic Health Check:</strong> Rapid triage report identifying missing bank statements, unlinked feeds, and historical GST discrepancies.</li>
    <li><strong>Multi-Year Ledger Recreation:</strong> Bulk data extraction, feed reconstruction, and historical ledger reconciliations.</li>
    <li><strong>Historical GST / BAS Recalibration:</strong> Identifying previously overpaid or underreported tax and preparing amendment schedules.</li>
    <li><strong>Staged Milestone Handover:</strong> Structured delivery milestones with weekly progress calls so your firm stays in complete control.</li>
    <li><strong>Clean Trial Balance Handover:</strong> A pristine starting position ready for your ongoing annual accounts or compliance work.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Quote new practice clients with total confidence, convert messy prospective clients without stressing internal staff, and eliminate backlog delays.</p>',
        'icon'              => 'fa-tools',
        'starting_price'    => 'Project',
        'image'             => 'assets/images/service/04.jpg',
        'sort_order'        => 12,
    ],
    [
        'title'             => 'Executive Reporting & Virtual CFO Advisory Packs',
        'slug'              => 'management-reporting',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Board-ready monthly management reports, Fathom / Spotlight dashboards, and variance commentary for partner client meetings.',
        'description'       => '<p class="lead">Elevate your practice from traditional compliance into high-value Virtual CFO and business advisory services. We handle the data extraction, consolidation, and dashboard formatting so your partners can walk into client meetings with polished presentation packs.</p>
<h4>What We Deliver to Your Practice:</h4>
<ul>
    <li><strong>Multi-Entity Consolidation Reports:</strong> Formatted monthly and quarterly management reports across group structures.</li>
    <li><strong>Advisory Dashboard Configuration:</strong> Beautiful visual KPI dashboards in Spotlight Reporting, Fathom, or Xero Analytics.</li>
    <li><strong>Budget vs. Actual Variance Analysis:</strong> Automated calculation of key financial ratios, working capital trends, and budget variances.</li>
    <li><strong>Custom Practice Branding:</strong> Fully white-labeled report packs prepared with your firm\'s logo, color palette, and cover templates.</li>
    <li><strong>Overnight Delivery:</strong> Send source data in the evening and receive presentation-ready management packs the next morning.</li>
</ul>
<h4>Key Practice Benefits:</h4>
<p>Unlock lucrative monthly recurring advisory fees ($1,500 - $3,500/client) without spending partner hours crunching spreadsheets and formatting graphs.</p>',
        'icon'              => 'fa-briefcase',
        'starting_price'    => '20/hr',
        'image'             => 'assets/images/service/01.jpg',
        'sort_order'        => 13,
    ],
];

// Truncate and re-seed
$pdo->exec('TRUNCATE TABLE services');

$stmt = $pdo->prepare('INSERT INTO services (title, slug, branch, short_description, description, icon, starting_price, image, sort_order) 
VALUES (:title, :slug, :branch, :short_description, :description, :icon, :starting_price, :image, :sort_order)');

foreach ($services as $s) {
    $stmt->execute($s);
}

echo "Successfully re-seeded " . count($services) . " upgraded services with rich descriptions!\n";
