<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 col-md-offset-2 clearfix" role="main">

					<article id="post-not-found" class="clearfix">

						<header>

							<div class="hero-unit">

								<h1><?php _e("Error 404 - Not Found","jwdmc"); ?></h1>

							</div>

						</header> <!-- end article header -->

						<section class="post_content">

							<p><?php _e("The page or resource you were looking for could not be found.","jwdmc"); ?></p>
							<p><?php _e("Search using the form below or go back to the <a href=" . get_bloginfo('url') . ">homepage</a>.","jwdmc"); ?></p>

							<div class="row">
								<div class="col col-lg-12">
									<?php get_search_form(); ?>
								</div>
							</div>

						</section> <!-- end article section -->

					</article> <!-- end article -->

				</div> <!-- end #main -->

			</div> <!-- end #content -->

<?php get_footer(); ?>