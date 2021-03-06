<?php
/*
Template Name: Interior Page
*/
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<main id="interior">
			<?php if( have_rows('page_content') ): ?>
				<?php while ( have_rows('page_content') ) : the_row(); ?>

					<?php if ( get_row_layout() == 'single_column_content' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-12">
										<?php the_sub_field('content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'two_column_content' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-6">
										<?php the_sub_field('left_content'); ?>
									</div>
									<div class="col-sm-6">
										<?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'three_column_content' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-4">
										<?php the_sub_field('left_content'); ?>
									</div>
									<div class="col-sm-4">
										<?php the_sub_field('middle_content'); ?>
									</div>
									<div class="col-sm-4">
										<?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'four_column_content' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-6 col-md-3">
										<?php the_sub_field('left_content'); ?>
									</div>
									<div class="col-sm-6 col-md-3">
										<?php the_sub_field('middle_left_content'); ?>
									</div>
									<div class="clearfix visible-sm"></div>
									<div class="col-sm-6 col-md-3">
										<?php the_sub_field('middle_right_content'); ?>
									</div>
									<div class="col-sm-6 col-md-3">
										<?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'onethird_twothirds' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-4">
										<?php the_sub_field('left_content'); ?>
									</div>
									<div class="col-sm-8">
										<?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'twothirds_onethird' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-8">
										<?php the_sub_field('left_content'); ?>
									</div>
									<div class="col-sm-4">
										<?php the_sub_field('right_content'); ?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'gallery' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-12">
										<?php if ( $gallery_title = get_sub_field('gallery_title') ): ?>
											<h2 class="text-center"><?php echo $gallery_title; ?></h2>
										<?php endif; ?>
										<?php
										$image_ids = get_sub_field('gallery', false, false);
										$columns = get_sub_field('columns');
										$shortcode = '[gallery ids="' . implode(',', $image_ids) . '" columns="' . $columns . '" size="jwdmc-gallery-thumbnail" link="file"]';
										echo do_shortcode( $shortcode );
										?>
									</div>
								</div>
							</div>
						</section>

					<?php elseif ( get_row_layout() == 'call_to_action' ): ?>

						<section class="flex-row">
							<div class="container">
								<div class="row flexible-content-row">
									<div class="col-sm-12 text-center">
										<?php if ( $cta_pre_text = get_sub_field('text') ): ?>
											<h2><?php echo $cta_pre_text; ?></h2>
										<?php endif; ?>

										<?php while ( have_rows('buttons') ) : the_row(); ?>
											<a class="btn btn-primary" href="<?php the_sub_field('button_link'); ?>" <?php if ( get_sub_field('new_tab') ) : echo 'target="_blank"'; endif; ?>><?php the_sub_field('button_text'); ?></a>
										<?php endwhile; ?>
									</div>
								</div>
							</div>
						</section>

					<?php endif; ?>

				<?php endwhile; ?>
			<?php endif; ?>
		</main>
	<?php endwhile; ?>

<?php get_footer(); ?>
