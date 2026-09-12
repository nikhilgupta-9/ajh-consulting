<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM team_members WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Team member deleted.');
    }
    redirect('team.php');
}

$members = $pdo ? $pdo->query('SELECT * FROM team_members ORDER BY sort_order ASC, id ASC')->fetchAll() : [];

$pageTitle = 'Team';
$activeNav = 'team';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Team Members</h2>
        <a href="team-form.php" class="btn">+ Add Member</a>
    </div>

    <?php if (empty($members)): ?>
        <div class="empty-state">No team members yet. Click "Add Member" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Photo</th><th>Name</th><th>Designation</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php if ($member['photo']): ?><img class="thumb-sm" src="../<?php echo e($member['photo']); ?>" alt=""><?php else: ?>-<?php endif; ?></td>
                            <td><?php echo e($member['name']); ?></td>
                            <td><?php echo e($member['designation']); ?></td>
                            <td><?php echo (int) $member['sort_order']; ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="team-form.php?id=<?php echo (int) $member['id']; ?>">Edit</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this member?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $member['id']; ?>">
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
