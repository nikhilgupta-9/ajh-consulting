<?php
require_once __DIR__ . '/config/config.php';

// ---- Handle AJAX form submission (see assets/js/plugins/contact.form.js) ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $name    = clean($_POST['name'] ?? '');
    $email   = clean($_POST['email'] ?? '');
    $subject = clean($_POST['subject'] ?? '');
    $message = clean($_POST['message'] ?? '');

    if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(422);
        exit('Please enter a valid name and email address.');
    }

    $pdo = db();
    if (!$pdo) {
        http_response_code(500);
        exit('Sorry, something went wrong. Please try again later or email us directly.');
    }

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO leads (type, name, email, subject, message) VALUES (:type, :name, :email, :subject, :message)'
        );
        $stmt->execute([
            'type'    => 'contact',
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject !== '' ? $subject : 'Website Contact Form',
            'message' => $message,
        ]);
    } catch (Throwable $e) {
        error_log('Contact form insert failed: ' . $e->getMessage());
        http_response_code(500);
        exit('Sorry, something went wrong. Please try again later or email us directly.');
    }

    exit('Thank you! Your message has been sent successfully. We will get back to you soon.');
}

$pageTitle       = 'Contact Us';
$metaDescription = 'Get in touch with get-accountant for business, tax and financial advice.';

require __DIR__ . '/includes/header.php';
// $settings is already populated by includes/header.php
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Contact Us</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='contactus.php'>Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <!-- contact single area start -->
    <div class="rts-contact-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <!-- single contact area -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <div class="single-contact-one-inner">
                        <div class="thumbnail">
                            <img src="assets/images/contact/01.png" alt="">
                        </div>
                        <div class="content">
                            <div class="icone">
                                <img src="assets/images/contact/shape/01.svg" alt="">
                            </div>
                            <div class="info">
                                <span>Call Us</span>
                                <a href="tel:<?php echo e($settings['phone']); ?>">
                                    <h2><?php echo e($settings['phone'] ?: 'Add a phone number in Admin > Settings'); ?></h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single contact area end -->
                <!-- single contact area -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <div class="single-contact-one-inner">
                        <div class="thumbnail">
                            <img src="assets/images/contact/02.png" alt="">
                        </div>
                        <div class="content">
                            <div class="icone">
                                <img src="assets/images/contact/shape/02.svg" alt="">
                            </div>
                            <div class="info">
                                <span>Email Us</span>
                                <a href="mailto:<?php echo e($settings['email']); ?>">
                                    <h3><?php echo e($settings['email'] ?: 'Add an email in Admin > Settings'); ?></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single contact area end -->
                <!-- single contact area -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <div class="single-contact-one-inner">
                        <div class="thumbnail">
                            <img src="assets/images/contact/03.png" alt="">
                        </div>
                        <div class="content">
                            <div class="icone">
                                <img src="assets/images/contact/shape/03.svg" alt="">
                            </div>
                            <div class="info">
                                <span>Visit Us</span>
                                <a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo urlencode($settings['address']); ?>">
                                    <h3><?php echo e($settings['address'] ?: 'Add an address in Admin > Settings'); ?></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single contact area end -->
            </div>
        </div>
    </div>
    <!-- conact single area end -->

    <!-- bizup map area start -->
    <?php if (!empty($settings['map_embed_url'])): ?>
    <div class="rts-contact-map-area">
        <div class="contaciner-fluid">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="contact-map-area-fluid">
                        <iframe class="contact-map" src="<?php echo e($settings['map_embed_url']); ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <img class="location" src="assets/images/contact/shape/location.svg" alt="Business_map">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- bizup map area end -->


    <!-- conact us form fluid start -->
    <div class="rts-contact-form-area">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-contact-fluid rts-section-gap">
                        <div class="rts-title-area contact-fluid text-center mb--50">
                            <p class="pre-title">
                                Get In Touch
                            </p>
                            <h2 class="title">Needs Help? Let’s Get in Touch</h2>
                        </div>
                        <div class="form-wrapper">
                            <div id="form-messages"></div>
                            <form id="contact-form" action="contactus.php" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="name-email">
                                    <input type="text" name="name" placeholder="Your Name" required>
                                    <input type="email" name="email" placeholder="Email Address" required>
                                </div>
                                <input type="text" name="subject" placeholder="Your Subject">
                                <textarea placeholder="Type Your Message" name="message"></textarea>
                                <button type="submit" class="rts-btn btn-primary" aria-label="Submit contact message">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- conact us form fluid end -->




<?php require __DIR__ . '/includes/footer.php'; ?>
