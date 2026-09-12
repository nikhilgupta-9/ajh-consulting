<?php
/**
 * Admin panel shared top layout. Every protected admin page must:
 *   require_once __DIR__ . '/../config/config.php';
 *   require_admin();
 *   $pageTitle = '...';
 *   $activeNav = 'dashboard'; // matches one of the nav keys below
 *   require __DIR__ . '/includes/layout-top.php';
 * ...page body...
 *   require __DIR__ . '/includes/layout-bottom.php';
 */

$activeNav = $activeNav ?? '';
$navItems = [
    'dashboard' => ['url' => 'index.php',    'label' => 'Dashboard',  'icon' => '&#128202;'],
    'leads'     => ['url' => 'leads.php',    'label' => 'Leads',      'icon' => '&#128231;'],
    'blog'      => ['url' => 'blog.php',     'label' => 'Blog Posts', 'icon' => '&#128221;'],
    'team'      => ['url' => 'team.php',     'label' => 'Team',       'icon' => '&#128101;'],
    'services'  => ['url' => 'services.php', 'label' => 'Services',   'icon' => '&#128188;'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle ?? 'Admin'); ?> | <?php echo e(APP_NAME); ?> Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/fav.png">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="admin-wrap">
        <aside class="admin-sidebar">
            <div class="brand"><?php echo e(APP_NAME); ?> <span>Admin</span></div>
            <nav>
                <?php foreach ($navItems as $key => $item): ?>
                    <a href="<?php echo e($item['url']); ?>" class="<?php echo $activeNav === $key ? 'active' : ''; ?>">
                        <span><?php echo $item['icon']; ?></span> <?php echo e($item['label']); ?>
                    </a>
                <?php endforeach; ?>
                <a href="../index.php" target="_blank">&#127760; View Website</a>
                <a href="logout.php">&#128274; Logout</a>
            </nav>
        </aside>
        <main class="admin-main">
            <div class="admin-topbar">
                <h1><?php echo e($pageTitle ?? 'Dashboard'); ?></h1>
                <div class="user">Hi, <?php echo e($_SESSION['admin_name'] ?? 'Admin'); ?></div>
            </div>
            <div class="admin-content">
                <?php if ($msg = flash_get('success')): ?>
                    <div class="alert alert-success"><?php echo e($msg); ?></div>
                <?php endif; ?>
                <?php if ($msg = flash_get('error')): ?>
                    <div class="alert alert-error"><?php echo e($msg); ?></div>
                <?php endif; ?>
