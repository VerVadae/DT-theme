<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main content
 *
 * @package Digital_Taverna
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?> Logo" class="logo-img">
                    <?php bloginfo('name'); ?>
                <?php endif; ?>
            </a>
            
            <?php
            // Check if primary menu exists
            if (has_nav_menu('primary-menu')) :
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class'     => 'nav-links',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'walker'         => new Digital_Taverna_Menu_Walker()
                ));
            else : // Fallback menu
            ?>
                <ul class="nav-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" <?php if (is_front_page()) echo 'class="active"'; ?>>Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>" <?php if (is_page('services')) echo 'class="active"'; ?>>Services</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>" <?php if (is_page('about-us')) echo 'class="active"'; ?>>About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/brand-portfolio/')); ?>" <?php if (is_page('brand-portfolio')) echo 'class="active"'; ?>>Brand Portfolio</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>" <?php if (is_page('contact')) echo 'class="active"'; ?>>Contact</a></li>
                </ul>
            <?php endif; ?>
            
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
