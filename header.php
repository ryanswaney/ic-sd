<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package icsd
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> role="document">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'icsd' ); ?></a>

	<header id="header" class="okayNav-header">
		<?php
			if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
			}
		?>
		<!--
			<a class="okayNav-header__logo" href="#">
				 Logo
			</a>
		-->

			<nav role="navigation" id="nav-main" class="okayNav">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'none', 'menu_id' => 'primary-menu' ) ); ?>
			</nav>
	</header><!-- /header -->

	<div id="content" class="site-content">
