-- =====================================================
--  get-accountant - Migration 003: Bentleys-style
--  Firm Outsourcing service categories
--
--  Client shared https://www.bentleysauckland.com/outsourcing/
--  as a reference. This migration adds the same core
--  outsourcing service categories under the
--  'firm_outsourcing' branch. The two earlier generic
--  placeholder services (firm-outsourcing, white-label-
--  support) are left in place — delete them from the
--  admin panel (Services) if they're no longer needed.
--
--  Run after migration_002_branch_structure.sql:
--    mysql -u root -p get_accountant_nz < database/migration_003_bentleys_style_content.sql
-- =====================================================

SET NAMES utf8mb4;

INSERT INTO services (title, slug, branch, short_description, description, icon, sort_order) VALUES
('Accounts Payable Processing', 'accounts-payable-processing', 'firm_outsourcing',
 'Timely processing of supplier invoices, payment scheduling and reconciliation.',
 '<ul><li>Timely processing of supplier invoices</li><li>Payment scheduling and reconciliation</li><li>Supplier statement reconciliation and reporting</li></ul>',
 'flaticon-accounting', 1),
('Accounts Receivable Management', 'accounts-receivable-management', 'firm_outsourcing',
 'Customer invoicing, debtor follow-up and aged debt analysis.',
 '<ul><li>Customer invoicing and debtor follow-up</li><li>Aged debt analysis</li><li>Payment collection reporting</li></ul>',
 'flaticon-financial', 2),
('Payroll Outsourcing', 'payroll-outsourcing-firms', 'firm_outsourcing',
 'Full payroll processing including PAYE, KiwiSaver and leave management.',
 '<ul><li>Payroll processing</li><li>PAYE, KiwiSaver, leave management</li><li>Payroll reporting and IRD submissions</li></ul>',
 'flaticon-consulting', 3),
('GST Returns', 'gst-returns-firms', 'firm_outsourcing',
 'GST return preparation, bank reconciliations and IRD filing.',
 '<ul><li>Processing records to prepare GST returns</li><li>Bank reconciliations</li><li>Filing returns with IRD and advising of payments due</li></ul>',
 'flaticon-audit', 4),
('Monthly Accounting', 'monthly-accounting-firms', 'firm_outsourcing',
 'Monthly financial statements prepared end-to-end or reviewed on your behalf.',
 '<ul><li>Preparation of monthly financial statements</li><li>We can take over at any point, preparing from start to finish, or reviewing your internally prepared reports</li></ul>',
 'flaticon-accounting', 5)
ON DUPLICATE KEY UPDATE
    short_description = VALUES(short_description),
    description = VALUES(description);
