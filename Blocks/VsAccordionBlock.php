<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;

class VsAccordionBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs_accordion_block', 'VS Accordion Block', 'format-image');
    }

    protected function generate_accordion_heading_background_styles($fields, $block_id) {
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
        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_accordion_separator_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;
            $styles[] = $this->get_css_rule($block_id, 'border-bottom-style', 'solid');
            $styles[] = $this->get_css_rule($block_id, 'border-top-style', 'solid');
            if (!empty($settings['height'])) {
                $styles[] = $this->get_css_rule($block_id, 'border-bottom-width',$settings['height']);
                $styles[] = $this->get_css_rule($block_id . ':first-child', 'border-top-width',$settings['height']);
            }
            if (!empty($settings['color'])) {
                $styles[] = $this->get_css_rule($block_id, 'border-bottom-color',$settings['color']);
                $styles[] = $this->get_css_rule($block_id . ':first-child', 'border-top-color',$settings['color']);
            }
        }
        return implode(' ', array_filter($styles));
    }

    protected function generate_accordion_padding_styles($fields, $block_id) {
        $styles = [];
        if (!empty($fields)) {
            $settings = $fields;

            //General
            if (!empty($settings['desktop'])) {
                if (!empty($settings['desktop']['padding_top'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-top', $settings['desktop']['padding_top']);
                }
                if (!empty($settings['desktop']['padding_bottom'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-bottom', $settings['desktop']['padding_bottom']);
                }
                if (!empty($settings['desktop']['padding_left'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-left', $settings['desktop']['padding_left']);
                }
                if (!empty($settings['desktop']['padding_right'])) {
                    $styles[] = $this->get_css_rule($block_id, 'padding-right', $settings['desktop']['padding_right']);
                }
            }


            if (!empty($settings['tablet'])) {
                if (!empty($settings['tablet']['padding_top'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-top', $settings['tablet']['padding_top']) . " }";
                }
                if (!empty($settings['tablet']['padding_bottom'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-bottom', $settings['tablet']['padding_bottom']) . " }";
                }
                if (!empty($settings['tablet']['padding_left'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-left', $settings['tablet']['padding_left']) . " }";
                }
                if (!empty($settings['tablet']['padding_right'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'padding-right', $settings['tablet']['padding_right']) . " }";
                }
            }


            if (!empty($settings['mobile'])) {
                if (!empty($settings['mobile']['padding_top'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-top', $settings['mobile']['padding_top']) . " }";
                }
                if (!empty($settings['mobile']['padding_bottom'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-bottom', $settings['mobile']['padding_bottom']) . " }";
                }
                if (!empty($settings['mobile']['padding_left'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-left', $settings['mobile']['padding_left']) . " }";
                }
                if (!empty($settings['mobile']['padding_right'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'padding-right', $settings['mobile']['padding_right']) . " }";
                }
            }
        }

        return implode(' ', array_filter($styles));
    }


    protected function render_content($fields, $block_id) {

        $settings = !empty($fields['accordion_block_settings']) ? $fields['accordion_block_settings'] : '';

        if (isset($settings['heading_background']) && !empty($settings['heading_background'])) {
            $heading_background_styles = $this->generate_accordion_heading_background_styles($settings['heading_background'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_background_styles . '</style>'; // Add styles
        }
        if (isset($settings['separator']) && !empty($settings['separator'])) {
            $accordion_separator_styles = $this->generate_accordion_separator_styles($settings['separator'], $block_id . ' .vs-accordion_item');
            echo '<style>' . $accordion_separator_styles . '</style>'; // Add styles
        }

        if (isset($settings['heading_padding']) && !empty($settings['heading_padding'])) {
            $heading_padding_styles = $this->generate_accordion_padding_styles($settings['heading_padding'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_padding_styles . '</style>'; // Add styles
        }
        if (isset($settings['content_padding']) && !empty($settings['content_padding'])) {
            $content_padding_styles = $this->generate_accordion_padding_styles($settings['content_padding'], $block_id . ' .vs-accordion_content');
            echo '<style>' . $content_padding_styles . '</style>'; // Add styles
        }

        if (isset($settings['heading_typography']) && !empty($settings['heading_typography'])) {
            $heading_typography_styles = $this->generate_typography_styles($settings['heading_typography'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_typography_styles . '</style>'; // Add styles
        }
        if (isset($settings['content_typography']) && !empty($settings['content_typography'])) {
            $heading_typography_styles = $this->generate_typography_styles($settings['content_typography'], $block_id . ' .vs-accordion_content');
            echo '<style>' . $heading_typography_styles . '</style>'; // Add styles
        }

        if (!empty($settings)) {
            if (!empty($settings['items'])) { ?>
                <div class="vs-accordion-list">
                    <?php foreach ($settings['items'] as $items) { ?>
                        <div class="vs-accordion_item">
                            <div class="vs-accordion_btn"><?= !empty($items['heading']) ? $items['heading'] : 'Open' ;?></div>
                            <div  class="vs-accordion_panel">
                                <div class="vs-accordion_content">
                                    <?= !empty($items['content']) ? $items['content'] : '' ;?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }
        }
    }
}

new VsImageBlock();
