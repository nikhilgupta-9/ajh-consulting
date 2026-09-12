<?php
/**
 * One-time CLI script to create/update the super-admin account using the
 * ADMIN_EMAIL / ADMIN_PASSWORD values from your .env file.
 *
 * Run from the project root:
 *   php database/seed.php
 */

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';

$pdo = db();

if (!$pdo) {
    fwrite(STDERR, "Could not connect to the database. Check your .env settings.\n");
    exit(1);
}

$email    = env('ADMIN_EMAIL', 'admin@ajhconsulting.com');
$password = env('ADMIN_PASSWORD');

if (!$password) {
    fwrite(STDERR, "ADMIN_PASSWORD is not set in .env\n");
    exit(1);
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('SELECT id FROM admins WHERE email = :email');
$stmt->execute(['email' => $email]);
$existing = $stmt->fetch();

if ($existing) {
    $update = $pdo->prepare('UPDATE admins SET password_hash = :hash WHERE id = :id');
    $update->execute(['hash' => $hash, 'id' => $existing['id']]);
    echo "Updated password for existing admin: {$email}\n";
} else {
    $insert = $pdo->prepare('INSERT INTO admins (name, email, password_hash) VALUES (:name, :email, :hash)');
    $insert->execute(['name' => 'Administrator', 'email' => $email, 'hash' => $hash]);
    echo "Created admin account: {$email}\n";
}

echo "Done. You can now log in at /admin/login.php\n";
