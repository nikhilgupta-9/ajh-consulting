<?php
require_once __DIR__ . '/config/config.php';

$content = ['heading' => 'Insight & Resources', 'subheading' => 'LATEST THINKING', 'body' => '', 'image' => ''];
$posts   = [];

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'insight-resources']);
        $found = $stmt->fetch();
        if ($found) {
            $content = $found;
        }
    } catch (Throwable $e) {
        // page_content not migrated yet — fall back to the defaults above.
    }

    try {
        $posts = $pdo->query(
            "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC"
        )->fetchAll();
    } catch (Throwable $e) {
        $posts = [];
    }
}

$pageTitle       = $content['heading'] ?: 'Insight & Resources';
$metaDescription = $content['body'] ? mb_substr(strip_tags($content['body']), 0, 160) : 'Guides, updates and ideas from our team.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Insight &amp; Resources</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='insight-resources.php'>Insight &amp; Resources</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- hero intro -->
    <div class="rts-section-gapTop">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:760px; margin:0 auto;">
                    <span class="color-primary sub" style="text-transform:uppercase; font-weight:700; letter-spacing:.1em;"><?php echo e($content['subheading']); ?></span>
                    <h2 class="title mt--10"><?php echo e($content['heading']); ?></h2>
                    <?php if ($content['body']): ?>
                        <p class="disc mt--15"><?php echo e($content['body']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- resources grid -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <?php if (empty($posts)): ?>
                    <div class="w-full px-[15px] text-center" style="padding:20px 0 40px; color:#6b7091;">
                        Add posts from Admin &rarr; Blog Posts to show them here.
                    </div>
                <?php endif; ?>
                <?php foreach ($posts as $post): ?>
                    <div class="xl:w-1/3 md:w-1/2 w-full px-[15px] mb--40">
                        <div class="blog-single-post-listing" style="height:100%;">
                            <div class="thumbnail">
                                <img src="<?php echo e($post['image'] ?: 'assets/images/blog/blog-lg-1.jpg'); ?>" alt="<?php echo e($post['title']); ?>">
                            </div>
                            <div class="blog-listing-content">
                                <div class="user-info">
                                    <div class="single">
                                        <i class="far fa-clock"></i>
                                        <span><?php echo date('d M, Y', strtotime($post['created_at'])); ?></span>
                                    </div>
                                </div>
                                <a class='blog-title' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>
                                    <h3 class="title h5"><?php echo e($post['title']); ?></h3>
                                </a>
                                <p class="disc"><?php echo e(mb_strimwidth((string) $post['excerpt'], 0, 110, '...')); ?></p>
                                <a class='rts-btn btn-primary' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
