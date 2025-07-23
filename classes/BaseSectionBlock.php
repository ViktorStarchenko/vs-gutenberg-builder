<?php

namespace VSGutenberg\Classes;

if (!defined('ABSPATH')) exit;

use VSGutenberg\Classes\Traits\BlockStyleGenerator;

abstract class BaseSectionBlock {

    use BlockStyleGenerator;

    protected $name;
    protected $title;
    protected $icon;
    protected $category;

    public function __construct($name, $title, $icon = 'admin-generic', $category = 'layout') {
        $this->name = $name;
        $this->title = $title;
        $this->icon = $icon;
        $this->category = $category;
    }

    public function init() {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name'              => $this->name,
                'title'             => __($this->title),
                'icon'              => $this->icon,
                'category'          => $this->category,
                'keywords'          => array('section', 'wrapper', 'layout'),
                'supports'          => array(
                    'align' => false,
                    'jsx'   => true,
                ),
                'mode' => 'preview',
                'enqueue_assets' => function () {
                    $this->enqueue_assets();
                },
                'render_callback' => [$this, 'render_callback']
            ));
        }
    }

    protected function enqueue_assets() {
        $plugin_url = plugins_url('../assets/css/', __FILE__);

        if (is_admin()) {
            wp_enqueue_style('vs-section-admin', $plugin_url . 'acf-gutenberg-style-admin.css', [], '1.0');
        } else {
            wp_enqueue_style('vs-section-front', $plugin_url . 'acf-gutenberg-style.css', [], '1.0');
        }
    }

    public function render_callback($block) {
        $fields = get_fields();
        $settings = $fields['section_settings'];
        $block_id = uniqid('vs-section-');
        $content_id = uniqid('vs-section-content-');

        if (isset($settings['min_height']) && !empty($settings['min_height'])) {
            $min_height_styles = $this->generate_min_height_styles($settings['min_height'], $block_id);
            echo '<style>' . $min_height_styles . '</style>'; // Add styles
        }

        if (isset($settings['wrappers']['section_wrapper']) && !empty($settings['wrappers']['section_wrapper'])) {
            $section_wrapper_styles = $this->generate_wrapper_styles($settings['wrappers']['section_wrapper'], $block_id);
            echo '<style>' . $section_wrapper_styles . '</style>'; // Add styles
        }

        if (isset($settings['wrappers']['content_wrapper']) && !empty($settings['wrappers']['content_wrapper'])) {
            $content_wrapper_styles = $this->generate_wrapper_styles($settings['wrappers']['content_wrapper'], $content_id);
            echo '<style>' . $content_wrapper_styles . '</style>'; // Add styles
        }

        if (isset($settings['padding']) && !empty($settings['padding'])) {
            $padding_styles = $this->generate_padding_styles($settings['padding'], $block_id);
            echo '<style>' . $padding_styles . '</style>'; // Add styles
        }

        if (isset($settings['margin']) && !empty($settings['margin'])) {
            $margin_styles = $this->generate_margin_styles($settings['margin'], $block_id);
            echo '<style>' . $margin_styles . '</style>'; // Add styles
        }

        if (isset($settings['section_background']) && !empty($settings['section_background'])) {
            $background_styles = $this->generate_background_styles($settings['section_background'], $block_id);
            echo '<style>' . $background_styles . '</style>'; // Add styles
        }

//        echo '<style>' . $this->generate_section_styles($fields, $block_id) . '</style>';
        echo $this->generate_section_wrapper($fields, $block_id, $content_id);
    }

    protected function get_css_rule($block_id, $property, $value) {
        return !empty($value) ? ".$block_id { $property: $value; }" : '';
    }

    protected function generate_section_wrapper($fields, $block_id, $content_id) {
        $settings = $fields['section_settings'] ?? [];
        $classes = esc_attr($block_id) . ' section-relative';

        if (!empty($settings['visibility'])) {
            $classes .= ' ' . implode(' ', $settings['visibility']);
        }

        if (!empty($settings['attributes']['class'])) {
            $classes .= ' ' . esc_attr($settings['attributes']['class']);
        }

        ob_start();
        ?>
        <section class="vs-section vs-wrapper <?= $classes; ?>" id="<?= esc_attr($settings['attributes']['id'] ?? '') ?>">
            <?php if (!empty($settings['section_background']['video']['url'])) : ?>
                <div class="vs-background__video-wrapper">
                    <video playsinline autoplay muted loop poster="<?= esc_url($settings['section_background']['video']['url']); ?>#t=2">
                        <source src="<?= esc_url($settings['section_background']['video']['url']); ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>

            <div class="vs-bg-overlay <?= !empty($settings['section_background']['enable_overlay']) ? 'active' : ''; ?>"></div>

            <div class="vs-wrapper content vs-content-wrapper <?= esc_attr($settings['wrappers']['content_wrapper']['preset'] ?? ''); ?> <?= esc_attr($content_id); ?>">
                <?php $this->render_content($fields); ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    // These methods must be implemented in child classes or have a default implementation.
    abstract protected function render_content($fields);
}
