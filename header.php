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
<!DOCTYPE html>
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="shortcut icon" href="<?php echo RIISKIT_BASE_URL . 'favicon.ico'; ?>" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?php echo RIISKIT_BASE_URL . 'apple-touch-icon-precomposed.png'; ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!--[if lt IE 8]>
		<p class="browsehappy"><a href="http://browsehappy.com/" target="_blank"><?php _e('You are using an outdated, slow and unsecure browser. Please upgrade to improve your experience.', 'riiskit'); ?></a></p>
	<![endif]-->





	<div class="site">

		<header class="site-header" role="banner">
			<div class="site-header__inner">

				<a class="site-header__inner__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Click to visit homepage', 'riiskit'); ?>" rel="home">
					<img src="<?php echo RIISKIT_BASE_URL . 'img/logo.png'; ?>" alt="<?php echo esc_html( get_bloginfo('name') ); ?>" width="80" height="80" />
				</a>



				<div class="screenreader"><a href="#site-main"><?php _e('Skip to content', 'riiskit'); ?></a></div>

				<button type="button" class="toggle-menu-btn" title="<?php _e('Toggle menu', 'riiskit'); ?>" aria-pressed="false">
					<svg class="toggle-menu-btn__svg toggle-menu-btn__icon" width="25" height="25" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M2.4 11.833h43.2c1.325 0 2.4-1.082 2.4-2.417 0-1.335-1.075-2.417-2.4-2.417h-43.2c-1.325 0-2.4 1.082-2.4 2.417 0 1.335 1.075 2.417 2.4 2.417zm43.2 9.667h-43.2c-1.325 0-2.4 1.082-2.4 2.417 0 1.335 1.075 2.417 2.4 2.417h43.2c1.325 0 2.4-1.082 2.4-2.417 0-1.335-1.075-2.417-2.4-2.417zm0 14.5h-43.2c-1.325 0-2.4 1.082-2.4 2.417 0 1.335 1.075 2.417 2.4 2.417h43.2c1.325 0 2.4-1.082 2.4-2.417 0-1.335-1.075-2.417-2.4-2.417z" fill="#000"/></svg>
					<img src="<?php echo RIISKIT_BASE_URL; ?>img/icons/hamburger-menu.png" alt="<?php _e('Click the icon to open menu', 'riiskit'); ?>" class="toggle-menu-btn__img toggle-menu-btn__icon" width="25" height="25" />

					<span class="toggle-menu-btn__title">
						<?php _e('Menu', 'riiskit'); ?>
					</span>
				</button> <!-- .toggle-menu-btn -->

				<nav class="site-header__nav" role="navigation">
					<?php
					$slideout_id = '';
					if ( 'slideout-menu' === get_option('developer_menu_type') ) {
						$slideout_id = 'rk-slideout';
					}

					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class' => 'menu-primary',
						'menu_id' => $slideout_id,
					) );
					?>
				</nav> <!-- site-header__nav -->

			</div> <!-- .site-header__inner -->
		</header> <!-- .site-header -->





		<div id="site-main" class="site-main">
