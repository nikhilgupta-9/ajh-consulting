-- =====================================================
--  get-accountant - Migration 011: Service starting price
--
--  Adds an optional "starting from" price shown on the
--  service detail page pricing block.
-- =====================================================

SET NAMES utf8mb4;

ALTER TABLE services
    ADD COLUMN IF NOT EXISTS starting_price VARCHAR(50) DEFAULT NULL AFTER icon;
