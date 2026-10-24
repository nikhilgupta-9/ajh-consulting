<?php
/**
 * Usage: set $pageHeading and optionally $breadcrumbParent = ['label' => '...', 'url' => '...']
 * before requiring this file (after header.php).
 */
$__parent = $breadcrumbParent ?? null;
?>
<style>
    .rts-breadcrumb-area.has-site-breadcrumb {
        padding: 0;
    }

    .site-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding: 26px 0;
    }

    .site-breadcrumb-title {
        margin: 0;
        font-size: 28px;
        line-height: 1.3;
        color: #fff;
        flex: 1 1 auto;
        min-width: 0;
    }

    .site-breadcrumb-tag {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 2px 6px;
        padding: 10px 20px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 9px 18px rgba(24, 16, 16, .05);
        font-size: 13.5px;
        flex: 0 0 auto;
        max-width: 100%;
    }

    .site-breadcrumb-tag a { font-weight: 700; white-space: nowrap; }
    .site-breadcrumb-tag a.active { color: #1c2539; font-weight: 600; }
    .site-breadcrumb-tag span { color: var(--color-primary); }

    @media (max-width: 767px) {
        .site-breadcrumb {
            padding: 18px 0 16px;
            gap: 12px;
        }

        .site-breadcrumb-title {
            font-size: 20px;
            flex: 1 1 100%;
        }

        .site-breadcrumb-tag {
            flex: 1 1 100%;
            padding: 8px 14px;
            font-size: 12px;
            border-radius: 10px;
            justify-content: flex-start;
        }
    }
</style>
<div class="rts-breadcrumb-area breadcrumb-bg bg_image has-site-breadcrumb sd-breadcrumb-nav">
    <div class="container">
        <div class="site-breadcrumb">
            <h1 class="site-breadcrumb-title"><?php echo e($pageHeading); ?></h1>
            <div class="site-breadcrumb-tag">
                <a href='<?php echo site_url('index.php'); ?>'>Home</a>
                <span> / </span>
                <?php if ($__parent): ?>
                    <a href="<?php echo e($__parent['url']); ?>"><?php echo e($__parent['label']); ?></a>
                    <span> / </span>
                <?php endif; ?>
                <a class='active' href='#'><?php echo e($pageHeading); ?></a>
            </div>
        </div>
    </div>
</div>
