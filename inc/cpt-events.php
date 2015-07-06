<?php

// Register Custom Post Type
function register_icsd_event_cpt() {

  $labels = array(
    'name'                => _x( 'Events', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Events', 'text_domain' ),
    'name_admin_bar'      => __( 'Event', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Event:', 'text_domain' ),
    'all_items'           => __( 'All Events', 'text_domain' ),
    'add_new_item'        => __( 'Add New Event', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'new_item'            => __( 'New Event', 'text_domain' ),
    'edit_item'           => __( 'Edit Event', 'text_domain' ),
    'update_item'         => __( 'Update Event', 'text_domain' ),
    'view_item'           => __( 'View Event', 'text_domain' ),
    'search_items'        => __( 'Search Event', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'events', 'text_domain' ),
    'description'         => __( 'Event postings for the ICSD', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-calendar-alt',
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,    
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
  );
  register_post_type( 'events', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_icsd_event_cpt', 0 );

?>