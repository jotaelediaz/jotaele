<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jotaele
 */

?>

<?php if( get_post_meta( $post->ID, 'has_social_thread', true ) && ( function_exists( 'get_field' ) ) && (get_field('social_network_thread')) ): ?>
	<?php $socialThread = get_field('social_network_thread'); ?>
	<?php $socialThreadType = ($socialThread['value'] === 'tiktok' || $socialThread['value'] === 'instagram') ? 'reel' : 'hilo' ?>
	
<aside id="social-thread-post-<?php the_ID(); ?>" class="social-thread-post <?php echo $socialThread['value']; ?>">
	<a href="<?php echo get_post_meta( $post->ID, 'social_thread_link', true ); ?>" target="_blank">
		<div class="icon-box">
			<i class="social-link-icon <?php echo $socialThread['value']; ?>"></i>
		</div>
		<div class="description">
			<span class="title">
				<?php _e('Este contenido fue publicado también como un ' . $socialThreadType . ' en ' . $socialThread['label'] . '.', 'jotaele'); ?>
			</span>
			<span class="link">
				<?php _e('Pulsa aquí si deseas consultar el contenido en esta red social.', 'jotaele'); ?>
			</span>
		</div>
	</a>
</aside>

<?php endif; ?>
