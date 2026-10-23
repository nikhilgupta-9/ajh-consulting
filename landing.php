<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Choose Your Service | get-accountant';
$metaDescription = 'Select the accounting, bookkeeping or firm outsourcing service you need. We will take you straight to your tailored service page.';

// Check existing cookies
$savedTrack   = $_COOKIE['ga_user_track'] ?? '';
$savedCountry = $_COOKIE['ga_user_country'] ?? 'nz';
$savedService = $_COOKIE['ga_user_service'] ?? '';
?>
<!DOCTYPE html>
<html lang="en" style="color-scheme: light;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($pageTitle); ?></title>
    <meta name="description" content="<?php echo e($metaDescription); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('assets/images/fav.png'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/gateway-mockup.css'); ?>">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #172333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .ga-landing-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ga-header-simple {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 36px;
            border-bottom: 1px solid #dde3eb;
            background: #fff;
        }

        .ga-logo-simple {
            font-size: 26px;
            font-weight: 800;
            color: #d71932;
            text-decoration: none;
            letter-spacing: -1px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ga-logo-simple span {
            font-size: 11px;
            font-weight: 700;
            color: #536172;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .ga-footer-simple {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 36px;
            border-top: 1px solid #dde3eb;
            font-size: 12px;
            color: #536172;
            background: #f8fafc;
            flex-wrap: wrap;
            gap: 12px;
        }

        .ga-footer-simple a {
            color: #172333;
            font-weight: 600;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .ga-header-simple, .ga-footer-simple {
                padding: 16px 20px;
            }
        }
    </style>
</head>
<body>

<div class="ga-landing-wrap" id="ga-preview">

    <!-- 1. Top Bar -->
    <div class="ga-top">
        <span>Accounting &amp; tax support for businesses. Outsourcing for accounting firms.</span>
    </div>

    <!-- 2. Simple Branded Header -->
    <header class="ga-header-simple">
        <a href="<?php echo site_url('index.php'); ?>" class="ga-logo-simple">
            get-accountant
            <span>NZ / AU</span>
        </a>
        <div class="ga-country-selector">
            <label for="ga-country-select" style="margin: 0; font-weight: 600;">Country</label>
            <select id="ga-country-select" aria-label="Select Country">
                <option value="nz" <?php echo $savedCountry === 'nz' ? 'selected' : ''; ?>>🇳🇿 New Zealand</option>
                <option value="au" <?php echo $savedCountry === 'au' ? 'selected' : ''; ?>>🇦🇺 Australia · Launching soon</option>
            </select>
        </div>
    </header>

    <!-- 3. Returning User Notice (if cookie is set) -->
    <?php if (!empty($savedTrack)): ?>
    <div class="ga-returning-banner" id="ga-returning-banner">
        <div class="ga-return-info">
            <span class="ga-return-badge">Saved Preference</span>
            <span>
                Welcome back! You previously selected <strong><?php echo $savedCountry === 'au' ? 'Australia' : 'New Zealand'; ?> &bull; <?php echo $savedTrack === 'firm' ? 'Accounting Firm Outsourcing' : 'Business Accounting &amp; Bookkeeping'; ?></strong>.
            </span>
        </div>
        <div class="ga-return-actions">
            <?php 
                $destUrl = site_url(($savedCountry === 'au' ? 'australia.php?track=' : 'nz/accounting') . ($savedTrack === 'firm' ? ($savedCountry === 'au' ? '' : '-firm/') : '/'));
            ?>
            <a href="<?php echo $destUrl; ?>" class="ga-return-btn">
                Go Straight to Selected Service &rarr;
            </a>
            <button type="button" class="ga-return-switch" id="ga-reset-cookie-btn">
                Choose Different Service ▾
            </button>
        </div>
    </div>
    <?php endif; ?>

    <!-- 4. The Gateway Service Selector (Mockup UI) -->
    <main>
        <section class="ga-home" id="ga-home-view">
            <div class="ga-intro">
                <div class="ga-eyebrow">PEOPLE. PROCESS. POSSIBILITY.™</div>
                <h1>The right accounting support.<br><span>For your business. For your firm.</span></h1>
                <p>
                    Please tell us which service you need. We’ll take you straight to your specific service page in <strong class="ga-region-name" style="color: #172333;"><?php echo $savedCountry === 'au' ? 'Australia' : 'New Zealand'; ?></strong>.
                </p>
            </div>

            <!-- Two Dedicated Pathway Cards -->
            <div class="ga-paths">
                
                <!-- Card 1: FOR BUSINESSES -->
                <article class="ga-path" id="card-business">
                    <div class="ga-kicker">FOR BUSINESSES</div>
                    <h2>More time for your business.<br>Less time on the books.</h2>
                    <p class="ga-path-desc">Practical accounting, bookkeeping and tax support to help you stay organised and understand your numbers.</p>
                    
                    <ul class="ga-features">
                        <li>Bookkeeping &amp; daily bank reconciliations</li>
                        <li>Tax returns, GST filing &amp; annual financial accounts</li>
                        <li>Payroll, PAYE, KiwiSaver &amp; ongoing reporting</li>
                    </ul>

                    <!-- Service Pills (Direct Redirection) -->
                    <div class="ga-service-pills">
                        <span class="ga-pills-label">Which business service do you need?</span>
                        <div class="ga-pills-wrap">
                            <button type="button" class="ga-pill" data-track="business" data-service="bookkeeping">Bookkeeping &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="tax-returns-gst">Tax returns &amp; GST &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="annual-accounts">Annual accounts &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="payroll">Payroll &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="catch-up-accounting" style="border-color: #f87171; color: #dc2626;">Catch-up accounting &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="business-reporting">Business reporting &rarr;</button>
                            <button type="button" class="ga-pill" data-track="business" data-service="tax-advice">Tax Advice &amp; Planning &rarr;</button>
                        </div>
                    </div>

                    <button class="ga-action" data-view="business" type="button">
                        <span>Explore All Business Services</span>
                        <span class="ga-arrow">&rarr;</span>
                    </button>
                    <div class="ga-caption">For business owners, sole traders &amp; growing companies</div>
                </article>

                <!-- Card 2: FOR ACCOUNTING FIRMS -->
                <article class="ga-path ga-firm" id="card-firm">
                    <div class="ga-kicker">FOR ACCOUNTING FIRMS</div>
                    <h2>Extra capacity.<br>Your standards. Your clients.</h2>
                    <p class="ga-path-desc">Outsourced accounting support that fits your practice’s workflows, systems and review requirements.</p>
                    
                    <ul class="ga-features">
                        <li>Bookkeeping &amp; reconciliation support</li>
                        <li>Year-end accounts &amp; audit-ready workpaper preparation</li>
                        <li>Tax return preparation for your firm’s review</li>
                    </ul>

                    <!-- Workflow Pills (Direct Redirection) -->
                    <div class="ga-service-pills">
                        <span class="ga-pills-label">Which practice workflow do you want to delegate?</span>
                        <div class="ga-pills-wrap">
                            <button type="button" class="ga-pill" data-track="firm" data-service="bookkeeping-reconciliations">Bookkeeping &amp; reconciliations &rarr;</button>
                            <button type="button" class="ga-pill" data-track="firm" data-service="year-end-workpapers">Year-end workpapers &rarr;</button>
                            <button type="button" class="ga-pill" data-track="firm" data-service="tax-gst-preparation">Tax &amp; GST preparation &rarr;</button>
                            <button type="button" class="ga-pill" data-track="firm" data-service="payroll-support">Payroll processing support &rarr;</button>
                            <button type="button" class="ga-pill" data-track="firm" data-service="catch-up-projects" style="border-color: #475569; color: #0f172a;">Catch-up &amp; cleanup projects &rarr;</button>
                            <button type="button" class="ga-pill" data-track="firm" data-service="management-reporting">Management reporting &rarr;</button>
                        </div>
                    </div>

                    <button class="ga-action" data-view="firm" type="button">
                        <span>Explore All Firm Outsourcing</span>
                        <span class="ga-arrow">&rarr;</span>
                    </button>
                    <div class="ga-caption">For sole practitioners, accounting firms &amp; practice managers</div>
                </article>

            </div>

            <!-- 3 Next Steps -->
            <div class="ga-next">
                <div>
                    <span class="ga-step">01</span>
                    <strong>Choose your support</strong>
                    <p>Business services or firm outsourcing.</p>
                </div>
                <div>
                    <span class="ga-step">02</span>
                    <strong>Agree the scope</strong>
                    <p>Discuss your needs, turnaround, and fees.</p>
                </div>
                <div>
                    <span class="ga-step">03</span>
                    <strong>Get started</strong>
                    <p>A clear handover, secure systems, and agreed next steps.</p>
                </div>
            </div>

        </section>

        <!-- Interactive Detail Modal / Tab Preview -->
        <section class="ga-detail" id="ga-detail-view" hidden aria-live="polite">
            <button type="button" class="ga-back" id="ga-detail-back-btn">&larr; All support options</button>
            <div class="ga-eyebrow" id="ga-detail-eyebrow"></div>
            <h2 class="ga-detail-title" id="ga-detail-title"></h2>
            <p class="ga-detail-copy" id="ga-detail-copy"></p>
            
            <div class="ga-subnav" id="ga-detail-subnav"></div>
            
            <div class="ga-detail-box" id="ga-detail-box">
                <h3 class="ga-panel-title" id="ga-panel-title"></h3>
                <p class="ga-panel-copy" id="ga-panel-copy"></p>
            </div>

            <div class="ga-detail-actions-row">
                <a href="#" class="ga-detail-action" id="ga-detail-primary-action">
                    <span>Continue to That Service</span> &rarr;
                </a>
            </div>
        </section>
    </main>

    <!-- 5. Simple Footer -->
    <footer class="ga-footer-simple">
        <div>
            <strong>get-accountant</strong> &bull; People. Process. Possibility.™
        </div>
        <div>
            <span>Prefer to visit the full website? <a href="<?php echo site_url('index.php'); ?>">Go to Main Homepage &rarr;</a></span>
        </div>
    </footer>

</div>

<!-- JavaScript Cookie & Instant Redirection Engine -->
<script>
(function() {
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value || "") + expires + "; path=/; SameSite=Lax";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    var baseUrl = <?php echo json_encode(site_url()); ?>;
    var countrySelect = document.getElementById('ga-country-select');
    var regionLabel = document.querySelector('.ga-region-name');
    var homeView = document.getElementById('ga-home-view');
    var detailView = document.getElementById('ga-detail-view');
    var resetCookieBtn = document.getElementById('ga-reset-cookie-btn');
    var returningBanner = document.getElementById('ga-returning-banner');

    var currentTrack = getCookie('ga_user_track') || 'business';

    // Save preferences and redirect
    function selectAndRedirect(track, service) {
        var country = countrySelect.value;
        setCookie('ga_user_track', track, 30);
        setCookie('ga_user_country', country, 30);
        setCookie('ga_gate', (track === 'firm' ? 'accountant' : 'business') + '_' + country, 30);
        if (service) {
            setCookie('ga_user_service', service, 30);
        }

        var destination = '';
        if (country === 'au') {
            destination = baseUrl + 'australia.php?track=' + track + (service ? '&service=' + encodeURIComponent(service) : '');
        } else {
            if (track === 'business') {
                destination = service 
                    ? (baseUrl + 'nz/accounting/services.php?service=' + encodeURIComponent(service))
                    : (baseUrl + 'nz/accounting/');
            } else {
                destination = service 
                    ? (baseUrl + 'nz/accounting-firm/services.php?service=' + encodeURIComponent(service))
                    : (baseUrl + 'nz/accounting-firm/');
            }
        }
        window.location.href = destination;
    }

    // Country Change
    countrySelect.addEventListener('change', function() {
        var selected = this.value;
        if (regionLabel) {
            regionLabel.textContent = selected === 'au' ? 'Australia' : 'New Zealand';
        }
        setCookie('ga_user_country', selected, 30);
    });

    // Pill click -> immediate redirection to that service
    document.querySelectorAll('.ga-pill').forEach(function(pill) {
        pill.addEventListener('click', function() {
            var track = this.getAttribute('data-track');
            var service = this.getAttribute('data-service');
            selectAndRedirect(track, service);
        });
    });

    // Explore Buttons -> redirect to full services portal
    document.querySelectorAll('.ga-action[data-view]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var track = this.getAttribute('data-view');
            selectAndRedirect(track, null);
        });
    });

    // Reset preference button
    if (resetCookieBtn) {
        resetCookieBtn.addEventListener('click', function() {
            eraseCookie('ga_user_track');
            eraseCookie('ga_user_service');
            if (returningBanner) {
                returningBanner.style.display = 'none';
            }
        });
    }

})();
</script>

</body>
</html>

