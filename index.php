<?php get_header(); ?>

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

					<?php while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'jwdmc-featured' ); ?></a>

							<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

							<p class="meta"><?php _e("Posted", "jwdmc"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "jwdmc"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "jwdmc"); ?> <?php the_category(', '); ?>.</p>

						</header> <!-- end article header -->

						<section class="post_content clearfix">

							<?php the_excerpt(); ?>

						</section> <!-- end article section -->

						<footer>

							<p class="tags"><?php the_tags('<span class="tags-title">' . __("Tags","jwdmc") . ':</span> ', ' ', ''); ?></p>

						</footer> <!-- end article footer -->

					</article> <!-- end article -->

					<?php endwhile; ?>

					<?php if (function_exists('page_navi')) { // if feature is active (it should be) ?>
						<?php page_navi(); // use the page navi function ?>
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="pager">
								<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "jwdmc")) ?></li>
								<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "jwdmc")) ?></li>
							</ul>
						</nav>
					<?php } ?>

				</div> <!-- end #main -->

				<?php get_sidebar(); // sidebar 1 ?>

			</div> <!-- end #content -->

<?php get_footer(); ?>