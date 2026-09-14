<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM faqs WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'FAQ deleted.');
    }
    redirect('faqs.php');
}

$branch = $_GET['branch'] ?? '';
$branchLabels = ['bookkeeping' => 'Accounting & Bookkeeping', 'firm_outsourcing' => 'Accounting Firm Outsourcing'];

if ($branch && isset($branchLabels[$branch])) {
    $stmt = $pdo->prepare('SELECT * FROM faqs WHERE branch = :branch ORDER BY sort_order ASC, id ASC');
    $stmt->execute(['branch' => $branch]);
    $faqs = $pdo ? $stmt->fetchAll() : [];
} else {
    $faqs = $pdo ? $pdo->query('SELECT * FROM faqs ORDER BY sort_order ASC, id ASC')->fetchAll() : [];
}

$pageTitle = 'FAQs';
$activeNav = 'faqs';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>FAQs</h2>
        <a href="faqs-form.php" class="btn">+ Add FAQ</a>
    </div>

    <div class="tabs" style="margin-bottom:20px;">
        <a href="faqs.php" class="btn btn-sm <?php echo $branch === '' ? 'btn' : 'btn-outline'; ?>">All</a>
        <a href="faqs.php?branch=bookkeeping" class="btn btn-sm <?php echo $branch === 'bookkeeping' ? 'btn' : 'btn-outline'; ?>">Accounting & Bookkeeping</a>
        <a href="faqs.php?branch=firm_outsourcing" class="btn btn-sm <?php echo $branch === 'firm_outsourcing' ? 'btn' : 'btn-outline'; ?>">Accounting Firm Outsourcing</a>
    </div>

    <?php if (empty($faqs)): ?>
        <div class="empty-state">No FAQs yet. Click "Add FAQ" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Question</th><th>Branch</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $faq): ?>
                        <tr>
                            <td><?php echo e(mb_strimwidth((string) $faq['question'], 0, 90, '...')); ?></td>
                            <td><?php echo e($branchLabels[$faq['branch']] ?? $faq['branch']); ?></td>
                            <td><?php echo (int) $faq['sort_order']; ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="faqs-form.php?id=<?php echo (int) $faq['id']; ?>">Edit</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this FAQ?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $faq['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
