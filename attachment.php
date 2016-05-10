<?php get_header(); ?>

		<div class="container">

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<header>
								<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>

								<p class="meta"><?php _e("Posted", "jwdmc"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "jwdmc"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "jwdmc"); ?> <?php the_category(', '); ?>.</p>
							</header>

							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
							</section>

							<footer>
								<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","jwdmc") . ':</span> ', ' ', '</p>'); ?>
							</footer>

						</article>

					<?php endwhile; ?>

				</div>

				<?php get_sidebar(); // sidebar 1 ?>

			</div>

		</div>

<?php get_footer(); ?>