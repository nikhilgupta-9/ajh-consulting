<?php
/**
 * Shared branch home page — ONE template used by both audience folders
 * (accounting / accounting-firm) so there is only one design to
 * maintain instead of a bespoke page per folder. The calling page sets
 * these variables and requires header.php + breadcrumb.php + the
 * matching subnav BEFORE requiring this file:
 *
 *   $country       'nz' | 'au'
 *   $branch        'bookkeeping' | 'firm_outsourcing'
 *   $introHeading   e.g. 'Smarter Bookkeeping for New Zealand Businesses'
 *   $introText      one paragraph
 *   $whyHeading     e.g. 'Why Choose Us'
 *   $whyPoints      array of short strings
 *   $steps          array of ['step' => '1', 'title' => '...', 'desc' => '...'] (How It Works)
 *   $ctaHeading     e.g. 'Ready to Get Started?'
 *   $ctaText        short paragraph
 */

$countryLabel = $country === 'au' ? 'Australia' : 'New Zealand';
$folder       = $branch === 'firm_outsourcing' ? 'accounting-firm' : 'accounting';
$branchBase   = site_url("$country/$folder/");

$services = [];
$faqs = [];
$testimonials = [];

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 3');
        $stmt->execute(['b' => $branch]);
        $services = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 2');
        $stmt->execute(['b' => $branch]);
        $testimonials = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC LIMIT 2');
        $stmt->execute(['b' => $branch]);
        $faqs = $stmt->fetchAll();
    } catch (Throwable $e) {
        // Tables not migrated yet — page still renders with what it has.
    }
}
?>

    <!-- 1. intro -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:850px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; <?php echo e($countryLabel); ?></span>
                    <h2 class="title mt--10"><?php echo e($introHeading); ?></h2>
                    <p class="disc mt--20"><?php echo nl2br(e($introText)); ?></p>
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
                    <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>services.php'>View All Services<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <?php if (empty($services)): ?>
                <p class="disc">Services will be listed here soon. Manage them from the admin panel &mdash; Services.</p>
            <?php elseif ($branch === 'bookkeeping'): ?>
                <!-- icon cards, matching nz/accounting/services.php -->
                <div class="flex flex-wrap -mx-[15px]">
                    <?php
                    $__icons = ['01', '02', '03', '04', '05', '06', '07', '08'];
                    $__variants = ['one', 'two', 'three', 'four'];
                    $__i = 0;
                    foreach ($services as $service):
                        $__icon = $__icons[$__i % count($__icons)];
                        $__variant = $__variants[$__i % count($__variants)];
                        $__detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                        $__i++;
                    ?>
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                        <div class="service-one-inner <?php echo e($__variant); ?>" style="height:100%;">
                            <div class="thumbnail">
                                <img src="<?php echo site_url('assets/images/service/icon/' . $__icon . '.svg'); ?>" alt="<?php echo e($service['title']); ?>">
                            </div>
                            <div class="service-details">
                                <a href='<?php echo e($__detailUrl); ?>'>
                                    <h3 class="title h5"><?php echo e($service['title']); ?></h3>
                                </a>
                                <?php if (!empty($service['short_description'])): ?>
                                    <p class="disc"><?php echo e($service['short_description']); ?></p>
                                <?php endif; ?>
                                <a class='rts-read-more btn-primary' href='<?php echo e($__detailUrl); ?>'><i class="far fa-arrow-right"></i>Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- compact photo cards, matching nz/accounting-firm/services.php -->
                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                    <?php
                    $__photos = ['10', '11', '12', '13'];
                    $__i = 0;
                    foreach ($services as $service):
                        $__photo = $__photos[$__i % count($__photos)];
                        $__detailUrl = site_url('service-details.php') . '?slug=' . urlencode($service['slug']);
                        $__i++;
                    ?>
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                        <div class="rts-single-service-h2 inner" style="height:100%;">
                            <a class='thumbnail' href='<?php echo e($__detailUrl); ?>'>
                                <img src="<?php echo e($service['image'] ?: site_url('assets/images/service/' . $__photo . '.jpg')); ?>" alt="<?php echo e($service['title']); ?>">
                            </a>
                            <div class="body">
                                <a href='<?php echo e($__detailUrl); ?>'>
                                    <h3 class="title"><?php echo e($service['title']); ?></h3>
                                </a>
                                <?php if (!empty($service['short_description'])): ?>
                                    <p class="disc"><?php echo e($service['short_description']); ?></p>
                                <?php endif; ?>
                                <a class='btn-red-more' href='<?php echo e($__detailUrl); ?>'>Learn More<i class="fas fa-arrow-right"></i></a>
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
                    <h2 class="title"><?php echo e($whyHeading); ?></h2>
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
            <?php if ($branch === 'bookkeeping'): ?>
            <div class="flex flex-wrap -mx-[15px]" style="margin-top:20px;">
                <div class="w-full px-[15px]">
                    <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>why-us.php'>See All Reasons<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <?php else: ?>
            <div class="flex flex-wrap -mx-[15px]" style="margin-top:20px;">
                <div class="w-full px-[15px]">
                    <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>why-partner.php'>See Why Firms Partner With Us<i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($steps)): ?>
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
    <?php endif; ?>

    <?php if (!empty($testimonials)): ?>
    <!-- 5. testimonials preview -->
    <div class="rts-client-feedback rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-end" style="margin-bottom:40px;">
                <div class="xl:w-2/3 px-[15px]">
                    <h2 class="title">What Our Clients Say</h2>
                </div>
                <?php if ($branch === 'bookkeeping'): ?>
                <div class="xl:w-1/3 px-[15px] text-right">
                    <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>client-stories.php'>All Client Stories<i class="far fa-arrow-right"></i></a>
                </div>
                <?php else: ?>
                <div class="xl:w-1/3 px-[15px] text-right">
                    <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>case-studies.php'>All Case Studies<i class="far fa-arrow-right"></i></a>
                </div>
                <?php endif; ?>
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
            <div class="accordion mt--10" id="branchHomeFaqAccordion">
                <?php foreach ($faqs as $i => $faq): $collapseId = 'branchHomeFaqCollapse' . $i; ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="branchHomeFaqHeading<?php echo $i; ?>">
                            <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapseId; ?>">
                                <?php echo e($faq['question']); ?>
                            </button>
                        </h2>
                        <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="branchHomeFaqHeading<?php echo $i; ?>" data-bs-parent="#branchHomeFaqAccordion">
                            <div class="accordion-body"><?php echo e($faq['answer']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="margin-top:20px;text-align:center;">
                <a class='rts-read-more-two color-primary' href='<?php echo e($branchBase); ?>faqs.php'>See All FAQs<i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- 7. final cta -->
    <div class="rts-cta-bg cta-one-bg">
        <div class="container">
            <div class="cta-one-inner">
                <div class="cta-left">
                    <h3 class="title"><?php echo e($ctaHeading); ?></h3>
                    <p class="disc" style="color:#fff;"><?php echo e($ctaText); ?></p>
                </div>
                <div class="cta-right">
                    <a class='rts-btn btn-primary' style="background:#fff;color:var(--color-primary);" href='<?php echo site_url("contactus.php"); ?>'>Contact Us</a>
                </div>
            </div>
        </div>
    </div>
