<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

	<div class="single-post__wrapper">

        <section class="bc">
            <div class="container">
                <a href="/" class="bc__item">Главная</a>
                &nbsp;-&nbsp;
                <a href="/blog/" class="bc__item">Блог</a>
            </div>
        </section>

        <section class="content">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="single-post__content">
            <div class="container">
				<?php the_content(); ?>
                <div class="d-flex jcsb">
                    <a href="/blog" class="single-post__back">Назад на страницу Блог</a>
					<?php $next_post = get_next_post(); ?>
                    <a href="<?php echo get_permalink( $next_post ); ?>" class="single-post__next">Следующая статья</a>
                </div>
            </div>
        </section>
    </div>

    <section>
        <div class="container">
            <div class="form__content">
                <div class="form__title">Заполните форму и закажите бесплатную консультацию у наших специалистов</div>
                <form class="request-form">
                    <div class="row">
                        <div class="col-33">
                            <input type="text" placeholder="Имя">
                        </div>
                        <div class="col-33">
                            <input type="text" placeholder="Телефон*" required="">
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
