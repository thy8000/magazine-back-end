<?php

if(!defined('ABSPATH')) {
    exit;
}

class Special_Register {
    public function __construct() {
        add_action('init', [$this, 'special_post_type']);
    }

    public function special_post_type() {
        $labels = [
            'name'               => __('Especial', 'magazine'),
            'singular_name'      => __('Especial', 'magazine'),
            'menu_name'          => __('Especiais', 'magazine'),
            'name_admin_bar'     => __('Especial', 'magazine'),
            'add_new'            => __('Adicionar novo especial', 'magazine'),
            'add_new_item'       => __('Adicionar novo especial', 'magazine'),
            'new_item'           => __('Novo especial', 'magazine'),
            'edit_item'          => __('Editar especial', 'magazine'),
            'view_item'          => __('Ver especial', 'magazine'),
            'all_items'          => __('Todos os especiais', 'magazine'),
            'search_items'       => __('Buscar especiais', 'magazine'),
            'parent_item_colon'  => __('Meus especiais:', 'magazine'),
            'not_found'          => __('Nenhum especial encontrado.', 'magazine'),
            'not_found_in_trash' => __('Nenhum especial encontrado na lixeira.', 'magazine'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug' => 'especiais',
            ],
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => null,
            'show_in_graphql'     => true,
            'graphql_single_name' => __('Especial', 'magazine'),
            'graphql_plural_name' => __('Especiais', 'magazine'),
            'supports'            => [ 
                'title', 
                'editor', 
                'author',
                'thumbnail', 
                'excerpt', 
                'comments' 
            ],
            'taxonomies'         => ['category'],
        ];

        register_post_type( 'special', $args );
    }
}

new Special_Register();