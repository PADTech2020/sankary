<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-blog entry-search'); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && !post_password_required() && !is_attachment() ) : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'thumbnail alignright' ) ); ?>
			</a>
		<?php endif; ?>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<?php tisara_meta_output('search'); ?>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>
