<?php

use function VSGutenberg\Helpers\simple_slug;

function get_visibility_rules($group_name = 'Visibility') {

    $group_label = $group_name;
    $group_slug = simple_slug($group_name);
    $group_key = 'field_' . $group_slug;
    return array(
        'key' => $group_key,
        'label' => $group_label,
        'name' => $group_slug,
        'aria-label' => '',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'choices' => array(
            'vs-hide-on-desktop' => 'Hide on Desktop',
            'vs-hide-on-tablet' => 'Hide on Tablet',
            'vs-hide-on-mobile' => 'Hide on Mobile',
        ),
        'allow_custom' => 0,
        'default_value' => array(),
        'layout' => 'horizontal',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
        'custom_choice_button_text' => 'Add new choice',
    );
}