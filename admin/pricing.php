<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM pricing_plans WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Pricing plan deleted.');
    }
    redirect('pricing.php');
}

$plans = [];
if ($pdo) {
    try {
        $plans = $pdo->query('SELECT * FROM pricing_plans ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {
        flash_set('error', 'The pricing_plans table does not exist yet. Run database/migration_010_pricing_plans.sql, then reload this page.');
    }
}

$pageTitle = 'Pricing Plans';
$activeNav = 'pricing';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Pricing Plans</h2>
        <a href="pricing-form.php" class="btn">+ New Plan</a>
    </div>

    <?php if (empty($plans)): ?>
        <div class="empty-state">No pricing plans yet. Click "New Plan" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Name</th><th>Price</th><th>Featured</th><th>Status</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($plans as $plan): ?>
                        <tr>
                            <td><?php echo e($plan['name']); ?></td>
                            <td>NZ$<?php echo e($plan['price']); ?> <?php echo e($plan['period']); ?></td>
                            <td><?php echo $plan['is_featured'] ? '<span class="badge badge-published">Featured</span>' : '-'; ?></td>
                            <td><span class="badge badge-<?php echo e($plan['status']); ?>"><?php echo e(ucfirst($plan['status'])); ?></span></td>
                            <td><?php echo (int) $plan['sort_order']; ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="pricing-form.php?id=<?php echo (int) $plan['id']; ?>">Edit</a>
                                <a class="btn btn-outline btn-sm" target="_blank" href="../nz/accounting/pricing.php">View</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this plan?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $plan['id']; ?>">
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
