<?php
/**
 * The template for displaying all single posts.
 *
 * @package Lecteur
 */

get_header();
$entry_class = ( wp_is_mobile() ) ? '' : 'hidden';
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="loader">
				<div class="corner">
					<div class="loading up"></div>
					<div class="loading down"></div>
				</div>
			</div>

			<div class="entry <?php echo $entry_class; ?>">
			<?php lecteur_post_nav(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>
		</div><!-- #entry -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_footer(); ?>