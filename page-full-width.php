<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-12 clearfix" role="main">

					<?php while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<h1><?php the_title(); ?></h1>

						</header> <!-- end article header -->

						<section class="post_content">

							<?php the_content(); ?>

						</section> <!-- end article section -->

					</article> <!-- end article -->

					<?php endwhile; ?>

				</div> <!-- end #main -->

			</div> <!-- end #content -->

<?php get_footer(); ?>