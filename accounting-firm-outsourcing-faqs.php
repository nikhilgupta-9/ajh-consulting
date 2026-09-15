<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'FAQs';
$metaDescription = 'Frequently asked questions from New Zealand accounting firms about outsourcing with get-accountant.';
$pageHeading     = 'FAQs';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'accounting-firm-outsourcing.php'];

$faqs = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'firm_outsourcing']);
        $faqs = $stmt->fetchAll();
    } catch (Throwable $e) {
        $faqs = [];
    }
}

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-accordion-area service rts-section-gap">
        <div class="container" style="max-width:900px;">
            <?php if (empty($faqs)): ?>
                <p class="disc text-center">FAQs will appear here soon. Manage them from the admin panel &mdash; FAQs.</p>
            <?php else: ?>
                <div class="accordion mt--10" id="foFaqAccordion">
                    <?php foreach ($faqs as $i => $faq): $collapseId = 'foFaqCollapse' . $i; ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="foFaqHeading<?php echo $i; ?>">
                                <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapseId; ?>">
                                    <?php echo e($faq['question']); ?>
                                </button>
                            </h2>
                            <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="foFaqHeading<?php echo $i; ?>" data-bs-parent="#foFaqAccordion">
                                <div class="accordion-body"><?php echo e($faq['answer']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
