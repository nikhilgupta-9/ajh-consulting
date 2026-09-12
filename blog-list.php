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

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title">Latest Posts</h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='blog-details.php'>Latest Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog list area -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <!-- rts blog post area -->
                <div class="xl:w-2/3 px-[15px] md:w-full sm:w-full w-full">
                    <!-- single post -->
                    <?php if (empty($posts)): ?>
                    <p class="disc">No blog posts yet. Please check back soon.</p>
                    <?php endif; ?>
                    <?php foreach ($posts as $post): ?>
                    <!-- single post -->
                    <div class="blog-single-post-listing">
                        <div class="thumbnail">
                            <img src="<?php echo e($post['image'] ?: 'assets/images/blog/blog-lg-1.jpg'); ?>" alt="<?php echo e($post['title']); ?>">
                        </div>
                        <div class="blog-listing-content">
                            <div class="user-info">
                                <div class="single">
                                    <i class="far fa-user-circle"></i>
                                    <span>by <?php echo e($post['author']); ?></span>
                                </div>
                                <div class="single">
                                    <i class="far fa-clock"></i>
                                    <span><?php echo date('d M, Y', strtotime($post['created_at'])); ?></span>
                                </div>
                            </div>
                            <a class='blog-title' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>
                                <h2 class="title h3"><?php echo e($post['title']); ?></h2>
                            </a>
                            <p class="disc">
                                <?php echo e($post['excerpt']); ?>
                            </p>
                            <a class='rts-btn btn-primary' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'>Read Details</a>
                        </div>
                    </div>
                    <!-- single post End-->
                    <?php endforeach; ?>
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wized area -->
                <div class="xl:w-1/3 px-[15px] md:w-full sm:w-full w-full mt_lg--60">
                    <!-- single wized start -->
                    <div class="rts-single-wized search">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Search Hear
                            </h3>
                        </div>
                        <div class="wized-body">
                            <div class="rts-search-wrapper">
                                <input class="Search" type="text" placeholder="Enter Keyword">
                                <button><i class="fal fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Categories
                            </h3>
                        </div>
                        <div class="wized-body">
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Business Solution <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Solution Model<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='blog-details.php'>More Business <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Finbiz Solution <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Consulting Busiuness<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                        </div>
                    </div>
                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized Recent-post">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Recent Posts
                            </h3>
                        </div>
                        <div class="wized-body">
                            <!-- recent-post -->
                            <div class="recent-post-single">
                                <div class="thumbnail">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/recent-post/01.png" alt="Blog_post"></a>
                                </div>
                                <div class="content-area">
                                    <div class="user">
                                        <i class="fal fa-clock"></i>
                                        <span>15 Jan, 2023</span>
                                    </div>
                                    <a class='post-title' href='blog-details.php'><h6 class="title">Best Business Ideas For Getting Solution</h6></a>
                                </div>
                            </div>
                            <!-- recent-post End -->
                            <!-- recent-post -->
                            <div class="recent-post-single">
                                <div class="thumbnail">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/recent-post/02.png" alt="Blog_post"></a>
                                </div>
                                <div class="content-area">
                                    <div class="user">
                                        <i class="fal fa-clock"></i>
                                        <span>15 Jan, 2023</span>
                                    </div>
                                    <a class='post-title' href='blog-details.php'><h6 class="title">How To Grow Your Business With Strategy</h6></a>
                                </div>
                            </div>
                            <!-- recent-post End -->
                            <!-- recent-post -->
                            <div class="recent-post-single">
                                <div class="thumbnail">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/recent-post/03.png" alt="Blog_post"></a>
                                </div>
                                <div class="content-area">
                                    <div class="user">
                                        <i class="fal fa-clock"></i>
                                        <span>15 Jan, 2023</span>
                                    </div>
                                    <a class='post-title' href='blog-details.php'><h6 class="title">The Better Solution For Your Finance</h6></a>
                                </div>
                            </div>
                            <!-- recent-post End -->
                            <!-- recent-post -->
                            <div class="recent-post-single">
                                <div class="thumbnail">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/recent-post/04.png" alt="Blog_post"></a>
                                </div>
                                <div class="content-area">
                                    <div class="user">
                                        <i class="fal fa-clock"></i>
                                        <span>15 Jan, 2023</span>
                                    </div>
                                    <a class='post-title' href='blog-details.php'><h6 class="title">Useful Tips From Business Experts</h6></a>
                                </div>
                            </div>
                            <!-- recent-post End -->
                        </div>
                    </div>
                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized Recent-post">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Recent Posts
                            </h3>
                        </div>
                        <div class="wized-body">
                            <div class="gallery-inner">
                                <div class="row-1 single-row">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/01.png" alt="Gallery"></a>
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/02.png" alt="Gallery"></a>
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/03.png" alt="Gallery"></a>
                                </div>
                                <div class="row-2 single-row">
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/04.png" alt="Gallery"></a>
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/05.png" alt="Gallery"></a>
                                    <a href='blog-details.php'><img src="assets/images/blog/details/gallery/06.png" alt="Gallery"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Popular Tags
                            </h3>
                        </div>
                        <div class="wized-body">
                            <div class="tags-wrapper">
                                <a href='our-service.php'>Services</a>
                                <a href='blog-details.php'>Business</a>
                                <a href='blog-details.php'>Growth</a>
                                <a href='blog-details.php'>Finance</a>
                                <a href='blog-details.php'>UI/UX Design</a>
                                <a href='service-details.php'>Solution</a>
                                <a href='blog-details.php'>Speed</a>
                                <a href='service-details.php'>Strategy</a>
                                <a href='service-details.php'>Technology</a>
                            </div>
                        </div>
                    </div>
                    <!-- single wized End -->
                    <!-- single wized start -->
                    <div class="rts-single-wized contact">
                        <div class="wized-header">
                            <a href='about-us.php'><img src="assets/images/logo/logo-2.svg" alt="Business_logo"></a>
                        </div>
                        <div class="wized-body">
                            <h3 class="title">Need Help? We Are Here
                                To Help You</h3>
                            <a class='rts-btn btn-primary' href='contactus.php'>Contact Us</a>
                        </div>
                    </div>
                    <!-- single wized End -->
                </div>
                <!-- rts- blog wized end area -->
            </div>
        </div>
    </div>
    <!-- rts blog list area End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
