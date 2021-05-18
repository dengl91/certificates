<?php
/**
 * Вакансии
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Вакансии
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
                <a href="/review" class="main__subtitle">Отзывы</a>
                <a href="/vacancy" class="main__subtitle active">Вакансии</a>
            </div>
        </div>
    </section>

    <section class="vacancy">
        <div class="container">
            <?php
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => 'job'
            );
            $myposts = get_posts( $args );
            foreach ( $myposts as $post ) { setup_postdata($post);
            ?>
                <div class="row vacancy__item">
                    <div class="col-30">
                        <div class="vacancy__side">
                            <div class="vacancy__title"><?php the_title(); ?></div>
                            <div class="vacancy__subtitle">График</div>
                            <div class="vacancy__text"><?php the_field('schedule'); ?></div>
                            <div class="vacancy__subtitle">Зарплата</div>
                            <div class="vacancy__text"><?php the_field('salary'); ?></div>
                            <div class="vacancy__subtitle">Обязанности</div>
                            <div class="vacancy__text">
                                <?php the_field('responsibility'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-70">
                        <div class="vacancy__description">
                            <?php the_content(); ?>
                        </div>
                        <div class="vacancy__btn" data-control="modal--request">Подать заявку</div>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>

<?php get_footer(); ?>