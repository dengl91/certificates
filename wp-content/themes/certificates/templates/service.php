<?php
/**
 * Услуги
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Услуги
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
        </div>
    </section>

    <section class="content content--cat">
        <div class="container">
            <div class="row">
                <div class="col-50">
                    <h1><?php the_title(); ?></h1>
                    <div class="content__subtitle"><?php the_field('text_left'); ?></div>
                </div>
                <div class="col-50">
                    <div class="content__quote"><?php the_field('text_right'); ?></div>
                </div>
            </div>
            <p class="has-text-align-right only-xs"><strong>Вы можете связаться с нами:</strong><br><strong><a href="tel:+375297675073" data-type="tel" data-id="tel:+375297675073">+375 29 767-50-73</a><br><a href="tel:+375447845073">+375 44 787-50-73</a></strong></p>
            <div class="cat">
                <?php
                $terms = get_terms( 'service_cat' );
                $num = 0;
                foreach( $terms as $term ) {
                ?>
                    <div class="row">
                        <div class="col-20">
                            <a href="<?php echo get_term_link($term->term_id); ?>" class="cat__tab"><?php echo $term->name; ?></a>
                        </div>
                        <div class="col-70">
                            <div class="cat__content">
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
                                $num = 0;
                                $myposts = get_posts( $args );
                                foreach ( $myposts as $post ) { setup_postdata($post);
                                ?>
                                    <a href="<?php the_permalink($post->ID); ?>" class="cat__item"><?php echo get_the_title($post->ID); ?></a>
                                <?php
                                    $num++;
                                }
                                wp_reset_postdata();
                                ?>
                                <?php
                                    $rows = ceil($num / 3);
                                    $add_cells = (3 * $rows) - $num;
                                    for ($i = 1; $i <= $add_cells; $i++) {
                                        echo '<a class="cat__item cat__item--add"></a>';
                                    }                                    
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                    $num++;
                }
                ?>
            </div>
        </div>
    </section>

    <style>
        .nav__service::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>