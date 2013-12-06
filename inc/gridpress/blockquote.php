<?php
	$quote = get_sub_field('quote');
	$credit_line_1 = get_sub_field('credit_line_1');
	$credit_line_2 = get_sub_field('credit_line_2');
	$credit_line_2_type = get_sub_field('credit_line_2_type');
	$target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
	$class = get_sub_field('class') ? str_replace(' ', '-', strtolower(rtrim(get_sub_field('class')))) . ' ' : '' ;

	if ($quote):
?>
	<blockquote class="<?php echo $class; ?><?php echo 'item-'  . $item_count; ?>">
		<?php echo $quote; ?>
		<<?php echo $credit_line_2_type == 'url' ? 'a href="' . $credit_line_2 . '"' : 'div' ; ?><?php echo $credit_line_2_type == 'class' ? ' class="' . str_replace(' ', '-', strtolower(rtrim($credit_line_2))) . '"' : '' ; ?> <?php echo $target; ?>>
			<?php echo $credit_line_1; ?>
		</<?php echo $credit_line_2_type == 'url' ? 'a' : 'div' ; ?>>
		<?php echo $credit_line_2_type == 'text' ? '<div>' . $credit_line_2 . '</div>' : '' ; ?>
	</blockquote>

<?php
    endif;
	// end blockquote
?>