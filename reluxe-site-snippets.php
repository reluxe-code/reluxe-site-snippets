<?php
/**
 * Plugin Name:       RELUXE Site Snippets
 * Plugin URI:        https://reluxemedspa.com
 * Description:       Custom functionality (Locations CPT, Services CPT, Service Category taxonomy, Staff CPT, Testimonials CPT, Monthly Specials CPT, and Applicable Locations relationship field) for RELUXE.
 * Version:           1.0.1
 * Author:            Kyle Robbins
 * Author URI:        https://reluxemedspa.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Locations CPT
 */
add_action( 'init', function() {
    $labels = [
        'name'                  => 'Locations',
        'singular_name'         => 'Location',
        'menu_name'             => 'Locations',
        'name_admin_bar'        => 'Location',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Location',
        'new_item'              => 'New Location',
        'edit_item'             => 'Edit Location',
        'view_item'             => 'View Location',
        'all_items'             => 'All Locations',
        'search_items'          => 'Search Locations',
        'not_found'             => 'No locations found.',
        'not_found_in_trash'    => 'No locations found in Trash.',
    ];
    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-location',
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'rewrite'            => [
            'slug'       => 'locations',
            'with_front' => true,
        ],
        'query_var'          => true,
        'supports'           => [
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
        ],
    ];
    register_post_type( 'locations', $args );
});

/**
 * Register Services CPT
 */
add_action( 'init', function() {
    $labels = [
        'name'               => 'Services',
        'singular_name'      => 'Service',
        'menu_name'          => 'Services',
        'add_new_item'       => 'Add New Service',
        'all_items'          => 'All Services',
        'edit_item'          => 'Edit Service',
        'view_item'          => 'View Service',
        'search_items'       => 'Search Services',
        'not_found'          => 'No services found.',
        'not_found_in_trash' => 'No services found in Trash.',
    ];
    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-hammer',
        'rewrite'            => [ 'slug' => 'services', 'with_front' => true ],
        'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
    ];
    register_post_type( 'service', $args );
});

/**
 * Register Service Category taxonomy
 */
add_action( 'init', function() {
    $labels = [
        'name'              => 'Service Categories',
        'singular_name'     => 'Service Category',
        'menu_name'         => 'Service Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'view_item'         => 'View Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'search_items'      => 'Search Categories',
        'not_found'         => 'No categories found.',
    ];
    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'service-category', 'with_front' => true ],
    ];
    register_taxonomy( 'service_category', 'service', $args );
});

/**
 * Register Staff CPT
 */
add_action( 'init', function() {
    $labels = [
        'name'               => 'Staff',
        'singular_name'      => 'Staff Member',
        'menu_name'          => 'Staff',
        'add_new_item'       => 'Add New Staff Member',
        'all_items'          => 'All Staff',
        'edit_item'          => 'Edit Staff Member',
        'view_item'          => 'View Staff Member',
        'search_items'       => 'Search Staff',
        'not_found'          => 'No staff found.',
        'not_found_in_trash' => 'No staff found in Trash.',
    ];
    register_post_type( 'staff', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-id',
        'rewrite'            => [ 'slug' => 'staff', 'with_front' => true ],
        'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
    ] );
});

/**
 * Register Testimonials CPT
 */
add_action( 'init', function() {
    $labels = [
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'add_new_item'       => 'Add New Testimonial',
        'all_items'          => 'All Testimonials',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'search_items'       => 'Search Testimonials',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.',
    ];
    register_post_type( 'testimonial', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-format-quote',
        'rewrite'            => [ 'slug' => 'testimonials', 'with_front' => true ],
        'supports'           => [ 'title', 'editor', 'custom-fields' ],
    ] );
});

/**
 * Register Monthly Specials CPT
 */
add_action( 'init', function() {
    $labels = [
        'name'               => 'Monthly Specials',
        'singular_name'      => 'Monthly Special',
        'menu_name'          => 'Monthly Specials',
        'add_new_item'       => 'Add New Monthly Special',
        'all_items'          => 'All Monthly Specials',
        'edit_item'          => 'Edit Monthly Special',
        'view_item'          => 'View Monthly Special',
        'search_items'       => 'Search Monthly Specials',
        'not_found'          => 'No specials found.',
        'not_found_in_trash' => 'No specials found in Trash.',
    ];
    register_post_type( 'monthly_special', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'rewrite'            => [ 'slug' => 'monthly-specials', 'with_front' => true ],
        'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
    ] );
});

// --------------------------------------------------
// ACF Relationship Field: Applicable Locations
// --------------------------------------------------
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
        'key'      => 'group_applicable_locations',
        'title'    => 'Applicable Locations',
        'fields'   => array(
            array(
                'key'               => 'field_applicable_locations',
                'label'             => 'Applicable Locations',
                'name'              => 'applicable_locations',
                'type'              => 'relationship',
                'instructions'      => 'Select one or more locations where this applies.',
                'required'          => 0,
                'post_type'         => array( 'locations' ),
                'filters'           => array( 'search' ),
                'return_format'     => 'object',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'staff',
                ),
            ),
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'service',
                ),
            ),
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'testimonial',
                ),
            ),
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'monthly_special',
                ),
            ),
        ),
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
        'description'           => '',
    ) );
}
