<?php
/**
 * Plugin Name: BSV Elementor Widgets
 * Description: Custom Elementor widgets for Beyond Splendid Ventures - displays tours, destinations, and reviews.
 * Version: 1.0.0
 * Author: Beyond Splendid Ventures
 * Text Domain: bsv-elementor-widgets
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('BSV_ELEMENTOR_WIDGETS_URL', plugins_url('/', __FILE__));
define('BSV_ELEMENTOR_WIDGETS_PATH', plugin_dir_path(__FILE__));

/**
 * Main Plugin Class
 */
final class BSV_Elementor_Widgets {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Get Instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
        
        // Add compatibility check
        register_activation_hook(__FILE__, [$this, 'check_compatibility']);
    }

    /**
     * Check plugin compatibility on activation
     */
    public function check_compatibility() {
        // Check if Elementor is active
        if (!is_plugin_active('elementor/elementor.php')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(
                esc_html__('BSV Elementor Widgets requires Elementor to be installed and activated.', 'bsv-elementor-widgets'),
                esc_html__('Plugin Activation Error', 'bsv-elementor-widgets'),
                ['back_link' => true]
            );
        }
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Wait for Elementor to fully initialize
        add_action('elementor/init', [$this, 'elementor_init']);
    }

    /**
     * Initialize after Elementor is fully loaded
     */
    public function elementor_init() {
        // Add widget categories
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

        // Register styles and scripts
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'frontend_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'frontend_scripts']);
    }

    /**
     * Admin notice for minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'bsv-elementor-widgets'),
            '<strong>BSV Elementor Widgets</strong>',
            '<strong>PHP</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'bsv-elementor-widgets'),
            '<strong>BSV Elementor Widgets</strong>',
            '<strong>Elementor</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'bsv-elementor-widgets'),
            '<strong>BSV Elementor Widgets</strong>',
            '<strong>Elementor</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Add widget categories
     */
    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'beyond-splendid-ventures',
            [
                'title' => esc_html__('Beyond Splendid Ventures', 'bsv-elementor-widgets'),
                'icon' => 'fa fa-globe',
            ]
        );
    }

    /**
     * Register widgets
     */
    public function register_widgets() {
        // Ensure Elementor is fully loaded
        if (!class_exists('\Elementor\Plugin') || !did_action('elementor/loaded')) {
            return;
        }

        // Include widget files with error handling
        $widget_files = [
            'tours-widget.php',
            'destinations-widget.php',
            'testimonials-widget.php',
            'unified-search-widget.php'
        ];

        foreach ($widget_files as $file) {
            $file_path = BSV_ELEMENTOR_WIDGETS_PATH . 'widgets/' . $file;
            if (file_exists($file_path)) {
                try {
                    require_once $file_path;
                } catch (Exception $e) {
                    error_log('BSV Elementor Widgets - Error loading widget file ' . $file . ': ' . $e->getMessage());
                    continue;
                }
            }
        }

        // Register widgets with improved error handling
        $widgets = [
            'BSV_Tours_Widget',
            'BSV_Destinations_Widget', 
            'BSV_Testimonials_Widget',
            'BSV_Unified_Search_Widget'
        ];

        foreach ($widgets as $widget_class) {
            try {
                if (class_exists($widget_class)) {
                    $widget_instance = new $widget_class();
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type($widget_instance);
                }
            } catch (Exception $e) {
                error_log('BSV Elementor Widgets - Error registering widget ' . $widget_class . ': ' . $e->getMessage());
            }
        }
    }

    /**
     * Frontend styles
     */
    public function frontend_styles() {
        wp_enqueue_style(
            'bsv-elementor-widgets-css',
            BSV_ELEMENTOR_WIDGETS_URL . 'assets/css/bsv-elementor-widgets.css',
            [],
            self::VERSION
        );
    }

    /**
     * Frontend scripts
     */
    public function frontend_scripts() {
        wp_register_script(
            'bsv-elementor-widgets-js',
            BSV_ELEMENTOR_WIDGETS_URL . 'assets/js/bsv-elementor-widgets.js',
            ['jquery'],
            self::VERSION,
            true
        );
        
        // Enqueue the main script
        wp_enqueue_script('bsv-elementor-widgets-js');
    }
}

// Initialize the plugin
BSV_Elementor_Widgets::instance();