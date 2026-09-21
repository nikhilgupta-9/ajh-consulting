<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Accounting & Bookkeeping';
$metaDescription = 'Accurate, reliable bookkeeping and accounting support for small businesses across New Zealand.';
$pageHeading     = 'Accounting & Bookkeeping';

$services = [];
$testimonials = [];
$faqs = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 3');
        $stmt->execute(['b' => 'bookkeeping']);
        $services = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 2');
        $stmt->execute(['b' => 'bookkeeping']);
        $testimonials = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 2');
        $stmt->execute(['b' => 'bookkeeping']);
        $faqs = $stmt->fetchAll();
    } catch (Throwable $e) {
        // Tables not migrated yet — page still renders with what it has.
    }
}

$whyPoints = [
    'Dedicated bookkeeping support tailored to your business',
    'Accurate, on-time monthly and tax reporting',
    'Straightforward, transparent pricing',
    'Local New Zealand team who understand IRD requirements',
];

$steps = [
    ['step' => '1', 'title' => 'Free Consultation',  'desc' => 'We learn about your business and what support you need.'],
    ['step' => '2', 'title' => 'Onboarding',          'desc' => 'We connect to your existing accounting systems and records.'],
    ['step' => '3', 'title' => 'Ongoing Bookkeeping', 'desc' => 'We handle day-to-day bookkeeping, reconciliation and reporting.'],
    ['step' => '4', 'title' => 'Monthly Reporting',   'desc' => 'You receive clear, regular reports on where your business stands.'],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <!-- 1. intro -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:800px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; New Zealand</span>
                    <h2 class="title mt--10">Smarter Bookkeeping for New Zealand Businesses</h2>
                    <p class="disc mt--20">We help small and medium businesses across New Zealand simplify their day-to-day bookkeeping, tax and payroll &mdash; so you can focus on running your business, not chasing numbers.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. services preview -->
    <div class="rts-service-area rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom:40px;">
                <div class="xl:w-2/3 px-[15px]">
                    <p class="pre-title">What We Offer</p>
                    <h2 class="title">Our Services</h2>
                </div>
                <div class="xl:w-1/3 px-[15px] text-right">
                    <a class='rts-read-more-two color-primary' href='services.php'>View All Services<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <?php if (empty($services)): ?>
                <p class="disc">Services will be listed here soon. Manage them from the admin panel &mdash; Services.</p>
            <?php else: ?>
                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($services as $service): ?>
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                        <div class="single-service-home-six" style="height:100%;">
                            <div class="inner">
                                <h3 class="title" style="font-size:19px;"><?php echo e($service['title']); ?></h3>
                                <?php if (!empty($service['short_description'])): ?>
                                    <p class="disc"><?php echo e($service['short_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 3. why choose us -->
    <div class="rts-about-area rts-section-gapBottom bg-team-color">
        <div class="container ptb--80">
            <div class="flex flex-wrap -mx-[15px]" style="margin-bottom:20px;">
                <div class="w-full px-[15px] text-center">
                    <h2 class="title">Why Choose Us</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($whyPoints as $point): ?>
                <div class="xl:w-1/2 px-[15px] pb--20">
                    <div class="single-business-solution">
                        <i class="far fa-check-circle color-primary" style="margin-right:12px;font-size:20px;"></i>
                        <p style="margin:0;display:inline;"><?php echo e($point); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="flex flex-wrap -mx-[15px]" style="margin-top:20px;">
                <div class="w-full px-[15px]">
                    <a class='rts-read-more-two color-primary' href='why-us.php'>See All Reasons<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. how it works -->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]" style="margin-bottom:40px;">
                <div class="w-full px-[15px] text-center">
                    <p class="pre-title">Getting Started</p>
                    <h2 class="title">How It Works</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($steps as $s): ?>
                <div class="xl:w-1/4 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <div class="single-service-home-six text-center" style="height:100%;">
                        <div class="inner">
                            <span class="color-primary" style="font-size:32px;font-weight:800;">0<?php echo e($s['step']); ?></span>
                            <h3 class="title" style="font-size:19px;margin-top:10px;"><?php echo e($s['title']); ?></h3>
                            <p class="disc"><?php echo e($s['desc']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($testimonials)): ?>
    <!-- 5. testimonials preview -->
    <div class="rts-client-feedback rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom:40px;">
                <div class="xl:w-2/3 px-[15px]">
                    <h2 class="title">What Our Clients Say</h2>
                </div>
                <div class="xl:w-1/3 px-[15px] text-right">
                    <a class='rts-read-more-two color-primary' href='client-stories.php'>All Client Stories<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($testimonials as $t): ?>
                <div class="xl:w-1/2 px-[15px] pb--30">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <?php if (!empty($t['photo'])): ?>
                                <div class="thumbnail"><img src="<?php echo e($t['photo']); ?>" alt="<?php echo e($t['client_name']); ?>" style="width:56px;height:56px;border-radius:50%;object-fit:cover;"></div>
                            <?php endif; ?>
                            <div class="name-desig" style="margin-left:<?php echo !empty($t['photo']) ? '20px' : '0'; ?>">
                                <h4 class="title"><?php echo e($t['client_name']); ?></h4>
                                <?php if (!empty($t['client_role'])): ?><span class="color-primary"><?php echo e($t['client_role']); ?></span><?php endif; ?>
                            </div>
                        </div>
                        <div class="test-body">
                            <p><?php echo e($t['quote']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($faqs)): ?>
    <!-- 6. faq preview -->
    <div class="rts-accordion-area service rts-section-gapBottom">
        <div class="container" style="max-width:900px;">
            <div class="rts-title-area text-center" style="margin-bottom:30px;">
                <p class="pre-title">Have Questions?</p>
                <h2 class="title">Frequently Asked Questions</h2>
            </div>
            <div class="accordion mt--10" id="bkHomeFaqAccordion">
                <?php foreach ($faqs as $i => $faq): $collapseId = 'bkHomeFaqCollapse' . $i; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="bkHomeFaqHeading<?php echo $i; ?>">
                            <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapseId; ?>">
                                <?php echo e($faq['question']); ?>
                            </button>
                        </h2>
                        <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="bkHomeFaqHeading<?php echo $i; ?>" data-bs-parent="#bkHomeFaqAccordion">
                            <div class="accordion-body"><?php echo e($faq['answer']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="margin-top:20px;text-align:center;">
                <a class='rts-read-more-two color-primary' href='faqs.php'>See All FAQs<i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- 7. final cta -->
    <div class="rts-cta-bg cta-one-bg">
        <div class="container">
            <div class="cta-one-inner">
                <div class="cta-left">
                    <h3 class="title">Ready to Simplify Your Books?</h3>
                    <p class="disc" style="color:#fff;">Get in touch and we'll take bookkeeping off your plate.</p>
                </div>
                <div class="cta-right">
                    <a class='rts-btn btn-primary' style="background:#fff;color:var(--color-primary);" href='<?php echo site_url("contactus.php"); ?>'>Contact Us</a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
