<?php
/**
 * Отзывы
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Отзывы
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-50">
                    <h1>О компании</h1>
                </div>
            </div>
            <div class="tab__content">
                <a href="/about" class="main__subtitle">Информация</a>
                <a href="/review" class="main__subtitle active">Отзывы</a>
                <a href="/vacancy" class="main__subtitle">Вакансии</a>
            </div>
        </div>
    </section>

    <section class="review review--alt">
        <div class="container">
            <div class="row">
                <div class="review__content review__content--alt">
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type'      => 'review'
                    );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) { setup_postdata($post);
                    ?>
                        <div class="review__wrapper">
                            <div class="review__item">
                                <div class="review__img">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                </div>
                                <div class="review__title"><?php the_title(); ?></div>
                                <div class="review__description"><?php the_content(); ?></div>
                                <a href="<?php the_field('review_img'); ?>" class="review__link">Оригинал отзыва</a>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="review__calc"><span class="review__current">1</span>/<span class="review__max">2</span></div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>