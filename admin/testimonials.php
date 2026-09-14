<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM testimonials WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Testimonial deleted.');
    }
    redirect('testimonials.php');
}

$branch = $_GET['branch'] ?? '';
$branchLabels = ['bookkeeping' => 'Accounting & Bookkeeping', 'firm_outsourcing' => 'Accounting Firm Outsourcing'];

if ($branch && isset($branchLabels[$branch])) {
    $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE branch = :branch ORDER BY sort_order ASC, id ASC');
    $stmt->execute(['branch' => $branch]);
    $testimonials = $pdo ? $stmt->fetchAll() : [];
} else {
    $testimonials = $pdo ? $pdo->query('SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC')->fetchAll() : [];
}

$pageTitle = 'Testimonials';
$activeNav = 'testimonials';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Testimonials</h2>
        <a href="testimonials-form.php" class="btn">+ Add Testimonial</a>
    </div>

    <div class="tabs" style="margin-bottom:20px;">
        <a href="testimonials.php" class="btn btn-sm <?php echo $branch === '' ? 'btn' : 'btn-outline'; ?>">All</a>
        <a href="testimonials.php?branch=bookkeeping" class="btn btn-sm <?php echo $branch === 'bookkeeping' ? 'btn' : 'btn-outline'; ?>">Accounting & Bookkeeping</a>
        <a href="testimonials.php?branch=firm_outsourcing" class="btn btn-sm <?php echo $branch === 'firm_outsourcing' ? 'btn' : 'btn-outline'; ?>">Accounting Firm Outsourcing</a>
    </div>

    <?php if (empty($testimonials)): ?>
        <div class="empty-state">No testimonials yet. Click "Add Testimonial" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Photo</th><th>Client</th><th>Branch</th><th>Quote</th><th>Rating</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $t): ?>
                        <tr>
                            <td><?php if ($t['photo']): ?><img class="thumb-sm" src="../<?php echo e($t['photo']); ?>" alt=""><?php else: ?>-<?php endif; ?></td>
                            <td><?php echo e($t['client_name']); ?><?php if ($t['client_role']): ?><br><small><?php echo e($t['client_role']); ?></small><?php endif; ?></td>
                            <td><?php echo e($branchLabels[$t['branch']] ?? $t['branch']); ?></td>
                            <td><?php echo e(mb_strimwidth((string) $t['quote'], 0, 70, '...')); ?></td>
                            <td><?php echo (int) $t['rating']; ?>/5</td>
                            <td><?php echo (int) $t['sort_order']; ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="testimonials-form.php?id=<?php echo (int) $t['id']; ?>">Edit</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this testimonial?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $t['id']; ?>">
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
