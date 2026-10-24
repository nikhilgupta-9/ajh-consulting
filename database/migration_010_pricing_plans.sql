-- =====================================================
--  get-accountant - Migration 010: Pricing Plans
--
--  Admin-editable pricing packages shown on the public
--  Pricing page (nz/accounting/pricing.php).
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_010_pricing_plans.sql
-- =====================================================

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS pricing_plans (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(150)        NOT NULL,
    subtitle      VARCHAR(255)                 DEFAULT NULL,
    price         VARCHAR(30)         NOT NULL,
    period        VARCHAR(60)                  DEFAULT '/month + GST',
    badge         VARCHAR(60)                  DEFAULT NULL,
    is_featured   TINYINT(1)          NOT NULL DEFAULT 0,
    features      TEXT                         DEFAULT NULL COMMENT 'One feature per line',
    not_included  TEXT                         DEFAULT NULL COMMENT 'One excluded feature per line',
    sort_order    INT                 NOT NULL DEFAULT 0,
    status        ENUM('draft','published') NOT NULL DEFAULT 'published',
    created_at    DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO pricing_plans (name, subtitle, price, period, badge, is_featured, features, not_included, sort_order, status) VALUES
('Starter / Sole Trader', 'For contractors, freelancers and early-stage ventures.', '199', '/month + GST', NULL, 0,
 'Up to 75 bank transactions / month
1 Bank account & 1 credit card reconciled
Bi-monthly or 6-monthly GST return filing
Dext / Hubdoc receipt capture setup
Dedicated bookkeeper contact
Email support within 24 business hours',
 'Payroll & payday filing
Monthly cash flow forecasting
Annual financial statements',
 1, 'published'),
('Growth Business', 'Our most popular plan for active small and medium businesses.', '399', '/month + GST', 'Most Popular', 1,
 'Up to 250 bank transactions / month
Up to 3 bank accounts & credit cards
Bi-monthly GST returns prepared & filed
Payroll processing for up to 5 staff
Automated payday filing with IRD
Dext automated receipt & invoice ingestion
Monthly Profit & Loss and Balance Sheet pack
Direct phone & email support',
 '12-month rolling cash flow forecasting
Annual company income tax return (IR4)',
 2, 'published'),
('Comprehensive Enterprise', 'Full-service virtual finance team with annual tax included.', '699', '/month + GST', NULL, 0,
 'Up to 600 bank transactions / month
Unlimited bank accounts & currencies
Bi-monthly GST returns & audit trail
Payroll processing for up to 15 staff
Payday filing, KiwiSaver & leave management
Monthly cash flow runway forecasting
Annual Financial Statements & Notes
Company Income Tax Return (IR4) filed
Quarterly virtual advisory strategy session',
 NULL,
 3, 'published');
