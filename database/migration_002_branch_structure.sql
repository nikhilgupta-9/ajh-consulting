-- =====================================================
--  get-accountant - Migration 002: NZ Branch Structure
--
--  Adds support for the two New Zealand audience branches
--  agreed in the approved website structure:
--    - bookkeeping        (Accounting & Bookkeeping)
--    - firm_outsourcing   (Accounting Firm Outsourcing)
--
--  Run after schema.sql on an existing database:
--    mysql -u root -p get_accountant_nz < database/migration_002_branch_structure.sql
-- =====================================================

SET NAMES utf8mb4;

-- ---------------------------------------------------
-- Add branch to services (existing services default to
-- 'bookkeeping' so nothing breaks on the live site).
-- ---------------------------------------------------
-- NOTE: run this only once. If you re-run it and the column
-- already exists, MySQL/MariaDB will show a duplicate-column
-- error for this line only — safe to ignore and continue.
ALTER TABLE services
    ADD COLUMN branch ENUM('bookkeeping','firm_outsourcing') NOT NULL DEFAULT 'bookkeeping' AFTER slug;

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

-- ---------------------------------------------------
-- Sample seed data (safe to remove/edit from admin panel)
-- ---------------------------------------------------
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
