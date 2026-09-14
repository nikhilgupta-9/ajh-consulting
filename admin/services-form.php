<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$service = ['title' => '', 'slug' => '', 'branch' => 'bookkeeping', 'short_description' => '', 'description' => '', 'icon' => '', 'image' => '', 'sort_order' => 0];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM services WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $service = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $service['title']             = clean($_POST['title'] ?? '');
    $service['branch']            = in_array(($_POST['branch'] ?? ''), ['bookkeeping', 'firm_outsourcing'], true) ? $_POST['branch'] : 'bookkeeping';
    $service['short_description'] = clean($_POST['short_description'] ?? '');
    $service['description']       = clean($_POST['description'] ?? '');
    $service['icon']              = clean($_POST['icon'] ?? '');
    $service['sort_order']        = (int) ($_POST['sort_order'] ?? 0);

    if ($service['title'] === '') {
        $errors[] = 'Title is required.';
    }

    if (empty($errors) && $pdo) {
        $slug = slugify($service['title']);
        $check = $pdo->prepare('SELECT id FROM services WHERE slug = :slug AND id != :id');
        $check->execute(['slug' => $slug, 'id' => $id]);
        if ($check->fetch()) {
            $slug .= '-' . substr(md5((string) time()), 0, 5);
        }
        $service['slug'] = $slug;

        $uploaded = handle_image_upload('image', 'services');
        if ($uploaded) {
            $service['image'] = $uploaded;
        }

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE services SET title=:title, slug=:slug, branch=:branch, short_description=:short_description, description=:description, icon=:icon, image=:image, sort_order=:sort_order WHERE id=:id'
            );
            $stmt->execute($service + ['id' => $id]);
            flash_set('success', 'Service updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO services (title, slug, branch, short_description, description, icon, image, sort_order) VALUES (:title, :slug, :branch, :short_description, :description, :icon, :image, :sort_order)'
            );
            $stmt->execute($service);
            flash_set('success', 'Service added.');
        }

        redirect('services.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Service' : 'Add Service';
$activeNav = 'services';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:720px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" required value="<?php echo e($service['title']); ?>">
        </div>

        <div class="form-group">
            <label>Branch</label>
            <select class="form-control" name="branch">
                <option value="bookkeeping" <?php echo $service['branch'] === 'bookkeeping' ? 'selected' : ''; ?>>Accounting & Bookkeeping</option>
                <option value="firm_outsourcing" <?php echo $service['branch'] === 'firm_outsourcing' ? 'selected' : ''; ?>>Accounting Firm Outsourcing</option>
            </select>
        </div>

        <div class="form-group">
            <label>Short Description (shown on the services grid)</label>
            <textarea class="form-control" name="short_description" style="min-height:70px;"><?php echo e($service['short_description']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Full Description (shown on the service details page)</label>
            <textarea class="form-control" name="description" style="min-height:160px;"><?php echo e($service['description']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Icon class (optional, Font Awesome / flaticon class)</label>
                <input class="form-control" type="text" name="icon" value="<?php echo e($service['icon']); ?>">
            </div>
            <div class="form-group">
                <label>Sort Order (lower shows first)</label>
                <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $service['sort_order']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Image</label>
            <?php if (!empty($service['image'])): ?>
                <div class="current-image"><img src="../<?php echo e($service['image']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Service' : 'Add Service'; ?></button>
        <a href="services.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
