<?php
/**
 * The template for displaying single service
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- Service Hero -->
<section class="page-hero services-hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php the_title(); ?></h1>
        <?php if (function_exists('get_field') && get_field('service_subtitle')) : ?>
            <p><?php echo esc_html(get_field('service_subtitle')); ?></p>
        <?php else : ?>
            <p>Tailored iGaming solutions to help your brand thrive</p>
        <?php endif; ?>
    </div>
</section>

<!-- Service Content -->
<section class="service-single">
    <div class="container">
        <div class="service-content">
            <div class="service-main">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'pixel-image-large')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="service-description">
                    <?php the_content(); ?>
                </div>
                
                <?php
                // Display service features if using ACF
                if (function_exists('get_field') && have_rows('service_features')) :
                ?>
                <div class="service-features-section">
                    <h2>Key Features</h2>
                    <div class="service-features-grid">
                        <?php
                        while (have_rows('service_features')) : the_row();
                            $feature = get_sub_field('feature');
                        ?>
                            <div class="feature">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                <span><?php echo esc_html($feature); ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php
                // Display service benefits if using ACF
                if (function_exists('get_field') && have_rows('service_benefits')) :
                ?>
                <div class="service-benefits-section">
                    <h2>Benefits</h2>
                    <div class="service-benefits-grid">
                        <?php
                        while (have_rows('service_benefits')) : the_row();
                            $benefit_title = get_sub_field('benefit_title');
                            $benefit_description = get_sub_field('benefit_description');
                            $benefit_icon = get_sub_field('benefit_icon');
                        ?>
                            <div class="benefit-card">
                                <?php if ($benefit_icon) : ?>
                                    <div class="benefit-icon">
                                        <img src="<?php echo esc_url($benefit_icon); ?>" alt="<?php echo esc_attr($benefit_title); ?>" class="pixel-icon-medium">
                                    </div>
                                <?php endif; ?>
                                <h3><?php echo esc_html($benefit_title); ?></h3>
                                <p><?php echo esc_html($benefit_description); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="service-sidebar">
                <div class="service-cta-box">
                    <h3>Interested in this Service?</h3>
                    <p>Contact us today to learn more about how we can help your brand succeed with our <?php the_title(); ?> service.</p>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn">Contact Us</a>
                </div>
                
                <div class="other-services">
                    <h3>Other Services</h3>
                    <ul>
                        <?php
                        $current_service_id = get_the_ID();
                        
                        $services_args = array(
                            'post_type'      => 'service',
                            'posts_per_page' => 5,
                            'post__not_in'   => array($current_service_id),
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC'
                        );
                        
                        $services_query = new WP_Query($services_args);
                        
                        if ($services_query->have_posts()) :
                            while ($services_query->have_posts()) : $services_query->the_post();
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects or Case Studies -->
<?php if (function_exists('get_field') && have_rows('related_case_studies')) : ?>
<section class="related-projects">
    <div class="container">
        <div class="section-title">
            <h2>Case Studies</h2>
        </div>
        
        <div class="projects-grid">
            <?php while (have_rows('related_case_studies')) : the_row(); 
                $case_title = get_sub_field('case_study_title');
                $case_description = get_sub_field('case_study_description');
                $case_image = get_sub_field('case_study_image');
                $case_link = get_sub_field('case_study_link');
            ?>
                <div class="project-card">
                    <?php if ($case_image) : ?>
                        <div class="project-image">
                            <img src="<?php echo esc_url($case_image); ?>" alt="<?php echo esc_attr($case_title); ?>" class="pixel-image">
                        </div>
                    <?php endif; ?>
                    
                    <div class="project-content">
                        <h3><?php echo esc_html($case_title); ?></h3>
                        <p><?php echo esc_html($case_description); ?></p>
                        
                        <?php if ($case_link) : ?>
                            <a href="<?php echo esc_url($case_link); ?>" class="pixel-link">Read Case Study</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2><?php echo esc_html(get_theme_mod('service_cta_title', 'Ready to Level Up Your iGaming Brand?')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('service_cta_text', 'Partner with Digital Taverna and let\'s craft a winning strategy together.')); ?></p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn"><?php echo esc_html(get_theme_mod('service_cta_button_text', 'Contact Us Today')); ?></a>
        </div>
    </div>
</section>

<?php
get_footer();
