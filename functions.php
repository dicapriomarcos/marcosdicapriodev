<?php
/**
 * WP Dev Blog functions and definitions
 */

// Define theme directory path
define('MDW_THEME_DIR', get_template_directory());

// Include theme functionalities
require_once MDW_THEME_DIR . '/inc/setup.php';
require_once MDW_THEME_DIR . '/inc/enqueue.php';
require_once MDW_THEME_DIR . '/inc/reading-time.php';
require_once MDW_THEME_DIR . '/inc/toc.php';
require_once MDW_THEME_DIR . '/inc/disable-gutenberg.php';
require_once MDW_THEME_DIR . '/inc/disable-comments.php';
require_once MDW_THEME_DIR . '/inc/exclude-uncategorized.php';
