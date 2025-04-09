<?php
/**
 * Digital Taverna functions and definitions
 *
 * @package Digital_Taverna
 */

function digitaltaverna_setup() {
    // Theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'digital-taverna'),
        'footer-menu' => __('Footer Menu', 'digital-taverna'),
    ));
}
add_action('after_setup_theme', 'digitaltaverna_setup');

function digitaltaverna_scripts() {
    // Enqueue styles
    wp_enqueue_style('digital-taverna-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue scripts
    wp_enqueue_script('digital-taverna-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'digitaltaverna_scripts');

/**
 * Register Custom Post Types
 */

// Services CPT
function digitaltaverna_register_services_cpt() {
    $labels = array(
        'name'               => _x('Services', 'post type general name', 'digitaltaverna'),
        'singular_name'      => _x('Service', 'post type singular name', 'digitaltaverna'),
        'menu_name'          => _x('Services', 'admin menu', 'digitaltaverna'),
        'name_admin_bar'     => _x('Service', 'add new on admin bar', 'digitaltaverna'),
        'add_new'            => _x('Add New', 'service', 'digitaltaverna'),
        'add_new_item'       => __('Add New Service', 'digitaltaverna'),
        'new_item'           => __('New Service', 'digitaltaverna'),
        'edit_item'          => __('Edit Service', 'digitaltaverna'),
        'view_item'          => __('View Service', 'digitaltaverna'),
        'all_items'          => __('All Services', 'digitaltaverna'),
        'search_items'       => __('Search Services', 'digitaltaverna'),
        'parent_item_colon'  => __('Parent Services:', 'digitaltaverna'),
        'not_found'          => __('No services found.', 'digitaltaverna'),
        'not_found_in_trash' => __('No services found in Trash.', 'digitaltaverna')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Digital Taverna Services', 'digitaltaverna'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'service'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    register_post_type('service', $args);
}
add_action('init', 'digitaltaverna_register_services_cpt');

// Brands CPT
function digitaltaverna_register_brands_cpt() {
    $labels = array(
        'name'               => _x('Brands', 'post type general name', 'digitaltaverna'),
        'singular_name'      => _x('Brand', 'post type singular name', 'digitaltaverna'),
        'menu_name'          => _x('Brands', 'admin menu', 'digitaltaverna'),
        'name_admin_bar'     => _x('Brand', 'add new on admin bar', 'digitaltaverna'),
        'add_new'            => _x('Add New', 'brand', 'digitaltaverna'),
        'add_new_item'       => __('Add New Brand', 'digitaltaverna'),
        'new_item'           => __('New Brand', 'digitaltaverna'),
        'edit_item'          => __('Edit Brand', 'digitaltaverna'),
        'view_item'          => __('View Brand', 'digitaltaverna'),
        'all_items'          => __('All Brands', 'digitaltaverna'),
        'search_items'       => __('Search Brands', 'digitaltaverna'),
        'parent_item_colon'  => __('Parent Brands:', 'digitaltaverna'),
        'not_found'          => __('No brands found.', 'digitaltaverna'),
        'not_found_in_trash' => __('No brands found in Trash.', 'digitaltaverna')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Digital Taverna Brand Portfolio', 'digitaltaverna'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'brand'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt')
    );

    register_post_type('brand', $args);
}
add_action('init', 'digitaltaverna_register_brands_cpt');

/**
 * Register Team Member CPT
 */
function digitaltaverna_register_team_cpt() {
    $labels = array(
        'name'               => _x('Team Members', 'post type general name', 'digitaltaverna'),
        'singular_name'      => _x('Team Member', 'post type singular name', 'digitaltaverna'),
        'menu_name'          => _x('Team', 'admin menu', 'digitaltaverna'),
        'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'digitaltaverna'),
        'add_new'            => _x('Add New', 'team member', 'digitaltaverna'),
        'add_new_item'       => __('Add New Team Member', 'digitaltaverna'),
        'new_item'           => __('New Team Member', 'digitaltaverna'),
        'edit_item'          => __('Edit Team Member', 'digitaltaverna'),
        'view_item'          => __('View Team Member', 'digitaltaverna'),
        'all_items'          => __('All Team Members', 'digitaltaverna'),
        'search_items'       => __('Search Team Members', 'digitaltaverna'),
        'parent_item_colon'  => __('Parent Team Members:', 'digitaltaverna'),
        'not_found'          => __('No team members found.', 'digitaltaverna'),
        'not_found_in_trash' => __('No team members found in Trash.', 'digitaltaverna')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Digital Taverna Team Members', 'digitaltaverna'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'team'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title', 'editor', 'thumbnail')
    );

    register_post_type('team', $args);
}
add_action('init', 'digitaltaverna_register_team_cpt');

/**
 * Theme Customizer Settings
 */
function digitaltaverna_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('contact_info', array(
        'title'       => __('Contact Information', 'digitaltaverna'),
        'description' => __('Update your contact information here.', 'digitaltaverna'),
        'priority'    => 30,
    ));
    
    // Email
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'info@digitaltaverna.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'   => __('Email Address', 'digitaltaverna'),
        'section' => 'contact_info',
        'type'    => 'email',
    ));
    
    // Phone
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+1 (123) 456-7890',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'   => __('Phone Number', 'digitaltaverna'),
        'section' => 'contact_info',
        'type'    => 'text',
    ));
    
    // Footer Section
    $wp_customize->add_section('footer_settings', array(
        'title'       => __('Footer Settings', 'digitaltaverna'),
        'description' => __('Customize your footer content here.', 'digitaltaverna'),
        'priority'    => 90,
    ));
    
    // Footer Tagline
    $wp_customize->add_setting('footer_tagline', array(
        'default'           => 'Building excitement for people in the digital world.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('footer_tagline', array(
        'label'   => __('Footer Tagline', 'digitaltaverna'),
        'section' => 'footer_settings',
        'type'    => 'text',
    ));
    
    // Copyright Text
    $wp_customize->add_setting('copyright_text', array(
        'default'           => '&copy; ' . date('Y') . ' Digital Taverna Ltd. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('copyright_text', array(
        'label'   => __('Copyright Text', 'digitaltaverna'),
        'section' => 'footer_settings',
        'type'    => 'textarea',
    ));
    
    // Homepage Settings
    $wp_customize->add_section('homepage_settings', array(
        'title'       => __('Homepage Settings', 'digitaltaverna'),
        'description' => __('Customize your homepage content here.', 'digitaltaverna'),
        'priority'    => 120,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Digital Taverna',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'digitaltaverna'),
        'section' => 'homepage_settings',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => '"A physical taverna is a building that houses excited people, and in the digital taverna - we are building excitement for people."',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'digitaltaverna'),
        'section' => 'homepage_settings',
        'type'    => 'textarea',
    ));
    
    // Hero Button Text
    $wp_customize->add_setting('hero_button_text', array(
        'default'           => 'Let\'s Build Something Great',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_button_text', array(
        'label'   => __('Hero Button Text', 'digitaltaverna'),
        'section' => 'homepage_settings',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'digitaltaverna_customize_register');

/**
 * Process Contact Form Submission
 */
function digitaltaverna_process_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_send_json_error('Security check failed');
    }
    
    // Sanitize form data
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $service = isset($_POST['service']) ? sanitize_text_field($_POST['service']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields');
    }
    
    // Set up email
    $to = get_option('admin_email');
    $subject = 'Contact Form Submission from ' . $name;
    
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    
    if (!empty($company)) {
        $body .= "Company: $company\n";
    }
    
    if (!empty($service)) {
        $body .= "Service Interest: $service\n";
    }
    
    $body .= "\nMessage:\n$message";
    
    $headers = array(
        'From: ' . get_bloginfo('name') . ' <' . $to . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );
    
    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        // Log the submission if desired
        // log_contact_form_submission($name, $email, $company, $service, $message);
        
        wp_send_json_success('Thank you for your message! We will get back to you soon.');
    } else {
        wp_send_json_error('There was a problem sending your message. Please try again later.');
    }
}
add_action('wp_ajax_digitaltaverna_process_contact_form', 'digitaltaverna_process_contact_form');
add_action('wp_ajax_nopriv_digitaltaverna_process_contact_form', 'digitaltaverna_process_contact_form');

