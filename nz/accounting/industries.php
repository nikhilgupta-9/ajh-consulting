<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle       = 'Industries We Support in New Zealand';
$metaDescription = 'Specialized accounting and bookkeeping support for trades, retail, hospitality, professional services, healthcare and agriculture across New Zealand.';
$pageHeading     = 'Industries We Support';
$breadcrumbParent = ['label' => 'Accounting & Bookkeeping', 'url' => 'index.php'];

require __DIR__ . '/../../includes/header.php';
require __DIR__ . '/../../includes/breadcrumb.php';
require __DIR__ . '/../../includes/bookkeeping-subnav.php';

$industries = [
    [
        'title'       => 'Trades & Construction',
        'subtitle'    => 'Builders, Electricians, Plumbers & Civil Contractors',
        'icon'        => 'fa-hard-hat',
        'image'       => 'assets/images/service/07.jpg',
        'description' => 'Managing cash flow, subcontractor tax deductions, retentions, and material costs can make or break a trade business. We connect directly to Tradify, Fergus, or SimPRO to ensure job profitability is tracked in real time.',
        'points'      => [
            'Subcontractor schedular tax (WT) deduction & IRD filing',
            'Progress claims, retentions and supplier bill reconciliation',
            'Seamless integration with Tradify, Fergus and Xero Projects',
            'Proactive cash flow management for seasonal building cycles',
        ],
    ],
    [
        'title'       => 'Retail & E-commerce',
        'subtitle'    => 'Brick-and-Mortar Stores, Shopify & Multi-Channel Sellers',
        'icon'        => 'fa-shopping-cart',
        'image'       => 'assets/images/service/08.jpg',
        'description' => 'High transaction volumes, merchant gateway fees (Stripe, Afterpay, Windcave), and inventory movements require automated bookkeeping. We synchronize your point-of-sale directly into Xero for effortless daily reconciliation.',
        'points'      => [
            'Automated Shopify, WooCommerce and Vend/Lightspeed POS feeds',
            'Reconciliation of merchant fees, Buy-Now-Pay-Later (Afterpay/Laybuy)',
            'Inventory asset valuation and cost of goods sold (COGS) tracking',
            'Multi-currency GST adjustments for overseas imports and exports',
        ],
    ],
    [
        'title'       => 'Hospitality & Food Services',
        'subtitle'    => 'Cafes, Restaurants, Bars & Caterers',
        'icon'        => 'fa-utensils',
        'image'       => 'assets/images/service/09.jpg',
        'description' => 'Hospitality margins are tight and staff turnover is high. We keep food and beverage operators profitable with accurate wage percentage monitoring, compliant holiday pay tracking, and weekly supplier bill runs.',
        'points'      => [
            'Rostered shift payroll compliance under the NZ Holidays Act',
            'Food and beverage gross margin benchmarking and tracking',
            'Daily till and EFTPOS settlements matched automatically',
            'Supplier statement reconciliations to prevent double payments',
        ],
    ],
    [
        'title'       => 'Professional Services & Consultancies',
        'subtitle'    => 'Marketing Agencies, IT Firms, Legal & Engineering Consultants',
        'icon'        => 'fa-briefcase',
        'image'       => 'assets/images/service/10.jpg',
        'description' => 'Service businesses succeed when billable hours translate into collected cash. We streamline your retainer invoices, track work-in-progress (WIP), and minimize debtor days so your bank account stays healthy.',
        'points'      => [
            'Automated monthly recurring retainer and milestone billing',
            'Work-in-progress (WIP) and project profitability reporting',
            'Debtor aging tracking and automated invoice payment reminders',
            'Cash runway forecasting and tax optimization strategies',
        ],
    ],
    [
        'title'       => 'Healthcare & Medical Practices',
        'subtitle'    => 'Dental Clinics, Physiotherapists, GPs & Wellness Specialists',
        'icon'        => 'fa-user-md',
        'image'       => 'assets/images/service/11.jpg',
        'description' => 'Clinicians should focus on patient outcomes, not bookkeeping administration. We reconcile practice management receipts (Exact, Medtech, Cliniko) and manage practitioner expense splitting with utmost discretion.',
        'points'      => [
            'Integration with practice management systems (Cliniko, Medtech)',
            'ACC payment reconciliations and patient copay tracking',
            'Compliant practitioner fee splits and contractor tax deductions',
            'Strict adherence to New Zealand Health Information Privacy rules',
        ],
    ],
    [
        'title'       => 'Transport, Logistics & Freight',
        'subtitle'    => 'Trucking Fleets, Couriers & Distribution Companies',
        'icon'        => 'fa-truck',
        'image'       => 'assets/images/service/12.jpg',
        'description' => 'High fuel costs, road user charges (RUC), and heavy equipment financing demand rigorous bookkeeping discipline. We keep your transport fleet running smoothly and tax-efficiently.',
        'points'      => [
            'Fuel tax refund credits and road user charge (RUC) accounting',
            'Vehicle asset financing schedules and depreciation registers',
            'Driver payroll, allowance tracking and KiwiSaver compliance',
            'Monthly operating cost per kilometer analytics',
        ],
    ],
];
?>

    <div class="rts-service-area rts-section-gap" style="padding: 70px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] justify-center text-center mb--50">
                <div class="w-full px-[15px]" style="max-width: 800px;">
                    <span class="color-primary sub" style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">Specialized Accounting</span>
                    <h2 class="title" style="font-size: 36px; margin: 10px 0 15px;">Tailored to Your Sector’s Unique Dynamics</h2>
                    <p class="disc" style="color: #64748b; font-size: 16px;">
                        Every New Zealand industry has its own tax rules, compliance frameworks, and operational software. Here is how get-accountant provides specialized value to your sector.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-[15px]">
                <?php foreach ($industries as $ind): ?>
                <div class="xl:w-1/2 lg:w-1/2 px-[15px] pb--40">
                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                        <div style="padding: 32px 30px; flex-grow: 1;">
                            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                                <div style="width: 54px; height: 54px; border-radius: 12px; background: #fef2f2; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    <i class="fas <?php echo $ind['icon']; ?>"></i>
                                </div>
                                <div>
                                    <h3 class="title h4" style="margin: 0; font-size: 22px; color: #0f172a;"><?php echo e($ind['title']); ?></h3>
                                    <span style="font-size: 13px; color: #64748b; font-weight: 500;"><?php echo e($ind['subtitle']); ?></span>
                                </div>
                            </div>
                            <p style="color: #475569; font-size: 15px; line-height: 1.6; margin-bottom: 20px;">
                                <?php echo e($ind['description']); ?>
                            </p>
                            <h5 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Key Services Provided:</h5>
                            <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 8px;">
                                <?php foreach ($ind['points'] as $p): ?>
                                <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #334155;">
                                    <i class="fas fa-check-circle" style="color: #22c55e; margin-top: 3px;"></i>
                                    <span><?php echo e($p); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 30px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 13px; color: #64748b; font-weight: 600;">Customized Chart of Accounts</span>
                            <a class="rts-read-more color-primary" href="contact.php" style="font-weight: 700; font-size: 14px;">Inquire for Your Sector <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="rts-cta-area" style="background: linear-gradient(135deg, #0b1220 0%, #1e293b 100%); color: #fff; padding: 75px 0;">
        <div class="container">
            <div class="flex flex-wrap -mx-[15px] items-center justify-between">
                <div class="xl:w-8/12 lg:w-8/12 px-[15px]">
                    <h2 class="title" style="color: #fff; font-size: 32px; margin: 0 0 10px;">Don’t See Your Specific Industry Listed?</h2>
                    <p class="disc" style="color: #cbd5e1; font-size: 16px; margin: 0;">We support many other Kiwi business categories. Contact us to discuss your operational workflow.</p>
                </div>
                <div class="xl:w-4/12 lg:w-4/12 px-[15px] text-right mt_md--30 mt_sm--30">
                    <a class="rts-btn btn-primary" href="contact.php" style="padding: 16px 36px; font-weight: 700;">Discuss Your Requirements <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
