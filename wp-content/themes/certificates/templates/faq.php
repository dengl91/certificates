<?php
/**
 * FAQ
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: FAQ
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
        </div>
    </section>

    <section class="content content--faq">
        <div class="container">
            <div class="row documents__row">
                <div class="col-70 documents__content">
                    <h1>Часто задаваемые вопросы</h1>
                    <div class="content__subtitle">Молодость всё простит — тысячи глупых обид.<br> Ты попал под наш бит, ты попал под наш бит.</div>
                    <p class="has-text-align-right only-xs"><strong>Вы можете связаться с нами:</strong><br><strong><a href="tel:+375297675073" data-type="tel" data-id="tel:+375297675073">+375 29 767-50-73</a><br><a href="tel:+375447845073">+375 44 787-50-73</a></strong></p>
                    <?php
                    $terms = get_terms( 'faq_cat' );
                    $num = 0;
                    foreach( $terms as $term ) {
                    ?>
                        <div class="row">
                            <div class="col-30">
                                <a href="<?php echo get_term_link($term->term_id); ?>" class="main__subtitle faq__tab"><?php echo $term->name; ?></a>
                            </div>
                            <div class="col-70">
                                <div class="open__content">
                                <?php
                                $args = array(
                                    'posts_per_page' => -1,
                                    'post_type'      => 'faq',
                                    'tax_query'      => array( 
                                        array(
                                            'taxonomy' => 'faq_cat',
                                            'terms'    => $term->term_id
                                        )
                                    )
                                );
                                $num = 0;
                                $myposts = get_posts( $args );
                                foreach ( $myposts as $post ) { setup_postdata($post);
                                ?>
                                    <div class="open <?php echo $num == 0 ? 'active' : ''; ?>" data-toggle>
                                        <div class="open__title"><?php echo get_the_title($post->ID); ?></div>
                                        <div class="open__description"><?php the_field('answer'); ?></div>
                                    </div>
                                <?php
                                    $num++;
                                }
                                wp_reset_postdata();
                                ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        $num++;
                    }
                    ?>
                </div>
                <div class="col-30 sidebar">
                    <div class="chat"></div>
                    <div class="form__content">
                        <div class="form__title">Заполните форму и закажите бесплатную консультацию</div>
                        <form class="sidebar__form request-form">
                            <input type="text" placeholder="Имя">
                            <input type="text" placeholder="Телефон*" required="">
                            <input type="submit" value="Заказать консультацию">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .nav__faq::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>