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

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
  'key'      => 'group_homepage_sections',
  'title'    => 'Homepage Sections',
  'fields'   => array(
    array(
      'key'               => 'field_hp_sections',
      'label'             => 'Sections',
      'name'              => 'homepage_sections',
      'type'              => 'flexible_content',
      'layouts'           => array(
        // 1. Hero
        'layout_hero' => array(
          'key'        => 'layout_hero',
          'name'       => 'hero',
          'label'      => 'Hero',
          'sub_fields' => array(
            array('key'=>'field_hero_headline','label'=>'Headline','name'=>'headline','type'=>'text'),
            array('key'=>'field_hero_subhead','label'=>'Subheading','name'=>'subhead','type'=>'text'),
            array('key'=>'field_hero_bg','label'=>'Background Image','name'=>'background_image','type'=>'image'),
            array('key'=>'field_hero_cta_text','label'=>'Button Text','name'=>'cta_text','type'=>'text'),
            array('key'=>'field_hero_cta_url','label'=>'Button URL','name'=>'cta_url','type'=>'url'),
          ),
        ),
        // 2. Locations
        'layout_locations' => array(
          'key'        => 'layout_locations',
          'name'       => 'locations',
          'label'      => 'Locations',
          'sub_fields' => array(
            array('key'=>'field_hp_locations','label'=>'Select Locations','name'=>'locations','type'=>'relationship','post_type'=>array('locations'),'return_format'=>'object'),
          ),
        ),
        // 3. Staff Carousel
        'layout_staff' => array(
          'key'        => 'layout_staff',
          'name'       => 'staff',
          'label'      => 'Staff Carousel',
          'sub_fields' => array(
            array('key'=>'field_hp_staff','label'=>'Select Staff','name'=>'staff_members','type'=>'relationship','post_type'=>array('staff'),'return_format'=>'object','filters'=>array('search'),'max'=>6),
          ),
        ),
        // 4. Google Reviews
        'layout_reviews' => array(
          'key'        => 'layout_reviews',
          'name'       => 'reviews',
          'label'      => 'Google Reviews',
          'sub_fields' => array(
            array('key'=>'field_hp_reviews_shortcode','label'=>'Reviews Shortcode','name'=>'reviews_shortcode','type'=>'text','instructions'=>'Paste your Google reviews shortcode'),
          ),
        ),
        // 5. Rolling Testimonials
        'layout_testimonials' => array(
          'key'        => 'layout_testimonials',
          'name'       => 'testimonials',
          'label'      => 'Testimonials',
          'sub_fields' => array(
            array('key'=>'field_hp_testimonials','label'=>'Select Testimonials','name'=>'testimonials','type'=>'relationship','post_type'=>array('testimonial'),'return_format'=>'object','max'=>5),
          ),
        ),
        // 6. Featured Services
        'layout_services' => array(
          'key'        => 'layout_services',
          'name'       => 'featured_services',
          'label'      => 'Featured Services',
          'sub_fields' => array(
            array('key'=>'field_hp_services','label'=>'Select Services','name'=>'services','type'=>'relationship','post_type'=>array('service'),'return_format'=>'object','filters'=>array('search'),'max'=>6),
          ),
        ),
        // 7. Monthly Specials
        'layout_specials' => array(
          'key'        => 'layout_specials',
          'name'       => 'monthly_specials',
          'label'      => 'Monthly Specials',
          'sub_fields' => array(
            array('key'=>'field_hp_specials','label'=>'Select Specials','name'=>'specials','type'=>'relationship','post_type'=>array('monthly_special'),'return_format'=>'object','max'=>3),
          ),
        ),
        // 8. Skincare Slider
        'layout_skincare' => array(
          'key'        => 'layout_skincare',
          'name'       => 'skincare_lines',
          'label'      => 'Skincare Lines',
          'sub_fields' => array(
            array('key'=>'field_hp_skincare','label'=>'Select Brands','name'=>'skincare_brands','type'=>'relationship','post_type'=>array('skincare_line'),'return_format'=>'object','max'=>8),
          ),
        ),
        // 9. CTA Section
        'layout_cta' => array(
          'key'        => 'layout_cta',
          'name'       => 'cta',
          'label'      => 'Call To Action',
          'sub_fields' => array(
            array('key'=>'field_hp_cta_heading','label'=>'Heading','name'=>'cta_heading','type'=>'text'),
            array('key'=>'field_hp_cta_text','label'=>'Text','name'=>'cta_text','type'=>'textarea'),
            array('key'=>'field_hp_cta_button_text','label'=>'Button Text','name'=>'cta_button_text','type'=>'text'),
            array('key'=>'field_hp_cta_button_url','label'=>'Button URL','name'=>'cta_button_url','type'=>'url'),
          ),
        ),
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param'    => 'page_type',
        'operator' => '==',
        'value'    => 'front_page',
      ),
    ),
  ),
  'style'                 => 'seamless',
  'position'              => 'normal',
  'label_placement'       => 'top',
  'instruction_placement' => 'label',
  'active'                => true,
));

