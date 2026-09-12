<?php
require_once __DIR__ . '/config/config.php';

$post = null;

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

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title"><?php echo e($post['title']); ?></h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='blog-details.php?slug=<?php echo urlencode($post['slug']); ?>'><?php echo e($post['title']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog mlist area -->
    <div class="rts-blog-list-area rts-section-gap">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px]">
                <!-- rts blo post area -->
                <div class="xl:w-2/3 px-[15px] md:w-full sm:w-full w-full">
                    <!-- single post -->
                    <div class="blog-single-post-listing details mb--0">
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
                            <h2 class="title h3"><?php echo e($post['title']); ?></h2>
                            <div class="disc para-1">
                                <?php echo $post['content']; ?>
                            </div>
                            <div class="flex flex-wrap -mx-[15px] items-center">
                                <div class="lg:w-1/2 px-[15px] md:w-full">
                                    <!-- tags details -->
                                    <div class="details-tag">
                                        <h3>Tags:</h3>
                                        <button>Services</button>
                                        <button>Business</button>
                                        <button>Growth</button>
                                    </div>
                                    <!-- tags details End -->
                                </div>
                                <div class="lg:w-1/2 px-[15px] md:w-full">
                                    <div class="details-share">
                                        <h3>Share:</h3>
                                        <button><i class="fab fa-facebook-f"></i></button>
                                        <button><i class="fab fa-twitter"></i></button>
                                        <button><i class="fab fa-instagram"></i></button>
                                        <button><i class="fab fa-linkedin-in"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="author-area">
                                <div class="thumbnail details mb_sm--15">
                                    <img src="assets/images/blog/details/author.jpg" alt="finbiz_buseness">
                                </div>
                                <div class="author-details team">
                                    <span>Brand Designer</span>
                                    <h3>Angelina H. Dekato</h3>
                                    <p class="disc">
                                        Nullam varius luctus pharetra ultrices volpat facilisis donec tortor, nibhkisys
                                        habitant curabitur at nunc nisl magna ac rhoncus vehicula sociis tortor nist
                                        hendrerit molestie integer.
                                    </p>
                                </div>
                            </div>
                            <div class="replay-area-details">
                                <h3 class="title h3">Leave a Reply</h3>
                                <form action="#">
                                    <div class="flex flex-wrap -mx-[12px] gap-y-[20px] [&>*]:!px-[12px]">
                                        <div class="lg:w-1/2 px-[15px]">
                                            <input type="text" placeholder="Your Name">
                                        </div>
                                        <div class="lg:w-1/2 px-[15px]">
                                            <input type="text" placeholder="Your Name">
                                        </div>
                                        <div class="w-full px-[15px]">
                                            <input type="text" placeholder="Select Topic">
                                        </div>
                                        <div class="w-full px-[15px]">
                                            <textarea></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a class='rts-btn btn-primary' href='contactus.php'>Submit Message</a>
                        </div>
                    </div>
                    <!-- single post End-->
                </div>
                <!-- rts-blog post end area -->
                <!--rts blog wizered area -->
                <div class="xl:w-1/3 px-[15px] md:w-full sm:w-full w-full">
                    <!-- single wizered start -->
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
                    <!-- single wizered End -->
                    <!-- single wizered start -->
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
                                <li><a href='service-details.php'>Strategy Growth<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Finance Solution<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Investment Policy<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href='service-details.php'>Tax Managment<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                        </div>
                    </div>
                    <!-- single wizered End -->
                    <!-- single wizered start -->
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
                    <!-- single wizered End -->
                    <!-- single wizered start -->
                    <div class="rts-single-wized Recent-post">
                        <div class="wized-header">
                            <h3 class="title h5">
                                Gallery Posts
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
                    <!-- single wizered End -->
                    <!-- single wizered start -->
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
                    <!-- single wizered End -->
                    <!-- single wizered start -->
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
                    <!-- single wizered End -->
                </div>
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
    <!-- rts blog mlist area End -->

<?php require __DIR__ . '/includes/footer.php'; ?>
