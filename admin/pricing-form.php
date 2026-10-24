<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$plan = [
    'name' => '', 'subtitle' => '', 'price' => '', 'period' => '/month + GST',
    'badge' => '', 'is_featured' => 0, 'features' => '', 'not_included' => '',
    'sort_order' => 0, 'status' => 'published',
];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM pricing_plans WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $plan = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $plan['name']         = clean($_POST['name'] ?? '');
    $plan['subtitle']     = clean($_POST['subtitle'] ?? '');
    $plan['price']        = clean($_POST['price'] ?? '');
    $plan['period']       = clean($_POST['period'] ?? '/month + GST');
    $plan['badge']        = clean($_POST['badge'] ?? '');
    $plan['is_featured']  = isset($_POST['is_featured']) ? 1 : 0;
    $plan['features']     = $_POST['features'] ?? '';
    $plan['not_included'] = $_POST['not_included'] ?? '';
    $plan['sort_order']   = (int) ($_POST['sort_order'] ?? 0);
    $plan['status']       = in_array($_POST['status'] ?? '', ['draft', 'published'], true) ? $_POST['status'] : 'published';

    if ($plan['name'] === '') {
        $errors[] = 'Plan name is required.';
    }
    if ($plan['price'] === '') {
        $errors[] = 'Price is required.';
    }

    if (empty($errors) && $pdo) {
        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE pricing_plans SET name=:name, subtitle=:subtitle, price=:price, period=:period, badge=:badge,
                 is_featured=:is_featured, features=:features, not_included=:not_included, sort_order=:sort_order, status=:status WHERE id=:id'
            );
            $stmt->execute([
                'name' => $plan['name'], 'subtitle' => $plan['subtitle'], 'price' => $plan['price'], 'period' => $plan['period'],
                'badge' => $plan['badge'], 'is_featured' => $plan['is_featured'], 'features' => $plan['features'],
                'not_included' => $plan['not_included'], 'sort_order' => $plan['sort_order'], 'status' => $plan['status'], 'id' => $id,
            ]);
            flash_set('success', 'Pricing plan updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO pricing_plans (name, subtitle, price, period, badge, is_featured, features, not_included, sort_order, status)
                 VALUES (:name, :subtitle, :price, :period, :badge, :is_featured, :features, :not_included, :sort_order, :status)'
            );
            $stmt->execute([
                'name' => $plan['name'], 'subtitle' => $plan['subtitle'], 'price' => $plan['price'], 'period' => $plan['period'],
                'badge' => $plan['badge'], 'is_featured' => $plan['is_featured'], 'features' => $plan['features'],
                'not_included' => $plan['not_included'], 'sort_order' => $plan['sort_order'], 'status' => $plan['status'],
            ]);
            flash_set('success', 'Pricing plan created.');
        }

        redirect('pricing.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Pricing Plan' : 'New Pricing Plan';
$activeNav = 'pricing';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:720px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Plan Name</label>
                <input class="form-control" type="text" name="name" required value="<?php echo e($plan['name']); ?>">
            </div>
            <div class="form-group">
                <label>Badge (optional, e.g. "Most Popular")</label>
                <input class="form-control" type="text" name="badge" value="<?php echo e($plan['badge']); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Subtitle</label>
            <input class="form-control" type="text" name="subtitle" value="<?php echo e($plan['subtitle']); ?>">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Price (NZ$, number only)</label>
                <input class="form-control" type="text" name="price" required value="<?php echo e($plan['price']); ?>">
            </div>
            <div class="form-group">
                <label>Billing Period Label</label>
                <input class="form-control" type="text" name="period" value="<?php echo e($plan['period']); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Included Features (one per line)</label>
            <textarea class="form-control" name="features" style="min-height:140px;"><?php echo e($plan['features']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Not Included (one per line, shown struck-through — optional)</label>
            <textarea class="form-control" name="not_included" style="min-height:90px;"><?php echo e($plan['not_included']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Sort Order (lower shows first)</label>
                <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $plan['sort_order']; ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="published" <?php echo $plan['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                    <option value="draft" <?php echo $plan['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="is_featured" value="1" <?php echo $plan['is_featured'] ? 'checked' : ''; ?>> Highlight this plan as featured (adds a border and badge)</label>
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Plan' : 'Create Plan'; ?></button>
        <a href="pricing.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
