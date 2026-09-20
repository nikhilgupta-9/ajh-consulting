<?php
/**
 * Renders an admin-editable legal page (Privacy Policy, Terms of Use)
 * by slug — e.g. legal.php?slug=privacy-policy.
 * Friendly aliases privacy-policy.php / terms-of-use.php redirect here.
 */
require_once __DIR__ . '/config/config.php';

$knownSlugs = ['privacy-policy' => 'Privacy Policy', 'terms-of-use' => 'Terms of Use'];
$slug       = $_GET['slug'] ?? 'privacy-policy';

if (!isset($knownSlugs[$slug])) {
    http_response_code(404);
    $slug = 'privacy-policy';
}

$page = ['slug' => $slug, 'title' => $knownSlugs[$slug], 'content' => '<p>This page has not been set up yet. Add its content from Admin &rarr; Legal Pages.</p>'];

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM legal_pages WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $found = $stmt->fetch();
        if ($found) {
            $page = $found;
        }
    } catch (Throwable $e) {
        // legal_pages not migrated yet — fall back to the placeholder above.
    }
}

$pageTitle       = $page['title'];
$metaDescription = strip_tags((string) $page['content']);
$metaDescription = mb_substr($metaDescription, 0, 160);

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title"><?php echo e($page['title']); ?></h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='legal.php?slug=<?php echo urlencode($slug); ?>'><?php echo e($page['title']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <div class="rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]" style="max-width:860px; margin:0 auto;">
                    <div class="legal-content" style="line-height:1.8;">
                        <?php echo $page['content']; ?>
                    </div>
                    <p style="margin-top:40px; color:#6b7091; font-size:13px;">
                        Last updated: <?php echo date('d M Y', strtotime($page['updated_at'] ?? 'now')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
