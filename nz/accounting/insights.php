<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Insights & Resources | get-accountant New Zealand';
$metaDescription = 'Practical guides, New Zealand tax calendar deadlines, cash flow strategies, and cloud accounting tips for Kiwi small businesses.';
$pageHeading     = 'Insights & Resources';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

$articles = [];
if ($pdo = db()) {
    try {
        $articles = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
    } catch (Throwable $e) {
        $articles = [];
    }
}

$taxCalendar = [
    ['date' => '28th of every 2nd month', 'title' => 'GST Return & Payment', 'desc' => 'Filing and payment due for standard bi-monthly periods ending the previous month.'],
    ['date' => '20th of every month', 'title' => 'PAYE & Employer Deductions', 'desc' => 'Monthly payment of PAYE, KiwiSaver, student loan, and child support deductions to IRD.'],
    ['date' => '28 August / 15 January / 7 May', 'title' => 'Provisional Tax Installments', 'desc' => 'Standard provisional tax payment dates for standard 31 March balance dates.'],
    ['date' => '7 February / 7 April', 'title' => 'Terminal Tax Due Date', 'desc' => 'Terminal tax payment due date (7 April for clients linked to an approved tax agency like get-accountant).'],
];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';
?>

    <div class="rts-blog-area rts-section-gap" style="padding: 80px 0;">
        <div class="container">
            <!-- Header section -->
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Latest Thinking</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Insights &amp; Practical Resources for Kiwi Businesses</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Stay ahead of Inland Revenue deadlines, tax compliance updates, and practical financial strategies.
                    </p>
                </div>
            </div>

            <!-- New Zealand Tax Calendar Strip -->
            <div style="background: #0b1220; color: #fff; border-radius: 18px; padding: 40px 35px; margin-bottom: 60px;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; margin-bottom: 25px;">
                    <div>
                        <span style="color: #ff6b6b; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">Inland Revenue Quick Reference</span>
                        <h3 style="color: #fff; font-size: 24px; margin: 4px 0 0; font-weight: 800;">Key New Zealand Tax Deadlines</h3>
                    </div>
                    <span style="background: rgba(229,57,53,0.2); color: #ff6b6b; border: 1px solid rgba(229,57,53,0.3); font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px;">
                        Never Miss an IRD Deadline
                    </span>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                    <?php foreach ($taxCalendar as $tc): ?>
                    <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 22px;">
                        <span style="display: block; font-size: 13px; font-weight: 800; color: #e53935; margin-bottom: 6px;"><?php echo e($tc['date']); ?></span>
                        <h4 style="color: #fff; font-size: 16px; margin: 0 0 8px; font-weight: 700;"><?php echo e($tc['title']); ?></h4>
                        <p style="color: #94a3b8; font-size: 13px; line-height: 1.5; margin: 0;"><?php echo e($tc['desc']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Articles Grid -->
            <?php if (!empty($articles)): ?>
            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($articles as $art): ?>
                <div class="xl:w-1/3 md:w-1/2 px-[15px] pb--35">
                    <div style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.04); height: 100%; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                        <a href="<?php echo site_url('blog-details.php') . '?slug=' . urlencode($art['slug']); ?>" style="height: 200px; overflow: hidden; display: block;">
                            <img src="<?php echo site_url($art['image'] ?: 'assets/images/blog/01.jpg'); ?>" alt="<?php echo e($art['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
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
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Need Specific Tax Advice for Your Business?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">Speak with our New Zealand certified accounting team today.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Talk to an Advisor <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
