<?php

if(!defined('ABSPATH')) {
    exit;
}

class ThemeCustomizer
{
    public function __construct()
    {
        $this->social_medias = ['Instagram', 'Facebook', 'Twitter', 'LinkedIn', 'YouTube'];

        $this->custom_colors = [
            'page' => [
                'label' => 'Página', 
            ],
            'header' => [
                'label' => 'Header', 
            ],
            'headerMegaMenu' => [
                'label' => 'Header Mega Menu', 
            ],
            'icon' => [
                'label' => 'Ícones',
            ],
            'iconHover' => [
                'label' => 'Ícones (Hover)',    
            ],
            'link' => [
                'label' => 'Links',   
            ],
            'linkHover' => [
                'label' => 'Links (Hover)',
            ],
            'title' => [
                'label' => 'Títulos',
            ],
            'titleHover' => [
                'label' => 'Títulos (Hover)',
            ],
            'text' => [
                'label' => 'Textos', 
            ],
            'button' => [
                'label' => 'Botões',
            ],
            'buttonHover' => [
                'label' => 'Botões (Hover)', 
            ]
        ];

        $this->parent_slug_graphql = 'ThemeCustomizer';

        add_action('init', [$this, 'register_parent_page']);

        add_action('customize_register', [$this, 'register_social_media_settings']);
        add_action('init', [$this, 'register_social_media_graphql']);

        add_action('customize_register', [$this, 'register_custom_color_settings']);
        add_action('init', [$this, 'register_custom_color_graphql']);

        add_action('customize_register', [$this, 'register_custom_logo']);
        add_action('init', [$this, 'register_custom_logo_graphql']);
    }

    public function register_parent_page() {
        $ParentPageGraphql = new GraphqlPage([
            'root' => 'RootQuery',
            'slug' => $this->parent_slug_graphql,
            'description' => __('Opções do Customizer', 'magazine'),
        ]);
    }

    public function register_social_media_settings($wp_customize) {
        $wp_customize->add_section('social_media', [
            'title'    => esc_html__('Redes Sociais', 'magazine'),
        ]);

        foreach($this->social_medias as $social_media) {
            $slug = sanitize_title($social_media);

            $wp_customize->add_setting("social_media_{$slug}", [
                'default'   => '',
                'transport' => 'refresh',
            ]);

            $wp_customize->add_control("social_media_{$slug}", [
                'label'    => sprintf(esc_html__('Link %s', 'magazine'), $social_media),
                'section'  => 'social_media',
                'settings' => "social_media_{$slug}",
            ]);
        }
    }

    public function register_social_media_graphql() {
        $SocialMediaGraphql = new GraphqlPage([
            'root' => $this->parent_slug_graphql,
            'slug' => 'SocialMedia',
            'description' => __('Opções de Redes sociais do Customizer', 'magazine'),
            'type' => ['list_of' => 'SocialMedia'],
            'fields' => [
                'name' => [
                    'type' => 'String',
                    'description' => __('Nome da rede social', 'magazine'),
                ],
                'url' => [
                    'type' => 'String',
                    'description' => __('Link da rede social', 'magazine'),
                ],
                'slug' => [
                    'type' => 'String',
                    'description' => __('Slug da rede social', 'magazine'),
                ],
            ],
            'resolve' => function () {
                $social_share_list = [];
                
                foreach($this->social_medias as $social_media) {
                    $slug = sanitize_title($social_media);

                    $social_share_list[] = [
                        'name' => $social_media,
                        'slug' => $slug,
                        'url'  => get_theme_mod("custom_social_share_{$slug}"),
                    ];
                }

                return $social_share_list;
            },
        ]);
    }

    public function register_custom_color_settings($wp_customize) {
        $wp_customize->add_section('custom_colors', [
            'title' => esc_html__('Cores', 'magazine'),
        ]);

        foreach($this->custom_colors as $color_slug => $color) {
            $wp_customize->add_setting($color_slug, [
                'default' => '#FFFFFF',
            ]);

            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color_slug, [
                'label'    => esc_html__($color['label'], 'magazine'),
                'section'  => 'custom_colors',
                'settings' => $color_slug,
            ]));
        }
    }

    public function register_custom_color_graphql() {
        $SocialMediaGraphql = new GraphqlPage([
            'root' => $this->parent_slug_graphql,
            'slug' => 'CustomColor',
            'description' => __('Opções de cores do Customizer', 'magazine'),
            'type' => ['list_of' => 'CustomColor'],
            'fields' => [
                'slug' => [
                    'type' => 'String',
                    'description' => __('Slug da cor', 'magazine'),
                ],
                'color' => [
                    'type' => 'String',
                    'description' => __('Cor em hexadecimal', 'magazine'),
                ],
            ],
            'resolve' => function () {
                $custom_colors = [];

                foreach($this->custom_colors as $key => $color) {
                    $custom_colors[$key] = [
                        'slug' => $key,
                        'color' => get_theme_mod($key) ?? '#FFFFFF',
                    ];
                }

                return $custom_colors;
            },
        ]);
    }

    public function register_custom_logo() {
        add_theme_support( 'custom-logo', [
            'height' => 480,
            'width'  => 720,
        ]);
    }

    public function register_custom_logo_graphql() {
        $CustomLogoGraphql = new GraphqlPage([
            'root'        => $this->parent_slug_graphql,
            'slug'        => 'CustomLogo',
            'description' => __('Logo personalizado do customizer', 'magazine'),
            'fields'      => [
                'url' => [
                    'type' => 'String',
                    'description' => __('URL da imagem', 'magazine'),
                ],
            ],
            'resolve' => function() {
                $custom_logo = get_theme_mod('custom_logo');

                $custom_logo_URL = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full' )[0] ?? "";

                return [
                    'url' => $custom_logo_URL,
                ];
            },
        ]);
    }
}

new ThemeCustomizer();