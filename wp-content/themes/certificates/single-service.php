<?php
/**
 * Отзывы
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Отзывы
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
            &nbsp;-&nbsp;
            <a href="/service/">Услуги нашей компании</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-70">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
                <div class="col-30 sidebar">
                    <div class="chat"></div>
                    <div class="form__content">
                        <div class="form__title">Заполните форму и закажите бесплатную консультацию</div>
                        <form class="sidebar__form">
                            <input type="text" name="username" placeholder="Имя">
                            <input type="text" name="phone" placeholder="Телефон*" required>
                            <span class="form__hint">Обязательное поле</span>
                            <input type="submit" value="Заказать консультацию">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ( get_field('review') ) { ?>
        <section class="review">
            <div class="container">
                <div class="row">
                    <div class="col-40">
                        <h2 class="main__subtitle">Отзывы об услуге</h2>
                    </div>
                    <div class="col-60 review__content">
                        <?php
                        $featured_reviews = get_field('review');
                        foreach( $featured_reviews as $post ): 
                            setup_postdata($post);
                        ?>
                            <div class="review__item">
                                <div class="review__img">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="Отзыв">
                                </div>
                                <div class="review__title"><?php the_title(); ?></div>
                                <div class="review__description"><?php the_content(); ?></div>
                                <a href="<?php the_field('review_img'); ?>" class="review__link" target="_blank">Оригинал отзыва</a>
                            </div>
                        <?php
                            wp_reset_postdata();
                        endforeach;
                        ?>
                    </div>
                    <div class="review__calc only-xs"><span class="review__current">1</span>/<span class="review__max">2</span></div>
                </div>
                <a href="/review" class="single-post__next only-xs">Читать все отзывы</a>
            </div>
        </section>
    <?php } ?>

    <section class="faq faq--page">
        <div class="container">
            <div class="d-flex jcfe">
                <div class="side side--w">
                    <div class="side__description">
                        <strong>Вопросы по теме:</strong><br>
                        "<?php the_title(); ?>"
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-80">
                    <div class="faq__content">
                        <div class="main__title">Часто задаваемые вопросы</div>
                        <div class="open__content active">
                            <?php
                            $featured_faq = get_field('faq');
                            $num = 0;
                            foreach( $featured_faq as $faq_item ): 
                                setup_postdata($faq_item);
                            ?>
                                <div class="open <?php echo $num == 0 ? 'active' : ''; ?>" data-toggle>
                                    <div class="open__title"><?php echo get_the_title($faq_item); ?></div>
                                    <div class="open__description"><?php echo get_field('answer', $faq_item); ?></div>
                                </div>
                            <?php
                                $num++;
                                wp_reset_postdata();
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>