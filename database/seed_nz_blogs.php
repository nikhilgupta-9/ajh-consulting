<?php
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) {
    die("Database connection failed\n");
}

$blogs = [
    [
        'title'   => 'Key IRD Tax Deadlines for New Zealand Businesses in 2026',
        'slug'    => 'key-ird-tax-deadlines-new-zealand-2026',
        'excerpt' => 'A comprehensive calendar of Inland Revenue filing dates including bi-monthly GST, payday filing, and provisional tax instalments for Kiwi businesses.',
        'content' => '<p>Staying compliant with Inland Revenue (IRD) in New Zealand requires disciplined calendar management. Missing statutory deadlines can result in non-deductible late filing penalties and use-of-money interest (UOMI) that erodes your operating margins.</p>
<h4>1. Goods and Services Tax (GST) Returns</h4>
<p>For businesses on a two-monthly filing frequency, standard GST returns and payments are due on the 28th day of the month following the end of the taxable period (with exceptions for December/January cycles):</p>
<ul>
    <li><strong>Period ending 31 January:</strong> Due 28 February</li>
    <li><strong>Period ending 31 March:</strong> Due 7 May</li>
    <li><strong>Period ending 31 May:</strong> Due 28 June</li>
    <li><strong>Period ending 31 July:</strong> Due 28 August</li>
    <li><strong>Period ending 30 September:</strong> Due 28 October</li>
    <li><strong>Period ending 30 November:</strong> Due 15 January</li>
</ul>
<h4>2. Payday Filing and PAYE</h4>
<p>Under IRD Payday Filing rules, employment information must be submitted within two working days of the payday (if filing electronically via Xero or MYOB). PAYE deductions and KiwiSaver employer contributions must be paid by the 20th of the following month for small-to-medium employers.</p>
<h4>3. Provisional Tax Instalments</h4>
<p>If your residual income tax exceeds $5,000, you are liable for provisional tax. Standard ratio or standard uplift instalments generally fall on:</p>
<ul>
    <li><strong>First Instalment (P1):</strong> 28 August</li>
    <li><strong>Second Instalment (P2):</strong> 15 January</li>
    <li><strong>Third Instalment (P3):</strong> 7 May</li>
</ul>
<p>At get-accountant, our automated compliance workflows ensure your reconciliations are finished well before deadline dates, avoiding stress and unnecessary penalties.</p>',
        'image'   => 'assets/images/blog/blog-lg-1.jpg',
        'author'  => 'get-accountant Tax Team',
        'status'  => 'published'
    ],
    [
        'title'   => 'Why NZ Accounting Firms Are Embracing White-Label Outsourcing in 2026',
        'slug'    => 'why-nz-accounting-firms-embrace-white-label-outsourcing',
        'excerpt' => 'How leading CA and CPA firms across Auckland, Wellington, and Christchurch scale gross margins and beat the domestic talent crisis through dedicated offshore teams.',
        'content' => '<p>The public practice accounting sector across New Zealand faces an acute talent shortage. Mid-tier and boutique CA firms struggle to recruit intermediate accountants, leading to partner burnout, client churn, and suppressed capacity during the March year-end crunch.</p>
<h4>The Cost and Capacity Bottleneck</h4>
<p>Recruiting a domestic intermediate accountant in Auckland or Wellington now routinely costs upwards of $85,000 &ndash; $105,000 plus KiwiSaver, ACC levies, recruitment agency fees, and hardware overheads. Even with budget allocated, hiring cycles take 3 to 6 months.</p>
<h4>How Outsourced Capacity Solves the Equation</h4>
<p>Forward-thinking practice partners are decoupling production compliance from client-facing advisory:</p>
<ul>
    <li><strong>Production Workpapers:</strong> Bank reconciliations, depreciation schedules, and tax computations prepared offshore under strict SOPs.</li>
    <li><strong>Partner Review:</strong> Domestic managers receive completed, cross-referenced workpaper packs ready for immediate sign-off.</li>
    <li><strong>40-60% Margin Expansion:</strong> Blended production costs drop significantly, allowing firms to take on high-margin clients without taking on long-term overhead.</li>
</ul>
<h4>Client Data Security & Sovereignty</h4>
<p>Operating under the New Zealand Privacy Act 2020, modern outsourcing partners like get-accountant utilize restricted remote sessions with zero local data storage, giving partners total peace of mind.</p>',
        'image'   => 'assets/images/blog/blog-lg-2.jpg',
        'author'  => 'get-accountant Practice Advisory',
        'status'  => 'published'
    ],
    [
        'title'   => 'Xero vs MYOB in New Zealand: The Definitive 2026 Comparison for Small Businesses',
        'slug'    => 'xero-vs-myob-new-zealand-2026-comparison',
        'excerpt' => 'Evaluating bank feeds, payroll compliance with the Holidays Act 2003, IRD integrations, and pricing between New Zealand’s two dominant cloud accounting platforms.',
        'content' => '<p>Choosing between Xero and MYOB is one of the most critical decisions a New Zealand business owner or practice principal makes. Both platforms offer mature cloud solutions, but subtle differences in payroll, reporting, and add-on ecosystems can determine your operational efficiency.</p>
<h4>1. Bank Feeds and Reconciliation</h4>
<p>Xero is famous for its intuitive bank rule engine and machine learning suggestion workflow. For high-volume transaction businesses like e-commerce and retail, Xero handles automated matching seamlessly. MYOB Business has caught up with direct bank feeds from all major NZ banks (ANZ, ASB, BNZ, Westpac, Kiwibank).</p>
<h4>2. New Zealand Payroll & Holidays Act Compliance</h4>
<p>The NZ Holidays Act 2003 is notoriously complex regarding alternative holidays, gross earnings calculations, and public holiday pay. Both Xero Payroll and MYOB Payroll provide certified Payday Filing directly to IRD, though MYOB often provides deeper configuration for complex shift rosters, whereas Xero excels in ease of employee self-service.</p>
<h4>3. Which Platform Should You Choose?</h4>
<ul>
    <li><strong>Choose Xero if:</strong> You value an enormous third-party app marketplace (Hubdoc, Dext, Shopify, Stripe, WorkflowMax) and clean, beautiful interfaces.</li>
    <li><strong>Choose MYOB if:</strong> Your business has intricate inventory management, wholesale distribution requirements, or specialized construction workflows.</li>
</ul>
<p>As certified partners in both Xero and MYOB, get-accountant helps Kiwi businesses set up, optimize, or migrate their cloud accounting stacks with zero data loss.</p>',
        'image'   => 'assets/images/blog/blog-lg-3.jpg',
        'author'  => 'get-accountant Cloud Systems Team',
        'status'  => 'published'
    ]
];

$stmt = $pdo->prepare("INSERT INTO blog_posts (title, slug, excerpt, content, image, author, status, created_at, updated_at) 
    VALUES (:title, :slug, :excerpt, :content, :image, :author, :status, NOW(), NOW())
    ON DUPLICATE KEY UPDATE 
    title = VALUES(title),
    excerpt = VALUES(excerpt),
    content = VALUES(content),
    image = VALUES(image),
    author = VALUES(author),
    status = VALUES(status),
    updated_at = NOW()");

foreach ($blogs as $b) {
    $stmt->execute($b);
    echo "Seeded blog: " . $b['title'] . "\n";
}

echo "All blogs seeded successfully.\n";
