<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$member = ['name' => '', 'designation' => '', 'photo' => '', 'facebook' => '', 'twitter' => '', 'linkedin' => '', 'instagram' => '', 'sort_order' => 0];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM team_members WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $member = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $member['name']        = clean($_POST['name'] ?? '');
    $member['designation'] = clean($_POST['designation'] ?? '');
    $member['facebook']    = clean($_POST['facebook'] ?? '');
    $member['twitter']     = clean($_POST['twitter'] ?? '');
    $member['linkedin']    = clean($_POST['linkedin'] ?? '');
    $member['instagram']   = clean($_POST['instagram'] ?? '');
    $member['sort_order']  = (int) ($_POST['sort_order'] ?? 0);

    if ($member['name'] === '') {
        $errors[] = 'Name is required.';
    }

    if (empty($errors) && $pdo) {
        $uploaded = handle_image_upload('photo', 'team');
        if ($uploaded) {
            $member['photo'] = $uploaded;
        }

        // Only the known columns — a GET-time SELECT * (when editing) can
        // leave extra keys like id/created_at in $member, which PDO
        // rejects now that emulated prepares are off.
        $memberFields = ['name', 'designation', 'photo', 'facebook', 'twitter', 'linkedin', 'instagram', 'sort_order'];
        $memberData   = array_intersect_key($member, array_flip($memberFields));

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE team_members SET name=:name, designation=:designation, photo=:photo, facebook=:facebook, twitter=:twitter, linkedin=:linkedin, instagram=:instagram, sort_order=:sort_order WHERE id=:id'
            );
            $stmt->execute($memberData + ['id' => $id]);
            flash_set('success', 'Team member updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO team_members (name, designation, photo, facebook, twitter, linkedin, instagram, sort_order) VALUES (:name, :designation, :photo, :facebook, :twitter, :linkedin, :instagram, :sort_order)'
            );
            $stmt->execute($memberData);
            flash_set('success', 'Team member added.');
        }

        redirect('team.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Team Member' : 'Add Team Member';
$activeNav = 'team';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:640px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" required value="<?php echo e($member['name']); ?>">
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input class="form-control" type="text" name="designation" value="<?php echo e($member['designation']); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Facebook URL</label>
                <input class="form-control" type="url" name="facebook" value="<?php echo e($member['facebook']); ?>">
            </div>
            <div class="form-group">
                <label>Twitter / X URL</label>
                <input class="form-control" type="url" name="twitter" value="<?php echo e($member['twitter']); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input class="form-control" type="url" name="linkedin" value="<?php echo e($member['linkedin']); ?>">
            </div>
            <div class="form-group">
                <label>Instagram URL</label>
                <input class="form-control" type="url" name="instagram" value="<?php echo e($member['instagram']); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Sort Order (lower shows first)</label>
            <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $member['sort_order']; ?>">
        </div>

        <div class="form-group">
            <label>Photo</label>
            <?php if (!empty($member['photo'])): ?>
                <div class="current-image"><img src="../<?php echo e($member['photo']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="photo" accept="image/*">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Member' : 'Add Member'; ?></button>
        <a href="team.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
