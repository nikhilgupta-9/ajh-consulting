<?php
/**
 * Shared helper functions used by both the public site and the admin panel.
 */

/** Escape a string for safe HTML output. */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/** Redirect and stop execution. */
function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

/** Generate (or reuse) a CSRF token for the current session. */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/** Render a hidden CSRF input field. */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/** Verify a submitted CSRF token, halting the request if it does not match. */
function csrf_verify(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(419);
        exit('Session expired. Please go back and submit the form again.');
    }
}

/** Store a one-time flash message. */
function flash_set(string $key, string $message): void
{
    $_SESSION['flash'][$key] = $message;
}

/** Retrieve and clear a flash message. */
function flash_get(string $key): ?string
{
    if (empty($_SESSION['flash'][$key])) {
        return null;
    }
    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $message;
}

/** Is an admin currently logged in? */
function is_admin_logged_in(): bool
{
    return !empty($_SESSION['admin_id']);
}

/** Require an admin session, otherwise send to the login page. */
function require_admin(): void
{
    if (!is_admin_logged_in()) {
        redirect('login.php');
    }
}

/** Trim + strip whitespace-only input safely. */
function clean(string $value): string
{
    return trim($value);
}

/**
 * Save an uploaded image into /uploads/{$folder}/ and return the relative
 * path to store in the database, or null when no file was uploaded / on error.
 */
function handle_image_upload(string $inputName, string $folder): ?string
{
    if (empty($_FILES[$inputName]) || $_FILES[$inputName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $file = $_FILES[$inputName];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp', 'gif' => 'image/gif'];
    $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed)) {
        return null;
    }

    $finfo    = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($mimeType !== $allowed[$ext]) {
        return null;
    }

    $destDir = dirname(__DIR__) . '/uploads/' . $folder;
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    $filename = bin2hex(random_bytes(8)) . '.' . $ext;
    $destPath = $destDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destPath)) {
        return null;
    }

    return 'uploads/' . $folder . '/' . $filename;
}

/** Turn a title into a URL-safe, unique-ish slug. */
function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-') ?: bin2hex(random_bytes(4));
}

/** Build a full site URL from a relative path. */
function site_url(string $path = ''): string
{
    return APP_URL . '/' . ltrim($path, '/');
}
