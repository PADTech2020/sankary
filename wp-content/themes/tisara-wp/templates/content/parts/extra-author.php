<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<aside class="post-author">
	<h4 class="title"><?php esc_html_e( 'About the author', 'tisara-wp' ); ?></h4>
	<div class="author-box">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tisara_author_bio_avatar_size', 60 ) ); ?>
		<p class="author-desc author vcard">
			<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo wp_kses_data( get_the_author() ); ?>
			</a>
			<?php echo wp_kses_data( get_the_author_meta( 'description' ) ); ?>
		</p>
	</div>
</aside>
