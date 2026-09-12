-- =====================================================
--  AJH Consulting - Database Schema
--  Import this file in phpMyAdmin / mysql CLI after
--  creating a database (name must match DB_NAME in .env).
--
--  mysql -u root -p ajh_consulting < database/schema.sql
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
    author      VARCHAR(120)                 DEFAULT 'AJH Consulting',
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
    short_description VARCHAR(400)                 DEFAULT NULL,
    description       LONGTEXT                     DEFAULT NULL,
    icon              VARCHAR(120)                 DEFAULT NULL,
    image             VARCHAR(255)                 DEFAULT NULL,
    sort_order        INT                 NOT NULL DEFAULT 0,
    created_at        DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------
-- Sample seed data (safe to remove/edit from admin panel)
-- ---------------------------------------------------
INSERT INTO services (title, slug, short_description, icon, sort_order) VALUES
('Business Consulting', 'business-consulting', 'Strategic advice to help your business grow and scale efficiently.', 'flaticon-consulting', 1),
('Tax & Accounting', 'tax-accounting', 'Accurate bookkeeping, tax planning and compliance for every business size.', 'flaticon-accounting', 2),
('Financial Planning', 'financial-planning', 'Long-term financial strategy tailored to your goals.', 'flaticon-financial', 3),
('Audit & Assurance', 'audit-assurance', 'Independent audits that build trust with stakeholders and investors.', 'flaticon-audit', 4)
ON DUPLICATE KEY UPDATE title = VALUES(title);

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
 'AJH Consulting', 'published'),
('How To Plan Your Company Finances', 'how-to-plan-your-company-finances',
 'A short guide on building a realistic, sustainable financial plan for your company.',
 '<p>A short guide on building a realistic, sustainable financial plan for your company. Replace this placeholder text from the admin panel.</p>',
 'AJH Consulting', 'published')
ON DUPLICATE KEY UPDATE title = VALUES(title);
