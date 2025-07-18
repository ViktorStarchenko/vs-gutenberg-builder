<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;

class VsImageSectionBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs_image_block', 'VS Image Block', 'format-image');
    }

    protected function generate_image_block_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields['image_block_settings'])) {
            $settings = $fields['image_block_settings'];

            if (!empty($settings['block_settings'])) {
                $block_settings = $settings['block_settings'];

                //flex-direction
                if (!empty($block_settings['direction'])) {
                    if (!empty($block_settings['direction']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'flex-direction', $block_settings['direction']['desktop']);
                    }
                    if (!empty($block_settings['direction']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'flex-direction', $block_settings['direction']['tablet']) . " }";
                    }
                    if (!empty($block_settings['direction']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'flex-direction', $block_settings['direction']['mobile']) . " }";
                    }
                }

                //flex-wrap
                if (!empty($block_settings['wrap_images'])) {
                    if (!empty($block_settings['wrap_images']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'flex-wrap', $block_settings['wrap_images']['desktop']);
                    }
                    if (!empty($block_settings['wrap_images']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'flex-wrap', $block_settings['wrap_images']['tablet']) . " }";
                    }
                    if (!empty($block_settings['wrap_images']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'flex-wrap', $block_settings['wrap_images']['mobile']) . " }";
                    }
                }
                //Gap
                if (!empty($block_settings['column_gap'])) {
                    if (!empty($block_settings['column_gap']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'column-gap', $block_settings['column_gap']['desktop']);
                    }
                    if (!empty($block_settings['column_gap']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'column-gap', $block_settings['column_gap']['tablet']) . " }";
                    }
                    if (!empty($block_settings['column_gap']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'column-gap', $block_settings['column_gap']['mobile']) . " }";
                    }
                }
                if (!empty($block_settings['row_gap'])) {
                    if (!empty($block_settings['row_gap']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'row-gap', $block_settings['row_gap']['desktop']);
                    }
                    if (!empty($block_settings['row_gap']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'row-gap', $block_settings['row_gap']['tablet']) . " }";
                    }
                    if (!empty($block_settings['row_gap']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'row-gap', $block_settings['row_gap']['mobile']) . " }";
                    }
                }

                if (!empty($block_settings['horizontal_alignment'])) {
                    if (!empty($block_settings['horizontal_alignment']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'justify-content', $block_settings['horizontal_alignment']['desktop']);
                    }
                    if (!empty($block_settings['horizontal_alignment']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'justify-content', $block_settings['horizontal_alignment']['tablet']) . " }";
                    }
                    if (!empty($block_settings['horizontal_alignment']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'justify-content', $block_settings['horizontal_alignment']['mobile']) . " }";
                    }
                }

                if (!empty($block_settings['vertical_alignment'])) {
                    if (!empty($block_settings['horizontal_alignment']['desktop'])) {
                        $styles[] = $this->get_css_rule($block_id . ' .vs-images-list', 'align-items', $block_settings['vertical_alignment']['desktop']);
                    }
                    if (!empty($block_settings['vertical_alignment']['tablet'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'align-items', $block_settings['vertical_alignment']['tablet']) . " }";
                    }
                    if (!empty($block_settings['vertical_alignment']['mobile'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id . ' .vs-images-list', 'align-items', $block_settings['vertical_alignment']['mobile']) . " }";
                    }
                }
            }

        }

        return implode(' ', array_filter($styles));
    }

    protected function generate_image_single_styles($fields, $uniq_class) {
        $styles = [];

        if (!empty($fields)) {
            $settings = $fields;

            if (!empty($settings['width'])) {
                if (!empty($settings['width']['desktop'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'width', $settings['width']['desktop']);
                }
                if (!empty($settings['width']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($uniq_class, 'width', $settings['width']['tablet']) . " }";
                }
                if (!empty($settings['width']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($uniq_class, 'width', $settings['width']['mobile']) . " }";
                }
            }
            if (!empty($settings['height'])) {
                if (!empty($settings['height']['desktop'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'height', $settings['height']['desktop']);
                }
                if (!empty($settings['height']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($uniq_class, 'height', $settings['height']['tablet']) . " }";
                }
                if (!empty($settings['height']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($uniq_class, 'height', $settings['height']['mobile']) . " }";
                }
            }
            if (!empty($settings['border'])) {
                if (!empty($settings['border']['color'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'border-color', $settings['border']['color']);
                }
                if (!empty($settings['border']['width'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'border-width', $settings['border']['width']);
                }
                if (!empty($settings['border']['style'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'border-style', $settings['border']['style']);
                }
                if (!empty($settings['border']['radius'])) {
                    $styles[] = $this->get_css_rule($uniq_class, 'border-radius', $settings['border']['radius']);
                }
            }

        }

        return implode(' ', array_filter($styles));
    }

    protected function render_content($fields, $block_id) {

        $settings = $fields['image_block_settings'];

        $image_block_styles = $this->generate_image_block_styles($fields, $block_id);
        echo '<style>' . $image_block_styles . '</style>'; // Add styles
        ?>
        <div class="vs-images-list">
            <?php if (!empty($settings['images'])) { ?>
                <?php foreach($settings['images'] as $image) { ?>
                    <?php
                    $uniq_id = wp_rand();
                    $uniq_class = 'vs-images-list--item-' . $uniq_id;
                        $image_single_styles = $this->generate_image_single_styles($image, $uniq_class);
                    echo '<style>' . $image_single_styles . '</style>'; // Add styles
                    if (!empty($image['image_desktop'])) { ?>
                        <div class="vs-images-list--item <?=$uniq_class;?>">
                            <picture>
                                <?php if (!empty($image['image_mobile'])) { ?>
                                    <source media="(max-width: 767px)" srcset="<?=$image['image_mobile']['url'];?>">
                                <?php } ?>
                                <img class="<?=!empty($image['object_fit']) ? $image['object_fit'] : 'vs-image-contain';?>" src="<?=$image['image_desktop']['url'];?>" alt="<?=$image['image_desktop']['title'];?>">
                            </picture>
                        </div>
                    <?php } ?>

                <?php } ?>
            <?php } ?>
        </div>
        <?php

        if (!empty($fields['image'])) {
            echo '<img src="' . esc_url($fields['image']['url']) . '" alt="' . esc_attr($fields['image']['alt']) . '">';
        }
    }
}

new VsImageSectionBlock();
