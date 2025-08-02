<?php
/**
 * Plugin Name:       RELUXE Site Snippets
 * Plugin URI:        https://reluxemedspa.com
 * Description:       Custom functionality for RELUXE: CPTs, ACF groups, relationship fields, and CORS.
 * Version:           1.1.2
 * Author:            Kyle Robbins
 * Author URI:        https://reluxemedspa.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * CORS: Allow REST API requests from any origin.
 */
add_action( 'rest_api_init', function() {
    remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
    add_filter( 'rest_pre_serve_request', function( $value ) {
        header( 'Access-Control-Allow-Origin: *' );
        return $value;
    }, 15 );
} );

/**
 * Register Custom Post Types & Taxonomies.
 */
add_action( 'init', function() {
    // Locations CPT.
    register_post_type( 'locations', [
        'labels'       => [
            'name'                  => 'Locations',
            'singular_name'         => 'Location',
            'menu_name'             => 'Locations',
            'add_new_item'          => 'Add New Location',
            'all_items'             => 'All Locations',
            'edit_item'             => 'Edit Location',
            'view_item'             => 'View Location',
            'search_items'          => 'Search Locations',
            'not_found'             => 'No locations found.',
            'not_found_in_trash'    => 'No locations found in Trash.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-location',
        'rewrite'      => [ 'slug' => 'locations', 'with_front' => true ],
        'supports'     => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
    ] );

    // Services CPT.
    register_post_type( 'service', [
        'labels'       => [
            'name'                  => 'Services',
            'singular_name'         => 'Service',
            'menu_name'             => 'Services',
            'add_new_item'          => 'Add New Service',
            'all_items'             => 'All Services',
            'edit_item'             => 'Edit Service',
            'view_item'             => 'View Service',
            'search_items'          => 'Search Services',
            'not_found'             => 'No services found.',
            'not_found_in_trash'    => 'No services found in Trash.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-hammer',
        'rewrite'      => [ 'slug' => 'services', 'with_front' => true ],
        'supports'     => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
    ] );

    // Service Category Taxonomy.
    register_taxonomy( 'service_category', 'service', [
        'labels'       => [
            'name'              => 'Service Categories',
            'singular_name'     => 'Service Category',
            'menu_name'         => 'Service Categories',
            'all_items'         => 'All Categories',
            'edit_item'         => 'Edit Category',
            'view_item'         => 'View Category',
            'add_new_item'      => 'Add New Category',
            'search_items'      => 'Search Categories',
            'not_found'         => 'No categories found.',
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'rewrite'      => [ 'slug' => 'service-category', 'with_front' => true ],
    ] );

    // Staff CPT.
    register_post_type( 'staff', [
        'labels'       => [
            'name'                  => 'Staff',
            'singular_name'         => 'Staff Member',
            'menu_name'             => 'Staff',
            'add_new_item'          => 'Add New Staff Member',
            'all_items'             => 'All Staff',
            'edit_item'             => 'Edit Staff Member',
            'view_item'             => 'View Staff Member',
            'search_items'          => 'Search Staff',
            'not_found'             => 'No staff found.',
            'not_found_in_trash'    => 'No staff found in Trash.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-id',
        'rewrite'      => [ 'slug' => 'staff', 'with_front' => true ],
        'supports'     => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
    ] );

    // Testimonials CPT.
    register_post_type( 'testimonial', [
        'labels'       => [
            'name'                  => 'Testimonials',
            'singular_name'         => 'Testimonial',
            'menu_name'             => 'Testimonials',
            'add_new_item'          => 'Add New Testimonial',
            'all_items'             => 'All Testimonials',
            'edit_item'             => 'Edit Testimonial',
            'view_item'             => 'View Testimonial',
            'search_items'          => 'Search Testimonials',
            'not_found'             => 'No testimonials found.',
            'not_found_in_trash'    => 'No testimonials found in Trash.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-quote',
        'rewrite'      => [ 'slug' => 'testimonials', 'with_front' => true ],
        'supports'     => [ 'title', 'editor', 'custom-fields' ],
    ] );

    // Monthly Specials CPT.
    register_post_type( 'monthly_special', [
        'labels'       => [
            'name'                  => 'Monthly Specials',
            'singular_name'         => 'Monthly Special',
            'menu_name'             => 'Monthly Specials',
            'add_new_item'          => 'Add New Monthly Special',
            'all_items'             => 'All Monthly Specials',
            'edit_item'             => 'Edit Monthly Special',
            'view_item'             => 'View Monthly Special',
            'search_items'          => 'Search Monthly Specials',
            'not_found'             => 'No specials found.',
            'not_found_in_trash'    => 'No specials found in Trash.',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-star-filled',
        'rewrite'      => [ 'slug' => 'monthly-specials', 'with_front' => true ],
        'supports'     => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
    ] );
} );

/**
 * ACF: Applicable Locations relationship field.
 */
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }
    acf_add_local_field_group( [
        'key'    => 'group_applicable_locations',
        'title'  => 'Applicable Locations',
        'fields' => [
            [
                'key'           => 'field_applicable_locations',
                'label'         => 'Applicable Locations',
                'name'          => 'applicable_locations',
                'type'          => 'relationship',
                'post_type'     => [ 'locations' ],
                'filters'       => [ 'search' ],
                'return_format' => 'object',
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'service' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'staff' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ] ],
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'monthly_special' ] ],
        ],
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ] );
} );

