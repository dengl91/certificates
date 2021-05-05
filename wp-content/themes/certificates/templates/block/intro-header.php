<?php
/**
 * Block Name: Intro header
 */

?>

<div class="content__subtitle">
    <?php
    if ( get_field('text') ) {
        the_field('text');
    } else {
        echo 'Молодость всё простит — тысячи глупых обид.<br> Ты попал под наш бит, ты попал под наш бит.';
    }
    ?>
</div>