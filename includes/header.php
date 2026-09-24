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
$isAuSection     = (strpos($_SERVER['REQUEST_URI'] ?? '', '/au/') !== false || $currentPage === 'australia.php');
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
                                <p><i class="fal fa-clock"></i> <?php echo e($settings['working_hours'] ?: 'Working: 9.00am - 6.00pm NZST'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 px-[15px] xl:block hidden">
                        <div class="right">
                            <div class="country-toggle">
                                <a href="<?php echo site_url("nz/accounting/"); ?>" class="country-toggle-btn<?php echo !$isAuSection ? ' active' : ''; ?>">🇳🇿 New Zealand</a>
                                <a href="<?php echo site_url("australia.php"); ?>" class="country-toggle-btn<?php echo $isAuSection ? ' active' : ''; ?>">🇦🇺 Australia <span style="font-size:10px; background:#e53935; color:#fff; padding:1px 6px; border-radius:10px; margin-left:4px; text-transform:uppercase;">Soon</span></a>
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
                                    <li><a class='nav-item<?php echo $currentPage === 'index.php' ? ' active' : ''; ?>' href='<?php echo site_url("index.php"); ?>'>Home</a></li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("nz/accounting/"); ?>'>NZ Bookkeeping</a>
                                        <ul class="submenu menu-link1">
                                            <li class="menu-item">
                                                <a class='tag' href='<?php echo site_url("nz/accounting/"); ?>'>Core Services</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("nz/accounting/"); ?>'>Accounting &amp; Bookkeeping Hub</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/services.php"); ?>'>All Services Overview</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/industries.php"); ?>'>Industries We Support</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/pricing.php"); ?>'>Fixed Monthly Pricing</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/client-stories.php"); ?>'>Client Stories &amp; Reviews</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a class='tag' href='<?php echo site_url("nz/accounting/how-it-works.php"); ?>'>How We Help</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("nz/accounting/how-it-works.php"); ?>'>4-Step Onboarding Process</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/why-us.php"); ?>'>Why Choose get-accountant</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/insights.php"); ?>'>Tax &amp; IRD Insights</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/faqs.php"); ?>'>Business Owner FAQs</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting/contact.php"); ?>' style='color:#e53935; font-weight:700;'>Book Free Consultation &rarr;</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("nz/accounting-firm/"); ?>'>Firm Outsourcing</a>
                                        <ul class="submenu menu-link1">
                                            <li class="menu-item">
                                                <a class='tag' href='<?php echo site_url("nz/accounting-firm/"); ?>'>Outsourcing Services</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/"); ?>'>Firm Outsourcing Hub</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/services.php"); ?>'>All Practice Services</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/how-we-work.php"); ?>'>How We Work with Firms</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/technology.php"); ?>'>Technology &amp; ISO Security</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/case-studies.php"); ?>'>Firm Case Studies</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a class='tag' href='<?php echo site_url("nz/accounting-firm/why-partner.php"); ?>'>Practice Growth</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/why-partner.php"); ?>'>Why Partner with Us</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/insights.php"); ?>'>Accounting Firm Trends</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/faqs.php"); ?>'>Firm Partnership FAQs</a></li>
                                                    <li><a href='<?php echo site_url("nz/accounting-firm/contact.php"); ?>' style='color:#e53935; font-weight:700;'>Request Scoping Call &rarr;</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown">
                                        <a class='nav-link' href='<?php echo site_url("about-us.php"); ?>'>About &amp; Practice</a>
                                        <ul class="submenu menu-link1" style="width: 480px;">
                                            <li class="menu-item" style="width: 48%;">
                                                <a class='tag' href='<?php echo site_url("about-us.php"); ?>'>Our Practice</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("about-us.php"); ?>'>About get-accountant</a></li>
                                                    <li><a href='<?php echo site_url("how-we-work.php"); ?>'>Our Methodology</a></li>
                                                    <li><a href='<?php echo site_url("our-peoples.php"); ?>'>Our Leadership Team</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item" style="width: 48%;">
                                                <a class='tag' href='<?php echo site_url("insight-resources.php"); ?>'>Resources</a>
                                                <ul>
                                                    <li><a href='<?php echo site_url("insight-resources.php"); ?>'>Insight &amp; Resources</a></li>
                                                    <li><a href='<?php echo site_url("blog-list.php"); ?>'>Tax &amp; Business News</a></li>
                                                    <li><a href='<?php echo site_url("contactus.php"); ?>' style='color:#e53935; font-weight:700;'>Contact Us &rarr;</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li>
                                        <a class='nav-item<?php echo $isAuSection ? ' active' : ''; ?>' href='<?php echo site_url("australia.php"); ?>'>Australia <span style="font-size:10px; background:#e53935; color:#fff; padding:2px 6px; border-radius:10px; font-weight:700; margin-left:2px;">SOON</span></a>
                                    </li> -->
                                    <li><a class='nav-item<?php echo $currentPage === 'contactus.php' ? ' active' : ''; ?>' href='<?php echo site_url("contactus.php"); ?>'>Contact</a></li>
                                </ul>
                            </nav>
                            <div class="button-area">
                                <button id="search" class="rts-btn btn-primary-alta" aria-label="Search"><i class="far fa-search"></i></button>
                                <a class='rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btn' href='<?php echo site_url("get-started.php"); ?>'>Get Started</a>
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
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("index.php"); ?>'>Home</a></li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("nz/accounting/"); ?>'>NZ Bookkeeping</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/"); ?>'>Accounting &amp; Bookkeeping Hub</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/services.php"); ?>'>All Services Overview</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/industries.php"); ?>'>Industries We Support</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/pricing.php"); ?>'>Fixed Monthly Pricing</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/client-stories.php"); ?>'>Client Stories &amp; Reviews</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/how-it-works.php"); ?>'>How It Works</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/why-us.php"); ?>'>Why Choose Us</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/insights.php"); ?>'>Tax &amp; IRD Insights</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/faqs.php"); ?>'>Business Owner FAQs</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting/contact.php"); ?>' style='color:#e53935; font-weight:700;'>Book Free Consultation</a></li>
                            </ul>
                        </li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("nz/accounting-firm/"); ?>'>Firm Outsourcing</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/"); ?>'>Firm Outsourcing Hub</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/services.php"); ?>'>All Practice Services</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/how-we-work.php"); ?>'>How We Work with Firms</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/technology.php"); ?>'>Technology &amp; ISO Security</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/why-partner.php"); ?>'>Why Partner with Us</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/case-studies.php"); ?>'>Firm Case Studies</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/insights.php"); ?>'>Accounting Firm Trends</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/faqs.php"); ?>'>Firm Partnership FAQs</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("nz/accounting-firm/contact.php"); ?>' style='color:#e53935; font-weight:700;'>Request Scoping Call</a></li>
                            </ul>
                        </li>
                        <li class="has-droupdown menu-item">
                            <a class='menu-link' href='<?php echo site_url("about-us.php"); ?>'>About &amp; Practice</a>
                            <ul class="submenu">
                                <li class="mobile-menu-link"><a href='<?php echo site_url("about-us.php"); ?>'>About get-accountant</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("how-we-work.php"); ?>'>Our Methodology</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("our-peoples.php"); ?>'>Our People</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("insight-resources.php"); ?>'>Insight &amp; Resources</a></li>
                                <li class="mobile-menu-link"><a href='<?php echo site_url("blog-list.php"); ?>'>Tax &amp; Business News</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a class='menu-link' href='<?php echo site_url("australia.php"); ?>'>Australia (Coming Soon)</a></li>
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
