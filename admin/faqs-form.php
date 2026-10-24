<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);

$faq = [
    'branch'     => 'bookkeeping',
    'service_id' => null,
    'page'       => 'all',
    'category'   => 'General',
    'question'   => '',
    'answer'     => '',
    'sort_order' => 0,
    'is_active'  => 1,
];

// Fetch all services for the dropdown
$servicesList = [];
if ($pdo) {
    try {
        $servicesList = $pdo->query('SELECT id, title, branch, slug FROM services ORDER BY branch ASC, sort_order ASC, id ASC')->fetchAll();
    } catch (Throwable $e) {}
}

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM faqs WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $faq = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $faq['branch']     = in_array(($_POST['branch'] ?? ''), ['bookkeeping', 'firm_outsourcing'], true) ? $_POST['branch'] : 'bookkeeping';
    $faq['page']       = in_array(($_POST['page'] ?? ''), ['all', 'home', 'service_details', 'faqs_page'], true) ? $_POST['page'] : 'all';
    $faq['service_id'] = (!empty($_POST['service_id']) && (int) $_POST['service_id'] > 0) ? (int) $_POST['service_id'] : null;
    $faq['category']   = clean($_POST['category'] ?? 'General') ?: 'General';
    $faq['question']   = clean($_POST['question'] ?? '');
    $faq['answer']     = clean($_POST['answer'] ?? '');
    $faq['sort_order'] = (int) ($_POST['sort_order'] ?? 0);
    $faq['is_active']  = isset($_POST['is_active']) ? 1 : 0;

    // If specific service is chosen, automatically set page to service_details
    if ($faq['service_id'] !== null) {
        $faq['page'] = 'service_details';
        // Also ensure branch matches the service branch
        foreach ($servicesList as $s) {
            if ((int) $s['id'] === $faq['service_id']) {
                $faq['branch'] = $s['branch'];
                break;
            }
        }
    }

    if ($faq['question'] === '') {
        $errors[] = 'Question is required.';
    }
    if ($faq['answer'] === '') {
        $errors[] = 'Answer is required.';
    }

    if (empty($errors) && $pdo) {
        $faqFields = ['branch', 'service_id', 'page', 'category', 'question', 'answer', 'sort_order', 'is_active'];
        $faqData   = array_intersect_key($faq, array_flip($faqFields));

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE faqs SET branch=:branch, service_id=:service_id, page=:page, category=:category, question=:question, answer=:answer, sort_order=:sort_order, is_active=:is_active WHERE id=:id'
            );
            $stmt->execute($faqData + ['id' => $id]);
            flash_set('success', 'FAQ updated successfully.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO faqs (branch, service_id, page, category, question, answer, sort_order, is_active) VALUES (:branch, :service_id, :page, :category, :question, :answer, :sort_order, :is_active)'
            );
            $stmt->execute($faqData);
            flash_set('success', 'FAQ added successfully.');
        }

        redirect('faqs.php');
    }
}

