<?php
require_once __DIR__ . '/config/config.php';

$content = ['heading' => 'Our Peoples', 'subheading' => 'MEET THE TEAM', 'body' => '', 'image' => ''];
$teamMembers = [];

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'our-peoples']);
        $found = $stmt->fetch();
        if ($found) {
            $content = $found;
        }
    } catch (Throwable $e) {
        // page_content not migrated yet — fall back to the defaults above.
    }

    try {
        $teamMembers = $pdo->query('SELECT * FROM team_members ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {
        $teamMembers = [];
    }
}

$pageTitle       = $content['heading'] ?: 'Our Peoples';
$metaDescription = $content['body'] ? mb_substr(strip_tags($content['body']), 0, 160) : 'Meet the people behind our business.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Our Peoples</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='our-peoples.php'>Our Peoples</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- hero intro -->
    <div class="rts-section-gapTop">
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
        </div>
    </div>

    <!-- team area start-->
    <div class="rts-team-area rts-section-gap bg-team-color">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <?php if (empty($teamMembers)): ?>
                    <div class="w-full px-[15px] text-center" style="padding:40px 0; color:#6b7091;">
                        Add team members from Admin &rarr; Team to show them here.
                    </div>
                <?php endif; ?>
                <?php
                $photos = ['06', '07', '08', '09', '10', '11', '12', '13'];
                $i = 0;
                foreach ($teamMembers as $member):
                    $photo = $photos[$i % count($photos)];
                    $i++;
                ?>
                <!-- team single start -->
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <div class="team-single-one-start">
                        <div class="team-image-area">
                            <a href='our-peoples.php'>
                                <img src="<?php echo e($member['photo'] ?: 'assets/images/team/tm/' . $photo . '.jpg'); ?>" alt="<?php echo e($member['name']); ?>">
                                <div class="team-social">
                                    <div class="main">
                                        <i class="fal fa-plus"></i>
                                    </div>
                                    <div class="team-social-one">
                                        <?php if (!empty($member['facebook'])): ?><a href="<?php echo e($member['facebook']); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                                        <?php if (!empty($member['twitter'])): ?><a href="<?php echo e($member['twitter']); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a><?php endif; ?>
                                        <?php if (!empty($member['instagram'])): ?><a href="<?php echo e($member['instagram']); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a><?php endif; ?>
                                        <?php if (!empty($member['linkedin'])): ?><a href="<?php echo e($member['linkedin']); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="single-details">
                            <a href='our-peoples.php'>
                                <h3 class="title h5"><?php echo e($member['name']); ?></h3>
                            </a>
                            <p><?php echo e($member['designation']); ?></p>
                        </div>
                    </div>
                </div>
                <!-- team single end -->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- team area End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
