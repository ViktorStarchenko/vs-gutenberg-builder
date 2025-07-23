<?php

if (file_exists(plugin_dir_path(__FILE__) . 'section-settings.php')) {
    require plugin_dir_path(__FILE__) . 'section-settings.php';
}

if (file_exists(plugin_dir_path(__FILE__) . 'element-settings.php')) {
    require plugin_dir_path(__FILE__) . 'element-settings.php';
}

if (file_exists(plugin_dir_path(__FILE__) . 'text-block-group.php')) {
    require plugin_dir_path(__FILE__) . 'text-block-group.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'image-block-group.php')) {
    require plugin_dir_path(__FILE__) . 'image-block-group.php';
}

if (file_exists(plugin_dir_path(__FILE__) . 'accordion-block-group.php')) {
    require plugin_dir_path(__FILE__) . 'accordion-block-group.php';
}

if (file_exists(plugin_dir_path(__FILE__) . 'button-block-group.php')) {
    require plugin_dir_path(__FILE__) . 'button-block-group.php';
}