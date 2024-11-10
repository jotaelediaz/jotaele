<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jotaele
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.png" rel="shortcut icon">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/faviconApple.png">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php if (wp_is_mobile()) { echo 'ontouchstart=""'; }?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Saltar al contenido', 'jotaele' ); ?></a>
	<div id="header-wrapper">
		<header id="masthead" class="site-header sticky-menu sticky-topbar">
			<div class="superwrapper container position-relative">
				<div class="row align-items-center">	
					<div class="col-3">
						<div class="d-flex justify-content-start">
							<button type="button" class="primary-menu-toggle header-button" aria-controls="primary-menu" aria-expanded="true" id="button-main-menu-toggle" aria-labelledby="main-menu-toggle-label"><i class="menu-icon"></i><span id="main-menu-toggle-label" hidden><?php esc_html_e( 'Menú Principal', 'jotaele' ); ?></span></button>
						</div>
					</div>
					<div class="site-branding col-6">
						<div class="text-center">
							<a class="site-title d-inline-block text-center" href="<?php echo get_option('jotaele_url'); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/JotaTeca.svg" class="logo-img" width="220" alt="<?php bloginfo( 'name' ); ?>"/>
							</a>
							
						</div>
					</div><!-- .site-branding -->
					<div class="col-3">
						<div class="d-flex justify-content-end">
							<button type="button" class="search-menu-toggle header-button" aria-controls="search-menu" aria-expanded="false" id="button-search-toggle" aria-labelledby="search-toggle-label"><i class="search-icon"></i><span id="search-toggle-label" hidden><?php esc_html_e( 'Buscar artículos', 'jotaele' ); ?></span></button>
						</div>
					</div>
				</div>
				<div id="main-search-bar" class="row align-items-center search-menu not-visible">
					<div class="d-flex align-items-center">
						<div class="col-11">
							<ul class="search-bar-wrapper">
								<?php dynamic_sidebar( 'search-bar' ); ?>
							</ul>
						</div>
						<div class="col-1 d-flex justify-content-end">
							<button type="button" class="close-menu-toggle search-menu-toggle header-button" aria-controls="search-menu" aria-expanded="false" aria-labelledby="search-close-label"><i class="close-icon"></i><span id="search-close-label" hidden><?php esc_html_e( 'Cerrar menú de búsqueda', 'jotaele' ); ?></span></button>
						</div>
					</div>
				</div>
			</div>
			<?php /* <div id="bar-read-progress" class="bar-read-progress"></div> */ ?>
			<div id="main-menu-wrapper" class="main-menu-wrapper side-menu">
				<button type="button" class="primary-menu-close side-menu-overlay" aria-controls="primary-menu" id="overlay-main-menu-toggle" aria-labelledby="main-menu-close-label"><span id="main-menu-close-label" hidden><?php esc_html_e( 'Cerrar menú principal', 'jotaele' ); ?></span></button>
				<div id="main-menu-superwrapper">
					<div class="header-main-menu">
						<a class="logo-menu-wrapper jotaele-squares-animation-wrapper" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<div class="jotaele-squares">
								<i class="square-jota"></i>
								<i class="square-ele"></i>
							</div>

							<span class="title-main-menu"><?php bloginfo( 'name' ); ?></span>
						</a>
						<div class="close-menu-wrapper">
							<button type="button" class="close-menu-toggle primary-menu-close header-button" aria-controls="search-menu" aria-expanded="false" aria-labelledby="search-close-label"><i class="close-icon"></i><span id="search-close-label" hidden><?php esc_html_e( 'Cerrar menú de búsqueda', 'jotaele' ); ?></span></button>
						</div>
					</div>
					<div class="search-and-nav">
						<div class="search-menu-wrapper">
							<ul class="search-menu">
								<?php dynamic_sidebar( 'search-bar' ); ?>
							</ul>
						</div>
						<nav id="site-navigation" class="main-menu-navigation">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
									)
								);
							?>
						</nav>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->
	</div>
