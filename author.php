<?php get_header(); ?>

		<div class="container">

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

					<h1 class="archive_title h2">
						<span><?php _e("Posts By:", "jwdmc"); ?></span>
						<?php
							// If google profile field is filled out on author profile, link the author's page to their google+ profile page
							$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
							$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
							if ( $google_profile ) {
								echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>';
						?>
						<?php
							} else {
								echo get_the_author_meta('display_name', $curauth->ID);
							}
						?>
					</h1>

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

							<header>
								<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								<p class="meta"><?php _e("Posted", "jwdmc"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "jwdmc"); ?> <?php the_author_posts_link(); ?> &amp; <?php _e("filed under", "jwdmc"); ?> <?php the_category(', '); ?>.</p>
							</header>

							<section class="post_content">
								<?php the_post_thumbnail( 'jwdmc-featured' ); ?>

								<?php the_excerpt(); ?>
							</section>

						</article>

					<?php endwhile; ?>

					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						<?php page_navi(); // use the page navi function ?>
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "jwdmc")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "jwdmc")) ?></li>
							</ul>
						</nav>
					<?php } ?>

				</div>

				<?php get_sidebar(); // sidebar 1 ?>

			</div>

		</div>

<?php get_footer(); ?>