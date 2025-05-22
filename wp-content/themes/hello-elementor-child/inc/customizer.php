<?php
/**
 * Theme Customizer settings for Beyond Splendid Ventures
 *
 * @package Hello Elementor Child
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Theme Customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hello_elementor_child_customize_register($wp_customize) {
    
    // Add section for contact information
    $wp_customize->add_section('hello_elementor_child_contact_info', array(
        'title' => __('Contact Information', 'hello-elementor-child'),
        'description' => __('Add your contact information here.', 'hello-elementor-child'),
        'priority' => 160,
    ));
    
    // Phone Number
    $wp_customize->add_setting('hello_elementor_child_phone', array(
        'default' => '+1 (800) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hello_elementor_child_phone', array(
        'label' => __('Phone Number', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_contact_info',
        'type' => 'text',
    ));
    
    // Email Address
    $wp_customize->add_setting('hello_elementor_child_email', array(
        'default' => 'info@beyondsplendidventures.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('hello_elementor_child_email', array(
        'label' => __('Email Address', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_contact_info',
        'type' => 'email',
    ));
    
    // Address
    $wp_customize->add_setting('hello_elementor_child_address', array(
        'default' => '123 Adventure Street, Traveler City, TC 10001',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hello_elementor_child_address', array(
        'label' => __('Address', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_contact_info',
        'type' => 'textarea',
    ));
    
    // Add section for social media profiles
    $wp_customize->add_section('hello_elementor_child_social_media', array(
        'title' => __('Social Media', 'hello-elementor-child'),
        'description' => __('Add your social media profile URLs here.', 'hello-elementor-child'),
        'priority' => 165,
    ));
    
    // Facebook URL
    $wp_customize->add_setting('hello_elementor_child_facebook', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hello_elementor_child_facebook', array(
        'label' => __('Facebook URL', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_social_media',
        'type' => 'url',
    ));
    
    // Twitter URL
    $wp_customize->add_setting('hello_elementor_child_twitter', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hello_elementor_child_twitter', array(
        'label' => __('Twitter URL', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_social_media',
        'type' => 'url',
    ));
    
    // Instagram URL
    $wp_customize->add_setting('hello_elementor_child_instagram', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hello_elementor_child_instagram', array(
        'label' => __('Instagram URL', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_social_media',
        'type' => 'url',
    ));
    
    // LinkedIn URL
    $wp_customize->add_setting('hello_elementor_child_linkedin', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hello_elementor_child_linkedin', array(
        'label' => __('LinkedIn URL', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_social_media',
        'type' => 'url',
    ));
    
    // YouTube URL
    $wp_customize->add_setting('hello_elementor_child_youtube', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hello_elementor_child_youtube', array(
        'label' => __('YouTube URL', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_social_media',
        'type' => 'url',
    ));
    
    // Add section for color scheme
    $wp_customize->add_section('hello_elementor_child_colors', array(
        'title' => __('Color Scheme', 'hello-elementor-child'),
        'description' => __('Customize your theme colors. Note: These may be overridden by Elementor settings.', 'hello-elementor-child'),
        'priority' => 140,
    ));
    
    // Primary Color
    $wp_customize->add_setting('hello_elementor_child_primary_color', array(
        'default' => '#1a73e8',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hello_elementor_child_primary_color', array(
        'label' => __('Primary Color', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_colors',
    )));
    
    // Secondary Color
    $wp_customize->add_setting('hello_elementor_child_secondary_color', array(
        'default' => '#34a853',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hello_elementor_child_secondary_color', array(
        'label' => __('Secondary Color', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_colors',
    )));
    
    // Accent Color
    $wp_customize->add_setting('hello_elementor_child_accent_color', array(
        'default' => '#fbbc05',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hello_elementor_child_accent_color', array(
        'label' => __('Accent Color', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_colors',
    )));
    
    // Footer Background Color
    $wp_customize->add_setting('hello_elementor_child_footer_bg_color', array(
        'default' => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hello_elementor_child_footer_bg_color', array(
        'label' => __('Footer Background Color', 'hello-elementor-child'),
        'section' => 'hello_elementor_child_colors',
    )));
}
add_action('customize_register', 'hello_elementor_child_customize_register');

/**
 * Output custom CSS based on customizer settings
 */
function hello_elementor_child_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr(get_theme_mod('hello_elementor_child_primary_color', '#1a73e8')); ?>;
            --secondary-color: <?php echo esc_attr(get_theme_mod('hello_elementor_child_secondary_color', '#34a853')); ?>;
            --accent-color: <?php echo esc_attr(get_theme_mod('hello_elementor_child_accent_color', '#fbbc05')); ?>;
        }
        
        .site-footer {
            background-color: <?php echo esc_attr(get_theme_mod('hello_elementor_child_footer_bg_color', '#222222')); ?>;
        }
        
        .btn-primary, .elementor-button {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover, .elementor-button:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        a {
            color: var(--primary-color);
        }
        
        a:hover {
            color: var(--secondary-color);
        }
        
        .footer-contact-icon {
            color: var(--primary-color);
        }
        
        .footer-social-link:hover {
            background-color: var(--primary-color);
        }
        
        .tour-price {
            background-color: var(--primary-color);
        }
        
        .featured-badge {
            background-color: var(--accent-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'hello_elementor_child_customizer_css');

/**
 * Get customizer value
 *
 * @param string $setting Setting name
 * @param mixed $default Default value
 * @return mixed Value or default
 */
function hello_elementor_child_get_option($setting, $default = '') {
    return get_theme_mod($setting, $default);
}