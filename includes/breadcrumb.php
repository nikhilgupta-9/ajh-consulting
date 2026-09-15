<?php
/**
 * Usage: set $pageHeading and optionally $breadcrumbParent = ['label' => '...', 'url' => '...']
 * before requiring this file (after header.php).
 */
$__parent = $breadcrumbParent ?? null;
?>
<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
    <div class="container">
        <div class="flex flex-wrap -mx-[15px] items-center">
            <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                <h1 class="title"><?php echo e($pageHeading); ?></h1>
            </div>
            <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                <div class="bread-tag">
                    <a href='index.php'>Home</a>
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
</div>
