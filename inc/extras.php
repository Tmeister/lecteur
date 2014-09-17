<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Lecteur
 */

/**
 * Adding Image Sizes
 */

add_image_size( 'grid_thumb', 1200, 700, true );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function lecteur_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'lecteur_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lecteur_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'lecteur_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function lecteur_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'lecteur' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'lecteur_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function lecteur_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'lecteur_setup_author' );


function lecteur_add_headline_profile( $user ){
	$headline = get_user_meta( $user->ID,  'lecteur_author_headline', true);
	?>
		<h3><?php IS_PROFILE_PAGE ? _e('Your headline', 'lecteur') : _e('User headline', 'lecteur'); ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label for="headline"><?php _e('Headline', 'lecteur') ?></label>
				</th>
				<td>
					<input type="text" name="lecteur_author_headline" id="lecteur-author-headline" value="<?php echo esc_attr($headline) ?>" class="regular-text" /><br/>
					<span class="description"><?php _e('This headline will be show below your name in the author box bio. ex. Storyteller', 'lecteur') ?></span>
				</td>
			</tr>
		</table>
	<?php
}

add_action('show_user_profile', 'lecteur_add_headline_profile');

function lecteur_update_headline_profile(){
	global $user_ID;
	update_user_meta( $user_ID, 'lecteur_author_headline', sanitize_text_field( $_POST['lecteur_author_headline']));
}

add_action('personal_options_update', 'lecteur_update_headline_profile');

function lecteur_excert_length(){
	return 16;
}

add_filter('excerpt_length', 'lecteur_excert_length');

function lecteur_excert_more(){
	return '...';
}

add_filter('excerpt_more', 'lecteur_excert_more');

function lecteur_post_class($classes){
	if( ! isset( $GLOBALS['lecteur_counter'] )){
		$GLOBALS['lecteur_counter'] = 0;
		$GLOBALS['lecteur_switch'] = false;
	}

	if( ++ $GLOBALS['lecteur_counter'] == 2 ){
		$GLOBALS['lecteur_counter'] = 0;
		$GLOBALS['lecteur_switch'] =  ! $GLOBALS['lecteur_switch'];
	}

	if( $GLOBALS['lecteur_switch'] ){
		$classes[] = 'single-size';
	}else{
		$classes[] = 'double-size';
	}

	return $classes;

}
add_filter('post_class', 'lecteur_post_class');


function lecteur_aesop_timeline_pusher($class){
	return 'div.post-navigation .nav-links';
}

add_filter('aesop_timeline_scroll_nav', 'lecteur_aesop_timeline_pusher');