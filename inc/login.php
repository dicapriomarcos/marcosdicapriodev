<?php
/**
 * Branded WordPress login screen.
 */

/**
 * Load the theme typography and the dedicated login stylesheet.
 */
function mdw_login_assets()
{
    $login_css = MDW_THEME_DIR . '/assets/css/login.css';

    wp_enqueue_style(
        'marcosdicapriodev-login-fonts',
        'https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@500;600;700&family=JetBrains+Mono:wght@400;600&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'marcosdicapriodev-login',
        get_template_directory_uri() . '/assets/css/login.css',
        array('marcosdicapriodev-login-fonts'),
        file_exists($login_css) ? (string) filemtime($login_css) : wp_get_theme()->get('Version')
    );
}
add_action('login_enqueue_scripts', 'mdw_login_assets');

/**
 * Make the brand mark return visitors to the site instead of wordpress.org.
 */
function mdw_login_logo_url()
{
    return home_url('/');
}
add_filter('login_headerurl', 'mdw_login_logo_url');

/**
 * Give the brand mark a useful accessible label.
 */
function mdw_login_logo_text()
{
    return sprintf(
        /* translators: %s: site name. */
        __('Volver a %s', 'marcosdicapriodev'),
        get_bloginfo('name')
    );
}
add_filter('login_headertext', 'mdw_login_logo_text');
