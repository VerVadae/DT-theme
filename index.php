<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme.
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @package Digital_Taverna
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <?php
    if (have_posts()) :
        // Start the Loop
        while (have_posts()) :
            the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             */
            get_template_part('template-parts/content', get_post_type());

        endwhile;

        // Display pagination if available
        the_posts_navigation();

    else :
        // Include a fallback template if no content is found
        get_template_part('template-parts/content', 'none');

    endif;
    ?>
</main><!-- #primary -->

<?php
get_footer();
?>
