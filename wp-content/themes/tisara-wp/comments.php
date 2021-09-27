<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
 
$text_title_single = esc_html__( 'One Comment', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_title_single') ) {
	$text_title_single = tisara_theme_mod('tisara_comments_title_single');
}
$text_title_plural = esc_html__( '%s Comments', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_title_plural') ) {
	$text_title_plural = tisara_theme_mod('tisara_comments_title_plural');
}
$text_name = esc_html__( 'Your Name', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_name') ) {
	$text_name = tisara_theme_mod('tisara_comments_form_name');
}
$text_email = esc_html__( 'Your Email', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_email') ) {
	$text_email = tisara_theme_mod('tisara_comments_form_email');
}
$text_website = esc_html__( 'Your Website', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_website') ) {
	$text_website = tisara_theme_mod('tisara_comments_form_website');
}
$text_comment = esc_html__( 'Your Comment', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_comment') ) {
	$text_comment = tisara_theme_mod('tisara_comments_form_comment');
}
$text_required = esc_html__('Required fields are marked %s', 'tisara-wp');
if ( tisara_theme_mod('tisara_comments_form_required') ) {
	$text_required = tisara_theme_mod('tisara_comments_form_required');
}
$text_notes = esc_html__( 'Your email address will not be published.', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_notes') ) {
	$text_notes = tisara_theme_mod('tisara_comments_form_notes');
}
$text_titlereply = esc_html__( 'Leave a Reply', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_title_reply') ) {
	$text_titlereply = tisara_theme_mod('tisara_comments_form_title_reply');
}
$text_titlereplyto = esc_html__( 'Leave a Reply to %s', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_title_reply_to') ) {
	$text_titlereplyto = tisara_theme_mod('tisara_comments_form_title_reply_to');
}
$text_cancelreply = esc_html__( 'Cancel reply', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_cancel_reply_link') ) {
	$text_cancelreply = tisara_theme_mod('tisara_comments_form_cancel_reply_link');
}
$text_submit = esc_html__( 'Post Comment', 'tisara-wp' );
if ( tisara_theme_mod('tisara_comments_form_label_submit') ) {
	$text_submit = tisara_theme_mod('tisara_comments_form_label_submit');
}

if ( ! function_exists( 'tisara_comment' ) ) :
function tisara_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'tisara-wp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'tisara-wp' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-body-inner">

				<?php echo get_avatar( $comment, 64, '', '', array( 'class' => 'comment-avatar alignright' ) ); ?>
					
				<h5 class="comment-author"><?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>

				<p class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'tisara-wp' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a> 
					<?php edit_comment_link( '<span style="margin-left: 5px;" class="fa fa-edit"></span>' . esc_html__("Edit", "tisara-wp" ) . '<span class="edit-link">', '</span>' ); ?>
				</p>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation alert alert-warning"><?php esc_html_e( 'Your comment is awaiting moderation.', 'tisara-wp' ); ?></p>
				<?php endif; ?>
				
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				
				<?php if ( $reply = get_comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ) : ?>
				<footer class="reply comment-reply">
					<?php echo str_replace( 'comment-reply-link', 'comment-reply-link btn btn-secondary btn-sm', $reply ); ?>
				</footer>
				<?php endif; ?>

			</div>

		</article>

	<?php
	endif;
}
endif;

?>

<div id="comments" class="comments-area">

	<div class="comments-area-inner">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$number = get_comments_number();
			if ( $number == 1 ) {
				echo esc_html( $text_title_single );
			}
			else {
				printf( $text_title_plural, number_format_i18n( $number ) );
			}
			?>
		</h3>

		<?php if ( 1 < get_comment_pages_count() && get_option( 'page_comments' ) ) :  ?>
		<nav id="comment-nav-above" class="comment-navigation comment-navigation-above">
			<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tisara-wp' ); ?></h5>
			<ul>
				<li class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'tisara-wp' ) ); ?></li>
				<li class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'tisara-wp' ) ); ?></li>
			</ul>
		</nav>
		<?php endif; ?>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'tisara_comment' ) ); ?>
		</ol>

		<?php if ( 1 < get_comment_pages_count() && get_option( 'page_comments' ) ) : ?>
		<nav class="comment-navigation comment-navigation-below">
			<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tisara-wp' ); ?></h5>
			<ul>
				<li class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'tisara-wp' ) ); ?></li>
				<li class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'tisara-wp' ) ); ?></li>
			</ul>
		</nav>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tisara-wp' ); ?></p>
	<?php endif; ?>

	<?php 
	$commenter = wp_get_current_commenter();
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = current_theme_supports( 'html5', 'comment-form' ) ? true : false;
	$fields   =  array(
		'author' 			=> '<div class="comment-form-field comment-form-author">' . '<input class="form-control" id="author" name="author" type="text" placeholder="' . esc_attr( $text_name ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email'  			=> '<div class="comment-form-field comment-form-email">' . '<input class="form-control" id="email" name="email" type="email" placeholder="' . esc_attr( $text_email ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
		'url'    			=> '<div class="comment-form-field comment-form-url">' . '<input class="form-control" id="url" name="url" type="url" placeholder="' . esc_attr( $text_website ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
	);
	$required_text = sprintf( ' ' . $text_required, '<span class="required">*</span>' );
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$args = array(
		'fields'               => $fields,
		'comment_field'        => '<div class="comment-form-field comment-form-comment"><textarea class="" id="comment" name="comment" placeholder="' . esc_attr( $text_comment ) . '" cols="45" rows="5" aria-required="true"></textarea></div>', 
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . $text_notes . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'commentsubmit',
		'class_submit'         => 'submit',
		'title_reply'          => $text_titlereply,
		'title_reply_to'       => $text_titlereplyto,
		'cancel_reply_link'    => $text_cancelreply,
		'label_submit'         => $text_submit,
	);
	
	comment_form( $args ); 
	?>

	</div><!-- .comments-area-inner -->

</div><!-- #comments -->
