<div class="footer-blog-item-wrap">
    <?php
        if (!empty($posts)):
        foreach ( $posts as $inx => $post ):
        $title = $post->post_title;

        if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_title ) ) {
            $title = $customize_title[$post->ID];
        }

        $excerpt = $post->post_excerpt;
        if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_text ) ) {
            $excerpt = $customize_text[$post->ID];
        }

        $thumb = get_the_post_thumbnail_url( $post->ID, 'large' );
        if ( 'selected' === $settings['show_post_by'] && array_key_exists( $post->ID, $customize_img ) && !empty( $customize_img[$post->ID]['url'] ) ) {
            $thumb = $customize_img[$post->ID]['url'];
        }

        $author_name = get_the_author_meta( 'display_name', $post->post_author );
        // aythor image
        $author_img = get_avatar_url( $post->post_author, array( 'size' => 50 ) );
        $author_link = get_author_posts_url( $post->post_author );

        // get post categories
        $categories = get_the_category( $post->ID );
        $cat_name = '';

        if ( !empty( $categories ) ) {
            $cat_name = $categories[0]->name;
        }
        $post_by_label = $settings['post_by_label'];

    ?>
    <div class="footer-blog-item-single">
        <?php if(!empty( $thumb && $settings['feature_image'] === 'yes' )) : ?>
        <div class="img-wrap">
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
        </div>
        <?php endif; ?>

        <div class="content-wrap">
            <a class="h1-heading" href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
            <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['date_meta'] ): ?>
            <span class="date"><i class="fal fa-clock"></i> <?php echo esc_html( get_the_date( get_option( 'date_format' ), $post->ID ) ); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach;
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'indsro-core'),
                esc_html($settings['post_type']),
                __('Found', 'indsro-core')
            );
        endif;
    ?>
</div>