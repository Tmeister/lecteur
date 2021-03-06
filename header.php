<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Lecteur
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Merriweather:300,700|Roboto:900,700,300' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<?php $site_class = ( wp_is_mobile() ) ? '' : 'menu-visible' ?>

<body <?php body_class($site_class); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'lecteur' ); ?></a>
	<div class="menu-indicator"></div>
	<section id="secondary-content">
		<div id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php if ( get_theme_mod('lecteur_logo') ) : ?>
					<div class="logo-holder">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_theme_mod('lecteur_logo'); ?>" alt="<?php bloginfo( 'description' ); ?>">
						</a>
					</div>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; // End header image check. ?>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<?php get_sidebar(); ?>
		</div><!-- #masthead -->

	</section>

	<div id="content" class="site-content">
