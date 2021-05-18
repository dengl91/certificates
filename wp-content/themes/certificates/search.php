<?php
/**
 * Шаблон поиска (search.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

	<section class="bc">
		<div class="container">
			<a href="/" class="bc__item">Главная</a>
			&nbsp;-&nbsp;
			<?php printf('Поиск по строке: %s', get_search_query()); ?>
		</div>
	</section>

<section>
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="result__item">
				<div class="result__cat"><?php echo get_post_type_object(get_post_type())->label; ?></div>
				<a href="<?php the_permalink(); ?>" class="result__title"><?php the_title(); ?></a>
				<div class="result__description"><?php the_excerpt(); ?></div>
			</div>
		<?php endwhile;
		else : echo '<p>Нет записей.</p>'; endif; ?>	 
		<?php pagination(); ?>
	</div>
</section>

<?php get_footer(); ?>