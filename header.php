<?php
/**
 * Displays all of the <head> section and everything up til <div id="site-main">
 *
 * @package WordPress
 * @subpackage Riiskit
 *
 * @since Riiskit 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="shortcut icon" href="<?php echo RIISKIT_BASE_URL . 'favicon.ico'; ?>" type="image/x-icon">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!--[if lt IE 8]>
		<p class="browserupgrade"><a href="http://browsehappy.com/" target="_blank"><?php _e('You are using an outdated, slow and unsecure browser. Please upgrade to improve your experience.', 'riiskit'); ?></a></p>
	<![endif]-->





	<div class="site">

		<header class="site-header" role="banner">
			<div class="site-header__inner">

				<a class="site-header__inner__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Click to visit homepage', 'riiskit'); ?>" rel="home">
					<img src="<?php echo RIISKIT_BASE_URL . 'dist/img/logo.png'; ?>" alt="<?php echo esc_html( get_bloginfo('name') ); ?>" width="80" height="80" />
				</a>



				<div class="screenreader"><a href="#site-main"><?php _e('Skip to content', 'riiskit'); ?></a></div>

				<button type="button" class="toggle-menu-btn" title="<?php _e('Toggle menu', 'riiskit'); ?>" aria-pressed="false">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>

					<span class="toggle-menu-btn__title">
						<?php _e('Menu', 'riiskit'); ?>
					</span>
				</button> <!-- .toggle-menu-btn -->

				<nav class="site-header__nav" role="navigation">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class' => 'menu-primary',
						) );
					?>
				</nav> <!-- site-header__nav -->

			</div> <!-- .site-header__inner -->
		</header> <!-- .site-header -->





		<div id="site-main" class="site-main">
