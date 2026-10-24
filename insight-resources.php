<?php
/** Alias — the global "Resources" nav link points here; the real content lives on the blog. */
require_once __DIR__ . '/config/config.php';
redirect(site_url('blog-list.php'));
