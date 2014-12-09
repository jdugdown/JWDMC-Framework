<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<?php
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'jwdmc-featured-home' );
							?>

							<div class="jumbotron" style="background-image: url('<?php echo $featured_src[0]; ?>'); background-repeat: no-repeat; background-position: 0 0;">

								<div class="page-header">
									<h1><?php bloginfo('title'); ?></h1>
								</div>

							</div>

						</header>

						<section class="row post_content">

							<div class="col-sm-8">

								<?php the_content(); ?>

							</div>

							<?php get_sidebar('sidebar2'); // sidebar 2 ?>

						</section> <!-- end article header -->

					</article> <!-- end article -->

					<?php endwhile; ?>

				</div> <!-- end #main -->

			</div> <!-- end #content -->

<?php get_footer(); ?>