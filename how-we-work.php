<?php
require_once __DIR__ . '/config/config.php';

$content = ['heading' => 'How We Work', 'subheading' => 'OUR PROCESS', 'body' => '', 'image' => ''];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'how-we-work']);
        $found = $stmt->fetch();
        if ($found) {
            $content = $found;
        }
    } catch (Throwable $e) {
        // page_content not migrated yet — fall back to the defaults above.
    }
}

$pageTitle       = $content['heading'] ?: 'How We Work';
$metaDescription = $content['body'] ? mb_substr(strip_tags($content['body']), 0, 160) : 'Our simple, transparent process for working with clients.';

require __DIR__ . '/includes/header.php';

$steps = [
    ['01', 'Get in Touch', 'Reach out via our contact form, phone or WhatsApp and tell us what you need.'],
    ['02', 'Free Consultation', 'We learn about your business or firm and recommend the right services.'],
    ['03', 'Onboarding', 'We set up your bookkeeping, tax or outsourcing workflow — usually within 1-2 weeks.'],
    ['04', 'Ongoing Support', 'You get regular reporting and a dedicated point of contact for anything you need.'],
];
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">How We Work</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='how-we-work.php'>How We Work</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- hero intro -->
    <div class="rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:760px; margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase; font-weight:700; letter-spacing:.1em;"><?php echo e($content['subheading']); ?></span>
                    <h2 class="title mt--10"><?php echo e($content['heading']); ?></h2>
                    <?php if ($content['body']): ?>
                        <p class="disc mt--15"><?php echo e($content['body']); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- process steps -->
            <div class="how-we-work-steps">
                <?php foreach ($steps as $step): ?>
                    <div class="how-we-work-step">
                        <span class="how-we-work-step-num"><?php echo e($step[0]); ?></span>
                        <h3><?php echo e($step[1]); ?></h3>
                        <p><?php echo e($step[2]); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <style>
        .how-we-work-steps { display:grid; grid-template-columns:repeat(4,1fr); gap:28px; margin-top:60px; }
        .how-we-work-step { text-align:center; padding:32px 20px; border:1px solid #eee; border-radius:12px; position:relative; }
        .how-we-work-step-num { display:inline-flex; align-items:center; justify-content:center; width:52px; height:52px; border-radius:50%; background:var(--color-primary); color:#fff; font-weight:700; margin-bottom:18px; }
        .how-we-work-step h3 { font-size:18px; margin-bottom:10px; }
        .how-we-work-step p { color:#6b7091; font-size:14px; line-height:1.7; margin:0; }
        @media (max-width:991px) { .how-we-work-steps { grid-template-columns:1fr 1fr; } }
        @media (max-width:576px) { .how-we-work-steps { grid-template-columns:1fr; } }
    </style>

<?php require __DIR__ . '/includes/footer.php'; ?>
