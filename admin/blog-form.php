<?php
require_once __DIR__ . '/../config/config.php';
require_admin();

$pdo = db();
$id  = (int) ($_GET['id'] ?? 0);
$post = ['title' => '', 'slug' => '', 'excerpt' => '', 'content' => '', 'image' => '', 'author' => APP_NAME, 'status' => 'published'];

if ($id > 0 && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM blog_posts WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if ($found) {
        $post = $found;
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $post['title']   = clean($_POST['title'] ?? '');
    $post['excerpt'] = clean($_POST['excerpt'] ?? '');
    $post['content'] = $_POST['content'] ?? '';
    $post['author']  = clean($_POST['author'] ?? APP_NAME);
    $post['status']  = in_array($_POST['status'] ?? '', ['draft', 'published'], true) ? $_POST['status'] : 'published';

    if ($post['title'] === '') {
        $errors[] = 'Title is required.';
    }
    if (trim(strip_tags($post['content'])) === '') {
        $errors[] = 'Content is required.';
    }

    if (empty($errors) && $pdo) {
        $slug = slugify($post['title']);
        // Ensure slug uniqueness (excluding current post when editing).
        $check = $pdo->prepare('SELECT id FROM blog_posts WHERE slug = :slug AND id != :id');
        $check->execute(['slug' => $slug, 'id' => $id]);
        if ($check->fetch()) {
            $slug .= '-' . substr(md5((string) time()), 0, 5);
        }
        $post['slug'] = $slug;

        $uploaded = handle_image_upload('image', 'blog');
        if ($uploaded) {
            $post['image'] = $uploaded;
        }

        if ($id > 0) {
            $stmt = $pdo->prepare(
                'UPDATE blog_posts SET title=:title, slug=:slug, excerpt=:excerpt, content=:content, image=:image, author=:author, status=:status WHERE id=:id'
            );
            $stmt->execute([
                'title' => $post['title'], 'slug' => $post['slug'], 'excerpt' => $post['excerpt'],
                'content' => $post['content'], 'image' => $post['image'], 'author' => $post['author'],
                'status' => $post['status'], 'id' => $id,
            ]);
            flash_set('success', 'Blog post updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO blog_posts (title, slug, excerpt, content, image, author, status) VALUES (:title, :slug, :excerpt, :content, :image, :author, :status)'
            );
            $stmt->execute([
                'title' => $post['title'], 'slug' => $post['slug'], 'excerpt' => $post['excerpt'],
                'content' => $post['content'], 'image' => $post['image'], 'author' => $post['author'],
                'status' => $post['status'],
            ]);
            flash_set('success', 'Blog post created.');
        }

        redirect('blog.php');
    }
}

$pageTitle = $id > 0 ? 'Edit Blog Post' : 'New Blog Post';
$activeNav = 'blog';
require __DIR__ . '/includes/layout-top.php';
?>

<div class="card" style="max-width:760px;">
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?php echo e($err); ?></div>
    <?php endforeach; ?>

    <form method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" required value="<?php echo e($post['title']); ?>">
        </div>

        <div class="form-group">
            <label>Excerpt (short summary shown on the blog list)</label>
            <textarea class="form-control" name="excerpt" style="min-height:70px;"><?php echo e($post['excerpt']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" name="content" style="min-height:220px;"><?php echo e($post['content']); ?></textarea>
            <small style="color:#6b7091;">Basic HTML tags like &lt;p&gt;, &lt;b&gt;, &lt;a&gt; are allowed.</small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Author</label>
                <input class="form-control" type="text" name="author" value="<?php echo e($post['author']); ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                    <option value="draft" <?php echo $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Featured Image</label>
            <?php if (!empty($post['image'])): ?>
                <div class="current-image"><img src="../<?php echo e($post['image']); ?>" alt=""></div>
            <?php endif; ?>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn"><?php echo $id > 0 ? 'Update Post' : 'Create Post'; ?></button>
        <a href="blog.php" class="btn btn-outline">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
