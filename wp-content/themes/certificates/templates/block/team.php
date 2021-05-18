<?php
/**
 * Block Name: Team
 */
?>

<section class="team">
    <div class="container">
        <div class="row">
            <div class="col-30"><h2 class="main__title"><?php the_field('title'); ?></h2></div>
            <div class="col-70">
                <div class="team__content">
                    <?php
                    if ( have_rows('features') ) :
                        while( have_rows('features') ) : the_row();
                    ?>
                    <div class="team__item">
                        <div class="team__img">
                            <img src="<?php the_sub_field('img'); ?>" alt="<?php the_sub_field('title'); ?>">
                        </div>
                        <div class="team__title"><?php the_sub_field('title'); ?></div>
                        <div class="team__description"><?php the_sub_field('description'); ?></div>
                    </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>