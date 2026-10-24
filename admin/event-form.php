<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$event = [
    'title' => '', 'slug' => '', 'summary' => '', 'description' => '', 'image' => '',
    'video_url' => '', 'event_date' => '', 'event_time' => '', 'location' => '',
    'registration_url' => '', 'status' => 'published',
];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM events WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $event = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $event['title']            = clean($_POST['title'] ?? '');
    $event['summary']          = clean($_POST['summary'] ?? '');
    $event['description']      = $_POST['description'] ?? '';
    $event['video_url']        = clean($_POST['video_url'] ?? '');
    $event['event_date']       = clean($_POST['event_date'] ?? '');
    $event['event_time']       = clean($_POST['event_time'] ?? '');
    $event['location']         = clean($_POST['location'] ?? '');
    $event['registration_url'] = clean($_POST['registration_url'] ?? '');
    $event['status']           = in_array($_POST['status'] ?? '', ['draft', 'published'], true) ? $_POST['status'] : 'published';

    if ($event['title'] === '') {
        $errors[] = 'Title is required.';
    }
    if ($event['event_date'] === '') {
        $errors[] = 'Event date is required.';
    }

    if (empty($errors) && $pdo) {
        $slug = slugify($event['title']);
        $check = $pdo->prepare('SELECT id FROM events WHERE slug = :slug AND id != :id');
        $check->execute(['slug' => $slug, 'id' => $id]);
        if ($check->fetch()) {
            $slug .= '-' . substr(md5((string) time()), 0, 5);
        }
        $event['slug'] = $slug;

        $uploaded = handle_image_upload('image', 'events');
        if ($uploaded) {
            $event['image'] = $uploaded;
        }

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE events SET title=:title, slug=:slug, summary=:summary, description=:description, image=:image,
                 video_url=:video_url, event_date=:event_date, event_time=:event_time, location=:location,
                 registration_url=:registration_url, status=:status WHERE id=:id'
            );
            $stmt->execute([
                'title' => $event['title'], 'slug' => $event['slug'], 'summary' => $event['summary'],
                'description' => $event['description'], 'image' => $event['image'], 'video_url' => $event['video_url'],
                'event_date' => $event['event_date'], 'event_time' => $event['event_time'], 'location' => $event['location'],
                'registration_url' => $event['registration_url'], 'status' => $event['status'], 'id' => $id,
            ]);
            flash_set('success', 'Event updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO events (title, slug, summary, description, image, video_url, event_date, event_time, location, registration_url, status)
                 VALUES (:title, :slug, :summary, :description, :image, :video_url, :event_date, :event_time, :location, :registration_url, :status)'
            );
            $stmt->execute([
                'title' => $event['title'], 'slug' => $event['slug'], 'summary' => $event['summary'],
                'description' => $event['description'], 'image' => $event['image'], 'video_url' => $event['video_url'],
                'event_date' => $event['event_date'], 'event_time' => $event['event_time'], 'location' => $event['location'],
                'registration_url' => $event['registration_url'], 'status' => $event['status'],
            ]);
            flash_set('success', 'Event created.');
        }

        redirect('events.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Event' : 'New Event';
$activeNav = 'events';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:780px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Event Title</label>
            <input class="form-control" type="text" name="title" required value="<?php echo e($event['title']); ?>">
        </div>

        <div class="form-group">
            <label>Short Summary (shown on the events list card)</label>
            <textarea class="form-control" name="summary" style="min-height:70px;"><?php echo e($event['summary']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Event Date</label>
                <input class="form-control" type="date" name="event_date" required value="<?php echo e($event['event_date'] ? date('Y-m-d', strtotime($event['event_date'])) : ''); ?>">
            </div>
            <div class="form-group">
                <label>Event Time</label>
                <input class="form-control" type="text" name="event_time" placeholder="e.g. 11:00am &ndash; 12:00pm NZST" value="<?php echo e($event['event_time']); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Location</label>
                <input class="form-control" type="text" name="location" placeholder="Online (Zoom) or a physical address" value="<?php echo e($event['location']); ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="published" <?php echo $event['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                    <option value="draft" <?php echo $event['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Registration / Booking Link</label>
            <input class="form-control" type="url" name="registration_url" placeholder="https://..." value="<?php echo e($event['registration_url']); ?>">
        </div>

        <div class="form-group">
            <label>Video URL (optional &mdash; YouTube/Vimeo embed or recap link)</label>
            <input class="form-control" type="url" name="video_url" placeholder="https://www.youtube.com/embed/..." value="<?php echo e($event['video_url']); ?>">
        </div>

        <div class="form-group">
            <label>Full Description</label>
            <textarea id="event-description-editor" class="form-control" name="description" style="min-height:260px;"><?php echo e($event['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Cover Image</label>
            <?php if (!empty($event['image'])): ?>
                <div class="current-image"><img src="../<?php echo e($event['image']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Event' : 'Create Event'; ?></button>
        <a href="events.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#event-description-editor',
        height: 420,
        menubar: false,
        plugins: 'lists link image table code wordcount',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | alignleft aligncenter alignright | removeformat | code',
        branding: false,
        images_upload_url: 'editor-image-upload.php',
        automatic_uploads: true,
        content_style: 'body { font-family: Segoe UI, Arial, sans-serif; font-size: 15px; line-height: 1.7; } img { max-width: 100%; height: auto; }'
    });
</script>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
