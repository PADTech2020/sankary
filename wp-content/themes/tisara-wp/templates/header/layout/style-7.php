<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_class = array( 'site-header', 'site-header-style-7' );
if ( ! tisara_theme_mod( 'tisara_header_sticky_disable' ) ) {
	$header_class[] = 'header-sticky';
}
?>
<div class="offcanvas-side offcanvas-widgets offcanvas-push-right offcanvas-menu">
	<button class="offcanvas-menu-close">
		<!-- <i class="ti-arrow-right"></i> -->
		<svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"/></svg>
	</button>
	<?php 
	$menu_args = array(
		'theme_location'	=> 'primary',
		'container'			=> 'nav',
		'container_class'	=> 'offcanvas-menu-primary',
	);
	if ( class_exists( 'Tisara_Mega_Menus_Walker' ) ) {
		$menu_args['walker'] = new Tisara_Mega_Menus_Walker();
	}
	wp_nav_menu( $menu_args );
	?>
	<?php get_template_part( 'templates/header/parts/search-form' ); ?>
</div>
<header id="masthead" role="banner" class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">
	<div class="header-bottom">
		<div class="container">
			<?php get_template_part( 'templates/header/parts/logo' ); ?>
			<div class="header-bottom-right">
				<button class="offcanvas-side-trigger">
					<!-- <i class="fa fa-bars"></i> -->
					<svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
				</button>
			</div>
		</div>
	</div>
	<?php get_template_part( 'templates/header/parts/hero' ); ?>
</header>
