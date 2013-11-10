<div class="container">
	<div class="grid isotope-grid">
<?php
	// set counters to 0
	$count = 0;
	// start container

	if (get_field('containers')) : while(has_sub_field('containers')):
	?>
		<div class="unit item <?php echo get_sub_field('layout'); ?>">
		<?php

			while(has_sub_field('content')):
				// start main image
				if (get_row_layout() == 'main_image'):
					$image = get_sub_field('image');
				?>
					<div class="main-image">
						<img src="<?php echo $image['sizes']['main-image']; ?>" alt="<?php echo $image['alt']; ?>">
					</div>
				<?php
				// end main image
				// start slides
				elseif (get_row_layout() == 'image_rotator'):
					$images = get_sub_field('images');
				 	if( $images ):
				 ?>
				    <div id="slider" class="flexslider <?php echo str_replace('_', '-', get_row_layout()); ?>">
				        <ul class="slides">
				            <?php foreach( $images as $image ): ?>
				                <li>
				                    <img src="<?php echo $image['sizes']['rotator-image']; ?>" alt="<?php echo $image['alt']; ?>" />
				                    <?php
										$image_text = get_post_meta($image['id'], 'text', true);
										$image_url = get_post_meta($image['id'], 'url', true);
				                    ?>
				                    <?php if ($image['caption']): ?>
					                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
				                	<?php endif; ?>
				                </li>
				            <?php endforeach; ?>
				        </ul>
				    </div>
				<?php
					endif;
				// end slides
				// start slides
				elseif (get_row_layout() == 'image_carousel'):
					$images = get_sub_field('images');
				 	if( $images ):
				 ?>
				    <div id="slider" class="flexslider carousel <?php echo str_replace('_', '-', get_row_layout()); ?>">
				        <ul class="slides">
				            <?php foreach( $images as $image ): ?>
				                <li>
				                    <img src="<?php echo $image['sizes']['carousel-image']; ?>" alt="<?php echo $image['alt']; ?>" />
				                    <?php
										$image_text = get_post_meta($image['id'], 'text', true);
										$image_url = get_post_meta($image['id'], 'url', true);
				                    ?>
				                    <?php if ($image['caption']): ?>
					                    <p class="flex-caption"><span class="icon-caption-arrow"></span><?php echo $image['caption']; ?> <a href="<?php echo $image_url; ?>"><?php echo $image_text; ?><span class="icon-caption-link-arrow"></span></a></p>
				                	<?php endif; ?>
				                </li>
				            <?php endforeach; ?>
				        </ul>
				    </div>
				<?php
					endif;
				// end slides
				// start map
				elseif (get_row_layout() == 'map'):
					$map = get_sub_field('map') ? get_sub_field('map') : '';
					$height = get_sub_field('map_height') ? get_sub_field('map_height') . 'px' : '';
					$style_id = get_sub_field('style_id') ? get_sub_field('style_id') : '';
					$zoom = get_sub_field('zoom_level') ? get_sub_field('zoom_level') : '';
					$markers = get_sub_field('markers');
				// echo "<pre>" ; var_dump($markers) ; echo "</pre>";
					$last_item = end($markers);

					if ($markers):
						if($count < 1 ):
						?>

						<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
						<!--[if lte IE 8]>
						 	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
						<![endif]-->
						<?php
							endif;
							$count++;
						?>

						<script>
						// $.getScript( "http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js", function(  ) {
							$(document).ready( function() {
								var <?php echo "map_" . $count; ?> = L.map('<?php echo "map-" . $count; ?>').setView([<?php echo $map['lat']; ?>, <?php echo $map['lng']; ?>], <?php echo $zoom; ?>);

								var cloudemade = L.tileLayer('http://{s}.tile.cloudmade.com/fcb864d780d741d28002f1e0ab52116f/{styleId}/256/{z}/{x}/{y}.png', {
								    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
								    maxZoom: 18,
								    styleId: <?php echo $style_id; ?>
								}).addTo(<?php echo "map_" . $count; ?>);

									var info = L.control();
										var greenIcon = L.icon({
										    iconUrl: '<?php echo bloginfo('template_directory'); ?>/img/map/map-marker.png',
										    // shadowUrl: 'marker-shadow.png',
										    iconSize:     [25, 41], // size of the icon
										    // shadowSize:   [50, 64], // size of the shadow
										    iconAnchor:   [12, 41], // point of the icon which will correspond to marker's location
										    // shadowAnchor: [4, 62],  // the same for the shadow
										    popupAnchor:  [5, -5] // point from which the popup should open relative to the iconAnchor
										});

										<?php
											$mcount = 0;
											foreach ($markers as $marker):
												$mcount++;
												$comma = $last_item == $marker ? '': ',';
												$coordinates = $marker['location'] ? $marker['location']['lat'] . ', ' . $marker['location']['lng'] : '';
												$address = $marker['address'] ? $marker['address'] : '';
												$image = $marker['image'] ? $marker['image']['sizes']['map-image'] : '';
												$image_id = $marker['image']['id'] ? $marker['image']['id'] : '';
												$title = $marker['image']['title'] ? $marker['image']['title'] : '';
												$class = "marker-" . strtolower( str_replace(' ', '-', $title) );
												$caption = $marker['image']['caption'] ? $marker['image']['caption'] : '';
												$alt = $marker['image']['alt'] ? $marker['image']['alt'] : '';
												$description = $marker['image']['description'] ? $marker['image']['description'] : '';
												$text = get_post_meta($image_id, 'text', true) ? get_post_meta($image_id, 'text', true) : '';
												$url = get_post_meta($image_id, 'url', true) ? get_post_meta($image_id, 'url', true) : '';

										?>

									var <?php echo "marker_" . $mcount; ?> = L.marker([<?php echo $coordinates; ?>], options={title : '<?php echo $class; ?>', icon: greenIcon, maxWidth: 600}).addTo(<?php echo "map_" . $count; ?>);
									var divNode = document.createElement('DIV');
										divNode.innerHTML = ("<div class='<?php echo $class; ?>'>" +
															"<p><?php echo $title; ?></p>" +
															"<img src='<?php echo $image; ?>' alt='<?php echo $alt ?>'>" +
															"<p><?php echo $address; ?></p>" +
															"<p><?php echo $description; ?></p>" +
															"</div>");
										$('.<?php echo $class; ?>').click(function(){ $('img[title=<?php echo $class; ?>]').trigger('click');});

									<?php echo "marker_" . $mcount; ?>.bindPopup(divNode,{ maxWidth: <?php echo $marker['image']['sizes']['map-image-width'] ?> });
									<?php
										endforeach;
									?>

							});
						</script>

						<div class="map-wrapper">
							<div id="<?php echo "map-" . $count; ?>" style="height:<?php echo $height; ?>;"></div>
						</div>
						<?php
					endif;
				// end map
				// start heading one
				elseif (get_row_layout() == "heading_1"):
					$heading = get_sub_field('heading');
						if ($heading):
				?>
				<h1><?php echo $heading; ?></h1>
				<?php
						endif;
					// end heading
					// start heading two
				elseif (get_row_layout() == "heading_2"):
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h2><?php echo $heading; ?></h2>
				<?php
						endif;
					// end heading two
					// start heading three
				elseif (get_row_layout() == "heading_3"):
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h3><?php echo $heading; ?></h3>
				<?php
						endif;
					// end heading three
					// start heading four
				elseif (get_row_layout() == "heading_4"):
					$heading = get_sub_field('heading');
					if ($heading):
				?>
				<h4><?php echo $heading; ?></h4>
				<?php
					endif;
					// end heading four
					// start heading link one
				elseif (get_row_layout() == "heading_1_link"):
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
				<h1><?php echo $heading;  ?></h1>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link one
					// start heading link two
				elseif (get_row_layout() == "heading_2_link"):
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
				<h2><?php echo $heading; ?></h2>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link two
					// start heading link three
				elseif (get_row_layout() == "heading_3_link"):
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
				<h3><?php echo $heading; ?></h3>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link three
					// start heading link four
				elseif (get_row_layout() == "heading_4_link"):
					$heading = get_sub_field('heading');
					$link = get_sub_field('link');
					$target =  get_sub_field('new_window') ? 'target="_blank"' : '' ;
						if ($heading):
				?>
				<?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
				<h4><?php echo $heading; ?></h4>
				<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
				<?php
						endif;
					// end heading link four
					// start editor
				elseif (get_row_layout() == "editor"):
					$editors = get_sub_field("editor");
					if ($editors):

						foreach ($editors as $editor):
					?>
							<div class="editor"><?php echo $editor['editor']; ?></div>
					<?php
						endforeach;
					endif;
					// end editor
					// start text_link
				elseif (get_row_layout() == "text_link"):
					$text_links = get_sub_field("text_link");
					if ($text_links):

						foreach ($text_links as $text_link):
						$target = $text_link['new_window'] ? 'target="_blank"' : '' ;
					?>

						<?php echo $open_anchor = $text_link['link'] ? '<a href="' . $text_link['link'] . '" ' . $target .' >' : ''; ?>
							<?php echo $text_link['text']; ?>
						<?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
					<?php
						endforeach;

					endif;
					// end text_link
					// start text to image link (lightbox)
				elseif (get_row_layout() == "text_to_image_link"):
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
				<div class="text-lightbox">
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
					<<?php echo $tag; ?> class="rotator"><?php echo $heading; ?></<?php echo $tag; ?>>
				<?php
					endif;
					$items = get_sub_field('text');
					if($items):
				?>
					<div id="slider" class="text-rotator">
					    <ul class="slides">
					        <?php foreach ($items as $item): ?>
								<li><p><?php echo $item['text']; ?></p></li>
					        <?php endforeach; ?>
					    </ul>
					</div>
				<?php
					endif;
					// end text_rotator
					// start button_link
				elseif (get_row_layout() == "button_link"):
					$text = get_sub_field('text');
					$link = get_sub_field('link');
					$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
					if ($text):
				?>
					<div class="button-wrapper">
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
					$quote = get_sub_field('quote');
					$credit_line_1 = get_sub_field('credit_line_1');
					$credit_line_2 = get_sub_field('credit_line_2');
					$credit_line_2_type = get_sub_field('credit_line_2_type');
					$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($quote):
				?>
					<div class="blockquote">
						<blockquote>
							<?php echo $quote; ?>
							<<?php echo $credit_line_2_type == 'url' ? 'a href="' . $credit_line_2 . '"' : 'div' ; ?><?php echo $credit_line_2_type == 'class' ? ' class="' . str_replace(' ', '-', strtolower($credit_line_2)) . '"' : '' ; ?> <?php echo $target; ?>>
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
					$quotes = get_sub_field('quotes');
					if ($quotes):
					?>
					<div id="slider" class="blockquote-rotator flexslider flexslider-quote ">
					    <ul class="slides">
							<?php
								foreach ($quotes as $quote):
								$target = $quote['new_window'] ? 'target="_blank"' : '' ;

							?>

							<li>
								<blockquote>
								<?php echo $quote['quote']; ?>
								<<?php echo $quote['credit_line_2_type'] == 'url' ? 'a href="' . $quote['credit_line_2'] . '"' : 'div' ; ?><?php echo $quote['credit_line_2_type'] == 'class' ? ' class="' . str_replace(' ', '-', strtolower($quote['credit_line_2'])) . '"' : '' ; ?> <?php echo $target; ?>>
									<?php echo $quote['credit_line_1']; ?>
								</<?php echo $quote['credit_line_2_type'] == 'url' ? 'a' : 'div' ; ?>>
								<?php echo $quote['credit_line_2_type'] == 'text' ? '<div>' . $quote['credit_line_2'] . '</div>' : '' ; ?>
								</blockquote>
							</li>
						<?php endforeach; ?>
					    </ul>
					</div>
				    <?php
				    endif;
					// end blockquote rotator
					// start image
				elseif (get_row_layout() == "image"):
						$image = get_sub_field('image');
						$image_link = get_sub_field("image_link");
						$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($image):
				?>
				<a class="img-link" <?php echo $target; ?> style="width:<?php echo $image['width'] . "px"; ?>; height:<?php echo $image['height'] . "px"; ?>;" href="<?php echo $image_link; ?>" target="_blank" href="<?php echo $image_link; ?>" target="_blank" >
					<div class="image-frame">
						<img src="<?php echo $image['url']; ?>" alt="">
					</div>
				</a>
				<?php
					endif;
					// end image
					// start image with hover
				elseif (get_row_layout() == "image_with_hover"):
						$image = get_sub_field('image');
						$image_link = get_sub_field('image_link');
						$image_hover = get_sub_field("image_hover");
						$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;

					if ($image):
				?>
				<a class="img-link" <?php echo $target; ?> style="width:<?php echo $image['width'] . "px"; ?>; height:<?php echo $image['height'] . "px"; ?>;" href="<?php echo $image_link; ?>" target="_blank" >
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
					$images = get_sub_field('images');
				?>
					<div class="image-gallery">
						<?php foreach ($images as $image): ?>
							<a class="image-gallery-anchor" rel="image-gallery" href="<?php echo $image['url']; ?>">
								<img class="image" src="<?php echo $image['sizes']['gallery-thumbnail']; ?>" data-target="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['description']; ?>" >
							</a>
						<?php endforeach ?>
					</div>
				<?php
					// end image gallery
					// start pdf link
				elseif (get_row_layout() == "pdf_link"):
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
				<div class="pdf">
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
				<ul class="accordion-editor">
					<?php foreach ($accordions as $accordion): ?>
					<li>
						<<?php echo $tag; ?> class="accordion-heading icon-accordion-heading">
							<?php echo $accordion['heading'] ? $accordion['heading'] : ''; ?>
						</<?php echo $tag; ?>>
						<div class="accordion-section">
							<div class="accordion-margin">
								<?php echo $accordion['editor'] ? $accordion['editor'] : '' ; ?>
							</div>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
				<?php
					// end accordion_editor
					// start accordion_links
				elseif (get_row_layout() == "accordion_links"):
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
				<ul class="accordion-links">
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
								<<?php echo $link['text_2_type'] == 'url' ? 'a href="' . $link['text_2'] . '"' : $next_tag ; ?><?php echo $link['text_2_type'] == 'class' ? ' class="' . str_replace(' ', '-', strtolower($link['text_2'])) . '"' : '' ; ?>>
								<?php echo $link['text'] ? $link['text'] : '' ; ?>
								</<?php echo $link['text_2_type'] == 'url' ? 'a' : $next_tag ; ?>>
								<?php echo $link['text_2_type'] == 'text' ? '<' . $next_tag . '>' . $link['text_2'] . '</' . $next_tag . '>' : '' ; ?>

								<?php endforeach ?>
							</div>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
				<?php
					// end accordion_links
					// start accordion_link button
				elseif (get_row_layout() == "accordion_button"):
					$button_text = get_sub_field('button_text');
					$editor = get_sub_field('editor');
					if ($button_text):
				?>
				<div class="accordion-button-wrapper">
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
				elseif (get_row_layout() == "youtube"): ?>
				<?php
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
					<<?php echo $tag; ?> class="accordion_link">
						<?php
							echo $heading ? $heading : '';
						?>
					</<?php echo $tag; ?>>
				<?php
					endif;
					if ($video_link):
				?>
					<div class="video-wrapper">
				   		<a class="y-video" href="<?php echo $video_link; ?>">
				   			<img src="<?php echo $video_image['url'] ? $video_image['url'] : ""; ?>">
				   		</a>
					</div>
					<?php
					endif;
					// end youtube video
					// start vimeo video
				elseif (get_row_layout() == "vimeo"): ?>

				<?php
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
					<<?php echo $tag; ?> class="accordion_link">
						<?php
							echo $heading ? $heading : '';
						?>
					</<?php echo $tag; ?>>
				<?php
					endif;
					if ($video_link):
				?>
					<div class="video-wrapper">
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