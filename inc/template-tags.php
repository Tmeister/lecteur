<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Lecteur
 */

if ( ! function_exists( 'lecteur_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function lecteur_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'lecteur' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><i class="fa fa-angle-left"></i> <?php next_posts_link( __( 'Older posts', 'lecteur' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'lecteur' ) ); ?> <i class="fa fa-angle-right"></i></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
		<div class="clear-fix"></div>
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lecteur_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function lecteur_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation hidden" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'lecteur' ); ?></h1>
		<div class="nav-links">
			<?php
			previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav"><i class="fa fa-angle-left"></i></span><span class="title"><span class="wrap"><span class="headline">Previous post</span>%title</span></span>', 'Previous post link', 'lecteur' ) );
			next_post_link(     '<div class="nav-next">%link</div>',     _x( '<span class="title"><span class="wrap"><span class="headline">Next post</span>%title</span></span><span class="meta-nav"><i class="fa fa-angle-right"></i></span>', 'Next post link',     'lecteur' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lecteur_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lecteur_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'lecteur' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'lecteur_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lecteur_posted_by() {

	$byline = sprintf(
		_x( '%s', 'post author', 'lecteur' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function lecteur_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'lecteur_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'lecteur_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so lecteur_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so lecteur_categorized_blog should return false.
		return false;
	}
}


if (! function_exists('lecteur_get_featured_image')):

/**
 * Helper function to get the featured image source
 */

function lecteur_get_featured_image($postid = false, $size = 'full'){
	if( ! $postid ){
		return false;
	}
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($postid), $size, false);
	return ($src) ? $src[0] : false;
}

endif;


if (! function_exists('lecteur_get_featured_image_style')):
/**
 * Helper function to get the featured image style
 */

function lecteur_get_featured_image_style($id, $size = 'full'){
	$bg = lecteur_get_featured_image($id, $size);
	return ($bg) ? sprintf('style="background-image: url(%s)"', $bg) : '';
}

endif;

/**
 * Flush out the transients used in lecteur_categorized_blog.
 */
function lecteur_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'lecteur_categories' );
}
add_action( 'edit_category', 'lecteur_category_transient_flusher' );
add_action( 'save_post',     'lecteur_category_transient_flusher' );


function lecteur_open_comment_form_wrap(){
?>
	<div id="lecteur-comments-wrapper">
<?php
}
add_action('comment_form_before', 'lecteur_open_comment_form_wrap' );

function lecteur_close_comment_form_wrap(){
?>
	</div> <!-- lecteur-comments-wrapper -->
<?php
}
add_action('comment_form_after', 'lecteur_close_comment_form_wrap' );

/**
* Custom Walker for Comments
*/

class Lecteur_Comment_Walker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
		var $counter = 1;

		// constructor – wrapper for the comments list
		function __construct() { ?>

			<section class="comments-list">

		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			<section class="child-comments comments-list">

		<?php }

		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			</section>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			}

			$no_url = !$comment->comment_author_url || $comment->comment_author_url == 'http://';

			?>

			<article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
				<header>
					<figure class="gravatar"><?php echo get_avatar( $comment, 80); ?></figure>
					<div class="comment-meta post-meta" role="complementary">
						<h3 class="comment-author">
							<?php if ( get_comment_author_url() ) : ?>
								<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
							<?php else: ?>
								<?php comment_author(); ?>
							<?php endif ?>

						</h3>
						<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('F jS, Y') ?><i class="fa fa-dot-circle-o"></i><a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
						<?php edit_comment_link('<i class="fa fa-dot-circle-o"></i><span class="comment-meta-item">Edit this comment</span>','',''); ?>
						<?php if ($comment->comment_approved == '0') : ?>
						<p class="comment-meta-item"><i class="fa fa-exclamation-triangle"></i> <?php _e('Your comment is awaiting moderation.', 'lecteur'); ?> </p>
						<?php endif; ?>
						<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					<div class="clear"></div>
				</header>
				<div class="comment-content post-content" itemprop="text">
					<?php comment_text() ?>
				</div>

		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</article>

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>

			</section>

		<?php }

	}