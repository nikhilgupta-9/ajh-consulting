<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

// ---- Handle actions (status update / delete) ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();

    $id     = (int) ($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0 && $action === 'delete') {
        $pdo->prepare('DELETE FROM leads WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Lead deleted.');
    } elseif ($id > 0 && $action === 'status') {
        $status = $_POST['status'] ?? 'new';
        if (in_array($status, ['new', 'read', 'resolved'], true)) {
            $pdo->prepare('UPDATE leads SET status = :status WHERE id = :id')->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        }
    }

    redirect('leads.php' . (!empty($_GET) ? '?' . http_build_query($_GET) : ''));
}

$type   = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';
$leads  = [];

if ($pdo) {
    $sql    = 'SELECT * FROM leads WHERE 1=1';
    $params = [];

    if (in_array($type, ['contact', 'appointment'], true)) {
        $sql .= ' AND type = :type';
        $params['type'] = $type;
    }
    if (in_array($status, ['new', 'read', 'resolved'], true)) {
        $sql .= ' AND status = :status';
        $params['status'] = $status;
    }
    $sql .= ' ORDER BY created_at DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $leads = $stmt->fetchAll();
}

$pageTitle = 'Leads';
$activeNav = 'leads';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Contact & Appointment Leads</h2>
        <form method="get" style="display:flex; gap:10px;">
            <select name="type" class="form-control" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="contact" <?php echo $type === 'contact' ? 'selected' : ''; ?>>Contact</option>
                <option value="appointment" <?php echo $type === 'appointment' ? 'selected' : ''; ?>>Appointment</option>
            </select>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="new" <?php echo $status === 'new' ? 'selected' : ''; ?>>New</option>
                <option value="read" <?php echo $status === 'read' ? 'selected' : ''; ?>>Read</option>
                <option value="resolved" <?php echo $status === 'resolved' ? 'selected' : ''; ?>>Resolved</option>
            </select>
        </form>
    </div>

    <?php if (empty($leads)): ?>
        <div class="empty-state">No leads found.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Type</th><th>Name</th><th>Email</th><th>Phone</th>
                        <th>Service</th><th>Message</th><th>Status</th><th>Received</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?php echo e(ucfirst($lead['type'])); ?></td>
                            <td><?php echo e($lead['name']); ?></td>
                            <td><?php echo e($lead['email']); ?></td>
                            <td><?php echo e($lead['phone'] ?: '-'); ?></td>
                            <td><?php echo e($lead['service'] ?: ($lead['subject'] ?: '-')); ?></td>
                            <td style="max-width:220px; white-space:normal;"><?php echo e(mb_strimwidth((string) $lead['message'], 0, 120, '...')); ?></td>
                            <td><span class="badge badge-<?php echo e($lead['status']); ?>"><?php echo e(ucfirst($lead['status'])); ?></span></td>
                            <td><?php echo date('d M Y, h:i A', strtotime($lead['created_at'])); ?></td>
                            <td class="actions">
                                <form method="post" action="leads.php?<?php echo e(http_build_query($_GET)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $lead['id']; ?>">
                                    <input type="hidden" name="action" value="status">
                                    <select name="status" class="form-control" style="padding:5px 8px; font-size:12px;" onchange="this.form.submit()">
                                        <option value="new" <?php echo $lead['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                        <option value="read" <?php echo $lead['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="resolved" <?php echo $lead['status'] === 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                                    </select>
                                </form>
                                <form method="post" action="leads.php?<?php echo e(http_build_query($_GET)); ?>" onsubmit="return confirm('Delete this lead?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $lead['id']; ?>">
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
