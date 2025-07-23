<?php

use function VSGutenberg\Helpers\simple_slug;

function get_max_width_rules($group_name = 'Max Width') {

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
                'key' => 'field_6878a5805ec88',
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
                'key' => 'field_6878a5865ec89',
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
                'key' => 'field_6878a58b5ec8a',
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