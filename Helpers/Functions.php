<?php

namespace VSGutenberg\Helpers;

if (!function_exists('VSGutenberg\Helpers\simple_slug')) {

    function simple_slug($text) {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '_', $text);
        return trim($text, '-');
    }

}
