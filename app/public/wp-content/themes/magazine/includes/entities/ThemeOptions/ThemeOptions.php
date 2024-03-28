<?php

if(!defined('ABSPATH')) {
    exit;
}

const PARENT_PAGE_FIELD = 'theme-options';

const HEADER_SUBPAGE_FIELDS = [
    'categoriesList' => [
        'key' => 'group_65fe1003a0974',
        'title' => 'Categorias',
        'fields' => [
            [
                'key' => 'field_65fe105c97b09',
                'label' => 'Lista de Categorias',
                'name' => 'categoriesList',
                'aria-label' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'category',
                'add_term' => 1,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'object',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'bidirectional' => 0,
                'multiple' => 0,
                'bidirectional_target' => [],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'header',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ],
    'transparentHeader' => [
        'key' => 'group_6604b54cb74cc',
        'title' => 'Cabeçalho transparente',
        'fields' => [
            [
                'key' => 'field_6604b54c8d372',
                'label' => 'Cabeçalho transparente',
                'name' => 'transparentHeader',
                'aria-label' => '',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'header',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,      
    ],
];

class ThemeOptions
{
    public function __construct() 
    {
        add_action('acf/init', [$this, 'register_page']);
        add_action('acf/init', [$this, 'register_sub_pages']);

        add_action('acf/include_fields', [$this, 'register_header_subpage_fields']);
        add_action('graphql_register_types', [$this, 'register_header_subpage_fields_graphql']);
    }

    public function register_page() 
    {
        if(!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => esc_html__('Opções do Tema', 'magazine'),
            'menu_slug' => PARENT_PAGE_FIELD,
            'position' => 2,
            'redirect' => true,
        ]);
    }

    public function register_sub_pages() 
    {
        if(!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => esc_html__('Cabeçalho', 'magazine'),
            'menu_slug' => 'header',
            'parent_slug' => PARENT_PAGE_FIELD,
            'position' => 1,
            'redirect' => false,
        ]);
    }

    public function register_header_subpage_fields() 
    {
        if(!function_exists('acf_add_local_field_group')) {
            return;
        }

        foreach(HEADER_SUBPAGE_FIELDS as $fields) {
            //debug($fields);

            acf_add_local_field_group($fields);        
        }
    }

    public function register_header_subpage_fields_graphql() 
    {
        register_graphql_object_type('ThemeOptionsHeader', [
            'description' => __('Logo personalizado do Customizer', 'magazine'),
            'fields' => [
                'data' => ['type' => 'String'],
            ],
        ]);

        register_graphql_field( 'RootQuery', 'themeOptionsHeader', [
            'type' => 'ThemeOptionsHeader',
            'resolve' => function () {
                $header_subpage_fields = [];

                foreach(HEADER_SUBPAGE_FIELDS as $key => $header_field) {
                    $header_subpage_fields[$key] = get_field($key, 'option') ?? '';
                }

                return [
                    'data' => json_encode($header_subpage_fields),
                ];
            },
        ]);
    }
}

new ThemeOptions();