<?php
/**
 * Database update script for get-accountant
 * Populates international-grade accounting & bookkeeping services,
 * accounting firm outsourcing services, FAQs, testimonials, and site settings.
 */

require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) {
    die("Database connection failed.\n");
}

echo "Updating site_settings...\n";
$stmt = $pdo->prepare("UPDATE site_settings SET 
    company_name = 'get-accountant',
    tagline = 'People. Process. Possibility.™',
    email = 'info@get-accountant.com',
    phone = '+64 9 801 0123',
    address = '188 Quay Street, Auckland CBD, Auckland 1010, New Zealand',
    working_hours = 'Mon - Fri: 8:30am - 5:30pm NZDT',
    copyright_text = 'get-accountant. All rights reserved. People. Process. Possibility.™'
    WHERE id = 1");
$stmt->execute();

echo "Updating services table...\n";
// Clear older placeholder services
$pdo->exec("DELETE FROM services");

$services = [
    // ---------------- BOOKKEEPING BRANCH (NZ Small & Medium Businesses) ----------------
    [
        'title'             => 'Bookkeeping & Bank Reconciliation',
        'slug'              => 'bookkeeping-bank-reconciliation',
        'branch'            => 'bookkeeping',
        'short_description' => 'Daily and weekly bank reconciliation in Xero or MYOB, keeping your financial records accurate, up-to-date and audit-ready.',
        'description'       => '<p>Accurate bookkeeping is the foundation of every successful business. At get-accountant, our certified New Zealand bookkeepers take care of your day-to-day transactions so you always know where your business stands without spending evenings sorting through receipts.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>Daily & Weekly Bank Feeds:</strong> Automatic matching and coding of all bank, credit card and loan transactions in Xero or MYOB.</li>
    <li><strong>Invoice & Receipt Matching:</strong> Digital receipt capture via Dext or Hubdoc, matching receipts directly to bank line items.</li>
    <li><strong>Ledger & Suspense Cleanup:</strong> Regular auditing of accounts to ensure zero unclassified transactions or balance discrepancies.</li>
    <li><strong>Multi-Currency Reconciliations:</strong> Precise FX gain/loss adjustments for international transactions and overseas suppliers.</li>
    <li><strong>Monthly Balance Sheet Substantiation:</strong> Verification that your bank balance in Xero perfectly matches your actual bank statement.</li>
</ul>
<h4>How We Deliver:</h4>
<p>We connect directly to your existing cloud accounting software (Xero, MYOB, or QuickBooks). Our team follows standard operating procedures tailored to your industry, ensuring consistent coding and prompt resolution of queries before every month-end.</p>',
        'icon'              => '01',
        'image'             => 'assets/images/service/01.jpg',
        'sort_order'        => 1,
    ],
    [
        'title'             => 'GST Returns & IRD Compliance',
        'slug'              => 'gst-returns-ird-filing',
        'branch'            => 'bookkeeping',
        'short_description' => 'Accurate preparation, reconciliation and on-time filing of your 2-monthly or 6-monthly GST returns with Inland Revenue (IRD).',
        'description'       => '<p>Avoid late filing penalties, interest charges, and IRD audit triggers. We reconcile your sales and purchase records, compute your net GST position under invoice or payments basis, and file your return directly with Inland Revenue on your behalf.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>GST Reconciliation:</strong> Detailed reconciliation of GST collected vs. GST paid against your general ledger before filing.</li>
    <li><strong>Input Tax Credit Verification:</strong> Ensuring valid tax invoices are on record for all expense claims to protect against IRD clawbacks.</li>
    <li><strong>Basis Optimization:</strong> Review of whether invoice basis, payments basis or hybrid basis is most advantageous for your cash flow.</li>
    <li><strong>Direct myIR Electronic Filing:</strong> Seamless electronic submission to Inland Revenue ahead of official due dates.</li>
    <li><strong>Payment Reminders & Advice:</strong> Clear advice on exact GST payable amounts, due dates, and payment reference codes.</li>
</ul>
<h4>Why Timely GST Matters:</h4>
<p>Inland Revenue strictly enforces filing deadlines. Our proactive timetable guarantees your GST is compiled and reviewed two weeks before the IRD due date, giving you ample time to inspect and approve.</p>',
        'icon'              => '02',
        'image'             => 'assets/images/service/02.jpg',
        'sort_order'        => 2,
    ],
    [
        'title'             => 'Payroll, PAYE & KiwiSaver',
        'slug'              => 'payroll-paye-kiwisaver',
        'branch'            => 'bookkeeping',
        'short_description' => 'End-to-end payroll processing with automated payday filing, KiwiSaver deductions, holiday pay calculations and NZ Holidays Act compliance.',
        'description'       => '<p>New Zealand payroll legislation is notoriously complex, especially around the Holidays Act 2003. get-accountant delivers complete, error-free payroll services so your staff are paid accurately on time, and all IRD obligations are satisfied automatically.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>Wages & Salary Processing:</strong> Weekly, fortnightly or monthly payroll runs for salaried and hourly team members.</li>
    <li><strong>IRD Payday Filing:</strong> Automated submission of employment information to Inland Revenue within 2 working days of each payday.</li>
    <li><strong>KiwiSaver & ESCT:</strong> Precise deduction of employee contributions, employer contributions, and Employer Superannuation Contribution Tax (ESCT).</li>
    <li><strong>Leave Management:</strong> Accurate tracking of annual leave, sick leave, bereavement leave, and alternative holidays with correct 8% or average weekly earnings formulas.</li>
    <li><strong>Direct Staff Payslips:</strong> Automated, secure distribution of digital payslips to your employees upon payroll finalization.</li>
</ul>
<h4>Peace of Mind Compliance:</h4>
<p>We work with leading NZ payroll platforms including Xero Payroll, PaySauce, and iPayroll to ensure 100% compliance with Employment New Zealand standards.</p>',
        'icon'              => '03',
        'image'             => 'assets/images/service/03.jpg',
        'sort_order'        => 3,
    ],
    [
        'title'             => 'Annual Accounts & Tax Returns',
        'slug'              => 'annual-financial-statements',
        'branch'            => 'bookkeeping',
        'short_description' => 'Preparation of annual Profit & Loss, Balance Sheet, fixed asset depreciation schedules, and IR4/IR3 income tax returns.',
        'description'       => '<p>Your year-end financials should do more than satisfy the tax department — they should give you clear insights into profitability, working capital, and asset performance. We prepare full financial statements in compliance with New Zealand GAAP.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>Special Purpose Financial Statements:</strong> Professionally structured Balance Sheet, Statement of Profit or Loss, and Notes to Accounts.</li>
    <li><strong>Fixed Asset Register & Depreciation:</strong> Maintenance of depreciation schedules according to current IRD depreciation rates.</li>
    <li><strong>Shareholder Current Account Reconciliation:</strong> Tracking drawings, advances, and ensuring interest-free loan rules are adhered to.</li>
    <li><strong>Company Tax Return (IR4) & Individual (IR3):</strong> Complete tax calculation, tax credit utilization, and electronic submission.</li>
    <li><strong>Provisional Tax Calculations:</strong> Guidance on standard vs. estimation options to manage provisional tax payments throughout the year.</li>
</ul>
<h4>Strategic Year-End Review:</h4>
<p>Each set of annual accounts includes an executive summary explaining key performance indicators and tax optimization strategies for the upcoming financial year.</p>',
        'icon'              => '04',
        'image'             => 'assets/images/service/04.jpg',
        'sort_order'        => 4,
    ],
    [
        'title'             => 'Cash Flow Forecasting & Management Reporting',
        'slug'              => 'cash-flow-management-reporting',
        'branch'            => 'bookkeeping',
        'short_description' => 'Monthly financial dashboards, KPI scorecards, budget variance tracking and 12-month rolling cash flow forecasts for strategic growth.',
        'description'       => '<p>Do not wait until the end of the year to discover whether you made a profit. Our monthly management reporting gives you forward-looking clarity into cash reserves, customer profitability, and operational expense efficiency.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>Monthly Management Pack:</strong> Clean, executive-level reports delivered within 7 business days of month-end.</li>
    <li><strong>Rolling Cash Flow Forecast:</strong> Dynamic 13-week or 12-month projections highlighting cash surpluses or working capital requirements in advance.</li>
    <li><strong>Budget vs. Actual Variance Analysis:</strong> Clear breakdown of where revenue outpaced expectations or where costs drifted from budget.</li>
    <li><strong>Key Performance Indicators (KPIs):</strong> Custom scorecards tracking gross profit margins, debtor days (DSO), and breakeven thresholds.</li>
    <li><strong>Monthly Virtual Advisory Call:</strong> 30-minute monthly briefing with a senior accountant to review highlights and answer your questions.</li>
</ul>
<h4>Make Confident Decisions:</h4>
<p>Whether you are considering hiring staff, purchasing new equipment, or applying for bank financing, our forecasts provide the hard data lenders and investors demand.</p>',
        'icon'              => '05',
        'image'             => 'assets/images/service/07.jpg',
        'sort_order'        => 5,
    ],
    [
        'title'             => 'Xero & Cloud Accounting Advisory',
        'slug'              => 'xero-cloud-accounting-setup',
        'branch'            => 'bookkeeping',
        'short_description' => 'Certified Xero & MYOB setup, historical ledger cleanups, custom chart of accounts and integration with your CRM, POS and inventory apps.',
        'description'       => '<p>Harness the full power of modern cloud accounting. Whether you are starting a new company or migrating from messy spreadsheets, our certified Xero advisors configure your system for maximum automation and zero friction.</p>
<h4>What is Included in This Service:</h4>
<ul>
    <li><strong>Platform Setup & Migration:</strong> Flawless migration of historical data, open invoices, customer contacts and chart of accounts.</li>
    <li><strong>Automated Bank Feed Configuration:</strong> Secure connection of all New Zealand bank accounts (ANZ, ASB, BNZ, Westpac, Kiwibank).</li>
    <li><strong>App Ecosystem Integration:</strong> Connecting Xero to Dext Prepare, Shopify, Vend/Lightspeed, Stripe, Fergus, or Tradify.</li>
    <li><strong>Invoice Template Customization:</strong> Professional, branded invoice and statement templates with direct "Pay Now" links.</li>
    <li><strong>Staff Workflow Training:</strong> 1-on-1 virtual training sessions to empower your team on receipt capture, quoting and daily workflows.</li>
</ul>
<h4>Future-Proof Your Operations:</h4>
<p>Cloud accounting eliminates manual data entry, cuts invoice turnaround time by up to 50%, and allows you to view your numbers anytime, anywhere on your mobile device.</p>',
        'icon'              => '06',
        'image'             => 'assets/images/service/08.jpg',
        'sort_order'        => 6,
    ],

    // ---------------- FIRM OUTSOURCING BRANCH (NZ Accounting Practices) ----------------
    [
        'title'             => 'Accounts Payable (AP) Processing',
        'slug'              => 'accounts-payable-processing',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'End-to-end supplier invoice data capture, automated OCR coding, three-way matching, batch payment approval files and supplier reconciliations.',
        'description'       => '<p>Managing accounts payable across dozens of business clients is one of the most time-consuming bottlenecks for accounting practices. get-accountant becomes your dedicated back-office AP department, processing invoices strictly to your firm’s chart of accounts and quality standards.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Receipt & Invoice Ingestion:</strong> Processing client invoices via Dext, Hubdoc, or your practice inbox with OCR verification.</li>
    <li><strong>GL Coding & Job Allocation:</strong> Strict adherence to your firm’s custom chart of accounts, tracking categories, and job codes.</li>
    <li><strong>Three-Way Purchase Order Matching:</strong> Verifying supplier invoice details against approved POs and delivery dockets.</li>
    <li><strong>Batch Payment Preparation:</strong> Producing bank payment files (ABA/batch) ready in Xero or bank portal for partner or client release.</li>
    <li><strong>Monthly Supplier Statement Reconciliations:</strong> Proactive identification of missing bills, credit notes, or duplicate billings.</li>
</ul>
<h4>Quality Assurance:</h4>
<p>All work is reviewed by a designated senior accountant before being pushed to your client’s live ledger, ensuring zero disruption to your firm’s reputation.</p>',
        'icon'              => '01',
        'image'             => 'assets/images/service/10.jpg',
        'sort_order'        => 1,
    ],
    [
        'title'             => 'Accounts Receivable (AR) Management',
        'slug'              => 'accounts-receivable-management',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Sales invoice generation, payment allocation, customer ledger reconciliation and aged debtor tracking delivered seamlessly under your firm’s brand.',
        'description'       => '<p>Help your clients maintain healthy cash flow without burning your firm’s billable hours on debtor administration. We handle the complete receivable cycle, from recurring billing generation to bank receipt allocation.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Sales Invoicing & Dispatch:</strong> Drafting and issuing recurring or milestone sales invoices per client billing schedules.</li>
    <li><strong>Bank Remittance Processing:</strong> Daily reconciliation of incoming customer payments against open sales invoices in Xero.</li>
    <li><strong>Aged Debtor Analysis:</strong> Weekly or monthly aging reports highlighting overdue balances, unallocated credits, and bad debt risks.</li>
    <li><strong>Statement Generation:</strong> Automated distribution of monthly statements to overdue accounts with gentle payment reminders.</li>
    <li><strong>Dispute Flagging:</strong> Prompt logging and escalation of billing discrepancies directly to your firm’s client manager.</li>
</ul>
<h4>White-Label Confidentiality:</h4>
<p>All communications can be carried out using your firm’s branded domain (e.g. accounts@yourfirm.co.nz) or strictly as a silent back-office processor.</p>',
        'icon'              => '02',
        'image'             => 'assets/images/service/11.jpg',
        'sort_order'        => 2,
    ],
    [
        'title'             => 'White-Label Payroll & PAYE Outsourcing',
        'slug'              => 'firm-payroll-outsourcing',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Dedicated multi-client payroll production for accounting firms, including payday filing, KiwiSaver, leave tracking and IRD submissions.',
        'description'       => '<p>Payroll requires intense deadline discipline, constant legislative awareness, and carries high liability. By outsourcing your firm’s client payroll processing to get-accountant, your practice unlocks consistent recurring revenue without the operational headache.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Multi-Frequency Payroll Runs:</strong> Processing weekly, fortnightly, and monthly payroll batches across diverse industries.</li>
    <li><strong>NZ Holidays Act Compliance:</strong> Accurate calculation of relevant daily pay, ordinary weekly pay, and 8% gross earning entitlements.</li>
    <li><strong>Direct IRD Payday Filing:</strong> Automated submission of employment information to Inland Revenue within statutory timelines.</li>
    <li><strong>KiwiSaver & Superannuation Compliance:</strong> Management of auto-enrolment, opt-outs, contribution holidays, and ESCT calculations.</li>
    <li><strong>Payroll Audit & Gross-to-Net Reports:</strong> Comprehensive verification schedules delivered to your firm for final audit trail documentation.</li>
</ul>
<h4>Software Competency:</h4>
<p>Experienced across Xero Payroll, PaySauce, iPayroll, MYOB PayGlobal, and Employment Hero.</p>',
        'icon'              => '03',
        'image'             => 'assets/images/service/12.jpg',
        'sort_order'        => 3,
    ],
    [
        'title'             => 'GST Returns & Working Papers',
        'slug'              => 'firm-gst-workpapers',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Standardized GST working papers, general ledger reconciliations, anomaly reviews and draft IRD filings prepared ready for partner sign-off.',
        'description'       => '<p>Free your in-house seniors and managers from low-margin GST preparation. Our specialized compliance team reconciles your clients’ accounts, compiles standardized working papers, and drafts the GST return ready for your partner’s quick 5-minute review.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Full Bank & Ledger Reconciliation:</strong> Verifying all bank feeds, credit cards, and clearing accounts are reconciled to the GST period end.</li>
    <li><strong>Standardized Workpaper Files:</strong> Compilation of working papers showing the audit trail from general ledger to box-by-box return figures.</li>
    <li><strong>Exception & Anomaly Checking:</strong> Verification of GST-exempt items, zero-rated exports, entertainment limits, and private use adjustments.</li>
    <li><strong>Draft IRD Return Preparation:</strong> Preparation of the draft return in Xero Tax, XPM, or myIR ready for client authorization.</li>
    <li><strong>Query Summary:</strong> A clear, bulleted summary of any unusual transactions sent to your manager for swift client confirmation.</li>
</ul>
<h4>Turnaround Guarantee:</h4>
<p>Working papers completed and delivered 10 business days before the IRD filing cut-off, ensuring your firm never rushes at deadline.</p>',
        'icon'              => '04',
        'image'             => 'assets/images/service/13.jpg',
        'sort_order'        => 4,
    ],
    [
        'title'             => 'Periodic Management Accounts & Review',
        'slug'              => 'monthly-accounting-firms',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Monthly and quarterly management accounts, balance sheet substantiation, accruals, prepayments and variance commentary.',
        'description'       => '<p>Deliver premium virtual CFO and advisory services to your top business clients without hiring extra full-time staff. We handle the balance sheet reconciliation, accruals, prepayments, and draft management reporting packs on your schedule.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Month-End Balance Sheet Reconciliations:</strong> Complete substantiation of all balance sheet accounts with supporting schedules.</li>
    <li><strong>Accruals, Prepayments & Depreciation:</strong> Posting standard month-end adjusting journals according to your firm’s accounting policies.</li>
    <li><strong>Intercompany Ledger Reconciliation:</strong> Elimination entries and reconciliation of loan accounts across group entities.</li>
    <li><strong>Draft Management Pack Assembly:</strong> Executive summaries, Profit & Loss vs budget, Balance Sheet, and cash movement schedules.</li>
    <li><strong>Variance Commentary Draft:</strong> Initial analytical commentary highlighting major revenue or expenditure fluctuations for your review.</li>
</ul>
<h4>Scale Your Practice Margin:</h4>
<p>Outsourcing monthly accounting enables your firm to offer lucrative ongoing advisory packages to clients at double your traditional compliance margin.</p>',
        'icon'              => '05',
        'image'             => 'assets/images/service/14.jpg',
        'sort_order'        => 5,
    ],
    [
        'title'             => 'Year-End Compliance & Tax Workpapers',
        'slug'              => 'year-end-compliance-workpapers',
        'branch'            => 'firm_outsourcing',
        'short_description' => 'Complete trial balance cleanup, working paper files, fixed asset schedules and draft tax returns (IR4, IR7, IR3) ready for partner sign-off.',
        'description'       => '<p>Eliminate the annual tax season rush and end staff overtime burnout. get-accountant delivers complete, audit-ready year-end working paper files compiled strictly in accordance with CA ANZ standards, allowing partners to review and sign off in record time.</p>
<h4>Scope of Work for Accounting Firms:</h4>
<ul>
    <li><strong>Trial Balance Review & Adjustments:</strong> Identifying and resolving ledger errors, suspense balances, and prior-period adjustments.</li>
    <li><strong>Complete Lead Schedules:</strong> Standardized working papers for Cash, Receivables, Stock, Fixed Assets, Liabilities, and Equity.</li>
    <li><strong>Fixed Asset Register & Tax Depreciation:</strong> Reviewing capitalizations vs repairs, computing depreciation under IRD diminishing value or straight-line rates.</li>
    <li><strong>Shareholder & Intercompany Accounts:</strong> Calculation of deemed dividends, shareholder salaries, and interest considerations.</li>
    <li><strong>Draft Tax Returns & Computations:</strong> Fully prepared IR4 (companies), IR7 (partnerships), or IR3 (individuals) returns ready in your tax software.</li>
</ul>
<h4>Practice Compatibility:</h4>
<p>We work directly inside your practice suite — whether Xero Practice Manager (XPM), CCH iFirm, APS, or MYOB Practice.</p>',
        'icon'              => '06',
        'image'             => 'assets/images/service/15.jpg',
        'sort_order'        => 6,
    ],
];

$stmt = $pdo->prepare("INSERT INTO services (title, slug, branch, short_description, description, icon, image, sort_order) 
    VALUES (:title, :slug, :branch, :short_description, :description, :icon, :image, :sort_order)");

foreach ($services as $s) {
    $stmt->execute($s);
    echo "Inserted service: {$s['title']} ({$s['branch']})\n";
}

// ---------------- Update FAQs ----------------
echo "Updating faqs table...\n";
$pdo->exec("DELETE FROM faqs");

$faqs = [
    // Bookkeeping FAQs
    [
        'branch'     => 'bookkeeping',
        'question'   => 'How does get-accountant work with my existing software?',
        'answer'     => 'We connect directly to your existing cloud software (Xero, MYOB, or QuickBooks) as an invited advisor or user. You maintain 100% ownership and administrative control of your subscription at all times. There is no software to install or data to move.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'question'   => 'Do you handle Inland Revenue (IRD) compliance and filings?',
        'answer'     => 'Yes. We are registered New Zealand tax and bookkeeping agents. We prepare and file your GST returns, payday payroll filing, and annual income tax returns directly with Inland Revenue (IRD) via secure electronic integration.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'question'   => 'How quickly can you get my books up to date?',
        'answer'     => 'Most clients are onboarded within 3 to 5 business days. If you have historical backlog or un-reconciled months, our catch-up bookkeeping team can bring you fully up to date within 1 to 2 weeks depending on transaction volume.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'bookkeeping',
        'question'   => 'How do I send my receipts, invoices, and documents?',
        'answer'     => 'Simply snap a photo using the Dext or Hubdoc mobile app, email bills directly to your dedicated bookkeeping address, or drag and drop files into your secure client portal. Our team extracts the data automatically.',
        'sort_order' => 4,
    ],
    [
        'branch'     => 'bookkeeping',
        'question'   => 'Is there a long-term contract or lock-in period?',
        'answer'     => 'No. Our bookkeeping and accounting packages operate on a flexible month-to-month subscription. We earn your business every month through accurate numbers, proactive advice, and timely delivery.',
        'sort_order' => 5,
    ],

    // Accounting Firm Outsourcing FAQs
    [
        'branch'     => 'firm_outsourcing',
        'question'   => 'How do you safeguard client confidentiality and data privacy?',
        'answer'     => 'Client confidentiality is our cornerstone. We operate under strict mutual Non-Disclosure Agreements (NDAs) and full compliance with the New Zealand Privacy Act 2020. We connect through your firm’s approved VPN, practice management system, and never store unencrypted client files on local machines.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'question'   => 'Can get-accountant work under our accounting firm’s brand?',
        'answer'     => 'Absolutely. All deliverables, workpapers, email communications, and reports can be 100% white-labeled under your firm’s branding and email domain. Your clients only ever see your firm’s trusted identity.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'question'   => 'How does the review and sign-off process work?',
        'answer'     => 'We prepare the standardized working papers, trial balance reconciliations, and draft tax returns to 95% completion. Your in-house manager or partner simply performs the final 5-minute review and signs off on the filing, retaining complete professional control.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'question'   => 'What software and practice suites do you support?',
        'answer'     => 'Our team has deep experience across Xero Practice Manager (XPM), CCH iFirm, MYOB Practice, Dext Prepare, FYI Docs, Karbon, and IRD myIR portals. We adapt to your firm’s existing templates and standard operating procedures (SOPs).',
        'sort_order' => 4,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'question'   => 'Is there a guarantee against client poaching?',
        'answer'     => 'Yes. Every partnership contract includes a binding, enforceable non-compete and non-solicitation clause guaranteeing that we will never solicit, contract, or communicate directly with your clients for independent services.',
        'sort_order' => 5,
    ],
];

$stmt = $pdo->prepare("INSERT INTO faqs (branch, question, answer, sort_order) VALUES (:branch, :question, :answer, :sort_order)");
foreach ($faqs as $f) {
    $stmt->execute($f);
}

// ---------------- Update Testimonials ----------------
echo "Updating testimonials table...\n";
$pdo->exec("DELETE FROM testimonials");

$testimonials = [
    [
        'branch'      => 'bookkeeping',
        'client_name' => 'Callum Henderson',
        'client_role' => 'Managing Director, Apex Construction & Civil (Christchurch)',
        'photo'       => 'assets/images/testimonials/01.png',
        'quote'       => 'get-accountant transformed how we manage cash flow and subcontractor payroll across 4 active construction sites. Invoicing is done on time, GST is filed two weeks early, and I finally have total visibility over job profitability.',
        'rating'      => 5,
        'sort_order'  => 1,
    ],
    [
        'branch'      => 'bookkeeping',
        'client_name' => 'Jessica Ward',
        'client_role' => 'Founder & CEO, Lumina Retail Group (Auckland)',
        'photo'       => 'assets/images/testimonials/02.png',
        'quote'       => 'Running 3 retail stores meant I was drowning in point-of-sale reconciliations and supplier bills every weekend. The get-accountant team integrated Xero with our POS seamlessly. Their monthly reporting has been a game-changer.',
        'rating'      => 5,
        'sort_order'  => 2,
    ],
    [
        'branch'      => 'firm_outsourcing',
        'client_name' => 'Hamish Miller, CA',
        'client_role' => 'Senior Partner, Miller & Associates Chartered Accountants (Wellington)',
        'photo'       => 'assets/images/testimonials/03.png',
        'quote'       => 'Partnering with get-accountant solved our persistent staffing shortage. Their team handles all routine GST returns and annual working paper files with meticulous accuracy, allowing our partners to focus 100% on advisory.',
        'rating'      => 5,
        'sort_order'  => 1,
    ],
    [
        'branch'      => 'firm_outsourcing',
        'client_name' => 'Elena Vasquez',
        'client_role' => 'Principal, Summit Business Advisory (Tauranga)',
        'photo'       => 'assets/images/testimonials/01.png',
        'quote'       => 'The quality of working papers and turnaround speed exceeded our expectations. Our gross margin on compliance work increased by 42% in our very first quarter, and our team has stopped working overtime during tax season.',
        'rating'      => 5,
        'sort_order'  => 2,
    ],
];

$stmt = $pdo->prepare("INSERT INTO testimonials (branch, client_name, client_role, photo, quote, rating, sort_order) 
    VALUES (:branch, :client_name, :client_role, :photo, :quote, :rating, :sort_order)");
foreach ($testimonials as $t) {
    $stmt->execute($t);
}

echo "Database successfully updated with international-grade data!\n";
