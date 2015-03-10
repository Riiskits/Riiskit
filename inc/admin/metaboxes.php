<?php
/**
 * Remove unused metaboxes.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.2.0
 */

if ( is_admin() ) {
	function riiskit_remove_meta_boxes() {
		// Posts
		remove_meta_box('trackbacksdiv', 'post', 'normal');
		remove_meta_box('commentstatusdiv', 'post', 'normal');
		remove_meta_box('commentsdiv', 'post', 'normal');
		// Pages
		remove_meta_box('trackbacksdiv', 'page', 'normal');
		remove_meta_box('commentstatusdiv', 'page', 'normal');
		remove_meta_box('commentsdiv', 'page', 'normal');
	}
	add_action( 'admin_menu', 'riiskit_remove_meta_boxes' );
}
