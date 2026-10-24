<?php
/**
 * Branch sub-navigation for Accounting & Bookkeeping pages.
 * Rendered directly under the breadcrumb.
 */
$__bkNav = [
    site_url('index.php') => 'Home',
    'services.php'        => 'Services',
    'industries.php'      => 'Industries We Support',
    'why-us.php'          => 'Why Choose Us',
    'faqs.php'            => 'FAQs',
    'insights.php'        => 'Insights & Resources',
    'contact.php'         => 'Contact Us',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__bkNav as $__url => $__label): ?>
                <?php
                $__isActive = ($currentPage === basename($__url) && $currentPage !== 'index.php') ||
                              ($__label === 'Home' && $currentPage === 'index.php');
                ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $__isActive ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
