<?php
/**
 * Block Name: Service
 */
?>

    <section class="service">
        <div class="container">
            <h2 class="main__title animate__animated animate__fadeIn delay--200"><?php the_field('title'); ?></h2>
            <div class="row">
                <div class="col-40 pl">
                    <?php
                    $terms = get_terms( 'service_cat' );
                    $num = 0;
                    foreach( $terms as $term ) {
                    ?>
                        <div class="tab__item <?php echo $num == 0 ? 'active' : ''; ?>" data-toggle data-navfor="service__content">
                            <div class="tab__title"><?php echo $term->name; ?><span></span></div>
                        </div>
                    <?php
                        $num++;
                    }
                    ?>
                </div>
                <div class="col-60">
                    <?php
                    $terms = get_terms( 'service_cat' );
                    $num = 0;
                    foreach( $terms as $term ) {
                    ?>
                    <div class="service__content <?php echo $num == 0 ? 'active' : ''; ?>">
                        <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type'      => 'service',
                            'order_by'       => 'date',
                            'order'          => 'ASC',
                            'tax_query'      => array( 
                                array(
                                    'taxonomy' => 'service_cat',
                                    'terms'    => $term->term_id
                                )
                            )
                        );
                        $myposts = get_posts( $args );
                        foreach ( $myposts as $post ) { setup_postdata($post);
                        ?>
                            <a href="<?php the_permalink($post->ID); ?>" class="service__item"><?php echo get_the_title($post->ID); ?></a>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php
                        $num++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>