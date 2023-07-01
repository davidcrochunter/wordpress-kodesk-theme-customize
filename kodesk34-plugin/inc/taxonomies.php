<?php namespace KODESKPLUGIN\Inc;
use KODESKPLUGIN\Inc\Abstracts\Taxonomy;

class Taxonomies extends Taxonomy {

	public static function init() {

		//Services Taxonomy Start
		$labels = array(
			'name'              => _x( 'Service Category', 'kodesk' ),
			'singular_name'     => _x( 'Service Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Service Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'service_cat' ),
		);
		register_taxonomy( 'service_cat', 'service', $args );

		//Gallery Taxonomy Start
		$labels = array(
			'name'              => _x( 'Gallery Category', 'kodesk' ),
			'singular_name'     => _x( 'Gallery Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Gallery Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'gallery_cat' ),
		);
		register_taxonomy( 'gallery_cat', 'gallery', $args );
		
		//Testimonials Taxonomy Start
		$labels = array(
			'name'              => _x( 'Testimonials Category', 'kodesk' ),
			'singular_name'     => _x( 'Testimonials Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Testimonials Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'testimonials_cat' ),
		);
		register_taxonomy( 'testimonials_cat', 'testimonials', $args );
		
		
		//Team Taxonomy Start
		$labels = array(
			'name'              => _x( 'Team Category', 'kodesk' ),
			'singular_name'     => _x( 'Team Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Team Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'team_cat' ),
		);
		register_taxonomy( 'team_cat', 'team', $args );
		
		//Workspace Taxonomy Start
		$labels = array(
			'name'              => _x( 'Workspace Category', 'kodesk' ),
			'singular_name'     => _x( 'Workspace Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Workspace Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'workspace_cat' ),
		);
		register_taxonomy( 'workspace_cat', 'workspace', $args );

		// ══════════════════════════════╦════════════════════════════════
		// 
		//  ████          ████     ██    ██
		//    ███        ███      ██     ██
		//      ██      ██       ██      ██
		//      ██      ██       ██      ██
		//       ██    ██       ██       ██
		//       ██    ██      ███████████████
		//        ██  ██                 ██
		//        ██  ██                 ██
		//          ██                   ██
		/**
		 * v4 filter CATEGORIES
		 */
		//Workspace V4 filter Taxonomy Start
		$labels = array(
			'name'              => _x( 'District', 'kodesk' ),
			'singular_name'     => _x( 'District', 'kodesk' ),
			'search_items'      => __( 'Search District', 'kodesk' ),
			'all_items'         => __( 'All Districts', 'kodesk' ),
			'parent_item'       => __( 'Parent District', 'kodesk' ),
			'parent_item_colon' => __( 'Parent District:', 'kodesk' ),
			'edit_item'         => __( 'Edit District', 'kodesk' ),
			'update_item'       => __( 'Update District', 'kodesk' ),
			'add_new_item'      => __( 'Add New District', 'kodesk' ),
			'new_item_name'     => __( 'New District Name', 'kodesk' ),
			'menu_name'         => __( 'District', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'district_cat' ),
		);
		register_taxonomy( 'district_cat', 'workspace', $args );

		$labels = array(
			'name'              => _x( 'Usetype', 'kodesk' ),
			'singular_name'     => _x( 'Usetype', 'kodesk' ),
			'search_items'      => __( 'Search Usetype', 'kodesk' ),
			'all_items'         => __( 'All Usetype', 'kodesk' ),
			'parent_item'       => __( 'Parent Usetype', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Usetype:', 'kodesk' ),
			'edit_item'         => __( 'Edit Usetype', 'kodesk' ),
			'update_item'       => __( 'Update Usetype', 'kodesk' ),
			'add_new_item'      => __( 'Add New Usetype', 'kodesk' ),
			'new_item_name'     => __( 'New Usetype Name', 'kodesk' ),
			'menu_name'         => __( 'Usetype', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'usetype_cat' ),
		);
		register_taxonomy( 'usetype_cat', 'workspace', $args );

		$labels = array(
			'name'              => _x( 'Addcondition', 'kodesk' ),
			'singular_name'     => _x( 'Addcondition', 'kodesk' ),
			'search_items'      => __( 'Search Addcondition', 'kodesk' ),
			'all_items'         => __( 'All Addcondition', 'kodesk' ),
			'parent_item'       => __( 'Parent Addcondition', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Addcondition:', 'kodesk' ),
			'edit_item'         => __( 'Edit Addcondition', 'kodesk' ),
			'update_item'       => __( 'Update Addcondition', 'kodesk' ),
			'add_new_item'      => __( 'Add New Addcondition', 'kodesk' ),
			'new_item_name'     => __( 'New Addcondition Name', 'kodesk' ),
			'menu_name'         => __( 'Addcondition', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'addcondition_cat' ),
		);
		register_taxonomy( 'addcondition_cat', 'workspace', $args );
		//  ████          ████     ██    ██
		//    ███        ███      ██     ██
		//      ██      ██       ██      ██
		//      ██      ██       ██      ██
		//       ██    ██       ██       ██
		//       ██    ██      ███████████████
		//        ██  ██                 ██
		//        ██  ██                 ██
		//          ██                   ██
		//
		// ══════════════════════════════╩════════════════════════════════
		
		//Location Taxonomy Start
		$labels = array(
			'name'              => _x( 'Location Category', 'kodesk' ),
			'singular_name'     => _x( 'Location Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Location Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'location_cat' ),
		);
		register_taxonomy( 'location_cat', 'location', $args );
		
		//Faqs Taxonomy Start
		$labels = array(
			'name'              => _x( 'Faqs Category', 'kodesk' ),
			'singular_name'     => _x( 'Faq Category', 'kodesk' ),
			'search_items'      => __( 'Search Category', 'kodesk' ),
			'all_items'         => __( 'All Categories', 'kodesk' ),
			'parent_item'       => __( 'Parent Category', 'kodesk' ),
			'parent_item_colon' => __( 'Parent Category:', 'kodesk' ),
			'edit_item'         => __( 'Edit Category', 'kodesk' ),
			'update_item'       => __( 'Update Category', 'kodesk' ),
			'add_new_item'      => __( 'Add New Category', 'kodesk' ),
			'new_item_name'     => __( 'New Category Name', 'kodesk' ),
			'menu_name'         => __( 'Faq Category', 'kodesk' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'faqs_cat' ),
		);
		register_taxonomy( 'faqs_cat', 'faqs', $args );
	}
	
}
