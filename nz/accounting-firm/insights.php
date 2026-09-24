<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Insights for Accounting Firms | Practice Management & Scaling';
$metaDescription = 'Practice management insights, staffing strategies, margin optimization, and cloud workflow guides for New Zealand CA and CPA leaders.';
$pageHeading     = 'Insights for Accounting Firms';
$breadcrumbParent = ['label' => 'Accounting Firm Outsourcing', 'url' => 'index.php'];

$articles = [];
if ($pdo = db()) {
    try {
        $articles = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
    } catch (Throwable $e) {
        $articles = [];
    }
}

$practiceGuides = [
    [
        'title' => 'Scaling Past the Talent Ceiling: How Mid-Tier Kiwi Firms Unlock 20%+ Margins',
        'read'  => '5 min read',
        'desc'  => 'An analytical breakdown of how modern firms shift intermediate compliance to dedicated back-office pods while redeploying local seniors to high-value advisory.',
    ],
    [
        'title' => 'The Complete Due Diligence Checklist for Outsourcing Practice Workpapers',
        'read'  => '7 min read',
        'desc'  => 'Essential criteria every CA ANZ partner should demand before signing an outsourcing agreement: data security, SOP mapping, and QA frameworks.',
    ],
    [
        'title' => 'Automating Accounts Payable & Receivable for SME Clients in Xero',
        'read'  => '4 min read',
        'desc'  => 'Best practices for setting up Dext Prepare rules and automated debtor workflows to eliminate manual data entry across multi-client ledgers.',
    ],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/firm-outsourcing-subnav.php';
?>

    <div class="rts-blog-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Practice Strategy</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Insights &amp; Strategy for Practice Partners</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Actionable thinking on practice scalability, talent management, workflow automation, and client advisory.
                    </p>
                </div>
            </div>

            <!-- Featured Practice Guides -->
            <div class="flex flex-wrap -mx-[15px] mb--40">
                <?php foreach ($practiceGuides as $pg): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--30">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px 26px; height: 100%; box-shadow: 0 10px 25px rgba(0,0,0,0.04); display: flex; flex-direction: column; border-top: 4px solid #0f172a;">
                        <span style="font-size: 12px; font-weight: 700; color: #e53935; text-transform: uppercase; margin-bottom: 8px;"><?php echo e($pg['read']); ?></span>
                        <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px; color: #0f172a;"><?php echo e($pg['title']); ?></h3>
                        <p class="disc" style="color: #64748b; font-size: 14px; line-height: 1.6; margin: 0; flex-grow: 1;">
                            <?php echo e($pg['desc']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Articles from DB -->
            <?php if (!empty($articles)): ?>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($articles as $art): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.04); height: 100%; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                        <a href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($art['slug']); ?>" style="height: 200px; overflow: hidden; display: block;">
                            <img src="<?php echo site_url($art['image'] ?: 'assets/images/blog/02.jpg'); ?>" alt="<?php echo e($art['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                        <div style="padding: 28px 24px; flex-grow: 1; display: flex; flex-direction: column;">
                            <span style="font-size: 13px; color: #94a3b8; margin-bottom: 8px;"><i class="fal fa-calendar-alt"></i> <?php echo date('M d, Y', strtotime($art['created_at'])); ?></span>
                            <h3 class="title h5" style="margin-bottom: 12px; font-size: 19px;">
                                <a href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($art['slug']); ?>" style="color: #0f172a; text-decoration: none;"><?php echo e($art['title']); ?></a>
                            </h3>
                            <p class="disc" style="color: #64748b; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                                <?php echo e($art['excerpt']); ?>
                            </p>
                            <a class="rts-read-more color-primary" href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($art['slug']); ?>" style="font-weight: 700; font-size: 14px;">
                                Read Full Article <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Want to Discuss Practice Scalability?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Speak directly with our partnership director under full mutual NDA.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Schedule Partner Meeting <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
