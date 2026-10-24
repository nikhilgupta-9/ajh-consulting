<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Firm Outsourcing FAQs | Questions from Accounting Partners';
$metaDescription = 'Answers to common questions from New Zealand accounting firm partners regarding white-label outsourcing, NDAs, workpaper quality and turnaround times.';
$pageHeading     = 'Practice FAQs';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

// Admin-managed Practice FAQs grouped dynamically by category
$firmFaqCategories = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE is_active = 1 AND branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'firm_outsourcing']);
        $dbFaqs = $stmt->fetchAll();
        foreach ($dbFaqs as $f) {
            $cat = !empty($f['category']) ? $f['category'] : 'Practice Inquiries';
            $firmFaqCategories[$cat][] = [
                'q' => $f['question'],
                'a' => $f['answer'],
            ];
        }
    } catch (Throwable $e) {
        $firmFaqCategories = [];
    }
}


require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/faq.css'); ?>">

    <div class="faq-wrap">
        <div class="container">
            <div class="faq-head">
                <span class="sub color-primary">Partner Due Diligence</span>
                <h2 class="title">Frequently Asked Questions by Practice Partners</h2>
                <p>Partnering with an outsourcing unit requires total confidence. Here is how we address common questions from CA and CPA firm leaders.</p>
            </div>

            <div class="faq-categories">
                <?php $cIdx = 0; foreach ($firmFaqCategories as $categoryTitle => $items): $cIdx++; ?>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-briefcase"></i> <?php echo e($categoryTitle); ?></h3>
                    <div class="faq-accordion">
                        <?php $i = 0; foreach ($items as $item): $i++; $colId = "firm_col_{$cIdx}_{$i}"; $isOpen = ($cIdx === 1 && $i === 1); ?>
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $colId; ?>" aria-expanded="<?php echo $isOpen ? 'true' : 'false'; ?>">
                                <span><?php echo e($item['q']); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="<?php echo $colId; ?>" class="collapse<?php echo $isOpen ? ' show' : ''; ?>">
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

            <div class="faq-cta is-dark">
                <h4>Have specific questions about your practice workflow?</h4>
                <p>Our partnership director is available for a confidential 30-minute scoping discussion.</p>
                <div class="faq-cta-actions">
                    <a class="rts-btn btn-primary" href="contact.php">Schedule Partner Call <i class="far fa-arrow-right"></i></a>
                    <a class="rts-btn btn-primary-alta" href="mailto:partners@get-accountant.com" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #fff;"><i class="fas fa-envelope"></i> partners@get-accountant.com</a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
