<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<main id="default">
			<div class="container">
				<?php the_title('<h1 class="page-title" itemprop="headline">', '</h1>'); ?>

				<?php the_content(); ?>
			</div>
		</main>
	<?php endwhile; ?>

<?php get_footer(); ?>
