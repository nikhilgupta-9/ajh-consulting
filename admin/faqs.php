<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();

// Handle status toggle and delete actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    csrf_verify();
    $id = (int) ($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0 && $action === 'delete') {
        $pdo->prepare('DELETE FROM faqs WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'FAQ deleted successfully.');
    } elseif ($id > 0 && $action === 'toggle') {
        $pdo->prepare('UPDATE faqs SET is_active = IF(is_active = 1, 0, 1) WHERE id = :id')->execute(['id' => $id]);
        flash_set('success', 'FAQ status updated.');
    }

    $redirectQs = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
    redirect('faqs.php' . $redirectQs);
}

// Read query filters
$search    = trim((string) ($_GET['q'] ?? ''));
$branch    = clean($_GET['branch'] ?? '');
$target    = clean($_GET['target'] ?? '');
$serviceId = (int) ($_GET['service_id'] ?? 0);
$status    = clean($_GET['status'] ?? '');
$page      = max(1, (int) ($_GET['page'] ?? 1));
$perPage   = (int) ($_GET['per_page'] ?? 10);
if ($perPage < 5 || $perPage > 100) {
    $perPage = 10;
}

$branchLabels = [
    'bookkeeping'      => 'Accounting & Bookkeeping',
    'firm_outsourcing' => 'Accounting Firm Outsourcing',
];

$pageLabels = [
    'all'             => 'All Pages / Global',
    'home'            => 'Homepage Only',
    'service_details' => 'Service Details Page',
    'faqs_page'       => 'Dedicated FAQs Page',
];

// Fetch all services for filter dropdown
$allServices = [];
if ($pdo) {
    try {
        $allServices = $pdo->query('SELECT id, title, branch FROM services ORDER BY branch, sort_order, id')->fetchAll();
    } catch (Throwable $e) {
        $allServices = [];
    }
}

// Build query
$where  = [];
$params = [];

if ($search !== '') {
    $where[] = '(f.question LIKE :q_q OR f.answer LIKE :q_a OR f.category LIKE :q_c OR s.title LIKE :q_s)';
    $searchTerm = '%' . $search . '%';
    $params['q_q'] = $searchTerm;
    $params['q_a'] = $searchTerm;
    $params['q_c'] = $searchTerm;
    $params['q_s'] = $searchTerm;
}

if ($branch !== '' && isset($branchLabels[$branch])) {
    $where[] = 'f.branch = :branch';
    $params['branch'] = $branch;
}

if ($target !== '' && isset($pageLabels[$target])) {
    $where[] = 'f.page = :target';
    $params['target'] = $target;
}

if ($serviceId > 0) {
    $where[] = 'f.service_id = :service_id';
    $params['service_id'] = $serviceId;
}

if ($status === 'active') {
    $where[] = 'f.is_active = 1';
} elseif ($status === 'draft') {
    $where[] = 'f.is_active = 0';
}

// Count total matching FAQs
$totalItems = 0;
if ($pdo) {
    try {
        $countSql = 'SELECT COUNT(*) FROM faqs f LEFT JOIN services s ON f.service_id = s.id';
        if (!empty($where)) {
            $countSql .= ' WHERE ' . implode(' AND ', $where);
        }
        $stmtCount = $pdo->prepare($countSql);
        foreach ($params as $k => $v) {
            $stmtCount->bindValue(':' . $k, $v);
        }
        $stmtCount->execute();
        $totalItems = (int) $stmtCount->fetchColumn();
    } catch (Throwable $e) {
        $totalItems = 0;
    }
}

// Calculate pagination
$totalPages = max(1, (int) ceil($totalItems / $perPage));
if ($page > $totalPages) {
    $page = $totalPages;
}
$offset = ($page - 1) * $perPage;

$fromItem = $totalItems > 0 ? $offset + 1 : 0;
$toItem   = min($offset + $perPage, $totalItems);

