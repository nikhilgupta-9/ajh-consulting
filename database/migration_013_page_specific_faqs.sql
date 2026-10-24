-- Migration 013: Add page, service_id, category, and is_active to faqs table
-- Enables per-page, per-service custom FAQ management from the admin panel.

ALTER TABLE faqs
  ADD COLUMN IF NOT EXISTS service_id INT(10) UNSIGNED NULL DEFAULT NULL AFTER branch,
  ADD COLUMN IF NOT EXISTS page VARCHAR(50) NOT NULL DEFAULT 'all' AFTER service_id,
  ADD COLUMN IF NOT EXISTS category VARCHAR(100) NOT NULL DEFAULT 'General' AFTER page,
  ADD COLUMN IF NOT EXISTS is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER sort_order;

CREATE INDEX IF NOT EXISTS idx_faqs_branch_page ON faqs (branch, page);
CREATE INDEX IF NOT EXISTS idx_faqs_service ON faqs (service_id);
