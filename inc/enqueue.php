<?php
/**
 * Enqueue scripts and styles.
 */

function mdw_theme_scripts()
{
    // Match the typography of the visual reference: Space Grotesk for display
    // text and Darker Grotesque for supporting copy.
    wp_enqueue_style(
        'marcosdicapriodev-fonts',
        'https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Enqueue the main stylesheet
    wp_enqueue_style('marcosdicapriodev-style', get_stylesheet_uri(), array('marcosdicapriodev-fonts'), wp_get_theme()->get('Version'));

    // Enqueue main script
    wp_enqueue_script('marcosdicapriodev-script', get_template_directory_uri() . '/theme.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'mdw_theme_scripts');
