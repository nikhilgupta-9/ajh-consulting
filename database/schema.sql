-- =====================================================
--  get-accountant - Database Schema
--  Import this file in phpMyAdmin / mysql CLI after
--  creating a database (name must match DB_NAME in .env).
--
--  mysql -u root -p get_accountant_nz < database/schema.sql
--
--  Already have data in an older AJH-branded DB? Instead of
--  re-running this file, apply database/migration_002_branch_structure.sql
--  to add branch support without losing existing rows.
-- =====================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------
-- Admin users (admin panel login)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS admins (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(120)        NOT NULL,
    email         VARCHAR(190)        NOT NULL UNIQUE,
    password_hash VARCHAR(255)        NOT NULL,
    created_at    DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Leads: contact-us + appointment form submissions
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS leads (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type            ENUM('contact','appointment') NOT NULL DEFAULT 'contact',
    name            VARCHAR(120)        NOT NULL,
    email           VARCHAR(190)        NOT NULL,
    phone           VARCHAR(30)                  DEFAULT NULL,
    subject         VARCHAR(190)                 DEFAULT NULL,
    service         VARCHAR(120)                 DEFAULT NULL,
    preferred_date  DATE                         DEFAULT NULL,
    preferred_time  VARCHAR(30)                  DEFAULT NULL,
    message         TEXT                         DEFAULT NULL,
    status          ENUM('new','read','resolved') NOT NULL DEFAULT 'new',
    created_at      DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Blog posts
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS blog_posts (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(190)        NOT NULL,
    slug        VARCHAR(190)        NOT NULL UNIQUE,
    excerpt     VARCHAR(400)                 DEFAULT NULL,
    content     LONGTEXT            NOT NULL,
    image       VARCHAR(255)                 DEFAULT NULL,
    author      VARCHAR(120)                 DEFAULT 'get-accountant',
    status      ENUM('draft','published') NOT NULL DEFAULT 'published',
    created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Team members
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS team_members (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(120)        NOT NULL,
    designation VARCHAR(150)                 DEFAULT NULL,
    photo       VARCHAR(255)                 DEFAULT NULL,
    facebook    VARCHAR(255)                 DEFAULT NULL,
    twitter     VARCHAR(255)                 DEFAULT NULL,
    linkedin    VARCHAR(255)                 DEFAULT NULL,
    instagram   VARCHAR(255)                 DEFAULT NULL,
    sort_order  INT                 NOT NULL DEFAULT 0,
    created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Services
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS services (
    id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title             VARCHAR(190)        NOT NULL,
    slug              VARCHAR(190)        NOT NULL UNIQUE,
    branch            ENUM('bookkeeping','firm_outsourcing') NOT NULL DEFAULT 'bookkeeping',
    short_description VARCHAR(400)                 DEFAULT NULL,
    description       LONGTEXT                     DEFAULT NULL,
    icon              VARCHAR(120)                 DEFAULT NULL,
    image             VARCHAR(255)                 DEFAULT NULL,
    sort_order        INT                 NOT NULL DEFAULT 0,
    created_at        DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- FAQs (per branch)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS faqs (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    branch      ENUM('bookkeeping','firm_outsourcing') NOT NULL DEFAULT 'bookkeeping',
    question    VARCHAR(255)        NOT NULL,
    answer      TEXT                NOT NULL,
    sort_order  INT                 NOT NULL DEFAULT 0,
    created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Testimonials (per branch)
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS testimonials (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    branch        ENUM('bookkeeping','firm_outsourcing') NOT NULL DEFAULT 'bookkeeping',
    client_name   VARCHAR(120)        NOT NULL,
    client_role   VARCHAR(150)                 DEFAULT NULL,
    photo         VARCHAR(255)                 DEFAULT NULL,
    quote         TEXT                NOT NULL,
    rating        TINYINT UNSIGNED    NOT NULL DEFAULT 5,
    sort_order    INT                 NOT NULL DEFAULT 0,
    created_at    DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------
-- Sample seed data (safe to remove/edit from admin panel)
-- ---------------------------------------------------
INSERT INTO services (title, slug, branch, short_description, description, icon, sort_order) VALUES
('Bookkeeping', 'bookkeeping', 'bookkeeping', 'Accurate day-to-day bookkeeping for New Zealand small businesses.', NULL, 'flaticon-accounting', 1),
('Tax Returns', 'tax-returns', 'bookkeeping', 'Individual and business tax returns prepared and filed on time.', NULL, 'flaticon-financial', 2),
('Payroll', 'payroll', 'bookkeeping', 'End-to-end payroll processing so your team gets paid accurately.', NULL, 'flaticon-consulting', 3),
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
ON DUPLICATE KEY UPDATE title = VALUES(title);

INSERT INTO faqs (branch, question, answer, sort_order) VALUES
('bookkeeping', 'Which industries do you support in New Zealand?', 'We work with a wide range of small and medium businesses across New Zealand, including retail, hospitality, trades and professional services.', 1),
('bookkeeping', 'How quickly can you take over our bookkeeping?', 'Most clients are fully onboarded within 1-2 weeks, depending on the size of your books and how quickly records are shared with us.', 2),
('firm_outsourcing', 'How does outsourcing work with our accounting firm?', 'We become an extension of your team, handling bookkeeping and compliance workflows under your firm''s branding and processes.', 1),
('firm_outsourcing', 'Is our clients'' data kept confidential?', 'Yes. All client data is handled under strict confidentiality agreements and secure systems built for accounting firm partnerships.', 2)
ON DUPLICATE KEY UPDATE question = VALUES(question);

INSERT INTO testimonials (branch, client_name, client_role, quote, rating, sort_order) VALUES
('bookkeeping', 'Sarah Mitchell', 'Small Business Owner, Auckland', 'They took bookkeeping completely off my plate. I finally have time to focus on running my business.', 5, 1),
('firm_outsourcing', 'David Chen', 'Partner, Chen & Associates', 'A reliable outsourcing partner that understands how accounting firms work. Highly recommended.', 5, 1)
ON DUPLICATE KEY UPDATE quote = VALUES(quote);

INSERT INTO team_members (name, designation, sort_order) VALUES
('Robert Fox', 'Founder & CEO', 1),
('Jane Cooper', 'Senior Consultant', 2),
('Wade Warren', 'Financial Advisor', 3),
('Esther Howard', 'Tax Specialist', 4)
ON DUPLICATE KEY UPDATE designation = VALUES(designation);

INSERT INTO blog_posts (title, slug, excerpt, content, author, status) VALUES
('Best Business Ideas For Getting Solution', 'best-business-ideas-for-getting-solution',
 'A quick look at practical, high-impact ideas that help growing businesses solve common problems.',
 '<p>A quick look at practical, high-impact ideas that help growing businesses solve common problems. Replace this placeholder text from the admin panel.</p>',
 'get-accountant', 'published'),
('How To Plan Your Company Finances', 'how-to-plan-your-company-finances',
 'A short guide on building a realistic, sustainable financial plan for your company.',
 '<p>A short guide on building a realistic, sustainable financial plan for your company. Replace this placeholder text from the admin panel.</p>',
 'get-accountant', 'published')
ON DUPLICATE KEY UPDATE title = VALUES(title);

-- ---------------------------------------------------
-- Page Content (CMS-lite) — admin-editable hero content
-- for pages like Services, keyed by page_slug.
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS page_content (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    page_slug   VARCHAR(100)        NOT NULL UNIQUE,
    heading     VARCHAR(190)                 DEFAULT NULL,
    subheading  VARCHAR(255)                 DEFAULT NULL,
    body        TEXT                         DEFAULT NULL,
    image       VARCHAR(255)                 DEFAULT NULL,
    updated_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO page_content (page_slug, heading, subheading, body) VALUES
('services', 'Our Services', 'What We Offer', 'Explore the accounting, bookkeeping and outsourcing services we offer across New Zealand.')
ON DUPLICATE KEY UPDATE heading = VALUES(heading);
