-- =====================================================
--  get-accountant - Migration 007: Legal Pages content refresh
--
--  Replaces the placeholder Privacy Policy / Terms of Use text
--  with full, structured content (modelled on a comprehensive
--  accounting-outsourcing privacy notice). Still fully editable
--  from Admin -> Legal Pages afterwards.
--
--  Run:
--    mysql -u root -p ajh_consulting < database/migration_007_legal_pages_content.sql
-- =====================================================

SET NAMES utf8mb4;

UPDATE legal_pages SET content = '
<p>get-accountant ("we", "us", "our") provides accounting, bookkeeping and outsourcing services to businesses and accounting firms in New Zealand and Australia. This Privacy Policy explains how we collect, use, store, share and protect personal information through our website and services, in line with the New Zealand Privacy Act 2020 and, where relevant, the Australian Privacy Act 1988, the EU/UK GDPR and other applicable data protection laws.</p>

<h3>1. Scope and Application</h3>
<p>This policy applies to visitors of our website, prospective and existing clients (businesses and accounting firms), and individuals whose information is shared with us by our clients for the purpose of delivering accounting and bookkeeping services. Where we process data on behalf of a client under a separate engagement or data processing agreement, the terms of that agreement take precedence over this policy.</p>

<h3>2. Personal Data We Collect</h3>
<p><strong>Information you provide directly:</strong> name, business name, email address, phone number, postal address, and any details submitted through our contact, appointment, or onboarding forms.</p>
<p><strong>Information collected automatically:</strong> IP address, browser and device details, pages visited, and general browsing behaviour, typically via cookies and analytics tools.</p>
<p><strong>Client financial data:</strong> where you engage us for bookkeeping, payroll, tax or outsourcing services, we may process bank transaction data, invoices, payroll records and other financial information strictly for service delivery.</p>
<p>We do not knowingly collect sensitive personal data (such as health or biometric information) through our website.</p>

<h3>3. How We Use Your Information</h3>
<p>We use personal information to: respond to enquiries and appointment requests; deliver and administer our accounting, bookkeeping, payroll and outsourcing services; send service-related communications; improve our website and services through analytics; meet legal, tax and regulatory obligations; and safeguard our systems against fraud and misuse.</p>

<h3>4. Cross-Border Data Storage &amp; Transfers</h3>
<p>As we support clients in New Zealand and Australia, and may use offshore service delivery or cloud infrastructure, personal data may be stored or processed outside the country in which you are based. Where this occurs, we take reasonable steps to ensure the receiving party provides a comparable standard of protection, consistent with the Privacy Act 2020 (NZ) and Australian Privacy Principles.</p>

<h3>5. Disclosure of Personal Data</h3>
<p>We do not sell or trade your personal information. We may disclose information to: trusted service providers and software platforms that support our operations (e.g. accounting and payroll software, cloud hosting, email providers); professional advisers (legal, audit, insurance) where necessary; regulators or law enforcement where required by law; and a successor entity in the event of a merger, acquisition or restructuring.</p>

<h3>6. Data Retention</h3>
<p>Enquiry and contact form data is retained for up to 24 months unless a client relationship is established. Client and financial records are retained for the duration of the engagement plus a minimum period required under NZ/AU tax and accounting record-keeping obligations (typically 7 years). Website analytics data is retained for up to 26 months. Data no longer required is securely deleted or anonymised.</p>

<h3>7. Cookies</h3>
<p>Our website uses strictly necessary cookies (required for core functionality), analytics cookies (to understand site usage), and functional cookies (to remember preferences). You can manage or disable cookies through your browser settings; disabling some cookies may affect site functionality. See our Terms of Use for further details on acceptable use of the site.</p>

<h3>8. Your Privacy Rights</h3>
<p>Depending on your location, you may have the right to: access the personal information we hold about you; request correction of inaccurate information; request deletion of your information, subject to our legal retention obligations; object to or restrict certain processing; and lodge a complaint with the relevant privacy regulator (in New Zealand, the Office of the Privacy Commissioner; in Australia, the OAIC). We aim to respond to verified requests within a reasonable timeframe, and in any event within timeframes required by applicable law.</p>

