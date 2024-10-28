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
		'limit' => 4,
		'threshold' => 4,
		'weight' => array(
			'title' => 1,
			'body' => 1,
			'tax' => array(
				'category' => 1,
				'tag' => 2,
			)
		),
		'post_type' => 'post',
	)
);

global $post;
?>
<div class="container">
	
	<div class="row">
		<h3><?php _e('Artículos relacionados', 'jotaele'); ?></h3>
	</div>
	<div class="row owl-carousel">
		<?php foreach($jotaeleRelatedPosts as $jotaeleRelatedPost):
			$post = $jotaeleRelatedPost;
			setup_postdata( $post );
		?>
		
			<div class="col-md-4 col-12">
				<?php get_template_part( 'template-parts/content-archive', get_post_type() ); ?>	
			</div>
		
		<?php endforeach; wp_reset_postdata(); ?>
	</div>
	<div class="row">
		BOTON DE MÁS POSTS (A LA HOME?)
	</div>
</div>