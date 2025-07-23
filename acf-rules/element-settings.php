<?php

require_once plugin_dir_path(__FILE__) . 'rules/max-width.php';
$max_width = get_max_width_rules();

require_once plugin_dir_path(__FILE__) . 'rules/min-height.php';
$min_height = get_min_height_rules();

require_once plugin_dir_path(__FILE__) . 'rules/padding.php';
$padding = get_padding_rules('Padding');

require_once plugin_dir_path(__FILE__) . 'rules/margin.php';
$margin = get_margin_rules('Margin');

require_once plugin_dir_path(__FILE__) . 'rules/attributes.php';
$attributes = get_attributes_rules('Attributes');

require_once plugin_dir_path(__FILE__) . 'rules/background-full.php';
$background_full = get_background_full_rules('Element Background');

require_once plugin_dir_path(__FILE__) . 'rules/visibility.php';
$visibility = get_visibility_rules();

if (!function_exists('acf_add_local_field_group')) {
    return;
}
acf_add_local_field_group(array(
    'key' => 'group_687754edaef2b',
    'title' => 'Element settings',
    'fields' => array(
        array(
            'key' => 'field_68789715fbb48',
            'label' => 'Element settings',
            'name' => 'element_settings',
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
                    'key' => 'field_6878a5955ec8b',
                    'label' => 'Width and Height Setting',
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
                $max_width,
                $min_height,
                array(
                    'key' => 'field_68789944fbb49',
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
                    'key' => 'field_6878a8521ea8b',
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
                    'key' => 'field_6878dfc857218',
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
                    'key' => 'field_68791c001f412',
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
                'value' => 'acf/vs-text-block',
            ),
        ),
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/vs-image-block',
            ),
        ),
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/vs-accordion-block',
            ),
        ),
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/vs-button-block',
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
));
