<?php
/**
 * Branch sub-navigation for Accounting Firm Outsourcing pages.
 * Rendered directly under the breadcrumb.
 */
$__foNav = [
    site_url('index.php') => 'Home',
    'services.php'        => 'Outsourcing Services',
    'technology.php'      => 'Technology & Systems',
    'why-partner.php'     => 'Why Partner with Us',
    'faqs.php'            => 'FAQs',
    'insights.php'        => 'Insights for Accounting Firms',
    'contact.php'         => 'Contact Us',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__foNav as $__url => $__label): ?>
                <?php
                $__isActive = ($currentPage === basename($__url) && $currentPage !== 'index.php') ||
                              ($__label === 'Home' && $currentPage === 'index.php');
                ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $__isActive ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
