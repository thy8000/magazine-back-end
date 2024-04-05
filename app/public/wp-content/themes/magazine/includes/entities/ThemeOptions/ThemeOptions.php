<?php
if (!defined('ABSPATH')) {
    exit;
}

class ThemeOptions
{
    public function __construct() 
    {
        $ThemeOptionsFields = new ThemeOptionsFields();

        $this->parent_page_acf = $ThemeOptionsFields->get_acf_parent();
        $this->parent_page_graphql = $ThemeOptionsFields->get_graphql_parent();

        $this->sub_pages_acf = $ThemeOptionsFields->get_acf_sub_pages();
        $this->sub_pages_graphql = $ThemeOptionsFields->get_graphql_sub_pages();

        add_action('acf/init', [$this, 'register_acf_fields']);
        add_action('graphql_register_types', [$this, 'register_graphql_types']);
    }

    public function register_acf_fields() 
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        $this->register_parent_page();

        foreach ($this->sub_pages_acf as $key => $sub_page) {
            acf_add_options_sub_page([
                'page_title' => sprintf("%s", $sub_page['title']),
                'menu_slug' => $key,
                'parent_slug' => $this->parent_page_acf['menu_slug'],
            ]);

            foreach ($sub_page['fields'] as $fields) {
                acf_add_local_field_group($fields);
            }
        }
    }

    private function register_parent_page() 
    {
        acf_add_options_page([
            ...$this->parent_page_acf
        ]);
    }

    public function register_graphql_types() 
    {
        $this->register_graphql_parent_object_type();

        foreach ($this->sub_pages_graphql as $key => $sub_page) {
            $this->register_graphql_object_type($sub_page);
            $this->register_graphql_interface_type($sub_page);
        }
    }

    private function register_graphql_parent_object_type() {
        register_graphql_object_type($this->parent_page_graphql['slug'], [
            'fields' => [],
        ]);

        register_graphql_field('RootQuery', $this->parent_page_graphql['slug'], [
            'type' => $this->parent_page_graphql['slug'],
            'resolve' => function() {
              return [];
            }
        ]);
    }

    private function register_graphql_object_type($sub_page) 
    {
        register_graphql_object_type($sub_page['parent_slug'], [
            'fields' => [],
        ]);

        register_graphql_field($this->parent_page_graphql['slug'], $sub_page['parent_slug'], [
            'type' => $sub_page['parent_slug'],
            'resolve' => function() {
                return [];
            }
        ]);
    }

    private function register_graphql_interface_type($sub_page) 
    {
        register_graphql_interface_type($sub_page['interface']['slug'], [
            'fields' => [
                ...$sub_page['interface']['fields'],
            ],
        ]);

        register_graphql_interfaces_to_types([$sub_page['interface']['slug']], [$sub_page['parent_slug']]);
    }
}

new ThemeOptions();
