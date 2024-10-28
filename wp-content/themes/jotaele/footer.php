<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jotaele
 */

?>

	<footer id="colophon" class="site-footer background-grey-jotaele">
		<div class="container-fluid">
			<div class="container">
				<div class="row main-footer-wrapper">
					<div class="footer-left">
						<a class="footer-logo logo-jotaele d-block" href="<?php echo get_option('jotaele_url') ?>" target="_blank">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/JotaEle.svg" class="logo-img-jotaele" width="220" alt="<?php _e('JotaEle Díaz'); ?>"/>
						</a>
						<div class="desc-text-wrapper">
							<span class="footer-desc-title d-block"><?php _e('¡Gracias por leerme! 👋'); ?></span>
							<span class="footer-desc-subtitle d-block">
								<?php _e('JotaTeca es un blog sobre branding, diseño, trenes y otras curiosidades.'); ?>
							</span>
						</div>
					</div>
					<div class="footer-down">
						<div class="copyright-text-wrapper">
							<div class="ending-copy">
								<span class="copyright-footer">© <?php echo date("Y"); ?> JotaEle </span>
								<nav id="footer-menu-tres" class="legal-menu"><?php wp_nav_menu(array('theme_location' => 'footer_menu_legal',)); ?></nav>
							</div>
							
							<span class="no-cooks"><i class="no-cooks-icon"></i> Este sitio web no utiliza cookies publicitarias ni otros métodos de rastreo.</span>
						</div>
					</div>
					<div class="footer-right">
						<div class="wrapper-footer-menus d-flex">
							<nav id="footer-menu-uno" class="footer-menu">
								<span class="footer-menu-title d-block"><?php echo wp_get_nav_menu_name("footer_menu_1"); ?></span>
							<?php
								wp_nav_menu(array('theme_location' => 'footer_menu_1',));
							?>
							</nav>
							<nav id="footer-menu-dos" class="footer-menu">
								<span class="footer-menu-title d-block"><?php echo wp_get_nav_menu_name("footer_menu_2"); ?></span>
								<?php
									wp_nav_menu(array('theme_location' => 'footer_menu_2',));
								?>
							</nav>
							<nav id="footer-menu-tres" class="footer-menu">
								<span class="footer-menu-title d-block"><?php echo wp_get_nav_menu_name("footer_menu_3"); ?></span>
								<?php
									wp_nav_menu(array('theme_location' => 'footer_menu_3',));
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
