-- =====================================================
--  get-accountant - Migration 004: Page Content (CMS-lite)
--
--  Generic table so page-level hero content (heading,
--  intro text, banner image) can be edited from the admin
--  panel instead of being hardcoded in the PHP template.
--  One row per page, keyed by page_slug.
--
--  Run:
--    mysql -u root -p get_accountant_nz < database/migration_004_page_content.sql
-- =====================================================

SET NAMES utf8mb4;

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
