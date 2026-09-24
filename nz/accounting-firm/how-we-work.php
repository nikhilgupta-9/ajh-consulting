<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'How We Work with Accounting Firms | get-accountant';
$metaDescription = 'Our 5-step integration process for New Zealand CA and CPA practices: from mutual NDA and SOP alignment to dedicated white-label team production.';
$pageHeading     = 'How We Work with Firms';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';

$firmSteps = [
    [
        'step'     => '01',
        'title'    => 'Mutual NDA & Practice Capacity Scoping',
        'desc'     => 'Before any client data is discussed, we execute a legally binding bilateral Non-Disclosure Agreement (NDA) and non-solicitation agreement under New Zealand law. We then conduct a confidential discovery call to understand your firm’s current bottleneck, workflow volumes, and software stack.',
        'tag'      => 'Legal Protection',
    ],
    [
        'step'     => '02',
        'title'    => 'SOP Alignment & Working Paper Indexing',
        'desc'     => 'Every accounting practice has its own unique chart of accounts preferences, lead schedule formats, and query conventions. We review your internal workpaper templates, checklist standards, and review procedures to ensure our output looks identical to your in-house managers.',
        'tag'      => 'Custom Integration',
    ],
    [
        'step'     => '03',
        'title'    => 'Secure System Authentication & Pilot Job',
        'desc'     => 'Your firm issues controlled user access to your practice suite (XPM, CCH iFirm, MYOB Practice, or Dext). We begin with a zero-risk pilot batch of 2 to 3 GST returns or compliance files, allowing your partners to inspect workpaper caliber, communication speed, and accuracy.',
        'tag'      => 'Zero-Risk Pilot',
    ],
    [
        'step'     => '04',
        'title'    => 'Dedicated Offshore Production Unit',
        'desc'     => 'Upon successful pilot calibration, we allocate designated senior accountants and managers to your firm. This dedicated team works continuously on your jobs, developing deep institutional knowledge of your clients’ idiosyncrasies over time.',
        'tag'      => 'Team Continuity',
    ],
    [
        'step'     => '05',
        'title'    => 'Quality Audit & Partner Sign-Off',
        'desc'     => 'Every job undergoes secondary quality control before delivery. Files are presented to your firm 95% complete with query notes, allowing your in-house managers or partners to perform a swift final review before filing with Inland Revenue or dispatching to the client.',
        'tag'      => 'Partner Control',
    ],
];
?>

    <div class="working-process-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Seamless Collaboration</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">How We Integrate With Your Practice</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        A disciplined, five-stage framework engineered to fit effortlessly into your existing practice management workflows.
                    </p>
                </div>
            </div>

            <!-- Steps Grid -->
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($firmSteps as $fs): ?>
                <div class="w-full px-[15px] pb--35">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 36px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); display: flex; gap: 30px; align-items: flex-start; border-left: 5px solid #e53935;">
                        <div style="width: 65px; height: 65px; border-radius: 14px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 800; flex-shrink: 0;">
                            <?php echo e($fs['step']); ?>
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0;"><?php echo e($fs['title']); ?></h3>
                                <span style="background: #0b1220; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; text-transform: uppercase;"><?php echo e($fs['tag']); ?></span>
                            </div>
                            <p style="color: #64748b; font-size: 15px; line-height: 1.7; margin: 0;">
                                <?php echo e($fs['desc']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Communication & SLA Protocols Box -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 40px 35px; margin-top: 30px;">
                <h4 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">Communication &amp; SLA Architecture:</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px;">
                        <div style="color: #e53935; font-size: 20px; margin-bottom: 8px;"><i class="fas fa-clock"></i></div>
                        <h5 style="margin: 0 0 6px; font-size: 16px; font-weight: 700;">Fast Turnaround Times</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">Routine bank recs completed within 24 hours. GST returns compiled 10 days before IRD due dates.</p>
                    </div>
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px;">
                        <div style="color: #e53935; font-size: 20px; margin-bottom: 8px;"><i class="fas fa-envelope-open-text"></i></div>
                        <h5 style="margin: 0 0 6px; font-size: 16px; font-weight: 700;">White-Label Direct Email</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">Communicate directly via your firm's domain (e.g. accounts@yourfirm.co.nz) or as an internal processor.</p>
                    </div>
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px;">
                        <div style="color: #e53935; font-size: 20px; margin-bottom: 8px;"><i class="fas fa-tasks"></i></div>
                        <h5 style="margin: 0 0 6px; font-size: 16px; font-weight: 700;">Transparent Job Tracking</h5>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b;">Live milestone updates logged directly in XPM, Karbon, or your firm's project management tracker.</p>
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
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Ready to Explore Stage 1?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Schedule a confidential 30-minute scoping discussion and request our standard mutual NDA.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Scoping Call <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
