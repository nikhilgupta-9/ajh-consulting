<?php
require_once __DIR__ . '/config/config.php';

$posts = [];
if ($pdo = db()) {
    try {
        $posts = $pdo->query(
            "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC"
        )->fetchAll();
    } catch (Throwable $e) {
        $posts = [];
    }
}

$pageTitle       = 'Blog';
$metaDescription = 'Business, tax and financial insights from the get-accountant team.';

require __DIR__ . '/includes/header.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/blog.css'); ?>">

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Latest Posts</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='<?php echo site_url('index.php'); ?>'>Home</a>
                        <span> / </span>
                        <a class='active' href='#'>Latest Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <div class="blog-wrap">
        <div class="container">
            <div class="blog-layout">

                <!-- Post grid -->
                <div>
                    <?php if (empty($posts)): ?>
                        <p class="disc">No blog posts yet. Please check back soon.</p>
                    <?php else: ?>
                        <div class="blog-grid">
                            <?php foreach ($posts as $post): ?>
                                <article class="blog-card">
                                    <a class="blog-card-thumb" href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($post['slug']); ?>">
                                        <img src="<?php echo e($post['image'] ?: site_url('assets/images/blog/blog-lg-1.jpg')); ?>" alt="<?php echo e($post['title']); ?>">
                                    </a>
                                    <div class="blog-card-body">
                                        <div class="blog-card-meta">
                                            <span><i class="far fa-user-circle"></i> <?php echo e($post['author']); ?></span>
                                            <span><i class="far fa-clock"></i> <?php echo date('d M, Y', strtotime($post['created_at'])); ?></span>
                                        </div>
                                        <h2 class="blog-card-title">
                                            <a href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($post['slug']); ?>"><?php echo e($post['title']); ?></a>
                                        </h2>
                                        <p class="blog-card-excerpt"><?php echo e($post['excerpt']); ?></p>
                                        <a class="blog-card-link" href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($post['slug']); ?>">Read More <i class="far fa-long-arrow-right"></i></a>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div>
                    <div class="blog-sidebar-card">
                        <h3>Recent Posts</h3>
                        <?php if (empty($posts)): ?>
                            <p class="disc" style="font-size:13px; color:#9ca3af; margin:0;">No posts yet.</p>
                        <?php endif; ?>
                        <?php foreach (array_slice($posts, 0, 4) as $post): ?>
                            <div class="blog-sidebar-post">
                                <img src="<?php echo e($post['image'] ?: site_url('assets/images/blog/blog-lg-1.jpg')); ?>" alt="<?php echo e($post['title']); ?>">
                                <div>
                                    <div class="blog-sidebar-post-meta"><?php echo date('d M, Y', strtotime($post['created_at'])); ?></div>
                                    <a class="blog-sidebar-post-title" href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($post['slug']); ?>"><?php echo e($post['title']); ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="blog-sidebar-cta">
                        <h3>Need Help? We Are Here</h3>
                        <p>Talk to our team about your accounting or bookkeeping needs.</p>
                        <a class="rts-btn btn-primary" href="<?php echo site_url('contactus.php'); ?>">Contact Us</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>
