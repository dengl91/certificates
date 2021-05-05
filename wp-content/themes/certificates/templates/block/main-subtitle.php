<?php
/**
 * Block Name: Main subtitle
 */

?>

<h3 class="main__subtitle">
    <?php
    if ( get_field('text') ) {
        the_field('text');
    } else {
        echo 'Заголовок';
    }
    ?>
</h3>