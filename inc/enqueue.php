<?php
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
