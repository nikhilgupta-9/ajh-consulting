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
$activeCountry   = current_country();
$isAuSection     = ($activeCountry === 'au');
$firmHubUrl      = $isAuSection ? site_url('au/accounting-firm/') : site_url('nz/accounting-firm/');
$bizHubUrl       = $isAuSection ? site_url('au/accounting/') : site_url('nz/accounting/');
$navServices     = site_nav_services();
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
    <link rel="stylesheet" href="<?php echo site_url("assets/css/gateway-mockup.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/navbar.css"); ?>">
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
                                <p><i class="fal fa-clock"></i> <?php echo e($settings['working_hours'] ?: 'Working: 9.00am - 6.00pm NZST'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 px-[15px] xl:block hidden">
                        <div class="right">
                            <div class="country-toggle">
                                <a href="<?php echo site_url("?country=nz"); ?>" class="country-toggle-btn<?php echo !$isAuSection ? ' active' : ''; ?>">🇳🇿 New Zealand</a>
                                <a href="<?php echo site_url("?country=au"); ?>" class="country-toggle-btn<?php echo $isAuSection ? ' active' : ''; ?>">🇦🇺 Australia <span style="font-size:10px; background:#e53935; color:#fff; padding:1px 6px; border-radius:10px; margin-left:4px; text-transform:uppercase;">Soon</span></a>
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
                    <div class="xl:w-3/12 lg:w-3/12 md:w-1/3 sm:w-1/2 w-1/2 px-[15px]">
                        <div class="thumbnail">
                            <a href='<?php echo site_url("index.php"); ?>' style="display: flex; align-items: center; padding: 20px 0;">
                                <img src="<?php echo site_url("assets/images/logo/logo-get-accountant-wordmark.png"); ?>" alt="<?php echo e(APP_NAME); ?>" style="max-height: 42px; width: auto; object-fit: contain; display: block;">
                            </a>
                        </div>
                    </div>
                    <div class="xl:w-9/12 lg:w-9/12 md:w-2/3 sm:w-1/2 w-1/2 px-[15px]">
                        <div class="main-header" style="justify-content: flex-end; align-items: center;">
                            <nav class="nav-main mainmenu-nav hidden xl:block">
                                <ul class="mainmenu">
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("about-us.php"); ?>'>Company</a>
                                        <ul class="submenu">
                                            <li><a href='<?php echo site_url("about-us.php"); ?>'><i class="far fa-building"></i> <span>About Us</span> <i class="far fa-chevron-right micro-arrow"></i></a></li>
                                            <li><a href='<?php echo site_url("our-peoples.php"); ?>'><i class="far fa-user-friends"></i> <span>Leadership Team</span> <i class="far fa-chevron-right micro-arrow"></i></a></li>
                                            <li><a href='<?php echo site_url("nz/accounting/faqs.php"); ?>'><i class="far fa-question-circle"></i> <span>FAQs</span> <i class="far fa-chevron-right micro-arrow"></i></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown nav-mega-item">
                                        <a class='nav-link' href='<?php echo e($bizHubUrl); ?>'>Services</a>
                                        <div class="submenu menu-link1 mega-menu-box">
                                            <div class="mega-columns-wrap">
                                                <!-- Column 1: For Businesses -->
                                                <div class="mega-column">
                                                    <div class="mega-col-header">
                                                        <span class="mega-tag"><i class="fas fa-briefcase"></i> For Businesses</span>
                                                        <h4 class="mega-col-title">Accounting &amp; Bookkeeping</h4>
                                                        <p class="mega-col-desc">Complete financial peace-of-mind for Kiwi &amp; Aussie SMEs</p>
                                                    </div>
                                                    <ul class="mega-service-list">
                                                        <?php if (!empty($navServices['biz'])): ?>
                                                            <?php foreach ($navServices['biz'] as $s): ?>
                                                                <li>
                                                                    <a href='<?php echo site_url("service-details.php?slug=" . urlencode($s['slug'])); ?>' class="mega-service-link">
                                                                        <span class="ms-icon"><i class="fas <?php echo e($s['icon'] ?: 'fa-calculator'); ?>"></i></span>
                                                                        <span class="ms-text">
                                                                            <strong class="ms-title"><?php echo e($s['title']); ?></strong>
                                                                        </span>
                                                                        <i class="far fa-arrow-right ms-arrow"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <div class="mega-col-footer">
                                                        <a href='<?php echo $isAuSection ? site_url("au/accounting/") : site_url("nz/accounting/services.php"); ?>' class="mega-view-all">
                                                            <span>View All Business Services</span>
                                                            <i class="far fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- Column 2: For CA/CPA Firms -->
                                                <div class="mega-column">
                                                    <div class="mega-col-header">
                                                        <span class="mega-tag"><i class="fas fa-chart-network"></i> For CA/CPA Firms</span>
                                                        <h4 class="mega-col-title">Practice Outsourcing Pods</h4>
                                                        <p class="mega-col-desc">Dedicated white-label capacity inside your existing firm software</p>
                                                    </div>
                                                    <ul class="mega-service-list">
                                                        <?php if (!empty($navServices['firm'])): ?>
                                                            <?php foreach ($navServices['firm'] as $s): ?>
                                                                <li>
                                                                    <a href='<?php echo site_url("service-details.php?slug=" . urlencode($s['slug'])); ?>' class="mega-service-link">
                                                                        <span class="ms-icon"><i class="fas <?php echo e($s['icon'] ?: 'fa-handshake'); ?>"></i></span>
                                                                        <span class="ms-text">
                                                                            <strong class="ms-title"><?php echo e($s['title']); ?></strong>
                                                                        </span>
                                                                        <i class="far fa-arrow-right ms-arrow"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <div class="mega-col-footer">
                                                        <a href='<?php echo $isAuSection ? site_url("au/accounting-firm/") : site_url("nz/accounting-firm/services.php"); ?>' class="mega-view-all">
                                                            <span>View All Firm Solutions</span>
                                                            <i class="far fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Trust bar across the bottom -->
                                            <div class="mega-bottom-trust">
                                                <div class="mbt-badge">
                                                    <i class="fas fa-shield-check" style="color: #10b981;"></i>
                                                    <span>SOC 2 Type II &amp; ISO 27001 Certified · Privacy Act &amp; GDPR Compliant</span>
                                                </div>
                                                <a href="<?php echo site_url('get-started.php'); ?>" class="mbt-action">
                                                    Need a Scoping Call? <strong>Get In Touch &rarr;</strong>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class='nav-item' href='<?php echo site_url("nz/accounting/industries.php"); ?>'>Industries</a></li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("insight-resources.php"); ?>'>Resources</a>
                                        <ul class="submenu">
                                            <li><a href='<?php echo site_url("blog-list.php"); ?>'><i class="far fa-newspaper"></i> <span>Insights &amp; Blogs</span> <i class="far fa-chevron-right micro-arrow"></i></a></li>
                                            <li><a href='<?php echo site_url("events.php"); ?>'><i class="far fa-calendar-star"></i> <span>Events &amp; Webinars</span> <i class="far fa-chevron-right micro-arrow"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a class='nav-item<?php echo $currentPage === 'contactus.php' ? ' active' : ''; ?>' href='<?php echo site_url("contactus.php"); ?>'>Contact Us</a></li>
                                </ul>
                            </nav>
                            <div class="button-area">
                                <button id="search" class="rts-btn btn-primary-alta" aria-label="Search"><i class="far fa-search"></i></button>
                                <a class='rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btn' href='<?php echo site_url("get-started.php"); ?>'>Get In Touch</a>
                                <button id="menu-btn" class="menu rts-btn btn-primary-alta ml--20 ml_sm--5" aria-label="Open Navigation">
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
                    <?php echo e($settings['tagline'] ?: (e(APP_NAME) . ' - People. Process. Possibility.™')); ?>
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
                    <a href="<?php echo site_url("nz/accounting/"); ?>" class="country-toggle-btn<?php echo !$isAuSection ? ' active' : ''; ?>" style="color:#1c2539">🇳🇿 New Zealand</a>
                    <a href="<?php echo site_url("australia.php"); ?>" class="country-toggle-btn<?php echo $isAuSection ? ' active' : ''; ?>" style="color:#1c2539">🇦🇺 Australia <span style="font-size:9px; background:#e53935; color:#fff; padding:1px 5px; border-radius:8px;">Soon</span></a>
                </div>
                <nav class="nav-main mainmenu-nav">
                    <ul class="mainmenu">
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("about-us.php"); ?>'>Company</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("about-us.php"); ?>'>About Us</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("our-peoples.php"); ?>'>Leadership Team</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/faqs.php"); ?>'>FAQs</a></li>
                            </ul>
                        </li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='javascript:void(0)'>Services</a>
                            <ul class="submenu">
                                <li class="mobile-menu-heading">
                                    <span class="badge-mini">For Businesses</span>
                                </li>
                                <?php if (!empty($navServices['biz'])): ?>
                                    <?php foreach ($navServices['biz'] as $s): ?>
                                        <li class="mobile-menu-link">
                                            <a href='<?php echo site_url("service-details.php?slug=" . urlencode($s['slug'])); ?>' style="display:flex; align-items:center; gap:8px;">
                                                <i class="fas <?php echo e($s['icon'] ?: 'fa-calculator'); ?>" style="color:#e53935; font-size:12px; width:16px; text-align:center;"></i>
                                                <span><?php echo e($s['title']); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <li class="mobile-menu-link mobile-cta-link">
                                    <a href='<?php echo $isAuSection ? site_url("au/accounting/") : site_url("nz/accounting/services.php"); ?>' style='color:#e53935; font-weight:700;'>
                                        View All Business Services &rarr;
                                    </a>
                                </li>

                                <li class="mobile-menu-heading">
                                    <span class="badge-mini">For CA/CPA Firms</span>
                                </li>
                                <?php if (!empty($navServices['firm'])): ?>
                                    <?php foreach ($navServices['firm'] as $s): ?>
                                        <li class="mobile-menu-link">
                                            <a href='<?php echo site_url("service-details.php?slug=" . urlencode($s['slug'])); ?>' style="display:flex; align-items:center; gap:8px;">
                                                <i class="fas <?php echo e($s['icon'] ?: 'fa-handshake'); ?>" style="color:#e53935; font-size:12px; width:16px; text-align:center;"></i>
                                                <span><?php echo e($s['title']); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <li class="mobile-menu-link mobile-cta-link">
                                    <a href='<?php echo $isAuSection ? site_url("au/accounting-firm/") : site_url("nz/accounting-firm/services.php"); ?>' style='color:#e53935; font-weight:700;'>
                                        View All Firm Solutions &rarr;
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("nz/accounting/industries.php"); ?>'>Industries</a></li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("insight-resources.php"); ?>'>Resources</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("blog-list.php"); ?>'>Blogs</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("events.php"); ?>'>Events</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("contactus.php"); ?>'>Contact Us</a></li>
                    </ul>
                </nav>
                <div class="social-wrapper-two menu mobile-menu">
                    <?php if ($settings['facebook_url']): ?><a href="<?php echo e($settings['facebook_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                    <?php if ($settings['twitter_url']): ?><a href="<?php echo e($settings['twitter_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a><?php endif; ?>
                    <?php if ($settings['instagram_url']): ?><a href="<?php echo e($settings['instagram_url']); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    <?php if ($waLink): ?><a href="<?php echo e($waLink); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a><?php endif; ?>
                </div>
                <a class='rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu' href='<?php echo site_url("get-started.php"); ?>'>Get In Touch</a>
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
