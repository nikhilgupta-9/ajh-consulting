<?php
/**
 * Shared <head> + site header/nav, included by every public page.
 * Each page should set $pageTitle (and optionally $metaDescription)
 * before requiring this file.
 */
require_once __DIR__ . '/../config/config.php';

$pageTitle       = $pageTitle ?? APP_NAME;
$metaDescription = $metaDescription ?? 'get-accountant - accounting, bookkeeping and outsourcing services for New Zealand and Australia.';
$currentPage     = basename($_SERVER['SCRIPT_NAME']);
$settings        = site_settings();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($metaDescription); ?>">
    <title><?php echo e($pageTitle); ?> | <?php echo e(APP_NAME); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url("assets/images/fav.png"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/plugins/swiper.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/plugins/fontawesome-5.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/plugins/unicons.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style.css"); ?>">
</head>

<body>

    <?php require __DIR__ . '/entry-gate.php'; ?>

    <!-- start header area -->
    <header class="header--sticky header-one">
        <div class="header-top header-top-one bg-1">
            <div class="container">
                <div class="flex flex-wrap -mx-[15px]">
                    <div class="lg:w-1/2 px-[15px] xl:block hidden">
                        <div class="left">
                            <div class="mail">
                                <a href="mailto:<?php echo e($settings['email']); ?>"><i class="fal fa-envelope"></i> <?php echo e($settings['email']); ?></a>
                            </div>
                            <div class="working-time">
                                <p><i class="fal fa-clock"></i> <?php echo e($settings['working_hours'] ?: 'Working: 9.00am - 6.00pm'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 px-[15px] xl:block hidden">
                        <div class="right">
                            <div class="country-toggle">
                                <a href="<?php echo site_url("index.php"); ?>" class="country-toggle-btn<?php echo $currentPage !== 'australia.php' ? ' active' : ''; ?>">New Zealand</a>
                                <a href="<?php echo site_url("australia.php"); ?>" class="country-toggle-btn<?php echo $currentPage === 'australia.php' ? ' active' : ''; ?>">Australia</a>
                            </div>
                            <ul class="top-nav">
                                <li><a href='<?php echo site_url("about-us.php"); ?>'>About</a></li>
                                <li><a href='<?php echo site_url("blog-list.php"); ?>'>News</a></li>
                                <li><a href='<?php echo site_url("contactus.php"); ?>'>Contact</a></li>
                            </ul>
                            <ul class="social-wrapper-one">
                                <?php if ($settings['facebook_url']): ?><li><a href="<?php echo e($settings['facebook_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li><?php endif; ?>
                                <?php if ($settings['twitter_url']): ?><li><a href="<?php echo e($settings['twitter_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li><?php endif; ?>
                                <?php if ($settings['instagram_url']): ?><li><a href="<?php echo e($settings['instagram_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li><?php endif; ?>
                                <?php if ($settings['linkedin_url']): ?><li><a class="mr--0" href="<?php echo e($settings['linkedin_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main-one bg-white">
            <div class="container">
                <div class="flex flex-wrap -mx-[15px]">
                    <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/3 sm:w-1/3 w-1/3">
                        <div class="thumbnail">
                            <a href='<?php echo site_url("index.php"); ?>'>
                                <img src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>" alt="<?php echo e(APP_NAME); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="xl:w-3/4 px-[15px] lg:w-2/3 md:w-2/3 sm:w-2/3 w-2/3">
                        <div class="main-header">
                            <nav class="nav-main mainmenu-nav hidden xl:block">
                                <ul class="mainmenu">
                                    <li><a class='nav-item<?php echo $currentPage === 'index.php' ? ' active' : ''; ?>' href='<?php echo site_url("index.php"); ?>'>Home</a></li>
                                    <li><a class='nav-item<?php echo $currentPage === 'get-started.php' ? ' active' : ''; ?>' href='<?php echo site_url("get-started.php"); ?>'>Get Started</a></li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("our-service.php"); ?>'>Services</a>
                                        <ul class="submenu menu-link3">
                                            <li><a href='<?php echo site_url("nz/accounting/"); ?>'>Accounting & Bookkeeping</a></li>
                                            <li><a href='<?php echo site_url("nz/accounting-firm/"); ?>'>Accounting Firm Outsourcing</a></li>
                                            <li><a href='<?php echo site_url("our-service.php"); ?>'>Our Service</a></li>
                                            <li><a href='<?php echo site_url("service-details.php"); ?>'>Service Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("about-us.php"); ?>'>Pages</a>
                                        <ul class="submenu menu-link">
                                            <li><a href='<?php echo site_url("about-us.php"); ?>'>About Us</a></li>
                                            <li><a href='<?php echo site_url("how-we-work.php"); ?>'>How We Work</a></li>
                                            <li><a href='<?php echo site_url("our-peoples.php"); ?>'>Our Peoples</a></li>
                                            <li><a href='<?php echo site_url("insight-resources.php"); ?>'>Insight &amp; Resources</a></li>
                                            <li><a href='<?php echo site_url("team.php"); ?>'>Our Team</a></li>
                                            <li><a href='<?php echo site_url("project.php"); ?>'>Portfolio</a></li>
                                            <li><a href='<?php echo site_url("pricing.php"); ?>'>Pricing</a></li>
                                            <li><a href='<?php echo site_url("appoinment.php"); ?>'>Appointment</a></li>
                                            <li><a href='<?php echo site_url("404.php"); ?>'>404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("blog-list.php"); ?>'>Blog</a>
                                        <ul class="submenu">
                                            <li><a href='<?php echo site_url("blog-list.php"); ?>'>Blog List</a></li>
                                            <li><a href='<?php echo site_url("blog-details.php"); ?>'>Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a class='nav-item' href='<?php echo site_url("contactus.php"); ?>'>Contact</a></li>
                                </ul>
                            </nav>
                            <div class="button-area">
                                <button id="search" class="rts-btn btn-primary-alta"><i class="far fa-search"></i></button>
                                <a class='rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btn' href='<?php echo site_url("contactus.php"); ?>'>Get Quote</a>
                                <button id="menu-btn" class="menu rts-btn btn-primary-alta ml--20 ml_sm--5">
                                    <img class="menu-dark" src="<?php echo site_url("assets/images/icon/menu.png"); ?>" alt="Menu-icon">
                                    <img class="menu-light" src="<?php echo site_url("assets/images/icon/menu-light.png"); ?>" alt="Menu-icon">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End header area -->

    <div id="side-bar" class="side-bar">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <div class="rts-sidebar-menu-desktop">
            <a class='logo-1' href='<?php echo site_url("index.php"); ?>'><img class="logo" src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>" alt="<?php echo e(APP_NAME); ?>"></a>
            <a class='logo-2' href='<?php echo site_url("index.php"); ?>'><img class="logo" src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>" alt="<?php echo e(APP_NAME); ?>"></a>
            <a class='logo-3' href='<?php echo site_url("index.php"); ?>'><img class="logo" src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>" alt="<?php echo e(APP_NAME); ?>"></a>
            <a class='logo-4' href='<?php echo site_url("index.php"); ?>'><img class="logo" src="<?php echo site_url("assets/images/logo/logo-5.svg"); ?>" alt="<?php echo e(APP_NAME); ?>"></a>
            <div class="body hidden xl:block">
                <p class="disc">
                    <?php echo e($settings['tagline'] ?: (e(APP_NAME) . ' helps businesses grow with clear, practical accounting, tax and consulting advice.')); ?>
                </p>
                <div class="get-in-touch">
                    <div class="h6 title">Get In Touch</div>
                    <div class="wrapper">
                        <?php if ($settings['phone']): ?>
                        <div class="single">
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:<?php echo e($settings['phone']); ?>"><?php echo e($settings['phone']); ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if ($settings['email']): ?>
                        <div class="single">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo e($settings['email']); ?>"><?php echo e($settings['email']); ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="single">
                            <i class="fas fa-globe"></i>
                            <a href="<?php echo e(APP_URL); ?>"><?php echo e(APP_URL); ?></a>
                        </div>
                        <?php if ($settings['address']): ?>
                        <div class="single">
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo urlencode($settings['address']); ?>"><?php echo e($settings['address']); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="social-wrapper-two menu">
                        <?php if ($settings['facebook_url']): ?><a href="<?php echo e($settings['facebook_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                        <?php if ($settings['twitter_url']): ?><a href="<?php echo e($settings['twitter_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a><?php endif; ?>
                        <?php if ($settings['instagram_url']): ?><a href="<?php echo e($settings['instagram_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a><?php endif; ?>
                        <?php $waLink = $settings['whatsapp_url'] ?: whatsapp_link($settings['whatsapp_number']); ?>
                        <?php if ($waLink): ?><a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="body-mobile block xl:hidden">
                <div class="country-toggle" style="border-color:#eee;margin:0 0 20px;max-width:max-content">
                    <a href="<?php echo site_url("index.php"); ?>" class="country-toggle-btn<?php echo $currentPage !== 'australia.php' ? ' active' : ''; ?>" style="color:#1c2539">New Zealand</a>
                    <a href="<?php echo site_url("australia.php"); ?>" class="country-toggle-btn<?php echo $currentPage === 'australia.php' ? ' active' : ''; ?>" style="color:#1c2539">Australia</a>
                </div>
                <nav class="nav-main mainmenu-nav">
                    <ul class="mainmenu">
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("index.php"); ?>'>Home</a></li>
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("get-started.php"); ?>'>Get Started</a></li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("our-service.php"); ?>'>Services</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/"); ?>'>Accounting & Bookkeeping</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/"); ?>'>Accounting Firm Outsourcing</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("our-service.php"); ?>'>Our Service</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("service-details.php"); ?>'>Service Details</a></li>
                            </ul>
                        </li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("about-us.php"); ?>'>Pages</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("about-us.php"); ?>'>About Us</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("how-we-work.php"); ?>'>How We Work</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("our-peoples.php"); ?>'>Our Peoples</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("insight-resources.php"); ?>'>Insight &amp; Resources</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("team.php"); ?>'>Our Team</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("project.php"); ?>'>Portfolio</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("pricing.php"); ?>'>Pricing</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("appoinment.php"); ?>'>Appointment</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("404.php"); ?>'>404 Page</a></li>
                            </ul>
                        </li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("blog-list.php"); ?>'>Blog</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("blog-list.php"); ?>'>Blog List</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("blog-details.php"); ?>'>Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("contactus.php"); ?>'>Contact</a></li>
                    </ul>
                </nav>
                <div class="social-wrapper-two menu mobile-menu">
                    <?php if ($settings['facebook_url']): ?><a href="<?php echo e($settings['facebook_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                    <?php if ($settings['twitter_url']): ?><a href="<?php echo e($settings['twitter_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a><?php endif; ?>
                    <?php if ($settings['instagram_url']): ?><a href="<?php echo e($settings['instagram_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    <?php if ($waLink): ?><a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a><?php endif; ?>
                </div>
                <a class='rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu' href='<?php echo site_url("contactus.php"); ?>'>Get Quote</a>
            </div>
        </div>
    </div>

    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input id="searchInput1" class="search-input" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>

    <div id="anywhere-home"></div>
    <!-- End header area -->
