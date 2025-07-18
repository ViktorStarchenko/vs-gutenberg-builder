<?php

namespace VSGutenberg\Sections;

use VSGutenberg\Classes\BaseSectionBlock;

if (!defined('ABSPATH')) exit;

class VsSectionBlock extends BaseSectionBlock {

    public function __construct() {
        parent::__construct('section_block', 'VS Section Block', 'editor-text');
    }

    protected function render_content($fields) {
        echo '<InnerBlocks />';
    }
}
