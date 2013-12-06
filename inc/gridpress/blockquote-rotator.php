<?php
	$quotes = get_sub_field('quotes');
	if ($quotes):
	?>
	<div id="slider" class=" blockquote-rotator flexslider flexslider-quote <?php echo 'item-'  . $item_count; ?>">
	    <ul class="slides">
			<?php
				foreach ($quotes as $quote):
				$target = $quote['new_window'] ? 'target="_blank"' : '' ;
				$class = $quote['class'] ? str_replace(' ', '-', strtolower(rtrim($quote['class']))) . ' ' : '' ;

			?>

			<li>
				<blockquote class="<?php echo $class; ?><?php echo $item_count; ?>">
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
?>