<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'About Us';
$metaDescription = 'Learn more about AJH Consulting - our mission, values and expert team.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">About Us</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='about-us.php'>About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts about us section start -->
    <div class="rts-about-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] items-center">
                <div class="lg:w-1/2 px-[15px]">
                    <div class="about-image-v-inner">
                        <div class="image-area">
                            <img class="mt--110 img-1" src="assets/images/about/main/about-03.jpg" alt="BUsiness_image">
                            <img class="img-over" src="assets/images/about/main/about-04.jpg" alt="BUsiness_image">
                            <div class="goal-button-wrapper">
                                <div class="vedio-icone">
                                    <a id="play-video" class="video-play-button" href="https://www.youtube.com/watch?v=6stlCkUDG_s">
                                        <span></span>
                                    </a>
                                    <div id="video-overlay" class="video-overlay">
                                        <a href="javascript:void(0)" class="video-overlay-close">×</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 px-[15px]">
                    <div class="about-progress-inner">
                        <div class="title-area">
                            <span>JUST A CONSULTANCY</span>
                            <h2 class="title">Get Consulting For Better
                                Business Growth</h2>
                        </div>
                        <!-- inner start -->
                        <div class="inner">
                            <p class="disc">Dapibus curae risus rutrum curabitur nunc sociis nullam nisl, aliquet quis
                                iaculis scelerisque primis massa imperdiet, dis senectus blandit aptent nulla cubilia
                                sodales convallis tortor pellentesque nulla.</p>
                            <div class="rts-progress-one-wrapper">
                                <div class="single-progress">
                                    <div class="progress-top">
                                        <p class="progress-title">Business Strategy</p>
                                        <span class="persectage">70%</span>
                                    </div>
                                    <div class="meter cadetblue">
                                        <span data-progress="70" style="width:0;"></span>
                                    </div>
                                </div>
                                <div class="single-progress">
                                    <div class="progress-top">
                                        <p class="progress-title">Company Strength</p>
                                        <span class="persectage">93%</span>
                                    </div>
                                    <div class="meter">
                                        <span data-progress="93" style="width:0;"></span>
                                    </div>
                                </div>
                            </div>
                            <a class='rts-btn btn-primary' href='appoinment.php'>Make an Appointment</a>
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts about us section end -->

    <!-- rts services area start -->
    <div class="rts-service-area rts-section-gapBottom">
        <div class="w-full px-[15px] service-main about-service-width-controler">
            <div class="background-service service-three flex flex-wrap -mx-[15px]">
                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                    <div class="rts-title-area service-four text-center pt--40 pt_md--0 mt_sm--0 mt_md--0">
                        <p class="pre-title">
                            Our Services
                        </p>
                        <h2 class="title">What We Provide</h2>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80 mb_md--40 mb_sm--30">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='service-details.php'>
                                    <img src="assets/images/service/07.jpg" alt="Business-service">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/13.svg" alt="Business-icon">
                                    <h3 class="title h5">Business Consultancy</h3>
                                    <p class="disc">Aenean augue venenatis est porttitor fames aptent lobortis nam
                                        potenti</p>
                                </div>
                                <a class='over_link' href='service-details.php'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='service-details.php'> Read More<i
                                    class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80 mb_md--40 mb_sm--30">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='service-details.php'>
                                    <img src="assets/images/service/08.jpg" alt="Business-service">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/14.svg" alt="Business-icon">
                                    <h3 class="title h5">Business Appoinment</h3>
                                    <p class="disc">Aenean augue venenatis est porttitor fames aptent lobortis nam
                                        potenti</p>
                                </div>
                                <a class='over_link' href='service-details.php'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='service-details.php'> Read More<i
                                    class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='service-details.php'>
                                    <img src="assets/images/service/09.jpg" alt="Business-service">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/15.svg" alt="Business-icon">
                                    <h3 class="title h5">Consultancy Foundation</h3>
                                    <p class="disc">Aenean augue venenatis est porttitor fames aptent lobortis nam
                                        potenti</p>
                                </div>
                                <a class='over_link' href='service-details.php'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='service-details.php'> Read More<i
                                    class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <div class="cta-one-bg w-full px-[15px]">
                    <div class="cta-one-inner">
                        <div class="cta-left">
                            <h3 class="title animated fadeIn">Let’s discuss about how we can help
                                make your business better</h3>
                        </div>
                        <div class="cta-right">
                            <a class='rts-btn btn-white' href='contactus.php'>Lets Work Togather</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts services area End -->

    <!-- rts team two area -->
    <div class="rts-team-area rts-section-gapBottom appoinment-team team-two">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-title-area team text-center">
                        <p class="pre-title">
                            Professionals Team
                        </p>
                        <h2 class="title">Professionals Team</h2>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--15 mt_sm--0">
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <!-- single team inner -->
                    <div class="team-inner-two">
                        <a class='thumbnail' href='team.php'>
                            <img src="assets/images/team/tm/lg-01.jpg" alt="">
                        </a>
                        <!-- Acquaintance area -->
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='team.php'>
                                    <h3 class="title h5">Kevin Martin</h3>
                                </a>
                                <span>Consultant</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <!-- Acquaintance area -->
                    </div>
                    <!-- single team inner End -->
                </div>
                <!-- single team End -->
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <!-- single team inner -->
                    <div class="team-inner-two">
                        <a class='thumbnail' href='team.php'>
                            <img src="assets/images/team/tm/lg-02.jpg" alt="">
                        </a>
                        <!-- Acquaintance area -->
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='team.php'>
                                    <h3 class="title h5">Martin Jone</h3>
                                </a>
                                <span>Manager</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <!-- Acquaintance area -->
                    </div>
                    <!-- single team inner End -->
                </div>
                <!-- single team End -->
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <!-- single team inner -->
                    <div class="team-inner-two">
                        <a class='thumbnail' href='team.php'>
                            <img src="assets/images/team/tm/lg-03.jpg" alt="">
                        </a>
                        <!-- Acquaintance area -->
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='team.php'>
                                    <h3 class="title h5">Jone Lee</h3>
                                </a>
                                <span>CEO</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <!-- Acquaintance area -->
                    </div>
                    <!-- single team inner End -->
                </div>
                <!-- single team End -->
            </div>
        </div>
    </div>
    <!-- rts team two area End -->

    <!-- rts faq section area -->
    <div class="rts-faq-section rts-section-gap rts-faq-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="lg:w-1/2 px-[15px]">
                    <div class="faq-two-inner">
                        <div class="title-area-faq">
                            <span class="sub">WHY CHOOSE US</span>
                            <h2 class="title">We Are Experienced
                                <span class="sm-title">Business <span>Solution</span></span>
                            </h2>
                        </div>
                        <!-- faq accordion area -->
                        <div class="faq-accordion-area">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span>01. </span> What should i included my personal details?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Neque partrient nascetur facilisis suscipit ridiculus agna lobortis
                                            imperdiet vivamus est aliquam euismod nector quam convallis ornare justo
                                            service lifereu visionary sources unleash online businesss solutions
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span>02. </span> Where i can find my business growth result?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Neque partrient nascetur facilisis suscipit ridiculus agna lobortis
                                            imperdiet vivamus est aliquam euismod nector quam convallis ornare justo
                                            service lifereu visionary sources unleash online businesss solutions
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <span>03. </span> Did you get any business consultant?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Neque partrient nascetur facilisis suscipit ridiculus agna lobortis
                                            imperdiet vivamus est aliquam euismod nector quam convallis ornare justo
                                            service lifereu visionary sources unleash online businesss solutions
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- faq accordion area end -->
                    </div>
                </div>
                <div class="lg:w-1/2 px-[15px]">
                    <div class="thumbnail-faq-four">
                        <img src="assets/images/faq/02.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts faq section area End -->

    <!-- customers feed back area start -->
    <div class="rts-customer-feedback-area rts-section-gap bg-customer-feedback">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="rts-title-area feedback team text-center">
                    <p class="pre-title">
                        Feedbacks
                    </p>
                    <h2 class="title">Customer Feedbacks</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--20">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/02.png" alt="">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">David Smith</h3>
                                <span class="designation">Business Expert</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                “Parallel task user friendly convergence through supply are chains type siflify reliable
                                meta provide service visionary sources unleash tactical thinking via granular
                                intellectual capital architect dynamic information value online business solution
                                services”
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/03.png" alt="">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">David Smith</h3>
                                <span class="designation">Business Expert</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                “Parallel task user friendly convergence through supply are chains type siflify reliable
                                meta provide service visionary sources unleash tactical thinking via granular
                                intellectual capital architect dynamic information value online business solution
                                services”
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customers feed back area end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
