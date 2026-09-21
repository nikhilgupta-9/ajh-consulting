<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$faq = ['branch' => 'bookkeeping', 'question' => '', 'answer' => '', 'sort_order' => 0];

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
    $faq['question']   = clean($_POST['question'] ?? '');
    $faq['answer']     = clean($_POST['answer'] ?? '');
    $faq['sort_order'] = (int) ($_POST['sort_order'] ?? 0);

    if ($faq['question'] === '') {
        $errors[] = 'Question is required.';
    }
    if ($faq['answer'] === '') {
        $errors[] = 'Answer is required.';
    }

    if (empty($errors) && $pdo) {
        // Only the known columns — a GET-time SELECT * (when editing) can
        // leave extra keys like id/created_at in $faq, which PDO rejects
        // now that emulated prepares are off.
        $faqFields = ['branch', 'question', 'answer', 'sort_order'];
        $faqData   = array_intersect_key($faq, array_flip($faqFields));

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE faqs SET branch=:branch, question=:question, answer=:answer, sort_order=:sort_order WHERE id=:id'
            );
            $stmt->execute($faqData + ['id' => $id]);
            flash_set('success', 'FAQ updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO faqs (branch, question, answer, sort_order) VALUES (:branch, :question, :answer, :sort_order)'
            );
            $stmt->execute($faqData);
            flash_set('success', 'FAQ added.');
        }

        redirect('faqs.php');
    }
}

$pageTitle = $id > 0 ? 'Edit FAQ' : 'Add FAQ';
$activeNav = 'faqs';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:720px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Branch</label>
            <select class="form-control" name="branch">
                <option value="bookkeeping" <?php echo $faq['branch'] === 'bookkeeping' ? 'selected' : ''; ?>>Accounting & Bookkeeping</option>
                <option value="firm_outsourcing" <?php echo $faq['branch'] === 'firm_outsourcing' ? 'selected' : ''; ?>>Accounting Firm Outsourcing</option>
            </select>
        </div>

        <div class="form-group">
            <label>Question</label>
            <input class="form-control" type="text" name="question" required value="<?php echo e($faq['question']); ?>">
        </div>

        <div class="form-group">
            <label>Answer</label>
            <textarea class="form-control" name="answer" style="min-height:120px;" required><?php echo e($faq['answer']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Sort Order (lower shows first)</label>
            <input class="form-control" type="number" name="sort_order" value="<?php echo (int) $faq['sort_order']; ?>">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update FAQ' : 'Add FAQ'; ?></button>
        <a href="faqs.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
