<div class="fti-blog-3-area bg-default fix fti-class-add tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container fti-container-8">
        <div class="fti-blog-3-wrap">
            <!-- left -->
            <div class="fti-blog-3-left">

                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-4 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-4 has-color-white fti-split-text fti-split-in-right-4' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>

                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-3-small disc tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="btn-wrap">
                    <a class="fti-btn-pr-4 has-bg-white tx-button"
                        href="<?php echo esc_url($settings['button_link']['url']); ?>"
                        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">

                        <?php if(!empty( $settings['button_text'] )) : ?>
                        <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
                        <?php endif; ?>

                        <?php if( $settings['enable_button_icon'] === 'yes' ) : ?>
                        <span class="btn-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="fti-blog-3-right">

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
                <div class="fti-blog-3-card wow fadeInUp">

                    <?php if(!empty( $thumb && $settings['feature_image'] === 'yes' )) : ?>
                    <div class="main-img img-cover">
                        <img src="<?php echo esc_url($thumb); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text($thumb); } ?>">
                    </div>
                    <?php endif; ?>

                    <div class="meta">
                        <?php if ( 'yes' === $settings['meta'] && 'yes' === $settings['date_meta'] ): ?>
                        <span class="date fti-para-3-small"><?php echo esc_html( get_the_date( get_option( 'date_format' ), $post->ID ) ); ?></span>
                        <?php endif; ?>

                        <h5 class="title fti-heading-3">
                            <a href="<?php echo esc_url(get_the_permalink( $post->ID )); ?>"><?php echo esc_html($title); ?></a>
                        </h5>
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
</div>