/**
 * Add ACF Flexible Content for Homepage Sections
 * Paste this into your reluxe-site-snippets.php plugin (below other ACF groups).
 */
if ( function_exists( 'acf_add_local_field_group' ) ):

acf_add_local_field_group(array(
  'key'      => 'group_homepage_sections',
  'title'    => 'Homepage Sections',
  'fields'   => array(
    array(
      'key'               => 'field_homepage_sections',
      'label'             => 'Sections',
      'name'              => 'homepage_sections',
      'type'              => 'flexible_content',
      'layouts'           => array(
        'layout_hero' => array(
          'key'        => 'layout_hero',
          'name'       => 'hero',
          'label'      => 'Hero',
          'sub_fields' => array(
            array('key'=>'field_hero_headline','label'=>'Headline','name'=>'headline','type'=>'text'),
            array('key'=>'field_hero_subhead','label'=>'Subheading','name'=>'subhead','type'=>'text'),
            array('key'=>'field_hero_background','label'=>'Background Image','name'=>'background_image','type'=>'image'),
            array('key'=>'field_hero_cta_text','label'=>'Button Text','name'=>'cta_text','type'=>'text'),
            array('key'=>'field_hero_cta_url','label'=>'Button URL','name'=>'cta_url','type'=>'url'),
          ),
        ),
        'layout_locations' => array(
          'key'        => 'layout_locations',
          'name'       => 'locations',
          'label'      => 'Locations',
          'sub_fields' => array(
            array('key'=>'field_locations_list','label'=>'Select Locations','name'=>'locations','type'=>'relationship','post_type'=>array('locations'),'return_format'=>'object'),
          ),
        ),
        'layout_staff' => array(
          'key'        => 'layout_staff',
          'name'       => 'staff',
          'label'      => 'Staff Carousel',
          'sub_fields' => array(
            array('key'=>'field_staff_list','label'=>'Select Staff','name'=>'staff_members','type'=>'relationship','post_type'=>array('staff'),'return_format'=>'object','filters'=>array('search'),'max'=>6),
          ),
        ),
        'layout_reviews' => array(
          'key'        => 'layout_reviews',
          'name'       => 'reviews',
          'label'      => 'Google Reviews',
          'sub_fields' => array(
            array('key'=>'field_reviews_shortcode','label'=>'Reviews Shortcode','name'=>'reviews_shortcode','type'=>'text','instructions'=>'Paste your Google reviews shortcode'),
          ),
        ),
        'layout_testimonials' => array(
          'key'        => 'layout_testimonials',
          'name'       => 'testimonials',
          'label'      => 'Testimonials',
          'sub_fields' => array(
            array('key'=>'field_testimonials_list','label'=>'Select Testimonials','name'=>'testimonials','type'=>'relationship','post_type'=>array('testimonial'),'return_format'=>'object','max'=>5),
          ),
        ),
        'layout_services' => array(
          'key'        => 'layout_services',
          'name'       => 'featured_services',
          'label'      => 'Featured Services',
          'sub_fields' => array(
            array('key'=>'field_services_list','label'=>'Select Services','name'=>'services','type'=>'relationship','post_type'=>array('service'),'return_format'=>'object','filters'=>array('search'),'max'=>6),
          ),
        ),
        'layout_specials' => array(
          'key'        => 'layout_specials',
          'name'       => 'monthly_specials',
          'label'      => 'Monthly Specials',
          'sub_fields' => array(
            array('key'=>'field_specials_list','label'=>'Select Specials','name'=>'specials','type'=>'relationship','post_type'=>array('monthly_special'),'return_format'=>'object','max'=>3),
          ),
        ),
        'layout_skincare' => array(
          'key'        => 'layout_skincare',
          'name'       => 'skincare_lines',
          'label'      => 'Skincare Lines',
          'sub_fields' => array(
            array('key'=>'field_skincare_list','label'=>'Select Brands','name'=>'skincare_brands','type'=>'relationship','post_type'=>array('skincare_line'),'return_format'=>'object','max'=>8),
          ),
        ),
        'layout_cta' => array(
          'key'        => 'layout_cta',
          'name'       => 'cta',
          'label'      => 'Call To Action',
          'sub_fields' => array(
            array('key'=>'field_cta_heading','label'=>'Heading','name'=>'cta_heading','type'=>'text'),
            array('key'=>'field_cta_text','label'=>'Text','name'=>'cta_text','type'=>'textarea'),
            array('key'=>'field_cta_button_text','label'=>'Button Text','name'=>'cta_button_text','type'=>'text'),
            array('key'=>'field_cta_button_url','label'=>'Button URL','name'=>'cta_button_url','type'=>'url'),
          ),
        ),
      ),
      'location' => array(
        array(
          array(
            'param'    => 'page_type',
            'operator' => '==',
            'value'    => 'front_page',
          ),
        ),
      ),
      'style'                 => 'seamless',
      'position'              => 'normal',
      'label_placement'       => 'top',
      'instruction_placement' => 'label',
      'active'                => true,
    ) );
endif;
