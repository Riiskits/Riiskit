<?php
/**
 * Modify the user role capabilities.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 */


// Editors
$editor = get_role('editor');

$editor->add_cap( 'edit_theme_options' );
