<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package jotaele
 */

get_header();
?>

	<main id="primary" class="site-main blog-single-wrapper container-fluid">

        <div class="row">
            
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry'); ?>>
					<div class="wrapper-thumbnail position-relative">
						<div class="background-thumbnail-desktop">	
						</div>
						<div class="container wrapper-thumbnail-img">
							<?php if(has_post_thumbnail()): ?>
								<?php the_post_thumbnail('full'); ?>
							<?php else: ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/JL_placeholder.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image placeholder-img" alt="<?php echo get_the_title(); ?>" >
							<?php endif; ?>
						</div>
					</div>
					
					<?php get_template_part( 'template-parts/content', 'voter' ); ?>
					
					<div class="container" id="article-content">
                		<div class="row justify-content-center">
                    		<div class="col-lg-9 col-12">
								<div class="categories-wrapper">
									<?php
										$categories = wp_get_post_categories( $post->ID, array( 'orderby' => 'term_id', 'order'=> 'ASC' ));

										foreach( $categories as $c ) {
											$category = get_category($c);
											$category_link = sprintf( 
												'<a class="category-tag" style="background-color:'. get_term_meta($category->term_id, 'category-color')[0] .'; color: ' . get_term_meta($category->term_id, 'category-color-text')[0] .'" href="%1$s" alt="%2$s">%3$s</a>',
												esc_url( get_category_link( $category->term_id ) ),
												esc_attr( sprintf( __( 'Ver todos los artículos de %s', 'jotaele' ), $category->name ) ),
												esc_html( $category->name )
											);
											echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );
										} 
									?>
								</div>
								<header class="entry-header">
									<?php if ( 'post' === get_post_type() ) : ?>
										<div class="title-wrapper">
											<?php the_title( '<h1 class="entry-title p-name">', '</h1>' ); ?>
											<?php if(get_post_meta($post->ID, "entradilla")[0]): ?>
												<h2 class="entradilla p-summary"><?php echo get_post_meta($post->ID, "entradilla")[0]; ?></h2>
											<?php endif; ?>
										</div>
										<div class="entry-meta">
											<div class="wrapper-meta-box wrapper-date">
												<i class="icon-calendario"></i>
												<?php jotaele_posted_on(); ?>
											</div>
											
											<div class="wrapper-meta-box wrapper-author 
											<?php if(get_the_author_meta('nicename', get_post_field ('post_author', $post->ID)) === 'jotaele') {echo 'd-none';} ?>"
											>
												<i class="icon-autor"></i>
												<?php jotaele_posted_by(); ?>
											</div>
											
											<?php if(get_the_author_meta('nicename', get_post_field ('post_author', $post->ID)) === 'jotaele'): ?> 
												<div class="wrapper-meta-box wrapper-readtime">
													<i class="icon-lectura"></i>
													<?php _e( 'Lectura: ', 'jotaele' ); echo jotaele_read_time();  _e( ' min', 'jotaele' ); ?>
												</div>
											<?php endif; ?>
											
											<div class="wrapper-meta-box wrapper-likes">
												<i class="icon-likes"></i>
												<div class="position-relative vote-counter-wrapper d-inline-block">
												<span class="vote_counter position-relative"><?php echo get_post_meta($post->ID, "votes", true) ?  get_post_meta($post->ID, "votes", true) : "0"; ?></span>
												</div>
											</div>
										</div><!-- .entry-meta -->
									<?php endif; ?>
								</header><!-- .entry-header -->

							<div class="entry-content">
								<?php
								the_content(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Continuar leyendo<span class="screen-reader-text"> "%s"</span>', 'jotaele' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									)
								);
								?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<?php get_template_part( 'template-parts/content', 'author-info' ); ?>
								<?php /* jotaele_entry_footer(); */ ?>
							</footer><!-- .entry-footer -->
						</article><!-- #post-<?php the_ID(); ?> -->	
                    </div>
                </div>
			</article>
		</div>
	</main><!-- #main -->

	<aside id="secondary" class="widget-area">
		<section class="related-posts-block single-related background-grey-jotaele container-fluid section-alternate-color">
			<?php get_template_part( 'template-parts/yarpp-template', 'jotaele' ); ?>
		</section>
		
		<h2>AQUÍ VA AHORA UN BOX PARA NEWSLETTER Y LOS COMENTARIOS</h2>
		
									
		<?php
		if ( comments_open() || get_comments_number() ) :
		comments_template();
		endif;
		?>
		<?php endwhile; ?>
	</aside>

<?php
get_footer();