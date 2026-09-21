<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Australia - Coming Soon';
$metaDescription = 'get-accountant is launching soon for Australia. Currently serving New Zealand.';

require __DIR__ . '/includes/header.php';
?>

    <!-- audience selector area -->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:700px;margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;">get-accountant &mdash; Australia</span>
                    <h2 class="title mt--10">Coming Soon to Australia</h2>
                    <p class="disc mt--15">We're launching soon. Tell us what you're looking for and we'll notify you when it's ready &mdash; or visit our New Zealand site in the meantime.</p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px] mt--60 justify-center">
                <div class="xl:w-5/12 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <a href="au/accounting/" style="display:block;height:100%;">
                        <div class="single-business-solution-2" style="height:100%;text-align:center;border-left:none;border-top:5px solid var(--color-primary);margin-left:0;">
                            <div class="content" style="padding-left:0;">
                                <h3 class="title">I need Accounting &amp; Bookkeeping</h3>
                                <p class="disc">For businesses in Australia.</p>
                                <span class="rts-btn btn-primary mt--20" style="display:inline-block;">Learn More <i class="far fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="xl:w-5/12 px-[15px] md:w-1/2 sm:w-full w-full pb--30">
                    <a href="au/accounting-firm/" style="display:block;height:100%;">
                        <div class="single-business-solution-2" style="height:100%;text-align:center;border-left:none;border-top:5px solid var(--color-primary);margin-left:0;">
                            <div class="content" style="padding-left:0;">
                                <h3 class="title">I'm an Accounting Firm</h3>
                                <p class="disc">Outsourcing support for accounting firms in Australia.</p>
                                <span class="rts-btn btn-primary mt--20" style="display:inline-block;">Learn More <i class="far fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full text-center mt--30">
                <a class='rts-read-more-two color-primary' href='index.php'>Visit the New Zealand Site<i class="far fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- audience selector area end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
