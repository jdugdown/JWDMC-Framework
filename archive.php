<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-sm-8 clearfix" role="main">

					<?php if (is_category()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts Categorized:", "jwdmc"); ?></span> <?php single_cat_title(); ?>
						</h1>
					<?php } elseif (is_tag()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts Tagged:", "jwdmc"); ?></span> <?php single_tag_title(); ?>
						</h1>
					<?php } elseif (is_author()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts By:", "jwdmc"); ?></span> <?php get_the_author_meta('display_name'); ?>
						</h1>
					<?php } elseif (is_day()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Daily Archives:", "jwdmc"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h1>
					<?php } elseif (is_month()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Monthly Archives:", "jwdmc"); ?></span> <?php the_time('F Y'); ?>
						</h1>
					<?php } elseif (is_year()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Yearly Archives:", "jwdmc"); ?></span> <?php the_time('Y'); ?>
						</h1>
					<?php } ?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

							<p class="meta"><?php _e("Posted", "jwdmc"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "jwdmc"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "jwdmc"); ?> <?php the_category(', '); ?>.</p>

						</header> <!-- end article header -->

						<section class="post_content">

							<?php the_post_thumbnail( 'jwdmc-featured' ); ?>

							<?php the_excerpt(); ?>

						</section> <!-- end article section -->

						<footer>

						</footer> <!-- end article footer -->

					</article> <!-- end article -->

					<?php endwhile; ?>

					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>

						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="pager">
								<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "jwdmc")) ?></li>
								<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "jwdmc")) ?></li>
							</ul>
						</nav>
					<?php } ?>


					<?php else : ?>

					<article id="post-not-found">
						<header>
							<h1><?php _e("No Posts Yet", "jwdmc"); ?></h1>
						</header>
						<section class="post_content">
							<p><?php _e("Sorry, What you were looking for is not here.", "jwdmc"); ?></p>
						</section>
						<footer>
						</footer>
					</article>

					<?php endif; ?>

				</div> <!-- end #main -->

				<?php get_sidebar(); // sidebar 1 ?>

			</div> <!-- end #content -->

<?php get_footer(); ?>