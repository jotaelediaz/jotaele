<?php
/**
 * Template part for displaying author info
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jotaele
 */

?>

<div class="jotaele-author-box background-accent-jotaele">
	<div class="author-wrapper">
		<div class="author-img-wrapper">
			<div class="author-img-inner-wrapper">
				<?php if (get_the_author_meta('avatarblog')): ?>
					<img src="<?php echo wp_get_attachment_url(get_the_author_meta('avatarblog'))?>" class="avatar photo wt-author-img" alt="<?php echo get_the_author(); ?>">
				<?php else: 
					echo get_avatar( get_the_author_meta( 'ID' ), $size = '150', $default = '', $alt = '', $args = array( 'class' => 'wt-author-img' ) ); 
				endif; ?>
			</div>
		</div>
		<div class="author-text-wrapper">
			<div class="author-title">
				<div class="super-wrapper">
					<a rel="author" class="author-title-link url fn n" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>"><?php echo get_the_author(); ?></a>
					<div class="author-social">
						<?php /* if(get_the_author_url()):
							<a href="<?php echo get_the_author_url(); ?>" target="_blank"><i class="social-link-icon webwww"></i></a>
						<?php endif; */ ?>
						<?php if(get_the_author_meta('twitter')): ?>
							<a href="<?php echo get_the_author_meta('twitter'); ?>" target="_blank" rel="noopener"><i class="social-link-icon twitter"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('instagram')): ?>
							<a href="<?php echo get_the_author_meta('instagram'); ?>" target="_blank" rel="noopener"><i class="social-link-icon instagram"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('linkedin')): ?>
							<a href="<?php echo get_the_author_meta('linkedin'); ?>" target="_blank" rel="noopener"><i class="social-link-icon linkedin"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('behance')): ?>
							<a href="<?php echo get_the_author_meta('behance'); ?>" target="_blank" rel="noopener"><i class="social-link-icon behance"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('dribbble')): ?>
							<a href="<?php echo get_the_author_meta('dribbble'); ?>" target="_blank" rel="noopener"><i class="social-link-icon dribbble"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('github')): ?>
							<a href="<?php echo get_the_author_meta('github'); ?>" target="_blank" rel="noopener"><i class="social-link-icon github"></i></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('telegram')): ?>
							<a href="<?php echo get_the_author_meta('telegram'); ?>" target="_blank" rel="noopener"><i class="social-link-icon telegram"></i></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="jotaele-bio">
				<?php echo get_the_author_meta('description'); ?>
			</div>
		</div>
	</div>
</div><!-- .author-box -->
