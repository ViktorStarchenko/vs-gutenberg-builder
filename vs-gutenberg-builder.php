<?php
/**
 * Plugin Name: VS Gutenberg Builder
 * Description: Універсальний набір ACF Gutenberg блоків з автозавантаженням і підтримкою кастомізації в темі.
 * Version: 1.0
 * Author: Djigan
 */

// Автозавантаження класів
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

// Завантажуємо ACF JSON для автоматичного sync
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = plugin_dir_path(__FILE__) . 'acf-json';
    return $paths;
});

// Ініціалізація блоків
add_action('acf/init', function() {
    // Ініціалізація базових блоків
    if (class_exists('VSGutenberg\\Blocks\\VsTextBlock')) {
        new VSGutenberg\Blocks\VsTextBlock();
    }

    if (class_exists('VSGutenberg\\Blocks\\AccordionBlock')) {
//        new VSGutenberg\Blocks\AccordionBlock();
    }

    // Додаткові блоки або секції можна реєструвати тут або в темі
});

// Дозволити розширення в темі
add_action('after_setup_theme', function() {
    if (file_exists(get_stylesheet_directory() . '/vs-gutenberg-builder-overrides/init.php')) {
        require get_stylesheet_directory() . '/vs-gutenberg-builder-overrides/init.php';
    }
});

use VSGutenberg\Sections\VsSectionBlock;
use VSGutenberg\Blocks\VsTextBlock;
use VSGutenberg\Blocks\VsImageBlock;
use VSGutenberg\Blocks\VsAccordionBlock;

add_action('acf/init', function() {
    (new VsSectionBlock())->init();
    (new VsTextBlock())->init();
    (new VsImageBlock())->init();
    (new VsAccordionBlock())->init();
});
