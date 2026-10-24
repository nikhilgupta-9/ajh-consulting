<?php
/**
 * Redirect duplicate accounting directory index to services catalog
 */
require_once __DIR__ . '/../../config/config.php';
header('Location: ' . site_url('nz/accounting/services.php'), true, 301);
exit;
