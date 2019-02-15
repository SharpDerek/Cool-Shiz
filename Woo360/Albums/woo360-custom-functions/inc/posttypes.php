<?php 
function register_posttypes() {
 
      $album_labels = array(
        'name' => __('Albums', 'mad'),
        'singular_name' => __('Album', 'mad'),
        'add_new' => __('Add New', 'mad'),
        'add_new_item' => __('Add New Album', 'mad'),
        'edit_item' => __('Edit Album', 'mad'),
        'new_item' => __('New Album', 'mad'),
        'all_items' => __('All Albums', 'mad'),
        'view_item' => __('View Album', 'mad'),
        'search_items' => __('Search Albums', 'mad'),
        'not_found' =>  __('No albums found', 'mad'),
        'not_found_in_trash' => __('No albums found in Trash', 'mad'),
        'parent_item_colon' => '',
        'menu_name' => __('Albums', 'mad')
      );

      $album_args = array(
        'menu_icon' => 'dashicons-format-gallery',
        'labels' => $album_labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'albums' ),
        'capability_type' => 'post',
        'has_archive' => 'albums',
        'hierarchical' => false,
        'menu_position' => 34,
        'supports' => array( 'title', 'editor', 'thumbnail' )
      );

    register_post_type( 'woo360_album', $album_args );
}

add_action( 'init', 'register_posttypes' );