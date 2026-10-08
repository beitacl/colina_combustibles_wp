<div class="fti-blog-1-area p-0">
    <div class="container">
        <div class="fti-blog-1-wrap">
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
            <div class="fti-blog-1-card">
                <?php if(!empty( $thumb && $settings['feature_image'] === 'yes' )) : ?>
                <div class="main-img img-cover">
                    <img src="<?php echo esc_url($thumb); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
                </div>
                <?php endif; ?>

                <div class="content-wrap">
                    <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['date_meta'] ): ?>
                    <div class="meta">
                        <span class="month">
                            <?php echo esc_html( get_the_date( 'M', $post->ID ) ); ?>
                        </span>
                        <div class="date-wrap">
                            <h5 class="fti-heading-1 date">
                                <?php echo esc_html( get_the_date( 'd', $post->ID ) ); ?>
                            </h5>
                            <span class="fti-para-1-small year">
                                <?php echo esc_html( get_the_date( 'Y', $post->ID ) ); ?>
                            </span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <h3 class="fti-heading-1 blog-title">
                        <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                    </h3>

                    <?php if(!empty( $settings['read_more_text'] )) : ?>
                    <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>" class="blog-btn">
                        <?php if(!empty( $settings['read_more_text'] )) : ?>
                        <span class="btn-text"><?php echo esc_html($settings['read_more_text']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty( $settings['read_more_icon'] )) : ?>
                        <span class="icon-1">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
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