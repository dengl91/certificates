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
            <div class="cat">
                <div class="row">
                    <div class="col-20">
                        <div class="cat__tab">Сертификация<br> продукции</div>
                    </div>
                    <div class="col-70">
                        <div class="cat__content">
                            <a href="" class="cat__item">Мебель</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                            <a href="" class="cat__item">Электроника, электрика и электротехническая продукция</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                            <a href="" class="cat__item">Мебель</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                            <a href="" class="cat__item">Игрушки/детские товары</a>
                            <a href="" class="cat__item empty"></a>
                            <a href="" class="cat__item empty"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-20">
                        <div class="cat__tab">Системы<br> менеджмента</div>
                    </div>
                    <div class="col-70">
                        <div class="cat__content">
                            <a href="" class="cat__item">Мебель</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                            <a href="" class="cat__item">Электроника, электрика и электротехническая продукция</a>
                            <a href="" class="cat__item empty"></a>
                            <a href="" class="cat__item empty"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-20">
                        <div class="cat__tab">Другие услуги</div>
                    </div>
                    <div class="col-70">
                        <div class="cat__content">
                            <a href="" class="cat__item">Мебель</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                            <a href="" class="cat__item">Электроника, электрика и электротехническая продукция</a>
                            <a href="" class="cat__item">Промышленное и аналогичное оборудование</a>
                            <a href="" class="cat__item">Строительные материалы</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .nav__service::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>