<?php

if (!defined('ABSPATH')) {
    exit;
}

const PARENT_SLUG = 'theme-options';
const PARENT_SLUG_GRAPHQL = 'ThemeOptions';

class ThemeOptions
{
    function __construct()
    {
        add_action('init', [$this, 'register_parent_page']);

        add_action('init', [$this, 'register_header_sub_page']);

        add_action('init', [$this, 'register_home_sub_page']);

        add_action('init', [$this, 'register_sidebar_sub_page']);
    }

    public function register_parent_page()
    {
        $ParentPage = new ACFPage([
            'page_title' => 'Opções do Tema',
            'menu_slug' => PARENT_SLUG,
            'position' => 2,
            'redirect' => true,
        ]);

        $ParentPageGraphql = new GraphqlPage([
            'root' => 'RootQuery',
            'slug' => PARENT_SLUG_GRAPHQL,
            'description' => __('Opções do tema', 'magazine'),
        ]);
    }

    public function register_header_sub_page()
    {
        $HeaderSubPage = new ACFPage([
            'page_title' => 'Cabeçalho',
            'menu_slug' => 'theme-options-header',
            'parent_slug' => PARENT_SLUG,
        ]);

        $HeaderSubPage->register_fields([
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
                        'value' => 'theme-options-header',
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
        ]);

        $HeaderSubPage->register_fields([
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
                        'value' => 'theme-options-header',
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
        ]);

        $HeaderSubPageGraphql = new GraphqlPage([
            'root' => PARENT_SLUG_GRAPHQL,
            'slug' => 'ThemeOptionsHeader',
            'description' => __('Opções do cabeçalho do tema', 'magazine'),
        ]);

        $HeaderSubPageGraphql->register_interface([
            'interface' => 'ThemeOptionsHeaderInterface',
            'fields' => [
                'TransparentHeader' => [
                    'type' => 'Boolean',
                    'description' => 'Cabeçalho transparente',
                    'resolve' => function () {
                        $transparent_header = get_field('transparentHeader', 'option');

                        if (empty($transparent_header)) {
                            return false;
                        }

                        return true;
                    }
                ],
                'CategoriesID' => [
                    'type' => ['list_of' => 'Integer'],
                    'description' => 'Lista de Categorias',
                    'resolve' => function () {
                        $categories_list = get_field('categoriesList', 'option');

                        if (empty($categories_list)) {
                            return [];
                        }

                        $categories_ID = [];

                        foreach ($categories_list as $category_ID) {
                            $categories_ID[] = $category_ID;
                        }

                        return $categories_ID;
                    }
                ],
            ],
        ]);
    }

    public function register_home_sub_page()
    {
        $HomeSubPage = new ACFPage([
            'page_title' => 'Página inicial',
            'menu_slug' => 'theme-options-home',
            'parent_slug' => PARENT_SLUG,
        ]);

        $HomeSubPage->register_fields([
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
                        'value' => 'theme-options-home',
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
        ]);

        $HomeSubPageGraphql = new GraphqlPage([
            'root' => PARENT_SLUG_GRAPHQL,
            'slug' => 'ThemeOptionsHome',
            'description' => __('Opções da página inicial do tema', 'magazine'),
        ]);

        $HomeSubPageGraphql->register_interface([
            'interface' => 'ThemeOptionsHomeInterface',
            'fields' => [
                'HomeFeaturedPostID' => [
                    'type' => 'Int',
                    'description' => 'Post Destacado',
                    'resolve' => function () {
                        $featured_post = get_field('homeFeaturedPost', 'option') ?? 0;

                        return $featured_post;
                    }
                ],
            ],
        ]);
    }

    public function register_sidebar_sub_page()
    {
        $SidebarSubPage = new ACFPage([
            'page_title' => 'Sidebar',
            'menu_slug' => 'theme-options-sidebar',
            'parent_slug' => PARENT_SLUG,
        ]);

        $SidebarSubPage->register_fields([
            'key' => 'group_662afb6274413',
            'title' => 'Grupo de campos - Sidebar',
            'fields' => [
                [
                    'key' => 'field_662afb62f4a45',
                    'label' => 'Lista de Sidebars',
                    'name' => 'sidebarSidebarList',
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
                    'max' => 3,
                    'collapsed' => '',
                    'button_label' => 'Adicionar linha',
                    'rows_per_page' => 20,
                    'sub_fields' => [
                        [
                            'key' => 'field_662afbf9f4a46',
                            'label' => 'Categoria',
                            'name' => 'categoria',
                            'aria-label' => '',
                            'type' => 'taxonomy',
                            'instructions' => '',
                            'required' => 1,
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
                            'parent_repeater' => 'field_662afb62f4a45',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-options-sidebar',
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
        ]);

        $SidebarSubPageGraphql = new GraphqlPage([
            'root' => PARENT_SLUG_GRAPHQL,
            'slug' => 'ThemeOptionsSidebar',
            'description' => __('Opções de sidebars do tema', 'magazine'),
        ]);

        $SidebarListGraphql = new GraphqlPage([
            'root' => 'ThemeOptionsSidebar',
            'slug' => 'SidebarList',
            'description' => __('Lista de sidebars', 'magazine'),
            'type' => ['list_of' => 'SidebarList'],
            'fields' => [
                'categoryID' => [
                    'type' => 'Int',
                    'description' => __('ID da categoria da sidebar', 'magazine'),
                ],
            ],
            'resolve' => function () {
                $sidebar_list = get_field('sidebarSidebarList', 'option') ?? [];

                if (empty($sidebar_list)) {
                    return $sidebar_list;
                }

                $sidebar_categories_list = [];

                /**
                 * TODO: adicionar mais campos
                 */
                foreach ($sidebar_list as $sidebar) {
                    $sidebar_categories_list[] = [
                        'categoryID' => $sidebar['categoria'],
                    ];
                }

                return $sidebar_categories_list;
            }
        ]);
    }
}

new ThemeOptions();
