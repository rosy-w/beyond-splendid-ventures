<?php
/**
 * Beyond Splendid Ventures - Hello Elementor Child Theme functions and definitions
 *
 * @package Hello Elementor Child
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue parent and child theme styles and scripts
 */
function hello_elementor_child_enqueue_styles_scripts() {
    // Enqueue parent theme style
    wp_enqueue_style('hello-elementor', get_template_directory_uri() . '/style.css');
    
    // Enqueue child theme style
    wp_enqueue_style('hello-elementor-child-style', 
        get_stylesheet_directory_uri() . '/style.css', 
        array('hello-elementor'), 
        wp_get_theme()->get('Version')
    );
    
    // Enqueue custom styles
    wp_enqueue_style('hello-elementor-child-custom-style', 
        get_stylesheet_directory_uri() . '/custom-styles.css', 
        array('hello-elementor-child-style'), 
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap', 
        array(), 
        null
    );
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', 
        array(), 
        '5.15.3'
    );
    
    // Enqueue custom scripts
    wp_enqueue_script('hello-elementor-child-scripts', 
        get_stylesheet_directory_uri() . '/custom-scripts.js', 
        array('jquery'), 
        wp_get_theme()->get('Version'), 
        true
    );
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles_scripts');

/**
 * Include custom post types
 */
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';

/**
 * Include custom widgets
 */
require_once get_stylesheet_directory() . '/inc/widgets.php';

/**
 * Include theme customizer settings
 */
require_once get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Register custom navigation menus
 */
function hello_elementor_child_register_menus() {
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'hello-elementor-child'),
        'footer_menu' => __('Footer Menu', 'hello-elementor-child'),
        'destinations_menu' => __('Destinations Menu', 'hello-elementor-child'),
    ));
}
add_action('init', 'hello_elementor_child_register_menus');

/**
 * Register widget areas
 */
function hello_elementor_child_widgets_init() {
    register_sidebar(array(
        'name'          => __('Home Page Sidebar', 'hello-elementor-child'),
        'id'            => 'home-sidebar',
        'description'   => __('Add widgets for the home page sidebar here', 'hello-elementor-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Tour Page Sidebar', 'hello-elementor-child'),
        'id'            => 'tour-sidebar',
        'description'   => __('Add widgets for the tour page sidebar here', 'hello-elementor-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'hello-elementor-child'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets for the footer area 1 here', 'hello-elementor-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'hello-elementor-child'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets for the footer area 2 here', 'hello-elementor-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'hello-elementor-child'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets for the footer area 3 here', 'hello-elementor-child'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'hello_elementor_child_widgets_init');

/**
 * Add theme support
 */
function hello_elementor_child_theme_setup() {
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add image sizes
    add_image_size('tour-thumbnail', 600, 400, true);
    add_image_size('destination-thumbnail', 800, 500, true);
    add_image_size('hero-image', 1920, 800, true);
    
    // Add support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for full and wide align images
    add_theme_support('align-wide');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add Elementor support
    add_theme_support('elementor');
    add_theme_support('elementor-pro');
    add_theme_support('elementor-header-footer');
}
add_action('after_setup_theme', 'hello_elementor_child_theme_setup');

/**
 * Add custom body classes
 */
function hello_elementor_child_body_classes($classes) {
    // Add class if we're viewing the front page
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    // Add class for tour pages
    if (is_page_template('page-tours.php') || is_singular('tour')) {
        $classes[] = 'tour-page';
    }
    
    // Add class for destination pages
    if (is_page_template('page-destinations.php') || is_tax('destination_category')) {
        $classes[] = 'destination-page';
    }
    
    return $classes;
}
add_filter('body_class', 'hello_elementor_child_body_classes');

/**
 * Modify the excerpt length
 */
function hello_elementor_child_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'hello_elementor_child_excerpt_length');

/**
 * Modify the excerpt more text
 */
function hello_elementor_child_excerpt_more($more) {
    return '... <a class="read-more" href="' . get_permalink() . '">' . __('Read More', 'hello-elementor-child') . ' <i class="fas fa-arrow-right"></i></a>';
}
add_filter('excerpt_more', 'hello_elementor_child_excerpt_more');

/**
 * Register custom admin columns for Tours
 */
function elementary_child_tour_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __('Tour Name', 'elementary-child'),
        'image' => __('Featured Image', 'elementary-child'),
        'price' => __('Price', 'elementary-child'),
        'duration' => __('Duration', 'elementary-child'),
        'destination' => __('Destination', 'elementary-child'),
        'date' => $columns['date'],
    );
    return $columns;
}
add_filter('manage_tour_posts_columns', 'elementary_child_tour_columns');

/**
 * Display custom column content for Tours
 */
function elementary_child_tour_column_content($column, $post_id) {
    switch ($column) {
        case 'image':
            if (has_post_thumbnail($post_id)) {
                echo '<img src="' . get_the_post_thumbnail_url($post_id, 'thumbnail') . '" width="60" height="60" />';
            } else {
                echo '—';
            }
            break;
        case 'price':
            echo get_post_meta($post_id, 'tour_price', true) ? '$' . get_post_meta($post_id, 'tour_price', true) : '—';
            break;
        case 'duration':
            echo get_post_meta($post_id, 'tour_duration', true) ? get_post_meta($post_id, 'tour_duration', true) . ' days' : '—';
            break;
        case 'destination':
            $terms = get_the_terms($post_id, 'destination_category');
            if ($terms && !is_wp_error($terms)) {
                $destinations = array();
                foreach ($terms as $term) {
                    $destinations[] = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                }
                echo implode(', ', $destinations);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_tour_posts_custom_column', 'elementary_child_tour_column_content', 10, 2);

/**
 * Add SVG upload support
 */
function elementary_child_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'elementary_child_mime_types');
