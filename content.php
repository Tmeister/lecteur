<?php
/**
 * @package Lecteur
 */

	$scroll = 500;
	$layout3 = [2, 1, 1, 1, 1, 2, 1, 1, 2];
	$layout4 = [3, 1, 2, 1, 1, 1, 1, 2, 4];
	$layout5 = [4, 1, 2, 1, 2, 1, 1, 3, 5];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('x1')?>>
	<header class="entry-header">
		<div class="bg" <?php echo lecteur_get_featured_image_style(get_the_ID()) ?>></div><!-- .bg -->
		<div class="mask"></div><!-- .mask -->
		<div class="holder">
			<div class="content">
				<div class="category">
					<?php the_category(' '); ?>
				</div><!-- .category -->
				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</div><!-- .content -->

		</div><!-- .holder -->
	</header><!-- .entry-header -->
</article><!-- #post-## -->