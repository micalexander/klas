<?php
    $button_text = get_sub_field('button_text');
    $editor = get_sub_field('editor');
    if ($button_text):
?>
        <div class=" accordion-button-wrapper ">
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
?>