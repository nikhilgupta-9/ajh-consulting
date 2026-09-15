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
    'accounting-bookkeeping.php',
    'accounting-firm-outsourcing.php',
    'australia.php',
    'contactus.php',
];
$showEntryGate = !in_array($currentPage, $gateExcludedPages, true) && empty($_COOKIE['ga_gate']);
?>
<?php if ($showEntryGate): ?>
<div id="entry-gate" class="entry-gate">
    <div class="entry-gate-box">
        <div class="entry-gate-logo">
            <img src="assets/images/logo/logo-get-accountant-wordmark.png" alt="get-accountant">
        </div>

        <!-- Step 1 -->
        <div class="entry-gate-step" data-step="1">
            <h3>Are you a business or an accountant?</h3>
            <p>This helps us show you the right services.</p>
            <div class="entry-gate-options">
                <button type="button" class="entry-gate-btn" data-who="business">I'm a Business</button>
                <button type="button" class="entry-gate-btn" data-who="accountant">I'm an Accounting Firm</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="entry-gate-step" data-step="2" hidden>
            <h3>Which country are you in?</h3>
            <p>We'll take you to the site for your region.</p>
            <div class="entry-gate-options">
                <button type="button" class="entry-gate-btn" data-country="nz">New Zealand</button>
                <button type="button" class="entry-gate-btn" data-country="au">Australia</button>
            </div>
            <button type="button" class="entry-gate-back">&larr; Back</button>
        </div>
    </div>
</div>

<style>
.entry-gate{position:fixed;inset:0;z-index:99999;background:#fff;display:flex;align-items:center;justify-content:center;padding:20px}
.entry-gate-box{max-width:520px;width:100%;text-align:center}
.entry-gate-logo{margin-bottom:36px}
.entry-gate-logo img{max-height:34px;width:auto}
.entry-gate-step h3{font-size:26px;font-weight:700;margin-bottom:10px;color:#1a1a1a}
.entry-gate-step p{color:#666;margin-bottom:30px}
.entry-gate-options{display:flex;gap:16px;flex-wrap:wrap;justify-content:center}
.entry-gate-btn{flex:1 1 200px;padding:18px 20px;border:2px solid #eee;border-radius:10px;background:#fff;font-size:16px;font-weight:600;color:#1a1a1a;cursor:pointer;transition:.2s}
.entry-gate-btn:hover{border-color:var(--color-primary);color:var(--color-primary);background:#fff5f5}
.entry-gate-back{margin-top:24px;background:none;border:none;color:#999;font-size:14px;cursor:pointer;text-decoration:underline}
@media (max-width:576px){.entry-gate-step h3{font-size:21px}.entry-gate-options{flex-direction:column}}
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

    step1.querySelectorAll('[data-who]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            who = btn.getAttribute('data-who');
            step1.hidden = true;
            step2.hidden = false;
        });
    });

    step2.querySelector('.entry-gate-back').addEventListener('click', function () {
        step2.hidden = true;
        step1.hidden = false;
    });

    step2.querySelectorAll('[data-country]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var country = btn.getAttribute('data-country');
            var dest = 'index.php';

            if (country === 'au') {
                dest = 'australia.php';
            } else if (who === 'business') {
                dest = 'accounting-bookkeeping.php';
            } else if (who === 'accountant') {
                dest = 'accounting-firm-outsourcing.php';
            }

            setCookie('ga_gate', who + '_' + country, 30);
            window.location.href = dest;
        });
    });
})();
</script>
<?php endif; ?>
