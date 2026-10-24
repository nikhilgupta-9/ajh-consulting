<?php
/**
 * Seeds 2 get-accountant events into the events table.
 * Run: php database/seed_events.php
 */
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) {
    die("Database not connected.\n");
}

$imgBase = 'assets/images/events/';

$events = [
    [
        'title'            => 'GST & Tax Season Readiness Webinar',
        'slug'             => 'gst-tax-season-readiness-webinar',
        'summary'          => 'A live session for New Zealand business owners on getting GST filings, payroll and year-end records ready before tax season.',
        'image'            => $imgBase . 'gst-tax-season-webinar.jpg',
        'video_url'        => '',
        'event_date'       => date('Y-m-d', strtotime('+21 days')),
        'event_time'       => '11:00am – 12:00pm NZST',
        'location'         => 'Online (Zoom)',
        'registration_url' => 'contactus.php',
        'status'           => 'published',
        'description'      => '
<p>Tax season doesn\'t have to mean a last-minute scramble. Join the get-accountant team for a practical, no-jargon session on getting your GST filings, payroll records and year-end books in order ahead of time.</p>
<h2>What We\'ll Cover</h2>
<ul>
<li>A simple month-by-month checklist to stay GST-ready year-round</li>
<li>Common bookkeeping mistakes that slow down tax filing</li>
<li>How to reconcile accounts before handing files to your accountant</li>
<li>Live Q&amp;A with our bookkeeping team</li>
</ul>
<h2>Who Should Attend</h2>
<p>Small business owners, office managers and bookkeepers who want a clear, repeatable process for staying on top of GST and tax obligations.</p>
',
    ],
    [
        'title'            => 'Outsourced Bookkeeping for Accounting Firms — Live Q&A',
        'slug'             => 'outsourced-bookkeeping-accounting-firms-live-qa',
        'summary'          => 'An open Q&A for accounting firm owners exploring outsourced bookkeeping support to handle peak-season workload.',
        'image'            => $imgBase . 'outsourced-bookkeeping-workshop.jpg',
        'video_url'        => '',
        'event_date'       => date('Y-m-d', strtotime('+35 days')),
        'event_time'       => '2:00pm – 3:00pm NZST',
        'location'         => 'Online (Zoom)',
        'registration_url' => 'contactus.php',
        'status'           => 'published',
        'description'      => '
<p>If your accounting firm is feeling the strain of peak season, this session walks through exactly how outsourced bookkeeping support works in practice &mdash; what stays in your control, what gets handed off, and how to keep review and client relationships firmly with your firm.</p>
<h2>What We\'ll Cover</h2>
<ul>
<li>What tasks can realistically be outsourced without losing control</li>
<li>How file handoff, review and escalation typically work</li>
<li>Data security questions every firm should ask before outsourcing</li>
<li>Open floor for your specific questions</li>
</ul>
<h2>Who Should Attend</h2>
<p>Accounting and CA/CPA firm owners and practice managers evaluating outsourced bookkeeping or practice support for the first time.</p>
',
    ],
];

$stmt = $pdo->prepare(
    "INSERT INTO events (title, slug, summary, description, image, video_url, event_date, event_time, location, registration_url, status)
     VALUES (:title, :slug, :summary, :description, :image, :video_url, :event_date, :event_time, :location, :registration_url, :status)
     ON DUPLICATE KEY UPDATE title = VALUES(title), summary = VALUES(summary), description = VALUES(description),
        image = VALUES(image), video_url = VALUES(video_url), event_date = VALUES(event_date),
        event_time = VALUES(event_time), location = VALUES(location), registration_url = VALUES(registration_url),
        status = VALUES(status)"
);

foreach ($events as $ev) {
    $stmt->execute($ev);
    echo "Seeded: {$ev['title']}\n";
}

echo "Done. " . count($events) . " events seeded.\n";
