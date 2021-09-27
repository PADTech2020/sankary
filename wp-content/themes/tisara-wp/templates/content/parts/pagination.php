<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<nav class="blog-pagination">
	<?php 
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'       => '?paged=%#%',
		'current'      => max( 1, get_query_var('paged') ),
		'total'        => $wp_query->max_num_pages,
		'prev_text'    => '&larr;',
		'next_text'    => '&rarr;',
		'type'         => 'list',
		'end_size'     => 3,
		'mid_size'     => 3,
	) );
	?>
</nav>
