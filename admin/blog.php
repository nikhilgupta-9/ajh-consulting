<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0 && ($_POST['action'] ?? '') === 'delete') {
        $pdo->prepare('DELETE FROM blog_posts WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'Blog post deleted.');
    }
    redirect('blog.php');
}

$posts = $pdo ? $pdo->query('SELECT * FROM blog_posts ORDER BY created_at DESC')->fetchAll() : [];

$pageTitle = 'Blog Posts';
$activeNav = 'blog';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header">
        <h2>Blog Posts</h2>
        <a href="blog-form.php" class="btn">+ New Post</a>
    </div>

    <?php if (empty($posts)): ?>
        <div class="empty-state">No blog posts yet. Click "New Post" to add one.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Image</th><th>Title</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?php if ($post['image']): ?><img class="thumb-sm" src="../<?php echo e($post['image']); ?>" alt=""><?php else: ?>-<?php endif; ?></td>
                            <td><?php echo e($post['title']); ?></td>
                            <td><?php echo e($post['author']); ?></td>
                            <td><span class="badge badge-<?php echo e($post['status']); ?>"><?php echo e(ucfirst($post['status'])); ?></span></td>
                            <td><?php echo date('d M Y', strtotime($post['created_at'])); ?></td>
                            <td class="actions">
                                <a class="btn btn-outline btn-sm" href="blog-form.php?id=<?php echo (int) $post['id']; ?>">Edit</a>
                                <a class="btn btn-outline btn-sm" target="_blank" href="../blog-details.php?slug=<?php echo urlencode($post['slug']); ?>">View</a>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete this post?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $post['id']; ?>">
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
