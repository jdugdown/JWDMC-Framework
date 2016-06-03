<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

		<div class="container">

			<div id="content" class="clearfix row">

				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="page-header">
							<h1 itemprop="headline"><?php bloginfo('title'); ?></h1>
						</div>

						<div class="row">
							<div class="col-md-8">
								<?php the_content(); ?>
							</div>

							<?php get_sidebar('sidebar2'); // sidebar 2 ?>
						</div>

					<?php endwhile; ?>

				</div> <!-- end #main -->

			</div> <!-- end #content -->

		</div>

<?php get_footer(); ?>
