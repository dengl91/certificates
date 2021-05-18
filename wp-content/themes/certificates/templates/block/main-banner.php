<?php
/**
 * Block Name: Main banner
 */

?>

<section class="banner" data-bg="<?php the_field('img'); ?>">
    <div class="container">
        <div class="banner__content">
            <span class="animate__animated animate__fadeIn" data-editable data-name="title"><?php the_field('title'); ?></span>
            <h3 class="animate__animated animate__fadeIn delay--200" data-editable data-name="subtitle"><?php the_field('subtitle'); ?></h3>
            <a href="/about" class="btn">Узнать подробнее</a>
        </div>
    </div>
</section>