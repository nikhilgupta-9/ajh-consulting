<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Client Stories';
$metaDescription = 'What our bookkeeping clients across New Zealand say about working with get-accountant.';
$pageHeading     = 'Client Stories';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

$testimonials = [];
if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :b ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['b' => 'bookkeeping']);
        $testimonials = $stmt->fetchAll();
    } catch (Throwable $e) {
        $testimonials = [];
    }
}

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';
?>

    <div class="rts-client-feedback rts-section-gap">
        <div class="container">
            <?php if (empty($testimonials)): ?>
                <p class="disc text-center">Client stories will appear here soon. Manage them from the admin panel &mdash; Testimonials.</p>
            <?php else: ?>
                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($testimonials as $t): ?>
                    <div class="xl:w-1/2 px-[15px] pb--30">
                        <div class="testimopnial-wrapper-two">
                            <div class="test-header">
                                <?php if (!empty($t['photo'])): ?>
                                    <div class="thumbnail"><img src="<?php echo e($t['photo']); ?>" alt="<?php echo e($t['client_name']); ?>" style="width:56px;height:56px;border-radius:50%;object-fit:cover;"></div>
                                <?php endif; ?>
                                <div class="name-desig" style="margin-left:<?php echo !empty($t['photo']) ? '20px' : '0'; ?>">
                                    <h4 class="title"><?php echo e($t['client_name']); ?></h4>
                                    <?php if (!empty($t['client_role'])): ?><span class="color-primary"><?php echo e($t['client_role']); ?></span><?php endif; ?>
                                </div>
                            </div>
                            <div class="test-body">
                                <p><?php echo e($t['quote']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
