<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;

class VsImageBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs_image_block', 'VS Image Block', 'format-image');
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
        $content__uniq_class = 'vs-images-list-' . wp_rand();
        $settings = $fields['image_block_settings'];
        $classes = $content__uniq_class;
        $classes .= ' vs-images-list';

        if (isset($settings['flex_alignment']) && !empty($settings['flex_alignment'])) {
            $alignment_styles = $this->generate_flex_alignment_styles($settings['flex_alignment'], $content__uniq_class);
            echo '<style>' . $alignment_styles . '</style>'; // Add styles
        }

        ?>
        <div class="<?= $classes;?>">
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

new VsImageBlock();
