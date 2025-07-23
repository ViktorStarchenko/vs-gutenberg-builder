<?php
/**
 * Plugin Name: VS Gutenberg Builder
 * Description: A universal set of ACF Gutenberg blocks with auto-links and enhanced customization in the theme.
 * Version: 1.0
 * Author: Viktor Starchenko
 */

if (!defined('ABSPATH')) exit;

// Autoloading classes
spl_autoload_register(function ($class) {
    $prefix = 'VSGutenberg\\';
    $base_dir = plugin_dir_path(__FILE__);

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

if (file_exists(plugin_dir_path(__FILE__) . 'Helpers/Functions.php')) {
    require_once plugin_dir_path(__FILE__) . 'Helpers/Functions.php';
}

// Download ACF JSON for automatic sync
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = plugin_dir_path(__FILE__) . 'acf-json';
    return $paths;
});

// ACF block initialization
add_action('acf/init', function() {

    if (file_exists(plugin_dir_path(__FILE__) . 'acf-rules/acf-rules-main.php')) {
        require plugin_dir_path(__FILE__) . 'acf-rules/acf-rules-main.php';
    }

});

// Allow extensions in the theme
add_action('after_setup_theme', function() {
    if (file_exists(get_stylesheet_directory() . '/vs-gutenberg-builder-overrides/init.php')) {
        require get_stylesheet_directory() . '/vs-gutenberg-builder-overrides/init.php';
    }
});

use VSGutenberg\Sections\VsSectionBlock;
use VSGutenberg\Blocks\VsTextBlock;
use VSGutenberg\Blocks\VsImageBlock;
use VSGutenberg\Blocks\VsAccordionBlock;
use VSGutenberg\Blocks\VsButtonBlock;

add_action('acf/init', function() {
    (new VsSectionBlock())->init();
    (new VsTextBlock())->init();
    (new VsImageBlock())->init();
    (new VsAccordionBlock())->init();
    (new VsButtonBlock())->init();

    if (file_exists(plugin_dir_path(__FILE__) . 'acf-rules/acf-rules-main.php')) {
        require plugin_dir_path(__FILE__) . 'acf-rules/acf-rules-main.php';
    }
});
