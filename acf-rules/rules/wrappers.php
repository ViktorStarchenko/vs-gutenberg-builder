<?php

use function VSGutenberg\Helpers\simple_slug;

function get_wrappers_rules($group_name = 'Wrappers') {

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
        'layout' => 'table',
        'sub_fields' => array(
            array(
                'key' => 'field_68776a00dbb50',
                'label' => 'Preset',
                'name' => 'preset',
                'aria-label' => '',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'wrapper-fullwidth' => 'wrapper-fullwidth',
                    'wrapper-1070' => 'wrapper-1070',
                    'wrapper-1400' => 'wrapper-1400',
                ),
                'default_value' => 'wrapper-fullwidth',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_68776a10dbb51',
                'label' => 'Max Width',
                'name' => 'max_width',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_68776a1bdbb52',
                'label' => 'Padding',
                'name' => 'padding',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'Left and right padding',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
    );
}