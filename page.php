<?php get_header(); ?>

		<div class="container">

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_title('<h1 class="page-title" itemprop="headline">', '</h1>'); ?>

						<?php the_content(); ?>

					<?php endwhile; ?>

				</div> <!-- end #main -->

				<?php get_sidebar(); // sidebar 1 ?>

			</div>

		</div>

<?php get_footer(); ?>