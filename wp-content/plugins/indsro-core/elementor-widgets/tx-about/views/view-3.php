<div class="fti-about-1-area fti-class-add tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="fix fti-about-1-hand-img-wrap">
        <img class="fti-about-1-hand-img"
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
        <img class="fti-about-1-shape-1"
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    <?php endif; ?>

    <div class="container fti-container-2">
        <div class="fti-about-1-wrap">

            <!-- left -->
            <div class="fti-about-1-left fti-class-add">
                <?php if(!empty( $settings['image_3']['url'] )) : ?>
                <div class="img-wrap-1">
                    <img
                    src="<?php echo esc_url($settings['image_3']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_count_box'] === 'yes' ) : ?>
                <div class="exper">
                    <h3 class="fti-heading-1 number"><span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?></h3>

                    <?php if(!empty( $settings['count_title'] )) : ?>
                    <p class="fti-para-1-large title"><?php echo elh_element_kses_intermediate( $settings['count_title'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['image_4']['url'] )) : ?>
                <div class="img-wrap-2">
                    <img
                    src="<?php echo esc_url($settings['image_4']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <?php if(!empty( $settings['image_5']['url'] )) : ?>
                <div class="img-wrap-3 d-none d-xxl-block">
                    <img
                    src="<?php echo esc_url($settings['image_5']['url']); ?>"
                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_5']['url'] ); } ?>">
                </div>
                <?php endif; ?>
            </div>

            <!-- right -->
            <div class="fti-about-1-right fti-class-add">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-1 tx-subTitle"><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-1 fti-split-text fti-split-in-right-1' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
                <?php if( $settings['enable_description'] === 'yes' ) : ?>
                <p class="fti-para-1 mt-25 tx-description"><?php echo elh_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>

                <?php if( $settings['enable_feature_lists'] === 'yes' ) : ?>
                <div class="features">
                    <?php foreach( $settings['feature_lists'] as $list ) : ?>
                    <div class="feature">
                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                        <span class="icon-1">
                            <?php if( $list['type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                            <?php endif; ?>
                        </span>
                        <?php endif; ?>
                        <div class="title-wrap">
                            <?php if(!empty( $list['feature_title'] )) : ?>
                            <h5 class="fti-heading-1 title"><?php echo elh_element_kses_intermediate($list['feature_title']); ?></h5>
                            <div class="feature-divider"></div>
                            <?php endif; ?>

                            <?php if(!empty( $list['feature_description'] )) : ?>
                            <p class="fti-para-1-small disc disc"><?php echo elh_element_kses_intermediate($list['feature_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="features-divider"></div>
                <?php endif; ?>

                <div class="bottom-content">

                    <?php if( $settings['enable_button'] === 'yes' ) : ?>
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-1">
                        <?php
                            if($settings['enable_button_icon'] === 'yes') {
                                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );
                            }
                        ?>
                        <span class="btn-text">
                            <?php echo esc_html( $settings['button_text'] ); ?>
                        </span>
                        <?php
                            if($settings['enable_button_icon'] === 'yes') {
                                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );
                            }
                        ?>
                    </a>
                    <?php endif; ?>

                    <?php if( $settings['enable_author_box'] === 'yes' ) : ?>
                    <div class="customer">
                        <?php if(!empty( $settings['author_image']['url'] )) : ?>
                        <div class="img-wrap">
                            <img src="<?php echo esc_url($settings['author_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['author_image']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                        <div>
                            <?php if(!empty( $settings['author_count'] )) : ?>
                            <h5 class="fti-heading-1 number">
                                <span class="counter"><?php echo esc_html($settings['author_count']); ?></span><?php echo esc_html($settings['author_count_prefix']); ?>
                            </h5>
                            <?php endif; ?>

                            <?php if(!empty( $settings['author_title'] )) : ?>
                            <span class="fti-para-1 disc">
                                <?php echo elh_element_kses_intermediate( $settings['author_title'] ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>