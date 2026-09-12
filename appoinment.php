<?php
require_once __DIR__ . '/config/config.php';

$services = [];
if ($pdo = db()) {
    try {
        $services = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {
        $services = [];
    }
}

// ---- Handle AJAX form submission ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $name          = clean($_POST['name'] ?? '');
    $email         = clean($_POST['email'] ?? '');
    $phone         = clean($_POST['phone'] ?? '');
    $service       = clean($_POST['service'] ?? '');
    $preferredDate = clean($_POST['preferred_date'] ?? '');
    $preferredTime = clean($_POST['preferred_time'] ?? '');
    $message       = clean($_POST['message'] ?? '');

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
            'INSERT INTO leads (type, name, email, phone, service, preferred_date, preferred_time, message)
             VALUES (:type, :name, :email, :phone, :service, :preferred_date, :preferred_time, :message)'
        );
        $stmt->execute([
            'type'           => 'appointment',
            'name'           => $name,
            'email'          => $email,
            'phone'          => $phone ?: null,
            'service'        => $service ?: null,
            'preferred_date' => $preferredDate ?: null,
            'preferred_time' => $preferredTime ?: null,
            'message'        => $message,
        ]);
    } catch (Throwable $e) {
        error_log('Appointment form insert failed: ' . $e->getMessage());
        http_response_code(500);
        exit('Sorry, something went wrong. Please try again later or email us directly.');
    }

    exit('Thank you! Your appointment request has been received. We will contact you shortly.');
}

$pageTitle       = 'Book an Appointment';
$metaDescription = 'Request a free quote or book an appointment with get-accountant.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Appointment</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='appoinment.php'>Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <!-- rts circle progress area -->
    <div class="rts-circle-progress-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <!-- single progress area -->
                    <div class="single-circle-progress-inner">
                        <!-- single -->
                        <div class="progress red">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">85%</div>
                        </div>
                        <!-- single -->
                        <h2 class="title">Quality Service</h2>
                    </div>
                    <!-- single progress area End -->
                </div>
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <!-- single progress area -->
                    <div class="single-circle-progress-inner">
                        <!-- single -->
                        <div class="progress red">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">90%</div>
                        </div>
                        <!-- single -->
                        <h3 class="title">Skilled Members</h3>
                    </div>
                    <!-- single progress area End -->
                </div>
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <!-- single progress area -->
                    <div class="single-circle-progress-inner">
                        <!-- single -->
                        <div class="progress red">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">78%</div>
                        </div>
                        <!-- single -->
                        <h3 class="title">Happy Customers</h3>
                    </div>
                    <!-- single progress area End -->
                </div>
                <div class="xl:w-1/4 px-[15px] lg:w-1/3 md:w-1/2 sm:w-1/2 w-full">
                    <!-- single progress area -->
                    <div class="single-circle-progress-inner">
                        <!-- single -->
                        <div class="progress red">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">79%</div>
                        </div>
                        <!-- single -->
                        <h3 class="title">Project Fails</h3>
                    </div>
                    <!-- single progress area End -->
                </div>
            </div>
        </div>
    </div>
    <!-- rts circle progress area End -->

    <!-- contact area start -->
    <div class="rts-contact-area contact-one appoinment background-contact-appoinment">
        <div class="">
            <div class="flex flex-wrap mx-0 [&>*]:!px-0 items-center">
                <div class="xl:w-5/12 px-[15px] lg:w-5/12 md:w-full sm:w-full w-full">
                    <div class="contact-image-one appoinment">
                        <img src="assets/images/appoinment/02.png" alt="">
                    </div>
                </div>
                <div class="xl:w-7/12 px-[15px] lg:w-7/12 md:w-full sm:w-full w-full">
                    <div class="contact-form-area-one">
                        <div class="rts-title-area contact-appoinment text-left">
                            <p class="pre-title">
                                Make An Appointment
                            </p>
                            <h2 class="title">Request a free quote</h2>
                        </div>
                        <div id="appoinment-form-messages"></div>
                        <form id="appoinment-form" action="appoinment.php" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="name-email">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="name-email">
                                <input type="text" name="phone" placeholder="Phone Number">
                                <select name="service">
                                    <option value="">Select a Service</option>
                                    <?php foreach ($services as $svc): ?>
                                    <option value="<?php echo e($svc['title']); ?>"><?php echo e($svc['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="name-email">
                                <input type="date" name="preferred_date" placeholder="Preferred Date">
                                <input type="text" name="preferred_time" placeholder="Preferred Time (e.g. 10:00 AM)">
                            </div>
                            <textarea name="message" placeholder="Type Your Message"></textarea>
                            <button type="submit" class="rts-btn btn-primary mt--20">Submit Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->

    <!-- rts team two area -->
    <div class="rts-team-area rts-section-gapTop appoinment-team team-two">
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
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--10">
                <!-- single team -->
                <div class="lg:w-1/3 px-[15px]">
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
                <div class="lg:w-1/3 px-[15px]">
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
                                <span>Business</span>
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
                <div class="lg:w-1/3 px-[15px]">
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


    <script>
    (function () {
        var form = document.getElementById('appoinment-form');
        var box  = document.getElementById('appoinment-form-messages');
        if (!form) { return; }
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var data = new URLSearchParams(new FormData(form));
            fetch(form.getAttribute('action'), { method: 'POST', body: data })
                .then(function (res) {
                    return res.text().then(function (text) {
                        return { ok: res.ok, text: text };
                    });
                })
                .then(function (result) {
                    box.className = result.ok ? 'success' : 'error';
                    box.textContent = result.text;
                    if (result.ok) { form.reset(); }
                })
                .catch(function () {
                    box.className = 'error';
                    box.textContent = 'Oops! An error occurred and your request could not be sent.';
                });
        });
    })();
    </script>
<?php require __DIR__ . '/includes/footer.php'; ?>
