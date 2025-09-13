<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="md__header" role="banner">
        <div class="md__container">
            <div class="header-wrapper">
                <div class="md__site-logo">
                    <h1> <a href="<?php echo esc_url(home_url('/')) ?>">marcosdicaprio.dev</a></h1>
                </div>
                <nav id="site-navigation" class="md__main-navigation" role="navigation">
                    <?php
                    /*
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                ) );
                 */
                ?>
                </nav>
            </div>
        </div>
    </header>
    </body>
</html>