<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

// Shortcodes
require_once('library/shortcodes.php');

// Custom Backend Footer
add_filter('admin_footer_text', 'jwdmc_custom_admin_footer');
function jwdmc_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://www.jenniferwebdesignlasvegas.com" target="_blank">Jennifer Web Design</a></span>.';
}
add_filter('admin_footer_text', 'jwdmc_custom_admin_footer');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;



/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'jwdmc-featured', 780, 350, true );
add_image_size( 'jwdmc-featured-home', 970, 311, true);
add_image_size( 'jwdmc-featured-carousel', 970, 400, true);



/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function jwdmc_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => 'Main Sidebar',
		'description' => 'Used on the default and left sidebar page templates.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => 'Homepage Sidebar',
		'description' => 'Used only on the homepage page template.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	register_sidebar(array(
		'id' => 'footer1',
		'name' => 'Footer 1',
		'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	register_sidebar(array(
		'id' => 'footer2',
		'name' => 'Footer 2',
		'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	register_sidebar(array(
		'id' => 'footer3',
		'name' => 'Footer 3',
		'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

} // don't touch this bracket!



/************* COMMENT LAYOUT *********************/

// Comment Layout
function jwdmc_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='85' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>

					<?php edit_comment_link(__('Edit','jwdmc'),'<span class="edit-comment btn btn-sm btn-default"><i class="fa fa-pencil"></i>','</span>') ?>

					<?php if ($comment->comment_approved == '0') : ?>
					<div class="alert-message success">
						<p><?php _e('Your comment is awaiting moderation.','jwdmc') ?></p>
					</div>
				<?php endif; ?>

				<?php comment_text() ?>


				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	</article>
	<!-- </li> is added by wordpress automatically -->
	<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	<li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
		<?php

	}

	/************* SEARCH FORM LAYOUT *****************/

	/****************** password protected post form *****/

	add_filter( 'the_password_form', 'custom_password_form' );

	function custom_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'jwdmc') . '</p>' . '
		<label for="' . $label . '">' . __( "Password:" ,'jwdmc') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'jwdmc' ) . '" /></div>
		</form></div>
		';
		return $o;
	}

	/*********** update standard wp tag cloud widget so it looks better ************/

	add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

	function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
	$tags = explode('</a>', $taglinks);
	$regex = "#(.*tag-link[-])(.*)(' title.*)#e";

	foreach( $tags as $tag ) {
		$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
	}

	$taglinks = implode('</a>', $tagn);

	return $taglinks;
}

add_action( 'wp_tag_cloud', 'add_tag_class' );

add_filter( 'wp_tag_cloud','wp_tag_cloud_filter', 10, 2) ;

function wp_tag_cloud_filter( $return, $args )
{
	return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Disable jump in 'read more' link
function remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_jump_link' );

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

// Add thumbnail class to thumbnail links
function add_class_attachment_link( $html ) {
	$postid = get_the_ID();
	$html = str_replace( '<a','<a class="thumbnail"',$html );
	return $html;
}
add_filter( 'wp_get_attachment_link', 'add_class_attachment_link', 10, 1 );

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

	function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		// if the item has children add these two attributes to the anchor tag
		if ( $args->has_children ) {
			$attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
		$item_output .= $args->link_after;

		// if the item has children add the caret just before closing the anchor tag
		if ( $args->has_children ) {
			$item_output .= '<b class="caret"></b></a>';
		}
		else {
			$item_output .= '</a>';
		}

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
	} // end start_el function

	function start_lvl(&$output, $depth = 0, $args = Array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

add_editor_style('editor-style.css');

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
		$classes[] = "active";
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

// enqueue styles
if( !function_exists("theme_styles") ) {
	function theme_styles() {
		// Bootstrap CSS
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.min.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'bootstrap' );

		// Flexslider CSS
		wp_register_style( 'flexslider', get_template_directory_uri() . '/library/css/flexslider.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'flexslider' );

		if (is_single()) {
			// Comments CSS
			wp_register_style( 'comments-style', get_stylesheet_directory_uri() . '/library/css/comments.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'comments-style' );
		}

		// Theme CSS
		wp_register_style( 'jwdmc-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'jwdmc-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// enqueue javascript
if( !function_exists( "theme_js" ) ) {
	function theme_js(){

		wp_register_script( 'bootstrap',
			get_template_directory_uri() . '/library/js/bootstrap.min.js',
			array('jquery'),
			'1.2' );

		wp_register_script( 'flexslider',
			get_template_directory_uri() . '/library/js/flexslider.min.js',
			array('jquery'),
			'1.2' );

		wp_register_script( 'jwdmc-scripts',
			get_template_directory_uri() . '/library/js/scripts.js',
			array('jquery'),
			'1.2' );

		wp_register_script(  'modernizr',
			get_template_directory_uri() . '/library/js/modernizr.full.min.js',
			array('jquery'),
			'1.2' );

		wp_enqueue_script('bootstrap');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('jwdmc-scripts');
		wp_enqueue_script('modernizr');

	}
}
add_action( 'wp_enqueue_scripts', 'theme_js' );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function framework_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'framework_wp_title', 10, 2 );


// Custom WordPress login screen
function my_custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo-login.png) !important; background-size:auto !important; height:100px !important; width: 100% !important; }
	</style>';
}
add_action('login_head', 'my_custom_login_logo');

function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Created by Jennifer Web Design';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_stylesheet() { ?>
<link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// Keep Yoast meta box at bottom of screen
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

?>
