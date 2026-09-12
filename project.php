<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Portfolio';
$metaDescription = 'A showcase of projects and client engagements delivered by get-accountant.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Portfolio</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='project.php'>Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- project section srart -->
    <div class="rts-project-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="tab-button-area-one">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Projects</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Business</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Solution</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tabs" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Marketing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tabrts" data-bs-toggle="tab" data-bs-target="#contactrts" type="button" role="tab" aria-controls="contactrts" aria-selected="false">Marketing</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content-area mt--50 mt_sm--30">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- tab product area -->
                                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/01.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h2 class="title h5">Business Growth Check</h2>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/02.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/03.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/04.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/05.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/06.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                </div>
                                <!-- tab product area end-->
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- tab product area -->
                                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/06.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-full w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/05.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/04.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/03.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/02.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/01.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                </div>
                                <!-- tab product area end-->
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <!-- tab product area -->
                                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/01.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/02.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/03.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/04.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/05.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/06.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                </div>
                                <!-- tab product area end-->
                            </div>
                            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contact-tabs">
                                <!-- tab product area -->
                                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/06.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/05.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/04.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/03.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/02.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/01.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                </div>
                                <!-- tab product area end-->
                            </div>
                            <div class="tab-pane fade" id="contactrts" role="tabpanel" aria-labelledby="contact-tabrts">
                                <!-- tab product area -->
                                <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/01.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/02.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/03.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/04.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/05.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                    <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                                        <!-- single -product area -->
                                        <div class="rts-product-one">
                                            <div class="thumbnail-area">
                                                <img src="assets/images/product/06.jpg" alt="Business_Finbiz">
                                                <a class='rts-btn btn-primary rounded' href='project.php'><i class="far fa-arrow-right"></i></a>
                                            </div>
                                            <div class="product-contact-wrapper">
                                                <span>Business Solution</span>
                                                <a href='project.php'>
                                                    <h3 class="title h5">Business Growth Check</h3>
                                                </a>
                                                <p class="disc">
                                                    Ultricies nequenulla eros sapien cubilia nostra viverra integer
                                                    ornare prointa
                                                </p>
                                            </div>
                                        </div>
                                        <!-- single -product area End -->
                                    </div>
                                </div>
                                <!-- tab product area end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- project section end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
