<?php
require_once __DIR__ . '/config/config.php';

$teamMembers = [];
if ($pdo = db()) {
    try {
        $teamMembers = $pdo->query('SELECT * FROM team_members ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {
        $teamMembers = [];
    }
}

$pageTitle       = 'Our Team';
$metaDescription = 'Meet the get-accountant team of business, tax and financial experts.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Our Team</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='team.php'>Our Team</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <!-- team area start-->
    <div class="rts-team-area rts-section-gap bg-team-color">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <?php
                $__photos = ['06', '07', '08', '09', '10', '11', '12', '13'];
                $__i = 0;
                foreach ($teamMembers as $member):
                    $__photo = $__photos[$__i % count($__photos)];
                    $__i++;
                ?>
                <!-- team single start -->
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <div class="team-single-one-start">
                        <div class="team-image-area">
                            <a href='team.php'>
                                <img src="<?php echo e($member['photo'] ?: 'assets/images/team/tm/' . $__photo . '.jpg'); ?>" alt="<?php echo e($member['name']); ?>">
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
                            <a href='team.php'>
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
