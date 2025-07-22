<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;


class VsTextBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs-text-block', 'VS Text Block', 'editor-text');
    }

    protected function generate_text_block_styles($fields, $block_id) {
        $styles = [];

        if (!empty($fields['text_block_settings'])) {
            $settings = $fields['text_block_settings'];

            //Text align
            if (!empty($settings['alignment'])) {
                if (!empty($settings['alignment']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'text-align', $settings['alignment']['desktop']);
                }
                if (!empty($settings['alignment']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'text-align', $settings['alignment']['tablet']) . " }";
                }
                if (!empty($typography['alignment']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'text-align', $settings['alignment']['mobile']) . " }";
                }
            }

            //Vertical Alignment
            if (!empty($settings['vertical_alignment'])) {
                if (!empty($settings['vertical_alignment']['desktop'])) {
                    $styles[] = $this->get_css_rule($block_id, 'justify-content', $settings['vertical_alignment']['desktop']);
                }
                if (!empty($settings['vertical_alignment']['tablet'])) {
                    $styles[] = "@media (max-width: 992px) { " . $this->get_css_rule($block_id, 'justify-content', $settings['vertical_alignment']['tablet']) . " }";
                }
                if (!empty($settings['vertical_alignment']['mobile'])) {
                    $styles[] = "@media (max-width: 767px) { " . $this->get_css_rule($block_id, 'justify-content', $settings['vertical_alignment']['mobile']) . " }";
                }
            }
        }

        return implode(' ', array_filter($styles));
    }

    protected function render_content($fields, $block_id) {
        $content__uniq_class = 'vs-custom-text-block-' . wp_rand();
        $text = $fields['text_block_settings']['text'] ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, quisquam?';
        $classes = 'vs-custom-text-block vs-d-flex vs-d-flex-column';
        $classes .= ' ' . $content__uniq_class;

        if (isset($fields['text_block_settings']['typography']) && !empty($fields['text_block_settings']['typography'])) {
            $typography_styles = $this->generate_typography_styles($fields['text_block_settings']['typography'], $content__uniq_class);
            echo '<style>' . $typography_styles . '</style>'; // Add styles
        }

        if (isset($fields['text_block_settings']['flex_alignment']) && !empty($fields['text_block_settings']['flex_alignment'])) {
            $alignment_styles = $this->generate_flex_alignment_styles($fields['text_block_settings']['flex_alignment'], $content__uniq_class);
            echo '<style>' . $alignment_styles . '</style>'; // Add styles
        }

        $text_styles = $this->generate_text_block_styles($fields, $content__uniq_class);
        echo '<style>' . $text_styles . '</style>'; // Add styles
        ob_start();
        ?>
        <div class="<?= $classes;?>" id=""><?= $text;?></div>
        <?php
        echo ob_get_clean();
    }
}

new VsTextBlock();

