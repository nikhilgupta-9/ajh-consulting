<?php
$__foNav = [
    'accounting-firm-outsourcing.php'                => 'Home',
    'accounting-firm-outsourcing-services.php'       => 'Outsourcing Services',
    'accounting-firm-outsourcing-how-we-work.php'    => 'How We Work with Firms',
    'accounting-firm-outsourcing-technology.php'     => 'Technology & Systems',
    'accounting-firm-outsourcing-why-partner.php'    => 'Why Partner with Us',
    'accounting-firm-outsourcing-case-studies.php'   => 'Case Studies',
    'accounting-firm-outsourcing-faqs.php'           => 'FAQs',
    'accounting-firm-outsourcing-insights.php'       => 'Insights for Accounting Firms',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__foNav as $__url => $__label): ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $currentPage === $__url ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
            <a href="contactus.php" class="branch-subnav-link">Contact Us</a>
        </div>
    </div>
</div>
