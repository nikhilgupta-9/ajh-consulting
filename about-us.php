<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'About Us';
$metaDescription = 'Learn more about get-accountant - our mission, values and expert team.';

require __DIR__ . '/includes/header.php';

// Admin-editable hero content (Admin > Page Content > About). Structure of
// this page is left untouched — only the heading/subheading/body/image
// text below is wired to the database, with the original copy as fallback.
$aboutContent = ['heading' => '', 'subheading' => '', 'body' => '', 'image' => ''];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'about']);
        $found = $stmt->fetch();
        if ($found) {
            $aboutContent = $found;
        }
    } catch (Throwable $e) {
        // page_content not migrated yet — fall back to the defaults below.
    }
}
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
                            <img class="mt--110 img-1" src="<?php echo e($aboutContent['image'] ?: 'assets/images/about/main/about-03.jpg'); ?>" alt="BUsiness_image">
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
                            <span><?php echo e($aboutContent['subheading'] ?: 'JUST A CONSULTANCY'); ?></span>
                            <h2 class="title"><?php echo e($aboutContent['heading'] ?: 'Get Consulting For Better Business Growth'); ?></h2>
                        </div>
                        <!-- inner start -->
                        <div class="inner">
                            <p class="disc"><?php echo e($aboutContent['body'] ?: 'Dapibus curae risus rutrum curabitur nunc sociis nullam nisl, aliquet quis iaculis scelerisque primis massa imperdiet, dis senectus blandit aptent nulla cubilia sodales convallis tortor pellentesque nulla.'); ?></p>
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
                            Our Core Pillars
                        </p>
                        <h2 class="title">Tailored Accounting Solutions</h2>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80 mb_md--40 mb_sm--30">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='<?php echo site_url("nz/accounting/"); ?>'>
                                    <img src="assets/images/service/07.jpg" alt="Business Accounting">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/13.svg" alt="Bookkeeping icon">
                                    <h3 class="title h5">For NZ Businesses</h3>
                                    <p class="disc">Daily bank feeds, reconciliations, GST returns, payroll processing, and proactive financial management.</p>
                                </div>
                                <a class='over_link' href='<?php echo site_url("nz/accounting/"); ?>'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting/"); ?>'> Explore Services<i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80 mb_md--40 mb_sm--30">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='<?php echo site_url("nz/accounting-firm/"); ?>'>
                                    <img src="assets/images/service/08.jpg" alt="Firm Outsourcing">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/14.svg" alt="Firm icon">
                                    <h3 class="title h5">For Accounting Practices</h3>
                                    <p class="disc">Dedicated offshore accounting capacity for CA &amp; CPA firms — year-end workpapers, financial statements &amp; tax returns.</p>
                                </div>
                                <a class='over_link' href='<?php echo site_url("nz/accounting-firm/"); ?>'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting-firm/"); ?>'> Firm Outsourcing<i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- start single Service -->
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pt--15 mb--80">
                        <div class="service-one-inner-four">
                            <div class="big-thumbnail-area">
                                <a class='thumbnail' href='<?php echo site_url("nz/accounting-firm/technology.php"); ?>'>
                                    <img src="assets/images/service/09.jpg" alt="Cloud Ecosystem">
                                </a>
                                <div class="content">
                                    <img src="assets/images/service/icon/15.svg" alt="Cloud icon">
                                    <h3 class="title h5">Cloud Tech &amp; Security</h3>
                                    <p class="disc">Deep expertise in Xero, MYOB, Dext, Hubdoc, and CCH iFirm with enterprise-grade data security protocols.</p>
                                </div>
                                <a class='over_link' href='<?php echo site_url("nz/accounting-firm/technology.php"); ?>'></a>
                            </div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting-firm/technology.php"); ?>'> Learn Systems<i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[15px]">
                <div class="cta-one-bg w-full px-[15px]">
                    <div class="cta-one-inner">
                        <div class="cta-left">
                            <h3 class="title animated fadeIn">Ready to scale your accounting with precision and confidence?</h3>
                        </div>
                        <div class="cta-right">
                            <a class='rts-btn btn-white' href='<?php echo site_url("contactus.php"); ?>'>Schedule Consultation</a>
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
                            Our Leadership
                        </p>
                        <h2 class="title">Experienced Accounting Leadership</h2>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--15 mt_sm--0">
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="team-inner-two">
                        <a class='thumbnail' href='<?php echo site_url("our-peoples.php"); ?>'>
                            <img src="assets/images/team/tm/lg-01.jpg" alt="Partner">
                        </a>
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='<?php echo site_url("our-peoples.php"); ?>'>
                                    <h3 class="title h5">Robert Fox</h3>
                                </a>
                                <span>Managing Director &amp; Lead Partner</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fal fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="team-inner-two">
                        <a class='thumbnail' href='<?php echo site_url("our-peoples.php"); ?>'>
                            <img src="assets/images/team/tm/lg-02.jpg" alt="CA Specialist">
                        </a>
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='<?php echo site_url("our-peoples.php"); ?>'>
                                    <h3 class="title h5">Jane Cooper</h3>
                                </a>
                                <span>Senior CA ANZ Practice Lead</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fal fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single team -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full">
                    <div class="team-inner-two">
                        <a class='thumbnail' href='<?php echo site_url("our-peoples.php"); ?>'>
                            <img src="assets/images/team/tm/lg-03.jpg" alt="Tax Manager">
                        </a>
                        <div class="acquaintance-area">
                            <div class="header">
                                <a href='<?php echo site_url("our-peoples.php"); ?>'>
                                    <h3 class="title h5">Esther Howard</h3>
                                </a>
                                <span>NZ Tax &amp; IRD Compliance Manager</span>
                            </div>
                            <div class="acquaintance-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fal fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <span class="sub">FREQUENTLY ASKED QUESTIONS</span>
                            <h2 class="title">Clear Answers to Common Questions</h2>
                        </div>
                        <div class="faq-accordion-area">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span>01. </span> How does get-accountant work with our existing software?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            We connect directly into your existing Xero, MYOB, or CCH iFirm software. You do not need to migrate systems or change your chart of accounts. We adapt to your standard operating procedures.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span>02. </span> Are your services fully compliant with New Zealand regulations?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Yes. All deliverables are built around the New Zealand Tax Administration Act, Goods and Services Tax Act 1985, and Holidays Act 2003, with strict adherence to the NZ Privacy Act 2020.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <span>03. </span> How do you protect practice client confidentiality?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            We operate under comprehensive bilateral NDAs. Our staff work on secure, encrypted virtual machines with zero local data storage, multi-factor authentication, and IP-restricted cloud access.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 px-[15px]">
                    <div class="thumbnail-faq-four">
                        <img src="assets/images/faq/02.png" alt="FAQ">
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
                        Client Trust
                    </p>
                    <h2 class="title">What Our New Zealand Clients Say</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--20">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/02.png" alt="Liam Gallagher">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">Liam Gallagher</h3>
                                <span class="designation">Managing Director, Auckland Trade Services</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                “get-accountant eliminated our end-of-month reconciliation headaches. Our GST returns are filed on time every period, and we finally have reliable monthly cashflow dashboards.”
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-full sm:w-full w-full">
                    <div class="testimopnial-wrapper-two">
                        <div class="test-header">
                            <div class="thumbnail">
                                <img src="assets/images/testimonials/03.png" alt="Sarah Jenkins">
                            </div>
                            <div class="name-desig">
                                <h3 class="title h5">Sarah Jenkins</h3>
                                <span class="designation">Principal CA, Christchurch Advisory Practice</span>
                            </div>
                        </div>
                        <div class="test-body">
                            <p class="disc">
                                “Partnering with get-accountant solved our senior staffing bottleneck during the peak March tax rush. Their workpapers are clean, indexed, and ready for partner review immediately.”
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customers feed back area end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
