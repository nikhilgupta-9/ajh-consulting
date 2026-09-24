<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Bookkeeping & Tax FAQs | get-accountant New Zealand';
$metaDescription = 'Answers to frequently asked questions about bookkeeping, GST returns, Xero software setup, IRD compliance and payroll for New Zealand businesses.';
$pageHeading     = 'Frequently Asked Questions';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$faqs = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'bookkeeping']);
        $faqs = $stmt->fetchAll();
    } catch (Throwable $e) {
        $faqs = [];
    }
}

// Supplemental categorized FAQs for deep international accounting coverage
$faqCategories = [
    'General & Onboarding' => [
        [
            'q' => 'How does get-accountant connect to my accounting software?',
            'a' => 'We connect as an invited professional advisor to your existing Xero or MYOB account. You maintain 100% administrative ownership of your software subscription at all times. There is no software to install and no interruption to your daily operations.',
        ],
        [
            'q' => 'How quickly can you get my books up to date?',
            'a' => 'Most new clients are fully onboarded within 3 to 5 business days. If you have historical backlog or months of un-reconciled bank feeds, our catch-up specialists can bring your records completely audit-ready within 1 to 2 weeks.',
        ],
        [
            'q' => 'Can you work alongside my existing tax accountant?',
            'a' => 'Yes, absolutely. Many of our clients have an existing tax accountant who only prepares annual returns. We take care of day-to-day bookkeeping, weekly bank reconciliation, payroll, and GST throughout the year, then hand over spotless year-end trial balances to your accountant.',
        ],
    ],
    'Inland Revenue (IRD) & Tax' => [
        [
            'q' => 'Do you file my GST returns directly with Inland Revenue?',
            'a' => 'Yes. As registered New Zealand tax and bookkeeping agents, we prepare your GST returns, reconcile all input tax credits, and submit the return directly to Inland Revenue via secure myIR gateway. We also advise you of exact payment amounts and due dates well in advance.',
        ],
        [
            'q' => 'What happens if I receive a query or audit notice from IRD?',
            'a' => 'Because we maintain complete digital audit trails and verify every tax invoice, we handle IRD verification queries on your behalf. We provide the supporting schedules, bank statements, and invoice copies required by Inland Revenue investigators.',
        ],
        [
            'q' => 'Can you help me manage provisional tax payments?',
            'a' => 'Yes. We track your rolling profitability and calculate provisional tax installments (standard or ratio method) so you can plan cash flow and avoid use-of-money interest charges from IRD.',
        ],
    ],
    'Payroll & The Holidays Act' => [
        [
            'q' => 'How do you ensure payroll complies with the New Zealand Holidays Act 2003?',
            'a' => 'We configure payroll software (Xero Payroll, PaySauce, or iPayroll) with exact employment contract parameters. We verify that annual leave is paid at the higher of ordinary weekly pay or average weekly earnings, and that public holidays and alternate days are tracked accurately.',
        ],
        [
            'q' => 'Do you submit payday filing to IRD automatically?',
            'a' => 'Yes. Employment Information (EI) is electronically submitted to Inland Revenue within 2 working days of every pay run, ensuring 100% compliance with IRD payday filing rules.',
        ],
    ],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <div class="rts-faq-section rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Clear Answers</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Bookkeeping &amp; Tax Questions Answered</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Everything you need to know about switching your bookkeeping, software integration, IRD filing, and our service commitments.
                    </p>
                </div>
            </div>

            <!-- FAQ Categories Accordions -->
            <div class="flex flex-wrap -mx-[15px] justify-center">
                <div class="xl:w-10/12 lg:w-10/12 px-[15px] w-full">
                    
                    <?php $catIdx = 0; foreach ($faqCategories as $categoryTitle => $items): $catIdx++; ?>
                    <div style="margin-bottom: 45px;">
                        <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; display: flex; align-items: center; gap: 10px;">
                            <span style="color: #e53935;"><i class="fas fa-question-circle"></i></span> <?php echo e($categoryTitle); ?>
                        </h3>

                        <div class="accordion" id="catAccordion<?php echo $catIdx; ?>" style="display: flex; flex-direction: column; gap: 12px;">
                            <?php $i = 0; foreach ($items as $item): $i++; $collapseId = "collapse_{$catIdx}_{$i}"; ?>
                            <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #fff;">
                                <h4 class="accordion-header" style="margin: 0;">
                                    <button class="accordion-button <?php echo ($catIdx === 1 && $i === 1) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo ($catIdx === 1 && $i === 1) ? 'true' : 'false'; ?>" style="padding: 18px 22px; font-weight: 700; font-size: 15.5px; color: #0f172a; width: 100%; text-align: left; display: flex; justify-content: space-between; align-items: center; border: none; background: #fff; cursor: pointer;">
                                        <span><?php echo e($item['q']); ?></span>
                                        <i class="fas fa-chevron-down" style="font-size: 12px; color: #e53935;"></i>
                                    </button>
                                </h4>
                                <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo ($catIdx === 1 && $i === 1) ? 'show' : ''; ?>" style="padding: 0 22px 20px; color: #64748b; font-size: 15px; line-height: 1.7;">
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
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 40px; margin-top: 30px; text-align: center; max-width: 850px; margin-left: auto; margin-right: auto;">
                <h4 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 10px;">Still have questions about your specific business?</h4>
                <p style="color: #64748b; font-size: 15px; margin-bottom: 25px;">Our New Zealand accountants are available for a friendly, no-obligation conversation.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 14px 30px;">Schedule Consultation <i class="far fa-arrow-right"></i></a>
                    <a class="rts-btn btn-primary-alta" href="tel:+6498010123" style="border: 2px solid #0f172a; color: #0f172a; padding: 14px 28px;"><i class="fas fa-phone-alt"></i> Call +64 9 801 0123</a>
                </div>
            </div>

        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
