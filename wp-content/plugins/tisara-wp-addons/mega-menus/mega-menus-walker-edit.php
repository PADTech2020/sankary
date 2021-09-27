<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Tisara_Mega_Menus_Walker_Edit extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $_wp_nav_menu_max_depth;
	   
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
		ob_start();
		$item_id 		= esc_attr( $item->ID );
		$removed_args 	= array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
	
		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}
	
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);
	
		$title = $item->title;
	
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'tisara-wp-addons' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __( '%s (Pending)', 'tisara-wp-addons' ), $item->title );
		}
	
		$title = empty( $item->label ) ? $title : $item->label; 
		?>

		<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' 	=> 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'tisara-wp-addons' ); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' 	=> 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'tisara-wp-addons' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'tisara-wp-addons' ); ?>" href="<?php
							echo (  isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'tisara-wp-addons' ); ?></a>
					</span>
				</dt>
			</dl>
	
			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'URL', 'tisara-wp-addons' ); ?><br>
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Navigation Label', 'tisara-wp-addons' ); ?><br>
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Title Attribute', 'tisara-wp-addons' ); ?><br>
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'tisara-wp-addons' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'tisara-wp-addons' ); ?><br>
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'tisara-wp-addons' ); ?><br>
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Description', 'tisara-wp-addons' ); ?><br>
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'tisara-wp-addons' ); ?></span>
					</label>
				</p>        
				
				<?php /* New fields insertion starts here */ ?>

				<p class="field-mega-menu description description-wide">
					<label for="edit-menu-item-mega_menu-<?php echo esc_attr( $item_id ); ?>">
						<strong><?php esc_html_e( 'Mega Menu', 'tisara-wp-addons' ); ?></strong><br>
						<span>Enable Mega Menu on this menu item?</span>
						<input type="text" id="edit-menu-item-mega_menu-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom mega-menu-status" name="menu-item-mega_menu[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->mega_menu ); ?>" />
						<input type="checkbox" id="toggle-mega_menu-<?php echo esc_attr( $item_id ); ?>" class="hidden-check" data-target="edit-menu-item-mega_menu-<?php echo esc_attr( $item_id ); ?>">
						<label for="toggle-mega_menu-<?php echo esc_attr( $item_id ); ?>" class="switch-control"></label>

					</label>
				</p>
				<div class="mega-menu-options">
					<p class="field-background-url description description-wide">
						<label for="edit-menu-item-background_url-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Background', 'tisara-wp-addons' ); ?><br>
						<input type="text" id="edit-menu-item-background_url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom mega-menu-bg" name="menu-item-background_url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->background_url ); ?>" placeholder="Paste Background URL or Upload"/>
						<a id="select-background_url-<?php echo esc_attr( $item_id ); ?>" class="tk-media-button button-secondary" name="select-background_url-<?php echo esc_attr( $item_id ); ?>" data-target="#edit-menu-item-background_url-<?php echo esc_attr( $item_id ); ?>">Upload</a>
					</p>
					
					<p class="field-menu-mm-bg-pos description description-wide">
						<label for="edit-menu-item-mm_bg_pos-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Background Position', 'tisara-wp-addons' ); ?><br>
							<select id="edit-menu-item-mm_bg_pos-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-custom" name="menu-item-mm_bg_pos[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->mm_bg_pos ); ?>">
								<option value="" <?php echo ( $item->mm_bg_pos == "") ? "selected" : ""; ?>>Select Background Position</option>
								<option value="top-left" <?php echo ( $item->mm_bg_pos == "top-left") ? "selected": ""; ?> >Top Left</option>
								<option value="top-right" <?php echo ( $item->mm_bg_pos == "top-right") ? "selected": ""; ?> >Top Right</option>
								<option value="bottom-left" <?php echo ( $item->mm_bg_pos == "bottom-left") ? "selected": ""; ?> >Bottom Left</option>
								<option value="bottom-right" <?php echo ( $item->mm_bg_pos == "bottom-right") ? "selected": ""; ?> >Bottom Right</option>
							</select>
						</label>
					</p>
					<p class="field-mega-fullwidth description description-wide">
						<label for="edit-menu-item-mega_fullwidth-<?php echo esc_attr( $item_id ); ?>">
							<strong><?php esc_html_e( 'Fullwidth Mega Menu', 'tisara-wp-addons' ); ?></strong><br>
							<span><?php esc_html_e( 'Make the Mega Menu Fullwidth?', 'tisara-wp-addons' ); ?></span>
							<input type="text" id="edit-menu-item-mega_fullwidth-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom mega-menu-status" name="menu-item-mega_fullwidth[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->mega_fullwidth ); ?>" />
							<input type="checkbox" id="toggle-mega_fullwidth-<?php echo esc_attr( $item_id ); ?>" class="hidden-check" data-target="edit-menu-item-mega_fullwidth-<?php echo esc_attr( $item_id ); ?>">
							<label for="toggle-mega_fullwidth-<?php echo esc_attr( $item_id ); ?>" class="switch-control"></label>

						</label>
					</p>
				</div>

				<!-- 
				<p class="field-menu-icon-code description description-wide">
					<label for="edit-menu-item-icon_code-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu Icon', 'tisara-wp-addons' ); ?><br>
						<?php echo esc_attr( $item->icon_code ); ?>
						<input type="text" id="edit-menu-item-icon_code-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-custom tk-icon-picker" name="menu-item-icon_code[<?php echo esc_attr( $item_id ); ?>]" value=<?php echo esc_attr( $item->icon_code ); ?> />
					   
					</label>
				</p>
				-->
				<?php
				/* New fields insertion ends here */
				?>
		
				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __( 'Original: %s', 'tisara-wp-addons' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' 	=> 'delete-menu-item',
								'menu-item' => $item_id,
							),
							remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_html_e( 'Remove', 'tisara-wp-addons' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
						?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'tisara-wp-addons' ); ?></a>
				</div>
	
				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		
		$output .= ob_get_clean();

		}
}
