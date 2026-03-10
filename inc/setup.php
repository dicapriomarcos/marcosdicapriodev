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
