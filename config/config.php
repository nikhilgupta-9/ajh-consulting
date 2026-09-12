<?php
/**
 * Application bootstrap: loads .env, sets error handling,
 * defines constants, starts the session and opens the DB connection.
 */

require_once __DIR__ . '/env.php';

$appDebug = env('APP_DEBUG', false);
error_reporting(E_ALL);
ini_set('display_errors', $appDebug ? '1' : '0');
ini_set('log_errors', '1');
ini_set('error_log', dirname(__DIR__) . '/logs/error.log');

define('APP_NAME', env('APP_NAME', 'AJH Consulting'));
define('APP_URL', rtrim(env('APP_URL', ''), '/'));
define('APP_ENV', env('APP_ENV', 'local'));
define('APP_DEBUG', $appDebug);

// ---- Business contact details shown across the public site ----
// Edit these (or wire them to .env if you prefer) to your real details.
define('BUSINESS_EMAIL', env('BUSINESS_EMAIL', 'info@ajhconsulting.com'));
define('BUSINESS_PHONE', env('BUSINESS_PHONE', '+91 98765 43210'));
define('BUSINESS_ADDRESS', env('BUSINESS_ADDRESS', '123 Business Avenue, New Delhi, India'));

date_default_timezone_set('Asia/Kolkata');

// ---- Session (used by the admin panel) ----
if (session_status() === PHP_SESSION_NONE) {
    session_name(env('SESSION_NAME', 'ajh_admin_session'));
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

require_once __DIR__ . '/database.php';
require_once dirname(__DIR__) . '/includes/functions.php';
