<?php
require_once __DIR__ . '/config/config.php';

$services = [];
$pageContent = ['heading' => 'Our Services', 'subheading' => '', 'body' => '', 'image' => ''];
if ($pdo = db()) {
    try {
        $services = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();

        $stmt = $pdo->prepare('SELECT * FROM page_content WHERE page_slug = :slug');
        $stmt->execute(['slug' => 'services']);
        $found = $stmt->fetch();
        if ($found) {
            $pageContent = $found;
        }
    } catch (Throwable $e) {
        $services = [];
    }
}

$pageTitle       = 'Our Services';
$metaDescription = 'Explore the business, tax, financial planning and audit services offered by get-accountant.';

require __DIR__ . '/includes/header.php';
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image"<?php echo !empty($pageContent['image']) ? " style=\"background-image:url('" . e($pageContent['image']) . "')\"" : ''; ?>>
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center">
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full breadcrumb-1">
                    <h1 class="title"><?php echo e($pageContent['heading'] ?: 'Our Services'); ?></h1>
                </div>
                <div class="xl:w-1/2 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="bread-tag">
                        <a href='index.php'>Home</a>
                        <span> / </span>
                        <a class='active' href='our-service.php'><?php echo e($pageContent['heading'] ?: 'Our Services'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <?php if (!empty($pageContent['subheading']) || !empty($pageContent['body'])): ?>
    <!-- editable intro area -->
    <div class="rts-about-area rts-section-gapTop">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px] text-center" style="max-width:800px;margin:0 auto;">
                    <?php if (!empty($pageContent['subheading'])): ?>
                        <span class="color-primary sub" style="text-transform:uppercase;font-weight:700;letter-spacing:.1em;"><?php echo e($pageContent['subheading']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($pageContent['body'])): ?>
                        <p class="disc mt--15"><?php echo e($pageContent['body']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end editable intro area -->
    <?php endif; ?>



    <!-- our service area start -->
    <div class="rts-service-area rts-section-gapTop pb--200 service-two-bg bg_image">
        <div class="container">
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] service padding-controler">
                <?php
                $__images = ['02', '03', '04'];
                $__i = 0;
                foreach ($services as $service):
                    $__thumbClass = $__i === 0 ? '' : ($__i === 1 ? 'two' : 'three');
                    $__img = $__images[$__i % count($__images)];
                    $__i++;
                ?>
                <!-- single service area -->
                <div class="xl:w-1/3 px-[15px] md:w-1/2 sm:w-full w-full pb--140 pb_md--100">
                    <div class="service-two-inner">
                        <a class='thumbnail <?php echo $__thumbClass; ?>' href='service-details.php?slug=<?php echo urlencode($service['slug']); ?>'><img src="<?php echo e($service['image'] ?: 'assets/images/service/' . $__img . '.jpg'); ?>" alt="<?php echo e($service['title']); ?>"></a>
                        <div class="body-content">
                            <div class="hidden-area">
                                <h3 class="title"><?php echo e($service['title']); ?></h3>
                                <p class="dsic">
                                    <?php echo e($service['short_description']); ?>
                                </p>
                                <a class='rts-read-more-two color-primary' href='service-details.php?slug=<?php echo urlencode($service['slug']); ?>'>Read More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single service area end-->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- our service area end -->

    <!-- service accordion area -->
    <div class="rts-accordion-area service rts-section-gap">
        <div class="accordion-service-bg bg_image ptb--120 ptb_md--80 ptb_sm--60">
            <div class="container">
                <div class="flex flex-wrap -mx-[15px]">
                    <div class="xl:w-1/2 px-[15px]">
                        <div class="accordion-service-inner">
                            <div class="title-area-start">
                                <span class="sub color-primary">STANDARDIZED WORKFLOWS</span>
                                <h2 class="title">How get-accountant Delivers Every Service</h2>
                            </div>
                            <div class="accordion-area">
                                <div class="accordion" id="accordionService">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                01. Cloud Integration &amp; Scope Alignment
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionService">
                                            <div class="accordion-body">
                                                We establish secure access to your Xero, MYOB or CCH iFirm ledger. We review chart of accounts and establish Standard Operating Procedures (SOPs).
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                02. Accurate Processing &amp; Reconciliation
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionService">
                                            <div class="accordion-body">
                                                Bank feeds, supplier invoices, payroll runs, and journal entries are reconciled daily or weekly following New Zealand tax legislation.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                03. Multi-Tier Senior Accountant Review
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionService">
                                            <div class="accordion-body">
                                                Before any report or IRD filing is released, a senior chartered accountant performs a comprehensive quality audit and verification checklist.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                04. Timely Filing &amp; Strategic Advisory
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionService">
                                            <div class="accordion-body">
                                                On-time GST, PAYE, and income tax lodgement with Inland Revenue, accompanied by management dashboards and proactive cashflow recommendations.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service accordion area End -->

    <!-- start pricing area -->
    <div class="rts-pricing-area rts-section-gapBottom">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px]">
                <div class="w-full px-[15px]">
                    <div class="rts-title-area pricing-planes text-center">
                        <p class="pre-title">
                            Transparent Plans
                        </p>
                        <h2 class="title">New Zealand SME Bookkeeping Pricing</h2>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-[24px] [&>*]:!px-[24px] mt--50">
                <!-- single pricing plan -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full">
                    <div class="pricing-wrapper-one">
                        <div class="plane-process">
                            <span>/month + GST</span>
                            <h3 class="title h5">$199</h3>
                        </div>
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Sole Traders &amp; Micro</span>
                            <h3 class="title h5">Starter Bookkeeping</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Monthly Bank Reconciliation (up to 75 txns)</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Bi-Monthly GST Return Preparation</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Xero / MYOB Cloud Setup Review</span></div>
                            <div class="single-pricing"><div class="icon"><i class="far fa-times"></i></div><span class="price-details">Payday Filing &amp; Payroll</span></div>
                            <div class="single-pricing"><div class="icon"><i class="far fa-times"></i></div><span class="price-details">Cash Flow Forecast Reports</span></div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting/contact.php"); ?>'>Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- single pricing plan -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full mt_sm--80">
                    <div class="pricing-wrapper-one" style="border: 2px solid #e53935; position: relative;">
                        <span style="position: absolute; top: -14px; right: 20px; background: #e53935; color: #fff; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 12px; text-transform: uppercase;">Most Popular</span>
                        <div class="plane-process">
                            <span>/month + GST</span>
                            <h3 class="title h5">$399</h3>
                        </div>
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Growing NZ Businesses</span>
                            <h3 class="title h5">Growth Package</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Weekly Bank Reconciliation (up to 200 txns)</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">GST &amp; Provisional Tax Review</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Payroll &amp; Payday Filing (up to 5 staff)</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Quarterly Management Reports</span></div>
                            <div class="single-pricing"><div class="icon"><i class="far fa-times"></i></div><span class="price-details">Custom KPI Dashboard</span></div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting/contact.php"); ?>'>Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- single pricing plan -->
                <div class="xl:w-1/3 px-[15px] lg:w-1/2 md:w-1/2 sm:w-full w-full mt_md--80 mt_sm--80">
                    <div class="pricing-wrapper-one">
                        <div class="plane-process">
                            <span>/month + GST</span>
                            <h3 class="title h5">$699</h3>
                        </div>
                        <div class="pricing-header-start">
                            <span class="pre-title h5">Established Companies</span>
                            <h3 class="title h5">Comprehensive</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Daily Bank Feed Processing (unlimited)</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Full GST &amp; IRD Lodgement</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Payroll &amp; KiwiSaver (up to 15 staff)</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Monthly Management P&amp;L &amp; Balance Sheet</span></div>
                            <div class="single-pricing available"><div class="icon"><i class="far fa-check"></i></div><span class="price-details">Dedicated Senior Accountant</span></div>
                            <a class='rts-btn btn-primary' href='<?php echo site_url("nz/accounting/contact.php"); ?>'>Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt--50">
                <p style="color:#64748b; font-size:15px;">Are you an Accounting Practice looking for wholesale offshore capacity? <a href="<?php echo site_url('nz/accounting-firm/contact.php'); ?>" style="color:#e53935; font-weight:700; text-decoration:underline;">Request Custom Practice Scoping &rarr;</a></p>
            </div>
        </div>
    </div>
    <!-- end pricing area -->

<?php require __DIR__ . '/includes/footer.php'; ?>
