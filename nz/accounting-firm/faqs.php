<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Firm Outsourcing FAQs | Questions from Accounting Partners';
$metaDescription = 'Answers to common questions from New Zealand accounting firm partners regarding white-label outsourcing, NDAs, workpaper quality and turnaround times.';
$pageHeading     = 'Practice FAQs';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

$firmFaqCategories = [
    'Confidentiality & Non-Poaching' => [
        [
            'q' => 'How do you safeguard client confidentiality under New Zealand law?',
            'a' => 'We operate under a legally binding bilateral Non-Disclosure Agreement (NDA) compliant with the New Zealand Privacy Act 2020. Our workstations are BitLocker-encrypted, operate under clean-desk biometric controls, and all work is executed directly inside your cloud environment without local downloads.',
        ],
        [
            'q' => 'What guarantee do we have that you will never poach our clients?',
            'a' => 'Every partnership agreement contains a strict, enforceable non-solicitation covenant. We are strictly a business-to-business back-office production unit for accounting practices and never offer independent accounting services to your clients.',
        ],
    ],
    'Delivery, SOPs & Review' => [
        [
            'q' => 'How does the partner review and sign-off process work?',
            'a' => 'Our accountants prepare the complete working paper files, trial balance adjustments, and draft tax returns to 95% completion, accompanied by a concise query schedule. Your in-house manager or partner simply performs the final 10-minute check and executes the statutory filing.',
        ],
        [
            'q' => 'Can you follow our firm’s custom workpaper templates and indexing?',
            'a' => 'Yes. During our initial onboarding stage, we review your firm’s chart of accounts, workpaper naming conventions, and quality checklists. Our accountants adopt your exact formatting so the files are indistinguishable from in-house work.',
        ],
        [
            'q' => 'What are your turnaround times for routine GST and accounts?',
            'a' => 'Standard bank reconciliations and AP coding are processed within 24 to 48 hours. Bi-monthly GST returns are compiled and ready for review 10 business days before the IRD due date.',
        ],
    ],
    'Team & Commercial Terms' => [
        [
            'q' => 'Will we work with a dedicated team or a pooled group of workers?',
            'a' => 'You are assigned a dedicated pod of named senior accountants and a team lead. This ensures consistency, direct Slack/Teams/email communication, and deep institutional familiarity with your clients year over year.',
        ],
        [
            'q' => 'Can we trial your service before making an ongoing commitment?',
            'a' => 'Yes. We encourage all prospective practice partners to start with a pilot batch of 2 to 3 GST returns or compliance jobs under full NDA so you can evaluate our accuracy and speed firsthand.',
        ],
    ],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-faq-section rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Partner Due Diligence</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Frequently Asked Questions by Practice Partners</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Partnering with an outsourcing unit requires total confidence. Here is how we address common questions from CA and CPA firm leaders.
                    </p>
                </div>
            </div>

            <!-- FAQ Categories Grid -->
            <div class="flex flex-wrap -mx-[15px] justify-center">
                <div class="xl:w-10/12 lg:w-10/12 px-[15px] w-full">
                    
                    <?php $cIdx = 0; foreach ($firmFaqCategories as $categoryTitle => $items): $cIdx++; ?>
                    <div style="margin-bottom: 45px;">
                        <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; display: flex; align-items: center; gap: 10px;">
                            <span style="color: #e53935;"><i class="fas fa-briefcase"></i></span> <?php echo e($categoryTitle); ?>
                        </h3>

                        <div class="accordion" id="firmAccordion<?php echo $cIdx; ?>" style="display: flex; flex-direction: column; gap: 12px;">
                            <?php $i = 0; foreach ($items as $item): $i++; $colId = "firm_col_{$cIdx}_{$i}"; ?>
                            <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff;">
                                <h4 class="accordion-header" style="margin: 0;">
                                    <button class="accordion-button <?php echo ($cIdx === 1 && $i === 1) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $colId; ?>" aria-expanded="<?php echo ($cIdx === 1 && $i === 1) ? 'true' : 'false'; ?>" style="padding: 18px 22px; font-weight: 700; font-size: 15.5px; color: #0f172a; width: 100%; text-align: left; display: flex; justify-content: space-between; align-items: center; border: none; background: #fff; cursor: pointer;">
                                        <span><?php echo e($item['q']); ?></span>
                                        <i class="fas fa-chevron-down" style="font-size: 12px; color: #e53935;"></i>
                                    </button>
                                </h4>
                                <div id="<?php echo $colId; ?>" class="accordion-collapse collapse <?php echo ($cIdx === 1 && $i === 1) ? 'show' : ''; ?>" style="padding: 0 22px 20px; color: #64748b; font-size: 15px; line-height: 1.7;">
                                    <div class="accordion-body">
                                        <?php echo e($item['a']); ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Still Have Questions Box -->
            <div style="background: #0b1220; color: #fff; border-radius: 18px; padding: 40px; margin-top: 30px; text-align: center; max-width: 850px; margin-left: auto; margin-right: auto;">
                <h4 style="font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 10px;">Have specific questions about your practice workflow?</h4>
                <p style="color: #94a3b8; font-size: 15px; margin-bottom: 25px;">Our partnership director is available for a confidential 30-minute scoping discussion.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 14px 30px;">Schedule Partner Call <i class="far fa-arrow-right"></i></a>
                    <a class="rts-btn btn-primary-alta" href="mailto:partners@get-accountant.com" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 14px 28px;"><i class="fas fa-envelope"></i> partners@get-accountant.com</a>
                </div>
            </div>

        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
