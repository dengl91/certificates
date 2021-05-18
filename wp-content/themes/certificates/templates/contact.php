<?php
/**
 * Контакты
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Контакты
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
                    <?php the_content(); ?>
                    <div class="link__content active">
                        <a href="mailto:info@sootvetstvie.by" class="link link--email">info@sootvetstvie.by</a>
                        <a href="" class="link link--address">Беларусь, Минск, ул. Ольшевского, д. 22</a>
                        <span class="link link--time">Пн. - Пт. с 9:00 до 17:30</span>
                        <div class="phone__content">
                            <div class="d-flex flex-col">
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <span class="phone__hint">Отдел сертификации</span>
                            </div>
                            <div class="d-flex flex-col">
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <div class="phone__hint">Отдел технических условий</div>
                            </div>
                        </div>
                        <div class="phone__content">
                            <div class="d-flex flex-col">
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <span class="phone__hint">Отдел сертификации</span>
                            </div>
                            <div class="d-flex flex-col">
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <a href="tel:+375297675073" class="phone__item">+375 29 767-50-73</a>
                                <div class="phone__hint">Отдел технических условий</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-50 contact__map">
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A356d664d6706d5afa8b0a333c81db6cb0877369aec0f68fc5c75b1192d82943b&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section>
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

    <style>
        .nav__contact::after {
            top: 0;
        }
    </style>

<?php get_footer(); ?>