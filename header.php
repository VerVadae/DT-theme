<?php
/**
 * The header for our theme
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

<header>
    <div class="container navbar">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?> Logo">
                <?php bloginfo('name'); ?>
            <?php endif; ?>
        </a>

        <?php
        if (has_nav_menu('primary-menu')) :
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'menu_class' => 'nav-links',
                'container' => false,
            ));
        else : ?>
            <ul class="nav-links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
            </ul>
        <?php endif; ?>
    </div>
</header>
