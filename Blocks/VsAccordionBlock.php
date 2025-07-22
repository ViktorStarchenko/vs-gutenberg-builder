<?php

namespace VSGutenberg\Blocks;

use VSGutenberg\Classes\BaseElementBlock;

if (!defined('ABSPATH')) exit;

class VsAccordionBlock extends BaseElementBlock {
    public function __construct() {
        parent::__construct('vs_accordion_block', 'VS Accordion Block', 'format-image');
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

    protected function render_content($fields, $block_id) {

        $settings = !empty($fields['accordion_block_settings']) ? $fields['accordion_block_settings'] : '';

        if (isset($settings['heading_background']) && !empty($settings['heading_background'])) {
            $heading_background_styles = $this->generate_background_styles($settings['heading_background'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_background_styles . '</style>';
        }
        if (isset($settings['separator']) && !empty($settings['separator'])) {
            $accordion_separator_styles = $this->generate_accordion_separator_styles($settings['separator'], $block_id . ' .vs-accordion_item');
            echo '<style>' . $accordion_separator_styles . '</style>';
        }

        if (isset($settings['heading_padding']) && !empty($settings['heading_padding'])) {
            $heading_padding_styles = $this->generate_padding_styles($settings['heading_padding'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_padding_styles . '</style>';
        }
        if (isset($settings['content_padding']) && !empty($settings['content_padding'])) {
            $content_padding_styles = $this->generate_padding_styles($settings['content_padding'], $block_id . ' .vs-accordion_content');
            echo '<style>' . $content_padding_styles . '</style>';
        }

        if (isset($settings['heading_typography']) && !empty($settings['heading_typography'])) {
            $heading_typography_styles = $this->generate_typography_styles($settings['heading_typography'], $block_id . ' .vs-accordion_btn');
            echo '<style>' . $heading_typography_styles . '</style>';
        }
        if (isset($settings['content_typography']) && !empty($settings['content_typography'])) {
            $heading_typography_styles = $this->generate_typography_styles($settings['content_typography'], $block_id . ' .vs-accordion_content');
            echo '<style>' . $heading_typography_styles . '</style>';
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
