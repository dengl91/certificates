<?php
/**
 * Документы
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Документы
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row documents__row">
                <div class="col-70 documents__content">
                    <h1><?php the_title(); ?></h1>
                    <div class="content__subtitle"><?php the_content(); ?></div>
                    <p class="has-text-align-right only-xs"><strong>Вы можете связаться с нами:</strong><br><strong><a href="tel:+375297675073" data-type="tel" data-id="tel:+375297675073">+375 29 767-50-73</a><br><a href="tel:+375447845073">+375 44 787-50-73</a></strong></p>
                    <div class="row">
                        <div class="col-40">
                            <?php
                            $terms = get_terms( 'document_cat' );
                            $num = 0;
                            foreach( $terms as $term ) {
                            ?>
                                <div class="tab__item <?php echo $num == 0 ? 'active' : ''; ?>" data-toggle data-navfor="link__content">
                                    <div class="tab__title"><?php echo $term->name; ?><span></span></div>
                                </div>
                                <!-- <a href="<?php // echo get_term_link($term->term_id); ?>" class="tab__link">Подробнее</a> -->
                            <?php
                                $num++;
                            }
                            ?>
                        </div>
                        <div class="col-60">
                            <?php
                            $terms = get_terms( 'document_cat' );
                            $num = 0;
                            foreach( $terms as $term ) {
                            ?>
                            <div class="link__content <?php echo $num == 0 ? 'active' : ''; ?>">
                                <?php
                                $args = array(
                                    'posts_per_page' => -1,
                                    'post_type'      => 'document',
                                    'tax_query'      => array( 
                                        array(
                                            'taxonomy' => 'document_cat',
                                            'terms'    => $term->term_id
                                        )
                                    )
                                );
                                $myposts = get_posts( $args );
                                foreach ( $myposts as $post ) { setup_postdata($post);
                                ?>
                                    <a href="<?php the_permalink($post->ID); ?>" class="link"><?php echo get_the_title($post->ID); ?></a>
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
                <div class="col-30 sidebar">
                    <div class="chat"></div>
                    <div class="form__content">
                        <div class="form__title">Заполните форму и закажите бесплатную консультацию</div>
                        <form class="sidebar__form request-form">
                            <input type="text" name="username" placeholder="Имя">
                            <input type="text" name="phone" placeholder="Телефон*" required>
                            <span class="sidebar__hint">Обязательное поле</span>
                            <input type="submit" value="Заказать консультацию">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .nav__documents::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>