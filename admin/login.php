<?php
require_once __DIR__ . '/../config/config.php';

if (is_admin_logged_in()) {
    redirect('index.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $email    = clean($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    $pdo = db();
    if (!$pdo) {
        $error = 'Database connection failed. Check config/database.php and your .env settings.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            redirect('index.php');
        }

        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | <?php echo e(APP_NAME); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/fav.png">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="login-page">
        <div class="login-box">
            <h1><?php echo e(APP_NAME); ?> <span>Admin</span></h1>
            <p class="sub">Sign in to manage your website</p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo e($error); ?></div>
            <?php endif; ?>

            <form method="post" action="login.php">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required autofocus value="<?php echo e($_POST['email'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn" style="width:100%;">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
