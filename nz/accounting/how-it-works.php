<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'How It Works | Onboarding & Ongoing Bookkeeping Process';
$metaDescription = 'Our simple 4-step onboarding and ongoing bookkeeping process for New Zealand businesses: from initial consultation to proactive IRD compliance.';
$pageHeading     = 'How It Works';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';

$steps = [
    [
        'step'     => '01',
        'title'    => 'Free Discovery & Needs Assessment',
        'subtitle' => 'We learn your business, pain points, and current software.',
        'desc'     => 'We schedule a 20-minute video or phone call to review your current transaction volume, IRD filing frequency, payroll size, and software setup (Xero, MYOB, or spreadsheets). Based on this, we provide a clear, fixed-price monthly proposal with zero hidden fees.',
        'deliverables' => ['Complete scope review', 'Fixed monthly quote', 'Software recommendation'],
    ],
    [
        'step'     => '02',
        'title'    => 'Secure Connection & Historical Clean-Up',
        'subtitle' => 'We connect to your accounts and get your numbers audit-ready.',
        'desc'     => 'You invite our registered agency account to your Xero or MYOB portal. We set up automated bank feeds, configure receipt capture apps (Dext or Hubdoc), and perform any necessary historical catch-up reconciliation to bring your ledger 100% up to date.',
        'deliverables' => ['Bank feed authentication', 'Dext/Hubdoc receipt routing', 'Historical ledger audit & cleanup'],
    ],
    [
        'step'     => '03',
        'title'    => 'Routine Processing & Payroll Management',
        'subtitle' => 'Your dedicated bookkeeper takes over day-to-day administration.',
        'desc'     => 'On an agreed weekly or fortnightly schedule, your dedicated bookkeeper codes all bank lines, matches supplier receipts, tracks customer invoices, and runs payday payroll with automated payday filing to Inland Revenue under the Holidays Act.',
        'deliverables' => ['Weekly bank reconciliation', 'Payday IRD filing & payslips', 'Supplier bill & payment tracking'],
    ],
    [
        'step'     => '04',
        'title'    => 'Monthly Reporting & Proactive IRD Filing',
        'subtitle' => 'Clear executive reports and timely GST filings.',
        'desc'     => 'At month-end, you receive an executive management pack with Profit & Loss, Balance Sheet, and cash flow commentary. Whenever a GST return or provisional tax date approaches, we prepare and file the return with IRD 10 business days early.',
        'deliverables' => ['Monthly P&L and Balance Sheet', 'Bi-monthly GST returns filed with myIR', 'Year-end financial statements'],
    ],
];
?>

    <div class="working-process-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Simple &amp; Transparent</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">How We Take Bookkeeping Off Your Plate</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Getting started with get-accountant is effortless. Here is the exact journey from your first inquiry to proactive ongoing bookkeeping.
                    </p>
                </div>
            </div>

            <!-- Steps Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($steps as $s): ?>
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--40">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px 30px; height: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.05); display: flex; flex-direction: column;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <span style="font-size: 42px; font-weight: 800; color: #e53935; line-height: 1;"><?php echo e($s['step']); ?></span>
                            <span style="background: #fef2f2; color: #e53935; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; text-transform: uppercase;">Stage <?php echo e($s['step']); ?></span>
                        </div>
                        <h3 class="title h4" style="font-size: 22px; color: #0f172a; margin-bottom: 8px;"><?php echo e($s['title']); ?></h3>
                        <p style="color: #e53935; font-size: 14px; font-weight: 600; margin-bottom: 15px;"><?php echo e($s['subtitle']); ?></p>
                        <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.7; margin-bottom: 24px; flex-grow: 1;">
                            <?php echo e($s['desc']); ?>
                        </p>
                        <div style="border-top: 1px solid #f1f5f9; padding-top: 16px;">
                            <span style="display: block; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 8px;">Key Deliverables:</span>
                            <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 6px;">
                                <?php foreach ($s['deliverables'] as $del): ?>
                                <li style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: #1e293b;">
                                    <i class="fas fa-check-circle" style="color: #22c55e;"></i> <?php echo e($del); ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- What We Need From You Box -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 40px 35px; margin-top: 40px;">
                <div class="flex flex-wrap -mx-[15px] items-center">
                    <div class="xl:w-1/3 lg:w-1/3 px-[15px]">
                        <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; font-size: 12px;">Hassle-Free Handover</span>
                        <h3 style="font-size: 26px; color: #0f172a; margin: 8px 0 10px;">What We Need From You to Start</h3>
                        <p style="color: #64748b; font-size: 14.5px; margin: 0;">Setup takes less than 30 minutes of your time. We do all the heavy lifting.</p>
                    </div>
                    <div class="xl:w-2/3 lg:w-2/3 px-[15px] mt_md--20 mt_sm--20">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div style="background: #fff; padding: 16px 20px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-key" style="color: #e53935; font-size: 18px;"></i>
                                <span style="font-size: 14px; font-weight: 600; color: #1e293b;">Invite us to Xero or MYOB</span>
                            </div>
                            <div style="background: #fff; padding: 16px 20px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-file-invoice" style="color: #e53935; font-size: 18px;"></i>
                                <span style="font-size: 14px; font-weight: 600; color: #1e293b;">Forward supplier invoices via email</span>
                            </div>
                            <div style="background: #fff; padding: 16px 20px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-university" style="color: #e53935; font-size: 18px;"></i>
                                <span style="font-size: 14px; font-weight: 600; color: #1e293b;">Connect bank feeds automatically</span>
                            </div>
                            <div style="background: #fff; padding: 16px 20px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-comments" style="color: #e53935; font-size: 18px;"></i>
                                <span style="font-size: 14px; font-weight: 600; color: #1e293b;">Answer quick monthly queries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Ready to Begin Step 1?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule your free 20-minute discovery call with our Auckland accounting team.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Start Your Free Assessment <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