// Fetch paginated FAQs
$faqs = [];
if ($pdo) {
    try {
        $sql = 'SELECT f.*, s.title AS service_title, s.slug AS service_slug 
                FROM faqs f 
                LEFT JOIN services s ON f.service_id = s.id';
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY f.branch ASC, f.page ASC, f.sort_order ASC, f.id ASC';
        $sql .= ' LIMIT :limit OFFSET :offset';

        $stmt = $pdo->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue(':' . $k, $v);
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $faqs = $stmt->fetchAll();
    } catch (Throwable $e) {
        $faqs = [];
    }
}

if (!function_exists('faq_build_url')) {
    /**
     * Build URL preserving existing filters and overriding specific keys
     */
    function faq_build_url(array $overrides = []): string {
        $params = $_GET;
        foreach ($overrides as $k => $v) {
            if ($v === null || $v === '') {
                unset($params[$k]);
            } else {
                $params[$k] = $v;
            }
        }
        return 'faqs.php' . (!empty($params) ? '?' . http_build_query($params) : '');
    }
}

if (!function_exists('faq_highlight')) {
    /**
     * Highlight search query safely in text
     */
    function faq_highlight(?string $text, string $query): string {
        $text = (string) $text;
        if ($query === '' || trim($text) === '') {
            return e($text);
        }
        $escaped = e($text);
        $q = preg_quote(e($query), '/');
        return preg_replace('/(' . $q . ')/i', '<mark style="background:#fef08a; color:#854d0e; padding:1px 3px; border-radius:3px; font-weight:600;">$1</mark>', $escaped);
    }
}

// Build pagination page range
$pageRange = [];
if ($totalPages <= 7) {
    $pageRange = range(1, $totalPages);
} else {
    $start = max(2, $page - 2);
    $end = min($totalPages - 1, $page + 2);
    $pageRange[] = 1;
    if ($start > 2) {
        $pageRange[] = '...';
    }
    for ($i = $start; $i <= $end; $i++) {
        $pageRange[] = $i;
    }
    if ($end < $totalPages - 1) {
        $pageRange[] = '...';
    }
    $pageRange[] = $totalPages;
}

$hasActiveFilters = ($search !== '' || $branch !== '' || $target !== '' || $serviceId > 0 || $status !== '');

