<?php

if(!defined('ABSPATH')) {
    exit;
}

class GlobalSettings
{
    public function __construct() {
        add_action('after_setup_theme', [$this, 'register_theme_support']);
    }

    public function register_theme_support() {
        add_theme_support('post-thumbnails');
    }
}

new GlobalSettings();