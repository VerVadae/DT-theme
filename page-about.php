<?php
/**
 * Template Name: About Page
 *
 * The template for displaying the about page
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- About Hero -->
<section class="page-hero about-hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php the_title(); ?></h1>
        <?php if (function_exists('get_field')) : ?>
            <p><?php echo esc_html(get_field('about_subtitle')); ?></p>
        <?php else : ?>
            <p>Get to know the keepers of the Digital Taverna</p>
        <?php endif; ?>
    </div>
</section>

<!-- About Digital Taverna -->
<section class="about-detailed">
    <div class="container">
        <div class="about-company">
            <div class="about-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', array('class' => 'pixel-image-large', 'alt' => get_the_title())); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/tavern-interior.png'); ?>" alt="Digital Taverna Concept" class="pixel-image-large">
                <?php endif; ?>
            </div>
            <div class="about-company-text">
                <?php if (function_exists('get_field')) : ?>
                    <h2><?php echo esc_html(get_field('about_heading')); ?></h2>
                    <?php echo wp_kses_post(get_field('about_content')); ?>
                <?php else : ?>
                    <h2>What is Digital Taverna?</h2>
                    <?php the_content(); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mission and Vision -->
        <div class="mission-vision">
            <?php if (function_exists('get_field')) : ?>
                <div class="mission-vision-item">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_field('mission_icon') ? get_field('mission_icon') : get_template_directory_uri() . '/img/icon-mission.png'); ?>" alt="Mission Icon">
                    </div>
                    <h3><?php echo esc_html(get_field('mission_title')); ?></h3>
                    <p><?php echo esc_html(get_field('mission_text')); ?></p>
                </div>
                <div class="mission-vision-item">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_field('vision_icon') ? get_field('vision_icon') : get_template_directory_uri() . '/img/icon-vision.png'); ?>" alt="Vision Icon">
                    </div>
                    <h3><?php echo esc_html(get_field('vision_title')); ?></h3>
                    <p><?php echo esc_html(get_field('vision_text')); ?></p>
                </div>
            <?php else : ?>
                <div class="mission-vision-item">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-mission.png'); ?>" alt="Mission Icon">
                    </div>
                    <h3>Our Mission</h3>
                    <p>We build brands that bring the fun, cut the nonsense, and put people first. It's all about thrills, simplicity, and keeping things real.</p>
                </div>
                <div class="mission-vision-item">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-vision.png'); ?>" alt="Vision Icon">
                    </div>
                    <h3>Our Vision</h3>
                    <p>We're here to reshape the way brands connect with real people, creating experiences packed with thrills, authenticity, and absolutely no unnecessary seriousness.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Core Values Section -->
        <div class="core-values">
            <h2>Our Values</h2>
            <div class="values-grid">
                <?php
                // If ACF is active, use custom fields for values
                if (function_exists('get_field') && have_rows('values')) :
                    while (have_rows('values')) : the_row();
                        $value_number = get_row_index();
                        $value_title = get_sub_field('value_title');
                        $value_icon = get_sub_field('value_icon');
                        $value_description = get_sub_field('value_description');
                        ?>
                        <div class="value-item">
                            <div class="pixel-icon-medium">
                                <img src="<?php echo esc_url($value_icon ? $value_icon : get_template_directory_uri() . '/img/icon-default.png'); ?>" alt="<?php echo esc_attr($value_title); ?>">
                            </div>
                            <h3><?php echo esc_html($value_number) . '. ' . esc_html($value_title); ?></h3>
                            <p><?php echo esc_html($value_description); ?></p>
                        </div>
                        <?php
                    endwhile;
                else : // Fallback to hardcoded values
                ?>
                    <div class="value-item">
                        <div class="pixel-icon-medium">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-people.png'); ?>" alt="Building for People">
                        </div>
                        <h3>1. Building for People</h3>
                        <p>At the core of the brands we build is a commitment to people. The goal of our gambling experiences is to mirror the welcoming environment of a taverna. We craft experiences where players feel at home, engaged, and valued.</p>
                    </div>
                    <div class="value-item">
                        <div class="pixel-icon-medium">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-thrills.png'); ?>" alt="Brands Made of Thrills">
                        </div>
                        <h3>2. Brands Made of Thrills</h3>
                        <p>By infusing the spirited atmosphere of a taverna into our brands, we amplify these thrills. Players aren't just engaging with a game; they're part of a collective excitement that a taverna embodies. Our job as the keepers of the taverna is to always give our patrons more excitement than they arrived with.</p>
                    </div>
                    <div class="value-item">
                        <div class="pixel-icon-medium">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-fun.png'); ?>" alt="Why So Serious?">
                        </div>
                        <h3>3. Why So Serious?</h3>
                        <p>Seriousness has no business in a taverna, and the digital taverna will not make seriousness into a business. We strip away unnecessary formalities. Our brands encourage players to enjoy themselves, share a laugh, and not take things too seriously—just like friends gathering over drinks in their favorite local spot.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
