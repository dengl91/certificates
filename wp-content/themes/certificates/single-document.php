<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
            &nbsp;-&nbsp;
            <a href="/documents/" class="bc__item">Документация</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <object data="<?php the_field('pdf'); ?>">
                <p>Ваш браузер не поддерживает просмотр pdf внутри страницы</p>
                <p><a href="<?php the_field('pdf'); ?>" target="_blank">Открыть в новой вкладке</a></p>
            </object>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="form__content">
                <div class="form__title">Заполните форму и закажите бесплатную консультацию у наших специалистов</div>
                <form>
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
