<?php

namespace VSGutenberg\Classes\Traits;

if (!defined('ABSPATH')) exit;

trait BlockStyleGenerator
{
    protected function get_css_rule($block_id, $property, $value) {
        return !empty($value) ? ".$block_id { $property: $value; }" : '';
    }

    protected function generate_wrapper_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields)) {
            $settings = $fields;
            if (!empty($settings['max_width']) && !empty($settings['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'max-width','calc(' . $settings['max_width']. ' + ' . $settings['padding'] . ' + ' . $settings['padding'] .')');
                $styles[] = $this->get_css_rule($block_id, 'padding-left', $settings['padding']);
                $styles[] = $this->get_css_rule($block_id, 'padding-right', $settings['padding']);
            } else if (!empty($settings['max_width']) && empty($settings['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'max-width', $settings['max_width']);
            } else if (!empty($settings['padding'])) {
                $styles[] = $this->get_css_rule($block_id, 'padding-left', $settings['padding']);
                $styles[] = $this->get_css_rule($block_id, 'padding-right', $settings['padding']);
            }
        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_max_width_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;
            if (!empty($settings['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'max-width', $settings['desktop']);
            }
            if (!empty($settings['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'max-width', $settings['tablet']) . " }";
            }
            if (!empty($settings['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'max-width', $settings['mobile']) . " }";
            }

        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_min_height_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;
            if (!empty($settings['desktop'])) {
                $styles[] = $this->get_css_rule($block_id, 'min-height', $settings['desktop']);
            }
            if (!empty($settings['tablet'])) {
                $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'min-height', $settings['tablet']) . " }";
            }
            if (!empty($settings['mobile'])) {
                $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'min-height', $settings['mobile']) . " }";
            }

        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_padding_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;
            if (!empty($settings['desktop'])) {

                if (!empty($settings['desktop']['padding-top'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-top', $settings['desktop']['padding-top']);
                }
                if (!empty($settings['desktop']['padding-bottom'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-bottom', $settings['desktop']['padding-bottom']);
                }
                if (!empty($settings['desktop']['padding-left'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-left', $settings['desktop']['padding-left']);
                }
                if (!empty($settings['desktop']['padding-right'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-right', $settings['desktop']['padding-right']);
                }
            }
            if (!empty($settings['tablet'])) {
                if (!empty($settings['tablet']['padding-top'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-top', $settings['tablet']['padding-top']) . " }";
                }
                if (!empty($settings['tablet']['padding-bottom'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-bottom', $settings['tablet']['padding-bottom']) . " }";
                }
                if (!empty($settings['tablet']['padding-left'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-left', $settings['tablet']['padding-left']) . " }";
                }
                if (!empty($settings['tablet']['padding-right'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-right', $settings['tablet']['padding-right']) . " }";
                }
            }
            if (!empty($settings['mobile'])) {
                if (!empty($settings['mobile']['padding-top'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-top', $settings['mobile']['padding-top']) . " }";
                }
                if (!empty($settings['mobile']['padding-bottom'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-bottom', $settings['mobile']['padding-bottom']) . " }";
                }
                if (!empty($settings['mobile']['padding-left'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-left', $settings['mobile']['padding-left']) . " }";
                }
                if (!empty($settings['mobile']['padding-right'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-right', $settings['mobile']['padding-right']) . " }";
                }
            }
        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_margin_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;
            if (!empty($settings['desktop'])) {
                if (!empty($settings['desktop']['margin-top'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-top', $settings['desktop']['margin-top']);
                }
                if (!empty($settings['desktop']['margin-bottom'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-bottom', $settings['desktop']['margin-bottom']);
                }
                if (!empty($settings['desktop']['margin-left'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-left', $settings['desktop']['margin-left']);
                }
                if (!empty($settings['desktop']['margin-right'])) {
                    $styles[] = $this->get_css_rule($block_id, 'margin-right', $settings['desktop']['margin-right']);
                }
            }
            if (!empty($settings['tablet'])) {
                if (!empty($settings['tablet']['margin-top'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-top', $settings['tablet']['margin-top']) . " }";
                }
                if (!empty($settings['tablet']['margin-bottom'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-bottom', $settings['tablet']['margin-bottom']) . " }";
                }
                if (!empty($settings['tablet']['margin-left'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-left', $settings['tablet']['margin-left']) . " }";
                }
                if (!empty($settings['tablet']['margin-right'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'margin-right', $settings['tablet']['margin-right']) . " }";
                }
            }
            if (!empty($settings['mobile'])) {
                if (!empty($settings['mobile']['margin-top'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-top', $settings['mobile']['margin-top']) . " }";
                }
                if (!empty($settings['mobile']['margin-bottom'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-bottom', $settings['mobile']['margin-bottom']) . " }";
                }
                if (!empty($settings['mobile']['margin-left'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-left', $settings['mobile']['margin-left']) . " }";
                }
                if (!empty($settings['mobile']['margin-right'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'margin-right', $settings['mobile']['margin-right']) . " }";
                }
            }
        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_background_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields)) {
            $settings = $fields;

            $gradient_direction = 'to right';
            if ($settings['gradient_direction']) {
                $gradient_direction = $settings['gradient_direction'];
            }

            $bg_color = '';
            $bg_color_gradient = '';
            if ($settings['background_color']) {
                $gradient_array = [];
                foreach ($settings['background_color'] as $color) {
                    $gradient_array[] = $color['color'];
                }
                $gradient_string = implode(', ', $gradient_array);
                $bg_color = $gradient_array[0] .';';
                $bg_color_gradient = 'linear-gradient(' . $gradient_direction . ',' . $gradient_string . ')';
            }

            $styles[] = $this->get_css_rule($block_id, 'background-color',$bg_color);
            $styles[] = $this->get_css_rule($block_id, 'background',$bg_color_gradient);

            //Background image
            if (!empty($settings['image'])) {
                $bg_image = $settings['image'];
                if (!empty($bg_image['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'background-image','url('.$bg_image['desktop']['url'].')');
                }
                if (!empty($bg_image['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['tablet']['url'].')') . " }";
                }
                if (!empty($bg_image['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'background-image', 'url('.$bg_image['mobile']['url'].')') . " }";
                }
            }
        }

        return implode(' ', array_filter($styles));
    }

    protected function generate_typography_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields)) {
            $typography = $fields;

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

    protected function generate_flex_alignment_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields)) {
            $settings = $fields;

            //flex-direction
            if (!empty($settings['direction'])) {
                if (!empty($settings['direction']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'flex-direction', $settings['direction']['desktop']);
                }
                if (!empty($settings['direction']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'flex-direction', $settings['direction']['tablet']) . " }";
                }
                if (!empty($settings['direction']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'flex-direction', $settings['direction']['mobile']) . " }";
                }
            }

            //flex-wrap
            if (!empty($settings['wrap'])) {
                if (!empty($settings['wrap']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'flex-wrap', $settings['wrap']['desktop']);
                }
                if (!empty($settings['wrap']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'flex-wrap', $settings['wrap']['tablet']) . " }";
                }
                if (!empty($settings['wrap']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'flex-wrap', $settings['wrap']['mobile']) . " }";
                }
            }
            //Gap
            if (!empty($settings['column_gap'])) {
                if (!empty($settings['column_gap']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'column-gap', $settings['column_gap']['desktop']);
                }
                if (!empty($settings['column_gap']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'column-gap', $settings['column_gap']['tablet']) . " }";
                }
                if (!empty($settings['column_gap']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'column-gap', $settings['column_gap']['mobile']) . " }";
                }
            }
            if (!empty($settings['row_gap'])) {
                if (!empty($settings['row_gap']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'row-gap', $settings['row_gap']['desktop']);
                }
                if (!empty($settings['row_gap']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'row-gap', $settings['row_gap']['tablet']) . " }";
                }
                if (!empty($settings['row_gap']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'row-gap', $settings['row_gap']['mobile']) . " }";
                }
            }

            if (!empty($settings['horizontal_alignment'])) {
                if (!empty($settings['horizontal_alignment']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'justify-content', $settings['horizontal_alignment']['desktop']);
                }
                if (!empty($settings['horizontal_alignment']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'justify-content', $settings['horizontal_alignment']['tablet']) . " }";
                }
                if (!empty($settings['horizontal_alignment']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'justify-content', $settings['horizontal_alignment']['mobile']) . " }";
                }
            }

            if (!empty($settings['vertical_alignment'])) {
                if (!empty($settings['horizontal_alignment']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'align-items', $settings['vertical_alignment']['desktop']);
                }
                if (!empty($settings['vertical_alignment']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'align-items', $settings['vertical_alignment']['tablet']) . " }";
                }
                if (!empty($settings['vertical_alignment']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'align-items', $settings['vertical_alignment']['mobile']) . " }";
                }
            }

        }

        return implode(' ', array_filter($styles));
    }
}
