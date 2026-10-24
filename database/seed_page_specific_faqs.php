<?php
/**
 * Seed comprehensive, page-specific and service-specific FAQs into `faqs` table.
 * All entries are admin-controllable and tailored to the exact demands of each page.
 */
require_once __DIR__ . '/../config/config.php';

$pdo = db();
if (!$pdo) {
    die("Database connection failed.\n");
}

// Clear current FAQs to ensure clean, accurate seeding
$pdo->exec("DELETE FROM faqs");

$faqs = [
    // =========================================================================
    // 1. HOMEPAGE FAQs (branch: bookkeeping, page: home)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'General Inquiries',
        'question'   => 'How quickly can get-accountant take over our company bookkeeping?',
        'answer'     => 'Most Kiwi and Aussie businesses are fully onboarded within 3 to 5 business days. Once you invite our certified team as an advisor to your Xero or MYOB account, we verify bank feeds, set up automated receipt rules, and begin daily reconciliations immediately.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'Software & Integration',
        'question'   => 'Do we need to migrate away from our current accounting software?',
        'answer'     => 'No. We work directly inside your existing cloud accounting software (Xero, MYOB, QuickBooks, or Zoho Books). You retain 100% ownership and administrative control of your subscription; we simply operate as your dedicated advisory team.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'Pricing & Terms',
        'question'   => 'Are your bookkeeping fees transparent or billed by the hour?',
        'answer'     => 'We operate on transparent, agreed fixed monthly plans based on your transaction volume and payroll size. You will never receive surprise invoices for phone calls, quick queries, or routine compliance reconciliations.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'Statutory Compliance',
        'question'   => 'How do you guarantee on-time IRD & ATO statutory tax compliance?',
        'answer'     => 'Every GST return, PAYE payday filing, and annual statutory report is scheduled on our central compliance calendar. All returns undergo a double-review protocol by qualified senior accountants before submission, maintaining our 99.8% on-time filing track record.',
        'sort_order' => 4,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'Historical Backlog',
        'question'   => 'Can you help if our books and GST filings are months behind schedule?',
        'answer'     => 'Yes. Our specialized catch-up accounting squad reconstructs disordered ledgers, reconciles backlogged bank feeds, and files overdue GST returns with Inland Revenue, halting penalty accruals and restoring financial order.',
        'sort_order' => 5,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => null,
        'page'       => 'home',
        'category'   => 'Security & Privacy',
        'question'   => 'How is our confidential company financial data safeguarded?',
        'answer'     => 'We enforce strict ISO 27001:2022 security controls, SOC 2 Type II certified infrastructure, multi-factor authentication, and operate under bilateral NDAs compliant with the New Zealand Privacy Act 2020.',
        'sort_order' => 6,
    ],

    // =========================================================================
    // 2. SERVICE 1: Cloud Bookkeeping & Daily Reconciliations (service_id: 1)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 1,
        'page'       => 'service_details',
        'category'   => 'Bookkeeping & Reconciliations',
        'question'   => 'How frequently are our bank feeds and transaction receipts reconciled?',
        'answer'     => 'Bank lines and transactions are reconciled on a daily to weekly schedule depending on your selected plan. This ensures your dashboard cash balance, outstanding invoices, and supplier payables are always 100% current.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 1,
        'page'       => 'service_details',
        'category'   => 'Bookkeeping & Reconciliations',
        'question'   => 'How do we send our supplier invoices and expense receipts to your team?',
        'answer'     => 'We configure automated receipt scanning tools such as Dext, Hubdoc, or Xero Expenses. You can snap photos on your phone or forward vendor email PDFs directly to a dedicated inbox, eliminating paper shoe boxes.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 1,
        'page'       => 'service_details',
        'category'   => 'Bookkeeping & Reconciliations',
        'question'   => 'Can your team handle invoice generation and accounts receivable follow-ups?',
        'answer'     => 'Yes. We manage your end-to-end sales ledger—from drafting and dispatching customized customer invoices to sending professional automated reminder statements for overdue receivables.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 1,
        'page'       => 'service_details',
        'category'   => 'Bookkeeping & Reconciliations',
        'question'   => 'What happens at month-end to close off our accounting books?',
        'answer'     => 'At month-end, our accountants perform comprehensive balance sheet reconciliations, review uncleared cheques and deposits, reconcile loan and credit card accounts, and produce a reconciled trial balance.',
        'sort_order' => 4,
    ],

    // =========================================================================
    // 3. SERVICE 2: GST Lodgement & Statutory Tax Compliance (service_id: 2)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 2,
        'page'       => 'service_details',
        'category'   => 'GST & Tax Compliance',
        'question'   => 'Do you file our GST returns directly with Inland Revenue (IRD)?',
        'answer'     => 'Yes. As registered tax and bookkeeping agents, we prepare your return, reconcile all input tax claims against valid tax invoices, and submit directly through the secure myIR gateway.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 2,
        'page'       => 'service_details',
        'category'   => 'GST & Tax Compliance',
        'question'   => 'What records do you need from me to verify GST input tax credits?',
        'answer'     => 'Under IRD rules, taxable supplies over $50 require a valid tax invoice showing the supplier’s GST number. Our team reviews all digital attachments to ensure every claim withstands statutory audit scrutiny.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 2,
        'page'       => 'service_details',
        'category'   => 'GST & Tax Compliance',
        'question'   => 'Can you help estimate and schedule our provisional tax installments?',
        'answer'     => 'Yes. We monitor your rolling profitability throughout the tax year and compute standard or ratio provisional tax payments, helping you manage cash reserves and avoid use-of-money interest charges.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 2,
        'page'       => 'service_details',
        'category'   => 'GST & Tax Compliance',
        'question'   => 'What happens if Inland Revenue conducts a review or audit on our return?',
        'answer'     => 'Because we maintain complete digital audit workpapers and verified invoice attachments for every transaction line, we manage the IRD correspondence and supply documentation on your behalf.',
        'sort_order' => 4,
    ],

    // =========================================================================
    // 4. SERVICE 3: Annual Financial Accounts & Year-End Reporting (service_id: 3)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 3,
        'page'       => 'service_details',
        'category'   => 'Annual Financial Accounts',
        'question'   => 'What statements and schedules are included in the annual accounts pack?',
        'answer'     => 'Your annual compilation includes a complete Statement of Financial Performance (P&L), Statement of Financial Position (Balance Sheet), Fixed Asset & Depreciation Schedule, and Notes to the Accounts.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 3,
        'page'       => 'service_details',
        'category'   => 'Annual Financial Accounts',
        'question'   => 'Can you work alongside our existing external chartered tax accountant?',
        'answer'     => 'Yes, absolutely. Many of our clients have an existing CPA or CA who handles high-level structural tax filing. We deliver reconciled trial balances and workpapers, reducing their preparation hours and your overall bill.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 3,
        'page'       => 'service_details',
        'category'   => 'Annual Financial Accounts',
        'question'   => 'Are your compiled year-end accounts accepted by banks for finance and loans?',
        'answer'     => 'Yes. Our financial statements follow standard New Zealand Special Purpose Financial Reporting Framework (SPFR) guidelines, recognized by major trading banks and lenders across Australasia.',
        'sort_order' => 3,
    ],

    // =========================================================================
    // 5. SERVICE 4: Payday Payroll & Wage Compliance Management (service_id: 4)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 4,
        'page'       => 'service_details',
        'category'   => 'Payday Payroll',
        'question'   => 'How do you ensure payroll complies with the New Zealand Holidays Act 2003?',
        'answer'     => 'We configure your payroll software (Xero Payroll, PaySauce, or iPayroll) to calculate leave using the higher of ordinary weekly pay vs average weekly earnings, ensuring strict compliance with Holidays Act rules.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 4,
        'page'       => 'service_details',
        'category'   => 'Payday Payroll',
        'question'   => 'Is payday filing submitted to IRD automatically on time?',
        'answer'     => 'Yes. Employment Information (EI) returns are electronically lodged with Inland Revenue within 2 working days of every pay run, eliminating late filing penalties.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 4,
        'page'       => 'service_details',
        'category'   => 'Payday Payroll',
        'question'   => 'Can you manage KiwiSaver employer contributions and employee deductions?',
        'answer'     => 'Yes. We track employer contributions (including ESCT tax calculations), employee deductions, student loan repayments, and child support deductions with exact accuracy.',
        'sort_order' => 3,
    ],

    // =========================================================================
    // 6. SERVICE 5: Catch-Up Accounting & Historical Cleanup (service_id: 5)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 5,
        'page'       => 'service_details',
        'category'   => 'Catch-Up Accounting',
        'question'   => 'Can you assist if our books are several months or years behind?',
        'answer'     => 'Yes. Catch-up cleanup is one of our core specialties. We reconstruct historical bank feeds, locate missing receipts, untangle suspense balances, and bring accounts fully up to date.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 5,
        'page'       => 'service_details',
        'category'   => 'Catch-Up Accounting',
        'question'   => 'How long does a typical historical cleanup project take?',
        'answer'     => 'Most catch-up projects spanning 6 to 18 months are completely resolved and reconciled within 1 to 3 weeks, restoring immediate peace of mind.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 5,
        'page'       => 'service_details',
        'category'   => 'Catch-Up Accounting',
        'question'   => 'Will you liaise with Inland Revenue regarding overdue filings and penalty relief?',
        'answer'     => 'Yes. As your authorized tax agent, we contact Inland Revenue to request filing extensions or penalty remissions while your catch-up workpapers are finalized.',
        'sort_order' => 3,
    ],

    // =========================================================================
    // 7. SERVICE 6: Strategic Financial Reporting & Cash Flow Advisory (service_id: 6)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 6,
        'page'       => 'service_details',
        'category'   => 'Strategic Advisory',
        'question'   => 'What reports are included in our monthly executive reporting pack?',
        'answer'     => 'You receive executive P&L summaries, cash flow forecasting models, rolling budget variance analyses, gross profit margins by department, and working capital runway alerts.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 6,
        'page'       => 'service_details',
        'category'   => 'Strategic Advisory',
        'question'   => 'Do you integrate with advanced visual reporting tools like Fathom or Spotlight?',
        'answer'     => 'Yes. We build dynamic visual KPI dashboards in Fathom and Spotlight Reporting, giving directors and investors crystalline visibility into cash trends and financial health.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 8. SERVICE 7: Proactive Tax Advisory & Structural Planning (service_id: 7)
    // =========================================================================
    [
        'branch'     => 'bookkeeping',
        'service_id' => 7,
        'page'       => 'service_details',
        'category'   => 'Tax Advisory',
        'question'   => 'What entity structures do you advise on for small-to-medium businesses?',
        'answer'     => 'We evaluate limited liability companies, family look-through companies (LTCs), discretionary trading trusts, partnerships, and sole trader structures for tax efficiency and asset protection.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'bookkeeping',
        'service_id' => 7,
        'page'       => 'service_details',
        'category'   => 'Tax Advisory',
        'question'   => 'How do you handle shareholder-employee salaries and dividend resolutions?',
        'answer'     => 'We calculate compliant shareholder salary allocations, draft dividend resolution documentation, and manage Imputation Credit Account (ICA) balances to prevent over-taxation.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 9. SERVICE 8: White-Label Back-Office Bookkeeping Pods (service_id: 8)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 8,
        'page'       => 'service_details',
        'category'   => 'Practice Outsourcing',
        'question'   => 'How does white-label bookkeeping operate under our accounting firm brand?',
        'answer'     => 'Our accountants work directly inside your practice management software using firm-issued email addresses and your custom chart of accounts. Your clients never see our brand.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 8,
        'page'       => 'service_details',
        'category'   => 'Practice Outsourcing',
        'question'   => 'Will you ever communicate with our accounting firm\'s clients directly?',
        'answer'     => 'Never without your express written instruction. All completed working papers and queries are delivered directly to your practice manager for final review and dispatch.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 8,
        'page'       => 'service_details',
        'category'   => 'Practice Outsourcing',
        'question'   => 'Can our accounting practice test your work on a single pilot job?',
        'answer'     => 'Yes. We encourage new partner firms to test our quality with a paid pilot client. This allows you to evaluate our speed, query clarity, and workpaper standards risk-free.',
        'sort_order' => 3,
    ],

    // =========================================================================
    // 10. SERVICE 9: Audit-Ready Year-End Working Paper Production (service_id: 9)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 9,
        'page'       => 'service_details',
        'category'   => 'Year-End Workpapers',
        'question'   => 'What workpaper platforms and indexing standards do you support?',
        'answer'     => 'We prepare structured workpapers in APS, CCH iFirm, Xero Workpapers, MYOB Practice, or Excel lead schedules following your firm\'s exact indexing and naming conventions.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 9,
        'page'       => 'service_details',
        'category'   => 'Year-End Workpapers',
        'question'   => 'What is the turnaround time for a complete year-end workpaper file?',
        'answer'     => 'Standard SME year-end workpapers are compiled to 95% completion within 5 to 7 business days, accompanied by a clean list of queries for your final partner review.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 11. SERVICE 10: Tax Return & GST Preparation Assistance (service_id: 10)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 10,
        'page'       => 'service_details',
        'category'   => 'Tax Return Preparation',
        'question'   => 'Which statutory return forms do your accountants prepare for review?',
        'answer'     => 'We prepare draft IR4 (company), IR7 (partnership/trust), IR3 (individual), and IR6 (estate/trust) returns with full tax reconciliation schedules ready for partner sign-off.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 10,
        'page'       => 'service_details',
        'category'   => 'Tax Return Preparation',
        'question'   => 'How do you handle tax season capacity spikes for accounting firms?',
        'answer'     => 'Our scalable pod model allows firms to ramp up capacity during March/April and November tax deadlines without hiring expensive temporary in-house contractors.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 12. SERVICE 11: Practice Payroll Processing Support (service_id: 11)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 11,
        'page'       => 'service_details',
        'category'   => 'Practice Payroll',
        'question'   => 'How do you handle multi-client payroll processing for our firm?',
        'answer'     => 'We manage scheduled pay runs across your firm’s entire payroll client portfolio, processing timesheets, leave approvals, bank batch payment files, and payday filing.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 11,
        'page'       => 'service_details',
        'category'   => 'Practice Payroll',
        'question'   => 'What confidentiality safeguards protect our clients\' employee payroll records?',
        'answer'     => 'All processing occurs directly within your cloud payroll instances under multi-factor authentication, with strict role-based access and zero local data storage.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 13. SERVICE 12: Emergency Client Cleanup & Catch-Up Projects (service_id: 12)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 12,
        'page'       => 'service_details',
        'category'   => 'Emergency Cleanup',
        'question'   => 'Can we outsource messy historical onboarding accounts to your team?',
        'answer'     => 'Yes. When your firm onboards a client with chaotic historical accounts, our cleanup specialists reconstruct ledgers and reconcile trial balances without tying up your senior billing staff.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 12,
        'page'       => 'service_details',
        'category'   => 'Emergency Cleanup',
        'question'   => 'Do you provide upfront scoping and fixed project pricing for cleanups?',
        'answer'     => 'Yes. We conduct a fast 24-hour file review to quantify the hours required and provide an agreed fixed-fee project price before any work begins.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 14. SERVICE 13: Executive Reporting & Virtual CFO Advisory Packs (service_id: 13)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 13,
        'page'       => 'service_details',
        'category'   => 'Virtual CFO Advisory',
        'question'   => 'Are management reporting packs customized with our accounting practice branding?',
        'answer'     => 'Yes. All monthly advisory decks, board summaries, and cash flow models are rendered with your firm’s logo, brand palette, and professional typography.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => 13,
        'page'       => 'service_details',
        'category'   => 'Virtual CFO Advisory',
        'question'   => 'Which analytics and KPI tools do your senior advisory accountants utilize?',
        'answer'     => 'We build models using Fathom, Spotlight Reporting, Power BI, and specialized Excel frameworks to deliver actionable financial intelligence.',
        'sort_order' => 2,
    ],

    // =========================================================================
    // 15. DEDICATED FIRM FAQS (branch: firm_outsourcing, page: faqs_page)
    // =========================================================================
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => null,
        'page'       => 'faqs_page',
        'category'   => 'Confidentiality & Non-Poaching',
        'question'   => 'How do you safeguard client confidentiality under New Zealand law?',
        'answer'     => 'We operate under a legally binding bilateral Non-Disclosure Agreement (NDA) compliant with the New Zealand Privacy Act 2020. Our workstations are BitLocker-encrypted, operate under clean-desk biometric controls, and all work is executed directly inside your cloud environment without local downloads.',
        'sort_order' => 1,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => null,
        'page'       => 'faqs_page',
        'category'   => 'Confidentiality & Non-Poaching',
        'question'   => 'What guarantee do we have that you will never poach our clients?',
        'answer'     => 'Every partnership agreement contains a strict, enforceable non-solicitation covenant. We are strictly a business-to-business back-office production unit for accounting practices and never offer independent accounting services to your clients.',
        'sort_order' => 2,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => null,
        'page'       => 'faqs_page',
        'category'   => 'Delivery, SOPs & Review',
        'question'   => 'How does the partner review and sign-off process work?',
        'answer'     => 'Our accountants prepare the complete working paper files, trial balance adjustments, and draft tax returns to 95% completion, accompanied by a concise query schedule. Your in-house manager or partner simply performs the final 10-minute check and executes the statutory filing.',
        'sort_order' => 3,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => null,
        'page'       => 'faqs_page',
        'category'   => 'Delivery, SOPs & Review',
        'question'   => 'Can you follow our firm\'s custom workpaper templates and indexing?',
        'answer'     => 'Yes. During our initial onboarding stage, we review your firm\'s chart of accounts, workpaper naming conventions, and quality checklists. Our accountants adopt your exact formatting so the files are indistinguishable from in-house work.',
        'sort_order' => 4,
    ],
    [
        'branch'     => 'firm_outsourcing',
        'service_id' => null,
        'page'       => 'faqs_page',
        'category'   => 'Team & Commercial Terms',
        'question'   => 'Will we work with a dedicated team or a pooled group of workers?',
        'answer'     => 'You are assigned a dedicated pod of named senior accountants and a team lead. This ensures consistency, direct Slack/Teams/email communication, and deep institutional familiarity with your clients year over year.',
        'sort_order' => 5,
    ],
];

$stmt = $pdo->prepare('INSERT INTO faqs (branch, service_id, page, category, question, answer, sort_order, is_active) VALUES (:branch, :service_id, :page, :category, :question, :answer, :sort_order, 1)');

$count = 0;
foreach ($faqs as $f) {
    $stmt->execute([
        'branch'     => $f['branch'],
        'service_id' => $f['service_id'],
        'page'       => $f['page'],
        'category'   => $f['category'],
        'question'   => $f['question'],
        'answer'     => $f['answer'],
        'sort_order' => $f['sort_order'],
    ]);
    $count++;
}

echo "Successfully seeded {$count} page-specific and service-specific FAQs into database!\n";
