<?php
/**
 * Tours Widget for Elementor
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class BSV_Tours_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'bsv_tours';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('BSV Tours', 'bsv-elementor-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-map-pin';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['beyond-splendid-ventures'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['tours', 'travel', 'bsv', 'beyond splendid ventures'];
    }

    /**
     * Register widget controls
     */
    protected function _register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Popular Tours', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your title', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Discover our popular tours and start your adventure today.', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your subtitle', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'number_of_tours',
            [
                'label' => esc_html__('Number of Tours', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__('1', 'bsv-elementor-widgets'),
                    '2' => esc_html__('2', 'bsv-elementor-widgets'),
                    '3' => esc_html__('3', 'bsv-elementor-widgets'),
                    '4' => esc_html__('4', 'bsv-elementor-widgets'),
                ],
            ]
        );

        $this->add_control(
            'show_featured_only',
            [
                'label' => esc_html__('Show Featured Tours Only', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'tour_categories',
            [
                'label' => esc_html__('Tour Categories', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_tour_categories(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'enable_pagination',
            [
                'label' => esc_html__('Enable Pagination', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'show_view_all',
            [
                'label' => esc_html__('Show "View All" Button', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'view_all_text',
            [
                'label' => esc_html__('View All Text', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View All Tours', 'bsv-elementor-widgets'),
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'view_all_url',
            [
                'label' => esc_html__('View All URL', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'bsv-elementor-widgets'),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Title & Subtitle
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title & Subtitle', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tours-title' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bsv-tours-title',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tours-subtitle' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .bsv-tours-subtitle',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__('Alignment', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'bsv-elementor-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bsv-elementor-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bsv-elementor-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .bsv-section-header' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_spacing',
            [
                'label' => esc_html__('Header Bottom Spacing', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-section-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Tour Cards
        $this->start_controls_section(
            'section_cards_style',
            [
                'label' => esc_html__('Tour Cards', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .bsv-tour-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .bsv-tour-card',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .bsv-tour-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
                ],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'card_spacing',
            [
                'label' => esc_html__('Card Spacing', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bsv-tour-card-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label' => esc_html__('Card Background', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-details' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label' => esc_html__('Card Content Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'tour_title_color',
            [
                'label' => esc_html__('Tour Title Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-title' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tour_title_typography',
                'selector' => '{{WRAPPER}} .bsv-tour-title',
            ]
        );

        $this->add_control(
            'tour_desc_color',
            [
                'label' => esc_html__('Tour Description Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-description' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tour_desc_typography',
                'selector' => '{{WRAPPER}} .bsv-tour-description',
            ]
        );

        $this->add_control(
            'price_badge_bg_color',
            [
                'label' => esc_html__('Price Badge Background', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-price' => 'background-color: {{VALUE}};',
                ],
                'default' => '#1a73e8',
            ]
        );

        $this->add_control(
            'price_badge_text_color',
            [
                'label' => esc_html__('Price Badge Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-price' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'featured_badge_bg_color',
            [
                'label' => esc_html__('Featured Badge Background', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-featured-badge' => 'background-color: {{VALUE}};',
                ],
                'default' => '#fbbc05',
            ]
        );

        $this->add_control(
            'featured_badge_text_color',
            [
                'label' => esc_html__('Featured Badge Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-featured-badge' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->end_controls_section();

        // Button Style Section
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Buttons', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label' => esc_html__('Tour Button', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Normal', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button' => 'background-color: {{VALUE}};',
                ],
                'default' => '#1a73e8',
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Hover', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#34a853',
            ]
        );

        $this->add_control(
            'button_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bsv-tour-button',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-tour-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 8,
                    'right' => 20,
                    'bottom' => 8,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'view_all_heading',
            [
                'label' => esc_html__('View All Button', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs(
            'view_all_style_tabs',
            [
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->start_controls_tab(
            'view_all_normal_tab',
            [
                'label' => esc_html__('Normal', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'view_all_bg_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button' => 'background-color: {{VALUE}};',
                ],
                'default' => '#1a73e8',
            ]
        );

        $this->add_control(
            'view_all_text_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'view_all_hover_tab',
            [
                'label' => esc_html__('Hover', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'view_all_bg_hover_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#34a853',
            ]
        );

        $this->add_control(
            'view_all_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'view_all_typography',
                'selector' => '{{WRAPPER}} .bsv-view-all-button',
                'separator' => 'before',
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'view_all_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'view_all_padding',
            [
                'label' => esc_html__('Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 12,
                    'right' => 30,
                    'bottom' => 12,
                    'left' => 30,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'view_all_margin_top',
            [
                'label' => esc_html__('View All Top Margin', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-view-all-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_view_all' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get tour categories
     */
    private function get_tour_categories() {
        $categories = array();
        
        // Get terms
        $terms = get_terms(array(
            'taxonomy' => 'tour_category',
            'hide_empty' => false,
        ));
        
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $categories[$term->slug] = $term->name;
            }
        }
        
        return $categories;
    }

    /**
     * Render widget output
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // Handle pagination
        $paged = max(1, get_query_var('paged') ?: (get_query_var('page') ?: 1));
        
        // Query args
        $args = array(
            'post_type' => 'tour',
            //'posts_per_page' => $settings['number_of_tours'],
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        );
         // Set posts per page based on pagination setting
        if ($settings['enable_pagination'] === 'yes') {
            $args['posts_per_page'] = $settings['number_of_tours'];
            $args['paged'] = $paged;
        } else {
            // If pagination is disabled, respect the number of tours setting
            $args['posts_per_page'] = $settings['number_of_tours'];
            $args['no_found_rows'] = true; // Optimize query when not paginating
        }
        
        // Add featured filter
        if ($settings['show_featured_only'] === 'yes') {
            $args['meta_query'] = array(
                array(
                    'key'     => 'tour_featured',
                    'value'   => '1',
                    'compare' => '=',
                ),
            );
        }
        
        // Add category filter
        if (!empty($settings['tour_categories'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'tour_category',
                    'field'    => 'slug',
                    'terms'    => $settings['tour_categories'],
                ),
            );
        }

        // Column classes
        $column_class = 'col-md-4';
        switch ($settings['columns']) {
            case '1':
                $column_class = 'col-md-12';
                break;
            case '2':
                $column_class = 'col-md-6';
                break;
            case '3':
                $column_class = 'col-md-4';
                break;
            case '4':
                $column_class = 'col-md-3';
                break;
        }
        
        // Get tours
        $tours = new WP_Query($args);
        ?>
        
        <div class="bsv-tours-widget">
            <?php if (!empty($settings['title']) || !empty($settings['subtitle'])) : ?>
                <div class="bsv-section-header">
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="bsv-tours-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="bsv-tours-title"><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>
                    
                </div>
            <?php endif; ?>
            
            <div class="bsv-tours-container">
                <div class="row g-4">
                    <?php
                    $column_class = 'col-xl-4 col-lg-4 col-md-6 col-sm-12'; // More specific column classes
                    $counter = 0;
                    if ($tours->have_posts()) :
                        while ($tours->have_posts()) : $tours->the_post();
                            // Get tour meta
                            $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                            $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                            $tour_group_size = get_post_meta(get_the_ID(), 'tour_group_size', true);
                            $tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
                            $tour_featured = get_post_meta(get_the_ID(), 'tour_featured', true);
                            $tour_excerpt = wp_trim_words(get_the_excerpt(), 20);
                            
                            // Feature image
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                            if (!$image_url) {
                                $image_url = BSV_ELEMENTOR_WIDGETS_URL . 'assets/images/placeholder.svg';
                            }
                            ?>
                            
                            <div class="<?php echo esc_attr($column_class); ?> bsv-tour-card-wrapper">
                                <?php include(BSV_ELEMENTOR_WIDGETS_PATH . 'templates/tour-card.php'); ?>

                            </div>
                            
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <div class="col-12">
                            <p><?php echo esc_html__('No tours found.', 'bsv-elementor-widgets'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($settings['show_view_all'] === 'yes' && !empty($settings['view_all_url']['url'])) : ?>
                    <div class="bsv-view-all-button-wrapper text-center">
                        <a href="<?php echo esc_url($settings['view_all_url']['url']); ?>" 
                           class="bsv-view-all-button"
                           <?php echo $settings['view_all_url']['is_external'] ? ' target="_blank"' : ''; ?>
                           <?php echo $settings['view_all_url']['nofollow'] ? ' rel="nofollow"' : ''; ?>>
                            <?php echo esc_html($settings['view_all_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Pagination - Only show if enabled and needed-->
            <?php if ($settings['enable_pagination'] === 'yes' && $tours->max_num_pages > 1) : ?>
                <div class="bsv-tours-pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => $paged,
                        'total' => $tours->max_num_pages,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}