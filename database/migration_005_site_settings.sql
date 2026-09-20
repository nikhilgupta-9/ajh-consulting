-- =====================================================
--  get-accountant - Migration 005: Site Settings
--
--  A single-row table holding all the site-wide contact /
--  business details (company name, email, phone, WhatsApp,
--  address, social links, Google Map embed, copyright text)
--  so they can be edited from the admin panel instead of
--  being hardcoded in the PHP templates.
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_005_site_settings.sql
-- =====================================================

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS site_settings (
    id              TINYINT UNSIGNED PRIMARY KEY DEFAULT 1,
    company_name    VARCHAR(190)        DEFAULT NULL,
    tagline         VARCHAR(255)        DEFAULT NULL,
    email           VARCHAR(190)        DEFAULT NULL,
    phone           VARCHAR(30)         DEFAULT NULL,
    whatsapp_number VARCHAR(30)         DEFAULT NULL,
    address         VARCHAR(500)        DEFAULT NULL,
    working_hours   VARCHAR(255)        DEFAULT NULL,
    map_embed_url   VARCHAR(1000)       DEFAULT NULL,
    facebook_url    VARCHAR(255)        DEFAULT NULL,
    twitter_url     VARCHAR(255)        DEFAULT NULL,
    instagram_url   VARCHAR(255)        DEFAULT NULL,
    linkedin_url    VARCHAR(255)        DEFAULT NULL,
    youtube_url     VARCHAR(255)        DEFAULT NULL,
    whatsapp_url    VARCHAR(255)        DEFAULT NULL,
    copyright_text  VARCHAR(255)        DEFAULT NULL,
    updated_at      DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_site_settings_single_row CHECK (id = 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO site_settings (
    id, company_name, tagline, email, phone, whatsapp_number, address, working_hours,
    map_embed_url, facebook_url, twitter_url, instagram_url, linkedin_url, copyright_text
) VALUES (
    1, 'get-accountant', 'Accounting, bookkeeping and outsourcing services for New Zealand and Australia.',
    'info@ajhconsulting.com', '+91 98765 43210', '',
    '123 Business Avenue, New Delhi, India', 'Mon - Fri: 9:00am - 6:00pm',
    '', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.linkedin.com/',
    'get-accountant. All rights reserved.'
)
ON DUPLICATE KEY UPDATE company_name = company_name;
