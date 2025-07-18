<?php

namespace VSGutenberg\Classes;

if (!defined('ABSPATH')) exit;

abstract class BaseElementBlock {

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
        $plugin_url = plugins_url('../assets/css/', __FILE__);

        if (is_admin()) {
            wp_enqueue_style('vs-section-admin', $plugin_url . 'acf-gutenberg-style-admin.css', [], '1.0');
        } else {
            wp_enqueue_style('vs-section-front', $plugin_url . 'acf-gutenberg-style.css', [], '1.0');
        }
    }

    public function render_callback($block) {
        $fields = get_fields();
        $block_id = uniqid('custom-block-');
        $styles = $this->generate_section_styles($fields, $block_id);
        $typography_styles = $this->generate_typography_styles($fields, $block_id);

        $settings = $fields['element_settings'];
        $visibility_classes = !empty($settings['visibility']) ? implode(' ', $settings['visibility']) : '';
        $classes = esc_attr($block_id);
        if (!empty($settings['attributes']['class'])) {
            $classes .= ' ' . $settings['attributes']['class'];
        }
        $classes .= ' ' . $visibility_classes;
        $id = '';
        if (!empty($settings['attributes']['id'])) {
            $id .= ' id="' . $settings['attributes']['id']. '"';
        }

        echo '<style>' . $styles . '</style>'; // Add styles to the page
        echo '<style>' . $typography_styles . '</style>'; // Add styles to the page
        echo '<div class="' . $classes . '" '.$id.'>';
        $this->render_content($fields, $block_id);
        echo '</div>';
    }

    protected function generate_section_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields['element_settings'])) {
            $settings = $fields['element_settings'];
            $general = $settings['general'];


            $bg_image = $settings['background']['image'];

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


            if (!empty($settings['max_width'])) {
                if (!empty($settings['max_width']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'max-width', $settings['max_width']['desktop']);
                }
                if (!empty($settings['max_width']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'max-width', $settings['max_width']['tablet']) . " }";
                }
                if (!empty($settings['max_width']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'max-width', $settings['max_width']['mobile']) . " }";
                }
            }

            // Min Height
            if (!empty($settings['min_height'])) {
                if (!empty($settings['min_height']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'min-height', $settings['min_height']['desktop']);
                }
            }
            if (!empty($settings['min_height'])) {
                if (!empty($settings['min_height']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'min-height', $settings['min_height']['tablet']) . " }";
                }
            }
            if (!empty($settings['min_height'])) {
                if (!empty($settings['min_height']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'min-height', $settings['min_height']['mobile']) . " }";
                }
            }

            //Background
            if (!empty($bg_image['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'background-image','url('.$bg_image['desktop']['url'].')');
            }
            if (!empty($bg_image['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['tablet']['url'].')') . " }";
            }
            if (!empty($bg_image['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['mobile']['url'].')') . " }";
            }


            //General
            if (!empty($general['desktop'])) {
                //margin
                if (!empty($general['desktop']['margin-top'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-top', $general['desktop']['margin-top']);
                }
                if (!empty($general['desktop']['margin-bottom'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-bottom', $general['desktop']['margin-bottom']);
                }
                if (!empty($general['desktop']['margin-left'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-left', $general['desktop']['margin-left']);
                }
                if (!empty($general['desktop']['margin-right'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-right', $general['desktop']['margin-right']);
                }
                //padding
                if (!empty($general['desktop']['padding-top'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-top', $general['desktop']['padding-top']);
                }
                if (!empty($general['desktop']['padding-bottom'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-bottom', $general['desktop']['padding-bottom']);
                }
                if (!empty($general['desktop']['padding-left'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-left', $general['desktop']['padding-left']);
                }
                if (!empty($general['desktop']['padding-right'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-right', $general['desktop']['padding-right']);
                }
            }


            if (!empty($general['tablet'])) {
                //margin
                if (!empty($general['tablet']['margin-top'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-top', $general['tablet']['margin-top']) . " }";
                }
                if (!empty($general['tablet']['margin-bottom'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-bottom', $general['tablet']['margin-bottom']) . " }";
                }
                if (!empty($general['tablet']['margin-left'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-left', $general['tablet']['margin-left']) . " }";
                }
                if (!empty($general['tablet']['margin-right'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-right', $general['tablet']['margin-right']) . " }";
                }
                //padding
                if (!empty($general['tablet']['padding-top'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-top', $general['tablet']['padding-top']) . " }";
                }
                if (!empty($general['tablet']['padding-bottom'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-bottom', $general['tablet']['padding-bottom']) . " }";
                }
                if (!empty($general['tablet']['padding-left'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-left', $general['tablet']['padding-left']) . " }";
                }
                if (!empty($general['tablet']['padding-right'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-right', $general['tablet']['padding-right']) . " }";
                }
            }


            if (!empty($general['mobile'])) {
                //margin
                if (!empty($general['mobile']['margin-top'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-top', $general['mobile']['margin-top']) . " }";
                }
                if (!empty($general['mobile']['margin-bottom'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-bottom', $general['mobile']['margin-bottom']) . " }";
                }
                if (!empty($general['mobile']['margin-left'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-left', $general['mobile']['margin-left']) . " }";
                }
                if (!empty($general['mobile']['margin-right'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-right', $general['mobile']['margin-right']) . " }";
                }
                //padding
                if (!empty($general['mobile']['padding-top'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-top', $general['mobile']['padding-top']) . " }";
                }
                if (!empty($general['mobile']['padding-bottom'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-bottom', $general['mobile']['padding-bottom']) . " }";
                }
                if (!empty($general['mobile']['padding-left'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-left', $general['mobile']['padding-left']) . " }";
                }
                if (!empty($general['mobile']['padding-right'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-right', $general['mobile']['padding-right']) . " }";
                }
            }

        }

        return implode(' ', array_filter($styles)); // Видаляємо порожні значення
    }

    protected function generate_typography_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields['typography'])) {
            $typography = $fields['typography'];

            //Text Color
            if (!empty($typography['font_color'])) {
                $styles[] = $this->get_css_rule($block_id, 'color', $typography['font_color']);
            }

            //Font Size
            if (!empty($typography['font_size'])) {
                if (!empty($typography['font_size']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'font-size', $typography['font_size']['desktop']);
                }
                if (!empty($typography['font_size']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'font-size', $typography['font_size']['tablet']) . " }";
                }
                if (!empty($typography['font_size']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'font-size', $typography['font_size']['mobile']) . " }";
                }
            }
            //Line Height
            if (!empty($typography['line_height'])) {
                if (!empty($typography['line_height']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'line-height', $typography['line_height']['desktop']);
                }
                if (!empty($typography['line_height']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'line-height', $typography['line_height']['tablet']) . " }";
                }
                if (!empty($typography['line_height']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'line-height', $typography['line_height']['mobile']) . " }";
                }
            }
            //Font Weight
            if (!empty($typography['font_weight'])) {
                if (!empty($typography['font_weight']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'font-weight', $typography['font_weight']['desktop']);
                }
                if (!empty($typography['font_weight']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'font-weight', $typography['font_weight']['tablet']) . " }";
                }
                if (!empty($typography['font_weight']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'font-weight', $typography['font_weight']['mobile']) . " }";
                }
            }
        }

        return implode(' ', array_filter($styles));
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
