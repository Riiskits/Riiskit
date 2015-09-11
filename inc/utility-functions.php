<?php
/**
 * Useful utility functions for common tasks.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.1.0
 */


if ( ! function_exists( 'riiskit_trim_phonenr' ) ) :
    /**
     * Remove whitespace and "-".
     *
     * Useful for e.g. using href="tel:".
     * No need for escaping as it converts the string to an integer.
     *
     * @since 1.1.0
     *
     * @param $string
     * @return trimmed $string with str_replace
     */
    function riiskit_trim_phonenr($string) {
    	return absint( str_replace( array(" ", "-"), "", $string ) );
    }
endif;

/**
 * Sanitise number
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_number( $value ) {
    $value = (int) $value;
    return ( 0 < $value ) ? $value : null;
}

/**
 * Sanitize checkbox
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_checkbox( $input ) {
    if ( $input === true ) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * Sanitize URL
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_url( $value) {
    $value = esc_url( $value);
    return $value;
}

/**
 * Sanitize HTML
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_html( $input ) {
    return wp_kses_post($input);
}

/**
 * Sanitize color hex
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_hex_color( $color ) {
    if ( $unhashed = sanitize_hex_color_no_hash( $color ) )
        return '#' . $unhashed;

    return $color;
}
