<?php
/**
 * Страница 404 ошибки (404.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

	<section class="error">
        <div class="container">
            <h1>Ой, кажется, этой страницы не существует :(</h1>
            <img src="public/img/404.svg" alt="Страницы не существует">
            <a href="/" class="error__btn">Вернуться на главную</a>
        </div>
    </section>

<?php get_footer(); ?>