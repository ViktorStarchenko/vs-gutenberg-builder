<?php

use function VSGutenberg\Helpers\simple_slug;

function get_bg_color_rules($group_name = 'Background') {

    $group_label = $group_name;
    $group_slug = simple_slug($group_name);
    $group_key = 'field_' . $group_slug;
    return array(
        'key' => $group_key,
        'label' => $group_label,
        'name' => $group_slug,
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
                'key' => 'field_687b80abcf7ed',
                'label' => 'Background Color',
                'name' => 'background_color',
                'aria-label' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array(
                    array(
                        'key' => 'field_687b80abcf7ee',
                        'label' => 'Color',
                        'name' => 'color',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                        'parent_repeater' => 'field_687b80abcf7ed',
                    ),
                ),
                'rows_per_page' => 20,
            ),
            array(
                'key' => 'field_687b80b0cf7ef',
                'label' => 'Gradient Direction',
                'name' => 'gradient_direction',
                'aria-label' => '',
                'type' => 'button_group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'to right' => 'to right',
                    'to bottom' => 'to bottom',
                ),
                'allow_null' => 0,
                'default_value' => 'to right',
                'layout' => 'horizontal',
                'return_format' => 'value',
            ),
        ),
    );
}