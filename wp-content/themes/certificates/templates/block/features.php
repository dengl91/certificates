<?php
/**
 * Block Name: Features
 */
?>

<section class="features <?php echo get_field('alt') ? 'features--alt' : ''; ?>">
    <div class="container">
        <div class="row">
            <div class="col-30"><h2 class="main__title"><?php the_field('title'); ?></h2></div>
            <div class="col-70">
                <div class="features__content">
                    <?php
                    if ( have_rows('features') ) :
                        while( have_rows('features') ) : the_row();
                    ?>
                        <div class="features__item">
                            <div class="features__img">
                                <img src="<?php the_sub_field('img'); ?>" alt="<?php the_sub_field('title'); ?>">
                            </div>
                            <div class="features__title"><?php the_sub_field('title'); ?></div>
                            <div class="features__description"><?php the_sub_field('description'); ?></div>
                        </div>
                    <?php
                        endwhile;
                    else :
                    ?>
                        <div class="features__item">
                            <div class="features__img">
                                <img src="/public/img/communication.svg">
                            </div>
                            <div class="features__title">Сопровождение</div>
                            <div class="features__description">Образцы</div>
                        </div>
                        <div class="features__item">
                            <div class="features__img">
                                <img src="/public/img/sales-report.svg">
                            </div>
                            <div class="features__title">Сопровождение</div>
                            <div class="features__description">Образцы</div>
                        </div>
                        <div class="features__item">
                            <div class="features__img">
                                <img src="/public/img/sale.svg">
                            </div>
                            <div class="features__title">Сопровождение</div>
                            <div class="features__description">Образцы</div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>