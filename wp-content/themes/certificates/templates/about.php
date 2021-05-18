<?php
/**
 * О нас
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: О нас
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
                <a href="/about" class="main__subtitle active">Информация</a>
                <a href="/review" class="main__subtitle">Отзывы</a>
                <a href="/vacancy" class="main__subtitle">Вакансии</a>
            </div>
            <?php the_content(); ?>
        </div>
    </section>

    <style>
        .nav__about::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>