<?php
/**
 * Shared helper functions used by both the public site and the admin panel.
 */

/** Escape a string for safe HTML output. */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Detect or switch the active region ('nz' or 'au').
 * Persists user choice across visits via 365-day cookie 'ga_country'.
 */
function current_country(): string
{
    static $country = null;
    if ($country !== null) {
        return $country;
    }

    // 1. Explicit query param switch (e.g. ?country=au or ?country=nz)
    if (!empty($_GET['country']) && in_array(strtolower($_GET['country']), ['nz', 'au'], true)) {
        $country = strtolower($_GET['country']);
        if (!headers_sent()) {
            setcookie('ga_country', $country, time() + 31536000, '/', '', false, false);
        }
        $_COOKIE['ga_country'] = $country;
        return $country;
    }

    // 2. URL path inspection
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($uri, '/au/') !== false || strpos($uri, 'au/index') !== false) {
        $country = 'au';
        if (empty($_COOKIE['ga_country']) || $_COOKIE['ga_country'] !== 'au') {
            if (!headers_sent()) {
                setcookie('ga_country', 'au', time() + 31536000, '/', '', false, false);
            }
            $_COOKIE['ga_country'] = 'au';
        }
        return $country;
    }
    if (strpos($uri, '/nz/') !== false || strpos($uri, 'nz/index') !== false) {
        $country = 'nz';
        if (empty($_COOKIE['ga_country']) || $_COOKIE['ga_country'] !== 'nz') {
            if (!headers_sent()) {
                setcookie('ga_country', 'nz', time() + 31536000, '/', '', false, false);
            }
            $_COOKIE['ga_country'] = 'nz';
        }
        return $country;
    }

    // 3. Persistent Cookie
    if (!empty($_COOKIE['ga_country']) && in_array($_COOKIE['ga_country'], ['nz', 'au'], true)) {
        $country = $_COOKIE['ga_country'];
        return $country;
    }

    // 4. Default: New Zealand
    $country = 'nz';
    return $country;
}

/**
 * Detect current audience track ('business' or 'firm').
 */
function current_track(): string
{
    static $track = null;
    if ($track !== null) {
        return $track;
    }

    if (!empty($_GET['track']) && in_array(strtolower($_GET['track']), ['business', 'firm'], true)) {
        $track = strtolower($_GET['track']);
        if (!headers_sent()) {
            setcookie('ga_track', $track, time() + 31536000, '/', '', false, false);
        }
        $_COOKIE['ga_track'] = $track;
        return $track;
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($uri, 'accounting-firm') !== false) {
        $track = 'firm';
        return $track;
    }
    if (strpos($uri, 'accounting') !== false) {
        $track = 'business';
        return $track;
    }

    if (!empty($_COOKIE['ga_track']) && in_array($_COOKIE['ga_track'], ['business', 'firm'], true)) {
        $track = $_COOKIE['ga_track'];
        return $track;
    }

    $track = 'business';
    return $track;
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

/**
 * Verify a submitted CSRF token, halting the request if it does not match.
 * Returns true so callers written as `if (!csrf_verify())` work too.
 */
function csrf_verify(): bool
{
    $token = $_POST['csrf_token'] ?? '';
    if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(419);
        exit('Session expired. Please go back and submit the form again.');
    }
    return true;
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

/**
 * Site-wide contact / business settings (company name, email, phone,
 * WhatsApp, address, social links, map embed, copyright text), edited
 * from the admin panel (Settings). Falls back to sensible defaults if
 * the site_settings table/row doesn't exist yet (e.g. before the
 * migration has been run) so the site never fatal-errors on this.
 */
function site_settings(): array
{
    static $settings = null;

    if ($settings !== null) {
        return $settings;
    }

    $defaults = [
        'company_name'    => APP_NAME,
        'tagline'         => '',
        'email'           => defined('BUSINESS_EMAIL') ? BUSINESS_EMAIL : '',
        'phone'           => defined('BUSINESS_PHONE') ? BUSINESS_PHONE : '',
        'whatsapp_number' => '',
        'whatsapp_url'    => '',
        'address'         => defined('BUSINESS_ADDRESS') ? BUSINESS_ADDRESS : '',
        'working_hours'   => '',
        'map_embed_url'   => '',
        'facebook_url'    => '',
        'twitter_url'     => '',
        'instagram_url'   => '',
        'linkedin_url'    => '',
        'youtube_url'     => '',
        'copyright_text'  => APP_NAME . '. All rights reserved.',
    ];

    if ($pdo = db()) {
        try {
            $row = $pdo->query('SELECT * FROM site_settings WHERE id = 1')->fetch();
            if ($row) {
                $settings = array_merge($defaults, array_filter($row, fn ($v) => $v !== null && $v !== ''));
                return $settings;
            }
        } catch (Throwable $e) {
            // Table not migrated yet — fall through to defaults.
        }
    }

    $settings = $defaults;
    return $settings;
}

/** Build a wa.me click-to-chat link from a settings WhatsApp number. */
function whatsapp_link(string $number): string
{
    $digits = preg_replace('/[^0-9]/', '', $number);
    return $digits ? 'https://wa.me/' . $digits : '';
}

/**
 * Retrieve active services grouped by branch ('bookkeeping' and 'firm_outsourcing')
 * for public navigation (navbar, mega menu, mobile drawer, footer).
 * Connected live to the database / admin panel.
 */
function site_nav_services(): array
{
    static $cached = null;
    if ($cached !== null) {
        return $cached;
    }

    $biz = [];
    $firm = [];

    if ($pdo = db()) {
        try {
            $stmt = $pdo->query('SELECT id, title, slug, branch, icon, short_description FROM services ORDER BY sort_order ASC, id ASC');
            while ($row = $stmt->fetch()) {
                if ($row['branch'] === 'firm_outsourcing') {
                    $firm[] = $row;
                } else {
                    $biz[] = $row;
                }
            }
        } catch (Throwable $e) {
            error_log('site_nav_services error: ' . $e->getMessage());
        }
    }

    $cached = ['biz' => $biz, 'firm' => $firm];
    return $cached;
}

