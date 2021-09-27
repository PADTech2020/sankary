<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_class = array( 'site-header', 'site-header-style-6' );
if ( ! tisara_theme_mod( 'tisara_header_sticky_disable' ) ) {
	$header_class[] = 'header-sticky';
}
?>
<header id="masthead" role="banner" class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>" >
	<div class="header-bottom">
		<div class="container">
			<a href="javascript:void(0)" class="offcanvas-menu-trigger pull-left">
				<!-- <i class="fa fa-bars"></i> -->
				<svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
			</a>
			<?php get_template_part( 'templates/header/parts/logo' ); ?>
		</div>
		<div class="container">
			<div class="header-bottom-section">
				<?php get_template_part( 'templates/header/parts/menu-primary' ); ?>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/header/parts/hero' ); ?>
</header>