/**
 * ACF: Homepage Sections flexible content.
 */
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }
    acf_add_local_field_group( [
        'key'       => 'group_homepage_sections',
        'title'     => 'Homepage Sections',
        'fields'    => [
            [
                'key'     => 'field_homepage_sections',
                'label'   => 'Sections',
                'name'    => 'homepage_sections',
                'type'    => 'flexible_content',
                'layouts' => [
                    'layout_hero'     => [
                        'key'        => 'layout_hero',
                        'name'       => 'hero',
                        'label'      => 'Hero',
                        'display'    => 'block',
                        'sub_fields' => [
                            [ 'key' => 'field_hero_headline',    'label' => 'Headline',         'name' => 'headline',          'type' => 'text' ],
                            [ 'key' => 'field_hero_subhead',     'label' => 'Subheading',       'name' => 'subhead',           'type' => 'text' ],
                            [ 'key' => 'field_hero_background',  'label' => 'Background Image', 'name' => 'background_image',  'type' => 'image' ],
                            [ 'key' => 'field_hero_cta_text',    'label' => 'Button Text',      'name' => 'cta_text',          'type' => 'text' ],
                            [ 'key' => 'field_hero_cta_url',     'label' => 'Button URL',       'name' => 'cta_url',           'type' => 'url' ],
                        ],
                    ],
                    'layout_locations' => [
                        'key'        => 'layout_locations',
                        'name'       => 'locations',
                        'label'      => 'Locations',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_locations_list',
                                'label'         => 'Select Locations',
                                'name'          => 'locations',
                                'type'          => 'relationship',
                                'post_type'     => [ 'locations' ],
                                'return_format' => 'object',
                            ],
                        ],
                    ],
                    'layout_staff'    => [
                        'key'        => 'layout_staff',
                        'name'       => 'staff',
                        'label'      => 'Staff Carousel',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_staff_list',
                                'label'         => 'Select Staff',
                                'name'          => 'staff_members',
                                'type'          => 'relationship',
                                'post_type'     => [ 'staff' ],
                                'filters'       => [ 'search' ],
                                'return_format' => 'object',
                                'max'           => 6,
                            ],
                        ],
                    ],
                    'layout_reviews'  => [
                        'key'        => 'layout_reviews',
                        'name'       => 'reviews',
                        'label'      => 'Google Reviews',
                        'display'    => 'block',
                        'sub_fields' => [
                            [ 'key' => 'field_reviews_shortcode', 'label' => 'Reviews Shortcode', 'name' => 'reviews_shortcode', 'type' => 'text' ],
                        ],
                    ],
                    'layout_testimonials' => [
                        'key'        => 'layout_testimonials',
                        'name'       => 'testimonials',
                        'label'      => 'Testimonials',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_testimonials_list',
                                'label'         => 'Select Testimonials',
                                'name'          => 'testimonials',
                                'type'          => 'relationship',
                                'post_type'     => [ 'testimonial' ],
                                'return_format' => 'object',
                                'max'           => 5,
                            ],
                        ],
                    ],
                    'layout_services' => [
                        'key'        => 'layout_services',
                        'name'       => 'featured_services',
                        'label'      => 'Featured Services',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_services_list',
                                'label'         => 'Select Services',
                                'name'          => 'services',
                                'type'          => 'relationship',
                                'post_type'     => [ 'service' ],
                                'filters'       => [ 'search' ],
                                'return_format' => 'object',
                                'max'           => 6,
                            ],
                        ],
                    ],
                    'layout_specials' => [
                        'key'        => 'layout_specials',
                        'name'       => 'monthly_specials',
                        'label'      => 'Monthly Specials',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_specials_list',
                                'label'         => 'Select Specials',
                                'name'          => 'specials',
                                'type'          => 'relationship',
                                'post_type'     => [ 'monthly_special' ],
                                'return_format' => 'object',
                                'max'           => 3,
                            ],
                        ],
                    ],
                    'layout_skincare' => [
                        'key'        => 'layout_skincare',
                        'name'       => 'skincare_lines',
                        'label'      => 'Skincare Lines',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'key'           => 'field_skincare_list',
                                'label'         => 'Select Brands',
                                'name'          => 'skincare_brands',
                                'type'          => 'relationship',
                                'post_type'     => [ 'skincare_line' ],
                                'return_format' => 'object',
                                'max'           => 8,
                            ],
                        ],
                    ],
                    'layout_cta'      => [
                        'key'        => 'layout_cta',
                        'name'       => 'cta',
                        'label'      => 'Call To Action',
                        'display'    => 'block',
                        'sub_fields' => [
                            [ 'key' => 'field_cta_heading',    'label' => 'Heading',      'name' => 'cta_heading',       'type' => 'text' ],
                            [ 'key' => 'field_cta_text',       'label' => 'Text',         'name' => 'cta_text',          'type' => 'textarea' ],
                            [ 'key' => 'field_cta_button_text','label' => 'Button Text',  'name' => 'cta_button_text',   'type' => 'text' ],
                            [ 'key' => 'field_cta_button_url', 'label' => 'Button URL',   'name' => 'cta_button_url',    'type' => 'url' ],
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'style'                 => 'seamless',
        'position'              => 'normal',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ] );
} );
