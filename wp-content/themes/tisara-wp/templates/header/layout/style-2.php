<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_class = array( 'site-header', 'site-header-style-2' );
if ( ! tisara_theme_mod( 'tisara_header_sticky_disable' ) ) {
	$header_class[] = 'header-sticky';
}
$header_class[] = 'header-transparent';
?>
<header id="masthead" role="banner" class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">
	<?php if ( ! tisara_theme_mod( 'tisara_header_top_hide' ) ) : ?>
	<div class="header-top">
		<div class="container">
			<div class="header-top-left pull-left">
				<?php get_template_part( 'templates/header/parts/text' ); ?>
			</div>
			<div class="header-top-right pull-right">
				<?php get_template_part( 'templates/header/parts/social' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="site-header-inner">
		<div class="header-bottom">
			<div class="container">
				<a href="javascript:void(0)" class="offcanvas-menu-trigger pull-left">
					<!-- <i class="fa fa-bars"></i> -->
					<svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
				</a>
				<?php get_template_part( 'templates/header/parts/logo' ); ?>
				<?php get_template_part( 'templates/header/parts/menu-primary' ); ?>
				<div class="header-bottom-right">
					<?php get_template_part( 'templates/header/parts/menu-addon' ); ?>
				</div>
			</div>
		</div>
		<?php get_template_part( 'templates/header/parts/hero' ); ?>
	</div>
</header>
