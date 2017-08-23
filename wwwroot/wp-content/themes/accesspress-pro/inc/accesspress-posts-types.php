<?php
/**
 * AccessPress Pro Custom Post Types
 *
 * @package Accesspress Pro
 */
function accesspress_pro_create_carsoul() {
    $labels = array(
        'name'               => _x( 'Logos', 'post type general name' , 'accesspress-pro'),
        'singular_name'      => _x( 'Logo', 'post type singular name' , 'accesspress-pro'),
        'add_new'            => _x( 'Add New', 'Logo' , 'accesspress-pro'),
        'add_new_item'       => __( 'Add New Logo' , 'accesspress-pro'),
        'edit_item'          => __( 'Edit Logo' , 'accesspress-pro' ),
        'new_item'           => __( 'New Logo' , 'accesspress-pro' ),
        'all_items'          => __( 'All Logo' , 'accesspress-pro' ),
        'view_item'          => __( 'View Logo' , 'accesspress-pro' ),
        'search_items'       => __( 'Search Logo' , 'accesspress-pro' ),
        'not_found'          => __( 'No Logo found' , 'accesspress-pro' ),
        'not_found_in_trash' => __( 'No Logo found in the Trash' , 'accesspress-pro' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Clients Logo'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Logos and Logo specific data',
        'public'        => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'thumbnail' ),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-images-alt2'
    );
    register_post_type( 'logo', $args );    
}

add_action( 'init', 'accesspress_pro_create_carsoul' );

function accesspress_pro_testimonial() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name' , 'accesspress-pro'),
        'singular_name'      => _x( 'Testimonial', 'post type singular name' , 'accesspress-pro'),
        'add_new'            => _x( 'Add New', 'Testimonial' , 'accesspress-pro'),
        'add_new_item'       => __( 'Add New Testimonial' , 'accesspress-pro'),
        'edit_item'          => __( 'Edit Testimonial' , 'accesspress-pro' ),
        'new_item'           => __( 'New Testimonial' , 'accesspress-pro' ),
        'all_items'          => __( 'All Testimonial' , 'accesspress-pro' ),
        'view_item'          => __( 'View Testimonial' , 'accesspress-pro' ),
        'search_items'       => __( 'Search Testimonial' , 'accesspress-pro' ),
        'not_found'          => __( 'No Testimonial found' , 'accesspress-pro' ),
        'not_found_in_trash' => __( 'No Testimonial found in the Trash' , 'accesspress-pro' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Testimonials'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Testimonials and Testimonial specific data',
        'public'        => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'thumbnail', 'editor' ),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-admin-users'
    );
    register_post_type( 'testimonial', $args );    
}

add_action( 'init', 'accesspress_pro_testimonial' );

function accesspress_pro_create_events() {
    $labels = array(
        'name'               => _x( 'Events', 'post type general name' , 'accesspress-pro' ),
        'singular_name'      => _x( 'Event', 'post type singular name' , 'accesspress-pro' ),
        'add_new'            => _x( 'Add New', 'Event' , 'accesspress-pro' ),
        'add_new_item'       => __( 'Add New Event' , 'accesspress-pro' ),
        'edit_item'          => __( 'Edit Event' , 'accesspress-pro' ),
        'new_item'           => __( 'New Event' , 'accesspress-pro' ),
        'all_items'          => __( 'All Event' , 'accesspress-pro' ),
        'view_item'          => __( 'View Event' , 'accesspress-pro' ),
        'search_items'       => __( 'Search Event' , 'accesspress-pro' ),
        'not_found'          => __( 'No Event found' , 'accesspress-pro' ),
        'not_found_in_trash' => __( 'No Event found in the Trash' , 'accesspress-pro' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Event'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Posts and Post specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail'),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-calendar'
    );
    register_post_type( 'events', $args );    
}

add_action( 'init', 'accesspress_pro_create_events' );

function accesspress_pro_create_faqs() {
    $labels = array(
        'name'               => _x( 'FAQ', 'post type general name' , 'accesspress-pro' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name' , 'accesspress-pro' ),
        'add_new'            => _x( 'Add New', 'FAQ' , 'accesspress-pro' ),
        'add_new_item'       => __( 'Add New FAQ' , 'accesspress-pro' ),
        'edit_item'          => __( 'Edit FAQ' , 'accesspress-pro' ),
        'new_item'           => __( 'New FAQ' , 'accesspress-pro' ),
        'all_items'          => __( 'All FAQ' , 'accesspress-pro' ),
        'view_item'          => __( 'View FAQ' , 'accesspress-pro' ),
        'search_items'       => __( 'Search FAQ' , 'accesspress-pro' ),
        'not_found'          => __( 'No FAQ found' , 'accesspress-pro' ),
        'not_found_in_trash' => __( 'No FAQ found in the Trash'  , 'accesspress-pro'),
        'parent_item_colon'  => '',
        'menu_name'          => 'FAQ'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our FAQs and FAQ specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor'),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-megaphone'
    );
    register_post_type( 'faqs', $args );    
}

add_action( 'init', 'accesspress_pro_create_faqs' );

function accesspress_pro_create_portfolio() {
    $labels = array(
        'name'               => _x( 'Portfolios', 'post type general name' , 'accesspress-pro' ),
        'singular_name'      => _x( 'Portfolio', 'post type singular name' , 'accesspress-pro' ),
        'add_new'            => _x( 'Add New', 'Portfolio' , 'accesspress-pro' ),
        'add_new_item'       => __( 'Add New Portfolio' , 'accesspress-pro' ),
        'edit_item'          => __( 'Edit Portfolio' , 'accesspress-pro' ),
        'new_item'           => __( 'New Portfolio' , 'accesspress-pro' ),
        'all_items'          => __( 'All Portfolio' , 'accesspress-pro'),
        'view_item'          => __( 'View Portfolio' , 'accesspress-pro'),
        'search_items'       => __( 'Search Portfolio' , 'accesspress-pro'),
        'not_found'          => __( 'No Portfolio found' , 'accesspress-pro'),
        'not_found_in_trash' => __( 'No Portfolio found in the Trash' , 'accesspress-pro'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Testimonials and Portfolio specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail'),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-portfolio',
    );
    register_post_type( 'portfolio', $args );    
}

add_action( 'init', 'accesspress_pro_create_portfolio' );

function create_portfolio_category() {
    $labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'accesspress-pro' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'accesspress-pro' ),
        'search_items'      => __( 'Search Portfolio Categories', 'accesspress-pro' ),
        'all_items'         => __( 'All Portfolio Categories', 'accesspress-pro' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'accesspress-pro' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'accesspress-pro' ),
        'edit_item'         => __( 'Edit Portfolio Category', 'accesspress-pro' ),
        'update_item'       => __( 'Update Portfolio Category', 'accesspress-pro' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'accesspress-pro' ),
        'new_item_name'     => __( 'New Portfolio Category', 'accesspress-pro' ),
        'menu_name'         => __( 'Portfolio Categories', 'accesspress-pro' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'portfolio-category', 'portfolio', $args );
}
add_action( 'init', 'create_portfolio_category', 0 );