<h3>9. Security of Personal Data</h3>
<p>We apply reasonable technical and organisational safeguards, including encrypted data transmission, restricted access controls, and confidentiality obligations for our staff and contractors. While we take data security seriously, no system can be guaranteed to be completely secure. If we become aware of a data breach affecting your personal information, we will notify you and/or the relevant regulator as required by law.</p>

<h3>10. Children''s Privacy</h3>
<p>Our services are intended for businesses and individuals operating in a professional capacity. We do not knowingly collect personal information from minors, and any such information identified will be deleted.</p>

<h3>11. Third-Party Links</h3>
<p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of external sites and encourage you to review their privacy policies separately.</p>

<h3>12. Changes to This Privacy Policy</h3>
<p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Updates will be posted on this page with a revised effective date. Where changes are material, we will take reasonable steps to notify clients in advance.</p>

<h3>13. Contact Us</h3>
<p>If you have any questions about this Privacy Policy or wish to exercise your privacy rights, please contact us using the details on our <a href="contactus.php">Contact page</a>.</p>
' WHERE slug = 'privacy-policy';

UPDATE legal_pages SET content = '
<p>These Terms of Use ("Terms") govern your access to and use of the get-accountant website and the accounting, bookkeeping and outsourcing services referenced on it. By accessing or using this website, you agree to be bound by these Terms. If you do not agree, please do not use this website.</p>

<h3>1. Use of This Website</h3>
<p>You may use this website only for lawful purposes and in a manner that does not infringe the rights of, restrict or inhibit anyone else''s use of the site. You must not attempt to gain unauthorised access to any part of this website, its systems, or related networks.</p>

<h3>2. Accuracy of Information</h3>
<p>We make reasonable efforts to keep the content on this website accurate, current and complete, but we do not warrant or guarantee that all information (including pricing, service descriptions and availability) is error-free or up to date at all times. Specific service terms and pricing are confirmed directly with clients through a separate engagement letter or service agreement.</p>

<h3>3. No Professional Advice</h3>
<p>Content on this website is provided for general informational purposes only and does not constitute accounting, tax, legal or financial advice. You should not rely on website content as a substitute for advice from a qualified professional familiar with your specific circumstances. Formal advice is only provided once an engagement has been agreed with get-accountant.</p>

<h3>4. Intellectual Property</h3>
<p>All content on this website, including text, graphics, logos, page layout and software, is owned by or licensed to get-accountant and is protected by copyright and other intellectual property laws, unless otherwise stated. You may not reproduce, distribute or create derivative works from this content without our prior written consent.</p>

<h3>5. Third-Party Links</h3>
<p>This website may contain links to third-party websites for your convenience. We do not control and are not responsible for the content, accuracy or privacy practices of any linked third-party site.</p>

<h3>6. Client Engagements</h3>
<p>Nothing on this website constitutes an offer to provide services. A formal client relationship, including the scope of services, fees and responsibilities, is only established once a signed engagement letter or service agreement is in place between get-accountant and the client.</p>

<h3>7. Limitation of Liability</h3>
<p>To the maximum extent permitted by law, get-accountant will not be liable for any direct, indirect, incidental or consequential loss or damage arising from your use of, or inability to use, this website, including reliance on any information contained on it.</p>

<h3>8. Governing Law</h3>
<p>These Terms are governed by the laws of New Zealand. Any disputes arising from your use of this website will be subject to the exclusive jurisdiction of the courts of New Zealand, unless otherwise required by applicable local law in your jurisdiction.</p>

<h3>9. Changes to These Terms</h3>
<p>We may update these Terms of Use from time to time to reflect changes in our services or legal requirements. Updates will be posted on this page with a revised effective date. Continued use of the website after changes are posted constitutes acceptance of the revised Terms.</p>

<h3>10. Contact Us</h3>
<p>If you have any questions about these Terms of Use, please contact us using the details on our <a href="contactus.php">Contact page</a>.</p>
' WHERE slug = 'terms-of-use';
