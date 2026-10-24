<?php
/**
 * Redirect duplicate accounting-firm directory index to outsourcing services catalog
 */
require_once __DIR__ . '/../../config/config.php';
header('Location: ' . site_url('nz/accounting-firm/services.php'), true, 301);
exit;
