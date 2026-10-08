<!-- blog start -->
<div class="fti-blog-5-area p-0">
    <div class="container fti-container-8">
        <div class="fti-blog-5-wrap m-0">

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

                // get post categories
                $categories = get_the_category( $post->ID );
                $cat_name = '';

                if ( !empty( $categories ) ) {
                    $cat_name = $categories[0]->name;
                }
                $post_by_label = $settings['post_by_label'];

            ?>
            <div class="fti-blog-5-card wow fadeInUp m-0">
                <?php if(!empty( $thumb && $settings['feature_image'] === 'yes' )) : ?>
                <div class="main-img img-cover">
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
                </div>
                <?php endif; ?>
                <div class="content">
                    <div class="meta">
                        <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['category_meta'] ): ?>
                        <span class="cate"><?php echo esc_html($cat_name); ?>  - </span>
                        <?php endif; ?>

                        <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['date_meta'] ): ?>
                        <span class="date"><?php echo esc_html( get_the_date( get_option( 'date_format' ), $post->ID ) ); ?></span>
                        <?php endif; ?>
                    </div>
                    <h5 class="fti-heading-3 title">
                        <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                    </h5>
                    <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>" class="link">
                        <i class="flaticon-right-arrow"></i>
                    </a>
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
    </div>
</div>