<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Technology, Software & Data Security | get-accountant';
$metaDescription = 'Our practice software ecosystem and enterprise-grade data security protocols built for New Zealand CA and CPA accounting firms.';
$pageHeading     = 'Technology & Systems';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';

$platforms = [
    [
        'name'     => 'Xero Practice Manager (XPM)',
        'category' => 'Practice Management & Job Tracking',
        'desc'     => 'Full mastery of XPM job templates, budget hours, milestone statuses, and lead schedule workpapers. We update job stages in real-time as tasks progress.',
    ],
    [
        'name'     => 'CCH iFirm',
        'category' => 'Compliance & Tax Suite',
        'desc'     => 'Experienced in CCH iFirm Contacts, Jobs, Documents, and Client Accounting. We compile working papers strictly to CCH ledger standards.',
    ],
    [
        'name'     => 'MYOB Practice Solutions',
        'category' => 'Multi-Entity Compliance',
        'desc'     => 'Comprehensive ledger processing across MYOB Business, MYOB Practice, fixed asset depreciation registers, and electronic tax filing.',
    ],
    [
        'name'     => 'Dext Prepare & Hubdoc',
        'category' => 'Automated Document Ingestion',
        'desc'     => 'Advanced OCR document extraction, supplier rule configuration, line-item splitting, and automatic publishing to client ledgers.',
    ],
    [
        'name'     => 'Karbon & FYI Docs',
        'category' => 'Workflow & Document Management',
        'desc'     => 'Adherence to internal Karbon Kanban boards and FYI Docs auto-filing conventions, maintaining immaculate digital client file cabinets.',
    ],
    [
        'name'     => 'Inland Revenue (myIR) Gateway',
        'category' => 'Direct Tax Submissions',
        'desc'     => 'Drafting of bi-monthly GST, payday filing, and annual income tax returns (IR4/IR7/IR3) prepared ready for authorized partner sign-off.',
    ],
];

$securityPillars = [
    [
        'title' => 'NZ Privacy Act 2020 Compliance',
        'desc'  => 'Strict adherence to all 13 Information Privacy Principles (IPPs). Client financial and tax records are handled exclusively for authorized compliance processing.',
        'icon'  => 'fa-user-lock',
    ],
    [
        'title' => 'Zero Local Data Storage Policy',
        'desc'  => 'Our team operates directly inside cloud applications (Xero, MYOB, CCH). Client source documents and workpapers are never downloaded or stored on local workstations.',
        'icon'  => 'fa-server',
    ],
    [
        'title' => 'Multi-Factor Authentication (MFA)',
        'desc'  => 'Hardware or authenticator app-based MFA is mandatory across every system login, practice email, and client management environment.',
        'icon'  => 'fa-key',
    ],
    [
        'title' => 'Dedicated VPN & IP Whitelisting',
        'desc'  => 'All system access can be routed through your firm’s dedicated private network or restricted strictly to our static office IP addresses.',
        'icon'  => 'fa-network-wired',
    ],
    [
        'title' => 'Clean Desk & Encrypted Workstations',
        'desc'  => 'Physical office security includes biometric access control, clean desk policies with no physical paper, and BitLocker-encrypted workstation hard drives.',
        'icon'  => 'fa-desktop',
    ],
    [
        'title' => 'Enforceable Non-Disclosure Agreements',
        'desc'  => 'Every staff member and executive signs binding confidentiality covenants that survive termination, reinforced by our master firm partnership agreement.',
        'icon'  => 'fa-file-signature',
    ],
];
?>

    <div class="rts-tech-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Systems &amp; Security</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Compatible With Your Stack, Protected by Bank-Grade Security</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        We adapt to your practice’s existing toolset so you never have to retrain your team or migrate software.
                    </p>
                </div>
            </div>

            <!-- Software Platforms Grid -->
            <div class="flex flex-wrap -mx-[15px] mb--60">
                <?php foreach ($platforms as $pl): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px 26px; height: 100%; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
                        <span style="font-size: 11.5px; font-weight: 700; color: #e53935; text-transform: uppercase; margin-bottom: 8px; display: block;"><?php echo e($pl['category']); ?></span>
                        <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px; color: #0f172a;"><?php echo e($pl['name']); ?></h3>
                        <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin: 0; flex-grow: 1;">
                            <?php echo e($pl['desc']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Data Security & Privacy Section -->
            <div style="background: #0b1220; color: #fff; border-radius: 20px; padding: 60px 45px;">
                <div class="text-center mb--45">
                    <span style="color: #ff6b6b; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 6px;">
                        Enterprise-Grade Governance
                    </span>
                    <h3 style="color: #fff; font-size: 32px; font-weight: 800; margin: 0 0 12px;">Data Security &amp; Confidentiality Architecture</h3>
                    <p style="color: #94a3b8; font-size: 15.5px; margin: 0; max-width: 700px; margin-left: auto; margin-right: auto;">
                        We understand that client confidentiality is your firm’s most valuable asset. Here is how we protect your reputation.
                    </p>
                </div>

                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($securityPillars as $sp): ?>
                    <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--30">
                        <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 28px; height: 100%;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; background: rgba(229,57,53,0.2); color: #ff6b6b; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 16px;">
                                <i class="fas <?php echo $sp['icon']; ?>"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 8px;"><?php echo e($sp['title']); ?></h4>
                            <p style="color: #94a3b8; font-size: 13.5px; line-height: 1.6; margin: 0;"><?php echo e($sp['desc']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Want to Review Our Security Protocols?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">We are happy to provide our standard NDA and technical security compliance overview to your IT partners.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Request Security Pack <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
