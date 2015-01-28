<?php
/**
 * Init admin actions: Customize the WP Control Panel
 *
 * @package 	Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 */

/**
 * Switch the default login logo's link from Wordpress to the site URL.
 * @package Riiskit
 * @since Riiskit 1.0.0
 */
function my_login_logo_url() {
    return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


/**
 * Switch the default login logo's title.
 * @package Riiskit
 * @since Riiskit 1.0.0
 */
function my_login_logo_url_title() {
    return 'Click the logo to visit your site';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


if ( get_option('header_admin_logo') ) {
	if ( true === is_admin_bar_showing() ) {
		/**
		* Add a custom logo to the admin bar menu.
		* @package Riiskit
		* @since Riiskit 1.0.0
		*/
		function riiskit_admin_logo() { ?>
			<style>
				#wpadminbar #wp-admin-bar-wp-logo>.ab-item {
					background-image: url('<?php echo get_template_directory_uri(); ?>/style/img/logo-wpadminbar.png') !important;
					background-position: 50% 50%;
					background-size: cover;
				}
				@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 1.3 / 1), only screen and (min-resolution: 125dpi), only screen and (min-resolution: 1.3dppx) {
					#wpadminbar #wp-admin-bar-wp-logo>.ab-item {
						background-image: url('<?php echo get_template_directory_uri(); ?>/style/img/logo-wpadminbar@2x.png') !important;
					}
				}
				#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before{ content: ""; }
			</style>
		<?php }
		add_action('admin_head', 'riiskit_admin_logo');
		add_action('wp_head', 'riiskit_admin_logo');
	}

	/**
	* Add a custom logo to the login screen.
	* @package Riiskit
	* @since Riiskit 1.0.0
	*/
	function riiskit_login_logo() { ?>
		<style>
			body.login div#login h1 a {
				background-image:url('<?php echo get_template_directory_uri(); ?>/style/img/logo-login.png');
			}
			@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 1.3 / 1), only screen and (min-resolution: 125dpi), only screen and (min-resolution: 1.3dppx) {
				body.login div#login h1 a {
					background-image:url('<?php echo get_template_directory_uri(); ?>/style/img/logo-login@2x.png');
				}
			}

		</style>
	<?php }
	add_action('login_enqueue_scripts', 'riiskit_login_logo');
}
