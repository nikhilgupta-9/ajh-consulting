<?php
require_once __DIR__ . '/config/config.php';

$slug = $_GET['slug'] ?? null;
$event = null;
$events = [];

if ($pdo = db()) {
    try {
        if ($slug) {
            $stmt = $pdo->prepare("SELECT * FROM events WHERE slug = :slug AND status = 'published' LIMIT 1");
            $stmt->execute(['slug' => $slug]);
            $event = $stmt->fetch() ?: null;
        } else {
            $events = $pdo->query(
                "SELECT * FROM events WHERE status = 'published' ORDER BY event_date ASC"
            )->fetchAll();
        }
    } catch (Throwable $e) {
        $events = [];
    }
}

$pageTitle       = $event ? $event['title'] : 'Events';
$metaDescription = $event
    ? mb_substr(strip_tags((string) $event['description']), 0, 160)
    : 'Webinars, workshops and live sessions from the get-accountant team for businesses and accounting firms.';

// Other upcoming/related events for the sidebar on the single-event view.
$otherEvents = [];
if ($event && $pdo) {
    try {
        $stmt = $pdo->prepare(
            "SELECT * FROM events WHERE status = 'published' AND slug != :slug ORDER BY event_date ASC LIMIT 3"
        );
        $stmt->execute(['slug' => $event['slug']]);
        $otherEvents = $stmt->fetchAll();
    } catch (Throwable $e) {
        $otherEvents = [];
    }
}

$pageHeading      = $event ? $event['title'] : 'Events & Webinars';
$breadcrumbParent = $event ? ['label' => 'Events', 'url' => site_url('events.php')] : null;

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/events.css'); ?>">

<?php if ($event): ?>

    <!-- ===== Single event view ===== -->
    <?php
        $isPastEvent = strtotime($event['event_date']) < strtotime('today');
        $eventDate   = strtotime($event['event_date']);
        $shareUrl    = site_url('events.php') . '?slug=' . urlencode($event['slug']);
    ?>
    <?php if (!empty($event['image'])): ?>
    <div class="event-hero">
        <img src="<?php echo e($event['image']); ?>" alt="<?php echo e($event['title']); ?>">
        <div class="event-hero-overlay"></div>
        <div class="container event-hero-inner">
            <?php if ($isPastEvent): ?><span class="event-hero-badge">Past Event &mdash; Recap</span>
            <?php else: ?><span class="event-hero-badge is-upcoming">Upcoming Event</span><?php endif; ?>
            <h1 class="event-hero-title"><?php echo e($event['title']); ?></h1>
            <div class="event-hero-meta">
                <span><i class="far fa-calendar-alt"></i> <?php echo date('l, d M Y', $eventDate); ?></span>
                <?php if (!empty($event['event_time'])): ?><span><i class="far fa-clock"></i> <?php echo e($event['event_time']); ?></span><?php endif; ?>
                <?php if (!empty($event['location'])): ?><span><i class="far fa-map-marker-alt"></i> <?php echo e($event['location']); ?></span><?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="events-wrap">
        <div class="container">
            <a class="events-back-link" href="<?php echo site_url('events.php'); ?>"><i class="far fa-long-arrow-left"></i> Back to all events</a>

            <div class="event-detail-layout">
                <!-- Main content -->
                <article class="event-detail-main">
                    <?php if (!empty($event['description'])): ?>
                        <div class="event-detail-body"><?php echo $event['description']; ?></div>
                    <?php endif; ?>

                    <?php if (!empty($event['video_url'])): ?>
                        <h3 class="event-section-heading">Session Recording</h3>
                        <div class="event-detail-video">
                            <iframe src="<?php echo e($event['video_url']); ?>" title="Event video" allowfullscreen loading="lazy"></iframe>
                        </div>
                    <?php endif; ?>

                    <div class="event-detail-share">
                        <span>Share this event:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($shareUrl); ?>" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($shareUrl); ?>&text=<?php echo urlencode($event['title']); ?>" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($shareUrl); ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="mailto:?subject=<?php echo urlencode($event['title']); ?>&body=<?php echo urlencode($shareUrl); ?>" aria-label="Share by email"><i class="far fa-envelope"></i></a>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="event-detail-sidebar">
                    <div class="event-reg-card">
                        <?php if ($isPastEvent): ?>
                            <div class="event-reg-status">This event has ended</div>
                        <?php else: ?>
                            <div class="event-reg-status is-live">Registration Open</div>
                        <?php endif; ?>

                        <ul class="event-reg-facts">
                            <li>
                                <i class="far fa-calendar-alt"></i>
                                <div>
                                    <strong>Date</strong>
                                    <span><?php echo date('l, d F Y', $eventDate); ?></span>
                                </div>
                            </li>
                            <?php if (!empty($event['event_time'])): ?>
                            <li>
                                <i class="far fa-clock"></i>
                                <div>
                                    <strong>Time</strong>
                                    <span><?php echo e($event['event_time']); ?></span>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if (!empty($event['location'])): ?>
                            <li>
                                <i class="far fa-map-marker-alt"></i>
                                <div>
                                    <strong>Location</strong>
                                    <span><?php echo e($event['location']); ?></span>
                                </div>
                            </li>
                            <?php endif; ?>
                            <li>
                                <i class="far fa-building"></i>
                                <div>
                                    <strong>Hosted By</strong>
                                    <span><?php echo e(APP_NAME); ?></span>
                                </div>
                            </li>
                        </ul>

                        <?php if (!$isPastEvent): ?>
                            <?php if (!empty($event['registration_url'])): ?>
                                <a class="rts-btn btn-primary event-reg-btn" href="<?php echo e($event['registration_url']); ?>" target="_blank" rel="noopener">Register Now <i class="far fa-arrow-right"></i></a>
                            <?php else: ?>
                                <a class="rts-btn btn-primary event-reg-btn" href="<?php echo site_url('contactus.php'); ?>">Contact Us to Register <i class="far fa-arrow-right"></i></a>
                            <?php endif; ?>
                            <p class="event-reg-note">Spaces are limited &mdash; reserve your seat in advance.</p>
                        <?php else: ?>
                            <a class="rts-btn btn-primary-alta event-reg-btn" href="<?php echo site_url('events.php'); ?>" style="border:2px solid #0f172a; color:#0f172a;">See Upcoming Events <i class="far fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($otherEvents)): ?>
                    <div class="event-sidebar-card">
                        <h4>Other Events</h4>
                        <?php foreach ($otherEvents as $oe): ?>
                            <a class="event-sidebar-item" href="<?php echo site_url('events.php'); ?>?slug=<?php echo urlencode($oe['slug']); ?>">
                                <img src="<?php echo e($oe['image'] ?: site_url('assets/images/events/gst-tax-season-webinar.jpg')); ?>" alt="<?php echo e($oe['title']); ?>">
                                <div>
                                    <span class="event-sidebar-item-date"><?php echo date('d M Y', strtotime($oe['event_date'])); ?></span>
                                    <span class="event-sidebar-item-title"><?php echo e($oe['title']); ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="event-sidebar-cta">
                        <h4>Questions About This Event?</h4>
                        <p>Reach out to our team and we'll be happy to help.</p>
                        <a class="rts-btn btn-primary-alta" href="<?php echo site_url('contactus.php'); ?>" style="border:2px solid #0f172a; color:#0f172a;">Contact Us</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>

