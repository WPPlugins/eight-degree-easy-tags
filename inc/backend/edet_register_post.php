<?php
defined('ABSPATH') or die('No script kiddies please!');
$singular = __( 'Eight Degree Easy Tag' );
$plural = __( 'Eight Degree Easy Tags' );
		        //Used for the rewrite slug below.
$plural_slug = str_replace( ' ', '_', $plural );

		        //Setup all the labels to accurately reflect this post type.
$labels = array(
	'name' 					=> __($plural,'eight-degree-easy-tags'),
	'singular_name' 		=> __($singular,'eight-degree-easy-tags'),
	'add_new' 				=> __('Add New','eight-degree-easy-tags'),
	'add_new_item' 			=> __('Add New Tag Setting','eight-degree-easy-tags'),
	'edit'		        	=> __('Edit','eight-degree-easy-tags'),
	'edit_item'	        	=> __('Edit ' . $singular,'eight-degree-easy-tags'),
	'new_item'	        	=> __('New ' . $singular,'eight-degree-easy-tags'),
	'view' 					=> __('View ' . $singular,'eight-degree-easy-tags'),
	'view_item' 			=> __('View Tags ' . $singular,'eight-degree-easy-tags'),
	'search_term'   		=> __('Search Tags ' . $plural,'eight-degree-easy-tags'),
	'parent' 				=> __('Parent ' . $singular,'eight-degree-easy-tags'),
	'not_found' 			=> __('No ' . $plural .' found','eight-degree-easy-tags'),
	'not_found_in_trash' 	=> __('No ' . $plural .' in Trash','eight-degree-easy-tags')
	);

			        //Define all the arguments for this post type.
$args = array(
	'labels' 			  => $labels,
	'public'              => true,
	'publicly_queryable'  => true,
	'exclude_from_search' => false,
	'show_in_nav_menus'   => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 65,
	'menu_icon'           => 'dashicons-tag',
	'can_export'          => true,
	'delete_with_user'    => false,
	'hierarchical'        => false,
	'has_archive'         => true,
	'query_var'           => true,
	'capability_type'     => 'post',
	'map_meta_cap'        => true,
	'rewrite'             => array( 
	'slug' => strtolower( $plural_slug ),
		'with_front' => true,
		'pages' => true,
		'feeds' => false,

		),
	'supports'            => array('title')
	);
register_post_type( 'edet_post_prop', $args);
			//registering with unique post type name for custom post type



