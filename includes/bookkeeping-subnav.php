<?php
$__bkNav = [
    'accounting-bookkeeping.php'                  => 'Home',
    'accounting-bookkeeping-services.php'         => 'Services',
    'accounting-bookkeeping-industries.php'       => 'Industries We Support',
    'accounting-bookkeeping-why-us.php'           => 'Why Choose Us',
    'accounting-bookkeeping-how-it-works.php'     => 'How It Works',
    'accounting-bookkeeping-pricing.php'          => 'Pricing',
    'accounting-bookkeeping-faqs.php'             => 'FAQs',
    'accounting-bookkeeping-client-stories.php'   => 'Client Stories',
    'accounting-bookkeeping-insights.php'         => 'Insights & Resources',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__bkNav as $__url => $__label): ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $currentPage === $__url ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
            <a href="contactus.php" class="branch-subnav-link">Contact Us</a>
        </div>
    </div>
</div>
