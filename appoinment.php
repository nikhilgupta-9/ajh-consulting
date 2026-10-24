<?php
/** Alias — the standalone appointment page was retired; book via the main Contact Us form instead. */
require_once __DIR__ . '/config/config.php';
redirect(site_url('contactus.php'));
