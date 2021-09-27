<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( function_exists('wp_body_open') ) { wp_body_open(); } ?>
	<div class="site_content"><?php /* Close in footer.php */ ?>
		<?php get_template_part( 'templates/header/output' ); ?>
