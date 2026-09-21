<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

// Known editable pages — add more slugs here as new pages need this.
$pages = [
    'services'          => ['label' => 'Services Page',          'view' => '../our-service.php'],
    'about'             => ['label' => 'About',                  'view' => '../about-us.php'],
    'how-we-work'       => ['label' => 'How We Work',             'view' => '../how-we-work.php'],
    'our-peoples'       => ['label' => 'Our Peoples',             'view' => '../our-peoples.php'],
    'insight-resources' => ['label' => 'Insight & Resources',     'view' => '../insight-resources.php'],
];

$slug = $_GET['page'] ?? 'services';
if (!isset($pages[$slug])) {
    $slug = 'services';
}

$content = ['page_slug' => $slug, 'heading' => '', 'subheading' => '', 'body' => '', 'image' => ''];

if ($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
    $stmt->execute(['slug' => $slug]);
    $found = $stmt->fetch();
    if ($found) {
        $content = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $content['heading']    = clean($_POST['heading'] ?? '');
    $content['subheading'] = clean($_POST['subheading'] ?? '');
    $content['body']       = clean($_POST['body'] ?? '');

    if (empty($errors) && $pdo) {
        $uploaded = handle_image_upload('image', 'page-content');
        if ($uploaded) {
            $content['image'] = $uploaded;
        }

        $exists = $pdo->prepare('SELECT id FROM page_content WHERE page_slug = :slug');
        $exists->execute(['slug' => $slug]);

        if ($exists->fetch()) {
            $stmt = $pdo->prepare(
                'UPDATE page_content SET heading=:heading, subheading=:subheading, body=:body, image=:image WHERE page_slug=:page_slug'
            );
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO page_content (heading, subheading, body, image, page_slug) VALUES (:heading, :subheading, :body, :image, :page_slug)'
            );
        }
        // Only pass the placeholders the query actually uses — SELECT *
        // above may have merged extra keys (id, updated_at) into
        // $content, which PDO rejects now that emulated prepares are off.
        $stmt->execute(array_intersect_key($content, ['heading' => 1, 'subheading' => 1, 'body' => 1, 'image' => 1, 'page_slug' => 1]));

        flash_set('success', 'Page content updated.');
        redirect('page-content.php?page=' . urlencode($slug));
    }
}

$pageTitle = 'Page Content';
$activeNav = 'page-content';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:720px;">
    <div class="page-header">
        <h2>Page Content &mdash; <?php echo e($pages[$slug]['label']); ?></h2>
    </div>

    <div class="tabs" style="margin-bottom:20px;">
        <?php foreach ($pages as $pSlug => $p): ?>
            <a href="page-content.php?page=<?php echo urlencode($pSlug); ?>" class="btn btn-sm <?php echo $slug === $pSlug ? 'btn' : 'btn-outline'; ?>"><?php echo e($p['label']); ?></a>
        <?php endforeach; ?>
    </div>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Heading</label>
            <input class="form-control" type="text" name="heading" value="<?php echo e($content['heading']); ?>">
        </div>

        <div class="form-group">
            <label>Subheading (small label above heading)</label>
            <input class="form-control" type="text" name="subheading" value="<?php echo e($content['subheading']); ?>">
        </div>

        <div class="form-group">
            <label>Intro Text</label>
            <textarea class="form-control" name="body" style="min-height:120px;"><?php echo e($content['body']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Banner Image</label>
            <?php if (!empty($content['image'])): ?>
                <div class="current-image"><img src="../<?php echo e($content['image']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn">Save Changes</button>
        <a href="<?php echo e($pages[$slug]['view']); ?>" target="_blank" class="btn btn-outline">View Page</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
