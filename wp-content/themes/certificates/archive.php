<?php
/**
 * Страница архивов записей (archive.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

	<?php $term = get_queried_object(); ?>

	<section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
            &nbsp;-&nbsp;
			<?php echo $term->name; ?>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-70">
                    <h1><?php echo $term->name; ?></h1>
					<?php echo get_field('description', $term); ?>
                </div>
                <div class="col-30 sidebar">
                    <div class="chat"></div>
                    <div class="form__content">
                        <div class="form__title">Заполните форму и закажите бесплатную консультацию</div>
                        <form class="sidebar__form request-form">
                            <input type="text" placeholder="Имя">
                            <input type="text" placeholder="Телефон*" required>
							<span class="form__hint">Обязательное поле</span>
                            <input type="submit" value="Заказать консультацию">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>