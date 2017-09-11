<?php
/*
This is where most of the main functions & features reside.
If you have any custom functions, it's best to put them in the functions.php file.
Adopted from Bones by Eddie Machado - http://themble.com/bones/
*/

// Adding Translation Option
load_theme_textdomain( 'jwdmc', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);


// Cleaning up the Wordpress Head
function jwdmc_head_cleanup() {
	// remove header links
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
}
add_action('init', 'jwdmc_head_cleanup');


// Remove WP version from RSS
function jwdmc_rss_version() {
	return '';
}
add_filter('the_generator', 'jwdmc_rss_version');


// Load jQuery reply elements on single pages automatically
function jwdmc_queue_js() {
	if ( !is_admin() ) {
		if ( is_singular() && comments_open() && (get_option('thread_comments') == 1) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('wp_print_scripts', 'jwdmc_queue_js');


// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function jwdmc_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'jwdmc_excerpt_more');


// Adding WP Functions & Theme Support
function jwdmc_theme_support() {
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(125, 125, true);
	add_theme_support('automatic-feed-links');
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
		)
	);
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
		)
	);
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array(
			'main_nav' => 'The Main Menu',   // main nav in header
			'footer_links' => 'Footer Links' // secondary nav in footer
		)
	);
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme','jwdmc_theme_support');


// Add sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'jwdmc_register_sidebars' );


function jwdmc_main_nav() {
	// display the wp3 menu if available
	wp_nav_menu(
		array(
			'menu' => 'main_nav', /* menu name */
			'menu_class' => 'nav navbar-nav',
			'theme_location' => 'main_nav', /* where in the theme it's assigned */
			'container' => 'nav', /* container element */
			'fallback_cb' => 'jwdmc_main_nav_fallback', /* menu fallback */
			// 'depth' => '2',  suppress lower levels for now
			'walker' => new Bootstrap_walker()
		)
	);
}


function jwdmc_footer_links() {
	// display the wp3 menu if available
	wp_nav_menu(
		array(
			'menu' => 'footer_links', /* menu name */
			'theme_location' => 'footer_links', /* where in the theme it's assigned */
			'container' => 'nav', /* container element */
			'container_class' => 'footer-links clearfix', /* container class */
			'fallback_cb' => 'jwdmc_footer_links_fallback' /* menu fallback */
		)
	);
}


// this is the fallback for header menu
function jwdmc_main_nav_fallback() {
	// Figure out how to make this output bootstrap-friendly html
	//wp_page_menu( 'show_home=Home&menu_class=nav' );
}

// this is the fallback for footer menu
function jwdmc_footer_links_fallback() {
	/* you can put a default here if you like */
}


/****************** PLUGINS & EXTRA FEATURES **************************/

// Related Posts Function (call using jwdmc_related_posts(); )
function jwdmc_related_posts() {
	echo '<ul id="related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if ( $tags ) {
		foreach ( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts($args);
		if( $related_posts ) {
			foreach ( $related_posts as $post ) : setup_postdata($post); ?>
				<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach;
		} else { ?>
			<li class="no_related_post">No Related Posts</li>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
}

// Numeric Page Navi (built into the theme by default)
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}

	echo $before.'<ul class="pagination">'."";
	if ($paged > 1) {
		$first_page_text = "&laquo";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}

	$prevposts = get_previous_posts_link('&larr; Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">&larr; Previous</a></li>'; }

	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next &rarr;');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "&raquo;";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul>'.$after."";
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

?>
