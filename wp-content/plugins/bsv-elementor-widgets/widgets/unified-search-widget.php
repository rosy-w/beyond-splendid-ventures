<?php
class BSV_Unified_Search_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'bsv_unified_search';
    }

    public function get_title() {
        return esc_html__('BSV Unified Search', 'bsv-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return ['beyond-splendid-ventures'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'search_type',
            [
                'label' => esc_html__('Search Type', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('All', 'bsv-elementor-widgets'),
                    'tours' => esc_html__('Tours Only', 'bsv-elementor-widgets'),
                    'destinations' => esc_html__('Destinations Only', 'bsv-elementor-widgets'),
                ],
            ]
        );

        $this->add_control(
            'show_filters',
            [
                'label' => esc_html__('Show Filters', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bsv-elementor-widgets'),
                'label_off' => esc_html__('No', 'bsv-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Search Box Style Section
        $this->start_controls_section(
            'section_search_box_style',
            [
                'label' => esc_html__('Search Box', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'search_box_bg_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bsv-unified-search' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'search_box_border',
                'selector' => '{{WRAPPER}} .bsv-unified-search',
            ]
        );

        $this->add_responsive_control(
            'search_box_padding',
            [
                'label' => esc_html__('Padding', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bsv-unified-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'search_box_shadow',
                'selector' => '{{WRAPPER}} .bsv-unified-search',
            ]
        );

        $this->end_controls_section();

        // Filter Layout Section
        $this->start_controls_section(
            'section_filter_layout',
            [
                'label' => esc_html__('Filter Layout', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filters' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_container_width',
            [
                'label' => esc_html__('Filters Container Width', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-column' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_item_width',
            [
                'label' => esc_html__('Individual Filter Width', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 48,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Input Fields Style Section
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__('Input Fields', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-input, {{WRAPPER}} .filter-select' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-input, {{WRAPPER}} .filter-select' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .search-input, {{WRAPPER}} .filter-select',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .search-input, {{WRAPPER}} .filter-select',
            ]
        );

        $this->add_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-input, {{WRAPPER}} .filter-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Search Button Style Section
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Search Button', 'bsv-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .search-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'color: {{VALUE}};',
                ],
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
            'button_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .search-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .search-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bsv-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bsv-unified-search ">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="search-container">
                    <div class="search-column">
                        <div class="search-input-wrap">
                            <input type="text" name="s" placeholder="<?php echo esc_attr__('Search...', 'bsv-elementor-widgets'); ?>" value="<?php echo get_search_query(); ?>" class="search-input">
                        </div>

                        <?php if ($settings['search_type'] !== 'all'): ?>
                            <input type="hidden" name="post_type" value="<?php echo esc_attr($settings['search_type'] === 'tours' ? 'tour' : 'destination'); ?>">
                        <?php endif; ?>

                        <?php if ($settings['show_filters'] === 'yes'): ?>
                            <div class="filter-column">
                                <div class="filter-item">
                                    <select name="destination_category" class="filter-select">
                                        <option value=""><?php echo esc_html__('All Locations', 'bsv-elementor-widgets'); ?></option>
                                        <?php
                                        $locations = get_terms(array(
                                            'taxonomy' => 'destination_category',
                                            'hide_empty' => true,
                                        ));
                                        foreach ($locations as $location) {
                                            echo '<option value="' . esc_attr($location->slug) . '">' . esc_html($location->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php if ($settings['search_type'] !== 'destinations'): ?>
                                    <div class="filter-item">
                                        <select name="duration" class="filter-select">
                                            <option value=""><?php echo esc_html__('Any Duration', 'bsv-elementor-widgets'); ?></option>
                                            <option value="1-3"><?php echo esc_html__('1-3 Days', 'bsv-elementor-widgets'); ?></option>
                                            <option value="4-7"><?php echo esc_html__('4-7 Days', 'bsv-elementor-widgets'); ?></option>
                                            <option value="8-14"><?php echo esc_html__('8-14 Days', 'bsv-elementor-widgets'); ?></option>
                                            <option value="15+"><?php echo esc_html__('15+ Days', 'bsv-elementor-widgets'); ?></option>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="search-button-wrap">
                            <button type="submit" class="search-button">
                                <?php echo esc_html__('Search', 'bsv-elementor-widgets'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
}
