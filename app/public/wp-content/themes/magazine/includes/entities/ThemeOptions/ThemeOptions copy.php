<?php

if(!defined('ABSPATH')) {
    exit;
}

const PARENT_PAGE_FIELD = 'theme-options';

const SUBPAGES = [
    'header' => [
        'title' => 'Cabeçalho',
        'graphql'    => [
            'object_name' => 'ThemeOptionsHeader',
            'object_slug' => 'themeOptionsHeader',
        ],
        'fields'     => [
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
        ],
    ],
    'home' => [
        'title' => 'Página inicial',
        'graphql'    => [
            'object_name' => 'ThemeOptionsHome',
            'object_slug' => 'themeOptionsHome',
        ],
        'fields' => [
            'homeFeaturedPost' => [
                'key' => 'group_660733359c7e4',
                'title' => 'Post Destacado',
                'fields' => [
                    [
                        'key' => 'field_6607333524b09',
                        'label' => 'Post destacado',
                        'name' => 'homeFeaturedPost',
                        'aria-label' => '',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'post_type' => [
                            'post',
                        ],
                        'post_status' => [
                            'publish',
                        ],
                        'taxonomy' => '',
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'bidirectional' => 0,
                        'ui' => 1,
                        'bidirectional_target' => [],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'home',
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
            'homePostsList' => [
                'key' => 'group_66099a691fcec',
                'title' => 'Listas de Posts',
                'fields' => [
                    [
                        'key' => 'field_66099a69857d6',
                        'label' => 'Coluna de Posts',
                        'name' => 'homePostsList',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'layout' => 'table',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => '',
                        'button_label' => 'Adicionar linha',
                        'rows_per_page' => 20,
                        'sub_fields' => [
                            [
                                'key' => 'field_66099aa6857d7',
                                'label' => 'Posts',
                                'name' => 'posts',
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
                                'add_term' => 0,
                                'save_terms' => 0,
                                'load_terms' => 0,
                                'return_format' => 'id',
                                'field_type' => 'select',
                                'allow_null' => 1,
                                'bidirectional' => 0,
                                'multiple' => 0,
                                'bidirectional_target' => [],
                                'parent_repeater' => 'field_66099a69857d6',
                            ],
                            [
                                'key' => 'field_66099af7857d8',
                                'label' => 'Sidebar',
                                'name' => 'sidebar',
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
                                'add_term' => 0,
                                'save_terms' => 0,
                                'load_terms' => 0,
                                'return_format' => 'id',
                                'field_type' => 'select',
                                'allow_null' => 0,
                                'bidirectional' => 0,
                                'multiple' => 0,
                                'bidirectional_target' => [],
                                'parent_repeater' => 'field_66099a69857d6',
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'home',
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
        ],
    ],
];

class ThemeOptions
{
    public function __construct() 
    {
        add_action('acf/init', [$this, 'register_page']);
        add_action('acf/init', [$this, 'register_sub_pages']);

        add_action('acf/include_fields', [$this, 'register_sub_page_fields']);
        add_action('graphql_register_types', [$this, 'register_sub_page_fields_graphql']);
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

        foreach(SUBPAGES as $menu_slug => $page) {
            acf_add_options_page([
                'page_title' => $page['title'],
                'menu_slug' => $menu_slug,
                'parent_slug' => PARENT_PAGE_FIELD,
                'redirect' => false,
            ]);
        }
    }

    public function register_sub_page_fields() 
    {
        if(!function_exists('acf_add_local_field_group')) {
            return;
        }

        foreach(SUBPAGES as $page) {
            foreach($page['fields'] as $fields) {
                acf_add_local_field_group($fields);  
            }
        }
    }

    public function register_sub_page_fields_graphql() 
    {
        foreach(SUBPAGES as $page) {
            register_graphql_object_type($page['graphql']['object_name'], [
                'description' => 'Teste',
                'fields' => [
                    'data' => ['type' => 'String'],
                ],
            ]);

            register_graphql_field( 'RootQuery', $page['graphql']['object_slug'], [
                'type' => $page['graphql']['object_name'],
                'resolve' => function () use ($page){
                    $subpage_fields = [];
    
                    foreach($page['fields'] as $key => $field) {
                        $subpage_fields[$key] = get_field($key, 'option') ?? '';
                    }
        
                    $subpage_fields_json_encoded = json_encode($subpage_fields);

                    return [
                        'data' => $subpage_fields_json_encoded,
                    ];
                },
            ]);
        }
    }
}

//new ThemeOptions();