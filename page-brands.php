<?php
/**
 * Template Name: Brands Page
 *
 * The template for displaying the brands portfolio page
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- Brands Hero -->
<section class="page-hero brands-hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php the_title(); ?></h1>
        <?php if (function_exists('get_field')) : ?>
            <p><?php echo esc_html(get_field('brands_subtitle')); ?></p>
        <?php else : ?>
            <p>Discover the exciting brands we've crafted throughout our journey</p>
        <?php endif; ?>
    </div>
</section>

<!-- Brands Introduction -->
<section class="brands-intro">
    <div class="container">
        <div class="intro-text">
            <?php if (function_exists('get_field') && get_field('brands_intro')) : ?>
                <p><?php echo esc_html(get_field('brands_intro')); ?></p>
            <?php else : ?>
                <p>At Digital Taverna, we've had the privilege of building and evolving some of the most exciting brands in the iGaming industry. Our portfolio showcases our commitment to creating authentic, thrilling, and people-focused gaming experiences.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Brands Timeline -->
<section class="brands-timeline">
    <div class="container">
        <div class="timeline">
            <!-- Timeline Header -->
            <div class="timeline-header">
                <h2>Our Brand Journey</h2>
                <p>Follow the evolution of our exciting brand portfolio</p>
            </div>
            
            <!-- Timeline Track -->
            <div class="timeline-track">
                <div class="timeline-line"></div>
                
                <?php
                // Get brands from brands CPT
                $brands_args = array(
                    'post_type'      => 'brand',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                );
                
                $brands_query = new WP_Query($brands_args);
                
                if ($brands_query->have_posts()) :
                    $i = 0;
                    while ($brands_query->have_posts()) : $brands_query->the_post();
                        $i++;
                        // Get brand fields - if using ACF
                        $brand_year = '';
                        $brand_subtitle = '';
                        $brand_logo = '';
                        $brand_features = array();
                        $brand_achievements = array();
                        $is_future_brand = false;
                        
                        if (function_exists('get_field')) {
                            $brand_year = get_field('brand_year');
                            $brand_subtitle = get_field('brand_subtitle');
                            $brand_logo = get_field('brand_logo');
                            $brand_features = get_field('brand_features');
                            $brand_achievements = get_field('brand_achievements');
                            $is_future_brand = get_field('future_brand');
                        }
                        
                        // Position alternating (left/right)
                        $position_class = ($i % 2 == 0) ? 'right' : 'left';
                        $marker_class = $is_future_brand ? 'future-marker' : '';
                        $card_class = $is_future_brand ? 'brand-card future-brand' : 'brand-card';
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-marker <?php echo esc_attr($marker_class); ?>"></div>
                            <div class="timeline-date"><?php echo esc_html($brand_year ? $brand_year : ($is_future_brand ? 'Coming Soon' : '2020')); ?></div>
                            <div class="timeline-content <?php echo esc_attr($position_class); ?>">
                                <div class="<?php echo esc_attr($card_class); ?>">
                                    <div class="brand-logo">
                                        <?php if ($brand_logo) : ?>
                                            <img src="<?php echo esc_url($brand_logo); ?>" alt="<?php the_title_attribute(); ?> Logo" class="pixel-image-medium">
                                        <?php elseif (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'pixel-image-medium', 'alt' => get_the_title() . ' Logo')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brand-default.png'); ?>" alt="<?php the_title_attribute(); ?> Logo" class="pixel-image-medium">
                                        <?php endif; ?>
                                    </div>
                                    <h3><?php the_title(); ?></h3>
                                    <p class="brand-subtitle"><?php echo esc_html($brand_subtitle ? $brand_subtitle : 'Brand subtitle goes here'); ?></p>
                                    
                                    <?php if (!$is_future_brand) : ?>
                                        <div class="brand-description">
                                            <?php the_content(); ?>
                                            
                                            <?php if (!empty($brand_features) && is_array($brand_features)) : ?>
                                                <div class="brand-features">
                                                    <?php foreach ($brand_features as $feature) : ?>
                                                        <div class="brand-feature">
                                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                                            <span><?php echo esc_html($feature['feature']); ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php if (!empty($brand_achievements) && is_array($brand_achievements)) : ?>
                                            <div class="brand-achievements">
                                                <?php foreach ($brand_achievements as $achievement) : ?>
                                                    <div class="achievement">
                                                        <div class="achievement-icon"><?php echo esc_html($achievement['icon']); ?></div>
                                                        <div class="achievement-text"><?php echo esc_html($achievement['text']); ?></div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="brand-description">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="coming-soon">
                                            <p>Stay tuned!</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else : // Fallback brands
                ?>
                    <!-- InstaCasino Brand -->
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-date">2015</div>
                        <div class="timeline-content left">
                            <div class="brand-card">
                                <div class="brand-logo">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brand-instacasino.png'); ?>" alt="InstaCasino Logo" class="pixel-image-medium">
                                </div>
                                <h3>InstaCasino</h3>
                                <p class="brand-subtitle">Where instant fun meets rewarding gameplay</p>
                                <div class="brand-description">
                                    <p>InstaCasino was our first venture into creating a player-centric gaming platform. With a focus on instant gratification and a streamlined user experience, InstaCasino quickly gained popularity for its no-fuss approach to online gaming.</p>
                                    <div class="brand-features">
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Instant play platform</span>
                                        </div>
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Streamlined user journey</span>
                                        </div>
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Innovative RealSpins feature</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="brand-achievements">
                                    <div class="achievement">
                                        <div class="achievement-icon">🏆</div>
                                        <div class="achievement-text">Best New Casino 2016</div>
                                    </div>
                                    <div class="achievement">
                                        <div class="achievement-icon">👥</div>
                                        <div class="achievement-text">100,000+ players</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Clown Casino Brand -->
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-date">2018</div>
                        <div class="timeline-content right">
                            <div class="brand-card">
                                <div class="brand-logo">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brand-clowncasino.png'); ?>" alt="Clown Casino Logo" class="pixel-image-medium">
                                </div>
                                <h3>Clown Casino</h3>
                                <p class="brand-subtitle">Seriously fun, never serious</p>
                                <div class="brand-description">
                                    <p>Clown Casino was our bold foray into challenging industry norms. Breaking away from the often serious tone of gaming platforms, we created a brand that embraced fun, humor, and playfulness while maintaining a high-quality gaming experience.</p>
                                    <div class="brand-features">
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Humor-driven brand identity</span>
                                        </div>
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Playful user interface</span>
                                        </div>
                                        <div class="brand-feature">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/pixel-check.png'); ?>" alt="Feature" class="pixel-icon-small">
                                            <span>Unique gamification elements</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="brand-achievements">
                                    <div class="achievement">
                                        <div class="achievement-icon">🎭</div>
                                        <div class="achievement-text">Most Original Casino Concept</div>
                                    </div>
                                    <div class="achievement">
                                        <div class="achievement-icon">📈</div>
                                        <div class="achievement-text">85% player retention rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Future Brand (Coming Soon) -->
                    <div class="timeline-item">
                        <div class="timeline-marker future-marker"></div>
                        <div class="timeline-date">Coming Soon</div>
                        <div class="timeline-content left">
                            <div class="brand-card future-brand">
                                <div class="brand-logo">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brand-mystery.png'); ?>" alt="Mystery Future Brand" class="pixel-image-medium">
                                </div>
                                <h3>Mystery Brand</h3>
                                <p class="brand-subtitle">The next chapter in our brand story...</p>
                                <div class="brand-description">
                                    <p>We're always evolving, always creating. Our next brand is currently in development, with an exciting new concept that will once again challenge conventions and deliver exceptional player experiences.</p>
                                </div>
                                <div class="coming-soon">
                                    <p>Stay tuned!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Brand Showcase -->
<section class="brand-showcase">
    <div class="container">
        <div class="section-title">
            <h2>The Digital Taverna Difference</h2>
        </div>
        <div class="showcase-content">
            <div class="showcase-text">
                <p>What makes our brands stand out in the crowded iGaming marketplace? It's our unwavering commitment to our core values:</p>
                
                <div class="showcase-values">
                    <?php
                    // If ACF is active, use custom fields for showcase values
                    if (function_exists('get_field') && have_rows('showcase_values')) :
                        while (have_rows('showcase_values')) : the_row();
                            $value_title = get_sub_field('value_title');
                            $value_icon = get_sub_field('value_icon');
                            $value_description = get_sub_field('value_description');
                            ?>
                            <div class="showcase-value">
                                <div class="pixel-icon-medium">
                                    <img src="<?php echo esc_url($value_icon ? $value_icon : get_template_directory_uri() . '/img/icon-default.png'); ?>" alt="<?php echo esc_attr($value_title); ?>" class="pixel-icon-img">
                                </div>
                                <h3><?php echo esc_html($value_title); ?></h3>
                                <p><?php echo esc_html($value_description); ?></p>
                            </div>
                            <?php
                        endwhile;
                    else : // Fallback showcase values
                    ?>
                        <div class="showcase-value">
                            <div class="pixel-icon-medium">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-people.png'); ?>" alt="Building for People" class="pixel-icon-img">
                            </div>
                            <h3>Building for People</h3>
                            <p>Every brand we create centers around authentic human connection, creating virtual spaces where players feel welcome and valued.</p>
                        </div>
                        
                        <div class="showcase-value">
                            <div class="pixel-icon-medium">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-thrills.png'); ?>" alt="Brands Made of Thrills" class="pixel-icon-img">
                            </div>
                            <h3>Brands Made of Thrills</h3>
                            <p>We infuse excitement into every aspect of our brands, from visual design to user experience, ensuring players remain engaged and entertained.</p>
                        </div>
                        
                        <div class="showcase-value">
                            <div class="pixel-icon-medium">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-fun.png'); ?>" alt="Why So Serious?" class="pixel-icon-img">
                            </div>
                            <h3>Why So Serious?</h3>
                            <p>Our brands don't take themselves too seriously. We bring fun and playfulness to the forefront, creating relaxed environments where players can truly enjoy themselves.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="showcase-image">
                <?php if (function_exists('get_field') && get_field('brands_showcase_image')) : ?>
                    <img src="<?php echo esc_url(get_field('brands_showcase_image')); ?>" alt="Digital Taverna Brands Collage" class="pixel-image-large">
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/brands-collage.png'); ?>" alt="Digital Taverna Brands Collage" class="pixel-image-large">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2><?php echo esc_html(get_theme_mod('brands_cta_title', 'Ready to Create Your Own Exciting Brand?')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('brands_cta_text', 'Partner with Digital Taverna and let\'s craft a brand that stands out, connects with players, and drives business success.')); ?></p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="pixel-btn"><?php echo esc_html(get_theme_mod('brands_cta_button_text', 'Let\'s Build Your Brand')); ?></a>
        </div>
    </div>
</section>

<?php
get_footer();
