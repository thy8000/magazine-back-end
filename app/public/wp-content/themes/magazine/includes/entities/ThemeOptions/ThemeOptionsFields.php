<?php

if(!defined('ABSPATH')) {
    exit;
}

class ThemeOptionsFields
{
    public function get_acf_parent() {
        return [
            'page_title' => sprintf("%s", esc_html__('Opções do Tema', 'magazine')),
            'menu_slug' => 'theme-options',
            'position' => 2,
            'redirect' => true,
        ];
    }

    public function get_graphql_parent() {
        return [
            'slug' => 'ThemeOptions',
        ];
    }

    public function get_acf_sub_pages() {
        return [
            'header' => [
                'title' => 'Cabeçalho',
                'fields' => [
                    [
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
                                'return_format' => 'id',
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
                    [
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
        ];
    }

    public function get_graphql_sub_pages() {
        return [
            'header' => [
                'parent_slug' => 'ThemeOptionsHeader',
                'interface' => [
                    'slug' => 'ThemeOptionsHeaderInterface',
                    'fields' => [
                        'TransparentHeader' => [
                            'type' => 'Boolean',
                            'description' => 'Cabeçalho transparente',
                            'resolve' => function() {
                                $transparent_header = get_field('transparentHeader', 'option');

                                if(empty($transparent_header)) {
                                    return false;
                                }

                                return true;
                            }
                        ], 
                        'CategoriesID' => [
                            'type' => ['list_of' => 'Integer'],
                            'description' => 'Lista de Categorias',
                            'resolve' => function() {
                                $categories_list = get_field('categoriesList', 'option');
                
                                if(empty($categories_list)) {
                                    return [];
                                }
                
                                $categories_ID = [];
                
                                foreach($categories_list as $category_ID) {
                                    $categories_ID[] = $category_ID;
                                }
                                    
                                return $categories_ID;
                            }
                        ],                    
                    ],
                ],
            ]
        ];
    }
}