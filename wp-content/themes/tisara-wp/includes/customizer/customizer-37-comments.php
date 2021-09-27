<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_comments' );
function tisara_customize_controls_comments( $controls ) {

	$controls['tisara_section_comments'] = array(
		'title'    => esc_html__( 'Comments', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-with-icon">
						<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.control( \'tisara_heading_post_comments\' ).focus();">'.esc_html__( 'CLICK HERE to show/hide comments on single post.', 'tisara-wp' ).'</a><br><br><a href="javascript:wp.customize.control( \'tisara_heading_page_comments\' ).focus();">'.esc_html__( 'CLICK HERE to show/hide comments on single page.', 'tisara-wp' ).'</a>
						</p>',
		'setting'  => 'tisara_section_comments',
		'panel'    => 'tisara_panel_settings',
		'type'     => 'section',
		'priority' => 37,
	);

	$controls['tisara_heading_comments_textarea'] = array(
		'label'    => esc_html__( 'Comment Form - Textarea Field', 'tisara-wp' ),
		'setting'  => 'tisara_heading_comments_textarea',
		'section'  => 'tisara_section_comments',
		'type'     => 'heading',
	);

	$controls['tisara_comments_textarea_reverse'] = array(
		'label'    => esc_html__( 'Reverse Comment Textarea To The Bottom (Below Name, Email, URL)', 'tisara-wp' ),
		'setting'  => 'tisara_comments_textarea_reverse',
		'section'  => 'tisara_section_comments',
		'type'     => 'checkbox',
	);

	$controls['tisara_heading_comments_url'] = array(
		'label'    => esc_html__( 'Comment Form - Web URL Field', 'tisara-wp' ),
		'setting'  => 'tisara_heading_comments_url',
		'section'  => 'tisara_section_comments',
		'type'     => 'heading',
	);

	$controls['tisara_comments_url_hide'] = array(
		'label'    => esc_html__( 'Hide Comment URL (Website) Field', 'tisara-wp' ),
		'setting'  => 'tisara_comments_url_hide',
		'section'  => 'tisara_section_comments',
		'type'     => 'checkbox',
	);

	$controls['tisara_heading_comments_title'] = array(
		'label'    => esc_html__( 'Comment Title Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_comments_title',
		'section'  => 'tisara_section_comments',
		'type'     => 'heading',
	);

	$controls['tisara_comments_title_single'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'One Comment', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_title_single',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_title_plural'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( '%s Comments', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_title_plural',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_heading_comments_reply'] = array(
		'label'    => esc_html__( 'Comment Reply Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_comments_reply',
		'section'  => 'tisara_section_comments',
		'type'     => 'heading',
	);

	$controls['tisara_comments_reply_text'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Reply', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_reply_text',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_login_text'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Log in to Reply', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_login_text',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_heading_comments_form'] = array(
		'label'    => esc_html__( 'Comment Form Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_comments_form',
		'section'  => 'tisara_section_comments',
		'type'     => 'heading',
	);

	$controls['tisara_comments_form_name'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Your Name', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_name',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_email'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Your Email', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_email',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_website'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Your Website', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_website',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_comment'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Your Comment', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_comment',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_notes'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Your email address will not be published.', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_notes',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_required'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Required fields are marked %s', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_required',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_title_reply'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Leave a Reply', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_title_reply',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_title_reply_to'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Leave a Reply to %s', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_title_reply_to',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_cancel_reply_link'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Cancel reply', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_cancel_reply_link',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	$controls['tisara_comments_form_label_submit'] = array(
		'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Post Comment', 'tisara-wp' ) ),
		'setting'  => 'tisara_comments_form_label_submit',
		'section'  => 'tisara_section_comments',
		'type'     => 'text',
	);

	return $controls;
}
