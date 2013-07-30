<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Skyflat
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title( '|', false, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="icon" type="image/png" href="http://<?= $_SERVER['SERVER_NAME']; ?>/newportfolio/wp-content/uploads/2013/06/favicon.png">
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body>
		<?php do_action( 'before' ); ?>
		<header id="masthead" role="banner" class="site-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-brand">
						<a href="<?= bloginfo('home'); ?>" title="<?php _e('Home'); ?>" rel="home">
							<img src="<?= get_bloginfo('template_url') . '/img/florian.png'; ?>" alt="">
						</a>
					</div>
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					
					<?php wp_nav_menu(array(
						'theme_location'  => 'primary',
						'menu'  => 'menu',
						'container'       => 'div', 
						'container_class' => 'nav-collapse collapse navbar-static-top navbar-responsive-collapse', 
						'container_id'    => '',
						'menu_class'      => 'nav navbar-nav', 
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					)); ?>
					<ul class="menuIcon pull-right navSocial">
						<li class="twitter"><a href="<?= get_option('twitter_url', '#'); ?>" title="Profil Twitter : @GIRARDEYFlorian">twitter</a></li>
						<li class="facebook"><a href="<?= get_option('facebook_url', '#'); ?>" title="Profil Facebook : florian.girardey">facebook</a></li>
						<li class="google"><a href="<?= get_option('google_url', '#'); ?>" title="Profil Google+" rel="author">google+</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div id="main" class="site-main">