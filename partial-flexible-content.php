<div class="container">
	<div class="grid isotope-grid">
<?php
	// set counters to 0
	$map_count = 0;
	$unit_count = 0;
	$item_count = 0;

	if (get_field('containers')) : while(has_sub_field('containers')):

		$unit_count++;
		$unit_size = get_sub_field('layout');
		$fit = get_sub_field('auto_fit') ? ' auto-fit' : '';
	?>
		<div class="unit <?php echo 'unit-'  . $unit_count . ' ' . $unit_size . ' ' . $fit; ?> ">
		<?php

			while(has_sub_field('content')):
				$item_count++;
				// start main image
				if (get_row_layout() == 'main_image'):
					$item_size = get_sub_field('layout');
					$image = get_sub_field('image');
				?>
					<div class="no-margin-unit main-image <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
						<img src="<?php echo $image['sizes']['main-image']; ?>" alt="<?php echo $image['alt']; ?>">
					</div>
				<?php
				// end main image
				// start slides
				elseif (get_row_layout() == 'image_rotator'):
					$item_size = get_sub_field('layout');
					$images = get_sub_field('images');
				 	if( $images ):
				 ?>
				    <div id="slider" class="no-margin-unit flexslider <?php echo 'item-'  . $item_count . ' ' . $item_size; ?> <?php echo str_replace('_', '-', get_row_layout()); ?> <?php echo $item_size; ?>">
				        <ul class="slides">
				            <?php foreach( $images as $image ): ?>
				                <li class="<?php echo $item_count; ?>">
				                    <img src="<?php echo $image['sizes']['rotator-image']; ?>" alt="<?php echo $image['alt']; ?>" />
				                    <?php
										$image_text = get_post_meta($image['id'], 'text', true);
										$image_url = get_post_meta($image['id'], 'url', true);
				                    ?>
				                    <?php if ($image['caption']): ?>
					                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
				                	<?php endif; ?>
				                </li>
					        <?php
								if($image != end($images)) {
									$item_count++;
								}
					        	endforeach;
					        ?>
				        </ul>
				    </div>
				<?php
					endif;
				// end slides
				// start slides
				elseif (get_row_layout() == 'image_carousel'):
					$item_size = get_sub_field('layout');
					$images = get_sub_field('images');
				 	if( $images ):
				 ?>
				    <div id="slider" class="no-margin-unit flexslider carousel <?php echo 'item-'  . $item_count . ' ' . $item_size; ?> <?php echo str_replace('_', '-', get_row_layout()); ?> <?php echo $item_size; ?>">
				        <ul class="slides">
				            <?php foreach( $images as $image ): ?>
				                <li class="<?php echo $item_count; ?>">
				                    <img src="<?php echo $image['sizes']['carousel-image']; ?>" alt="<?php echo $image['alt']; ?>" />
				                    <?php
										$image_text = get_post_meta($image['id'], 'text', true);
										$image_url = get_post_meta($image['id'], 'url', true);
				                    ?>
				                    <?php if ($image['caption']): ?>
					                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
				                	<?php endif; ?>
				                </li>
					        <?php
								if($image != end($images)) {
									$item_count++;
								}
					        	endforeach;
					        ?>
				        </ul>
				    </div>
				<?php
					endif;
				// end slides
				// start map
				elseif (get_row_layout() == 'map'):
					$item_size = get_sub_field('layout');
					$map = get_sub_field('map') ? get_sub_field('map') : '';
					$height = get_sub_field('map_height') ? get_sub_field('map_height') . 'px' : '';
					$style_id = get_sub_field('style_id') ? get_sub_field('style_id') : '';
					$zoom = get_sub_field('zoom_level') ? get_sub_field('zoom_level') : '';
					$markers = get_sub_field('markers');
					$last_item = end($markers);

					if ($markers):
						if($map_count < 1 ):
						?>

						<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
						<!--[if lte IE 8]>
						 	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
						<![endif]-->
						<?php
							endif;
							$map_count++;
						?>

						<script>
						// $.getScript( "http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js", function(  ) {
							$(document).ready( function() {
								var <?php echo "map_" . $map_count; ?> = L.map('<?php echo "map-" . $map_count; ?>').setView([<?php echo $map['lat']; ?>, <?php echo $map['lng']; ?>], <?php echo $zoom; ?>);

								var cloudemade = L.tileLayer('http://{s}.tile.cloudmade.com/fcb864d780d741d28002f1e0ab52116f/{styleId}/256/{z}/{x}/{y}.png', {
								    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
								    maxZoom: 18,
								    styleId: <?php echo $style_id; ?>
								}).addTo(<?php echo "map_" . $map_count; ?>);


								var greenIcon = L.icon({
								    iconUrl: '<?php echo bloginfo('template_directory'); ?>/img/map/map-marker.png',
								    // shadowUrl: 'marker-shadow.png',
								    iconSize:     [17, 27], // size of the icon
								    // shadowSize:   [50, 64], // size of the shadow
								    iconAnchor:   [7, 12], // point of the icon which will correspond to marker's location
								    // shadowAnchor: [4, 62],  // the same for the shadow
								    popupAnchor:  [2, -6] // point from which the popup should open relative to the iconAnchor
								});

									<?php
										$mcount = 0;
										foreach ($markers as $marker):
											$mcount++;
											$comma = $last_item == $marker ? '': ',';
											$coordinates = $marker['location'] ? $marker['location']['lat'] . ', ' . $marker['location']['lng'] : '';
											$address = $marker['location'] ? $marker['location']['address'] : '';
											$image = $marker['image'] ? $marker['image']['sizes']['map-image'] : '';
											$image_id = $marker['image']['id'] ? $marker['image']['id'] : '';
											$title = $marker['image']['title'] ? $marker['image']['title'] : '';
											$class = "map-marker-" . str_replace(' ', '-', strtolower(rtrim($title)));
											$alt = $marker['image']['alt'] ? $marker['image']['alt'] : '';
											$description = $marker['image']['description'] ? $marker['image']['description'] : '';
											$text_1 = get_post_meta($image_id, 'map-text-1', true) ? get_post_meta($image_id, 'map-text-1', true) : '';
											$text_2 = get_post_meta($image_id, 'map-text-2', true) ? get_post_meta($image_id, 'map-text-2', true) : '';
											$text_3 = get_post_meta($image_id, 'map-text-3', true) ? get_post_meta($image_id, 'map-text-3', true) : '';
											$text_4 = get_post_meta($image_id, 'map-text-4', true) ? get_post_meta($image_id, 'map-text-4', true) : '';
											$url_text = get_post_meta($image_id, 'map-url-text', true) ? get_post_meta($image_id, 'map-url-text', true) : '';
											$url = get_post_meta($image_id, 'map-url', true) ? get_post_meta($image_id, 'map-url', true) : '';

									?>

								var <?php echo "marker_" . $mcount; ?> = L.marker([<?php echo $coordinates; ?>], options={title :<?php echo json_encode($class); ?>, icon: greenIcon, maxWidth: 600}).addTo(<?php echo "map_" . $map_count; ?>);
								var divNode = document.createElement('DIV');
									divNode.innerHTML = ("<div class='" + <?php echo json_encode($class); ?> + "'>" +
														"<p class='title'>" + <?php echo json_encode($title); ?> + "</p>" +
														"<img src='" + <?php echo json_encode($image); ?> + "' alt='" + <?php echo json_encode($alt); ?> + "'>" +
														"<p class='address'>" + <?php echo json_encode($address); ?> + "</p>" +
														"<p class='line-1'>" + <?php echo json_encode($text_1); ?> + "</p>" +
														"<p class='line-2'>" + <?php echo json_encode($text_2); ?> + "</p>" +
														"<p class='line-3'>" + <?php echo json_encode($text_3); ?> + "</p>" +
														"<p class='line-4'>" + <?php echo json_encode($text_4); ?> + "</p>" +
														"<a class='url' href='" + <?php echo json_encode($url); ?> + "' target='_blank' >" +
														"<span class='url-text'>" + <?php echo json_encode($url_text); ?> +
														"</span></a>" +
														"</div>");
									$('.' + <?php echo json_encode($class); ?>).click(function(){ $('img[title=<?php echo $class; ?>]').trigger('click');});

								<?php echo "marker_" . $mcount; ?>.bindPopup(divNode,{ maxWidth: <?php echo $marker['image']['sizes']['map-image-width'] ?> });
								<?php
									endforeach;
								?>

							});
						</script>

						<div class="no-margin-unit map-wrapper <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
							<div id="<?php echo "map-" . $map_count; ?>" style="height:<?php echo $height; ?>;"></div>
						</div>
						<?php
					endif;
				// end map
				// start sub-nav
				elseif (get_row_layout() == 'sub_nav'):
					$item_size = get_sub_field('layout');
					$theme_location = get_sub_field('theme_location');
				?>
						<div class="no-margin-unit nav-wrapper <?php echo 'item-'  . $item_count . ' ' . $item_size; ?> sub-nav">
							<nav>
								<?php wp_nav_menu( array('theme_location' => str_replace(' ', '-', strtolower(rtrim($theme_location))), 'sub_menu' => true ) ); ?>
							</nav>
						</div>
				<?php
				// end sub-nav
				// start heading one
				elseif (get_row_layout() == "heading_1"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
						if ($heading):
				?>
				<h1 class="no-margin-unit <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>"><?php echo $heading; ?></h1>
				<?php
						endif;
					// end heading
					// start heading two
				elseif (get_row_layout() == "heading_2"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h2 class="no-margin-unit <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>"><?php echo $heading; ?></h2>
				<?php
						endif;
					// end heading two
					// start heading three
				elseif (get_row_layout() == "heading_3"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h3 class="no-margin-unit <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>"><?php echo $heading; ?></h3>
				<?php
						endif;
					// end heading three
					// start heading four
				elseif (get_row_layout() == "heading_4"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h4 class="no-margin-unit <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>"><?php echo $heading; ?></h4>
				<?php
					endif;
					// end heading four
					// start heading link one
				elseif (get_row_layout() == "heading_1_link"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . ' class="item-'  . $item_count . ' ' . $item_size . '"' . $target .' >' : ''; ?>
				<h1 class="no-margin-unit"><?php echo $heading;  ?></h1>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link one
					// start heading link two
				elseif (get_row_layout() == "heading_2_link"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . ' class="item-'  . $item_count . ' ' . $item_size . '"' . $target .' >' : ''; ?>
				<h2 class="<?php echo $item_size; ?>"><?php echo $heading; ?></h2>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link two
					// start heading link three
				elseif (get_row_layout() == "heading_3_link"):
					$item_size = get_sub_field('layout');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . ' class="item-'  . $item_count . ' ' . $item_size . '"' . $target .' >' : ''; ?>
				<h3 class="<?php echo $item_size; ?>"><?php echo $heading; ?></h3>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link three
					// start heading link four
				elseif (get_row_layout() == "heading_4_link"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . ' class="item-'  . $item_count . ' ' . $item_size . '"' . $target .' >' : ''; ?>
				<h4 class="<?php echo $item_size; ?>"><?php echo $heading; ?></h4>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link four
					// start editor
				elseif (get_row_layout() == "editor"):
					$item_size = get_sub_field('layout');
					$editors = get_sub_field("editor");
					if ($editors):

						foreach ($editors as $editor):
					?>
							<div class="no-margin-unit editor <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>"><?php echo $editor['editor']; ?></div>
					<?php
								$item_count++;
							if($editor = end($editors)) {
							}
						endforeach;
					endif;
					// end editor
					// start text_link
				elseif (get_row_layout() == "text_link"):
					$item_size = get_sub_field('layout');
					$text_links = get_sub_field("text_link");
					if ($text_links):

						foreach ($text_links as $text_link):
						$target = $text_link['new_window'] ? 'target="_blank"' : '' ;
					?>

						<?php echo $open_anchor = $text_link['link'] ? '<a href="' . $text_link['link'] . '" class="no-margin-unit item-'  . $item_count . ' ' . $item_size . '"' . $target  : '<p' . '" class="' . $item_size . '>'; ?>
							<?php echo $text_link['text']; ?>
						<?php echo $close_anchor = $open_anchor ? '</a>' : '</p>'; ?>
					<?php
							if($text_link != end($text_links)) {
								$item_count++;
							}
						endforeach;

					endif;
					// end text_link
					// start text to image link (lightbox)
				elseif (get_row_layout() == "text_to_image_link"):
					$item_size = get_sub_field('layout');
					$image = get_sub_field('image');
					$text = get_sub_field("text");
					$type = get_sub_field("text_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
				?>
				<div class="no-margin-unit text-lightbox <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
					<div class="icon-text-lightbox">
					</div>
					<<?php echo $tag; ?>>
						<a class="text-lightbox-anchor" rel="image-link" href="<?php echo $image['url']; ?>">
							<?php echo $text; ?>
						</a>
					</<?php echo $tag; ?>>
				</div>
				<?php
					// end text to image link
					// start text_rotator
				elseif (get_row_layout() == "text_rotator"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field("heading");
					$type = get_sub_field("heading_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
					if ($heading):
				?>
					<<?php echo $tag . ' class="no-margin-unit rotator item-'  . $item_count . ' ' . $item_size; ?>><?php echo $heading; ?></<?php echo $tag; ?>>
				<?php
					endif;
					$items = get_sub_field('text');
					if($items):
				?>
					<div id="slider" class="text-rotator">
					    <ul class="slides">
					        <?php foreach ($items as $item): ?>
								<li class="<?php echo $item_count; ?>" ><p><?php echo $item['text']; ?></p></li>
					        <?php
								if($item != end($items)) {
									$item_count++;
								}
					        	endforeach;
					        ?>
					    </ul>
					</div>
				<?php
					endif;
					// end text_rotator
					// start button_link
				elseif (get_row_layout() == "button_link"):
					$item_size = get_sub_field('layout');
					$text = get_sub_field('text');
					$link = get_sub_field('link');
					$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
					if ($text):
				?>
					<div class="no-margin-unit button-wrapper <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
						<div class="button">
				    		<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
						    	<?php echo $text; ?>
							<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
						</div>
					</div>
				<?php
				    endif;
					// end button_link
					// start blockquote
				elseif (get_row_layout() == "blockquote"):
					$item_size = get_sub_field('layout');
					$quote = get_sub_field('quote');
					$credit_line_1 = get_sub_field('credit_line_1');
					$credit_line_2 = get_sub_field('credit_line_2');
					$credit_line_2_type = get_sub_field('credit_line_2_type');
					$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($quote):
				?>
					<div class="no-margin-unit blockquote <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
						<blockquote>
							<?php echo $quote; ?>
							<<?php echo $credit_line_2_type == 'url' ? 'a href="' . $credit_line_2 . '"' : 'div' ; ?><?php echo $credit_line_2_type == 'class' ? ' class="' . str_replace(' ', '-', strtolower(rtrim($credit_line_2))) . '"' : '' ; ?> <?php echo $target; ?>>
								<?php echo $credit_line_1; ?>
							</<?php echo $credit_line_2_type == 'url' ? 'a' : 'div' ; ?>>
							<?php echo $credit_line_2_type == 'text' ? '<div>' . $credit_line_2 . '</div>' : '' ; ?>
						</blockquote>
					</div>
				<?php
				    endif;
					// end blockquote
					// start blockquote rotator
				elseif (get_row_layout() == "blockquote_rotator"):
					$item_size = get_sub_field('layout');
					$quotes = get_sub_field('quotes');
					if ($quotes):
					?>
					<div id="slider" class="no-margin-unit blockquote-rotator flexslider flexslider-quote <?php echo 'item-'  . $item_count . ' ' . $item_size; ?>">
					    <ul class="slides">
							<?php
								foreach ($quotes as $quote):
								$target = $quote['new_window'] ? 'target="_blank"' : '' ;

							?>

							<li>
								<blockquote class="<?php echo $item_count; ?>">
								<?php echo $quote['quote']; ?>
								<<?php echo $quote['credit_line_2_type'] == 'url' ? 'a href="' . $quote['credit_line_2'] . '"' : 'div' ; ?><?php echo $quote['credit_line_2_type'] == 'class' ? ' class="' . str_replace(' ', '-', strtolower(rtrim($quote['credit_line_2']))) . '"' : '' ; ?> <?php echo $target; ?>>
									<?php echo $quote['credit_line_1']; ?>
								</<?php echo $quote['credit_line_2_type'] == 'url' ? 'a' : 'div' ; ?>>
								<?php echo $quote['credit_line_2_type'] == 'text' ? '<div>' . $quote['credit_line_2'] . '</div>' : '' ; ?>
								</blockquote>
							</li>
					        <?php
								if($quote != end($quotes)) {
									$item_count++;
								}
					        	endforeach;
					        ?>
					    </ul>
					</div>
				    <?php
				    endif;
					// end blockquote rotator
					// start image
				elseif (get_row_layout() == "image"):
					$item_size = get_sub_field('layout');
						$image = get_sub_field('image');
						$image_link = get_sub_field("image_link");
						$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($image):
				?>
				<a class="no-margin-unit img-link <?php echo 'item-' . $item_count . ' ' . $item_size ?>" <?php echo $target; ?> href="<?php echo $image_link; ?>" >
					<div class="image-frame">
						<img src="<?php echo $image['url']; ?>" alt="">
					</div>
				</a>
				<?php
					endif;
					// end image
					// start image with hover
				elseif (get_row_layout() == "image_with_hover"):
					$item_size = get_sub_field('layout');
						$image = get_sub_field('image');
						$image_link = get_sub_field('image_link');
						$image_hover = get_sub_field("image_hover");
						$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($image):
				?>
				<a class="no-margin-unit img-link <?php echo 'item-' . $item_count . ' ' . $item_size ?>" <?php echo $target; ?>  href="<?php echo $image_link; ?>" >
					<div class="image-frame-hover">
						<img src="<?php echo $image['url']; ?>" alt="">
						<img src="<?php echo $image_hover['url']; ?>" alt="">
					</div>
				</a>
				<?php
					endif;
					// end image with hover
					// start image gallery
				elseif (get_row_layout() == "image_gallery"):
					$item_size = get_sub_field('layout');
					$images = get_sub_field('images');
				?>
					<div class="no-margin-unit image-gallery <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
						<?php foreach ($images as $image): ?>
							<a class="image-gallery-anchor <?php echo $item_count; ?>" rel="image-gallery" href="<?php echo $image['url']; ?>">
								<img class="image" src="<?php echo $image['sizes']['gallery-thumbnail']; ?>" data-target="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['description']; ?>" >
							</a>
					        <?php
								if($image != end($images)) {
									$item_count++;
								}
					        	endforeach;
					        ?>
					</div>
				<?php
					// end image gallery
					// start pdf link
				elseif (get_row_layout() == "pdf_link"):
					$item_size = get_sub_field('layout');
					$text = get_sub_field("text");
					$pdf = get_sub_field('pdf');
					$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
					$type = get_sub_field("text_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
					if ($pdf):
				?>
				<div class="no-margin-unit pdf <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
					<a class="text" href="<?php echo $pdf['url']; ?>" <?php echo $target; ?> >
					<div class="icon-pdf">PDF</div>
					<<?php echo $tag; ?>>
						<?php echo $text ? $text : ""; ?>
					</<?php echo $tag; ?>>
					</a>
				</div>
				<?php
						endif;
					// end pdf link
					// start accordion_editor
				elseif (get_row_layout() == "accordion_editor"):
					$item_size = get_sub_field('layout');
					$accordions = get_sub_field("accordion");
					$type = get_sub_field("heading_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
				?>
				<ul class="no-margin-unit accordion-editor <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
					<?php foreach ($accordions as $accordion): ?>
					<li>
						<<?php echo $tag; ?> class="accordion-heading icon-accordion-heading <?php echo $item_count; ?>">
							<?php echo $accordion['heading'] ? $accordion['heading'] : ''; ?>
						</<?php echo $tag; ?>>
						<div class="accordion-section">
							<div class="accordion-margin">
								<?php echo $accordion['editor'] ? $accordion['editor'] : '' ; ?>
							</div>
						</div>
					</li>
			        <?php
						if($accordion != end($accordions)) {
							$item_count++;
						}
			        	endforeach;
			        ?>
				</ul>
				<?php
					// end accordion_editor
					// start accordion_links
				elseif (get_row_layout() == "accordion_links"):
					$item_size = get_sub_field('layout');
					$accordions = get_sub_field("accordion");
					$type = get_sub_field("heading_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							$next_tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							$next_tag = 'h2';
							break;
						case 'heading_2':
							$tag = 'h2';
							$next_tag = 'h3';
							break;
						case 'heading_3':
							$tag = 'h3';
							$next_tag = 'h4';
							break;
						case 'heading_4':
							$tag = 'h4';
							$next_tag = 'h5';
							break;
					}
				?>
				<ul class="no-margin-unit accordion-links <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
					<?php
						foreach ($accordions as $accordion):
							$links = $accordion['links'];
					?>

					<li class="accordion-key">
						<<?php echo $tag; ?> class="accordion-heading icon-accordion-heading">
							<?php echo $accordion['heading'] ? $accordion['heading'] : ''; ?>
						</<?php echo $tag; ?>>
						<div class="accordion-section">
							<div class="accordion-margin">
								<?php foreach ($links as $link): ?>
									<<?php echo $link['text_2_type'] == 'url' ? 'a href="' . $link['text_2'] . '"' : $next_tag ; ?><?php echo $link['text_2_type'] == 'class' ? ' class="' . str_replace(' ', '-', strtolower(rtrim($link['text_2']))) . ' ' .$item_count . '"' : '' ; ?>>
									<?php echo $link['text'] ? $link['text'] : '' ; ?>
									</<?php echo $link['text_2_type'] == 'url' ? 'a' : $next_tag ; ?>>
									<?php echo $link['text_2_type'] == 'text' ? '<' . $next_tag . ' class="' . $item_count . '">' . $link['text_2'] . '</' . $next_tag . '>' : '' ; ?>
							        <?php
										if($link != end($links)) {
											$item_count++;
										}
							        	endforeach;
							        ?>
							</div>
						</div>
					</li>
			        <?php
						if($accordion != end($accordions)) {
							$item_count++;
						}
			        	endforeach;
			        ?>
				</ul>
				<?php
					// end accordion_links
					// start accordion_link button
				elseif (get_row_layout() == "accordion_button"):
					$item_size = get_sub_field('layout');
					$button_text = get_sub_field('button_text');
					$editor = get_sub_field('editor');
					if ($button_text):
				?>
				<div class="no-margin-unit accordion-button-wrapper <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
					<div class="accordion-button">
						<?php echo $button_text; ?>
					</div>
					<div class="accordion-section">
						<div class="accordion-margin">
							<?php echo $editor ? $editor : ""; ?>
						</div>
					</div>
				</div>

				<?php
					endif;
					// end accordion_link button
					// start youtube video
				elseif (get_row_layout() == "youtube"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					$video_link = get_sub_field('video_link');
					$video_image = get_sub_field('video_image');
					$type = get_sub_field("heading_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
					if ($heading):
				?>
					<<?php echo $tag; ?> <?php echo 'class="no-margin-unit video item-' . $item_count . ' ' . $item_size . '"'; ?>>
						<?php
							echo $heading ? $heading : '';
						?>
					</<?php echo $tag; ?>>
				<?php
					endif;
					if ($video_link):
				?>
					<div class="no-margin-unit video-wrapper <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
				   		<a class="y-video" href="<?php echo $video_link; ?>">
				   			<img src="<?php echo $video_image['url'] ? $video_image['url'] : ""; ?>">
				   		</a>
					</div>
					<?php
					endif;
					// end youtube video
					// start vimeo video
				elseif (get_row_layout() == "vimeo"):
					$item_size = get_sub_field('layout');
					$heading = get_sub_field('heading');
					$video_link = get_sub_field('video_link');
					$video_image = get_sub_field('video_image');
					$type = get_sub_field("heading_type");
					switch ($type) {
						case 'paragraph_text':
							$tag = 'p';
							break;
						case 'heading_1':
							$tag = 'h1';
							break;
						case 'heading_2':
							$tag = 'h2';
							break;
						case 'heading_3':
							$tag = 'h3';
							break;
						case 'heading_4':
							$tag = 'h4';
							break;
					}
					if ($heading):
				?>
					<<?php echo $tag; ?> <?php echo 'class="no-margin-unit video item-' . $item_count . ' ' . $item_size . '"'; ?>>
						<?php
							echo $heading ? $heading : '';
						?>
					</<?php echo $tag; ?>>
				<?php
					endif;
					if ($video_link):
				?>
					<div class="no-margin-unit video-wrapper <?php echo 'item-' . $item_count . ' ' . $item_size; ?>">
				   		<a class="v-video" href="<?php echo $video_link; ?>">
				   			<img src="<?php echo $video_image['url'] ? $video_image['url'] : ""; ?>">
				   		</a>
					</div>
				<?php
					endif;
					// end vimeo video
				// end flexible editor
				endif;
			endwhile;
			?>
			</div>
		<?php
	endwhile; endif;
?>
	</div>
</div>