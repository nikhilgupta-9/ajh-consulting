<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

$stats = [
    'new_leads' => 0,
    'total_leads' => 0,
    'blog_posts' => 0,
    'team_members' => 0,
    'services' => 0,
];
$recentLeads = [];

if ($pdo) {
    $stats['new_leads']     = (int) $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetchColumn();
    $stats['total_leads']   = (int) $pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn();
    $stats['blog_posts']    = (int) $pdo->query('SELECT COUNT(*) FROM blog_posts')->fetchColumn();
    $stats['team_members']  = (int) $pdo->query('SELECT COUNT(*) FROM team_members')->fetchColumn();
    $stats['services']      = (int) $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn();
    $recentLeads            = $pdo->query('SELECT * FROM leads ORDER BY created_at DESC LIMIT 8')->fetchAll();
}

$pageTitle = 'Dashboard';
$activeNav = 'dashboard';
require __DIR__ . '/includes/layout-top.php';
?>

<?php if (!$pdo): ?>
    <div class="alert alert-error">Could not connect to the database. Check your <code>.env</code> file and make sure MySQL is running.</div>
<?php endif; ?>

<div class="stat-grid">
    <div class="stat-card">
        <div class="num"><?php echo $stats['new_leads']; ?></div>
        <div class="label">New Leads</div>
    </div>
    <div class="stat-card">
        <div class="num"><?php echo $stats['total_leads']; ?></div>
        <div class="label">Total Leads</div>
    </div>
    <div class="stat-card">
        <div class="num"><?php echo $stats['blog_posts']; ?></div>
        <div class="label">Blog Posts</div>
    </div>
    <div class="stat-card">
        <div class="num"><?php echo $stats['team_members']; ?></div>
        <div class="label">Team Members</div>
    </div>
    <div class="stat-card">
        <div class="num"><?php echo $stats['services']; ?></div>
        <div class="label">Services</div>
    </div>
</div>

<div class="card">
    <div class="page-header">
        <h2>Recent Leads</h2>
        <a href="leads.php" class="btn btn-outline btn-sm">View All</a>
    </div>
    <?php if (empty($recentLeads)): ?>
        <div class="empty-state">No leads yet. They will show up here once visitors submit the contact or appointment forms.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Received</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentLeads as $lead): ?>
                        <tr>
                            <td><?php echo e(ucfirst($lead['type'])); ?></td>
                            <td><?php echo e($lead['name']); ?></td>
                            <td><?php echo e($lead['email']); ?></td>
                            <td><span class="badge badge-<?php echo e($lead['status']); ?>"><?php echo e(ucfirst($lead['status'])); ?></span></td>
                            <td><?php echo date('d M Y, h:i A', strtotime($lead['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
