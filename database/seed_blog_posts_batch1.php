<?php
/**
 * Seeds 6 get-accountant branded blog posts (topics inspired by common
 * accounting/bookkeeping outsourcing themes, written fresh for NZ/AU
 * businesses and accounting firms — not copied from any third party).
 *
 * Run:
 *   php database/seed_blog_posts_batch1.php
 */
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) {
    die("Database not connected.\n");
}

$imgBase = 'assets/images/blog/posts/';

$posts = [
    [
        'title'   => 'Books Clean-Up for Tax Season: A Checklist for Accounting Firms',
        'slug'    => 'books-clean-up-for-tax-season',
        'excerpt' => 'A practical checklist accounting firms can use to clean up client books before tax season starts, so the tax team isn\'t starting from messy records.',
        'image'   => $imgBase . 'books-clean-up-for-tax-season.jpg',
        'content' => '
<p>Every tax season, accounting firms lose hours untangling client files that should have been clean months earlier. A proper books clean-up before filing season starts means your tax preparers begin with reliable numbers instead of guesswork.</p>

<h2>Why Clean-Up Matters</h2>
<p>A trial balance that technically balances doesn\'t mean the underlying records are correct. Duplicate transactions, unreconciled accounts and miscategorised expenses can all hide inside a "balanced" file. Clean-up catches these before they turn into rushed corrections during peak season.</p>

<h2>The Clean-Up Checklist</h2>
<ul>
<li><strong>Gather and organise records</strong> — bank statements, invoices, receipts and prior-period workpapers in one place.</li>
<li><strong>Reconcile every account</strong> — bank, credit card and loan accounts against statements, not just the ledger.</li>
<li><strong>Review categorisation</strong> — check that recurring suppliers and customers are coded consistently.</li>
<li><strong>Chase receivables and payables</strong> — confirm outstanding invoices and bills are still accurate.</li>
<li><strong>Check payroll and tax liabilities</strong> — make sure PAYE/GST (or payroll tax) balances match filed returns.</li>
<li><strong>Review loans and fixed assets</strong> — confirm depreciation schedules and loan splits between principal and interest.</li>
<li><strong>Clear suspense accounts</strong> — nothing should sit unexplained in a holding account by filing time.</li>
<li><strong>Do a final balance-sheet sanity check</strong> before handing files to the tax team.</li>
</ul>

<img src="' . $imgBase . 'inline-bookkeeping-checklist.jpg" alt="Bookkeeping checklist review">

<h2>Common Mistakes We See</h2>
<p>Personal expenses mixed into business accounts, missing supplier invoices, stale opening balances carried over year after year, and loan repayments posted as a single expense instead of being split into principal and interest — these are the issues that turn a one-day review into a week-long cleanup.</p>

<h2>When to Bring in Outside Help</h2>
<p>If your firm is facing a backlog, onboarding a client with years of messy records, or simply hitting capacity during peak season, outsourced bookkeeping support can clear the backlog without pulling your senior staff off review work. The scope, access and confidentiality terms should always be agreed before any file changes hands.</p>

<h2>How get-accountant Helps</h2>
<p>We work behind the scenes for accounting firms and businesses across New Zealand and Australia, handling reconciliations, categorisation and file clean-up so your team can focus on review and advisory work — not data entry.</p>
',
    ],
    [
        'title'   => 'Securing Agricultural Financing in New Zealand: What Lenders Actually Look For',
        'slug'    => 'agricultural-financing-nz',
        'excerpt' => 'A practical guide for New Zealand farm owners preparing to approach a lender for land, machinery or working capital finance.',
        'image'   => $imgBase . 'agricultural-financing-nz.jpg',
        'content' => '
<p>Farming income is seasonal and costs rarely are. That mismatch is exactly what lenders scrutinise when a farm applies for finance — and it\'s why preparation matters more than the size of the request.</p>

<h2>1. Know Exactly What You\'re Financing</h2>
<p>Land, livestock, machinery, irrigation or working capital each carry a different loan structure. Get real quotes, include installation and transport costs, and match the repayment term to how long the asset will actually generate returns.</p>

<h2>2. Understand Your Current Financial Position</h2>
<p>Lenders will look past the profit figure to actual cash timing — outstanding invoices, upcoming supplier payments, tax due and drawings. A profitable farm can still fail a serviceability test if cash isn\'t available when repayments fall due.</p>

<h2>3. Build a Cash-Flow Forecast, Not Just a Budget</h2>
<p>A seasonal or monthly forecast that includes irregular costs — repairs, insurance, tax — shows a lender (and you) exactly where funding gaps appear before harvest income arrives.</p>

<h2>4. Compare More Than the Interest Rate</h2>
<p>Farm mortgages, machinery finance, overdrafts and livestock finance all carry different fees, security requirements and repayment flexibility. The cheapest headline rate isn\'t always the best fit for a seasonal income pattern.</p>

<h2>5. Get Your Documentation Lender-Ready</h2>
<p>Profit and loss statements, a balance sheet, cash-flow forecasts, tax records, and asset and debt summaries should all be current and consistent with each other. Be ready to explain any gap between forecast and actual results from prior years.</p>

<img src="' . $imgBase . 'inline-farm-cashflow.jpg" alt="Farm cash flow and planting season">

<h2>6. Stress-Test the Plan</h2>
<p>What happens if commodity prices drop, a drought hits, or interest rates rise? A credible application shows the lender you\'ve already thought about the downside — not just the upside.</p>

<h2>Where Good Accounting Fits In</h2>
<p>Clean, reconciled books with properly separated farm and personal spending make every step above faster and more credible. get-accountant supports rural and agribusiness clients across New Zealand with bookkeeping, reporting and cash-flow forecasting that stands up to lender scrutiny — though no accountant can guarantee loan approval or terms.</p>
',
    ],
    [
        'title'   => 'Bookkeeping for Real Estate Investors: 9 Practices for Better Financial Control',
        'slug'    => 'bookkeeping-for-real-estate-investors',
        'excerpt' => 'Nine bookkeeping practices that give property investors a clear, property-level view of performance as a portfolio grows.',
        'image'   => $imgBase . 'bookkeeping-for-real-estate-investors.jpg',
        'content' => '
<p>A single rental property is forgiving. A portfolio of five, ten or twenty is not — and the bookkeeping habits that worked for one property quickly break down once income and costs need to be tracked across several.</p>

<h2>1. Separate Personal and Property Finances</h2>
<p>Use dedicated accounts for property income and expenses, and record owner contributions and withdrawals as exactly that — not as miscellaneous income or expense.</p>

<h2>2. Track Costs by Property, Not Just by Portfolio</h2>
<p>A portfolio-wide total can hide a single underperforming property. Code every transaction to a specific property so problems surface early.</p>

<h2>3. Use a Chart of Accounts Built for Property</h2>
<p>Categories should be consistent and useful without becoming unmanageable — rent, maintenance, rates, insurance, mortgage interest and management fees, tracked the same way every month.</p>

<h2>4. Document Repairs and Improvements Clearly</h2>
<p>Keep invoices and a short description of the work for every repair or improvement — the tax treatment can differ significantly between the two, and your accountant will need the detail to get it right.</p>

<h2>5. Reconcile Monthly, Not Annually</h2>
<p>Check bank and loan records against your books every month, and split mortgage payments into principal and interest at the time of entry — not retroactively at year-end.</p>

<img src="' . $imgBase . 'inline-real-estate-ledger.jpg" alt="Property ledger and keys">

<h2>6. Handle Deposits and Loans Carefully</h2>
<p>Security deposits aren\'t income and shouldn\'t be recorded as such. Purchase, sale and refinance transactions should be broken into their component parts rather than posted as a single lump sum.</p>

<h2>7. Review Property-Level Reports, Not Just the Total</h2>
<p>A profit-and-loss report per property — compared against rent roll or management statements for larger portfolios — catches discrepancies that a combined report never will.</p>

<h2>8. Choose Software That Scales With You</h2>
<p>Check that your accounting software properly separates multiple properties, supports the reporting you need, and allows the right level of access for property managers, bookkeepers and your accountant.</p>

<h2>9. Know When to Bring in Support</h2>
<p>If reconciliations are falling behind, categorisation is inconsistent, or reports take too long to produce, that\'s the signal to bring in dedicated bookkeeping support rather than letting the backlog grow.</p>

<h2>How get-accountant Can Help</h2>
<p>Our end-to-end bookkeeping service covers transaction recording, reconciliations, accounts payable/receivable and month-end reporting for property investors across New Zealand and Australia — scoped to however many properties you hold today, and built to grow with you.</p>
',
    ],
    [
        'title'   => 'Outsourcing Tax Preparation: A Practical Guide for Growing Accounting Firms',
        'slug'    => 'outsourcing-tax-preparation-guide',
        'excerpt' => 'How accounting firms can outsource tax preparation workload without losing control of client relationships, review or final sign-off.',
        'image'   => $imgBase . 'outsourcing-tax-preparation.jpg',
        'content' => '
<p>When tax volume outgrows a firm\'s available preparation capacity, senior staff end up doing data entry instead of review and client work. Outsourcing a defined slice of preparation work — not the client relationship, not the final sign-off — is how growing firms solve this without losing control.</p>

<h2>What Outsourcing Actually Means</h2>
<p>It means handing off agreed preparation tasks to an external team that works inside your existing review process. It does not have to include client conversations, technical judgement calls, or final approval — those stay with the firm.</p>

<h2>What Can Be Outsourced</h2>
<ul>
<li>Organising source documents and preparing workpapers</li>
<li>Data entry and preparation-stage reconciliations</li>
<li>Drafting agreed return types ahead of review</li>
<li>Flagging missing information for the preparer to chase</li>
</ul>

<h2>What Always Stays With the Firm</h2>
<p>Final professional review, complex or material tax positions, client advice, and sign-off. A clear escalation path for judgement calls is non-negotiable.</p>

<h2>How to Roll It Out</h2>
<ol>
<li><strong>Define scope</strong> — volume, deadlines, responsibilities and escalation triggers.</li>
<li><strong>Set the workflow</strong> — how files move, how questions get routed, how progress is tracked.</li>
<li><strong>Align on standards</strong> — checklists, workpaper formats, naming conventions.</li>
<li><strong>Start small</strong> — test with a limited batch of files before expanding scope.</li>
<li><strong>Review and refine</strong> — every file still goes through your normal review; use early feedback to tighten instructions.</li>
</ol>

<img src="' . $imgBase . 'inline-team-review.jpg" alt="Team reviewing tax preparation files">

<h2>Data Security Comes First</h2>
<p>Before any client data is shared, confirm how it\'s accessed, transferred, stored and eventually deleted, and what protections apply if a provider operates offshore. These checks matter as much as price when choosing a partner.</p>

<h2>Where get-accountant Fits</h2>
<p>We work as an extension of your firm\'s existing process — not a replacement for it — handling agreed preparation tasks for accounting firms in New Zealand and Australia while you keep the client relationship and final review exactly where it belongs.</p>
',
    ],
    [
        'title'   => 'AI in Client Accounting Services: What It Can (and Can\'t) Automate',
        'slug'    => 'ai-in-client-accounting-services',
        'excerpt' => 'Where AI genuinely helps client accounting services teams — and where professional judgement still has to do the work.',
        'image'   => $imgBase . 'ai-in-client-accounting-services.jpg',
        'content' => '
<p>As a firm\'s client accounting workload grows, so does the volume of repetitive transaction processing, reconciliations and reporting behind it. AI can take a real bite out of that routine work — but it changes where your team spends time, it doesn\'t remove the need for them.</p>

<h2>What AI Actually Does Here</h2>
<p>Traditional automation follows fixed rules. AI handles variability better — recognising transaction patterns, extracting data from invoices, suggesting categorisation, and flagging anything that doesn\'t fit the pattern. The flag is where the useful part ends; deciding why something is unusual still needs a person.</p>

<h2>Where It Genuinely Helps</h2>
<ul>
<li><strong>Transaction processing</strong> — suggesting categories for recurring suppliers and customers, extracting invoice data automatically.</li>
<li><strong>Reconciliations</strong> — auto-matching routine items so staff focus on unmatched entries and unusual balances.</li>
<li><strong>Accounts payable/receivable</strong> — automating invoice capture, approval routing and reminders.</li>
<li><strong>Month-end close</strong> — tracking outstanding tasks so bottlenecks are visible early.</li>
<li><strong>Reporting</strong> — surfacing trends and deviations, like a sudden margin drop, for a human to investigate.</li>
</ul>

<h2>Where It Doesn\'t Replace Judgement</h2>
<p>Complex treatments, material adjustments, client-specific advice and final review all need a professional who understands the client\'s context — something no AI output can supply on its own. Firms should explicitly decide which items a system can process automatically and which must go to a reviewer.</p>

<img src="' . $imgBase . 'inline-ai-dashboard.jpg" alt="AI dashboard for accounting automation">

<h2>Rolling It Out Without Breaking Things</h2>
<p>Start with one time-consuming process rather than automating everything at once. Document how that process works today — automation exposes a bad process rather than fixing it. Define who reviews exceptions and how decisions get traced back.</p>

<h2>The Bottom Line</h2>
<p>The right question isn\'t how far AI can go — it\'s which tasks your team should still be doing by hand. Removing the repetitive work frees accountants to investigate the unusual, review the numbers that matter, and actually advise clients.</p>

<h2>How get-accountant Fits In</h2>
<p>We combine sensible automation with outsourced bookkeeping and reporting support, so growing firms can scale client accounting services without adding headcount for every incremental client.</p>
',
    ],
    [
        'title'   => 'How to Prepare Your Taxes: A Step-by-Step Guide',
        'slug'    => 'how-to-prepare-taxes-guide',
        'excerpt' => 'A practical, step-by-step walkthrough of tax preparation — from gathering documents to knowing when it\'s time to bring in a professional.',
        'image'   => $imgBase . 'how-to-prepare-taxes.jpg',
        'content' => '
<p>Most tax season stress comes from poor organisation, not complicated tax law. Here\'s the process broken down into steps that work whether you\'re an employee, a contractor, or running a small business.</p>

<h2>Documents to Gather First</h2>
<ul>
<li>Income statements/payment summaries from every employer</li>
<li>Records for freelance, contract or platform-based income</li>
<li>Investment transaction records — actual buy/sell logs, not just summaries</li>
<li>Mortgage interest statements and donation receipts, if you\'re claiming deductions</li>
<li>Last year\'s return, for spotting recurring items</li>
<li>Business or rental income and expense records, kept separate from personal finances</li>
</ul>

<h2>The Step-by-Step Process</h2>
<ol>
<li><strong>Gather everything before you start.</strong> Missing documents are the single biggest cause of guessed numbers and later corrections.</li>
<li><strong>Confirm your filing status and entity structure</strong> — this affects what you can claim and how.</li>
<li><strong>Count all income</strong>, including cash work, interest, dividends and any crypto activity. Cross-check bank deposits against what you\'ve recorded.</li>
<li><strong>Separate deductions from offsets/credits</strong> — deductions reduce taxable income, credits or offsets reduce the tax bill directly, and eligibility is specific to your situation.</li>
<li><strong>Check what you\'ve already paid</strong> against what you actually owe — a large refund usually means you overpaid through the year.</li>
<li><strong>Double-check every detail</strong> — a wrong bank account number or ID detail is the most common cause of delayed refunds.</li>
<li><strong>File and keep your records</strong> — electronic filing is faster and reduces errors, and records should be kept in case of a later query or amendment.</li>
</ol>

<img src="' . $imgBase . 'inline-tax-forms.jpg" alt="Tax forms and calculator">

<h2>Guidance by Situation</h2>
<p><strong>Employees</strong> with one income source usually have the simplest filing. <strong>Contractors and freelancers</strong> need to track expenses through the year and plan for provisional/estimated tax. <strong>Small business owners</strong> should keep business and personal accounts strictly separate. <strong>Landlords</strong> need to track maintenance, rates and depreciation carefully. <strong>Anyone with multiple income streams</strong> should list every source before starting.</p>

<h2>When to Bring in a Professional</h2>
<p>A single, straightforward income source is usually fine with basic software. Self-employment income, rental properties, investment portfolios, a major life change, or a confusing notice from the tax office are all good reasons to get a professional involved before you file, not after.</p>

<h2>How get-accountant Can Help</h2>
<p>Whether you need your books in order before filing or want an accountant to handle preparation end-to-end, our team supports individuals and small businesses across New Zealand and Australia through tax season — without the last-minute scramble.</p>
',
    ],
];

$stmt = $pdo->prepare(
    "INSERT INTO blog_posts (title, slug, excerpt, content, image, author, status, created_at)
     VALUES (:title, :slug, :excerpt, :content, :image, 'get-accountant', 'published', NOW())
     ON DUPLICATE KEY UPDATE title = VALUES(title), excerpt = VALUES(excerpt), content = VALUES(content), image = VALUES(image)"
);

foreach ($posts as $i => $p) {
    $stmt->execute([
        'title'   => $p['title'],
        'slug'    => $p['slug'],
        'excerpt' => $p['excerpt'],
        'content' => $p['content'],
        'image'   => $p['image'],
    ]);
    echo "Seeded: {$p['title']}\n";
}

echo "Done. " . count($posts) . " posts seeded.\n";
