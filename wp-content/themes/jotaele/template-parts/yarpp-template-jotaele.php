<?php
/*
YARPP Template: Thumbnails
Description: This template returns the related posts as thumbnails in an ordered list. Requires a theme which supports post thumbnails.
Author: YARPP Team
*/
?>

<?php
/*
Templating in YARPP enables developers to uber-customize their YARPP display using PHP and template tags.

The tags we use in YARPP templates are the same as the template tags used in any WordPress template. In fact, any WordPress template tag will work in the YARPP Loop. You can use these template tags to display the excerpt, the post date, the comment count, or even some custom metadata. In addition, template tags from other plugins will also work.

If you've ever had to tweak or build a WordPress theme before, you’ll immediately feel at home.

// Special template tags which only work within a YARPP Loop:

1. the_score()      // this will print the YARPP match score of that particular related post
2. get_the_score()      // or return the YARPP match score of that particular related post

Notes:
1. If you would like Pinterest not to save an image, add `data-pin-nopin="true"` to the img tag.

*/
?>

<?php
/* Pick Thumbnail */
global $_wp_additional_image_sizes;
if ( isset( $_wp_additional_image_sizes['yarpp-thumbnail'] ) ) {
	$dimensions['size'] = 'yarpp-thumbnail';
} else {
	$dimensions['size'] = 'medium'; // default
}

$jotaeleRelatedPosts = yarpp_get_related(
	array(
		'limit' => 6,
		'threshold' => 1,
		'post_type' => 'post',
		'order' => 'score DESC',
		'weight' => array(
			'title' => 1,
			'body' => 1,
			'tax' => array(
				'category' => 2,
				'tag' => 3,
			)
		),
	)
);

global $post;
?>
<div class="container">
	
	<div class="row">
		<div class="section-title-wrapper">
			<h3 class="section-title"><?php _e('Artículos relacionados', 'jotaele'); ?></h3>
			<span class="section-subtitle"><?php _e('Prueba de subtítulo', 'jotaele'); ?></span>
		</div>
	</div>
	<div class="row">
		<div class="position-relative">
			<div class="owl-carousel carousel-related-single">
				<?php foreach($jotaeleRelatedPosts as $jotaeleRelatedPost):
					$post = $jotaeleRelatedPost;
					setup_postdata( $post );
				?>

					<div class="carousel-elem">
						<?php get_template_part( 'template-parts/content-archive', get_post_type() ); ?>	
					</div>

				<?php endforeach; wp_reset_postdata(); ?>
			</div>
			<div class="owl-jota-nav"></div>
		</div>
	</div>
	<div class="row">
		<div class="dots-container">
			<div class="owl-jota-dots"></div>
		</div>
	</div>
	<div class="row">
		<div class="section-cta-container">
			<a class="button-cta-jota" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e('Ver más artículos', 'jotaele'); ?></a>
		</div>
	</div>
</div>