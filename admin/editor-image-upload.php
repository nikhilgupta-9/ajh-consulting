<?php
/** Inline image upload endpoint used by the TinyMCE editor on admin content forms. */
require_once __DIR__ . '/../config/config.php';
require_admin();

header('Content-Type: application/json');

$path = handle_image_upload('file', 'blog');

if (!$path) {
    http_response_code(400);
    echo json_encode(['error' => 'Upload failed. Use JPG, PNG, WEBP or GIF.']);
    exit;
}

echo json_encode(['location' => site_url($path)]);
