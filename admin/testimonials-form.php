<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$t   = ['branch' => 'bookkeeping', 'client_name' => '', 'client_role' => '', 'photo' => '', 'quote' => '', 'rating' => 5, 'sort_order' => 0];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM testimonials WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $t = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $t['branch']      = in_array(($_POST['branch'] ?? ''), ['bookkeeping', 'firm_outsourcing'], true) ? $_POST['branch'] : 'bookkeeping';
    $t['client_name'] = clean($_POST['client_name'] ?? '');
    $t['client_role'] = clean($_POST['client_role'] ?? '');
    $t['quote']       = clean($_POST['quote'] ?? '');
    $t['rating']      = max(1, min(5, (int) ($_POST['rating'] ?? 5)));
    $t['sort_order']  = (int) ($_POST['sort_order'] ?? 0);

    if ($t['client_name'] === '') {
        $errors[] = 'Client name is required.';
    }
    if ($t['quote'] === '') {
        $errors[] = 'Quote is required.';
    }

    if (empty($errors) && $pdo) {
        $uploaded = handle_image_upload('photo', 'testimonials');
        if ($uploaded) {
            $t['photo'] = $uploaded;
        }

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE testimonials SET branch=:branch, client_name=:client_name, client_role=:client_role, photo=:photo, quote=:quote, rating=:rating, sort_order=:sort_order WHERE id=:id'
            );
            $stmt->execute($t + ['id' => $id]);
            flash_set('success', 'Testimonial updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO testimonials (branch, client_name, client_role, photo, quote, rating, sort_order) VALUES (:branch, :client_name, :client_role, :photo, :quote, :rating, :sort_order)'
            );
            $stmt->execute($t);
            flash_set('success', 'Testimonial added.');
        }

        redirect('testimonials.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Testimonial' : 'Add Testimonial';
$activeNav = 'testimonials';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:720px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Branch</label>
            <select class="form-control" name="branch">
                <option value="bookkeeping" <?php echo $t['branch'] === 'bookkeeping' ? 'selected' : ''; ?>>Accounting & Bookkeeping</option>
                <option value="firm_outsourcing" <?php echo $t['branch'] === 'firm_outsourcing' ? 'selected' : ''; ?>>Accounting Firm Outsourcing</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Client Name</label>
                <input class="form-control" type="text" name="client_name" required value="<?php echo e($t['client_name']); ?>">
            </div>
            <div class="form-group">
                <label>Client Role / Company</label>
                <input class="form-control" type="text" name="client_role" value="<?php echo e($t['client_role']); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Quote</label>
            <textarea class="form-control" name="quote" style="min-height:100px;" required><?php echo e($t['quote']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <input class="form-control" type="number" name="rating" min="1" max="5" value="<?php echo (int) $t['rating']; ?>">
            </div>
            <div class="form-group">
                <label>Sort Order (lower shows first)</label>
                <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $t['sort_order']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Photo</label>
            <?php if (!empty($t['photo'])): ?>
                <div class="current-image"><img src="../<?php echo e($t['photo']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="photo" accept="image/*">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Testimonial' : 'Add Testimonial'; ?></button>
        <a href="testimonials.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
