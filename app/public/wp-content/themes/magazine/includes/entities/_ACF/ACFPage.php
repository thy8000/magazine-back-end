<?php

if(!defined('ABSPATH')) {
    exit;
}

class ACFPage {
    function __construct($args = []) {
        if (!function_exists('acf_add_options_page') || !function_exists('acf_add_options_sub_page') || !function_exists('acf_add_local_field_group')) {
            return;
        }

        $this->args = [
            'page_title' => sprintf(esc_html__("%s", 'magazine'), $args['page_title']),
            'menu_slug' => $args['menu_slug'],
        ];

        if(!empty($args['position'])) {
            $this->args['position'] = $args['position'];
        }

        if(!empty($args['redirect'])) {
            $this->args['redirect'] = $args['redirect'];
        }

        if(!empty($args['parent_slug'])) {
            $this->args['parent_slug'] = $args['parent_slug'];
        }

        if(!empty($args)) {
            $this->register_page();
        }
    }

    public function register_page() {
        if(!empty($this->args['parent_slug'])) {
            acf_add_options_sub_page($this->args);

            return;
        }

        acf_add_options_page($this->args);

        return;
    }

    public function register_fields($fields) {
        acf_add_local_field_group($fields);
    }
}