$pageTitle = $id > 0 ? 'Edit FAQ' : 'Add FAQ';
$activeNav = 'faqs';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:760px; margin:0 auto;">
    <div style="border-bottom:1px solid #e2e8f0; padding-bottom:14px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin:0 0 4px 0;"><?php echo $id > 0 ? 'Edit FAQ' : 'Create New FAQ'; ?></h2>
            <p style="margin:0; font-size:13px; color:#64748b;">Configure the question, target page, or specific service page where this FAQ should appear.</p>
        </div>
        <a href="faqs.php" class="btn btn-outline btn-sm">&larr; Back to FAQs</a>
    </div>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php echo csrf_field(); ?>

        <!-- Target Page Selector -->
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:18px; margin-bottom:22px;">
            <h4 style="margin:0 0 12px 0; font-size:14px; color:#0f172a;">📍 Page Display &amp; Targeting</h4>
            
            <div class="form-group" style="margin-bottom:14px;">
                <label style="font-weight:600; display:block; margin-bottom:6px;">Where should this FAQ be displayed?</label>
                <select class="form-control" name="page" id="faqPageTarget" onchange="toggleServiceSelector(this.value);">
                    <option value="all" <?php echo ($faq['page'] === 'all' && empty($faq['service_id'])) ? 'selected' : ''; ?>>All Pages / Global (Shows everywhere when relevant)</option>
                    <option value="home" <?php echo ($faq['page'] === 'home' && empty($faq['service_id'])) ? 'selected' : ''; ?>>Homepage Only</option>
                    <option value="service_details" <?php echo ($faq['page'] === 'service_details' || !empty($faq['service_id'])) ? 'selected' : ''; ?>>Specific Service Page (e.g. Payroll, GST, Workpapers)</option>
                    <option value="faqs_page" <?php echo ($faq['page'] === 'faqs_page' && empty($faq['service_id'])) ? 'selected' : ''; ?>>Dedicated FAQs Page Only</option>
                </select>
            </div>

            <!-- Specific Service Dropdown -->
            <div class="form-group" id="serviceSelectGroup" style="margin-bottom:14px; <?php echo ($faq['page'] === 'service_details' || !empty($faq['service_id'])) ? '' : 'display:none;'; ?>">
                <label style="font-weight:600; display:block; margin-bottom:6px; color:#0369a1;">Select Target Service Page:</label>
                <select class="form-control" name="service_id" id="serviceIdField">
                    <option value="">-- Apply to All Service Details Pages --</option>
                    <optgroup label="Accounting & Bookkeeping Services (Businesses)">
                        <?php foreach ($servicesList as $s): if ($s['branch'] !== 'bookkeeping') continue; ?>
                            <option value="<?php echo (int) $s['id']; ?>" <?php echo ((int) $faq['service_id'] === (int) $s['id']) ? 'selected' : ''; ?>>
                                <?php echo e($s['title']); ?> (/service-details.php?slug=<?php echo e($s['slug']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="Accounting Firm Outsourcing (CA/CPA Practices)">
                        <?php foreach ($servicesList as $s): if ($s['branch'] !== 'firm_outsourcing') continue; ?>
                            <option value="<?php echo (int) $s['id']; ?>" <?php echo ((int) $faq['service_id'] === (int) $s['id']) ? 'selected' : ''; ?>>
                                <?php echo e($s['title']); ?> (/service-details.php?slug=<?php echo e($s['slug']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
                <small style="color:#64748b; font-size:12px; display:block; margin-top:4px;">When chosen, this FAQ will dynamically appear inside the FAQ section of this specific service detail page.</small>
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label style="font-weight:600; display:block; margin-bottom:6px;">Target Branch / Audience:</label>
                <select class="form-control" name="branch" id="branchField">
                    <option value="bookkeeping" <?php echo $faq['branch'] === 'bookkeeping' ? 'selected' : ''; ?>>Accounting &amp; Bookkeeping (Small/Medium Businesses)</option>
                    <option value="firm_outsourcing" <?php echo $faq['branch'] === 'firm_outsourcing' ? 'selected' : ''; ?>>Accounting Firm Outsourcing (CA/CPA Practice Support)</option>
                </select>
            </div>
        </div>

        <!-- Question & Answer -->
        <div class="form-group" style="margin-bottom:16px;">
            <label style="font-weight:600; display:block; margin-bottom:6px;">Category / Topic</label>
            <input class="form-control" type="text" name="category" list="categoryPresets" value="<?php echo e($faq['category'] ?: 'General'); ?>" placeholder="e.g. Bookkeeping, GST & Tax, Payroll, Security">
            <datalist id="categoryPresets">
                <option value="General">
                <option value="Bookkeeping & Reconciliations">
                <option value="GST & Statutory Tax Compliance">
                <option value="Payday Payroll & Wage Compliance">
                <option value="Annual Financial Accounts">
                <option value="Catch-Up Accounting & Cleanups">
                <option value="Year-End Workpapers">
                <option value="Audit & Workpaper Support">
                <option value="Security, Privacy & NDAs">
                <option value="Onboarding & Process">
            </datalist>
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="font-weight:600; display:block; margin-bottom:6px;">Question <span style="color:#e53935;">*</span></label>
            <input class="form-control" type="text" name="question" required value="<?php echo e($faq['question']); ?>" placeholder="e.g. Can you handle backdated accounting or cleanup?">
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="font-weight:600; display:block; margin-bottom:6px;">Answer <span style="color:#e53935;">*</span></label>
            <textarea class="form-control" name="answer" style="min-height:130px; font-family:inherit; line-height:1.5;" required placeholder="Write a clear, helpful, confidence-building answer..."><?php echo e($faq['answer']); ?></textarea>
        </div>

        <div style="display:flex; gap:20px; align-items:center; margin-bottom:24px;">
            <div class="form-group" style="margin-bottom:0; flex:1;">
                <label style="font-weight:600; display:block; margin-bottom:6px;">Sort Order (lower numbers appear first)</label>
                <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $faq['sort_order']; ?>">
            </div>

            <div class="form-group" style="margin-bottom:0; flex:1; padding-top:24px;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" <?php echo ((int) $faq['is_active'] === 1) ? 'checked' : ''; ?>>
                    <span style="font-weight:600; color:#0f172a;">Active / Visible on Website</span>
                </label>
            </div>
        </div>

        <div style="display:flex; gap:12px; align-items:center;">
            <button type="submit" class="btn" style="background:#e53935; color:#fff; font-weight:600; padding:10px 24px;">
                <?php echo $id > 0 ? 'Update FAQ' : 'Save & Publish FAQ'; ?>
            </button>
            <a href="faqs.php" class="btn btn-outline" style="padding:10px 20px;">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleServiceSelector(targetVal) {
    var group = document.getElementById('serviceSelectGroup');
    if (targetVal === 'service_details') {
        group.style.display = 'block';
    } else {
        group.style.display = 'none';
        document.getElementById('serviceIdField').value = '';
    }
}
</script>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
