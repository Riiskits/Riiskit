<?php
/**
 * Useful utility functions for common tasks.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.1.0
 */


/**
 * Remove whitespace, + and "-".
 *
 * Useful for e.g. using href="tel:".
 * No need for escaping as it converts the string to an integer.
 *
 * @since		1.1.0
 *
 * @param $string
 * @return trimmed $string with str_replace
 */
function riiskit_trim_phonenr($string) {
	return absint( str_replace( array(" ", "+", "-"), "", $string ) );
}
