<?php
$__bkNav = [
    'index.php'          => 'Home',
    'services.php'       => 'Services',
    'industries.php'     => 'Industries We Support',
    'why-us.php'         => 'Why Choose Us',
    'how-it-works.php'   => 'How It Works',
    'pricing.php'        => 'Pricing',
    'faqs.php'           => 'FAQs',
    'client-stories.php' => 'Client Stories',
    'insights.php'       => 'Insights & Resources',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__bkNav as $__url => $__label): ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $currentPage === $__url ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
            <a href="<?php echo site_url('contactus.php'); ?>" class="branch-subnav-link">Contact Us</a>
        </div>
    </div>
</div>
