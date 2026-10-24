<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM events WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Event deleted.');
    }
    redirect('events.php');
}

$events = [];
if ($pdo) {
    try {
        $events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC')->fetchAll();
    } catch (Throwable $e) {
        flash_set('error', 'The events table does not exist yet. Run database/migration_009_events.sql, then reload this page.');
    }
}

$pageTitle = 'Events';
$activeNav = 'events';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Events</h2>
        <a href="event-form.php" class="btn">+ New Event</a>
    </div>

    <?php if (empty($events)): ?>
        <div class="empty-state">No events yet. Click "New Event" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Image</th><th>Title</th><th>Date</th><th>Location</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?php if ($event['image']): ?><img class="thumb-sm" src="../<?php echo e($event['image']); ?>" alt=""><?php else: ?>-<?php endif; ?></td>
                            <td><?php echo e($event['title']); ?></td>
                            <td><?php echo date('d M Y', strtotime($event['event_date'])); ?></td>
                            <td><?php echo e($event['location']); ?></td>
                            <td><span class="badge badge-<?php echo e($event['status']); ?>"><?php echo e(ucfirst($event['status'])); ?></span></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="event-form.php?id=<?php echo (int) $event['id']; ?>">Edit</a>
                                <a class="btn btn-outline btn-sm" target="_blank" href="../events.php?slug=<?php echo urlencode($event['slug']); ?>">View</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this event?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $event['id']; ?>">
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
