<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Get Started';
$metaDescription = 'Tell us what you need — accounting & bookkeeping for your business, or outsourcing support for your accounting firm.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Get Started</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='get-started.php'>Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- audience selector area -->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:700px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; New Zealand</span>
                    <h2 class="title mt--10">Tell us what you're looking for</h2>
                    <p class="disc mt--15">Choose the option below that best describes you, and we'll show you the right services.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px] mt--60 justify-center">
                <!-- bookkeeping card -->
                <div class="xl:w-5/12 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <a href="nz/accounting/" style="display:block;height:100%;">
                        <div class="single-business-solution-2" style="height:100%;text-align:center;border-left:none;border-top:5px solid var(--color-primary);margin-left:0;">
                            <div class="content" style="padding-left:0;">
                                <h3 class="title">I need Accounting & Bookkeeping</h3>
                                <p class="disc">I run a business in New Zealand and need bookkeeping, tax or payroll support.</p>
                                <span class="rts-btn btn-primary mt--20" style="display:inline-block;">Explore Bookkeeping <i class="far fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- firm outsourcing card -->
                <div class="xl:w-5/12 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <a href="nz/accounting-firm/" style="display:block;height:100%;">
                        <div class="single-business-solution-2" style="height:100%;text-align:center;border-left:none;border-top:5px solid var(--color-primary);margin-left:0;">
                            <div class="content" style="padding-left:0;">
                                <h3 class="title">I'm an Accounting Firm</h3>
                                <p class="disc">My firm needs reliable outsourcing support for accounts, payroll or compliance work.</p>
                                <span class="rts-btn btn-primary mt--20" style="display:inline-block;">Explore Outsourcing <i class="far fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end audience selector area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
