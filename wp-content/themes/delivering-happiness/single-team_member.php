<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Delivering Happiness
 */

get_header(); ?>

<div class="one-column-template">
	<div class="wrapper">
		<div class="page-header">
			<h1><?php the_title() ?></h1>
		</div>
	</div>
	<div id="primary" class="content-area">
		<div class="wrapper">
			<main id="main" class="site-main" role="main">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_field( 'designation' ); ?>

						<?php the_content(); ?>

						<img src="<?php $image = get_field( 'image' ); echo $image['url']; ?>" alt="<?php the_title(); ?>" />

						<?php the_field( 'facebook' ); ?>

						<?php the_field( 'twitter' ); ?>

					<?php endwhile; ?>

					<?php delivering_happiness_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</main><!-- #main -->
		</div>
	</div><!-- #primary -->
</div>

<?php get_footer();