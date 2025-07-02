<?php
/**
 * Testimonials Widget for Elementor
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class BSV_Testimonials_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'bsv_testimonials';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__('BSV Testimonials', 'bsv-elementor-widgets');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-testimonial';
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
        return ['testimonials', 'reviews', 'clients', 'bsv', 'beyond splendid ventures'];
    }

    /**
     * Register widget styles and scripts
     */
    public function get_script_depends() {
        wp_register_script('bsv-slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], '1.8.1', true);
        wp_register_script('bsv-testimonials-js', BSV_ELEMENTOR_WIDGETS_URL . 'assets/js/testimonials.js', ['jquery', 'bsv-slick-js'], '1.0.0', true);
        
        return ['bsv-slick-js', 'bsv-testimonials-js'];
    }

    public function get_style_depends() {
        wp_register_style('bsv-slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [], '1.8.1');
        wp_register_style('bsv-slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', ['bsv-slick-css'], '1.8.1');
        wp_register_style('bsv-testimonials-css', BSV_ELEMENTOR_WIDGETS_URL . 'assets/css/testimonials.css', ['bsv-slick-css', 'bsv-slick-theme-css'], '1.0.0');
        
        return ['bsv-slick-css', 'bsv-slick-theme-css', 'bsv-testimonials-css'];
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
                'default' => esc_html__('What Our Clients Say', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your title', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Read testimonials from our satisfied customers about their travel experiences.', 'bsv-elementor-widgets'),
                'placeholder' => esc_html__('Enter your subtitle', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'number_of_testimonials',
            [
                'label' => esc_html__('Number of Testimonials', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' => esc_html__('Slides to Show', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 2,
                'description' => esc_html__('Number of slides to show at once', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => esc_html__('Slides to Scroll', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__('Number of slides to scroll at a time', 'bsv-elementor-widgets'),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 4000,
                'description' => esc_html__('Autoplay speed in milliseconds', 'bsv-elementor-widgets'),
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Show Arrows', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Dots', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'slides_to_show_tablet',
            [
                'label' => esc_html__('Slides to Show (Tablet)', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'step' => 1,
                'default' => 2,
            ]
        );

        $this->add_responsive_control(
            'slides_to_show_mobile',
            [
                'label' => esc_html__('Slides to Show (Mobile)', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 2,
                'step' => 1,
                'default' => 1,
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
                    '{{WRAPPER}} .bsv-testimonials-title' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bsv-testimonials-title',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonials-subtitle' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .bsv-testimonials-subtitle',
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

        // Style Section for Testimonial Items
        $this->start_controls_section(
            'section_testimonial_style',
            [
                'label' => esc_html__('Testimonial Items', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testimonial_bg_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-item' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_border',
                'selector' => '{{WRAPPER}} .bsv-testimonial-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .bsv-testimonial-item',
            ]
        );

        $this->add_control(
            'testimonial_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'testimonial_padding',
            [
                'label' => esc_html__('Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 30,
                    'right' => 30,
                    'bottom' => 30,
                    'left' => 30,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_spacing',
            [
                'label' => esc_html__('Space Between Items', 'bsv-elementor-widgets'),
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
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bsv-testimonial-slider' => 'margin: 0 -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_heading',
            [
                'label' => esc_html__('Content', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-content' => 'color: {{VALUE}};',
                ],
                'default' => '#666666',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .bsv-testimonial-content',
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label' => esc_html__('Author Name', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Name Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-author-name' => 'color: {{VALUE}};',
                ],
                'default' => '#222222',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .bsv-testimonial-author-name',
            ]
        );

        $this->add_control(
            'role_heading',
            [
                'label' => esc_html__('Author Info', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'role_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-author-title' => 'color: {{VALUE}};',
                ],
                'default' => '#777777',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'selector' => '{{WRAPPER}} .bsv-testimonial-author-title',
            ]
        );

        $this->add_control(
            'star_color',
            [
                'label' => esc_html__('Rating Star Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-rating' => 'color: {{VALUE}};',
                ],
                'default' => '#fbbc05',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_heading',
            [
                'label' => esc_html__('Author Image', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => esc_html__('Image Size', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .bsv-testimonial-author-image',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-author-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                    'isLinked' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Navigation Style Section
        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => esc_html__('Navigation', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => esc_html__('Arrows Size', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-prev, {{WRAPPER}} .bsv-testimonial-slider .slick-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; transform: translateY(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-prev:before, {{WRAPPER}} .bsv-testimonial-slider .slick-next:before' => 'font-size: calc({{SIZE}}{{UNIT}} * 0.6);',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => esc_html__('Arrows Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-prev:before, {{WRAPPER}} .bsv-testimonial-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'default' => '#1a73e8',
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__('Dots Size', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__('Dots Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
                'default' => '#1a73e8',
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_spacing',
            [
                'label' => esc_html__('Dots Top Spacing', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bsv-testimonial-slider .slick-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('testimonial-slider', 'class', 'bsv-testimonial-slider');

        // Add data attributes for slider settings
        $slider_options = [
            'slidesToShow' => absint($settings['slides_to_show']),
            'slidesToScroll' => absint($settings['slides_to_scroll']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'autoplaySpeed' => absint($settings['autoplay_speed']),
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'infinite' => ('yes' === $settings['infinite']),
            'arrows' => ('yes' === $settings['show_arrows']),
            'dots' => ('yes' === $settings['show_dots']),
            'responsive' => [
                [
                    'breakpoint' => 1024,
                    'settings' => [
                        'slidesToShow' => absint($settings['slides_to_show_tablet']),
                        'slidesToScroll' => 1,
                    ],
                ],
                [
                    'breakpoint' => 767,
                    'settings' => [
                        'slidesToShow' => absint($settings['slides_to_show_mobile']),
                        'slidesToScroll' => 1,
                    ],
                ],
            ],
        ];

        $this->add_render_attribute('testimonial-slider', 'data-settings', json_encode($slider_options));
        
        // Query args
        $args = array(
            'post_type' => 'testimonial',
            'posts_per_page' => $settings['number_of_testimonials'],
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        
        // Get testimonials
        $testimonials = new WP_Query($args);
        ?>
        
        <div class="bsv-testimonials-widget">
            <?php if (!empty($settings['title']) || !empty($settings['subtitle'])) : ?>
                <div class="bsv-section-header">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="bsv-testimonials-title"><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="bsv-testimonials-subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div <?php echo $this->get_render_attribute_string('testimonial-slider'); ?>>
                <?php
                if ($testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();
                        // Get testimonial meta
                        $author_name = get_post_meta(get_the_ID(), 'testimonial_author', true);
                        $author_title = get_post_meta(get_the_ID(), 'testimonial_title', true);
                        
                        // Feature image
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                        
                        // Format testimonial content
                        $content = get_the_content();
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        
                        // Get first letter of author name for avatar
                        $initials = '';
                        if (!empty($author_name)) {
                            $name_parts = explode(' ', $author_name);
                            $initials = strtoupper(substr($name_parts[0], 0, 1));
                            if (count($name_parts) > 1) {
                                $initials .= strtoupper(substr(end($name_parts), 0, 1));
                            }
                        }
                        ?>
                        
                        <div class="bsv-testimonial-item">
                            <div class="bsv-testimonial-content">
                                <i class="fas fa-quote-left bsv-testimonial-quote-icon"></i>
                                <?php echo $content; ?>
                            </div>
                            
                            <div class="bsv-testimonial-author">
                                <?php if ($image_url) : ?>
                                    <div class="bsv-testimonial-author-image">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($author_name); ?>">
                                    </div>
                                <?php else : ?>
                                    <div class="bsv-testimonial-author-initials">
                                        <?php echo esc_html($initials); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="bsv-testimonial-author-info">
                                    <?php if (!empty($author_name)) : ?>
                                        <h4 class="bsv-testimonial-author-name"><?php echo esc_html($author_name); ?></h4>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($author_title)) : ?>
                                        <p class="bsv-testimonial-author-title"><?php echo esc_html($author_title); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <div class="bsv-testimonial-item">
                        <p><?php echo esc_html__('No testimonials found.', 'bsv-elementor-widgets'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.bsv-testimonial-slider').slick({
                    slidesToShow: <?php echo absint($settings['slides_to_show']); ?>,
                    slidesToScroll: <?php echo absint($settings['slides_to_scroll']); ?>,
                    autoplay: <?php echo ($settings['autoplay'] === 'yes') ? 'true' : 'false'; ?>,
                    autoplaySpeed: <?php echo absint($settings['autoplay_speed']); ?>,
                    pauseOnHover: <?php echo ($settings['pause_on_hover'] === 'yes') ? 'true' : 'false'; ?>,
                    infinite: <?php echo ($settings['infinite'] === 'yes') ? 'true' : 'false'; ?>,
                    arrows: <?php echo ($settings['show_arrows'] === 'yes') ? 'true' : 'false'; ?>,
                    dots: <?php echo ($settings['show_dots'] === 'yes') ? 'true' : 'false'; ?>,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: <?php echo absint($settings['slides_to_show_tablet']); ?>,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: <?php echo absint($settings['slides_to_show_mobile']); ?>,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        </script>
        <?php
    }
}