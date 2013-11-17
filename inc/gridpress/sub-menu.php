<?php
	$custom_theme_menu_location = get_sub_field('custom_theme_menu_location');
	$primary_header_menu = get_sub_field('primary_header_menu');


?>
	<div class=" nav-wrapper <?php echo 'item-'  . $item_count; ?> sub-nav">
		<nav>
	<?php
		if ($custom_theme_menu_location){
			wp_nav_menu( array('theme_location' => str_replace(' ', '-', strtolower(rtrim($custom_theme_menu_location))), 'sub_menu' => true ) );
		} elseif ($primary_header_menu) {
			wp_nav_menu( array('theme_location' => 'primary-header-menu', 'sub_menu' => true ) );
		}

	?>
		</nav>
	</div>
<?php //end sub-nav ?>