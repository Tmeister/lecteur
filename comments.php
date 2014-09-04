<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Lecteur
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
* Comments Form Args
**/
$args = array(
  'title_reply'       => __( 'Share your thoughts' ),
  'title_reply_to'    => __( 'Share your thoughts in %s' ),
  'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Your thoughts', 'lecteur' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
);


?>

<div id="comments" class="comments-area">
	<div class="holder">

		<div class="comments-title-holder">
			<div class="join"><?php _e('Join the conversation', 'lecteur') ?></div>
			<div class="comments-title">
				<?php
					printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'lecteur' ),
						number_format_i18n( get_comments_number() ));
				?>
			</div>
		</div>
		<?php if ( have_comments() ) : ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'lecteur' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lecteur' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lecteur' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
			<?php endif; // check for comment navigation ?>

			<div class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'div',
						'short_ping' => true,
						'walker' => new Lecteur_Comment_Walker()
					) );
				?>
			</div><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'lecteur' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lecteur' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lecteur' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'lecteur' ); ?></p>
		<?php endif; ?>
	</div><!-- holder comments -->

	<?php comment_form($args); ?>

</div><!-- #comments -->
