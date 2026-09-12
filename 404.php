<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Page Not Found';
$metaDescription = 'The page you are looking for could not be found.';

require __DIR__ . '/includes/header.php';
?>

    <!-- rts- 404 area start -->
    <div class="rts-404-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="404wrapper text-center">
                        <div class="thumbnail">
                            <img src="assets/images/contact/shape/404.png" alt="">
                        </div>
                        <h2 class="title mt--40">
                            Oops! Nothing Was Found
                        </h2>
                        <p class="disc">Sorry, we couldn’t find the page you where looking for. We suggest <br> that you
                            return to homepage.</p>
                        <a class='rts-btn btn-primary' href='index.php'>Back To Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts- 404 area end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
