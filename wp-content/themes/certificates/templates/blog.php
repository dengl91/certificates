<?php
/**
 * Блог
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Блог
 */
get_header(); ?>

    <section class="bc">
        <div class="container">
            <a href="/" class="bc__item">Главная</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <h1>Блог</h1>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-50 intro__first">
                    <?php
                    $args = array(
                        'posts_per_page' => 1,
                        'post_type'      => 'post'
                    );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) { setup_postdata($post);
                    ?>
                        <a href="<?php the_permalink(); ?>" class="intro__item">
                            <div class="intro__img">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            </div>
                            <div class="intro__title"><?php the_title(); ?></div>
                            <div class="intro__description"><?php the_excerpt(); ?></div>
                            <div class="blog__date">
                                <?php the_date(); ?>
                                <span class="arrow__right"></span>
                            </div>
                        </a>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="col-50 d-flex flex-col jcsb intro__second">
                    <?php
                    $args = array(
                        'posts_per_page' => 2,
                        'post_type'      => 'post',
                        'offset'         => 1
                    );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) { setup_postdata($post);
                    ?>
                        <a href="<?php the_permalink(); ?>" class="intro__item">
                            <div class="intro__title"><?php the_title(); ?></div>
                            <div class="intro__description"><?php the_excerpt(); ?></div>
                            <div class="blog__date">
                                <?php the_date(); ?>
                                <span class="arrow__right"></span>
                            </div>
                        </a>
                        <div class="intro__sep"></div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

    <section class="news">
        <div class="container">
            <div class="news__content d-flex flex-wrap jcsb">
                <?php
                $offset = 3 + 6 * ($paged - 1);
                $args = array(
                    'posts_per_page' => 6,
                    'post_type'      => 'post',
                    'offset'         => $offset
                );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) { setup_postdata($post);
                ?>
                    <a href="<?php the_permalink(); ?>" class="blog__item">
                        <div class="blog__img">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="blog__title"><?php the_title(); ?></div>
                        <div class="blog__excerpt"><?php the_excerpt(); ?></div>
                        <div class="blog__date">
                            <?php the_date(); ?>
                            <span class="arrow__right"></span>
                        </div>
                    </a>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
            <?php
                $total_post_count = wp_count_posts();
                $published_post_count = $total_post_count->publish;
                $total_pages = ceil( ($published_post_count - 3) / 6 );
            ?>
            <div class="cases-nav">
                <?php 
                for ( $i = 1; $i <= $total_pages; $i++ ) {
                ?>
                    <?php if ( $i == 1 ) { ?>
                        <a href="/blog/page/<?php echo $paged - 1; ?>" class="cases-nav-item prev <?php if ( $paged == 1 ) { echo 'disabled'; } ?>"></a>
                    <?php } ?>
                    <a href="/blog/page/<?php echo $i; ?>" class="cases-nav-item <?php if ( $i == $paged ) { echo 'active'; } ?>"><?php echo $i; ?></a>
                    <?php if ( $i == $total_pages ) { ?>
                        <a href="/blog/page/<?php echo $paged + 1; ?>" class="cases-nav-item next <?php if ( $paged == $total_pages ) { echo 'disabled'; } ?>"></a>
                    <?php } ?>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>