<?php
/**
 * Custom post types (CPTs).
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 */

// CPT without translation
function register_riiskit_reference()
{
    $labels = array(
        'name' => 'Referanser',
        'singular_name' => 'Referanse',
        'add_new' => _x( 'Add', 'reference', 'riiskit' ),
        'add_new_item' => 'Legg til referanse',
        'edit_item' => 'Rediger referanse',
        'new_item' => 'Ny referanse',
        'view_item' => 'Vis referanse',
        'search_items' => 'Søk etter referanser',
        'not_found' => 'Ingen referanser funnet',
        'not_found_in_trash' => 'Ingen referanser i søppelkurven',
        'parent_item_colon' => 'Forelderreferanse',
        'menu_name' => 'Referanser',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => '',
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
        'taxonomies' => array( 'category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		'menu_icon' => 'dashicons-feedback',

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'reference', $args );
}
add_action( 'init', 'register_riiskit_reference' );


// CPT with translation
function register_riiskit_employee()
{
    $labels = array(
        'name' => _x( 'Employee', 'employee', 'riiskit' ),
        'singular_name' => _x( 'Employee', 'employee', 'riiskit' ),
        'add_new' => _x( 'Add', 'employee', 'riiskit' ),
        'add_new_item' => _x( 'Add employee', 'employee', 'riiskit' ),
        'edit_item' => _x( 'Edit employee', 'employee', 'riiskit' ),
        'new_item' => _x( 'New employee', 'employee', 'riiskit' ),
        'view_item' => _x( 'Show employee', 'employee', 'riiskit' ),
        'search_items' => _x( 'Search for employees', 'employee', 'riiskit' ),
        'not_found' => _x( 'No employees found', 'employee', 'riiskit' ),
        'not_found_in_trash' => _x( 'No employees in the trash', 'employee', 'riiskit' ),
        'parent_item_colon' => _x( 'Parent employee:', 'employee', 'riiskit' ),
        'menu_name' => _x( 'Employees', 'employee', 'riiskit' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => '',
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'employee', $args );
}
add_action( 'init', 'register_riiskit_employee' );
