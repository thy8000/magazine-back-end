<?php

if(!defined('ABSPATH')) {
    exit;
}

const SOCIAL_MEDIA_LIST = ['Instagram', 'Facebook', 'Twitter', 'LinkedIn', 'YouTube'];

const CUSTOM_COLORS = [
    'pageColor' => [
        'label' => 'Página', 
    ],
    'headerColor' => [
        'label' => 'Header', 
    ],
    'headerMegaMenuColor' => [
        'label' => 'Header Mega Menu', 
    ],
    'iconColor' => [
        'label' => 'Ícones',
    ],
    'iconHoverColor' => [
        'label' => 'Ícones (Hover)',    
    ],
    'linkColor' => [
        'label' => 'Links',   
    ],
    'linkHoverColor' => [
        'label' => 'Links (Hover)',
    ],
    'titleColor' => [
        'label' => 'Títulos',
    ],
    'titleHoverColor' => [
        'label' => 'Títulos (Hover)',
    ],
    'textColor' => [
        'label' => 'Textos', 
    ],
    'buttonColor' => [
        'label' => 'Botões',
    ],
    'buttonHoverColor' => [
        'label' => 'Botões (Hover)', 
    ],
];

class ThemeCustomizer
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'custom_logo']);
        add_action('graphql_register_types', [$this, 'custom_logo_graphql']);

        add_action('customize_register',     [$this, 'custom_colors']);
        add_action('graphql_register_types', [$this, 'custom_colors_graphql']);

        add_action('customize_register',     [$this, 'custom_social_shares']);
        add_action('graphql_register_types',     [$this, 'custom_social_shares_graphql']);
    }

    public function custom_logo($wp_customize) {
        add_theme_support( 'custom-logo');
    }

    public function custom_logo_graphql() {
        register_graphql_object_type('CustomLogo', [
            'description' => __('Logo personalizado do Customizer', 'magazine'),
            'fields' => [
                'url' => ['type' => 'String'],
            ],
        ]);

        register_graphql_field( 'RootQuery', 'CustomLogo', [
            'type' => 'CustomLogo',
            'resolve' => function () {
                return [
                    'url' => wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full' )[0] ?? "",
                ];
            },
        ]);
    }

    public function custom_colors($wp_customize) {
        $wp_customize->add_section('custom_colors', [
            'title' => esc_html__('Cores', 'magazine'),
        ]);

        foreach(CUSTOM_COLORS as $color_slug => $color) {
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

    public function custom_colors_graphql() {
        register_graphql_object_type('CustomColors', [
            'description' => __('Cores personalizadas do Customizer', 'magazine'),
            'fields' => [
                'slug' => ['type' => 'String'],
                'color' => ['type' => 'String'],
            ],
        ]);

        register_graphql_field( 'RootQuery', 'CustomColors', [
            'type' => ['list_of' => 'CustomColors'],
            'resolve' => function () {

                $custom_colors = [];

                foreach(CUSTOM_COLORS as $key => $color) {
                    $custom_colors[$key] = [
                        'slug' => $key,
                        'color' => get_theme_mod($key) ?? '#FFFFFF',
                    ];
                }

                return $custom_colors;
            },
        ]);
    }

    public function custom_social_shares($wp_customize) {
        $wp_customize->add_section('custom_social_shares', [
            'title'    => esc_html__('Redes Sociais', 'magazine'),
        ]);

        foreach(SOCIAL_MEDIA_LIST as $social_media) {
            $slug = sanitize_title($social_media);

            $wp_customize->add_setting("custom_social_share_{$slug}", [
                'default'   => '',
                'transport' => 'refresh',
            ]);

            $wp_customize->add_control("custom_social_share_{$slug}", [
                'label'    => sprintf(esc_html__('Link %s', 'magazine'), $social_media),
                'section'  => 'custom_social_shares',
                'settings' => "custom_social_share_{$slug}",
            ]);
        }
    }

    public function custom_social_shares_graphql() {
        register_graphql_object_type('SocialShare', [
            'description' => __('Redes sociais personalizadas do Customizer', 'magazine'),
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
        ]);

        register_graphql_field( 'RootQuery', 'SocialShare', [
            'type' => ['list_of' => 'SocialShare'],
            'resolve' => function () {
                $social_share_list = [];
                
                foreach(SOCIAL_MEDIA_LIST as $social) {
                    $slug = sanitize_title($social);

                    $social_share_list[] = [
                        'name' => $social,
                        'slug' => $slug,
                        'url'  => get_theme_mod("custom_social_share_{$slug}"),
                    ];
                }

                return $social_share_list;
            },
        ]);
    }
}

new ThemeCustomizer();