-- =====================================================
--  get-accountant - Migration 006: Legal Pages
--
--  Admin-editable long-form pages (Privacy Policy, Terms
--  of Use) shown publicly and linked from the footer.
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_006_legal_pages.sql
-- =====================================================

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS legal_pages (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug        VARCHAR(100)        NOT NULL UNIQUE,
    title       VARCHAR(190)        NOT NULL,
    content     LONGTEXT                     DEFAULT NULL,
    updated_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO legal_pages (slug, title, content) VALUES
('privacy-policy', 'Privacy Policy',
 '<p>This Privacy Policy explains how we collect, use and protect your personal information when you use our website and services. Replace this placeholder text from the admin panel (Legal Pages).</p>
<h3>Information We Collect</h3>
<p>We may collect your name, email address, phone number and any details you submit through our contact or appointment forms.</p>
<h3>How We Use Your Information</h3>
<p>We use the information you provide to respond to enquiries, provide our services and improve our website.</p>
<h3>Contact Us</h3>
<p>If you have any questions about this Privacy Policy, please contact us using the details on our Contact page.</p>'),
('terms-of-use', 'Terms of Use',
 '<p>These Terms of Use govern your access to and use of this website. Replace this placeholder text from the admin panel (Legal Pages).</p>
<h3>Use of Website</h3>
<p>By accessing this website, you agree to use it only for lawful purposes and in a manner that does not infringe the rights of others.</p>
<h3>Intellectual Property</h3>
<p>All content on this website, including text, graphics and logos, is the property of the company unless otherwise stated.</p>
<h3>Limitation of Liability</h3>
<p>We make reasonable efforts to keep information on this website accurate but do not guarantee completeness or accuracy.</p>')
ON DUPLICATE KEY UPDATE title = VALUES(title);
