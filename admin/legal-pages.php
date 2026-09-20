<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

$knownSlugs = ['privacy-policy' => 'Privacy Policy', 'terms-of-use' => 'Terms of Use'];

$slug = $_GET['page'] ?? 'privacy-policy';
if (!isset($knownSlugs[$slug])) {
    $slug = 'privacy-policy';
}

$page = ['slug' => $slug, 'title' => $knownSlugs[$slug], 'content' => ''];

if ($pdo) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM legal_pages WHERE slug = :slug');
        $stmt->execute(['slug' => $slug]);
        $found = $stmt->fetch();
        if ($found) {
            $page = $found;
        }
    } catch (Throwable $e) {
        flash_set('error', 'The legal_pages table does not exist yet. Run database/migration_006_legal_pages.sql, then reload this page.');
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $page['title']   = clean($_POST['title'] ?? $knownSlugs[$slug]);
    $page['content'] = $_POST['content'] ?? '';

    if (empty($errors) && $pdo) {
        try {
            $exists = $pdo->prepare('SELECT id FROM legal_pages WHERE slug = :slug');
            $exists->execute(['slug' => $slug]);

            if ($exists->fetch()) {
                $stmt = $pdo->prepare('UPDATE legal_pages SET title=:title, content=:content WHERE slug=:slug');
            } else {
                $stmt = $pdo->prepare('INSERT INTO legal_pages (title, content, slug) VALUES (:title, :content, :slug)');
            }
            $stmt->execute(['title' => $page['title'], 'content' => $page['content'], 'slug' => $slug]);

            flash_set('success', 'Page updated.');
            redirect('legal-pages.php?page=' . urlencode($slug));
        } catch (Throwable $e) {
            $errors[] = 'Could not save this page. Has database/migration_006_legal_pages.sql been run?';
        }
    }
}

$pageTitle = 'Legal Pages';
$activeNav = 'legal-pages';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:860px;">
    <div class="page-header">
        <h2>Legal Pages &mdash; <?php echo e($knownSlugs[$slug]); ?></h2>
        <a href="../<?php echo e($slug); ?>.php" target="_blank" class="btn btn-outline btn-sm">View Page</a>
    </div>

    <div class="tabs" style="margin-bottom:20px;">
        <?php foreach ($knownSlugs as $pSlug => $label): ?>
            <a href="legal-pages.php?page=<?php echo urlencode($pSlug); ?>" class="btn btn-sm <?php echo $slug === $pSlug ? 'btn' : 'btn-outline'; ?>"><?php echo e($label); ?></a>
        <?php endforeach; ?>
    </div>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Page Title</label>
            <input class="form-control" type="text" name="title" value="<?php echo e($page['title']); ?>">
        </div>

        <div class="form-group">
            <label>Content (basic HTML allowed — &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;/&lt;li&gt;, &lt;b&gt;, &lt;a&gt;)</label>
            <textarea class="form-control" name="content" style="min-height:420px; font-family:monospace; font-size:13px;"><?php echo e($page['content']); ?></textarea>
        </div>

        <button type="submit" class="btn">Save Page</button>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
