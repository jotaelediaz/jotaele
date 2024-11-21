<?php
/**
 * Template part for newsletter and share cta buttons
 * 
 * @package jotaele
 */

?>

<div class="container">
	
	<div class="row">
		<div class="section-title-wrapper">
			<h3 class="section-title"><?php _e('¿Te ha gustado este artículo?', 'jotaele'); ?></h3>
			<span class="section-subtitle">Aquí tienes algunas formas de ayudarme a difundirlo</span>
		</div>
	</div>
	<div class="row">
			<div class="col-md-4">
				<div class="shareit-block">
					<div class="shareit-first">
						<div class="shareit-icon">
							<i class="icon-likes"></i>
						</div>
						<div class="shareit-text">
							<span class="title">
								Dale un corazón
							</span>
							<span class="txt">¡Si te gusta, pulsa el botón! Es solo un clic y no necesitas registrarte en ningún sitio. Me ayuda mucho a conocer qué temas interesan más a los lectores.</span>
						</div>
					</div>
					<a class="button-cta-jota">¡CTA!</a>
				</div>
			</div>
			<div class="col-md-4">
					<div class="shareit-block">
					<div class="shareit-first">
						<div class="shareit-icon">
							<i class="icon-repost"></i>
						</div>
						<div class="shareit-text">
							<span class="title">Compártelo en redes</span>
							<span class="txt">Puedes compartir el enlace de este artículo con quien creas que pueda interesarle. ¡Si lo deseas, también puedes darle difusión al hilo de BlueSky asociado!</span>
						</div>
						<a class="button-cta-jota">¡CTA!</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="shareit-block">
					<div class="shareit-first">
						<div class="shareit-icon">
							<i class="icon-buzon"></i>
						</div>
						<div class="shareit-text">
							<span class="title">Recíbelo en tu buzón</span>
							<span class="txt">Si te ha gustado este contenido, quizá quieras recibir más directamente en tu correo. No enviaré más de un email al mes, sin publicidad ni distracciones. ¡Prometido!</span>						
						</div>
					</div>
					<a class="button-cta-jota">¡CTA!</a>
					
				</div>
			</div>
	</div>
	<div class="row">
		<div class="section-cta-container">
			<a class="button-cta-jota" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Ver más artículos</a>
		</div>
	</div>
</div>