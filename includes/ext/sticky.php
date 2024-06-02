<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( !class_exists('news_element_sticky_section_column') ) {
    class news_element_sticky_section_column
    {
        public static function init()
        {
            add_action('elementor/element/section/section_advanced/after_section_end', [
                __CLASS__,
                'section_control'
            ], 10, 2);

            add_action( 'elementor/element/column/section_advanced/after_section_end', [__CLASS__, 'column_controls'], 10, 2 );

            add_action( 'elementor/frontend/after_enqueue_scripts', [__CLASS__, 'enqueue_scripts'] );
        }

        public static function enqueue_scripts()
        {
            wp_enqueue_script('thepack-sticky', NEWS_ELM_URL . 'assets/js/sticky-effect.js');
        }

        public static function column_controls ( $element, $args )
        {
            $element->start_controls_section(
            'tp_sticky_col_effect',
            [
                'label' => esc_html__( 'Sticky Column Effect', 'news-element' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

            $element->add_control(
            'tp_sticky_col_effect_enable',
            [
                'label' => esc_html__( 'Enable column sticky effect', 'news-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => false,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

            $element->add_control(
            'tp_sticky_col_effect_enable_on',
            [
                'label' => esc_html__( 'Enable On', 'news-element' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => 'true',
                'default' => ['desktop'],
                'options' => [
                    'desktop' => esc_html__( 'Desktop', 'news-element' ),
                    'tablet' => esc_html__( 'Tablet', 'news-element' ),
                    'mobile' => esc_html__( 'Mobile', 'news-element' ),
                ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_col_effect_enable' => 'yes'
                ],
            ]
        );

            $element->add_control(
            'tp_sticky_col_effect_offset_top',
            [
                'label' => esc_html__( 'Offset top', 'news-element' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1
                    ],
                ],
                'size_units' => ['px'],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_col_effect_enable' => 'yes',
                ],
            ]
        );

            $element->end_controls_section();
        }

        public static function section_control($element, $args)
        {
            $element->start_controls_section(
            'tp_sticky_section',
            [
                'label' => esc_html__('Sticky section', 'thepack'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

            $element->add_control(
            'tp_sticky_sec_effect_enable',
            [
                'label' => esc_html__( 'Enable', 'news-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => false,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

            $element->add_control(
            'tp_sticky_sec_effect_enable_on',
            [
                'label' => esc_html__( 'Enable On', 'news-element' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => 'true',
                'default' => ['desktop'],
                'options' => [
                    'desktop' => esc_html__( 'Desktop', 'news-element' ),
                    'tablet' => esc_html__( 'Tablet', 'news-element' ),
                    'mobile' => esc_html__( 'Mobile', 'news-element' ),
                ],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
            ]
        );

            $element->add_control(
            'tp_sticky_sec_effect_scroll_offset',
            [
                'label' => esc_html__( 'Scroll Offset', 'news-element' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px'],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes',
                ],
            ]
        );

            $element->add_control(
            'tp_sticky_sec_section_effect_offset_top',
            [
                'label' => esc_html__( 'Offset top', 'news-element' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1
                    ],
                ],
                'size_units' => ['px'],
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes',
                ],
            ]
        );

            $element->add_control(
            'tp_sticky_sec_effect_z_index',
            [
                'label' => esc_html__( 'Z-Index', 'news-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 1,
                'frontend_available' => true,
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
            ]
        );

            $element->add_group_control(
			Group_Control_Background::get_type(),
			[
			    'name' => 'tp_sticky_sec_effect_background',
			    'label' => esc_html__( 'Background', 'news-element' ),
			    'types' => ['classic', 'gradient'],
			    'condition' => [
			        'tp_sticky_sec_effect_enable' => 'yes'
			    ],
			    'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
			]
		);

            $element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
			    'name' => 'tp_sticky_sec_effect_box_shadow',
			    'label' => esc_html__( 'Box Shadow', 'news-element' ),
			    'condition' => [
			        'tp_sticky_sec_effect_enable' => 'yes'
			    ],
			    'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
			]
		);

            $element->add_group_control(
			Group_Control_Border::get_type(),
			[
			    'name' => 'tp_sticky_sec_effect_borders',
			    'label' => esc_html__( 'Border', 'news-element' ),
			    'selector' => '.elementor-element.elementor-element-{{ID}}.tp-section-sticky-effect-yes-{{ID}}.tp-section-sticky',
			    'condition' => [
			        'tp_sticky_sec_effect_enable' => 'yes'
			    ],
			]
		);

            $element->add_control(
            'tp_sticky_sec_effect_hide_on_scroll_down',
            [
                'label' => esc_html__( 'Hide on scroll down', 'news-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => false,
                'separator' => 'before',
                'condition' => [
                    'tp_sticky_sec_effect_enable' => 'yes'
                ],
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

            $element->end_controls_section();
        }
    }

    news_element_sticky_section_column::init();
}

