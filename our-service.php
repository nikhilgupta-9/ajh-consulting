<?php
require_once __DIR__ . '/config/config.php';

$services = [];
if ($pdo = db()) {
    try {
        $services = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {
        $services = [];
    }
}

$pageTitle       = 'Our Services';
$metaDescription = 'Explore the business, tax, financial planning and audit services offered by AJH Consulting.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Our Services</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='our-service.php'>Our Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <!-- our service area start -->
    <div class="rts-service-area rts-section-gapTop pb--200 service-two-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] service padding-controler">
                <?php
                $__images = ['02', '03', '04'];
                $__i = 0;
                foreach ($services as $service):
                    $__thumbClass = $__i === 0 ? '' : ($__i === 1 ? 'two' : 'three');
                    $__img = $__images[$__i % count($__images)];
                    $__i++;
                ?>
                <!-- single service area -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--140 pb_md--100">
                    <div class="service-two-inner">
                        <a class='thumbnail <?php echo $__thumbClass; ?>' href='service-details.php?slug=<?php echo urlencode($service['slug']); ?>'><img src="<?php echo e($service['image'] ?: 'assets/images/service/' . $__img . '.jpg'); ?>" alt="<?php echo e($service['title']); ?>"></a>
                        <div class="body-content">
                            <div class="hidden-area">
                                <h3 class="title"><?php echo e($service['title']); ?></h3>
                                <p class="dsic">
                                    <?php echo e($service['short_description']); ?>
                                </p>
                                <a class='rts-read-more-two color-primary' href='service-details.php?slug=<?php echo urlencode($service['slug']); ?>'>Read More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single service area end-->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- our service area end -->

    <!-- service accordion area -->
    <div class="rts-accordion-area service rts-section-gap">
        <div class="accordion-service-bg bg_image ptb--120 ptb_md--80 ptb_sm--60">
            <div class="container">
                <div class="flex flex-wrap -mx-[15px]">
                    <div class="xl:w-1/2 px-[15px]">
                        <div class="accordion-service-inner">
                            <div class="title-area-start">
                                <span class="sub color-primary">JUST A CONSULTANCY</span>
                                <h2 class="title">We know how to manage
                                    business globally</h2>
                            </div>
                            <div class="accordion-area">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Making Easy Business Growth
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Business Solution Model
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Finbiz Company Solution
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Management Process
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Managing Invesment
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Neque parturient sed nascetur facilisis suscipit ridiculus magna lobortis imperdiet vivamus est aliquam euismod nec quam convallis ornare justo
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service accordion area End -->

    <!-- start pricing area -->
    <div class="rts-pricing-area rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-title-area pricing-planes text-center">
                        <p class="pre-title">
                            What We Offer
                        </p>
                        <h2 class="title">Packages & Pricing</h2>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--50">
                <!-- single pricing plane -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="pricing-wrapper-one">
                        <div class="plane-process">
                            <span>/month</span>
                            <h3 class="title h5">$260</h3>
                        </div>
                        <!-- pricing header -->
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Starter Package</span>
                            <h3 class="title h5">
                                Basic Plan
                            </h3>
                        </div>
                        <!-- pricing header End -->
                        <!-- pricing body start -->
                        <div class="pricing-body">
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Business Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Great Customer Support</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Market Growth Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <a class='rts-btn btn-primary' href='contactus.php'>Buy This</a>
                        </div>
                        <!-- pricing body end -->
                    </div>
                </div>
                <!-- single pricing plane -->
                <!-- single pricing plane -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full mt_sm--80">
                    <div class="pricing-wrapper-one">
                        <div class="plane-process">
                            <span>/month</span>
                            <h3 class="title h5">$260</h3>
                        </div>
                        <!-- pricing header -->
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Starter Package</span>
                            <h3 class="title h5">
                                Basic Plan
                            </h3>
                        </div>
                        <!-- pricing header End -->
                        <!-- pricing body start -->
                        <div class="pricing-body">
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Business Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Great Customer Support</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Market Growth Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <a class='rts-btn btn-primary' href='contactus.php'>Buy This</a>
                        </div>
                        <!-- pricing body end -->
                    </div>
                </div>
                <!-- single pricing plane -->
                <!-- single pricing plane -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full mt_md--80 mt_sm--80">
                    <div class="pricing-wrapper-one">
                        <div class="plane-process">
                            <span>/month</span>
                            <h3 class="title h5">$260</h3>
                        </div>
                        <!-- pricing header -->
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Starter Package</span>
                            <h3 class="title h5">
                                Basic Plan
                            </h3>
                        </div>
                        <!-- pricing header End -->
                        <!-- pricing body start -->
                        <div class="pricing-body">
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Business Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing available">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Great Customer Support</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">Market Growth Solution</span>
                            </div>
                            <!-- single pricing End -->
                            <!-- single pricing -->
                            <div class="single-pricing">
                                <div class="icon">
                                    <i class="far fa-check"></i>
                                </div>
                                <span class="price-details">24/7 Consultant Service</span>
                            </div>
                            <!-- single pricing End -->
                            <a class='rts-btn btn-primary' href='contactus.php'>Buy This</a>
                        </div>
                        <!-- pricing body end -->
                    </div>
                </div>
                <!-- single pricing plane -->
            </div>
        </div>
    </div>
    <!-- end pricing area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
