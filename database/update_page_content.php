<?php
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) die("DB failed");

$updates = [
    [
        'slug' => 'about',
        'heading' => 'People. Process. Possibility.™',
        'subheading' => 'ABOUT GET-ACCOUNTANT',
        'body' => 'At get-accountant, we empower growing businesses and accounting practices across New Zealand with disciplined accounting, on-time IRD compliance, and scalable back-office production capacity. Combining certified New Zealand accountants with cloud automation, we help our clients focus on what truly matters: expanding sales, delighting customers, and building enterprise value.',
    ],
    [
        'slug' => 'how-we-work',
        'heading' => 'Structured, Transparent & Reliable',
        'subheading' => 'HOW WE WORK',
        'body' => 'We operate under a simple, reliable framework: seamless cloud system connection, proactive daily/weekly transaction reconciliation, multi-tier quality audits, and punctual statutory filing with Inland Revenue. Zero surprises, complete transparency, and dedicated support every step of the way.',
    ],
    [
        'slug' => 'our-peoples',
        'heading' => 'Experienced Accounting Professionals Dedicated to Your Success',
        'subheading' => 'MEET OUR TEAM',
        'body' => 'The team behind get-accountant combines decades of Chartered Accounting, tax compliance, and payroll experience across New Zealand and Australia. Meet the leaders who ensure your numbers are always accurate and audit-ready.',
    ],
    [
        'slug' => 'insight-resources',
        'heading' => 'Insights & Practical Financial Resources',
        'subheading' => 'LATEST THINKING',
        'body' => 'Practical guides, New Zealand tax calendar deadlines, cash flow forecasting models, and cloud accounting updates to help you navigate compliance and accelerate business growth.',
    ],
];

$stmt = $pdo->prepare("UPDATE page_content SET heading = :heading, subheading = :subheading, body = :body WHERE page_slug = :slug");
foreach ($updates as $u) {
    $stmt->execute($u);
    echo "Updated page_content for {$u['slug']}\n";
}
