<?php
/**
 * The template used for displaying page content in home-fullscreen.php
 *
 * @package Lecteur
 * @since 1.0.0
 */

	$bg = lecteur_get_featured_image(get_the_ID());
	$header_bg = ($bg) ? sprintf('style="background-image: url(%s)"', $bg) : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" <?php echo $header_bg ?>>
		<div class="holder">
			<div class="content">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
				<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
				<?php the_title( '<h5 class="entry-title">', '</h5>' ); ?>
				<?php the_title( '<h6 class="entry-title">', '</h6>' ); ?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lecteur' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'lecteur' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
