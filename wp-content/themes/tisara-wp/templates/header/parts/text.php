<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_email = tisara_theme_mod( 'tisara_header_top_email' );
$header_phone = tisara_theme_mod( 'tisara_header_top_phone' );
$header_text = tisara_theme_mod( 'tisara_header_top_text' );
if ( empty( $header_text ) ) {
	$header_text = '';
}
if ( empty( $header_phone ) ) {
	$header_phone = '';
}
if ( empty( $header_email ) ) {
	$header_email = ''; 
}

?>
<?php if ( ! tisara_theme_mod( 'tisara_header_top_text_hide' ) ) : ?>
	<span class="header-top-text">
		<?php echo esc_html( $header_text ); ?>
	</span>
<?php endif; ?>
<?php if ( ! tisara_theme_mod( 'tisara_header_top_phone_hide' ) ) : ?>
	<span class="header-top-text">
		<!-- <i class="fa fa-phone"></i>  -->
		<?php if ( $header_phone != '' ): ?>
			<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"/></svg>
			<?php echo esc_html( $header_phone ); ?>
		<?php endif ?>
	</span>
<?php endif; ?>
<?php if ( ! tisara_theme_mod( 'tisara_header_top_email_hide' ) ) : ?>
	<span class="header-top-text">
		<!-- <i class="fa fa-envelope-o"></i>  -->
		<?php if ( $header_email != ''): ?>
			<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg>
			<?php echo esc_html( $header_email ); ?>
		<?php endif ?>
	</span>
<?php endif; ?>
