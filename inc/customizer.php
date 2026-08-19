<?php
/**
 * Theme Customizer settings.
 */

/**
 * Register the reusable theme accent color.
 */
function mdw_customize_register($wp_customize)
{
    $wp_customize->add_section('mdw_theme_style', array(
        'title' => __('Estilo del tema', 'marcosdicapriodev'),
        'description' => __('El color principal se reutiliza en enlaces, botones, subrayados, etiquetas y detalles decorativos.', 'marcosdicapriodev'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('mdw_accent_color', array(
        'default' => '#11f3af',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'mdw_accent_color',
        array(
            'label' => __('Color principal', 'marcosdicapriodev'),
            'section' => 'mdw_theme_style',
            'settings' => 'mdw_accent_color',
        )
    ));
}
add_action('customize_register', 'mdw_customize_register');

/**
 * Expose the selected color through the theme's global CSS variable.
 */
function mdw_customizer_css()
{
    $accent_color = sanitize_hex_color(get_theme_mod('mdw_accent_color', '#11f3af'));

    if (!$accent_color) {
        $accent_color = '#11f3af';
    }

    wp_add_inline_style(
        'marcosdicapriodev-style',
        sprintf(':root { --color-accent: %1$s; }', esc_html($accent_color))
    );
}
add_action('wp_enqueue_scripts', 'mdw_customizer_css', 20);
