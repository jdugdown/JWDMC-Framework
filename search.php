<?php get_header(); ?>

		<div class="container">

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

					<h1><span><?php _e("Search Results for","jwdmc"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1>

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

							<header>
								<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								<p class="meta"><?php _e("Posted", "jwdmc"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "jwdmc"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "jwdmc"); ?> <?php the_category(', '); ?>.</p>
							</header>

							<section class="post_content">
								<?php the_excerpt( '<span class="read-more">' . __("Read more on","jwdmc" ) . ' "'.the_title( '', '', false ).'" &raquo;</span>'); ?>
							</section>

						</article>

					<?php endwhile; ?>

						<?php if ( function_exists('page_navi') ) { ?>
							<?php page_navi(); ?>
						<?php } else { ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "jwdmc")) ?></li>
									<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "jwdmc")) ?></li>
								</ul>
							</nav>
						<?php } ?>

					<?php else : ?>

						<article id="post-not-found">
							<header>
								<h1><?php _e("Not Found", "jwdmc"); ?></h1>
							</header>
							<section class="post_content">
								<p><?php _e("Sorry, but the requested resource was not found on this site.", "jwdmc"); ?></p>
							</section>
						</article>

					<?php endif; ?>

				</div>

				<?php get_sidebar(); // sidebar 1 ?>

			</div>

		</div>

<?php get_footer(); ?>