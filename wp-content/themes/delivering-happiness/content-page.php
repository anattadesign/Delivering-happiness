<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Delivering Happiness
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'delivering-happiness' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php // edit_post_link( __( 'Edit', 'delivering-happiness' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
