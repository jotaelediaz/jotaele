<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jotaele
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-card'); ?>>
	<div class="card-header">
		<div class="wrapper-thumbnail-img">
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php if(has_post_thumbnail()): ?>
					<?php the_post_thumbnail('full'); ?>
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/JL_placeholder.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image placeholder-img"  decoding="async" fetchpriority="high" alt="<?php echo get_the_title(); ?>" >
				<?php endif; ?>
			</a>
		</div>
	</div>
	<div class="card-body">
			<div class="entry-meta categories-likes">
				<?php get_template_part( 'template-parts/content', 'categories-list', ['archive-post']); ?>
				<div class="wrapper-meta-box wrapper-likes">
					<i class="icon-likes"></i>
					<div class="position-relative vote-counter-wrapper d-inline-block">
						<span class="vote_counter position-relative"><?php echo get_post_meta($post->ID, "votes", true) ?  get_post_meta($post->ID, "votes", true) : "0"; ?></span>
					</div>
				</div>
			</div>
			<a class="link-wrapper" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<div class="super-wrapper">
					<header class="entry-header">
						<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
						<div class="entry-meta-wrapper">
							<div class="entry-meta">
								<div class="wrapper-meta-box wrapper-date">
									<i class="icon-calendario"></i>
									<?php jotaele_posted_on(); ?>
								</div>
							</div>
						</div><!-- .entry-meta-wrapper -->
					</header><!-- .entry-header -->

					<div class="card-text content">
						<?php if(get_post_meta($post->ID, "entradilla") && get_post_meta($post->ID, "entradilla")[0]): ?>
							<p class="excerpt entradilla"><?php echo wp_trim_words(get_post_meta($post->ID, "entradilla")[0], 20, '…'); ?></p>
						<?php else: ?>
							<p class="excerpt content-trimmed"><?php echo wp_trim_words( get_the_content(), 20, '…' ); ?></p>
						<?php endif; ?>
					</div><!-- .entry-content -->
				</div>
			
			<div class="read-more-button">
					<i class="square-jota-bullet"></i>
					<span><?php _e('Leer más…', 'jotaele'); ?></span>
					<i class="arrow-icon right" title="➡️"></i>
			</div>
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->