<?php
/**
 * Block Name: Blog
 */
?>

<section class="blog">
    <div class="container">
        <div class="row">
            <div class="col-50 d-flex flex-col">
                <a href="/blog" class="main__title"><?php the_field('title'); ?></a>
                <?php
                $args = array(
                    'posts_per_page' => 2,
                    'post_type'      => 'post',
                    'offset'         => 3
                );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) { setup_postdata($post);
                ?>
                    <a href="<?php the_permalink($post->ID); ?>" class="blog__short-item only-md">
                        <div class="blog__date"><?php echo get_the_date('', $post->ID); ?></div>
                        <div class="blog__short-title"><?php echo get_the_title($post->ID); ?><span></span></div>
                    </a>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="col-50">
                <div class="row blog__content flex-wrap jcfe">
                    <?php
                    $args = array(
                        'posts_per_page' => 3,
                        'post_type'      => 'post'
                    );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) { setup_postdata($post);
                    ?>
                        <div class="col-50">
                            <a href="<?php the_permalink($post->ID); ?>" class="blog__item">
                                <div class="blog__img">
                                    <img data-src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo get_the_title($post->ID); ?>">
                                </div>
                                <div class="blog__title"><?php echo get_the_title($post->ID); ?></div>
                                <div class="blog__excerpt"><?php the_excerpt($post->ID); ?></div>
                                <div class="blog__date">
                                    <?php echo get_the_date('', $post->ID); ?>
                                    <span class="arrow__right"></span>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
                $args = array(
                    'posts_per_page' => 2,
                    'post_type'      => 'post',
                    'offset'         => 3
                );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) { setup_postdata($post);
                ?>
                    <a href="<?php the_permalink($post->ID); ?>" class="blog__short-item only-xs">
                        <div class="blog__date"><?php echo get_the_date('', $post->ID); ?></div>
                        <div class="blog__short-title"><?php echo get_the_title($post->ID); ?><span></span></div>
                    </a>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>