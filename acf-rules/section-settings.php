<?php

require_once plugin_dir_path(__FILE__) . 'rules/wrappers.php';
$section_wrapper = get_wrappers_rules('Section Wrapper');
$content_wrapper = get_wrappers_rules('Content Wrapper');

require_once plugin_dir_path(__FILE__) . 'rules/padding.php';
$padding = get_padding_rules('Padding');

require_once plugin_dir_path(__FILE__) . 'rules/margin.php';
$margin = get_margin_rules('Margin');

require_once plugin_dir_path(__FILE__) . 'rules/min-height.php';
$min_height = get_min_height_rules();

require_once plugin_dir_path(__FILE__) . 'rules/background-full.php';
$background_full = get_background_full_rules('Section Background');

require_once plugin_dir_path(__FILE__) . 'rules/attributes.php';
$attributes = get_attributes_rules('Attributes');

require_once plugin_dir_path(__FILE__) . 'rules/visibility.php';
$visibility = get_visibility_rules();

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

acf_add_local_field_group( array(
    'key' => 'group_6877552037995',
    'title' => 'Section Settings',
    'fields' => array(
        array(
            'key' => 'field_68777806fc561',
            'label' => 'Section settings',
            'name' => 'section_settings',
            'aria-label' => '',
            'type' => 'group',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_687755281f251',
                    'label' => 'Wrapper Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_687755371f252',
                    'label' => 'wrappers',
                    'name' => 'wrappers',
                    'aria-label' => '',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'block',
                    'sub_fields' => array(
                        $section_wrapper,
                        $content_wrapper,
                    ),
                ),
                $min_height,
                array(
                    'key' => 'field_687782e2e0ab6',
                    'label' => 'Background Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                $background_full,
                array(
                    'key' => 'field_68779edb6dcd7',
                    'label' => 'Spacing Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                $padding,
                $margin,
                array(
                    'key' => 'field_6877ceff6ccce',
                    'label' => 'Attributes Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                $attributes,
                array(
                    'key' => 'field_6877cf6c6ccd3',
                    'label' => 'Border Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_687919ab080b3',
                    'label' => 'Visibility Settings',
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                $visibility,
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/section-block',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
) );


