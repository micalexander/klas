<?php
	$map = get_sub_field('map') ? get_sub_field('map') : '';
	if($map['address']):
		$height = get_sub_field('map_height') ? get_sub_field('map_height') . 'px' : '';
		$style_id = get_sub_field('style_id') ? get_sub_field('style_id') : '';
		$zoom = get_sub_field('zoom_level') ? get_sub_field('zoom_level') : '';
		$markers = get_sub_field('markers');
		$last_item = end($markers);

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
							if($address):
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
				endif;
			endforeach;
			?>

			});
		</script>

		<div class=" map-wrapper <?php echo 'item-'  . $item_count; ?>">
			<div id="<?php echo "map-" . $map_count; ?>" style="height:<?php echo $height; ?>;">
			</div>
		</div>
<?php
	endif;
?>
