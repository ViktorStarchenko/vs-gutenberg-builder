<?php

namespace VSGutenberg\Classes;

if (!defined('ABSPATH')) exit;

use VSGutenberg\Classes\Traits\BlockStyleGenerator;

abstract class BaseElementBlock {

    use BlockStyleGenerator;

    protected $name;
    protected $title;
    protected $icon;
    protected $category;
    protected $template;

    public function __construct($name, $title, $icon = 'admin-generic', $category = 'common') {
        $this->name = $name;
        $this->title = $title;
        $this->icon = $icon;
        $this->category = $category;

        add_action('acf/init', [$this, 'register_block']);
    }

    public function init() {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name'              => $this->name,
                'title'             => __($this->title),
                'icon'              => $this->icon,
                'category'          => $this->category,
                'keywords'          => array('content', 'block', 'wrapper', 'layout'),
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
        $plugin_url = plugins_url('../assets/', __FILE__);

        if (is_admin()) {
            wp_enqueue_style('vs-section-admin', $plugin_url . 'css/acf-gutenberg-style-admin.css', [], '1.0');
        } else {
            wp_enqueue_style('vs-section-front', $plugin_url . 'css/acf-gutenberg-style.css', [], '1.0');
        }
        wp_enqueue_script('vs-main', $plugin_url . 'js/vs-main.js', ['jquery'], false, true);
    }

    public function render_callback($block) {
        $fields = get_fields();
        $block_id = uniqid('vs-custom-block-');
//        $styles = $this->generate_section_styles($fields, $block_id);
        $typography_styles = $this->generate_typography_styles($fields, $block_id);
        $classes = esc_attr($block_id);
        $classes .= ' vs-custom-block';
        $id = '';


        if (!empty($fields['element_settings'])) {
            $settings = $fields['element_settings'];
            $visibility_classes = !empty($settings['visibility']) ? implode(' ', $settings['visibility']) : '';
            if (!empty($settings['attributes']['class'])) {
                $classes .= ' ' . $settings['attributes']['class'];
            }
            $classes .= ' ' . $visibility_classes;
            if (!empty($settings['attributes']['id'])) {
                $id .= ' id="' . $settings['attributes']['id']. '"';
            }
//            echo '<style>' . $styles . '</style>'; // Add styles to the page
            echo '<style>' . $typography_styles . '</style>'; // Add styles to the page

            if (isset($settings['max_width']) && !empty($settings['max_width'])) {
                $max_width_styles = $this->generate_max_width_styles($settings['max_width'], $block_id);
                echo '<style>' . $max_width_styles . '</style>'; // Add styles
            }
            if (isset($settings['min_height']) && !empty($settings['min_height'])) {
                $min_height_styles = $this->generate_min_height_styles($settings['min_height'], $block_id);
                echo '<style>' . $min_height_styles . '</style>'; // Add styles
            }
            if (isset($settings['padding']) && !empty($settings['padding'])) {
                $padding_styles = $this->generate_padding_styles($settings['padding'], $block_id);
                echo '<style>' . $padding_styles . '</style>'; // Add styles
            }
            if (isset($settings['margin']) && !empty($settings['margin'])) {
                $margin_styles = $this->generate_margin_styles($settings['margin'], $block_id);
                echo '<style>' . $margin_styles . '</style>'; // Add styles
            }
            if (isset($settings['background']) && !empty($settings['background'])) {
                $background_styles = $this->generate_background_styles($settings['background'], $block_id);
                echo '<style>' . $background_styles . '</style>'; // Add styles
            }

        }

        echo '<div class="' . $classes . '" '.$id.'>';
        $this->render_content($fields, $block_id);
        echo '</div>';
    }

    protected function get_css_rule($block_id, $property, $value) {
        return !empty($value) ? ".$block_id { $property: $value; }" : '';
    }

    protected function generate_section_wrapper($fields, $block_id) {
        $settings = $fields['element_settings'];
        $classes = esc_attr($block_id);
        if (!empty($settings['attributes']['class'])) {
            $classes .= ' ' . $settings['attributes']['class'];
        }
        ob_start();
        ?>
        <div class="<?= $classes; ?>" id="<?= $settings['attributes']['id']; ?>">
            <?php
                $this->render_content($fields);
            ?>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    protected function render_content($fields, $block_id) {
        echo '<p>Base block content</p>';
    }
}
?>
