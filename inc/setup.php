<?php
/**
 * Theme setup.
 */

if (!function_exists('mdw_theme_setup')):
    function mdw_theme_setup()
    {
        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Allow the site identity to use a custom logo.
        add_theme_support('custom-logo', array(
            'height' => 72,
            'width' => 180,
            'flex-height' => true,
            'flex-width' => true,
        ));

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

        // Register the navigation areas used by the header and footer.
        register_nav_menus(array(
            'primary' => __('Menú del header', 'marcosdicapriodev'),
            'footer_legal' => __('Menú legal del footer', 'marcosdicapriodev'),
        ));
    }
endif;
add_action('after_setup_theme', 'mdw_theme_setup');

/**
 * Mirror the menu label through pseudo-elements for the rolling hover effect.
 * The original text remains in the link as its accessible name.
 */
function mdw_primary_menu_link_attributes($atts, $item, $args, $depth)
{
    if (!empty($args->theme_location) && 'primary' === $args->theme_location) {
        $atts['data-text'] = wp_strip_all_tags($item->title);
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'mdw_primary_menu_link_attributes', 10, 4);

/**
 * Keep a useful animated navigation visible before a menu is assigned.
 */
function mdw_fallback_menu($args)
{
    $home_label = __('Inicio', 'marcosdicapriodev');
    $articles_label = __('Artículos', 'marcosdicapriodev');

    $menu = sprintf(
        '<ul id="primary-menu" class="primary-menu"><li><a href="%1$s" data-text="%2$s">%3$s</a></li><li><a href="%4$s" data-text="%5$s">%6$s</a></li></ul>',
        esc_url(home_url('/')),
        esc_attr($home_label),
        esc_html($home_label),
        esc_url(home_url('/#latest-posts')),
        esc_attr($articles_label),
        esc_html($articles_label)
    );

    if (isset($args['echo']) && false === $args['echo']) {
        return $menu;
    }

    echo wp_kses_post($menu);
}

/**
 * Use published legal pages as a footer fallback until a menu is assigned.
 */
function mdw_footer_legal_fallback($args)
{
    $legal_pages = array(
        array('aviso-legal', 'legal-notice'),
        array('politica-de-privacidad', 'privacidad', 'privacy-policy'),
        array('politica-de-cookies', 'cookies', 'cookie-policy'),
    );
    $items = array();

    foreach ($legal_pages as $slugs) {
        foreach ($slugs as $slug) {
            $page = get_page_by_path($slug);

            if ($page instanceof WP_Post && 'publish' === $page->post_status) {
                $items[] = sprintf(
                    '<li><a href="%1$s">%2$s</a></li>',
                    esc_url(get_permalink($page)),
                    esc_html(get_the_title($page))
                );
                break;
            }
        }
    }

    if (empty($items)) {
        return '';
    }

    $menu = '<ul class="footer-legal-menu">' . implode('', $items) . '</ul>';

    if (isset($args['echo']) && false === $args['echo']) {
        return $menu;
    }

    echo wp_kses_post($menu);
}
