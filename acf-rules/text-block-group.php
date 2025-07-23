<?php

require_once plugin_dir_path(__FILE__) . 'rules/flex-alignment.php';
$flex_alignment = get_flex_alignment_rules();

require_once plugin_dir_path(__FILE__) . 'rules/typography.php';
$typography = get_typography_rules('Typography');

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_687917825d828',
        'title' => 'Text Block Settings',
        'fields' => array(
            array(
                'key' => 'field_68791792947c2',
                'label' => 'Text Block Settings',
                'name' => 'text_block_settings',
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
                        'key' => 'field_687a653b6398a',
                        'label' => 'Text Block Settings',
                        'name' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 0,
                        'multi_expand' => 0,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_68791e709561f',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    $typography,
                    $flex_alignment
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

endif;
