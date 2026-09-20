<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

$fields = [
    'company_name', 'tagline', 'email', 'phone', 'whatsapp_number',
    'address', 'working_hours', 'map_embed_url',
    'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url', 'whatsapp_url',
    'copyright_text',
];

$settings = array_fill_keys($fields, '');

if ($pdo) {
    try {
        $row = $pdo->query('SELECT * FROM site_settings WHERE id = 1')->fetch();
        if ($row) {
            $settings = array_merge($settings, $row);
        }
    } catch (Throwable $e) {
        flash_set('error', 'The site_settings table does not exist yet. Run database/migration_005_site_settings.sql, then reload this page.');
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    foreach ($fields as $field) {
        $settings[$field] = clean($_POST[$field] ?? '');
    }

    if ($settings['email'] !== '' && !filter_var($settings['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($errors) && $pdo) {
        try {
            $sql = 'INSERT INTO site_settings (id, ' . implode(', ', $fields) . ')
                    VALUES (1, ' . implode(', ', array_map(fn ($f) => ":$f", $fields)) . ')
                    ON DUPLICATE KEY UPDATE ' . implode(', ', array_map(fn ($f) => "$f = VALUES($f)", $fields));
            $stmt = $pdo->prepare($sql);
            // Only pass the known fields — extra keys (id, updated_at) picked
            // up from the SELECT * merge above would otherwise trip PDO's
            // strict parameter check now that emulated prepares are off.
            $stmt->execute(array_intersect_key($settings, array_flip($fields)));

            flash_set('success', 'Settings updated.');
            redirect('settings.php');
        } catch (Throwable $e) {
            $errors[] = 'Could not save settings. Has database/migration_005_site_settings.sql been run?';
        }
    }
}

$pageTitle = 'Site Settings';
$activeNav = 'settings';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:820px;">
    <div class="page-header">
        <h2>Contact &amp; Site Settings</h2>
        <a href="../contactus.php" target="_blank" class="btn btn-outline btn-sm">View Contact Page</a>
    </div>
    <p style="color:#6b7091; margin-top:-8px;">These details power the header, footer, floating WhatsApp button and the public Contact page across the whole site.</p>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php echo csrf_field(); ?>

        <h3 style="margin:0 0 14px;">Company</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Company Name</label>
                <input class="form-control" type="text" name="company_name" value="<?php echo e($settings['company_name']); ?>">
            </div>
            <div class="form-group">
                <label>Tagline / Short About</label>
                <input class="form-control" type="text" name="tagline" value="<?php echo e($settings['tagline']); ?>">
            </div>
        </div>

        <h3 style="margin:20px 0 14px;">Contact Details</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="<?php echo e($settings['email']); ?>">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control" type="text" name="phone" value="<?php echo e($settings['phone']); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>WhatsApp Number (with country code, e.g. 919876543210)</label>
                <input class="form-control" type="text" name="whatsapp_number" value="<?php echo e($settings['whatsapp_number']); ?>">
            </div>
            <div class="form-group">
                <label>WhatsApp Link (optional — overrides the number above if set)</label>
                <input class="form-control" type="url" name="whatsapp_url" placeholder="https://wa.me/919876543210" value="<?php echo e($settings['whatsapp_url']); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Address</label>
                <input class="form-control" type="text" name="address" value="<?php echo e($settings['address']); ?>">
            </div>
            <div class="form-group">
                <label>Working Hours</label>
                <input class="form-control" type="text" name="working_hours" placeholder="Mon - Fri: 9:00am - 6:00pm" value="<?php echo e($settings['working_hours']); ?>">
            </div>
        </div>

        <h3 style="margin:20px 0 14px;">Google Map</h3>
        <div class="form-group">
            <label>Map Embed URL (Google Maps &rarr; Share &rarr; Embed a map &rarr; copy the "src" from the iframe)</label>
            <input class="form-control" type="url" name="map_embed_url" placeholder="https://www.google.com/maps/embed?pb=..." value="<?php echo e($settings['map_embed_url']); ?>">
            <small style="color:#6b7091;">Leave blank to hide the map on the Contact page.</small>
        </div>

        <h3 style="margin:20px 0 14px;">Social Media</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Facebook URL</label>
                <input class="form-control" type="url" name="facebook_url" value="<?php echo e($settings['facebook_url']); ?>">
            </div>
            <div class="form-group">
                <label>Twitter / X URL</label>
                <input class="form-control" type="url" name="twitter_url" value="<?php echo e($settings['twitter_url']); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Instagram URL</label>
                <input class="form-control" type="url" name="instagram_url" value="<?php echo e($settings['instagram_url']); ?>">
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input class="form-control" type="url" name="linkedin_url" value="<?php echo e($settings['linkedin_url']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label>YouTube URL</label>
            <input class="form-control" type="url" name="youtube_url" value="<?php echo e($settings['youtube_url']); ?>">
        </div>

        <h3 style="margin:20px 0 14px;">Footer</h3>
        <div class="form-group">
            <label>Copyright Text (shown next to the year in the footer)</label>
            <input class="form-control" type="text" name="copyright_text" placeholder="Your Company Name. All rights reserved." value="<?php echo e($settings['copyright_text']); ?>">
        </div>

        <button type="submit" class="btn">Save Settings</button>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
