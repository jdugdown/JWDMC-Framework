<?php
/*
Template Name: Left Sidebar Page
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<?php get_sidebar(); // sidebar 1 ?>

				<div id="main" class="col col-lg-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<h1><?php the_title(); ?></h1>

						</header> <!-- end article header -->

						<section class="post_content">

							<?php the_content(); ?>

						</section> <!-- end article section -->

					</article> <!-- end article -->

					<?php endwhile; ?>

					<?php else : ?>

					<article id="post-not-found">
						<header>
							<h1><?php _e("Not Found", "jwdmc"); ?></h1>
						</header>
						<section class="post_content">
							<p><?php _e("Sorry, but the requested resource was not found on this site.", "jwdmc"); ?></p>
						</section>
						<footer>
						</footer>
					</article>

					<?php endif; ?>

				</div> <!-- end #main -->

			</div> <!-- end #content -->

<?php get_footer(); ?>