<?php
    $text = get_sub_field('text');
    $link = get_sub_field('link');
    $target = get_sub_field('new_window') ? 'target="_blank"' : '' ;
    if ($text):
?>
    <div class=" button-wrapper <?php echo 'item-'  . $item_count; ?>">
        <div class="button">
            <?php echo $open_anchor = $link ? '<a href="' . $link . '" ' . $target .' >' : ''; ?>
                <?php echo $text; ?>
            <?php echo $close_anchor = $open_anchor ? '</a>' : ''; ?>
        </div>
    </div>
<?php
    endif;
    // end button_link
?>