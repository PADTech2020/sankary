<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'pt-ocdi/import_files', 'tisara_fe_import_files' );
add_filter( 'tisara_importer_configs', 'tisara_fe_import_files' );
function tisara_fe_import_files( $configs ) {

	$configs[] = array(
		'import_file_name'              => 'Tisara Demo',
		'import_file_url'               => 'http://import.tokomoo.com/tokoo-demo-content/tisara/01_dummy_contents.xml',
		'import_widget_file_url'        => 'http://import.tokomoo.com/tokoo-demo-content/tisara/02_dummy_widgets.json',
		'import_customizer_file_url'    => 'http://import.tokomoo.com/tokoo-demo-content/tisara/03_dummy_customizer.txt',
		'import_preview_image_url'      => 'https://selaraswp.com/import/tisarawp/screenshot.jpg',
		'import_notice'                 => '',
		'preview_url'                   => 'https://demo.tokomoo.com/tisara/',
		'import_home_page'              => 'Homepage',
		'import_blog_page'              => '',
		'import_available_menus'        => array(
			'primary'   => 'Main Menu', 
		) 
	);

	return $configs;
}

add_action( 'pt-ocdi/after_import', 'tisara_after_import_handling' );
function tisara_after_import_handling( $selected_import ) {
	// Set Home
	if ( isset( $selected_import['import_home_page'] ) ) {
		$page = get_page_by_title( $selected_import['import_home_page'] );
		
		if ( isset( $page->ID ) ) {
			update_option( 'page_on_front', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}
	
	// Set Blog
	if ( isset( $selected_import['import_blog_page'] ) ) {
		$page = get_page_by_title( $selected_import['import_blog_page'] );
		
		if ( isset( $page->ID ) ) {
			update_option( 'page_for_posts', $page->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	// Store All Menu
	$menu_locations = array();
	if ( ! empty( $selected_import['import_available_menus'] ) ) {
		foreach ( $selected_import['import_available_menus'] as $key => $value ) {
			$menu = get_term_by( 'name', $value, 'nav_menu' );
			if ( isset( $menu->term_id ) ) {
				$menu_locations[$key] = $menu->term_id;
			}
		}
		// Set Menu If has
		if ( isset( $menu_locations ) ) {
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}
	}
}

add_action( 'admin_head', 'tisara_import_admin_head' );
function tisara_import_admin_head() {
?>
<style type="text/css">
.ocdi__gl-item-image-container::after {
	padding-top: 100%;
}
.tisara-demo-importer-intro{
	background-color: #328ee0;
	padding: 30px 30px 30px;
	border-radius: 3px;
	color: rgba(255,255,255,.9);
	margin-top: 20px;
	margin-bottom: 50px;
	font-weight: 300;
	background-repeat: no-repeat;
	background-position: bottom left;
}
.tisara-demo-importer-intro h2{
	font-size: 48px;
	color: white;
	font-weight: 300;
	line-height: 1.7;
	margin: 30px 0;
}
.tisara-demo-importer-intro .row{
	margin: 0 -15px;
	overflow: hidden;
}
.tisara-demo-importer-intro .col-1,
.tisara-demo-importer-intro .col-2{
	float: left;
	padding: 0 15px;
	box-sizing: border-box;
}
.tisara-demo-importer-intro .col-1{
	width: 40%;
}
.tisara-demo-importer-intro .col-2{
	width: 60%;
}
@media screen and (max-width: 990px){
	.tisara-demo-importer-intro .col-1,
	.tisara-demo-importer-intro .col-2{
		width: 100%;
	}
}

.tisara-demo-importer-intro .importer-intro p{
	font-size: 18px;
	line-height: 1.7;
}
.demo-notices{
	list-style: none;
	font-size: 16px;
}
.demo-notices li{
	margin-bottom: 10px;
	padding-left: 30px;
	line-height: 1.7;
	position: relative;
}
.demo-notices li .dashicons {
	position: absolute;
	left: 0;
	top: 2px;
	color: #65f765;
}
</style>
<?php 
}
add_filter ( 'pt-ocdi/plugin_intro_text', 'tisara_import_intro_text' );
function tisara_import_intro_text() {
	ob_start();
?>
<div class="tisara-demo-importer-intro" style="">
	<h2><?php esc_html_e( 'Welcome to Tisara WP Demo Importer', 'tisara-wp' ); ?></h2>
	<div class="row">
		<div class="col-1 importer-intro">
			<p >
				<?php esc_html_e( 'Importing demo data (post, pages, images, theme settings, etc) is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch. When you import the data, the following things might happen:', 'tisara-wp' ); ?>
			</p>
		</div>
		<div class="col-2">
			<ul class="demo-notices">
				<li><span class="dashicons dashicons-yes-alt"></span> <?php esc_html_e( 'Before you begin, make sure all the required plugins are activated.', 'tisara-wp' ); ?></li>
				<li><span class="dashicons dashicons-yes-alt"></span> <?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'tisara-wp' ); ?></li>
				<li><span class="dashicons dashicons-yes-alt"></span> <?php esc_html_e( 'Posts, pages, images, widgets and menus will get imported.', 'tisara-wp' ); ?></li>
				<li><span class="dashicons dashicons-yes-alt"></span> <?php esc_html_e( 'Please click "Import Demo Data" button only once and wait, it can take a couple of minutes.', 'tisara-wp' ); ?></li>
			</ul>
		</div>
	</div>
</div>
<?php 
	$intro = ob_get_contents();
	ob_end_clean();
	return $intro;
}
