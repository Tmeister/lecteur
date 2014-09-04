<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lecteur
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('x1')?>>
	<header class="entry-header">
		<div class="bg" <?php echo lecteur_get_featured_image_style(get_the_ID()) ?>></div><!-- .bg -->
		<div class="mask"></div><!-- .mask -->
		<div class="holder">
			<div class="content">
				<p class="the-excerpt"><?php echo the_excerpt(); ?></p>
				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</div><!-- .content -->

		</div><!-- .holder -->
	</header><!-- .entry-header -->
</article><!-- #post-## -->