/**
 * Custom Menu Walker for Primary Menu
 */
class Digital_Taverna_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<li>';
        
        $attributes = '';
        
        if (!empty($item->attr_title)) {
            $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        }
        if (!empty($item->target)) {
            $attributes .= ' target="' . esc_attr($item->target) . '"';
        }
        if (!empty($item->xfn)) {
            $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        }
        if (!empty($item->url)) {
            $attributes .= ' href="' . esc_attr($item->url) . '"';
        }
        
        // Check if current page
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        
        if (in_array('current-menu-item', $classes)) {
            $output .= '<a class="active"' . $attributes . '>';
        } else {
            $output .= '<a' . $attributes . '>';
        }
        
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }
}

/**
 * Custom function to get menu items with proper classes
 */
function digitaltaverna_get_menu_items($menu_location) {
    $locations = get_nav_menu_locations();
    
    if (isset($locations[$menu_location])) {
        $menu = wp_get_nav_menu_object($locations[$menu_location]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        
        return $menu_items;
    }
    
    return array();
}

/**
 * Add ACF plugin recommendation
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

function digitaltaverna_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => false,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
    );

    $config = array(
        'id'           => 'digitaltaverna',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgm_plugin_activation($plugins, $config);
}
add_action('tgmpa_register', 'digitaltaverna_register_required_plugins');
