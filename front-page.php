<?php
/**
 * The template for displaying the homepage
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- Hero Section with Tavern Pixel Art Background -->
<section class="hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php echo esc_html(get_theme_mod('hero_title', 'Digital Taverna')); ?></h1>
        <p><?php echo esc_html(get_theme_mod('hero_subtitle', '"A physical taverna is a building that houses excited people, and in the digital taverna - we are building excitement for people."')); ?></p>
        <div class="pixel-btn-container">
            <div class="pixel-btn-left"></div>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn"><?php echo esc_html(get_theme_mod('hero_button_text', 'Let\'s Build Something Great')); ?></a>
            <div class="pixel-btn-right"></div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('about_section_title', 'Our Vision & Mission')); ?></h2>
        </div>
        <div class="about-content">
            <div class="about-text">
                <?php if (function_exists('get_field')) : ?>
                    <h3><?php echo esc_html(get_field('vision_title') ? get_field('vision_title') : 'Our Vision'); ?></h3>
                    <p><?php echo esc_html(get_field('vision_text') ? get_field('vision_text') : 'We\'re here to reshape the way brands connect with real people, creating experiences packed with thrills, authenticity, and absolutely no unnecessary seriousness.'); ?></p>
                    
                    <h3><?php echo esc_html(get_field('mission_title') ? get_field('mission_title') : 'Our Mission'); ?></h3>
                    <p><?php echo esc_html(get_field('mission_text') ? get_field('mission_text') : 'We build brands that bring the fun, cut the nonsense, and put people first. It\'s all about thrills, simplicity, and keeping things real.'); ?></p>
                <?php else : ?>
                    <h3>Our Vision</h3>
                    <p>We're here to reshape the way brands connect with real people, creating experiences packed with thrills, authenticity, and absolutely no unnecessary seriousness.</p>
                    
                    <h3>Our Mission</h3>
                    <p>We build brands that bring the fun, cut the nonsense, and put people first. It's all about thrills, simplicity, and keeping things real.</p>
                <?php endif; ?>
            </div>
            <div class="pixel-box">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/tavern-scene.png'); ?>" alt="Digital Taverna Pixel Art" class="pixel-image">
            </div>
        </div>
        
        <!-- Values Section -->
        <div class="values">
            <div class="section-title">
                <h2><?php echo esc_html(get_theme_mod('values_section_title', 'Our Values')); ?></h2>
            </div>
            <div class="values-container">
                <?php
                // If ACF is active, use custom fields for values
                if (function_exists('get_field') && have_rows('values')) :
                    while (have_rows('values')) : the_row();
                        $value_title = get_sub_field('value_title');
                        $value_icon = get_sub_field('value_icon');
                        $value_description = get_sub_field('value_description');
                        ?>
                        <div class="value-card">
                            <div class="pixel-icon">
                                <img src="<?php echo esc_url($value_icon ? $value_icon : get_template_directory_uri() . '/img/icon-default.png'); ?>" alt="<?php echo esc_attr($value_title); ?>" class="pixel-icon-img">
                            </div>
                            <h3><?php echo esc_html($value_title); ?></h3>
                            <p><?php echo esc_html($value_description); ?></p>
                        </div>
                        <?php
                    endwhile;
                else : // Fallback to hardcoded values
                ?>
                    <div class="value-card">
                        <div class="pixel-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-people.png'); ?>" alt="Building for People" class="pixel-icon-img">
                        </div>
                        <h3>1. Building for People</h3>
                        <p>At the core of the brands we build is a commitment to people. The goal of our gambling experiences is to mirror the welcoming environment of a taverna. We craft experiences where players feel at home, engaged, and valued.</p>
                    </div>
                    <div class="value-card">
                        <div class="pixel-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-thrills.png'); ?>" alt="Brands Made of Thrills" class="pixel-icon-img">
                        </div>
                        <h3>2. Brands Made of Thrills</h3>
                        <p>By infusing the spirited atmosphere of a taverna into our brands, we amplify these thrills. Players aren't just engaging with a game; they're part of a collective excitement that a taverna embodies. Our job as the keepers of the taverna is to always give our patrons more excitement than they arrived with.</p>
                    </div>
                    <div class="value-card">
                        <div class="pixel-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-fun.png'); ?>" alt="Why So Serious?" class="pixel-icon-img">
                        </div>
                        <h3>3. Why So Serious?</h3>
                        <p>Seriousness has no business in a taverna, and the digital taverna will not make seriousness into a business. We strip away unnecessary formalities. Our brands encourage players to enjoy themselves, share a laugh, and not take things too seriously—just like friends gathering over drinks in their favorite local spot.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="services-preview">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('services_section_title', 'Our Services')); ?></h2>
        </div>
        <div class="services-grid">
            <?php
            // Get services from services CPT
            $services_args = array(
                'post_type'      => 'service',
                'posts_per_page' => 3,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            );
            
            $services_query = new WP_Query($services_args);
            
            if ($services_query->have_posts()) :
                while ($services_query->have_posts()) : $services_query->the_post();
                    // Get service fields - if using ACF
                    $service_icon = '';
                    $service_link = '#';
                    
                    if (function_exists('get_field')) {
                        $service_icon = get_field('service_icon');
                        $service_link = get_field('service_anchor') ? home_url('/services/#' . get_field('service_anchor')) : get_permalink();
                    } else {
                        $service_link = get_permalink();
                    }
                    ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <?php if ($service_icon) : ?>
                                <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title_attribute(); ?> Icon">
                            <?php else : ?>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title() . ' Icon')); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-default-service.png'); ?>" alt="<?php the_title_attribute(); ?> Icon">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="service-content">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20); ?></p>
                            <a href="<?php echo esc_url($service_link); ?>" class="pixel-link">Learn More</a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else : // Fallback services
            ?>
                <div class="service-card">
                    <div class="service-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-crm.png'); ?>" alt="CRM Icon">
                    </div>
                    <div class="service-content">
                        <h3>CRM: Building Player Loyalty</h3>
                        <p>We design and implement customized CRM strategies to enhance player retention, engagement, and lifetime value.</p>
                        <a href="<?php echo esc_url(home_url('/services/#crm')); ?>" class="pixel-link">Learn More</a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-seo.png'); ?>" alt="SEO Icon">
                    </div>
                    <div class="service-content">
                        <h3>SEO & SEM: Maximize Your Reach</h3>
                        <p>With expert search engine optimization (SEO) and paid search strategies (SEM), we ensure your platform ranks high in search results.</p>
                        <a href="<?php echo esc_url(home_url('/services/#seo')); ?>" class="pixel-link">Learn More</a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-marketing.png'); ?>" alt="Digital Marketing Icon">
                    </div>
                    <div class="service-content">
                        <h3>Digital Marketing: Performance-Driven Growth</h3>
                        <p>Our data-driven marketing campaigns leverage social media, content marketing, and influencer partnerships.</p>
                        <a href="<?php echo esc_url(home_url('/services/#marketing')); ?>" class="pixel-link">Learn More</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="services-cta">
            <a href="<?php echo esc_url(home_url('/services')); ?>" class="pixel-btn">View All Services</a>
        </div>
    </div>
</section>

<!-- Why Us Section -->
<section class="why-us">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('why_us_section_title', 'Why Work with Digital Taverna?')); ?></h2>
        </div>
        <div class="why-grid">
            <?php
            // If ACF is active, use custom fields for Why Us section
            if (function_exists('get_field') && have_rows('why_us_items')) :
                while (have_rows('why_us_items')) : the_row();
                    $why_us_title = get_sub_field('why_us_title');
                    $why_us_icon = get_sub_field('why_us_icon');
                    $why_us_text = get_sub_field('why_us_text');
                    ?>
                    <div class="why-item">
                        <div class="why-icon">
                            <img src="<?php echo esc_url($why_us_icon ? $why_us_icon : get_template_directory_uri() . '/img/icon-default.png'); ?>" alt="<?php echo esc_attr($why_us_title); ?> Icon" class="pixel-icon-img">
                        </div>
                        <h3><?php echo esc_html($why_us_title); ?></h3>
                        <p><?php echo esc_html($why_us_text); ?></p>
                    </div>
                    <?php
                endwhile;
            else : // Fallback Why Us items
            ?>
                <div class="why-item">
                    <div class="why-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-expertise.png'); ?>" alt="Expertise Icon" class="pixel-icon-img">
                    </div>
                    <h3>Industry Expertise</h3>
                    <p>Years of experience in iGaming marketing, branding, and operations.</p>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-solutions.png'); ?>" alt="Solutions Icon" class="pixel-icon-img">
                    </div>
                    <h3>Tailored Solutions</h3>
                    <p>Custom strategies designed for your unique business goals.</p>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-data.png'); ?>" alt="Data Icon" class="pixel-icon-img">
                    </div>
                    <h3>Data-Driven Approach</h3>
                    <p>Leveraging analytics for measurable success.</p>
                </div>
                <div class="why-item">
                    <div class="why-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-support.png'); ?>" alt="Support Icon" class="pixel-icon-img">
                    </div>
                    <h3>Full-Service Support</h3>
                    <p>From acquisition to retention, we've got you covered.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="call-to-action">
            <h3><?php echo esc_html(get_theme_mod('cta_title', 'Let\'s Build Something Great')); ?></h3>
            <p><?php echo esc_html(get_theme_mod('cta_text', 'Ready to take your iGaming brand to the next level? Partner with Digital Taverna and let\'s craft a winning strategy together.')); ?></p>
            <div class="pixel-btn-container">
                <div class="pixel-btn-left"></div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn"><?php echo esc_html(get_theme_mod('cta_button_text', 'Contact Us Today')); ?></a>
                <div class="pixel-btn-right"></div>
            </div>
        </div>
    </div>
</section>

<!-- Pixel Characters Section -->
<section class="pixel-characters-section">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('team_section_title', 'Meet Our Team')); ?></h2>
        </div>
        <div class="pixel-characters">
            <?php
            // Get team members from Team CPT
            $team_args = array(
                'post_type'      => 'team',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            );
            
            $team_query = new WP_Query($team_args);
            
            if ($team_query->have_posts()) :
                while ($team_query->have_posts()) : $team_query->the_post();
                    // Get team member fields - if using ACF
                    $team_role = '';
                    
                    if (function_exists('get_field')) {
                        $team_role = get_field('team_role');
                    }
                    ?>
                    <div class="pixel-character">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title() . ' Pixel Art')); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/default-avatar.png'); ?>" alt="<?php the_title_attribute(); ?> Pixel Art">
                        <?php endif; ?>
                        <p><?php echo esc_html($team_role ? $team_role : get_the_title()); ?></p>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else : // Fallback team members
            ?>
                <div class="pixel-character">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/aidan_static.webp'); ?>" alt="Team Member Aidan Pixel Art" title="Aidan's pixel art">
                    <p>Innovation Alchemist</p>
                </div>
                <div class="pixel-character">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/rawBjorn_actual.png'); ?>" alt="Team Member Bjorn Pixel Art" title="Bjorn's pixel art">
                    <p>CRM Master</p>
                </div>
                <div class="pixel-character">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/avatars/michel_static.webp'); ?>" alt="Team Member Michel Pixel Art" title="Michel's pixel art">
                    <p>Growth Mage</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
