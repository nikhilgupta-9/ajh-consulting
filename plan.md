# Project Implementation Plan: get-accountant

A modern, dual-track accounting and bookkeeping platform for **New Zealand** and **Australia**, combining the minimalist clarity of the `get-accountant` design system with the high-converting trust and enterprise credibility of **[Indian Muneem](https://indianmuneem.com/)**.

---

## 🏗️ Architecture & Dual-Track Model

The platform serves two distinct user personas with customized user journeys:

```
                              ┌────────────────────────────────────────┐
                              │  GET-ACCOUNTANT (Core Brand Engine)   │
                              └──────────────────┬─────────────────────┘
                                                 │
                   ┌─────────────────────────────┴─────────────────────────────┐
                   ▼                                                           ▼
    ┌───────────────────────────────┐                           ┌───────────────────────────────┐
    │     Track 1: FOR BUSINESSES   │                           │ Track 2: FOR ACCOUNTING FIRMS │
    │   (SMEs, Sole Traders, Cos.)  │                           │    (CA / CPA Practices)       │
    ├───────────────────────────────┤                           ├───────────────────────────────┤
    │ • Bookkeeping & Bank Recs     │                           │ • White-Label Bookkeeping     │
    │ • GST & Tax Filing (IRD)      │                           │ • Audit-Ready Workpapers      │
    │ • Annual Accounts & Tax       │                           │ • Tax Return Prep for Review  │
    │ • Payroll & Payday Filing     │                           │ • Payroll Processing Support  │
    │ • Catch-up Accounting Cleanup │                           │ • Catch-up Backlog Projects   │
    │ • Business & Cash Flow Reports│                           │ • Management Reporting Packs  │
    │ • Tax Advice & Planning       │                           │ • Director-Level Review       │
    └───────────────────────────────┘                           └───────────────────────────────┘
```

---

## 🚀 Execution Phases

### ✅ Phase 1: Standalone Gateway Landing Page & Cookie Engine
**Status**: Completed & Live (`landing.php`)

* [x] **Standalone Service Selection Landing Page (`landing.php`)**:
  * Clean mockup UI where new users choose country (NZ / AU) and select their needed service.
  * Direct clickable service pills for Businesses (*Bookkeeping, Tax & GST, Annual accounts, Payroll, Catch-up, Reporting, Tax Advice*).
  * Direct clickable workflow pills for Accounting Firms (*Bookkeeping, Year-end workpapers, Tax preparation, Payroll support, Catch-up projects, Management reporting*).
* [x] **Cookie Personalization Engine**:
  * 30-day persistent cookies: `ga_user_track`, `ga_user_country`, `ga_user_service`, and `ga_gate`.
  * Returning user welcome banner with 1-click continuation to their saved portal and preference switcher.
* [x] **Smart Service Redirection**:
  * Seamless redirection to specific service pages with contextual selection banners on both portals:
    * Businesses: `nz/accounting/services.php?service=...`
    * Firms: `nz/accounting-firm/services.php?service=...`
* [x] **Core Integrity**:
  * Main homepage (`index.php`) preserved and kept completely untouched.

---

### ⏳ Phase 2: Homepage Trust & Enterprise Sections (Indian Muneem Standard)
**Status**: Upcoming

* [ ] **Trust Metrics & Credibility Counter Bar**:
  * `99.8%` Statutory Accuracy
  * `24 Hours` Overnight Turnaround (Work prepared while partners sleep)
  * `100% Strict Mutual NDA` (Zero client poaching guarantee)
  * `Risk-Free` Pilot Engagement
* [ ] **Certified Practice Technology Ecosystem**:
  * Partner badges for Xero Certified Advisor, MYOB Practice, CCH iFirm, QuickBooks Online, and Dext Prepare.
* [ ] **"Why Choose Us" / In-House vs Scalable Capacity Comparison**:
  * Clear comparison matrix highlighting cost savings (40-50%), zero recruitment overhead, and CA ANZ quality standards.
* [ ] **Dynamic Database Integration**:
  * Render client reviews from `testimonials` table.
  * Render dynamic FAQs from `faqs` table.
  * Render recent business insights from `blog_posts` table.
* [ ] **High-Converting Lead & Consultation Form**:
  * Dropdown selector connected to the database `leads` table and `/admin/leads.php` inbox.

---

### ⏳ Phase 3: Service Portals Deepening & Workflows
**Status**: Upcoming

* [ ] **Business Portal (`nz/accounting/`)**:
  * Dedicated service cards for all 7 business services with transparent pricing guidance.
  * High-ticket "Catch-up Accounting" backlog cleanup audit request module.
* [ ] **Accounting Firm Portal (`nz/accounting-firm/`)**:
  * 6 white-label workflows with downloadable sample workpaper specifications.
  * "Useful Handover" checklist (Audit-ready files, indexed schedules, reviewer query sheet).
  * 1-Click "Start a Pilot Job" risk-free booking form.
* [ ] **Admin Panel Sync (`/admin`)**:
  * Full CRUD management for both `bookkeeping` and `firm_outsourcing` branches in `/admin/services.php`.

---

### ⏳ Phase 4: Mobile Responsiveness, Speed Optimization & Admin QA
**Status**: Upcoming

* [ ] Mobile navigation and touch target auditing across all viewports ($\le 375\text{px}$, $\le 768\text{px}$, $\le 1024\text{px}$).
* [ ] End-to-end form submission testing into database `leads` table.
* [ ] Admin panel review and operational sign-off.

---

*Last Updated: October 2026*
