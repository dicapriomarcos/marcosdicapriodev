<?php
/**
 * Define la versión del tema
 */
if (!defined('MD_THEME_VERSION')) {
    $theme = wp_get_theme();
    define('MD_THEME_VERSION', $theme->get('Version'));
}

/**
 * Carga los estilos y scripts del tema
 */
function md_enqueue_styles() {
    // Estilos principales
    wp_enqueue_style(
        'md-styles', 
        get_template_directory_uri() . '/assets/styles.css', 
        array(), 
        MD_THEME_VERSION
    );
    
    // Scripts
    wp_enqueue_script(
        'md-scripts', 
        get_template_directory_uri() . '/assets/js/main.js', 
        array('jquery'), 
        MD_THEME_VERSION, 
        true
    );
}
add_action('wp_enqueue_scripts', 'md_enqueue_styles');
