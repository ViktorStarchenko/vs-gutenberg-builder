<?php

use function VSGutenberg\Helpers\simple_slug;

function get_min_height_rules($group_name = 'Min Height') {

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
                'key' => 'field_6878dc1198b62',
                'label' => 'Desktop',
                'name' => 'desktop',
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
                'key' => 'field_6878dc1198b63',
                'label' => 'Tablet',
                'name' => 'tablet',
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
                'key' => 'field_6878dc1198b64',
                'label' => 'Mobile',
                'name' => 'mobile',
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
        ),
    );
}