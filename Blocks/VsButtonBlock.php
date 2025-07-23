<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;

class VsButtonBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs_button_block', 'VS Button Block', 'editor-text');
    }

    protected function generate_single_button_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields)) {
            $settings = $fields;

            if (!empty($settings['width'])) {
                if (!empty($settings['width']['desktop'])) {
                    if (!empty($settings['width']['desktop']['min_width'])) {
                        $styles[] = $this->get_css_rule($block_id, 'min-width', $settings['width']['desktop']['min_width']);
                    }
                    if (!empty($settings['width']['desktop']['stretch'] == true)) {
                        $styles[] = $this->get_css_rule($block_id, 'flex', '1');
                    }
                }
                if (!empty($settings['width']['tablet'])) {
                    if (!empty($settings['width']['tablet']['min_width'])) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'min-width', $settings['width']['tablet']['min_width']) . " }";
                    }
                    if (!empty($settings['width']['tablet']['stretch'] == true)) {
                        $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'flex', '1') . " }";
                    }
                }
                if (!empty($typography['width']['mobile'])) {
                    if (!empty($settings['width']['mobile']['min_width'])) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'min-width', $settings['width']['mobile']['min_width']) . " }";
                    }
                    if (!empty($settings['width']['mobile']['stretch'] == true)) {
                        $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'flex', '1') . " }";
                    }
                }
            }

            if (!empty($settings['border'])) {
                if (!empty($settings['border']['width'])) {
                    $styles[] = $this->get_css_rule($block_id, 'border-width', $settings['border']['width']);
                    $styles[] = $this->get_css_rule($block_id, 'border-style', 'solid');
                }
                if (!empty($settings['border']['color'])) {
                    $styles[] = $this->get_css_rule($block_id, 'border-color', $settings['border']['color']);
                    $styles[] = $this->get_css_rule($block_id, 'border-style', 'solid');
                }
                if (!empty($settings['border']['radius'])) {
                    $styles[] = $this->get_css_rule($block_id, 'border-radius', $settings['border']['radius']);
                    $styles[] = $this->get_css_rule($block_id, 'border-style', 'solid');
                }
            }
            if (!empty($settings['border_hover'])) {
                if (!empty($settings['border_hover']['width'])) {
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-width', $settings['border_hover']['width']);
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-style', 'solid');
                }
                if (!empty($settings['border_hover']['color'])) {
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-color', $settings['border_hover']['color']);
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-style', 'solid');
                }
                if (!empty($settings['border_hover']['radius'])) {
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-radius', $settings['border_hover']['radius']);
                    $styles[] = $this->get_css_rule($block_id . ':hover', 'border-style', 'solid');
                }
            }

        }



        return implode(' ', array_filter($styles));
    }

    protected function render_content($fields, $block_id) {
        $content__uniq_class = 'vs-custom-button-block-' . wp_rand();
        if (empty($fields['button_block_settings'])) {
            return;
        }
        $buttons_settings = $fields['button_block_settings'];
        $classes = 'vs-custom-button-block';
        $classes .= ' ' . $content__uniq_class;
        $classes .= ' vs-d-flex';

        if (isset($buttons_settings['flex_alignment']) && !empty($buttons_settings['flex_alignment'])) {
            $alignment_styles = $this->generate_flex_alignment_styles($buttons_settings['flex_alignment'], $content__uniq_class);
            echo '<style>' . $alignment_styles . '</style>'; // Add styles
        }

        ob_start();
        if (!empty($buttons_settings['items'])) { ?>
            <div class="<?= $classes;?>" id="">
                <?php foreach ($buttons_settings['items'] as $item) {
//                    dd($item);
                    $vs_button_uniq_id = 'vs-button-' . wp_rand();
                    $vs_button_casses = $vs_button_uniq_id;
                    $vs_button_casses .= ' vs-button';
                    $single_button_styles = $this->generate_single_button_styles($item, $vs_button_uniq_id);
                    echo '<style>' . $single_button_styles . '</style>'; // Add styles

                    if (isset($item['typography']) && !empty($item['typography'])) {
                        $typography_styles = $this->generate_typography_styles($item['typography'], $vs_button_uniq_id);
                        echo '<style>' . $typography_styles . '</style>'; // Add styles
                    }
                    if (isset($item['typography_hover']) && !empty($item['typography_hover'])) {
                        $typography_hover_styles = $this->generate_typography_styles($item['typography_hover'], $vs_button_uniq_id . ':hover');
                        echo '<style>' . $typography_hover_styles . '</style>'; // Add styles
                    }

                    if (isset($item['background']) && !empty($item['background'])) {
                        $background_styles = $this->generate_background_styles($item['background'], $vs_button_uniq_id);
                        echo '<style>' . $background_styles . '</style>'; // Add styles
                    }
                    if (isset($item['background_hover']) && !empty($item['background_hover'])) {
                        $background_hover_styles = $this->generate_background_styles($item['background_hover'], $vs_button_uniq_id . ':hover');
                        echo '<style>' . $background_hover_styles . '</style>'; // Add styles
                    }

                    if ($item['type'] == 'link') {
                        if (!empty($item['link'])) { ?>
                            <a class="<?=$vs_button_casses;?>" href="<?= $item['link']['url'];?>" target="<?= $item['link']['target'];?>">
                                <span class="vs-btn-inner"><?= $item['link']['title'];?></span>
                                <?php if (isset($item['icon']['image']) && !empty($item['icon']['image'])) { ?>
                                    <img class="vs-btn-icon <?= !empty($item['icon']['position']) ? ' ' . $item['icon']['position'] : ''; ?>" src="<?= $item['icon']['image']['url'];?>" alt="<?= $item['icon']['image']['title'];?>">
                                <?php } ?>
                            </a>
                        <?php }
                    } else if ($item['type'] == 'file') {
                        if (!empty($item['file'])) { ?>
                            <a download class="<?=$vs_button_casses;?>" href="<?= $item['file']['url'];?>" target="<?= $item['link']['target'];?>">
                                <span class="vs-btn-inner"><?= $item['file_text'];?></span>
                                <?php if (isset($item['icon']['image']) && !empty($item['icon']['image'])) { ?>
                                    <img class="vs-btn-icon <?= !empty($item['icon']['position']) ? ' ' . $item['icon']['position'] : ''; ?>" src="<?= $item['icon']['image']['url'];?>" alt="<?= $item['icon']['image']['title'];?>">
                                <?php } ?>
                            </a>
                        <?php }
                    } ?>
                <?php } ?>
            </div>
        <?php } ?>
        <?php
        echo ob_get_clean();
    }
}

new VsButtonBlock();

