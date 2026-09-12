<?php
require_once __DIR__ . '/config/config.php';

$allServices = [];
$service     = null;

if ($pdo = db()) {
    try {
        $allServices = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();

        $slug = $_GET['slug'] ?? null;
        if ($slug) {
            $stmt = $pdo->prepare('SELECT * FROM services WHERE slug = :slug LIMIT 1');
            $stmt->execute(['slug' => $slug]);
            $service = $stmt->fetch() ?: null;
        }
        if (!$service && !empty($allServices)) {
            $service = $allServices[0];
        }
    } catch (Throwable $e) {
        $allServices = [];
    }
}

// Fallback so the page still renders sensibly if the DB has no data yet.
if (!$service) {
    $service = [
        'title'             => 'Business Consulting',
        'slug'              => 'business-consulting',
        'short_description' => 'Strategic advice to help your business grow and scale efficiently.',
        'description'       => 'Add your services from the admin panel to replace this placeholder text.',
        'image'             => null,
    ];
    $allServices = [$service];
}

$pageTitle       = $service['title'];
$metaDescription = $service['short_description'] ?? ('Learn more about our ' . $service['title'] . ' service.');

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title"><?php echo e($service['title']); ?></h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='service-details.php'><?php echo e($service['title']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="xl:w-2/3 px-[15px] md:w-full sm:w-full w-full">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">
                        <div class="thumbnail">
                            <img src="<?php echo e($service['image'] ?: 'assets/images/service/01.jpg'); ?>" alt="<?php echo e($service['title']); ?>">
                        </div>
                        <h2 class="title"><?php echo e($service['title']); ?></h2>
                        <p class="disc">
                            <?php echo nl2br(e($service['description'] ?: $service['short_description'] ?? '')); ?>
                        </p>
                        <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--30 mb--40">
                            <div class="lg:w-1/2 px-[15px]">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="assets/images/service/icon/09.svg" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h3 class="title">Instant Business Growth</h3>
                                        <p class="disc">Maintain wireless scerios after sure quality vectors future</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="lg:w-1/2 px-[15px]">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="assets/images/service/icon/10.svg" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h3 class="title">24/7 Quality Service</h3>
                                        <p class="disc">Maintain wireless scerios after sure quality vectors future</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="lg:w-1/2 px-[15px]">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="assets/images/service/icon/11.svg" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h3 class="title">Easy Customer Service</h3>
                                        <p class="disc">Maintain wireless scerios after sure quality vectors future</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="lg:w-1/2 px-[15px]">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="assets/images/service/icon/12.svg" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h3 class="title">Quality Cost Service</h3>
                                        <p class="disc">Maintain wireless scerios after sure quality vectors future</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                        </div>
                        <p class="disc">
                            Phosfluorescently maintain wireless scenarios after intermandated applications. Conveniently
                            unique predominate revolutionary quality vectors through future-proof manufactured products.
                            Objectively envisioneer high solution convergence through collaborative networks.
                            Interactively generate B2C e-tailers for business data restore fully researched
                            relationships through resource maximizing results.
                        </p>
                    </div>
                    <div class="service-detials-step-2 mt--40">
                        <h3 class="title">3 Simple Steps to Process</h3>
                        <p class="disc mb--25">
                            Assertively e-enable catalysts for change before fully tested markets. Phosfluo rescently is
                            maintain solve wireless scenarios after intermandated applications. Conveniently predominate
                            busin revolutionary quality vectors through future-proof manufactured products.
                            Enthusiastically transform distinctive collaboration.
                        </p>
                        <p class="disc">
                            Phosfluorescently maintain wireless scenarios after intermandated applications. Conveniently
                            predominate misslat revolutionary quality vectors through future-proof manufactured
                            products.
                        </p>
                        <!-- stem-area start -->
                        <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mb--40 mb_md--20 mb_sm--20">
                            <div class="lg:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                                <div class="single-service-step text-center">
                                    <p class="step">01</p>
                                    <h3 class="title h6">
                                        STEP ONE
                                    </h3>
                                    <p class="disc">
                                        Tactical services through market web services
                                    </p>
                                </div>
                            </div>
                            <div class="lg:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                                <div class="single-service-step text-center">
                                    <p class="step">02</p>
                                    <h3 class="title h6">
                                        STEP TWO
                                    </h3>
                                    <p class="disc">
                                        Tactical services through market web services
                                    </p>
                                </div>
                            </div>
                            <div class="lg:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                                <div class="single-service-step text-center">
                                    <p class="step">03</p>
                                    <h3 class="title h6">
                                        STEP THREE
                                    </h3>
                                    <p class="disc">
                                        Tactical services through market web services
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="disc">
                            Conveniently predominate revolutionary quality vectors through future-proof manufactured
                            products. Objectively envisioneer high in convergence through collaborative networks.
                            Interactively generate B2C tailers for business data restore fully researched relationships
                            through
                        </p>
                        <!-- stem-area End -->
                    </div>
                    <!-- service details left area end -->
                    <div class="service-detials-step-3 mt--70 mt_md--50">
                        <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] items-center">
                            <div class="xl:w-1/2 px-[15px] lg:w-full md:w-full sm:w-full w-full">
                                <div class="thumbnail sm-thumb-service">
                                    <img src="assets/images/service/sm-01.jpg" alt="Service">
                                </div>
                            </div>
                            <div class="xl:w-1/2 px-[15px] lg:w-full md:w-full sm:w-full w-full mb_md--20 mb_sm--20">
                                <h3 class="title">Customer Benefits</h3>
                                <p class="disc">Catalysts for change before fully tested markets are maintain wireless
                                    scenarios after intermandated applications predominate revolutionary.</p>
                                <div class="single-banifits">
                                    <i class="far fa-check-circle"></i>
                                    <span>We use the latest diagnostic equipment</span>
                                </div>
                                <div class="single-banifits">
                                    <i class="far fa-check-circle"></i>
                                    <span>We are a member of Professional Service</span>
                                </div>
                                <div class="single-banifits">
                                    <i class="far fa-check-circle"></i>
                                    <span>Automotive service our clients receive</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--rts blog wizered area -->
                <div class="xl:w-1/3 px-[15px] md:w-full sm:w-full w-full mt_lg--60 pl--50 pl_md--0 pl-lg-controler pl_sm--0">
                    <!-- single wizered start -->
                    <div class="rts-single-wized Categories service">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Categories
                            </h3>
                        </div>
                        <div class="wized-body">
                            <?php foreach ($allServices as $svc): ?>
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php?slug=<?php echo urlencode($svc['slug']); ?>'<?php echo $svc['slug'] === $service['slug'] ? " class='active'" : ''; ?>><?php echo e($svc['title']); ?> <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- single wizered End -->
                    <!-- single wizered start -->
                    <div class="rts-single-wized download service">
                        <div class="wized-header">
                            <h3 class="title h5">Download</h3>
                        </div>
                        <div class="wized-body">
                            <!-- single downlaod area start -->
                            <div class="single-download-area">
                                <img src="assets/images/service/icon/07.svg" alt="Business_downlaod">
                                <div class="mid">
                                    <h3 class="title">
                                        Our Brochures
                                    </h3>
                                    <span>Downlaod</span>
                                </div>
                                <a class='rts-btn btn-primary' href='service-details.php'><i class="fal fa-arrow-right"></i></a>
                            </div>
                            <!-- single downlaod area End -->
                            <!-- single downlaod area start -->
                            <div class="single-download-area">
                                <img src="assets/images/service/icon/08.svg" alt="Business_downlaod">
                                <div class="mid">
                                    <h3 class="title">
                                        Company Details
                                    </h3>
                                    <span>Downlaod</span>
                                </div>
                                <a class='rts-btn btn-primary' href='service-details.php'><i class="fal fa-arrow-right"></i></a>
                            </div>
                            <!-- single downlaod area End -->
                        </div>
                    </div>
                    <!-- single wizered End -->
                    <!-- single wizered start -->
                    <div class="rts-single-wized contact service">
                        <div class="wized-header">
                            <a href='about-us.php'><img src="assets/images/logo/logo-2.svg" alt="Business_logo"></a>
                        </div>
                        <div class="wized-body">
                            <h3 class="title">Need Help? We Are Here
                                To Help You</h3>
                            <a class='rts-btn btn-primary' href='contactus.php'>Contact Us</a>
                        </div>
                    </div>
                    <!-- single wizered End -->
                </div>
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
    <!-- End service details area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
