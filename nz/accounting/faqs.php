<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Bookkeeping & Tax FAQs | get-accountant New Zealand';
$metaDescription = 'Answers to frequently asked questions about bookkeeping, GST returns, Xero software setup, IRD compliance and payroll for New Zealand businesses.';
$pageHeading     = 'Frequently Asked Questions';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

// Admin-managed FAQs grouped dynamically by category
$faqCategories = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE is_active = 1 AND branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'bookkeeping']);
        $dbFaqs = $stmt->fetchAll();
        foreach ($dbFaqs as $f) {
            $cat = !empty($f['category']) ? $f['category'] : 'General Inquiries';
            $faqCategories[$cat][] = [
                'q' => $f['question'],
                'a' => $f['answer'],
            ];
        }
    } catch (Throwable $e) {
        $faqCategories = [];
    }
}


require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/faq.css'); ?>">

    <div class="faq-wrap">
        <div class="container">
            <div class="faq-head">
                <span class="sub color-primary">Clear Answers</span>
                <h2 class="title">Bookkeeping &amp; Tax Questions Answered</h2>
                <p>Everything you need to know about switching your bookkeeping, software integration, IRD filing, and our service commitments.</p>
            </div>

            <div class="faq-categories">
                <?php $catIdx = 0; foreach ($faqCategories as $categoryTitle => $items): $catIdx++; ?>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-question-circle"></i> <?php echo e($categoryTitle); ?></h3>
                    <div class="faq-accordion">
                        <?php $i = 0; foreach ($items as $item): $i++; $collapseId = "collapse_{$catIdx}_{$i}"; $isOpen = ($catIdx === 1 && $i === 1); ?>
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $isOpen ? 'true' : 'false'; ?>">
                                <span><?php echo e($item['q']); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="<?php echo $collapseId; ?>" class="collapse<?php echo $isOpen ? ' show' : ''; ?>">
                                <div class="faq-answer-wrap">
                                    <p class="faq-answer"><?php echo e($item['a']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="faq-cta">
                <h4>Still have questions about your specific business?</h4>
                <p>Our New Zealand accountants are available for a friendly, no-obligation conversation.</p>
                <div class="faq-cta-actions">
                    <a class="rts-btn btn-primary" href="contact.php">Schedule Consultation <i class="far fa-arrow-right"></i></a>
                    <a class="rts-btn btn-primary-alta" href="tel:+6498010123" style="border: 2px solid #0f172a; color: #0f172a;"><i class="fas fa-phone-alt"></i> Call +64 9 801 0123</a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
