<?php
require_once __DIR__ . '/../config/config.php';

$pageTitle       = 'Australia Accounting & Bookkeeping (Launching Soon) | get-accountant';
$metaDescription = 'get-accountant is launching Accounting & Bookkeeping for Australian businesses: BAS preparation, STP payroll, and Xero cloud bookkeeping.';
$currentPage     = 'index.php';

$waitlistSaved = false;
$waitlistErr   = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $waitlistErr = 'Security check failed. Please refresh and try again.';
    } else {
        $name  = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $tool  = trim($_POST['tool'] ?? '');

        if (empty($name) || empty($email)) {
            $waitlistErr = 'Please provide your name and email.';
        } else {
            if ($pdo = db()) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO leads (type, name, email, phone, subject, service, status)
                        VALUES ('contact', :name, :email, :phone, 'AU Bookkeeping Waitlist', :service, 'new')");
                    $stmt->execute([
                        'name'    => $name,
                        'email'   => $email,
                        'phone'   => $phone,
                        'service' => 'Australia Accounting & Bookkeeping' . ($tool ? " ({$tool})" : ''),
                    ]);
                    $waitlistSaved = true;
                } catch (Throwable $e) {}
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo e($metaDescription); ?>">
  <title><?php echo e($pageTitle); ?></title>

  <!-- Dynamic Favicon with Brand "g-a" identity -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='16' fill='%23ffffff'/><rect width='64' height='64' rx='16' fill='none' stroke='%23e2e8f0' stroke-width='2'/><text x='11' y='41' fill='%23e53935' font-family='system-ui, sans-serif' font-weight='900' font-size='23' letter-spacing='-0.5'>g-a</text></svg>">

  <!-- Tailwind CSS & Inter Font -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            mono: ['"Space Grotesk"', 'sans-serif']
          },
          colors: {
            brand: {
              red: '#e53935',
              darkred: '#b91c1c',
              lightred: '#fee2e2',
              navy: '#0f172a',
              accent: '#0284c7'
            }
          },
          boxShadow: {
            'glow': '0 0 50px -10px rgba(229, 57, 53, 0.25)'
          }
        }
      }
    }
  </script>

  <style>
    /* Custom grid pattern background */
    .bg-grid-pattern {
      background-size: 40px 40px;
      background-image:
        linear-gradient(to right, rgba(15, 23, 42, 0.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
    }

    .glow-radial {
      background: radial-gradient(circle at 50% 20%, rgba(229, 57, 53, 0.08) 0%, rgba(255, 255, 255, 0) 65%);
    }

    @keyframes pulseGlow {
      0%, 100% { opacity: 0.3; transform: scale(1); }
      50% { opacity: 0.6; transform: scale(1.05); }
    }
    .pulse-glow {
      animation: pulseGlow 5s ease-in-out infinite;
    }

    .au-wordmark {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 22px;
      letter-spacing: -0.02em;
      color: #0f172a;
    }

    .au-wordmark-e {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 800;
      color: #e53935;
    }
  </style>
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-brand-red selection:text-white min-h-screen relative overflow-x-hidden">

  <!-- Ambient Light Orbs -->
  <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[600px] glow-radial pointer-events-none -z-10"></div>
  <div class="fixed -top-40 -right-40 w-96 h-96 bg-brand-red/5 rounded-full blur-3xl pointer-events-none -z-10 pulse-glow"></div>
  <div class="fixed top-1/2 -left-40 w-96 h-96 bg-sky-500/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

  <!-- Header / Navigation Bar -->
  <header class="border-b border-slate-200 bg-white/80 backdrop-blur-md sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between gap-3">

      <!-- Brand Logo -->
      <a href="<?php echo site_url('index.php'); ?>" class="flex items-center gap-2 sm:gap-3 group min-w-0">
        <span class="au-wordmark text-base sm:text-xl whitespace-nowrap">g<span class="au-wordmark-e">e</span>t-accountant</span>
        <div class="hidden sm:block">
          <span class="text-xs px-2 py-0.5 font-bold uppercase rounded-md bg-brand-red/10 border border-brand-red/30 text-brand-red align-middle">AU</span>
          <p class="text-[11px] text-slate-500 font-medium mt-0.5">Australia Accounting &amp; Bookkeeping</p>
        </div>
        <span class="sm:hidden text-[10px] px-1.5 py-0.5 font-bold uppercase rounded bg-brand-red/10 border border-brand-red/30 text-brand-red">AU</span>
      </a>

      <!-- Quick Actions -->
      <div class="flex items-center gap-3 flex-none">
        <a href="<?php echo site_url('nz/accounting/'); ?>" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 transition">
          <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-brand-red/10 border border-brand-red/30 text-brand-red">NZ</span>
          <span>Explore Live NZ Portal</span>
          <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
        </a>
        <a href="<?php echo site_url('nz/accounting/'); ?>" class="sm:hidden inline-flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 transition" aria-label="Explore Live NZ Portal">
          <span class="text-[10px] font-bold text-brand-red">NZ</span>
        </a>
      </div>

    </div>
  </header>

  <!-- Hero Section -->
  <main class="relative bg-grid-pattern pt-6 pb-10 sm:pt-8 sm:pb-16 lg:pt-14 lg:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Top Status Banner -->
      <div class="flex flex-wrap items-center justify-between gap-3 mb-6 sm:mb-8 pb-5 sm:pb-6 border-b border-slate-200">
        <div class="inline-flex items-center gap-2.5 px-3 py-1.5 sm:px-3.5 rounded-full bg-brand-red/10 border border-brand-red/30 backdrop-blur-sm">
          <span class="flex h-2 w-2 rounded-full bg-brand-red relative flex-none">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-red opacity-75"></span>
          </span>
          <span class="text-[10px] sm:text-xs font-bold tracking-wide uppercase text-brand-red">AUSTRALIA EXPANSION &bull; LAUNCHING SOON</span>
        </div>

        <!-- Breadcrumb tracker -->
        <nav class="hidden sm:flex items-center gap-2 text-xs text-slate-500 font-medium">
          <a href="<?php echo site_url('index.php'); ?>" class="hover:text-slate-900 transition">Home</a>
          <span class="text-slate-300">/</span>
          <span class="text-slate-600">Oceania</span>
          <span class="text-slate-300">/</span>
          <span class="text-brand-red font-semibold">Australia Launch</span>
        </nav>
      </div>

      <!-- Main Layout Grid: Left Content + Right Form -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-12 items-start">

        <!-- Left Column: Copy & Value Proposition -->
        <div class="lg:col-span-7 space-y-6 sm:space-y-8">

          <div class="space-y-3 sm:space-y-4">
            <div class="flex items-center gap-2 text-brand-accent text-xs sm:text-sm font-semibold tracking-wider uppercase">
              <i class="fa-solid fa-chart-line"></i>
              <span>Next-Gen Cloud Accounting &amp; Payroll</span>
            </div>

            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
              Smarter, ATO-compliant bookkeeping for <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-red via-rose-500 to-amber-500">Australian Businesses.</span>
            </h1>

            <p class="text-slate-600 text-sm sm:text-lg leading-relaxed max-w-2xl font-normal">
              We are bringing our disciplined, proactive accounting workflows to Australian SMBs, startups, and contractors. Say goodbye to GST panic, messy STP payroll reports, and end-of-quarter stress.
            </p>
          </div>

          <!-- Feature Spotlight Cards -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

            <!-- Card 1 -->
            <div class="p-4 rounded-xl bg-white border border-slate-200 hover:border-slate-300 hover:shadow-md transition group">
              <div class="w-10 h-10 rounded-lg bg-brand-red/10 border border-brand-red/30 flex items-center justify-center text-brand-red mb-3 group-hover:scale-105 transition">
                <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-1">BAS &amp; IAS Lodgments</h3>
              <p class="text-xs text-slate-500 leading-relaxed">
                Seamless monthly &amp; quarterly ATO tax reporting, automated GST checks, and on-time compliance without the penalties.
              </p>
            </div>

            <!-- Card 2 -->
            <div class="p-4 rounded-xl bg-white border border-slate-200 hover:border-slate-300 hover:shadow-md transition group">
              <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-500 mb-3 group-hover:scale-105 transition">
                <i class="fa-solid fa-users-gear text-lg"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-1">STP Phase 2 Payroll</h3>
              <p class="text-xs text-slate-500 leading-relaxed">
                Real-time single touch payroll lodgments, Superannuation Guarantee (SG 11.5%+), leave balances, and employee portals.
              </p>
            </div>

            <!-- Card 3 -->
            <div class="p-4 rounded-xl bg-white border border-slate-200 hover:border-slate-300 hover:shadow-md transition group">
              <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-105 transition">
                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-1">Daily Xero &amp; MYOB Sync</h3>
              <p class="text-xs text-slate-500 leading-relaxed">
                Automated bank feeds, clean receipt reconciliation, invoice matching, and live cash flow dashboards tailored for AU banks.
              </p>
            </div>

            <!-- Card 4 -->
            <div class="p-4 rounded-xl bg-white border border-slate-200 hover:border-slate-300 hover:shadow-md transition group">
              <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-500 mb-3 group-hover:scale-105 transition">
                <i class="fa-solid fa-shield-halved text-lg"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-1">Dedicated AU Lead</h3>
              <p class="text-xs text-slate-500 leading-relaxed">
                Direct phone and Slack access to your designated bookkeeper. No ticketing blackholes or delayed quarterly reviews.
              </p>
            </div>

          </div>

        </div>

        <!-- Right Column: Waitlist Conversion Card -->
        <div class="lg:col-span-5 relative">

          <!-- Outer Decorative Glow -->
          <div class="absolute -inset-1 bg-gradient-to-r from-brand-red to-amber-400 rounded-2xl blur-lg opacity-20 -z-10"></div>

          <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-xl relative">

            <!-- Badge -->
            <div class="flex items-center justify-between mb-4">
              <span class="text-[11px] font-bold tracking-wider uppercase px-2.5 py-1 rounded bg-brand-red/10 text-brand-red border border-brand-red/30">
                Priority Early Access
              </span>
            </div>

            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Register for AU Launch</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-6">
              Lock in your founding partner pricing and receive instant notification the day onboarding goes live.
            </p>

            <?php if ($waitlistSaved): ?>
              <!-- Success Box -->
              <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                <div class="flex items-start gap-3">
                  <i class="fa-solid fa-circle-check text-emerald-500 text-xl mt-0.5"></i>
                  <div>
                    <h4 class="font-bold text-sm text-emerald-900">You're on the priority list!</h4>
                    <p class="text-xs text-emerald-700 mt-0.5">We've reserved your spot and early-bird onboarding consultation.</p>
                  </div>
                </div>
              </div>
            <?php elseif ($waitlistErr): ?>
              <!-- Error Box -->
              <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                <div class="flex items-start gap-3">
                  <i class="fa-solid fa-triangle-exclamation text-red-500 text-xl mt-0.5"></i>
                  <p class="text-xs text-red-700"><?php echo e($waitlistErr); ?></p>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!$waitlistSaved): ?>
            <!-- Waitlist Form -->
            <form action="" method="post" class="space-y-4">
              <?php echo csrf_field(); ?>

              <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                  Full Name / Business Owner <span class="text-brand-red">*</span>
                </label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-regular fa-user"></i>
                  </div>
                  <input type="text" name="name" required placeholder="e.g. Lachlan Murdoch"
                    class="w-full bg-slate-50 border border-slate-300 rounded-lg pl-10 pr-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red transition">
                </div>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                  Business Email <span class="text-brand-red">*</span>
                </label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-regular fa-envelope"></i>
                  </div>
                  <input type="email" name="email" required placeholder="lachlan@company.com.au"
                    class="w-full bg-slate-50 border border-slate-300 rounded-lg pl-10 pr-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red transition">
                </div>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                  Phone (AU Mobile or Landline)
                </label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-phone"></i>
                  </div>
                  <input type="tel" name="phone" placeholder="+61 400 000 000"
                    class="w-full bg-slate-50 border border-slate-300 rounded-lg pl-10 pr-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-brand-red focus:ring-1 focus:ring-brand-red transition">
                </div>
              </div>

              <!-- Software Preference Selector -->
              <div>
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                  Current Accounting Tool
                </label>
                <div class="grid grid-cols-3 gap-2">
                  <label class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border border-slate-300 bg-slate-50 cursor-pointer text-xs font-semibold text-slate-600 hover:border-brand-red has-[:checked]:border-brand-red has-[:checked]:bg-brand-red/10 has-[:checked]:text-brand-red transition">
                    <input type="radio" name="tool" value="Xero" class="hidden" checked>
                    <span>Xero</span>
                  </label>
                  <label class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border border-slate-300 bg-slate-50 cursor-pointer text-xs font-semibold text-slate-600 hover:border-brand-red has-[:checked]:border-brand-red has-[:checked]:bg-brand-red/10 has-[:checked]:text-brand-red transition">
                    <input type="radio" name="tool" value="MYOB" class="hidden">
                    <span>MYOB</span>
                  </label>
                  <label class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border border-slate-300 bg-slate-50 cursor-pointer text-xs font-semibold text-slate-600 hover:border-brand-red has-[:checked]:border-brand-red has-[:checked]:bg-brand-red/10 has-[:checked]:text-brand-red transition">
                    <input type="radio" name="tool" value="QuickBooks" class="hidden">
                    <span>QuickBooks</span>
                  </label>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full mt-2 py-3.5 px-6 rounded-lg bg-gradient-to-r from-brand-red to-rose-600 hover:from-brand-darkred hover:to-brand-red text-white font-bold text-sm shadow-lg shadow-brand-red/20 hover:shadow-brand-red/30 transition duration-200 flex items-center justify-center gap-2 group">
                <span>Notify Me on Launch</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition duration-200"></i>
              </button>

              <div class="pt-2 text-center text-[11px] text-slate-500 flex items-center justify-center gap-2">
                <i class="fa-solid fa-shield-check text-emerald-500"></i>
                <span>Strict privacy. No spam. Unsubscribe anytime.</span>
              </div>
            </form>
            <?php endif; ?>

            <!-- Early Perks Included -->
            <div class="mt-6 pt-5 border-t border-slate-200">
              <span class="text-[11px] uppercase font-bold text-slate-500 tracking-wider block mb-2">Waitlist Perks:</span>
              <ul class="text-xs text-slate-600 space-y-1.5">
                <li class="flex items-center gap-2">
                  <i class="fa-solid fa-check text-brand-red"></i>
                  <span>Free Initial Chart of Accounts ATO review</span>
                </li>
                <li class="flex items-center gap-2">
                  <i class="fa-solid fa-check text-brand-red"></i>
                  <span>Dedicated Australian Account Manager setup</span>
                </li>
                <li class="flex items-center gap-2">
                  <i class="fa-solid fa-check text-brand-red"></i>
                  <span>First month 30% discount on standard plans</span>
                </li>
              </ul>
            </div>

          </div>
        </div>

      </div>

      <!-- Trust Badges & Tech Stack -->
      <div class="mt-12 pt-8 sm:mt-20 sm:pt-10 border-t border-slate-200">
        <p class="text-center text-xs font-bold uppercase tracking-widest text-slate-400 mb-5 sm:mb-6">
          Supporting the Australian SME Cloud Ecosystem
        </p>
        <div class="flex flex-wrap items-center justify-center gap-5 sm:gap-8 md:gap-14 opacity-80 grayscale hover:grayscale-0 transition duration-300">
          <div class="flex items-center gap-2 text-slate-700 font-bold text-xs sm:text-sm tracking-wide">
            <i class="fa-solid fa-building-columns text-brand-red text-lg"></i> ATO Compliant
          </div>
          <div class="flex items-center gap-2 text-slate-700 font-bold text-xs sm:text-sm tracking-wide">
            <i class="fa-solid fa-bolt text-brand-accent text-lg"></i> Xero Cloud Silver
          </div>
          <div class="flex items-center gap-2 text-slate-700 font-bold text-xs sm:text-sm tracking-wide">
            <i class="fa-solid fa-briefcase text-purple-500 text-lg"></i> MYOB Partner
          </div>
          <div class="flex items-center gap-2 text-slate-700 font-bold text-xs sm:text-sm tracking-wide">
            <i class="fa-solid fa-fingerprint text-emerald-500 text-lg"></i> STP Phase 2 Ready
          </div>
          <div class="flex items-center gap-2 text-slate-700 font-bold text-xs sm:text-sm tracking-wide">
            <i class="fa-solid fa-lock text-amber-500 text-lg"></i> 256-Bit Bank Security
          </div>
        </div>
      </div>

    </div>
  </main>

  <footer class="border-t border-slate-200 bg-slate-50 py-8 text-center text-xs text-slate-500">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <span class="font-extrabold text-brand-red">get-accountant</span>
        <span>&copy; <?php echo date('Y'); ?>. All rights reserved.</span>
      </div>
      <div class="flex items-center gap-6">
        <a href="<?php echo site_url('privacy-policy.php'); ?>" class="hover:text-slate-900 transition">Privacy Policy</a>
        <a href="<?php echo site_url('terms-of-use.php'); ?>" class="hover:text-slate-900 transition">Terms of Use</a>
        <a href="<?php echo site_url('nz/accounting/'); ?>" class="text-brand-red hover:underline">New Zealand Division &rarr;</a>
      </div>
    </div>
  </footer>

</body>
</html>
