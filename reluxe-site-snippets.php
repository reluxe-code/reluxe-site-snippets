<?php
/**
 * Plugin Name:       RELUXE Site Snippets
 * Plugin URI:        https://reluxemedspa.com
 * Description:       Custom functionality (Locations CPT, shortcodes, etc.) for RELUXE.
 * Version:           1.0.0
 * Author:            Kyle Robbins
 * Author URI:        https://reluxemedspa.com
 */

 // Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }

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
        'has_archive'        => true,            // enables /locations/ archive
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
            'thumbnail',    // featured image
        ],
    ];
    register_post_type( 'locations', $args );
});
