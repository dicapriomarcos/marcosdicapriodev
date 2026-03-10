<?php
/**
 * WP Dev Blog functions and definitions
 */

if (!function_exists('mdw_theme_setup')):
    function mdw_theme_setup()
    {
        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Register Primary Navigation Menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'marcosdicapriodev'),
        ));
    }
endif;
add_action('after_setup_theme', 'mdw_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function mdw_theme_scripts()
{
    // Enqueue the main stylesheet
    wp_enqueue_style('marcosdicapriodev-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Enqueue main script
    wp_enqueue_script('marcosdicapriodev-script', get_template_directory_uri() . '/theme.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'mdw_theme_scripts');

/**
 * Calculate estimated reading time
 */
function mdw_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average 200 words per minute

    if ($reading_time == 1) {
        $timer = " min";
    }
    else {
        $timer = " min";
    }

    return $reading_time . $timer . ' de lectura';
}

/**
 * Automatically Generate Table of Contents for Single Posts
 */
function mdw_add_toc_to_content($content)
{
    if (!is_single() || !in_the_loop() || is_main_query() === false) {
        return $content;
    }

    // Match all H2 and H3 tags
    preg_match_all('/<h([2-3])(.*?)>(.*?)<\/h[2-3]>/i', $content, $matches);

    if (empty($matches[0]) || count($matches[0]) < 2) {
        return $content; // Only show TOC if there are 2 or more headings
    }

    $toc = '<div class="mdw-toc"><h2>Tabla de Contenidos</h2><ul>';
    $current_level = 2;
    $counter = 1;

    foreach ($matches[0] as $i => $match) {
        $level = $matches[1][$i];
        $attributes = $matches[2][$i];
        $title = strip_tags($matches[3][$i]);
        $slug = sanitize_title($title) . '-' . $counter; // Ensure unique ID

        // Add ID to the heading in the content
        $new_heading = "<h{$level}{$attributes} id=\"{$slug}\">{$matches[3][$i]}</h{$level}>";
        $content = str_replace($match, $new_heading, $content);

        // Handle nested lists for H3
        if ($level > $current_level) {
            $toc .= '<ul>';
        }
        elseif ($level < $current_level) {
            $toc .= '</ul></li>';
        }
        elseif ($i > 0) {
            $toc .= '</li>';
        }

        $toc .= '<li><a href="#' . esc_attr($slug) . '">' . esc_html($title) . '</a>';

        $current_level = $level;
        $counter++;
    }

    // Close any remaining open lists
    while ($current_level > 2) {
        $toc .= '</ul></li>';
        $current_level--;
    }

    $toc .= '</li></ul></div>';

    return $toc . $content;
}
add_filter('the_content', 'mdw_add_toc_to_content');

/**
 * Disable Gutenberg Editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Disable Comments
 */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 * Block direct requests to wp-comments-post.php
 */
add_action('init', function () {
    if (isset($_SERVER['SCRIPT_FILENAME']) && basename($_SERVER['SCRIPT_FILENAME']) === 'wp-comments-post.php') {
        wp_die('Los comentarios están deshabilitados.', 'Comentarios Cerrados', array('response' => 403));
    }
});
