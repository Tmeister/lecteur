<?php
/*
 * Template Name: Home FullScreen
 * Description: Home layout to show all the posts in fullscreen

 * @package Lecteur
 */

get_header();

/**
 * Get the last post
**/

$latest_post = new WP_Query('posts_per_page=1');

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>

				<?php get_template_part( 'content', 'page-fullscreen' ); ?>

			<?php endwhile; // end of the loop. ?>
			<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
