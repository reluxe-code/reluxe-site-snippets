<?php
/**
 * Plugin Name:       RELUXE Site Snippets
 * Plugin URI:        https://reluxemedspa.com
 * Description:       Custom functionality for RELUXE: CPTs, ACF groups, and relationship fields.
 * Version:           1.1.0
 * Author:            Kyle Robbins
 * Author URI:        https://reluxemedspa.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types
 */
add_action( 'init', function() {
    // Locations CPT
    $labels = [
        'name'               => 'Locations',
        'singular_name'      => 'Location',
        'menu_name'          => 'Locations',
        'add_new_item'       => 'Add New Location',
        'all_items'          => 'All Locations',
        'edit_item'          => 'Edit Location',
        'view_item'          => 'View Location',
        'search_items'       => 'Search Locations',
        'not_found'          => 'No locations found.',
        'not_found_in_trash' => 'No locations found in Trash.',
    ];
    register_post_type( 'locations', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-location',
        'show_in_rest'       => true,
        'rewrite'            => ['slug'=>'locations','with_front'=>true],
        'supports'           => ['title','editor','excerpt','thumbnail','custom-fields'],
    ] );

    // Services CPT
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
    register_post_type( 'service', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-hammer',
        'rewrite'            => ['slug'=>'services','with_front'=>true],
        'supports'           => ['title','editor','excerpt','thumbnail','custom-fields'],
    ] );

    // Service Category Taxonomy
    $labels = [
        'name'               => 'Service Categories',
        'singular_name'      => 'Service Category',
        'menu_name'          => 'Service Categories',
        'all_items'          => 'All Categories',
        'edit_item'          => 'Edit Category',
        'view_item'          => 'View Category',
        'update_item'        => 'Update Category',
        'add_new_item'       => 'Add New Category',
        'new_item_name'      => 'New Category Name',
        'search_items'       => 'Search Categories',
        'not_found'          => 'No categories found.',
    ];
    register_taxonomy( 'service_category', 'service', [
        'labels'       => $labels,
        'public'       => true,
        'hierarchical' => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug'=>'service-category','with_front'=>true],
    ] );

    // Staff CPT
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
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-id',
        'rewrite'      => ['slug'=>'staff','with_front'=>true],
        'supports'     => ['title','editor','thumbnail','custom-fields'],
    ] );

    // Testimonials CPT
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
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-quote',
        'rewrite'      => ['slug'=>'testimonials','with_front'=>true],
        'supports'     => ['title','editor','custom-fields'],
    ] );

    // Monthly Specials CPT
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
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-star-filled',
        'rewrite'      => ['slug'=>'monthly-specials','with_front'=>true],
        'supports'     => ['title','editor','excerpt','thumbnail','custom-fields'],
    ] );
});

/**
 * ACF: Applicable Locations relationship field
 */
if ( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key'    => 'group_applicable_locations',
        'title'  => 'Applicable Locations',
        'fields' => array(
            array(
                'key'           => 'field_applicable_locations',
                'label'         => 'Applicable Locations',
                'name'          => 'applicable_locations',
                'type'          => 'relationship',
                'post_type'     => array('locations'),
                'filters'       => array('search'),
                'return_format' => 'object',
            ),
        ),
        'location' => array(
            array(array('param'=>'post_type','operator'=>'==','value'=>'service')),
            array(array('param'=>'post_type','operator'=>'==','value'=>'staff')),
            array(array('param'=>'post_type','operator'=>'==','value'=>'testimonial')),
            array(array('param'=>'post_type','operator'=>'==','value'=>'monthly_special')),
        ),
        'position' => 'normal',
        'style'    => 'default',
        'active'   => true,
    ));
}

/**
 * ACF: Homepage Sections flexible content
 */
if ( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key'      => 'group_homepage_sections',
        'title'    => 'Homepage Sections',
        'fields'   => array(
            array(
                'key'           => 'field_homepage_sections',
                'label'         => 'Sections',
                'name'          => 'homepage_sections',
                'type'          => 'flexible_content',
                'layouts'       => array(
                    // Hero
                    'layout_hero' => array(
                        'key'        => 'layout_hero',
                        'name'       => 'hero',
                        'label'      => 'Hero',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array('key'=>'field_hero_headline','label'=>'Headline','name'=>'headline','type'=>'text'),
                            array('key'=>'field_hero_subhead','label'=>'Subheading','name'=>'subhead','type'=>'text'),
                            array('key'=>'field_hero_background','label'=>'Background Image','name'=>'background_image','type'=>'image'),
                            array('key'=>'field_hero_cta_text','label'=>'Button Text','name'=>'cta_text','type'=>'text'),
                            array('key'=>'field_hero_cta_url','label'=>'Button URL','name'=>'cta_url','type'=>'url'),
                        ),
                    ),
                    // Locations
                    'layout_locations' => array(
                        'key'        => 'layout_locations',
                        'name'       => 'locations',
                        'label'      => 'Locations',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_locations_list','label'=>'Select Locations','name'=>'locations','type'=>'relationship',
                                'post_type'=>array('locations'),'return_format'=>'object',
                            ),
                        ),
                    ),
                    // Staff
                    'layout_staff' => array(
                        'key'        => 'layout_staff',
                        'name'       => 'staff',
                        'label'      => 'Staff Carousel',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_staff_list','label'=>'Select Staff','name'=>'staff_members','type'=>'relationship',
                                'post_type'=>array('staff'),'return_format'=>'object','filters'=>array('search'),'max'=>6,
                            ),
                        ),
                    ),
                    // Reviews
                    'layout_reviews' => array(
                        'key'        => 'layout_reviews',
                        'name'       => 'reviews',
                        'label'      => 'Google Reviews',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array('key'=>'field_reviews_shortcode','label'=>'Reviews Shortcode','name'=>'reviews_shortcode','type'=>'text'),
                        ),
                    ),
                    // Testimonials
                    'layout_testimonials' => array(
                        'key'        => 'layout_testimonials',
                        'name'       => 'testimonials',
                        'label'      => 'Testimonials',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_testimonials_list','label'=>'Select Testimonials','name'=>'testimonials','type'=>'relationship',
                                'post_type'=>array('testimonial'),'return_format'=>'object','max'=>5,
                            ),
                        ),
                    ),
                    // Featured Services
                    'layout_services' => array(
                        'key'        => 'layout_services',
                        'name'       => 'featured_services',
                        'label'      => 'Featured Services',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_services_list','label'=>'Select Services','name'=>'services','type'=>'relationship',
                                'post_type'=>array('service'),'return_format'=>'object','filters'=>array('search'),'max'=>6,
                            ),
                        ),
                    ),
                    // Monthly Specials
                    'layout_specials' => array(
                        'key'        => 'layout_specials',
                        'name'       => 'monthly_specials',
                        'label'      => 'Monthly Specials',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_specials_list','label'=>'Select Specials','name'=>'specials','type'=>'relationship',
                                'post_type'=>array('monthly_special'),'return_format'=>'object','max'=>3,
                            ),
                        ),
                    ),
                    // Skincare Lines
                    'layout_skincare' => array(
                        'key'        => 'layout_skincare',
                        'name'       => 'skincare_lines',
                        'label'      => 'Skincare Lines',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array(
                                'key'=>'field_skincare_list','label'=>'Select Brands','name'=>'skincare_brands','type'=>'relationship',
                                'post_type'=>array('skincare_line'),'return_format'=>'object','max'=>8,
                            ),
                        ),
                    ),
                    // CTA
                    'layout_cta' => array(
                        'key'        => 'layout_cta',
                        'name'       => 'cta',
                        'label'      => 'Call To Action',
                        'display'    => 'block',
                        'sub_fields' => array(
                            array('key'=>'field_cta_heading','label'=>'Heading','name'=>'cta_heading','type'=>'text'),
                            array('key'=>'field_cta_text','label'=>'Text','name'=>'cta_text','type'=>'textarea'),
                            array('key'=>'field_cta_button_text','label'=>'Button Text','name'=>'cta_button_text','type'=>'text'),
                            array('key'=>'field_cta_button_url','label'=>'Button URL','name'=>'cta_button_url','type'=>'url'),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(array('param'=>'page_type','operator'=>'==','value'=>'front_page')),  
        ),
        'style'                 => 'seamless',
        'position'              => 'normal',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ));
}
