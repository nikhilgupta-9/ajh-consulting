<?php
require_once __DIR__ . '/config/config.php';

$post        = null;
$recentPosts = [];

if ($pdo = db()) {
    try {
        $slug = $_GET['slug'] ?? null;
        if ($slug) {
            $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = :slug AND status = 'published' LIMIT 1");
            $stmt->execute(['slug' => $slug]);
            $post = $stmt->fetch() ?: null;
        }
        if (!$post) {
            $post = $pdo->query(
                "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 1"
            )->fetch() ?: null;
        }
        if ($post) {
            $stmt = $pdo->prepare(
                "SELECT * FROM blog_posts WHERE status = 'published' AND slug != :slug ORDER BY created_at DESC LIMIT 4"
            );
            $stmt->execute(['slug' => $post['slug']]);
            $recentPosts = $stmt->fetchAll();
        }
    } catch (Throwable $e) {
        $post = null;
    }
}

if (!$post) {
    $post = [
        'title'      => 'No posts yet',
        'slug'       => '',
        'image'      => null,
        'author'     => APP_NAME,
        'created_at' => date('Y-m-d H:i:s'),
        'content'    => '<p>Add blog posts from the admin panel to replace this placeholder text.</p>',
    ];
}

$pageTitle       = $post['title'];
$metaDescription = strip_tags($post['content'] ?? '');
$metaDescription = mb_substr($metaDescription, 0, 160);

// Build a Table of Contents from <h2> headings and slug-id them for anchor links.
$toc = [];
$post['content'] = preg_replace_callback(
    '/<h2>(.*?)<\/h2>/i',
    function ($m) use (&$toc) {
        $text = trim(strip_tags($m[1]));
        $id   = 'section-' . (count($toc) + 1) . '-' . slugify($text);
        $toc[] = ['id' => $id, 'text' => $text];
        return '<h2 id="' . e($id) . '">' . $m[1] . '</h2>';
    },
    (string) ($post['content'] ?? '')
);

require __DIR__ . '/includes/header.php';
?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/blog.css'); ?>">

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image blog-details-breadcrumb">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title"><?php echo e($post['title']); ?></h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='<?php echo site_url('index.php'); ?>'>Home</a>
                        <span> / </span>
                        <a href='<?php echo site_url('blog-list.php'); ?>'>Blog</a>
                        <span> / </span>
                        <a class='active' href='#'>Article</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <div class="blog-wrap">
        <div class="container">
            <div class="blog-layout">

                <!-- Article -->
                <article class="blog-article">
                    <?php if (!empty($post['image'])): ?>
                        <div class="blog-article-thumb">
                            <img src="<?php echo e($post['image']); ?>" alt="<?php echo e($post['title']); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="blog-article-head">
                        <h1><?php echo e($post['title']); ?></h1>
                        <div class="blog-article-meta">
                            <span><i class="far fa-user-circle"></i> <?php echo e($post['author']); ?></span>
                            <span><i class="far fa-clock"></i> <?php echo date('d M, Y', strtotime($post['created_at'])); ?></span>
                        </div>
                    </div>

                    <?php if (!empty($toc)): ?>
                        <details class="blog-toc" open>
                            <summary>Table of Contents</summary>
                            <ol>
                                <?php foreach ($toc as $t): ?>
                                    <li><a href="#<?php echo e($t['id']); ?>"><?php echo e($t['text']); ?></a></li>
                                <?php endforeach; ?>
                            </ol>
                        </details>
                    <?php endif; ?>

                    <div class="blog-article-body">
                        <?php echo $post['content']; ?>
                    </div>

                    <div class="blog-cta-card">
                        <div>
                            <h3>Need Accounting Support?</h3>
                            <p>Talk to our team about how we can help with your bookkeeping, tax and compliance needs.</p>
                        </div>
                        <a class="rts-btn btn-primary" href="<?php echo site_url('contactus.php'); ?>">Talk to an Expert</a>
                    </div>
                </article>

                <!-- Sidebar -->
                <div>
                    <div class="blog-sidebar-card">
                        <h3>Categories</h3>
                        <ul class="blog-sidebar-categories">
                            <li><a href="<?php echo site_url('nz/accounting/services.php'); ?>">Bookkeeping &amp; Payroll <i class="far fa-long-arrow-right"></i></a></li>
                            <li><a href="<?php echo site_url('nz/accounting/'); ?>">Tax Preparation &amp; Filing <i class="far fa-long-arrow-right"></i></a></li>
                            <li><a href="<?php echo site_url('nz/accounting-firm/'); ?>">Accounting Firm Outsourcing <i class="far fa-long-arrow-right"></i></a></li>
                            <li><a href="<?php echo site_url('nz/accounting/industries.php'); ?>">Industries We Support <i class="far fa-long-arrow-right"></i></a></li>
                        </ul>
                    </div>

                    <div class="blog-sidebar-card">
                        <h3>Recent Posts</h3>
                        <?php if (empty($recentPosts)): ?>
                            <p class="disc" style="font-size:13px; color:#9ca3af; margin:0;">No other posts yet.</p>
                        <?php endif; ?>
                        <?php foreach ($recentPosts as $rp): ?>
                            <div class="blog-sidebar-post">
                                <img src="<?php echo e($rp['image'] ?: site_url('assets/images/blog/blog-lg-1.jpg')); ?>" alt="<?php echo e($rp['title']); ?>">
                                <div>
                                    <div class="blog-sidebar-post-meta"><?php echo date('d M, Y', strtotime($rp['created_at'])); ?></div>
                                    <a class="blog-sidebar-post-title" href="<?php echo site_url('blog-details.php'); ?>?slug=<?php echo urlencode($rp['slug']); ?>"><?php echo e($rp['title']); ?></a>
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
