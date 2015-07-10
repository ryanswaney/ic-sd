<?php

// Register Custom Post Type
function register_icsd_agendas_cpt() {

  $labels = array(
    'name'                => _x( 'Agendas', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Agenda', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Agendas', 'text_domain' ),
    'name_admin_bar'      => __( 'Agenda', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Agenda:', 'text_domain' ),
    'all_items'           => __( 'All Agendas', 'text_domain' ),
    'add_new_item'        => __( 'Add New Agenda', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'new_item'            => __( 'New Agenda', 'text_domain' ),
    'edit_item'           => __( 'Edit Agenda', 'text_domain' ),
    'update_item'         => __( 'Update Agenda', 'text_domain' ),
    'view_item'           => __( 'View Agenda', 'text_domain' ),
    'search_items'        => __( 'Search Agenda', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'Agendas', 'text_domain' ),
    'description'         => __( 'Agendas for the ICSD Events', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title' ),
    'hierarchical'        => false,
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-clipboard',
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => false,
    'can_export'          => true,
    'has_archive'         => false,    
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'capability_type'     => 'post',
  );
  register_post_type( 'agendas', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_icsd_agendas_cpt', 0 );

?>