$pageTitle = 'FAQs Manager';
$activeNav = 'faqs';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card">
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
        <div>
            <h2 style="margin:0 0 4px 0; display:flex; align-items:center; gap:10px;">
                Frequently Asked Questions (FAQs)
                <span class="badge" style="background:#e2e8f0; color:#334155; font-size:12.5px; font-weight:700; padding:3px 10px;">
                    <?php echo $totalItems; ?> Total
                </span>
            </h2>
            <p style="margin:0; color:#64748b; font-size:13.5px;">Control page-specific and service-specific FAQ questions across the website.</p>
        </div>
        <a href="faqs-form.php" class="btn" style="background:#e53935; color:#fff; font-weight:600; display:inline-flex; align-items:center; gap:6px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New FAQ
        </a>
    </div>

    <!-- Search & Filters Container -->
    <div class="filter-card" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 18px; margin-bottom:22px;">
        <!-- Row 1: Search Form -->
        <form method="get" action="faqs.php" class="search-form-wrap" style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; width:100%;">
            <?php if ($branch !== ''): ?>
                <input type="hidden" name="branch" value="<?php echo e($branch); ?>">
            <?php endif; ?>
            <?php if ($target !== ''): ?>
                <input type="hidden" name="target" value="<?php echo e($target); ?>">
            <?php endif; ?>
            <?php if ($serviceId > 0): ?>
                <input type="hidden" name="service_id" value="<?php echo (int) $serviceId; ?>">
            <?php endif; ?>
            <?php if ($status !== ''): ?>
                <input type="hidden" name="status" value="<?php echo e($status); ?>">
            <?php endif; ?>
            <?php if ($perPage !== 10): ?>
                <input type="hidden" name="per_page" value="<?php echo (int) $perPage; ?>">
            <?php endif; ?>

            <div class="search-box-input" style="position:relative; flex:1; min-width:260px;">
                <svg class="search-svg-icon" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); width:16px; height:16px; color:#94a3b8; pointer-events:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input 
                    type="text" 
                    name="q" 
                    value="<?php echo e($search); ?>" 
                    placeholder="Search by question, answer, category, or service..." 
                    style="width:100%; padding:9px 36px 9px 38px; border:1px solid #cbd5e1; border-radius:6px; font-size:13.5px; background:#fff;"
                >
                <?php if ($search !== ''): ?>
                    <a href="<?php echo faq_build_url(['q' => null, 'page' => 1]); ?>" title="Clear search" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#94a3b8; text-decoration:none; font-size:16px; font-weight:bold; line-height:1; padding:2px 6px;">&times;</a>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-sm" style="background:#0f172a; color:#fff; padding:9px 16px; font-size:13px; font-weight:600; display:inline-flex; align-items:center; gap:6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                Search
            </button>
        </form>

        <!-- Row 2: Secondary Filter Controls -->
        <div class="filter-row" style="display:flex; align-items:center; flex-wrap:wrap; gap:12px; margin-top:14px; padding-top:14px; border-top:1px dashed #e2e8f0;">
            <!-- Branch Filter -->
            <div style="display:flex; align-items:center; gap:6px;">
                <span style="font-size:12.5px; font-weight:600; color:#475569;">Branch:</span>
                <a href="<?php echo faq_build_url(['branch' => null, 'page' => 1]); ?>" class="filter-pill <?php echo $branch === '' ? 'active' : ''; ?>">All</a>
                <a href="<?php echo faq_build_url(['branch' => 'bookkeeping', 'page' => 1]); ?>" class="filter-pill <?php echo $branch === 'bookkeeping' ? 'active' : ''; ?>">💼 Businesses</a>
                <a href="<?php echo faq_build_url(['branch' => 'firm_outsourcing', 'page' => 1]); ?>" class="filter-pill <?php echo $branch === 'firm_outsourcing' ? 'active' : ''; ?>">🏛️ CA/CPA Firms</a>
            </div>

            <!-- Target Page Filter -->
            <div style="display:flex; align-items:center; gap:6px;">
                <label for="faq_target_select" style="font-size:12.5px; font-weight:600; color:#475569;">Target:</label>
                <select id="faq_target_select" class="form-control" style="font-size:12.5px; padding:5px 10px; width:auto; border-radius:6px; background:#fff;" onchange="location.href=this.value;">
                    <option value="<?php echo faq_build_url(['target' => null, 'page' => 1]); ?>">All Display Targets</option>
                    <option value="<?php echo faq_build_url(['target' => 'home', 'page' => 1]); ?>" <?php echo $target === 'home' ? 'selected' : ''; ?>>🏠 Homepage Only</option>
                    <option value="<?php echo faq_build_url(['target' => 'service_details', 'page' => 1]); ?>" <?php echo $target === 'service_details' ? 'selected' : ''; ?>>💼 Service Details Pages</option>
                    <option value="<?php echo faq_build_url(['target' => 'faqs_page', 'page' => 1]); ?>" <?php echo $target === 'faqs_page' ? 'selected' : ''; ?>>📖 Dedicated FAQs Page</option>
                    <option value="<?php echo faq_build_url(['target' => 'all', 'page' => 1]); ?>" <?php echo $target === 'all' ? 'selected' : ''; ?>>🌐 Global / All Pages</option>
                </select>
            </div>

            <!-- Specific Service Filter -->
            <div style="display:flex; align-items:center; gap:6px;">
                <label for="faq_service_select" style="font-size:12.5px; font-weight:600; color:#475569;">Service:</label>
                <select id="faq_service_select" class="form-control" style="font-size:12.5px; padding:5px 10px; width:auto; max-width:200px; border-radius:6px; background:#fff;" onchange="location.href=this.value;">
                    <option value="<?php echo faq_build_url(['service_id' => null, 'page' => 1]); ?>">All Services</option>
                    <?php 
                    $currBranchGroup = '';
                    foreach ($allServices as $svc): 
                        if ($svc['branch'] !== $currBranchGroup):
                            if ($currBranchGroup !== '') echo '</optgroup>';
                            $currBranchGroup = $svc['branch'];
                            $groupTitle = $svc['branch'] === 'firm_outsourcing' ? 'Accounting Firms' : 'Business Services';
                            echo '<optgroup label="' . e($groupTitle) . '">';
                        endif;
                    ?>
                        <option value="<?php echo faq_build_url(['service_id' => $svc['id'], 'page' => 1]); ?>" <?php echo $serviceId === (int)$svc['id'] ? 'selected' : ''; ?>>
                            <?php echo e($svc['title']); ?>
                        </option>
                    <?php endforeach; ?>
                    <?php if ($currBranchGroup !== '') echo '</optgroup>'; ?>
                </select>
            </div>

            <!-- Status Filter -->
            <div style="display:flex; align-items:center; gap:6px;">
                <label for="faq_status_select" style="font-size:12.5px; font-weight:600; color:#475569;">Status:</label>
                <select id="faq_status_select" class="form-control" style="font-size:12.5px; padding:5px 10px; width:auto; border-radius:6px; background:#fff;" onchange="location.href=this.value;">
                    <option value="<?php echo faq_build_url(['status' => null, 'page' => 1]); ?>">All Statuses</option>
                    <option value="<?php echo faq_build_url(['status' => 'active', 'page' => 1]); ?>" <?php echo $status === 'active' ? 'selected' : ''; ?>>Active Only</option>
                    <option value="<?php echo faq_build_url(['status' => 'draft', 'page' => 1]); ?>" <?php echo $status === 'draft' ? 'selected' : ''; ?>>Draft Only</option>
                </select>
            </div>

            <!-- Per Page Select -->
            <div style="display:flex; align-items:center; gap:6px; margin-left:auto;">
                <label for="faq_perpage_select" style="font-size:12.5px; font-weight:600; color:#475569;">Per Page:</label>
                <select id="faq_perpage_select" class="form-control" style="font-size:12.5px; padding:5px 10px; width:auto; border-radius:6px; background:#fff;" onchange="location.href=this.value;">
                    <option value="<?php echo faq_build_url(['per_page' => 10, 'page' => 1]); ?>" <?php echo $perPage === 10 ? 'selected' : ''; ?>>10</option>
                    <option value="<?php echo faq_build_url(['per_page' => 20, 'page' => 1]); ?>" <?php echo $perPage === 20 ? 'selected' : ''; ?>>20</option>
                    <option value="<?php echo faq_build_url(['per_page' => 50, 'page' => 1]); ?>" <?php echo $perPage === 50 ? 'selected' : ''; ?>>50</option>
                </select>

                <?php if ($hasActiveFilters): ?>
                    <a href="faqs.php" class="btn btn-outline btn-sm" style="font-size:12px; padding:4px 10px; color:#ef4444; border-color:#fecaca;" title="Reset all search and filter options">
                        &times; Reset All
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Active Filter Tags / Feedback Row -->
        <?php if ($hasActiveFilters): ?>
            <div style="margin-top:12px; padding-top:10px; border-top:1px solid #edf2f7; font-size:12px; color:#64748b; display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                <span style="font-weight:600; color:#475569;">Active Filters:</span>
                <?php if ($search !== ''): ?>
                    <span style="background:#e0f2fe; color:#0369a1; padding:2px 8px; border-radius:12px; display:inline-flex; align-items:center; gap:4px;">
                        Search: "<strong><?php echo e($search); ?></strong>"
                        <a href="<?php echo faq_build_url(['q' => null, 'page' => 1]); ?>" style="color:#0369a1; font-weight:bold;">&times;</a>
                    </span>
                <?php endif; ?>
                <?php if ($branch !== ''): ?>
                    <span style="background:#f1f5f9; color:#334155; padding:2px 8px; border-radius:12px; display:inline-flex; align-items:center; gap:4px;">
                        Branch: <?php echo e($branchLabels[$branch] ?? $branch); ?>
                        <a href="<?php echo faq_build_url(['branch' => null, 'page' => 1]); ?>" style="color:#64748b; font-weight:bold;">&times;</a>
                    </span>
                <?php endif; ?>
                <?php if ($target !== ''): ?>
                    <span style="background:#f1f5f9; color:#334155; padding:2px 8px; border-radius:12px; display:inline-flex; align-items:center; gap:4px;">
                        Target: <?php echo e($pageLabels[$target] ?? $target); ?>
                        <a href="<?php echo faq_build_url(['target' => null, 'page' => 1]); ?>" style="color:#64748b; font-weight:bold;">&times;</a>
                    </span>
                <?php endif; ?>
                <?php if ($serviceId > 0): ?>
                    <?php 
                    $svcName = 'Service #' . $serviceId;
                    foreach ($allServices as $s) {
                        if ((int)$s['id'] === $serviceId) { $svcName = $s['title']; break; }
                    }
                    ?>
                    <span style="background:#e0e7ff; color:#3730a3; padding:2px 8px; border-radius:12px; display:inline-flex; align-items:center; gap:4px;">
                        Service: <?php echo e($svcName); ?>
                        <a href="<?php echo faq_build_url(['service_id' => null, 'page' => 1]); ?>" style="color:#3730a3; font-weight:bold;">&times;</a>
                    </span>
                <?php endif; ?>
                <?php if ($status !== ''): ?>
                    <span style="background:#f1f5f9; color:#334155; padding:2px 8px; border-radius:12px; display:inline-flex; align-items:center; gap:4px;">
                        Status: <?php echo ucfirst($status); ?>
                        <a href="<?php echo faq_build_url(['status' => null, 'page' => 1]); ?>" style="color:#64748b; font-weight:bold;">&times;</a>
                    </span>
                <?php endif; ?>
                <span style="margin-left:auto; color:#64748b;">
                    Showing <strong><?php echo $fromItem; ?>–<?php echo $toItem; ?></strong> of <strong><?php echo $totalItems; ?></strong> FAQs
                </span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Table of FAQs -->
    <?php if (empty($faqs)): ?>
        <div class="empty-state" style="padding:50px 20px; text-align:center; color:#64748b; background:#fff; border:1px dashed #cbd5e1; border-radius:10px;">
            <div style="font-size:36px; margin-bottom:10px;">🔍</div>
            <h3 style="margin:0 0 6px 0; color:#1e293b;">No FAQs found</h3>
            <p style="margin:0 0 16px 0; font-size:13.5px;">No FAQs matched your current search and filter criteria.</p>
            <?php if ($hasActiveFilters): ?>
                <a href="faqs.php" class="btn btn-outline btn-sm">Clear All Filters</a>
            <?php else: ?>
                <a href="faqs-form.php" class="btn btn-sm" style="background:#e53935; color:#fff;">+ Add New FAQ</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:38%;">Question & Answer</th>
                        <th style="width:20%;">Target Page / Service</th>
                        <th style="width:13%;">Category</th>
                        <th style="width:12%;">Branch</th>
                        <th style="text-align:center; width:6%;">Order</th>
                        <th style="text-align:center; width:8%;">Status</th>
                        <th style="text-align:right; width:13%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $currentQuery = !empty($_SERVER['QUERY_STRING']) ? '?' . htmlspecialchars($_SERVER['QUERY_STRING'], ENT_QUOTES, 'UTF-8') : '';
                    foreach ($faqs as $faq): 
                    ?>
                        <tr>
                            <td>
                                <strong style="color:#0f172a; font-size:13.5px; display:block; line-height:1.4;">
                                    <?php echo faq_highlight($faq['question'], $search); ?>
                                </strong>
                                <small style="color:#64748b; font-size:12px; display:block; margin-top:4px; line-height:1.45;">
                                    <?php echo faq_highlight(mb_strimwidth((string) $faq['answer'], 0, 110, '...'), $search); ?>
                                </small>
                            </td>
                            <td>
                                <?php if (!empty($faq['service_title'])): ?>
                                    <span style="display:inline-block; background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:6px; font-size:11.5px; font-weight:700;">
                                        🎯 Service: <?php echo faq_highlight($faq['service_title'], $search); ?>
                                    </span>
                                <?php elseif ($faq['page'] === 'home'): ?>
                                    <span style="display:inline-block; background:#fef3c7; color:#92400e; padding:3px 8px; border-radius:6px; font-size:11.5px; font-weight:700;">
                                        🏠 Homepage Only
                                    </span>
                                <?php elseif ($faq['page'] === 'faqs_page'): ?>
                                    <span style="display:inline-block; background:#f3e8ff; color:#7e22ce; padding:3px 8px; border-radius:6px; font-size:11.5px; font-weight:700;">
                                        📖 FAQs Page Only
                                    </span>
                                <?php elseif ($faq['page'] === 'service_details'): ?>
                                    <span style="display:inline-block; background:#e0e7ff; color:#4338ca; padding:3px 8px; border-radius:6px; font-size:11.5px; font-weight:700;">
                                        💼 All Service Details
                                    </span>
                                <?php else: ?>
                                    <span style="display:inline-block; background:#f1f5f9; color:#475569; padding:3px 8px; border-radius:6px; font-size:11.5px; font-weight:600;">
                                        🌐 Global / All
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="font-size:12.5px; color:#334155; font-weight:500;">
                                    <?php echo faq_highlight($faq['category'] ?: 'General', $search); ?>
                                </span>
                            </td>
                            <td>
                                <span style="font-size:12px; color:#475569;">
                                    <?php echo e($branchLabels[$faq['branch']] ?? $faq['branch']); ?>
                                </span>
                            </td>
                            <td style="text-align:center; font-weight:600; color:#64748b;">
                                <?php echo (int) $faq['sort_order']; ?>
                            </td>
                            <td style="text-align:center;">
                                <form method="post" action="faqs.php<?php echo $currentQuery; ?>" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $faq['id']; ?>">
                                    <input type="hidden" name="action" value="toggle">
                                    <button type="submit" style="background:none; border:none; cursor:pointer; padding:0;" title="Click to toggle status">
                                        <?php if ((int) $faq['is_active'] === 1): ?>
                                            <span style="background:#dcfce7; color:#15803d; padding:3px 9px; border-radius:12px; font-size:11px; font-weight:700; display:inline-block;">Active</span>
                                        <?php else: ?>
                                            <span style="background:#fee2e2; color:#b91c1c; padding:3px 9px; border-radius:12px; font-size:11px; font-weight:700; display:inline-block;">Draft</span>
                                        <?php endif; ?>
                                    </button>
                                </form>
                            </td>
                            <td class="actions" style="text-align:right; white-space:nowrap;">
                                <a class="btn btn-outline btn-sm" href="faqs-form.php?id=<?php echo (int) $faq['id']; ?>" title="Edit FAQ">Edit</a>
                                <form method="post" action="faqs.php<?php echo $currentQuery; ?>" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo (int) $faq['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" style="color:#e53935; background:none; border:none; padding:4px 8px; font-size:12px; cursor:pointer;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        <div class="pagination-wrap">
            <div class="pagination-info">
                Showing <strong><?php echo $fromItem; ?></strong> to <strong><?php echo $toItem; ?></strong> of <strong><?php echo $totalItems; ?></strong> FAQs
                <?php if ($totalPages > 1): ?>
                    &bull; Page <strong><?php echo $page; ?></strong> of <strong><?php echo $totalPages; ?></strong>
                <?php endif; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <ul class="pagination-list">
                    <!-- Prev Button -->
                    <li class="pagination-item">
                        <?php if ($page > 1): ?>
                            <a href="<?php echo faq_build_url(['page' => $page - 1]); ?>" class="pagination-link" title="Previous page">&laquo; Prev</a>
                        <?php else: ?>
                            <span class="pagination-link disabled">&laquo; Prev</span>
                        <?php endif; ?>
                    </li>

                    <!-- Page Numbers -->
                    <?php foreach ($pageRange as $p): ?>
                        <li class="pagination-item">
                            <?php if ($p === '...'): ?>
                                <span class="pagination-ellipsis">&hellip;</span>
                            <?php elseif ((int)$p === $page): ?>
                                <span class="pagination-link active"><?php echo $p; ?></span>
                            <?php else: ?>
                                <a href="<?php echo faq_build_url(['page' => $p]); ?>" class="pagination-link"><?php echo $p; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                    <!-- Next Button -->
                    <li class="pagination-item">
                        <?php if ($page < $totalPages): ?>
                            <a href="<?php echo faq_build_url(['page' => $page + 1]); ?>" class="pagination-link" title="Next page">Next &raquo;</a>
                        <?php else: ?>
                            <span class="pagination-link disabled">Next &raquo;</span>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
