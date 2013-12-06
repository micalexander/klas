<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_hompage-rotator',
		'title' => 'Hompage Rotator',
		'fields' => array (
			array (
				'key' => 'field_528sdf88d8607',
				'label' => __('Images'),
				'name' => 'images',
				'type' => 'gallery',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content'
			),
		),
		'menu_order' => 0,
	));
}

?>