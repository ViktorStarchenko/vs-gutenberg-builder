<?php

$max_width = include plugin_dir_path(__FILE__) . 'rules/max-width.php';
$min_height = include plugin_dir_path(__FILE__) . 'rules/max-height.php';
require_once plugin_dir_path(__FILE__) . 'rules/padding.php';
$padding = get_padding_rules('Padding');
$margin = include plugin_dir_path(__FILE__) . 'rules/margin.php';
$attributes = include plugin_dir_path(__FILE__) . 'rules/attributes.php';
$background_full = include plugin_dir_path(__FILE__) . 'rules/background-full.php';
$visibility = include plugin_dir_path(__FILE__) . 'rules/visibility.php';

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
