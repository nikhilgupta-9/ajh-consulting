<?php
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) exit("DB connection error\n");

$testimonials = [
    [
        'branch' => 'bookkeeping',
        'client_name' => 'Liam Henderson',
        'client_role' => 'Managing Director, Apex Build Group (Auckland)',
        'quote' => 'Handing our bookkeeping, subcontractor PAYE, and bi-monthly GST to get-accountant has been transformative. Reconciliations are done weekly, zero filing delays with IRD, and we save at least 25 hours every single month.',
        'rating' => 5,
        'sort_order' => 1
    ],
    [
        'branch' => 'bookkeeping',
        'client_name' => 'Sophie Campbell',
        'client_role' => 'Founder, Campbell & Co Retail (Wellington)',
        'quote' => 'They rescued our Shopify and POS accounts after our previous bookkeeper left us three months behind on GST. The catch-up team cleaned everything up in 10 days flat. Honest, communicative, and worth every dollar.',
        'rating' => 5,
        'sort_order' => 2
    ],
    [
        'branch' => 'firm_outsourcing',
        'client_name' => 'Marcus Vance, CA',
        'client_role' => 'Principal Partner, Vance Chartered Accountants (Christchurch)',
        'quote' => 'We started with a single pilot job preparing year-end workpapers in Xero Practice Manager. The file arrived meticulously indexed to CA ANZ standards with clear queries highlighted. They are now an indispensable extension of our practice.',
        'rating' => 5,
        'sort_order' => 1
    ],
    [
        'branch' => 'firm_outsourcing',
        'client_name' => 'Elena Rossi, CPA',
        'client_role' => 'Managing Partner, Rossi Tax & Advisory (Sydney)',
        'quote' => 'The overnight turnaround is a massive competitive advantage for us. We send work at 5 PM in Sydney, and the draft accounts and tax schedules are ready for our morning review. Our staff retention and margins have both jumped 35%.',
        'rating' => 5,
        'sort_order' => 2
    ],
];

$pdo->exec("DELETE FROM testimonials");
$stmt = $pdo->prepare("INSERT INTO testimonials (branch, client_name, client_role, quote, rating, sort_order) VALUES (:branch, :client_name, :client_role, :quote, :rating, :sort_order)");
foreach ($testimonials as $t) {
    $stmt->execute($t);
}
echo "Seeded " . count($testimonials) . " authentic testimonials!\n";
