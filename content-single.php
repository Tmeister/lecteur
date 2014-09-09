<?php
/**
 * @package Lecteur
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" <?php echo lecteur_get_featured_image_style(get_the_ID()) ?>>
		<div class="holder">
			<div class="content">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$category_list = get_the_category_list( __( ', ', 'lecteur' ) );
					$tag_list = get_the_tag_list( '', __( ', ', 'lecteur' ) );
				?>
				<div class="cats-tags">
					<div class="cats"><?php echo $category_list ?> <?php _e( ' // ', 'lecteur' ) ?> <i class="fa fa-folder"></i></div>
					<?php if ($tag_list): ?>
						<div class="tags"><?php echo $tag_list ?> <?php _e( ' // ', 'lecteur' ) ?> <i class="fa fa-tags"></i></div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->
	<?php $entry_class = ( wp_is_mobile() ) ? '' : 'hidden'; ?>
	<div class="entry-content-holder <?php echo $entry_class ?>">
		<div class="entry-meta">
			<div class="wrapper date"><i class="fa fa-clock-o"></i> <?php lecteur_posted_on(); ?></div>
			<div class="wrapper comments"><i class="fa fa-comments-o"></i> <a href="#comments"><?php  comments_number( __('0 Comments', 'lecteur'), __('1 Comment', 'lecteur'), __('% Comments', 'lecteur') ); ?></a></div>
		</div><!-- .entry-meta -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links"><div class="holder">' . __( 'Pages:', 'lecteur' ),
					'after'  => '</div></div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-holder -->

	<footer class="entry-footer">
		<div class="holder">
			<div class="avatar">
				<?php echo get_avatar(get_the_author_meta( 'ID' ), '175'); ?>
			</div>
			<div class="author-vcard">
				<div class="author-label">
					<?php _e('Author', 'lecteur') ?>
				</div>
				<div class="author-name">
					<?php echo lecteur_posted_by(); ?>
					<span class="headline"><?php echo get_the_author_meta( 'lecteur_author_headline' ) ?></span>
				</div>
				<div class="author-bio">
					<?php echo get_the_author_meta('description') ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
