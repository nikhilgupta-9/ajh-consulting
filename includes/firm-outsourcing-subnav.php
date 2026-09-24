<?php
$__foNav = [
    'index.php'         => 'Home',
    'services.php'      => 'Outsourcing Services',
    'how-we-work.php'   => 'How We Work with Firms',
    'technology.php'    => 'Technology & Systems',
    'why-partner.php'   => 'Why Partner with Us',
    'case-studies.php'  => 'Case Studies',
    'faqs.php'          => 'FAQs',
    'insights.php'      => 'Insights for Accounting Firms',
    'contact.php'       => 'Contact Us',
];
?>
<div class="branch-subnav">
    <div class="container">
        <div class="branch-subnav-scroll">
            <?php foreach ($__foNav as $__url => $__label): ?>
                <a href="<?php echo e($__url); ?>" class="branch-subnav-link<?php echo $currentPage === $__url ? ' active' : ''; ?>"><?php echo e($__label); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
