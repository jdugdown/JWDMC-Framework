<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 col-md-offset-2 clearfix" role="main">

					<h1><?php _e("Error 404 - Not Found","jwdmc"); ?></h1>

					<p><?php _e("The page or resource you were looking for could not be found.","jwdmc"); ?></p>
					<p><?php _e("Search using the form below or go back to the <a href=" . get_bloginfo('url') . ">homepage</a>.","jwdmc"); ?></p>

					<?php get_search_form(); ?>

				</div> <!-- end #main -->

			</div> <!-- end #content -->

<?php get_footer(); ?>