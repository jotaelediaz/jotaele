<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jotaele
 */

?>

<div class="categories-wrapper">
	<?php
	$categories = wp_get_post_categories( $post->ID, array( 'orderby' => 'term_id', 'order'=> 'ASC' ));
	$i = 0;
	
	foreach( $categories as $c ) {
		
		if (in_array("archive-post", $args) && $i >= 2): 
			echo '';
			break; 
		endif;
		
		$category = get_category($c);
		$category_link = sprintf( 
			'<a class="category-tag" style="background-color:'. get_term_meta($category->term_id, 'category-color')[0] .'; color: ' . get_term_meta($category->term_id, 'category-color-text')[0] .'" href="%1$s" alt="%2$s">%3$s</a>',
			esc_url( get_category_link( $category->term_id ) ),
			esc_attr( sprintf( __( 'Ver todos los artículos de %s', 'jotaele' ), $category->name ) ),
			esc_html( $category->name )
		);
		echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );
		$i++;
	} 
	?>
</div>