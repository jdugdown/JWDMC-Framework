<?php
/*
The comments page for Bones
*/

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","jwdmc"); ?></div>
	<?php return;
} ?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php comments_number('<span>' . __("No","jwdmc") . '</span> ' . __("Responses","jwdmc") . '', '<span>' . __("One","jwdmc") . '</span> ' . __("Response","jwdmc") . '', '<span>%</span> ' . __("Responses","jwdmc") );?> <?php _e("to","jwdmc"); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<?php if ( get_comment_pages_count() > 1 ): ?>
		<nav id="comment-nav">
			<ul class="clearfix">
				<li class="pull-left"><?php previous_comments_link(); ?></li>
				<li class="pull-right"><?php next_comments_link(); ?></li>
			</ul>
		</nav>
	<?php endif ?>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=jwdmc_comments'); ?>
	</ol>

<?php endif; ?>

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	<h3 id="pings">Trackbacks/Pingbacks</h3>

	<ol class="pinglist">
		<?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
<?php endif; ?>

	<?php if ( get_comment_pages_count() > 1 ): ?>
		<nav id="comment-nav">
			<ul class="clearfix">
				<li class="pull-left"><?php previous_comments_link(); ?></li>
				<li class="pull-right"><?php next_comments_link(); ?></li>
			</ul>
		</nav>
	<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed
	?>

	<!-- If comments are closed. -->
	<p class="alert alert-info"><?php _e("Comments are closed","jwdmc"); ?>.</p>

<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) :

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(

		'author' =>
		'<div class="form-group comment-form-author"><label for="author">' . __( 'Name', 'jwdmc' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',

		'email' =>
		'<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'jwdmc' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		);

	$args = array(
		'title_reply' => 'Leave a Reply',
		'label_submit' => 'Submit',
		'class_submit' => 'btn btn-primary',
		'comment_field' =>  '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'jwdmc' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="6" aria-required="true">' . '</textarea></div>',
		// 'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		);

	comment_form($args);

endif; // if you delete this the sky will fall on your head ?>
