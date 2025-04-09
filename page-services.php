<?php
/**
 * Template Name: Services Page
 *
 * The template for displaying the services page
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- Services Hero -->
<section class="page-hero services-hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php the_title(); ?></h1>
        <?php if (function_exists('get_field')) : ?>
            <p><?php echo esc_html(get_field('services_subtitle')); ?></p>
        <?php else : ?>
            <p>Tailored iGaming solutions to help your brand thrive</p>
        <?php endif; ?>
    </div>
</section>

<!-- Services Intro -->
<section class="services-intro">
    <div class="container">
        <div class="intro-text">
            <?php if (function_exists('get_field') && get_field('services_intro')) : ?>
                <p><?php echo esc_html(get_field('services_intro')); ?></p>
            <?php else : ?>
                <p>At Digital Taverna, we specialize in marketing, branding and general support services within the iGaming sector. Our comprehensive suite of services is designed to help gaming operators attract and retain players, develop compelling brands, and stay ahead of the competition.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-detailed">
    <div class="container">
        <?php
        // Get services from services CPT
        $services_args = array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        );
        
        $services_query = new WP_Query($services_args);
        
        if ($services_query->have_posts()) :
            while ($services_query->have_posts()) : $services_query->the_post();
                // Get service fields - if using ACF
                $service_icon = '';
                $service_features = array();
                $service_anchor = sanitize_title(get_the_title());
                
                if (function_exists('get_field')) {
                    $service_icon = get_field('service_icon');
                    $service_features = get_field('service_features');
                    $service_anchor = get_field('service_anchor') ? get_field('service_anchor') : $service_anchor;
                }
                ?>
                <div id="<?php echo esc_attr($service_anchor); ?>" class="service-detailed-item">
                    <div class="service-icon-large">
                        <?php if ($service_icon) : ?>
                            <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title_attribute(); ?> Icon">
                        <?php else : ?>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('alt' => get_the_title() . ' Icon')); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-default-service.png'); ?>" alt="<?php the_title_attribute(); ?> Icon">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="service-detailed-content">
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                        
                        <?php if (!empty($service_features) && is_array($service_features)) : ?>
                            <div class="service-features">
                                <div class="service-container">
                                    <?php
                                    $feature_count = count($service_features);
                                    $features_per_column = ceil($feature_count / 3);
                                    $features_chunked = array_chunk($service_features, $features_per_column);
                                    
                                    foreach ($features_chunked as $feature_column) :
                                    ?>
                                        <ul class="services-list">
                                            <?php foreach ($feature_column as $feature) : ?>
                                                <li><?php echo esc_html($feature['feature']); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <!-- Fallback service features if no ACF -->
                            <div class="service-features">
                                <div class="service-container">
                                    <ul class="services-list">
                                        <li>Feature 1</li>
                                        <li>Feature 2</li>
                                    </ul>
                                    <ul class="services-list">
                                        <li>Feature 3</li>
                                    </ul>
                                    <ul class="services-list">
                                        <li>Feature 4</li>
                                        <li>Feature 5</li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else : // Fallback services
        ?>
            <!-- CRM Service -->
            <div id="crm" class="service-detailed-item">
                <div class="service-icon-large">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/icons/services/CRM-icon.png'); ?>" alt="CRM Icon">
                </div>
                <div class="service-detailed-content">
                    <h2>CRM: Building Player Loyalty</h2>
                    <p>We design and implement customized CRM strategies to enhance player retention, engagement, and lifetime value. Through data analysis, segmentation, and personalized communication, we keep players returning for more.</p>
                    <div class="service-features">
                        <div class="service-container">
                            <ul class="services-list">
                                <li>Player lifecycle management</li>
                                <li>Segmentation strategies</li>
                            </ul>
                            <ul class="services-list">
                                <li>Personalized communication</li>
                            </ul>
                            <ul class="services-list">
                                <li>Retention communication</li>
                                <li>VIP programs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO & SEM Service -->
            <div id="seo" class="service-detailed-item">
                <div class="service-icon-large">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/icons/services/SEO-icon.png'); ?>" alt="SEO Icon">
                </div>
                <div class="service-detailed-content">
                    <h2>SEO & SEM: Maximize Your Reach</h2>
                    <p>With expert search engine optimization (SEO) and paid search strategies (SEM), we ensure your platform ranks high in search results and attracts high-value players. From keyword optimization to paid ad campaigns, we drive traffic that converts.</p>
                    <div class="service-features">
                        <div class="service-container">
                            <ul class="services-list">
                                <li>Keyword research and optimization</li>
                                <li>Competator analysis</li>
                            </ul>
                            <ul class="services-list">
                                <li>Content strategy</li>
                            </ul>
                            <ul class="services-list">
                                <li>PPC campaign management</li>
                                <li>Performance reports</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Digital Marketing Service -->
            <div id="marketing" class="service-detailed-item">
                <div class="service-icon-large">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-marketing.png'); ?>" alt="Digital Marketing Icon">
                </div>
                <div class="service-detailed-content">
                    <h2>Digital Marketing: Performance-Driven Growth</h2>
                    <p>Our data-driven marketing campaigns leverage social media, content marketing, and influencer partnerships to attract and retain players. We create engaging content that builds brand awareness and fosters a loyal community.</p>
                    <div class="service-features">
                        <div class="service-container">
                            <ul class="services-list">
                                <li>Social media marketing</li>
                                <li>Content creation</li>
                            </ul>
                            <ul class="services-list">
                                <li>Influencer partnerships</li>
                            </ul>
                            <ul class="services-list">
                                <li>Email marketing</li>
                                <li>Affiliate management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branding & Design Service -->
            <div id="branding" class="service-detailed-item">
                <div class="service-icon-large">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-branding.png'); ?>" alt="Branding Icon">
                </div>
                <div class="service-detailed-content">
                    <h2>Branding & Design: Stand Out in the Crowd</h2>
                    <p>Your brand's identity is key to success. We craft compelling visual identities, UX/UI designs, and storytelling strategies that make your gaming platform unforgettable. From logo creation to full-scale brand development, we ensure consistency across all touchpoints.</p>
                    <div class="service-features">
                        <div class="service-container">
                            <ul class="services-list">
                                <li>Brand identity development</li>
                                <li>Logo and visual design</li>
                            </ul>
                            <ul class="services-list">
                                <li>UX/UI design</li>
                            </ul>
                            <ul class="services-list">
                                <li>Brand messaging</li>
                                <li>Brand guidelines</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI & Future Service -->
            <div id="ai" class="service-detailed-item">
                <div class="service-icon-large">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-ai.png'); ?>" alt="AI Icon">
                </div>
                <div class="service-detailed-content">
                    <h2>AI & Future: Innovating for Tomorrow</h2>
                    <p>We leverage artificial intelligence and cutting-edge technologies to optimize player engagement, detect fraud, and drive predictive analytics. Stay ahead of industry trends with automation and AI-powered solutions.</p>
                    <div class="service-features">
                        <div class="service-container">
                            <ul class="services-list">
                                <li>AI-powered personalization</li>
                                <li>Predictive analytics</li>
                            </ul>
                            <ul class="services-list">
                                <li>Chatbot implementation</li>
                            </ul>
                            <ul class="services-list">
                                <li>Fraud detection</li>
                                <li>Automation solutions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2><?php echo esc_html(get_theme_mod('services_cta_title', 'Ready to Level Up Your iGaming Brand?')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('services_cta_text', 'Partner with Digital Taverna and let\'s craft a winning strategy together.')); ?></p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn"><?php echo esc_html(get_theme_mod('services_cta_button_text', 'Contact Us Today')); ?></a>
        </div>
    </div>
</section>

<?php
get_footer();
