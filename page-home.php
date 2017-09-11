<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<main id="home">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h1 itemprop="headline"><?php bloginfo('title'); ?></h1>

						<?php the_content(); ?>
					</div>

					<?php get_sidebar('sidebar2'); // sidebar 2 ?>
				</div>
			</div>
		</main>
	<?php endwhile; ?>

<?php get_footer(); ?>
