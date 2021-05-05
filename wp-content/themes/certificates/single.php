<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>

<section>
	<div class="container">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php previous_post_link('%link', '<- Предыдущий пост: %title', TRUE); ?>
		<?php next_post_link('%link', 'Следующий пост: %title ->', TRUE); ?>
		<?php if (comments_open() || get_comments_number()) comments_template('', true); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
