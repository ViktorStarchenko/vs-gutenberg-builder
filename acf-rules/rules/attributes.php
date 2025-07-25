<?php

use function VSGutenberg\Helpers\simple_slug;

function get_attributes_rules($group_name = 'Attributes') {

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
                'key' => 'field_6878a8851ea8d',
                'label' => 'Class',
                'name' => 'class',
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
                'key' => 'field_6878a88a1ea8e',
                'label' => 'Id',
                'name' => 'id',
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