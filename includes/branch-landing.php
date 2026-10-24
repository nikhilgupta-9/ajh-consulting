<?php
/**
 * Branch landing page — one template behind both audience homepages
 * (nz/accounting/ = businesses, nz/accounting-firm/ = CA/CPA firms).
 *
 * Section order and the alternating dark / light rhythm follow
 * indianmuneem.com: Hero → Who We Serve → Services → Key Partners →
 * Industries → Why Choose Us + enquiry form → Workflow → Software →
 * Testimonials → FAQs → Insights → closing CTA. Navigation is the main
 * header only — no second "mini navbar" on these pages.
 *
 * The calling page sets $branch ('bookkeeping' | 'firm_outsourcing') and
 * $L (all copy for that audience — see nz/accounting/index.php), then
 * requires header.php followed by this file.
 */

$isFirm     = $branch === 'firm_outsourcing';
$otherBranch = $isFirm ? 'bookkeeping' : 'firm_outsourcing';
$bizUrl     = site_url('nz/accounting/');
$firmUrl    = site_url('nz/accounting-firm/');

$servicesBy   = ['bookkeeping' => [], 'firm_outsourcing' => []];
$testimonials = [];
$faqs         = [];
$posts        = [];

if ($pdo = db()) {
    try {
        foreach ($pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC') as $row) {
            $servicesBy[$row['branch']][] = $row;
        }

        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 6');
        $stmt->execute(['b' => $branch]);
        $testimonials = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT * FROM faqs WHERE is_active = 1 AND (page IN ('home', 'all') AND service_id IS NULL) AND branch = :b ORDER BY sort_order ASC, id ASC LIMIT 6");
        $stmt->execute(['b' => $branch]);
        $faqs = $stmt->fetchAll();
        if (empty($faqs)) {
            $stmt = $pdo->prepare("SELECT * FROM faqs WHERE is_active = 1 AND branch = :b ORDER BY sort_order ASC, id ASC LIMIT 6");
            $stmt->execute(['b' => $branch]);
            $faqs = $stmt->fetchAll();
        }

        $posts = $pdo->query("SELECT title, slug, image, created_at FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
    } catch (Throwable $e) {
        // Sections below fall back to their empty states.
    }
}

$serviceIcons = [
    'flaticon-consulting' => 'fa-handshake',
    'flaticon-accounting' => 'fa-calculator',
    'flaticon-financial'  => 'fa-chart-line',
    'flaticon-audit'      => 'fa-file-search',
];
$assetUrl = static fn(?string $path, string $fallback): string =>
    $path ? (preg_match('#^https?://#', $path) ? $path : site_url($path)) : site_url($fallback);

// Tabs: this page's audience first and active.
$serviceTabs = [
    $branch      => $isFirm ? ['For CA/CPA Firms', 'fa-users', $firmUrl] : ['For Businesses', 'fa-building', $bizUrl],
    $otherBranch => $isFirm ? ['For Businesses', 'fa-building', $bizUrl] : ['For CA/CPA Firms', 'fa-users', $firmUrl],
];
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/branch-landing.css?v=2'); ?>">

<?php
// The page's own slider hero renders outside .bl so this file's styles never touch it.
if (!empty($heroFile)) {
    require $heroFile;
}
?>

<main class="bl">

    <!-- 1. HERO — static dark hero, used only when the page has no slider of its own -->
    <?php if (empty($heroFile)): ?>
    <section class="bl-hero bl-dark">
        <div class="bl-container bl-hero-grid">
            <div>
                <span class="bl-eyebrow"><?php echo e($L['hero']['eyebrow']); ?></span>
                <h1><?php echo $L['hero']['title']; ?></h1>
                <p><?php echo e($L['hero']['text']); ?></p>
                <div class="bl-btn-row">
                    <a class="bl-btn bl-btn-primary" href="#enquiry"><?php echo e($L['hero']['cta']); ?> <i class="far fa-arrow-right"></i></a>
                    <a class="bl-btn bl-btn-ghost" href="#services">Explore Our Services <i class="far fa-arrow-right"></i></a>
                </div>
                <div class="bl-badges">
                    <?php foreach ($L['hero']['badges'] as $badge): ?>
                        <span><i class="fas fa-check-circle"></i><?php echo e($badge); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="bl-hero-media">
                <img src="<?php echo site_url($L['hero']['image']); ?>" alt="<?php echo e($L['hero']['imageAlt']); ?>">
            </div>
        </div>
    </section>

    <?php endif; ?>

    <!-- 2. WHO WE SERVE + STATS (light) -->
    <section class="bl-section bl-light">
        <div class="bl-container">
            <div class="bl-head center">
                <span class="bl-eyebrow">Who We Serve</span>
                <h2 class="bl-title">Built for Two <em>Distinct Needs</em></h2>
                <span class="bl-title-rule"></span>
            </div>
            <div class="bl-serve-grid">
                <?php foreach ($L['serve'] as $card): ?>
                    <div class="bl-serve-card<?php echo $card['current'] ? ' is-current' : ''; ?>">
                        <span class="bl-serve-tag"><?php echo e($card['tag']); ?><?php echo $card['current'] ? ' · You are here' : ''; ?></span>
                        <h3><?php echo e($card['title']); ?></h3>
                        <p><?php echo e($card['text']); ?></p>
                        <ul class="bl-checks">
                            <?php foreach ($card['points'] as $point): ?>
                                <li><i class="fas fa-check-circle"></i><?php echo e($point); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="bl-btn <?php echo $card['current'] ? 'bl-btn-primary' : 'bl-btn-ghost'; ?>" href="<?php echo e(!empty($card['url']) ? $card['url'] : '#services'); ?>">
                            <?php echo e($card['cta']); ?> <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="bl-stats">
                <?php foreach ($L['stats'] as [$value, $label]): ?>
                    <div class="bl-stat"><strong><?php echo e($value); ?></strong><span><?php echo e($label); ?></span></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 3. SERVICES (dark) — tabbed like indianmuneem.com, this audience first -->
    <section class="bl-section bl-dark bl-glow" id="services">
        <div class="bl-container">
            <div class="bl-head center">
                <span class="bl-eyebrow">Our Services</span>
                <h2 class="bl-title"><?php echo $L['servicesTitle']; ?></h2>
                <span class="bl-title-rule"></span>
            </div>
            <div class="bl-tabs" role="tablist">
                <?php $first = true; foreach ($serviceTabs as $key => [$label, $icon]): ?>
                    <button type="button" class="bl-tab<?php echo $first ? ' active' : ''; ?>" role="tab" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" data-bl-tab="<?php echo e($key); ?>">
                        <i class="fas <?php echo $icon; ?>"></i> <?php echo e($label); ?>
                    </button>
                <?php $first = false; endforeach; ?>
            </div>
            <?php $first = true; foreach ($serviceTabs as $key => [$label, $icon, $url]): ?>
                <div class="bl-tab-panel" data-bl-panel="<?php echo e($key); ?>"<?php echo $first ? '' : ' hidden'; ?>>
                    <?php if (empty($servicesBy[$key])): ?>
                        <p class="bl-empty">Services will appear here once they are added in the admin panel.</p>
                    <?php else: ?>
                        <div class="bl-service-grid">
                            <?php foreach ($servicesBy[$key] as $s):
                                $detailUrl = site_url('service-details.php') . '?slug=' . urlencode($s['slug']);
                            ?>
                                <?php 
                                    $iconClass = !empty($s['icon']) ? (strpos($s['icon'], 'fa-') === 0 ? $s['icon'] : ($serviceIcons[$s['icon']] ?? 'fa-calculator')) : 'fa-calculator';
                                ?>
                                <div class="bl-service-card">
                                    <div class="bl-service-icon"><i class="fas <?php echo e($iconClass); ?>"></i></div>
                                    <h3><a href="<?php echo e($detailUrl); ?>"><?php echo e($s['title']); ?></a></h3>
                                    <p><?php echo e($s['short_description']); ?></p>
                                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: auto; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                                        <?php if (!empty($s['starting_price'])): ?>
                                            <span style="font-size: 12.5px; font-weight: 700; color: #0f172a;">From NZ$<?php echo e($s['starting_price']); ?><?php echo $key === 'firm_outsourcing' ? '' : '/mo'; ?></span>
                                        <?php endif; ?>
                                        <a class="bl-btn bl-btn-outline" href="<?php echo e($detailUrl); ?>">Explore Scope <i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!$first): ?>
                        <div class="bl-center-cta"><a class="bl-btn bl-btn-ghost" href="<?php echo e($url); ?>">Go to <?php echo e($label); ?> <i class="far fa-arrow-right"></i></a></div>
                    <?php endif; ?>
                </div>
            <?php $first = false; endforeach; ?>
        </div>
    </section>

    <!-- 5. INDUSTRIES (dark) -->
    <section class="bl-section bl-dark">
        <div class="bl-container">
            <div class="bl-head center">
                <span class="bl-eyebrow">Industries</span>
                <h2 class="bl-title">Sector-Specific <em>Expertise</em></h2>
                <span class="bl-title-rule"></span>
                <p class="bl-lead"><?php echo e($L['industriesText']); ?></p>
            </div>
            <div class="bl-industry-grid">
                <?php foreach ($L['industries'] as [$title, $desc, $icon]): ?>
                    <div class="bl-industry">
                        <div class="bl-industry-head"><i class="fas <?php echo $icon; ?>"></i><h3><?php echo e($title); ?></h3></div>
                        <p><?php echo e($desc); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="bl-center-cta"><a class="bl-btn bl-btn-ghost" href="<?php echo site_url('nz/accounting/industries.php'); ?>">View All Industries <i class="far fa-arrow-right"></i></a></div>
        </div>
    </section>

    <!-- 6. WHY CHOOSE US + ENQUIRY FORM (light) -->
    <section class="bl-section bl-light" id="enquiry">
        <div class="bl-container bl-why-grid">
            <div>
                <span class="bl-eyebrow">Why Choose Us</span>
                <h2 class="bl-title"><?php echo $L['whyTitle']; ?></h2>
                <span class="bl-title-rule"></span>
                <p class="bl-lead"><?php echo e($L['whyText']); ?></p>
                <ul class="bl-why-list">
                    <?php foreach ($L['why'] as [$strong, $text]): ?>
                        <li><i class="fas fa-check-circle"></i><span><strong><?php echo e($strong); ?>:</strong> <?php echo e($text); ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <form class="bl-form" action="<?php echo site_url('contactus.php'); ?>" method="post">
                <?php echo csrf_field(); ?>
                <h3>Let&rsquo;s Discuss Your Needs</h3>
                <p>Tell us how we can help and our team will get back to you shortly.</p>
                <div class="bl-form-grid">
                    <input type="text" name="name" placeholder="Full name *" required>
                    <?php if ($isFirm): ?>
                        <input type="text" name="firm_name" placeholder="Firm name">
                    <?php endif; ?>
                    <input type="email" name="email" placeholder="Email *" required>
                    <input type="tel" name="phone" placeholder="Phone"<?php echo $isFirm ? '' : ' class="full"'; ?>>
                    <select name="service" class="full">
                        <?php foreach ($L['formServices'] as $opt): ?>
                            <option value="<?php echo e($opt); ?>"><?php echo e($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <textarea name="message" class="full" placeholder="Let us know what you need"></textarea>
                </div>
                <button type="submit" class="bl-btn bl-btn-primary">Submit Enquiry <i class="far fa-arrow-right"></i></button>
            </form>
        </div>
    </section>

    <!-- 7. WORKFLOW (dark) -->
    <section class="bl-section bl-dark bl-glow">
        <div class="bl-container">
            <div class="bl-head center">
                <span class="bl-eyebrow">Your Workflow, Simplified</span>
                <h2 class="bl-title">From First Call to <em>Seamless Delivery</em></h2>
                <span class="bl-title-rule"></span>
            </div>
            <div class="bl-phase-grid">
                <?php foreach ($L['phases'] as $phase): ?>
                    <div class="bl-phase">
                        <div class="bl-phase-icon"><i class="fas <?php echo $phase['icon']; ?>"></i></div>
                        <h3><?php echo e($phase['title']); ?></h3>
                        <?php foreach ($phase['steps'] as [$stepTitle, $stepText]): ?>
                            <div class="bl-step"><h4><?php echo e($stepTitle); ?></h4><p><?php echo e($stepText); ?></p></div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 8. ACCOUNTING SOFTWARE (light band) -->
    <section class="bl-band bl-cream" id="software">
        <div class="bl-container">
            <div class="bl-head center" style="margin-bottom: 34px;">
                <span class="bl-eyebrow">Cloud Ecosystem</span>
                <h2 class="bl-title">Accounting <em>Software</em> We Work In</h2>
                <span class="bl-title-rule"></span>
            </div>
            <div class="bl-software-grid">
                <?php foreach ($L['software'] as $item): 
                    $name = is_array($item) ? ($item['name'] ?? $item[0] ?? '') : $item;
                    $note = is_array($item) ? ($item['note'] ?? $item[1] ?? '') : '';
                    $logo = is_array($item) ? ($item['logo'] ?? null) : null;
                ?>
                    <div class="bl-software-card">
                        <?php if ($logo && file_exists(__DIR__ . '/../' . $logo)): ?>
                            <div class="bl-software-img-wrap">
                                <img src="<?php echo site_url($logo); ?>" alt="<?php echo e($name); ?> logo" class="bl-software-img" loading="lazy">
                            </div>
                        <?php else: ?>
                            <div class="bl-software-img-wrap">
                                <i class="fas fa-file-invoice-dollar" style="font-size: 28px; color: var(--bl-red);"></i>
                            </div>
                        <?php endif; ?>
                        <div class="bl-software-name"><?php echo e($name); ?></div>
                        <?php if (!empty($note)): ?>
                            <div class="bl-software-note"><?php echo e($note); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 9. TESTIMONIALS (dark) -->
    <section class="bl-section bl-dark">
        <div class="bl-container">
            <div class="bl-reviews">
                <div class="bl-reviews-intro">
                    <h2>Trusted by Our Clients</h2>
                    <p><?php echo e($L['reviewsText']); ?></p>
                    <a class="bl-btn bl-btn-outline" href="<?php echo e($L['reviewsUrl']); ?>"><?php echo e($L['reviewsCta']); ?> <i class="far fa-arrow-right"></i></a>
                </div>
                <?php if (empty($testimonials)): ?>
                    <p class="bl-empty">Client reviews will appear here once they are added in the admin panel.</p>
                <?php else: ?>
                    <div class="bl-review-grid">
                        <?php foreach ($testimonials as $t): $rating = max(1, min(5, (int) $t['rating'])); ?>
                            <div class="bl-review">
                                <div class="bl-review-who">
                                    <span class="bl-avatar"><?php echo e(strtoupper(substr($t['client_name'], 0, 1))); ?></span>
                                    <div><strong><?php echo e($t['client_name']); ?></strong><span><?php echo e($t['client_role']); ?></span></div>
                                </div>
                                <div class="bl-stars" aria-label="<?php echo $rating; ?> out of 5"><?php echo str_repeat('<i class="fas fa-star"></i>', $rating); ?></div>
                                <p>&ldquo;<?php echo e($t['quote']); ?>&rdquo;</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 10. FAQs (light) -->
    <section class="bl-section bl-light">
        <div class="bl-container">
            <div class="bl-head">
                <span class="bl-eyebrow">FAQs</span>
                <h2 class="bl-title">Frequently Asked <em>Questions</em></h2>
                <span class="bl-title-rule"></span>
            </div>
            <div class="bl-faq-grid">
                <div class="bl-faq-media">
                    <img src="<?php echo site_url('assets/images/service/08.jpg'); ?>" alt="Our team answering client questions">
                    <div class="bl-faq-badge"><strong>NZ</strong><span>Based support team</span></div>
                </div>
                <div class="bl-faq-list">
                    <?php if (empty($faqs)): ?>
                        <p class="bl-empty">FAQs will appear here once they are added in the admin panel.</p>
                    <?php else: ?>
                        <?php foreach ($faqs as $i => $f): ?>
                            <details class="bl-faq"<?php echo $i === 0 ? ' open' : ''; ?>>
                                <summary><?php echo e($f['question']); ?> <i class="fas fa-chevron-down"></i></summary>
                                <div class="bl-faq-answer"><?php echo e($f['answer']); ?></div>
                            </details>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. INSIGHTS / BLOGS (dark) -->
    <section class="bl-section bl-dark bl-glow">
        <div class="bl-container">
            <div class="bl-head-row">
                <div class="bl-head">
                    <span class="bl-eyebrow">Blogs</span>
                    <h2 class="bl-title">Our <em>Recent Blogs</em></h2>
                </div>
                <a class="bl-btn bl-btn-primary" href="<?php echo site_url('blog-list.php'); ?>">View All Blogs</a>
            </div>
            <?php if (empty($posts)): ?>
                <p class="bl-empty">New articles are on the way.</p>
            <?php else: ?>
                <div class="bl-blog-grid">
                    <?php foreach ($posts as $post):
                        $postUrl = site_url('blog-details.php') . '?slug=' . urlencode($post['slug']);
                    ?>
                        <article class="bl-blog">
                            <a href="<?php echo e($postUrl); ?>"><img src="<?php echo e($assetUrl($post['image'], 'assets/images/blog/blog-lg-1.jpg')); ?>" alt="<?php echo e($post['title']); ?>" loading="lazy"></a>
                            <div class="bl-blog-body">
                                <div class="bl-blog-date"><i class="far fa-calendar"></i> <?php echo e(date('F j, Y', strtotime($post['created_at']))); ?></div>
                                <h3><a href="<?php echo e($postUrl); ?>"><?php echo e($post['title']); ?></a></h3>
                                <a class="bl-btn bl-btn-primary" href="<?php echo e($postUrl); ?>">Read More</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- 12. CERTIFICATIONS & STANDARDS (light) -->
    <section class="bl-section bl-light" id="certifications">
        <div class="bl-container">
            <div class="bl-head center">
                <span class="bl-eyebrow">Trust &amp; Compliance</span>
                <h2 class="bl-title"><?php echo $L['certificationsTitle'] ?? 'Certifications &amp; <em>Standards</em>'; ?></h2>
                <span class="bl-title-rule"></span>
                <p class="bl-lead"><?php echo e($L['certificationsText'] ?? 'We maintain the highest global benchmarks for quality, confidentiality, and information security across New Zealand and Australia.'); ?></p>
            </div>
            <div class="bl-cert-grid">
                <?php 
                $certs = $L['certifications'] ?? [
                    [
                        'code'  => 'ISO 9001:2015',
                        'title' => 'Quality Management System',
                        'desc'  => 'Standardized multi-tier review workflows ensuring error-free accounts, reconciliations, and statutory filings.',
                        'icon'  => 'fa-award',
                        'badge' => 'Quality Assured',
                    ],
                    [
                        'code'  => 'ISO 27001:2022',
                        'title' => 'Information Security System',
                        'desc'  => 'Enterprise-grade encryption, role-based access controls, and secure offshore infrastructure protecting client data.',
                        'icon'  => 'fa-shield-alt',
                        'badge' => 'Information Security',
                    ],
                    [
                        'code'  => 'SOC 2 Type II',
                        'title' => 'Security & Confidentiality',
                        'desc'  => 'Independent third-party audits confirming continuous security, processing integrity, and data confidentiality.',
                        'icon'  => 'fa-user-shield',
                        'badge' => 'Audited Controls',
                    ],
                    [
                        'code'  => 'Privacy Act & GDPR',
                        'title' => 'Statutory Privacy Compliance',
                        'desc'  => 'Full compliance with the New Zealand Privacy Act 2020, Australian Privacy Principles (APPs), and strict bilateral NDAs.',
                        'icon'  => 'fa-file-shield',
                        'badge' => '100% Data Protection',
                    ],
                ];
                foreach ($certs as $c): ?>
                    <div class="bl-cert-card">
                        <div class="bl-cert-icon"><i class="fas <?php echo e($c['icon']); ?>"></i></div>
                        <h3 class="bl-cert-code"><?php echo e($c['code']); ?></h3>
                        <div class="bl-cert-subtitle"><?php echo e($c['title']); ?></div>
                        <p class="bl-cert-desc"><?php echo e($c['desc']); ?></p>
                        <span class="bl-cert-badge"><i class="fas fa-check-circle"></i> <?php echo e($c['badge']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 13. CLOSING CTA (cream) -->
    <section class="bl-band bl-light">
        <div class="bl-container bl-cta">
            <div>
                <h2 class="bl-title"><?php echo e($L['ctaTitle']); ?></h2>
                <p><?php echo e($L['ctaText']); ?></p>
            </div>
            <div class="bl-btn-row" style="margin-top: 0;">
                <a class="bl-btn bl-btn-primary" href="contact.php"><?php echo e($L['hero']['cta']); ?> <i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Tab Switching with Smooth Transition
    document.querySelectorAll('.bl [data-bl-tab]').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var key = tab.getAttribute('data-bl-tab');
            document.querySelectorAll('.bl [data-bl-tab]').forEach(function (t) {
                var on = t === tab;
                t.classList.toggle('active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            document.querySelectorAll('.bl [data-bl-panel]').forEach(function (p) {
                var isMatch = p.getAttribute('data-bl-panel') === key;
                p.hidden = !isMatch;
                if (isMatch) {
                    p.querySelectorAll('.bl-service-card').forEach(function (card) {
                        card.classList.add('is-revealed');
                    });
                }
            });
        });
    });

    // 2. High-Performance GPU Scroll-Reveal Animation Engine
    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        var revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        // Add stagger class to grid containers
        var gridContainers = document.querySelectorAll(
            '.bl-service-grid, .bl-software-grid, .bl-cert-grid, .bl-industry-grid, .bl-phase-grid, .bl-stats'
        );
        gridContainers.forEach(function (g) {
            g.classList.add('bl-reveal-stagger');
        });

        // Observe individual animatable elements
        var revealTargets = document.querySelectorAll(
            '.bl-head, .bl-serve-card, .bl-stat, .bl-service-card, .bl-industry, .bl-phase, .bl-software-card, .bl-review, .bl-blog, .bl-cert-card, .bl-form, .bl-why-list, .bl-faq'
        );

        revealTargets.forEach(function (el) {
            el.classList.add('bl-reveal');
            revealObserver.observe(el);
        });
    }
});
</script>
