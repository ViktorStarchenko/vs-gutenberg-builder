<?php

namespace VSGutenberg\Classes;

if (!defined('ABSPATH')) exit;

abstract class BaseSectionBlock {

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
        $block_id = uniqid('vs-section-');
        $content_id = uniqid('vs-section-content-');

        echo '<style>' . $this->generate_section_styles($fields, $block_id) . '</style>';
        echo '<style>' . $this->generate_content_styles($fields, $content_id) . '</style>';
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

        if (!empty($settings['section_classes'])) {
            $classes .= ' ' . esc_attr($settings['section_classes']);
        }

        ob_start();
        ?>
        <section class="vs-section vs-wrapper <?= $classes; ?>" id="<?= esc_attr($settings['attributes']['id'] ?? '') ?>">
            <?php if (!empty($settings['background']['video']['url'])) : ?>
                <div class="vs-background__video-wrapper">
                    <video playsinline autoplay muted loop poster="<?= esc_url($settings['background']['video']['url']); ?>#t=2">
                        <source src="<?= esc_url($settings['background']['video']['url']); ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>

            <div class="vs-bg-overlay <?= !empty($settings['background']['enable_overlay']) ? 'active' : ''; ?>"></div>

            <div class="vs-wrapper content vs-content-wrapper <?= esc_attr($settings['wrappers']['content_wrapper']['preset'] ?? ''); ?> <?= esc_attr($content_id); ?>">
                <?php $this->render_content($fields); ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    protected function generate_section_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields['section_settings'])) {
            $settings = $fields['section_settings'];
            $bg_image = $settings['background']['image'];
            $spacing = $settings['spacing'];

            $gradient_direction = 'to right';
            if ($settings['background']['gradient_direction']) {
                $gradient_direction = $settings['background']['gradient_direction'];
            }

            $bg_color = '';
            $bg_color_gradient = '';
            if ($settings['background']['background_color']) {
                $gradient_array = [];
                foreach ($settings['background']['background_color'] as $color) {
                    $gradient_array[] = $color['color'];
                }
                $gradient_string = implode(', ', $gradient_array);
                $bg_color = $gradient_array[0] .';';
                $bg_color_gradient = 'linear-gradient(' . $gradient_direction . ',' . $gradient_string . ')';
            }

            $styles[] = $this->get_css_rule($block_id, 'background-color',$bg_color);
            $styles[] = $this->get_css_rule($block_id, 'background',$bg_color_gradient);

            // Desktop
            if (!empty($settings['wrappers']['section_wrapper']['max_width']) && !empty($settings['wrappers']['section_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'max-width','calc(' . $settings['wrappers']['section_wrapper']['max_width']. ' + ' . $settings['wrappers']['section_wrapper']['padding'] . ' + ' . $settings['wrappers']['section_wrapper']['padding'] .')');
            } else if (!empty($settings['wrappers']['section_wrapper']['max_width']) && empty($settings['wrappers']['section_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'max-width', $settings['wrappers']['section_wrapper']['max_width']);
            }
            if (!empty($settings['wrappers']['section_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'padding-left',$settings['wrappers']['section_wrapper']['padding']);
                $styles[] = $this->get_css_rule($block_id, 'padding-right',$settings['wrappers']['section_wrapper']['padding']);
            }

            if (!empty($bg_image['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'background-image','url('.$bg_image['desktop']['url'].')');
            }

            if (!empty($spacing['height']['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'min-height',$settings['spacing']['height']['desktop']);
            }
//
            if (!empty($spacing['padding']['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'padding-top', $spacing['padding']['desktop']['top']);
                $styles[] = $this->get_css_rule($block_id, 'padding-bottom', $spacing['padding']['desktop']['bottom']);
            }

            if (!empty($spacing['margin']['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'margin-top', $spacing['margin']['desktop']['top']);
                $styles[] = $this->get_css_rule($block_id, 'margin-bottom', $spacing['margin']['desktop']['bottom']);
            }


            // Tablet
            if (!empty($bg_image['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['tablet']['url'].')') . " }";
            }

            if (!empty($spacing['height']['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'min-height', $settings['spacing']['height']['tablet']) . " }";
            }

            if (!empty($spacing['padding']['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-top', $spacing['padding']['tablet']['top']) . " }";
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-bottom', $spacing['padding']['tablet']['bottom']) . " }";
            }

            if (!empty($spacing['margin']['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-top', $spacing['margin']['tablet']['top']) . " }";
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-bottom', $spacing['margin']['tablet']['bottom']) . " }";
            }

            // Mobile
            if (!empty($bg_image['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['mobile']['url'].')') . " }";
            }

            if (!empty($spacing['height']['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'min-height', $settings['spacing']['height']['mobile']) . " }";
            }

            if (!empty($spacing['padding']['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-top', $spacing['padding']['mobile']['top']) . " }";
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-bottom', $spacing['padding']['mobile']['bottom']) . " }";
            }

            if (!empty($spacing['margin']['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-top', $spacing['margin']['mobile']['top']) . " }";
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-bottom', $spacing['margin']['mobile']['bottom']) . " }";
            }

        }

        return implode(' ', array_filter($styles)); // Видаляємо порожні значення
    }

    protected function generate_content_styles($fields, $content_id) {
        $styles = [];

        if (!empty($fields['section_settings'])) {
            $settings = $fields['section_settings'];

            $section_wrapper = $settings['wrappers']['section_wrapper'];

            // Desktop
            if (!empty($settings['wrappers']['content_wrapper']['max_width']) && !empty($settings['wrappers']['content_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($content_id, 'max-width','calc(' . $settings['wrappers']['content_wrapper']['max_width']. ' + ' . $settings['wrappers']['content_wrapper']['padding'] . ' + ' . $settings['wrappers']['content_wrapper']['padding'] .')');
            } else if (!empty($settings['wrappers']['content_wrapper']['max_width']) && empty($settings['wrappers']['content_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($content_id, 'max-width', $settings['wrappers']['content_wrapper']['max_width']);
            }

            if (!empty($settings['wrappers']['content_wrapper']['padding'])) {
                $styles[] = $this->get_css_rule($content_id, 'padding-left',$settings['wrappers']['content_wrapper']['padding']);
                $styles[] = $this->get_css_rule($content_id, 'padding-right',$settings['wrappers']['content_wrapper']['padding']);
            }

        }

        return implode(' ', array_filter($styles));
    }

    // Ці методи мають бути реалізовані в дочірніх класах або мати дефолтну реалізацію
    abstract protected function render_content($fields);
}
