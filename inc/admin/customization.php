<?php
/**
 * Customize your admin area.
 *
 * @package 	Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 */

/**
 * Switch the default login-logo's link from Wordpress to the site URL.
 * @package Riiskit
 * @since Riiskit 1.0.0
 */
function riiskit_login_logo_url() {
    return esc_url( home_url('/') );
}
add_filter( 'login_headerurl', 'riiskit_login_logo_url' );


/**
 * Switch the default login-logo's link title.
 * @package Riiskit
 * @since Riiskit 1.0.0
 */
function riiskit_login_logo_title() {
    return __('Go back to the website', 'riiskit');
}
add_filter( 'login_headertitle', 'riiskit_login_logo_title' );


/**
 * Add a custom logo to the admin bar menu.
 * @package Riiskit
 * @since Riiskit 1.0.0
 */
function riiskit_adminbar_logo() { ?>
	<style>
		#wpadminbar #wp-admin-bar-wp-logo>.ab-item {
			background-image: url('<?php echo get_template_directory_uri(); ?>/img/logo.png');
			background-position: center;
			background-size: 25px;
			background-repeat: no-repeat;
		}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 1.3 / 1), only screen and (min-resolution: 125dpi), only screen and (min-resolution: 1.3dppx) {
			#wpadminbar #wp-admin-bar-wp-logo>.ab-item {
				background-image: url('<?php echo get_template_directory_uri(); ?>/img/logo@2x.png');
			}
		}
		#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before { content: ""; }
	</style>
<?php }
add_action('admin_head', 'riiskit_adminbar_logo');
add_action('wp_head', 'riiskit_adminbar_logo');

/**
* Add a custom logo to the login screen.
* @package Riiskit
* @since Riiskit 1.0.0
*/
function riiskit_login_logo() { ?>
	<style>
		body.login div#login h1 a {
			width: 80px; height: 80px;
			background-image: url('<?php echo get_template_directory_uri(); ?>/img/logo.png');
			background-size: 80px;
		}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 1.3 / 1), only screen and (min-resolution: 125dpi), only screen and (min-resolution: 1.3dppx) {
			body.login div#login h1 a {
				background-image: url('<?php echo get_template_directory_uri(); ?>/img/logo@2x.png');
			}
		}

	</style>
<?php }
add_action('login_enqueue_scripts', 'riiskit_login_logo');
