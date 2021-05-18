<?php
/**
 * Block Name: Documents
 */
?>

<section class="docs">
    <div class="container">
        <div class="row">
            <div class="col-30">
                <h2 class="main__title"><?php the_field('title'); ?></h2>
            </div>
            <div class="col-40">
                <div class="docs__content">
                    <?php
                    $args = array(
                        'posts_per_page' => 3,
                        'post_type'      => 'document'
                    );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) { setup_postdata($post);
                    ?>
                        <a href="<?php the_permalink($post->ID); ?>" class="docs__link"><?php echo get_the_title($post->ID); ?></a>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                    <a href="/documents/" class="docs__hint">
                        То, о чем вы боялись спросить про сертификацию
                        <span class="arrow__right"></span>
                    </a>
                </div>
            </div>
            <div class="col-30 d-flex flex-col">
                <div class="docs__title"><?php the_field('title_left'); ?></div>
                <div class="docs__description"><?php the_field('description_left'); ?></div>
            </div>
        </div>
    </div>
</section>