<div class="fti-blog-4-area tx-section">
    <div class="container fit-container-9">
        <div class="fti-blog-4-wrap m-0">
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
            <div class="fti-blog-4-card wow fadeInUp">
                <?php if(!empty( $thumb && $settings['feature_image'] === 'yes' )) : ?>
                <div class="main-img-wrap fix">
                    <div class="main-img img-cover">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
                    </div>
                    <div class="main-img img-cover">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
                    </div>
                </div>
                <?php endif; ?>
                <div class="content">
                    <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['date_meta'] ): ?>
                    <div class="date">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="date-text"><?php echo esc_html( get_the_date( get_option( 'date_format' ), $post->ID ) ); ?></span>
                    </div>
                    <?php endif; ?>

                    <h4 class="title">
                        <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                    </h4>

                    <?php if(!empty( $excerpt )) : ?>
                    <p class="disc">
                        <?php echo esc_html($excerpt); ?>
                    </p>
                    <?php endif; ?>

                    <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['author_meta'] ): ?>
                    <div class="auth">
                        <?php if(!empty( $author_img )) : ?>
                        <div class="auth-img">
                            <img src="<?php echo esc_url($author_img); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $author_img ); } ?>">
                        </div>
                        <?php endif; ?>
                        <h6 class="auth-name">
                            <?php echo esc_html($post_by_label . ' ' . $author_name); ?>
                        </h6>
                    </div>
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
    </div>
</div>