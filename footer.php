<?php
/**
 * The template for displaying the footer
 *
 * @package Digital_Taverna
 */
?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3><?php bloginfo('name'); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('footer_tagline', 'Building excitement for people in the digital world.')); ?></p>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <?php
                    if (has_nav_menu('footer-menu')) :
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'     => '',
                            'container'      => false,
                            'fallback_cb'    => false,
                        ));
                    else : // Fallback menu
                    ?>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
                            <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
                
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul>
                        <?php
                        // Get services from services CPT
                        $services_query = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => 5,
                            'orderby'        => 'title',
                            'order'          => 'ASC'
                        ));
                        
                        if ($services_query->have_posts()) :
                            while ($services_query->have_posts()) : $services_query->the_post();
                                $service_slug = get_post_field('post_name', get_the_ID());
                                echo '<li><a href="' . esc_url(home_url('/services/#' . $service_slug)) . '">' . get_the_title() . '</a></li>';
                            endwhile;
                            wp_reset_postdata();
                        else : // Fallback service links
                        ?>
                            <li><a href="<?php echo esc_url(home_url('/services/#crm')); ?>">CRM</a></li>
                            <li><a href="<?php echo esc_url(home_url('/services/#seo')); ?>">SEO & SEM</a></li>
                            <li><a href="<?php echo esc_url(home_url('/services/#marketing')); ?>">Digital Marketing</a></li>
                            <li><a href="<?php echo esc_url(home_url('/services/#branding')); ?>">Branding & Design</a></li>
                            <li><a href="<?php echo esc_url(home_url('/services/#ai')); ?>">AI & Future</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>Email: <?php echo esc_html(get_theme_mod('contact_email', 'info@digitaltaverna.com')); ?></li>
                        <li>Phone: <?php echo esc_html(get_theme_mod('contact_phone', '+1 (123) 456-7890')); ?></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p><?php echo wp_kses_post(get_theme_mod('copyright_text', '&copy; ' . date('Y') . ' Digital Taverna Ltd. All rights reserved.')); ?></p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
