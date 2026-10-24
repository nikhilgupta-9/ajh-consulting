-- =====================================================
--  get-accountant - Migration 009: Events
--
--  Admin-editable events (webinars, workshops, firm
--  partner sessions) shown on the public Events page.
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_009_events.sql
-- =====================================================

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS events (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(190)        NOT NULL,
    slug            VARCHAR(190)        NOT NULL UNIQUE,
    summary         VARCHAR(400)                 DEFAULT NULL,
    description     LONGTEXT                     DEFAULT NULL,
    image           VARCHAR(255)                 DEFAULT NULL,
    video_url       VARCHAR(255)                 DEFAULT NULL,
    event_date      DATE                NOT NULL,
    event_time      VARCHAR(100)                 DEFAULT NULL,
    location        VARCHAR(190)                 DEFAULT NULL,
    registration_url VARCHAR(255)                DEFAULT NULL,
    status          ENUM('draft','published') NOT NULL DEFAULT 'published',
    created_at      DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
