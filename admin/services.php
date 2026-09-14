<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM services WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Service deleted.');
    }
    redirect('services.php');
}

$branch = $_GET['branch'] ?? '';
$branchLabels = ['bookkeeping' => 'Accounting & Bookkeeping', 'firm_outsourcing' => 'Accounting Firm Outsourcing'];

if ($branch && isset($branchLabels[$branch])) {
    $stmt = $pdo->prepare('SELECT * FROM services WHERE branch = :branch ORDER BY sort_order ASC, id ASC');
    $stmt->execute(['branch' => $branch]);
    $services = $pdo ? $stmt->fetchAll() : [];
} else {
    $services = $pdo ? $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll() : [];
}

$pageTitle = 'Services';
$activeNav = 'services';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Services</h2>
        <a href="services-form.php" class="btn">+ Add Service</a>
    </div>

    <div class="tabs" style="margin-bottom:20px;">
        <a href="services.php" class="btn btn-sm <?php echo $branch === '' ? 'btn' : 'btn-outline'; ?>">All</a>
        <a href="services.php?branch=bookkeeping" class="btn btn-sm <?php echo $branch === 'bookkeeping' ? 'btn' : 'btn-outline'; ?>">Accounting & Bookkeeping</a>
        <a href="services.php?branch=firm_outsourcing" class="btn btn-sm <?php echo $branch === 'firm_outsourcing' ? 'btn' : 'btn-outline'; ?>">Accounting Firm Outsourcing</a>
    </div>

    <?php if (empty($services)): ?>
        <div class="empty-state">No services yet. Click "Add Service" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Image</th><th>Title</th><th>Branch</th><th>Short Description</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php if ($service['image']): ?><img class="thumb-sm" src="../<?php echo e($service['image']); ?>" alt=""><?php else: ?>-<?php endif; ?></td>
                            <td><?php echo e($service['title']); ?></td>
                            <td><?php echo e($branchLabels[$service['branch']] ?? $service['branch']); ?></td>
                            <td><?php echo e(mb_strimwidth((string) $service['short_description'], 0, 80, '...')); ?></td>
                            <td><?php echo (int) $service['sort_order']; ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="services-form.php?id=<?php echo (int) $service['id']; ?>">Edit</a>
                                <a class="btn btn-outline btn-sm" target="_blank" href="../service-details.php?slug=<?php echo urlencode($service['slug']); ?>">View</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this service?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $service['id']; ?>">
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
