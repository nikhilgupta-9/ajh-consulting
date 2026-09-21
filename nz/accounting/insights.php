<?php
require_once __DIR__ . '/config/config.php';

$pageTitle       = 'Insights & Resources';
$metaDescription = 'Business, tax and bookkeeping insights for New Zealand small businesses.';
$pageHeading     = 'Insights & Resources';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'accounting-bookkeeping.php'];

$posts = [];
if ($pdo = db()) {
    try {
        $posts = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
    } catch (Throwable $e) {
        $posts = [];
    }
}

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/breadcrumb.php';
require __DIR__ . '/includes/bookkeeping-subnav.php';
?>

    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <?php if (empty($posts)): ?>
                <p class="disc text-center">Articles will appear here soon. Manage them from the admin panel &mdash; Blog Posts.</p>
            <?php else: ?>
                <div class="flex flex-wrap -mx-[15px]">
                    <?php foreach ($posts as $post): ?>
                    <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--40">
                        <div class="blog-single-post-listing" style="height:100%;">
                            <div class="thumbnail">
                                <img src="<?php echo e($post['image'] ?: 'assets/images/blog/blog-lg-1.jpg'); ?>" alt="<?php echo e($post['title']); ?>">
                            </div>
                            <div class="blog-listing-content">
                                <a class='blog-title' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>
                                    <h3 class="title" style="font-size:19px;"><?php echo e($post['title']); ?></h3>
                                </a>
                                <p class="disc"><?php echo e($post['excerpt']); ?></p>
                                <a class='rts-read-more-two color-primary' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>Read More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