<?php else: ?>

    <!-- ===== Events list view ===== -->
    <div class="events-wrap">
        <div class="container">
            <?php if (empty($events)): ?>
                <p class="disc">No upcoming events right now. Please check back soon.</p>
            <?php else: ?>
                <div class="events-grid">
                    <?php foreach ($events as $ev):
                        $isPast = strtotime($ev['event_date']) < strtotime('today');
                    ?>
                        <article class="event-card<?php echo $isPast ? ' is-past' : ''; ?>">
                            <a class="event-card-thumb" href="<?php echo site_url('events.php'); ?>?slug=<?php echo urlencode($ev['slug']); ?>">
                                <img src="<?php echo e($ev['image'] ?: site_url('assets/images/events/gst-tax-season-webinar.jpg')); ?>" alt="<?php echo e($ev['title']); ?>">
                                <span class="event-card-date">
                                    <strong><?php echo date('d', strtotime($ev['event_date'])); ?></strong>
                                    <small><?php echo date('M Y', strtotime($ev['event_date'])); ?></small>
                                </span>
                                <?php if ($isPast): ?><span class="event-card-badge">Past Event</span><?php endif; ?>
                            </a>
                            <div class="event-card-body">
                                <?php if (!empty($ev['event_time'])): ?>
                                    <div class="event-card-meta"><i class="far fa-clock"></i> <?php echo e($ev['event_time']); ?></div>
                                <?php endif; ?>
                                <h2 class="event-card-title">
                                    <a href="<?php echo site_url('events.php'); ?>?slug=<?php echo urlencode($ev['slug']); ?>"><?php echo e($ev['title']); ?></a>
                                </h2>
                                <?php if (!empty($ev['location'])): ?>
                                    <div class="event-card-location"><i class="far fa-map-marker-alt"></i> <?php echo e($ev['location']); ?></div>
                                <?php endif; ?>
                                <p class="event-card-excerpt"><?php echo e($ev['summary']); ?></p>
                                <a class="event-card-link" href="<?php echo site_url('events.php'); ?>?slug=<?php echo urlencode($ev['slug']); ?>">
                                    <?php echo $isPast ? 'View Recap' : 'View Details'; ?> <i class="far fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
