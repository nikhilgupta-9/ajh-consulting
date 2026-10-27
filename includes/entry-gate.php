<?php
/**
 * Entry gate — shown once per visitor (remembered via cookie for 30 days).
 * Asks: (1) Business or Accountant, (2) New Zealand or Australia, then
 * redirects to the matching branch page. Included from header.php, but
 * only rendered on the pages listed in $gateExcludedPages below so the
 * gate itself, the branch pages and the admin panel are never blocked.
 */
$gateExcludedPages = [
    'get-started.php',
    'australia.php',
    'contactus.php',
];
// Any page inside /nz/ or /au/ (the branch hub pages themselves, or their
// sub-pages) should never show the gate either.
$__requestPath  = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
$__isBranchPage = (bool) preg_match('#/(nz|au)/#', $__requestPath);
$showEntryGate  = !$__isBranchPage && !in_array($currentPage, $gateExcludedPages, true) && empty($_COOKIE['ga_gate']) && empty($_COOKIE['ga_country']) && empty($_COOKIE['ga_user_track']);
?>
<?php if ($showEntryGate): ?>
    <div id="entry-gate" class="entry-gate">
        <div class="entry-gate-box">
            <div class="entry-gate-logo">
                <img src="assets/images/logo/logo-get-accountant-wordmark.png" alt="get-accountant">
            </div>

            <div class="entry-gate-progress">
                <span class="entry-gate-dot is-active" data-dot="1"></span>
                <span class="entry-gate-dot" data-dot="2"></span>
            </div>

            <!-- Step 1 -->
            <div class="entry-gate-step entry-gate-step--cards" data-step="1">
                <div class="entry-gate-eyebrow">People. Process. Possibility.</div>
                <h3>Let's find the right support for you</h3>
                <p>Choose what best describes you &mdash; we'll take you straight to the services that are relevant.</p>
                <div class="entry-gate-cards">
                    <button type="button" class="entry-gate-card" data-who="business">
                        <span class="entry-gate-card-icon" aria-hidden="true"><i class="fas fa-briefcase"></i></span>
                        <span class="entry-gate-card-title">I run a business</span>
                        <span class="entry-gate-card-desc">Bookkeeping, tax returns, GST &amp; ongoing accounting support for your business.</span>
                        <span class="entry-gate-card-cta">Explore business services &rarr;</span>
                    </button>
                    <button type="button" class="entry-gate-card" data-who="accountant">
                        <span class="entry-gate-card-icon" aria-hidden="true"><i class="fas fa-chart-pie"></i></span>
                        <span class="entry-gate-card-title">I'm an accountant or firm</span>
                        <span class="entry-gate-card-desc">Outsourced bookkeeping, workpapers &amp; tax prep for your practice to review.</span>
                        <span class="entry-gate-card-cta">Explore firm outsourcing &rarr;</span>
                    </button>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="entry-gate-step entry-gate-step--cards" data-step="2" hidden>
                <div class="entry-gate-eyebrow">Last step</div>
                <h3>Which country are you in?</h3>
                <p>We'll take you to the site for your region.</p>
                <div class="entry-gate-cards entry-gate-cards--country">
                    <button type="button" class="entry-gate-card entry-gate-card--country" data-country="nz">
                        <span class="entry-gate-card-flag" aria-hidden="true"><img src="https://flagcdn.com/w80/nz.png" srcset="https://flagcdn.com/w160/nz.png 2x" alt=""></span>
                        <span class="entry-gate-card-title">New Zealand</span>
                        <span class="entry-gate-card-cta">Continue &rarr;</span>
                    </button>
                    <button type="button" class="entry-gate-card entry-gate-card--country" data-country="au">
                        <span class="entry-gate-card-flag" aria-hidden="true"><img src="https://flagcdn.com/w80/au.png" srcset="https://flagcdn.com/w160/au.png 2x" alt=""></span>
                        <span class="entry-gate-card-title">Australia</span>
                        <span class="entry-gate-card-cta">Continue &rarr;</span>
                    </button>
                </div>
                <button type="button" class="entry-gate-back">&larr; Back</button>
            </div>
        </div>
    </div>

    <style>
        .entry-gate {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px
        }

        .entry-gate-box {
            max-width: 640px;
            width: 100%;
            text-align: center
        }

        .entry-gate-logo {
            margin-bottom: 24px
        }

        .entry-gate-logo img {
            max-height: 34px;
            width: auto
        }

        .entry-gate-progress {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 32px
        }

        .entry-gate-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #eee;
            transition: .2s
        }

        .entry-gate-dot.is-active {
            background: var(--color-primary);
            width: 22px;
            border-radius: 5px
        }

        .entry-gate-eyebrow {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: var(--color-primary);
            margin-bottom: 14px
        }

        .entry-gate-step h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1a1a1a;
            letter-spacing: -.5px
        }

        .entry-gate-step p {
            color: #666;
            margin-bottom: 30px
        }

        .entry-gate-options {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center
        }

        .entry-gate-btn {
            flex: 1 1 200px;
            padding: 18px 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            background: #fff;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            cursor: pointer;
            transition: .2s
        }

        .entry-gate-btn:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
            background: #fff5f5
        }

        .entry-gate-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap
        }

        .entry-gate-card {
            flex: 1 1 240px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            padding: 26px 22px;
            border: 2px solid #eee;
            border-radius: 14px;
            background: #fff;
            cursor: pointer;
            transition: .2s
        }

        .entry-gate-card:hover {
            border-color: var(--color-primary);
            background: #fff5f5;
            transform: translateY(-2px)
        }

        .entry-gate-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: #fff5f5;
            color: var(--color-primary);
            font-size: 19px;
            margin-bottom: 16px;
            transition: .2s
        }

        .entry-gate-card:hover .entry-gate-card-icon {
            background: var(--color-primary);
            color: #fff
        }

        .entry-gate-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px
        }

        .entry-gate-card-desc {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 18px
        }

        .entry-gate-card-cta {
            font-size: 13px;
            font-weight: 700;
            color: var(--color-primary);
            margin-top: auto
        }

        .entry-gate-card--country {
            align-items: center;
            text-align: center
        }

        .entry-gate-card-flag {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 14px;
            border: 2px solid #eee;
            transition: .2s
        }

        .entry-gate-card-flag img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .entry-gate-card:hover .entry-gate-card-flag {
            border-color: var(--color-primary)
        }

        .entry-gate-card--country .entry-gate-card-title {
            margin-bottom: 6px
        }

        .entry-gate-back {
            margin-top: 24px;
            background: none;
            border: none;
            color: #999;
            font-size: 14px;
            cursor: pointer;
            text-decoration: underline
        }

        @media (max-width:576px) {
            .entry-gate-step h3 {
                font-size: 22px
            }

            .entry-gate-options {
                flex-direction: column
            }

            .entry-gate-cards {
                flex-direction: column
            }
        }
    </style>

    <script>
        (function () {
            function setCookie(name, value, days) {
                var d = new Date();
                d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
                document.cookie = name + '=' + value + ';expires=' + d.toUTCString() + ';path=/';
            }

            var gate = document.getElementById('entry-gate');
            if (!gate) { return; }

            var who = null;
            var step1 = gate.querySelector('[data-step="1"]');
            var step2 = gate.querySelector('[data-step="2"]');
            var dot1 = gate.querySelector('[data-dot="1"]');
            var dot2 = gate.querySelector('[data-dot="2"]');

            step1.querySelectorAll('[data-who]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    who = btn.getAttribute('data-who');
                    step1.hidden = true;
                    step2.hidden = false;
                    dot1.classList.remove('is-active');
                    dot2.classList.add('is-active');
                });
            });

            step2.querySelector('.entry-gate-back').addEventListener('click', function () {
                step2.hidden = true;
                step1.hidden = false;
                dot2.classList.remove('is-active');
                dot1.classList.add('is-active');
            });

            var base = <?php echo json_encode(site_url()); ?>;

            step2.querySelectorAll('[data-country]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var country = btn.getAttribute('data-country');
                    var dest = base + 'index.php';

                    if (who === 'business') {
                        dest = base + country + '/accounting/';
                    } else if (who === 'accountant') {
                        dest = base + country + '/accounting-firm/';
                    }

                    setCookie('ga_country', country, 365);
                    setCookie('ga_track', (who === 'accountant' ? 'firm' : 'business'), 365);
                    setCookie('ga_gate', who + '_' + country, 365);
                    window.location.href = dest;
                });
            });
        })();
    </script>
<?php endif; ?>