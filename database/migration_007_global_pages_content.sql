-- =====================================================
--  get-accountant - Migration 007: Global Pages Content
--
--  Seeds page_content rows for four admin-editable global
--  pages: About, How We Work, Our Peoples, Insight & Resources.
--  (Uses the same page_content table added in migration 004 —
--  no schema change here, just new rows.)
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_007_global_pages_content.sql
-- =====================================================

SET NAMES utf8mb4;

INSERT INTO page_content (page_slug, heading, subheading, body) VALUES
('about', 'Get Consulting For Better Business Growth', 'JUST A CONSULTANCY',
 'Dapibus curae risus rutrum curabitur nunc sociis nullam nisl, aliquet quis iaculis scelerisque primis massa imperdiet, dis senectus blandit aptent nulla cubilia sodales convallis tortor pellentesque nulla.'),
('how-we-work', 'How We Work', 'OUR PROCESS',
 'A simple, transparent process that keeps you informed at every step — from your first enquiry through to ongoing support. Edit this introduction from Admin > Page Content.'),
('our-peoples', 'Our Peoples', 'MEET THE TEAM',
 'The people behind get-accountant — experienced, approachable and committed to helping your business succeed. Edit this introduction from Admin > Page Content.'),
('insight-resources', 'Insight & Resources', 'LATEST THINKING',
 'Practical guides, updates and ideas to help you run your business or accounting firm more effectively. Edit this introduction from Admin > Page Content.')
ON DUPLICATE KEY UPDATE heading = VALUES(heading);
