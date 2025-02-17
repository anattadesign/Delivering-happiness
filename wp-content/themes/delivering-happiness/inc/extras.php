<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Delivering Happiness
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function delivering_happiness_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'delivering_happiness_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function delivering_happiness_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'delivering_happiness_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function delivering_happiness_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title = get_bloginfo( 'name', 'display' ) . $title;

	// Add the blog description for the home/front page.
//	$site_description = get_bloginfo( 'description', 'display' );
//	if ( $site_description && ( is_home() || is_front_page() ) ) {
//		$title .= " $sep $site_description";
//	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'delivering-happiness' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'delivering_happiness_wp_title', 10, 2 );

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
function delivering_happiness_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'delivering_happiness_setup_author' );

function delivering_happiness_sort_team_members( $query ) {
	/** @var WP_Query $query */
	if( $query->is_main_query() && !is_admin() && ( $query->is_post_type_archive( 'team_member' ) || $query->is_tax( 'team_category' ) ) ) {
		if( !$query->is_tax( 'team_category' ) ) {
			$tax_query = $query->get( 'tax_query' );
			if( empty( $tax_query ) ) {
				$tax_query = array();
			}
			$tax_query = array_merge( $tax_query,
				array(
				     'relation' => 'AND',
				     array(
					     'taxonomy' => 'team_category',
					     'field'    => 'slug',
					     'terms'    => array( 'partner', 'advisor' ),
					     'operator' => 'NOT IN'
				     )
				)
			);
			$query->set( 'tax_query', $tax_query );
		}
		$meta_query = $query->get( 'meta_query' );
		if( empty( $meta_query ) ) {
			$meta_query = array();
		}
		if( $query->get( 'meta_key' ) ) {
			$meta_query[] = array(
				'key'     => $query->get( 'meta_key' ),
				'value'   => $query->get( 'meta_value' ) ? $query->get( 'meta_value' ) : $query->get( 'meta_value_num' ),
				'compare' => $query->get( 'meta_compare' ),
				'type'    => $query->get( 'meta_value' ) ? '' : 'NUMERIC'
			);
		}
		$meta_query = array_merge( $meta_query,
			array(
			     'relation' => 'OR',
			     array(
				     'key'   => '_dh_location',
				     'value' => DH_Metabox::TEAM_LOCATION_EVERYWHERE
			     ),
			     array(
				     'key'   => '_dh_location',
				     'value' => DH_Metabox::TEAM_LOCATION_LIST
			     ),
			     array(
				     'key'     => '_dh_location',
				     'value'   => 'fake value due to bug #23268 in wordpress core',
				     'compare' => 'NOT EXISTS'
			     )
			)
		);
		$query->set( 'meta_query', $meta_query );
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'posts_per_page', -1 );
	}
}
add_action( 'pre_get_posts', 'delivering_happiness_sort_team_members' );

function dh_default_for_menu_order($data) {
	if(0 == $data['menu_order'])
		$data['menu_order'] = 100;
	return $data;
}
add_filter('wp_insert_post_data', 'dh_default_for_menu_order');

/*function for including Hello Bar code */
function hellobar_scrpt(){ ?>

	<script type="text/javascript" src="//www.hellobar.com/hellobar.js"></script>
	<script type="text/javascript">
    	new HelloBar(18996,118669);
	</script>

<?php }
add_action('wp_footer', 'hellobar_scrpt' );

/*
* Function used for getting featured thumbnails on blogs, search page, category page, etc
* this function is added because updating 'get the image' plugin stop fetching thumbnails, so created a copy of existing function
*/
if ( ! function_exists( 'get_the_image_by_scans' ) ) :
function get_the_image_by_scans( $args = array() ) {

	/* Search the post's content for the <img /> tag and get its URL. */
	preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

	/* If there is a match for the image, return its URL. */
	if ( isset( $matches ) && !empty( $matches[1][0] ) )
		return array( 'src' => $matches[1][0] );

	return false;
}
endif;