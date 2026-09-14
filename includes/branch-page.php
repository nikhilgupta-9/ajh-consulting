<?php
/**
 * Shared branch page body. The calling page must set these
 * variables and include header.php BEFORE requiring this file:
 *
 *   $branch          'bookkeeping' | 'firm_outsourcing'
 *   $pageHeading      e.g. 'Accounting & Bookkeeping'
 *   $introHeading     e.g. 'Smarter Bookkeeping for NZ Businesses'
 *   $introText        paragraph(s), plain text (will be escaped)
 *   $whyHeading       e.g. 'Why Choose Us'
 *   $whyPoints        array of short strings
 *   $ctaHeading       e.g. 'Ready to Get Started?'
 *   $ctaText          short paragraph
 */

$pdo = db();

$services = [];
$faqs = [];
$testimonials = [];

if ($pdo) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => $branch]);
        $services = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => $branch]);
        $faqs = $stmt->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => $branch]);
        $testimonials = $stmt->fetchAll();
    } catch (Throwable $e) {
        // Tables not migrated yet — page still renders with empty sections.
    }
}
?>

<!-- start breadcrumb area -->
<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
    <div class="container">
        <div class="flex flex-wrap -mx-[15px] items-center">
            <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                <h1 class="title"><?php echo e($pageHeading); ?></h1>
            </div>
            <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                <div class="bread-tag">
                    <a href='index.php'>Home</a>
                    <span> / </span>
                    <a class='active' href='#'><?php echo e($pageHeading); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->

<!-- intro area -->
<div class="rts-about-area rts-section-gap">
    <div class="container">
        <div class="flex flex-wrap -mx-[15px]">
            <div class="w-full px-[15px] text-center" style="max-width:900px;margin:0 auto;">
                <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; New Zealand</span>
                <h2 class="title mt--10"><?php echo e($introHeading); ?></h2>
                <p class="disc mt--20"><?php echo nl2br(e($introText)); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- end intro area -->

<?php if (!empty($services)): ?>
<!-- our services area -->
<div class="rts-service-area rts-section-gapBottom">
    <div class="container">
        <div class="flex flex-wrap -mx-[15px]">
            <div class="w-full px-[15px]">
                <div class="rts-title-area text-center">
                    <p class="pre-title">What We Offer</p>
                    <h2 class="title">Our Core Services</h2>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-[15px] mt--50">
            <?php foreach ($services as $service): ?>
            <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--40">
                <div class="single-service-home-six" style="height:100%;">
                    <div class="inner">
                        <h3 class="title"><?php echo e($service['title']); ?></h3>
                        <?php if (!empty($service['short_description'])): ?>
                            <p class="disc"><?php echo e($service['short_description']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($service['description'])): ?>
                            <div class="disc" style="margin-top:10px;"><?php echo $service['description']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- end our services area -->
<?php endif; ?>

<!-- why choose us area -->
<div class="rts-about-area rts-section-gapBottom bg-team-color">
    <div class="container ptb--80">
        <div class="flex flex-wrap -mx-[15px]">
            <div class="w-full px-[15px] text-center">
                <h2 class="title"><?php echo e($whyHeading); ?></h2>
            </div>
        </div>
        <div class="flex flex-wrap -mx-[15px] mt--40">
            <?php foreach ($whyPoints as $point): ?>
            <div class="xl:w-1/2 px-[15px] pb--20">
                <div class="single-business-solution">
                    <i class="far fa-check-circle color-primary" style="margin-right:12px;font-size:20px;"></i>
                    <p style="margin:0;"><?php echo e($point); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- end why choose us area -->

<?php if (!empty($testimonials)): ?>
<!-- testimonials area -->
<div class="rts-client-feedback rts-section-gap">
    <div class="container">
        <div class="flex flex-wrap -mx-[15px]">
            <div class="w-full px-[15px] text-center">
                <h2 class="title">What Our Clients Say</h2>
            </div>
        </div>
        <div class="flex flex-wrap -mx-[15px] mt--40">
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
<!-- end testimonials area -->
<?php endif; ?>

<?php if (!empty($faqs)): ?>
<!-- faq area -->
<div class="rts-accordion-area service rts-section-gapBottom">
    <div class="container" style="max-width:900px;">
        <div class="rts-title-area text-center">
            <p class="pre-title">Have Questions?</p>
            <h2 class="title">Frequently Asked Questions</h2>
        </div>
        <div class="accordion mt--40" id="branchFaqAccordion">
            <?php foreach ($faqs as $i => $faq): $collapseId = 'faqCollapse' . $i; ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading<?php echo $i; ?>">
                        <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapseId; ?>">
                            <?php echo e($faq['question']); ?>
                        </button>
                    </h2>
                    <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="faqHeading<?php echo $i; ?>" data-bs-parent="#branchFaqAccordion">
                        <div class="accordion-body"><?php echo e($faq['answer']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- end faq area -->
<?php endif; ?>

<!-- cta area -->
<div class="rts-cta-bg cta-one-bg">
    <div class="container">
        <div class="cta-one-inner">
            <div class="cta-left">
                <h3 class="title"><?php echo e($ctaHeading); ?></h3>
                <p class="disc" style="color:#fff;"><?php echo e($ctaText); ?></p>
            </div>
            <div class="cta-right">
                <a class='rts-btn btn-primary' style="background:#fff;color:var(--color-primary);" href='contactus.php'>Contact Us</a>
            </div>
        </div>
    </div>
</div>
<!-- end cta area -->
