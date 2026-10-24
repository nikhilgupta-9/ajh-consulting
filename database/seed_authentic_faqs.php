<?php
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) exit("DB connection error\n");

$faqs = [
    // Bookkeeping / Businesses
    [
        'branch' => 'bookkeeping',
        'question' => 'Can you help if my accounts and GST returns are behind?',
        'answer' => 'Yes. Our specialized catch-up pod reviews your historical bank feeds, reconstructs missing records, resolves discrepancies, and brings your accounts fully up to date so you can file with Inland Revenue (IRD) or ATO without panic.',
        'sort_order' => 1
    ],
    [
        'branch' => 'bookkeeping',
        'question' => 'What accounting software do you work with?',
        'answer' => 'We are certified experts in Xero and MYOB. We also integrate seamlessly with receipt automation tools like Dext Prepare, Hubdoc, and direct bank feeds for 100% paperless bookkeeping.',
        'sort_order' => 2
    ],
    [
        'branch' => 'bookkeeping',
        'question' => 'Are your monthly fees fixed or hourly?',
        'answer' => 'We operate on transparent, agreed fixed monthly plans with no surprise bills. You know exactly what is included—bookkeeping, GST filing, and payroll—before we start.',
        'sort_order' => 3
    ],
    [
        'branch' => 'bookkeeping',
        'question' => 'How quickly can we get started?',
        'answer' => 'Following our 20-minute discovery consultation and security access setup, we typically start processing your transactions within 48 to 72 hours.',
        'sort_order' => 4
    ],

    // Firm Outsourcing
    [
        'branch' => 'firm_outsourcing',
        'question' => 'Will you ever contact our accounting firm\'s clients directly?',
        'answer' => 'Never. We operate under a 100% strict mutual NDA with an airtight zero client contact and non-solicitation guarantee. Your firm owns all client relationships, and all work is delivered white-label.',
        'sort_order' => 1
    ],
    [
        'branch' => 'firm_outsourcing',
        'question' => 'Who reviews and signs off the completed work?',
        'answer' => 'Our team prepares files to CA ANZ standards with lead schedules, source document links, and clear review notes. Your internal reviewer or partner retains final review, client sign-off, and filing authority.',
        'sort_order' => 2
    ],
    [
        'branch' => 'firm_outsourcing',
        'question' => 'Can we test your quality with a single pilot job?',
        'answer' => 'Absolutely. We encourage all new accounting practices to begin with a single defined pilot job (e.g. one year-end workpaper file or bookkeeping cleanup) so you can evaluate our turnaround speed and workpaper quality risk-free.',
        'sort_order' => 3
    ],
    [
        'branch' => 'firm_outsourcing',
        'question' => 'How does the overnight time-zone advantage work?',
        'answer' => 'Because our offshore production team operates across complementary time zones, jobs submitted at the end of your business day are worked on overnight and delivered ready for review the next morning.',
        'sort_order' => 4
    ],
    [
        'branch' => 'firm_outsourcing',
        'question' => 'Where is data stored and how is security maintained?',
        'answer' => 'We work directly inside your cloud environments (Xero HQ, MYOB Practice, Karbon, CCH iFirm) using role-based access control and two-factor authentication (2FA). Client data never leaves your secure authorized cloud perimeter.',
        'sort_order' => 5
    ]
];

$pdo->exec("DELETE FROM faqs");
$stmt = $pdo->prepare("INSERT INTO faqs (branch, question, answer, sort_order) VALUES (:branch, :question, :answer, :sort_order)");
foreach ($faqs as $f) {
    $stmt->execute($f);
}
echo "Seeded " . count($faqs) . " authentic FAQs!\n";
