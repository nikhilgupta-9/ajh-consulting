<?php
/** Handles the "Sign Up Newsletter" form in the footer. */
require_once __DIR__ . '/config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

csrf_verify();

$email = clean($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set('newsletter_error', 'Please enter a valid email address.');
    redirect($_SERVER['HTTP_REFERER'] ?? 'index.php');
}

if ($pdo = db()) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO leads (type, name, email, subject) VALUES (:type, :name, :email, :subject)'
        );
        $stmt->execute([
            'type'    => 'contact',
            'name'    => 'Newsletter Subscriber',
            'email'   => $email,
            'subject' => 'Newsletter Signup',
        ]);
    } catch (Throwable $e) {
        error_log('Newsletter insert failed: ' . $e->getMessage());
    }
}

flash_set('newsletter_success', 'Thanks for subscribing!');
redirect($_SERVER['HTTP_REFERER'] ?? 'index.php');
