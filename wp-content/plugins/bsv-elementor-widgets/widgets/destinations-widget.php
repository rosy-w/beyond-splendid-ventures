<?php
/**
 * Destinations Widget for Elementor
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class BSV_Destinations_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'bsv_destinations';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('BSV Destinations', 'bsv-elementor-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-globe';
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
        return ['destinations', 'locations', 'travel', 'bsv', 'beyond splendid ventures'];
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
                'default' => esc_html__('Popular Destinations', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your title', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Explore our most popular destinations around the world.', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your subtitle', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'number_of_destinations',
            [
                'label' => esc_html__('Number of Destinations', 'bsv-elementor-widgets'),
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
                'label' => esc_html__('Show Featured Destinations Only', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'destination_categories',
            [
                'label' => esc_html__('Destination Categories', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_destination_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'destination_continents',
            [
                'label' => esc_html__('Continents', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_destination_continents(),
                'multiple' => true,
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
                'default' => esc_html__('View All Destinations', 'bsv-elementor-widgets'),
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

        $this->end_controls_section();

        // Layout & Design Options
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'card_layout',
            [
                'label' => esc_html__('Card Layout', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => esc_html__('Text Overlay', 'bsv-elementor-widgets'),
                    'below' => esc_html__('Text Below Image', 'bsv-elementor-widgets'),
                ],
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-overlay' => 'opacity: calc({{SIZE}} / 100);',
                ],
                'condition' => [
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_description',
            [
                'label' => esc_html__('Show Description', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'description_length',
            [
                'label' => esc_html__('Description Length (words)', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 50,
                'step' => 1,
                'default' => 15,
                'condition' => [
                    'show_description' => 'yes',
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
                    '{{WRAPPER}} .bsv-destinations-title' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bsv-destinations-title',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destinations-subtitle' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .bsv-destinations-subtitle',
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

        // Style Section for Destination Cards
        $this->start_controls_section(
            'section_cards_style',
            [
                'label' => esc_html__('Destination Cards', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .bsv-destination-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .bsv-destination-card',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .bsv-destination-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
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
                    '{{WRAPPER}} .bsv-destination-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bsv-destination-card-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label' => esc_html__('Card Background', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-details' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'card_layout' => 'below',
                ],
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-overlay' => 'background-color: {{VALUE}};',
                ],
                'default' => '#000000',
                'condition' => [
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_control(
            'card_padding',
            [
                'label' => esc_html__('Card Content Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'condition' => [
                    'card_layout' => 'below',
                ],
            ]
        );

        $this->add_control(
            'overlay_padding',
            [
                'label' => esc_html__('Overlay Content Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-content-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'condition' => [
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_control(
            'destination_title_color',
            [
                'label' => esc_html__('Destination Title Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-title, {{WRAPPER}} .bsv-destination-title a' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
                'condition' => [
                    'card_layout' => 'below',
                ],
            ]
        );

        $this->add_control(
            'overlay_title_color',
            [
                'label' => esc_html__('Overlay Title Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-content-overlay .bsv-destination-title, {{WRAPPER}} .bsv-destination-content-overlay .bsv-destination-title a' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'destination_title_typography',
                'selector' => '{{WRAPPER}} .bsv-destination-title',
            ]
        );

        $this->add_control(
            'destination_desc_color',
            [
                'label' => esc_html__('Description Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-description' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
                'condition' => [
                    'show_description' => 'yes',
                    'card_layout' => 'below',
                ],
            ]
        );

        $this->add_control(
            'overlay_desc_color',
            [
                'label' => esc_html__('Overlay Description Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-content-overlay .bsv-destination-description' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'show_description' => 'yes',
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'destination_desc_typography',
                'selector' => '{{WRAPPER}} .bsv-destination-description',
                'condition' => [
                    'show_description' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'location_color',
            [
                'label' => esc_html__('Location Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-location' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
                'condition' => [
                    'card_layout' => 'below',
                ],
            ]
        );

        $this->add_control(
            'overlay_location_color',
            [
                'label' => esc_html__('Overlay Location Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-destination-content-overlay .bsv-destination-location' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'card_layout' => 'overlay',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'location_typography',
                'selector' => '{{WRAPPER}} .bsv-destination-location',
            ]
        );

        $this->end_controls_section();

        // Button Style Section
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Button', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_view_all' => 'yes',
                ],
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
                    '{{WRAPPER}} .bsv-view-all-button' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bsv-view-all-button' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .bsv-view-all-button:hover' => 'background-color: {{VALUE}};',
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
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bsv-view-all-button',
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
            ]
        );

        $this->add_control(
            'button_padding',
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
            ]
        );

        $this->add_responsive_control(
            'button_margin_top',
            [
                'label' => esc_html__('Top Margin', 'bsv-elementor-widgets'),
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
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get destination categories
     */
    private function get_destination_categories() {
        $categories = array();
        
        // Get terms
        $terms = get_terms(array(
            'taxonomy' => 'destination_category',
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
     * Get destination continents
     */
    private function get_destination_continents() {
        $continents = array();
        
        // Get terms
        $terms = get_terms(array(
            'taxonomy' => 'destination_continent',
            'hide_empty' => false,
        ));
        
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $continents[$term->slug] = $term->name;
            }
        }
        
        return $continents;
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
        'post_type' => 'destination',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
     // Set posts per page based on pagination setting
    if ($settings['enable_pagination'] === 'yes') {
        $args['posts_per_page'] = $settings['number_of_destinations'];
        $args['paged'] = $paged;
    } else {
        // If pagination is disabled, respect the number of destinations setting
        $args['posts_per_page'] = $settings['number_of_destinations'];
        $args['no_found_rows'] = true; // Optimize query when not paginating
    }
        // Add featured filter
        if ($settings['show_featured_only'] === 'yes') {
            $args['meta_query'] = array(
                array(
                    'key'     => 'featured_destination',
                    'value'   => '1',
                    'compare' => '=',
                ),
            );
        }
        
        // Add category filter
        if (!empty($settings['destination_categories'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'destination_category',
                'field'    => 'slug',
                'terms'    => $settings['destination_categories'],
            );
        }
        
        // Add continent filter
        if (!empty($settings['destination_continents'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'destination_continent',
                'field'    => 'slug',
                'terms'    => $settings['destination_continents'],
            );
        }

        // Multiple taxonomies need an AND relation
        if (!empty($settings['destination_categories']) && !empty($settings['destination_continents'])) {
            $args['tax_query']['relation'] = 'AND';
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
        
        // Get destinations
        $destinations = new WP_Query($args);
        ?>
        
        <div class="bsv-destinations-widget">
            <?php if (!empty($settings['title']) || !empty($settings['subtitle'])) : ?>
                <div class="bsv-section-header">
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="bsv-destinations-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="bsv-destinations-title"><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="bsv-destinations-container">
                <div class="row g-3 justify-content-start"> <!-- Added gutter spacing with g-4 -->
                    <?php
                    $column_class = 'col-xl-3 col-lg-3 col-md-6 col-sm-6'; // More specific column classes
                    $counter = 0;
                    
                    if ($destinations->have_posts()) :
                        while ($destinations->have_posts()) : $destinations->the_post();
                            $counter++;
                            // Get destination meta
                            $destination_location = get_post_meta(get_the_ID(), 'destination_location', true);
                            $destination_excerpt = $settings['show_description'] === 'yes' ? wp_trim_words(get_the_excerpt(), $settings['description_length']) : '';
                            
                            // Feature image
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            if (!$image_url) {
                                $image_url = BSV_ELEMENTOR_WIDGETS_URL . 'assets/images/placeholder.jpg';
                            }
                            // Determine card layout
                            $card_layout = $settings['card_layout'];

                            ?>
                            
                            <div class="<?php echo esc_attr($column_class); ?> bsv-destination-card-wrapper">
                                <div class="bsv-destination-card h-100"> <!-- Added h-100 for equal height -->
                                    <!-- Rest of your card content remains the same -->
                                    <div class="bsv-destination-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                        
                                        <?php if ($card_layout === 'overlay') : ?>
                                            <div class="bsv-destination-overlay"></div>
                                            <div class="bsv-destination-content-overlay">
                                                <h3 class="bsv-destination-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                
                                                <?php if (!empty($destination_location)) : ?>
                                                    <div class="bsv-destination-location">
                                                        <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($destination_location); ?>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if ($settings['show_description'] === 'yes' && !empty($destination_excerpt)) : ?>
                                                    <div class="bsv-destination-description"><?php echo esc_html($destination_excerpt); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if ($card_layout === 'below') : ?>
                                        <div class="bsv-destination-details">
                                            <h3 class="bsv-destination-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            
                                            <?php if (!empty($destination_location)) : ?>
                                                <div class="bsv-destination-location">
                                                    <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($destination_location); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if ($settings['show_description'] === 'yes' && !empty($destination_excerpt)) : ?>
                                                <div class="bsv-destination-description"><?php echo esc_html($destination_excerpt); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <div class="col-12">
                            <p><?php echo esc_html__('No destinations found.', 'bsv-elementor-widgets'); ?></p>
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
            <?php if ($settings['enable_pagination'] === 'yes' && $destinations->max_num_pages > 1) : ?>
                <div class="bsv-destinations-pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => $paged,
                        'total' => $destinations->max_num_pages,
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