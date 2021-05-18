<?php
/**
 * Block Name: FAQ
 */
?>

<section class="faq">
    <div class="container">
        <div class="d-flex jcfe">
            <div class="side side--w">
                <div class="side__title"><?php the_field('title_right'); ?></div>
                <div class="side__description"><?php the_field('description_right'); ?></div>
            </div>
        </div>
        <?php if ( get_field('faq') ) { ?>
            <div class="row">
                <div class="col-80">
                    <div class="faq__content">
                        <div class="main__title"><?php the_field('title'); ?></div>
                        <div class="open__content active">
                            <?php
                            $featured_faq = get_field('faq');
                            $num = 0;
                            foreach( $featured_faq as $faq_item ): 
                                setup_postdata($faq_item);
                            ?>
                                <div class="open <?php echo $num == 0 ? 'active' : ''; ?>" data-toggle>
                                    <div class="open__title"><?php echo get_the_title($faq_item); ?></div>
                                    <div class="open__description"><?php echo get_field('answer', $faq_item); ?></div>
                                </div>
                            <?php
                                $num++;
                                wp_reset_postdata();
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>