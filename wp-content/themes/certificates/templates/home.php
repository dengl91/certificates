<?php
/**
 * Главная
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Главная
 * Author URI: telegram @dhljob
 */
get_header(); ?>

    <?php the_content(); ?>

    <section class="form">
        <div class="container">
            <div class="form__content">
                <div class="form__title">Заполните форму и закажите бесплатную консультацию у наших специалистов</div>
                <form class="request-form">
                    <div class="row">
                        <div class="col-33">
                            <input type="text" name="username" placeholder="Имя">
                        </div>
                        <div class="col-33">
                            <input type="text" name="phone" placeholder="Телефон*" required>
                            <span class="form__hint">Обязательное поле</span>
                        </div>
                        <div class="col-33">
                            <input type="submit" value="Заказать консультацию">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php get_footer(); ?>