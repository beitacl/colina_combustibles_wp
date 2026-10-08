<section class="log-why-choose-section-4  pt-120 position-relative tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <span class="log-side-img position-absolute appear_left">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <div class="container">
        <div class="log-why-choose-content-4 txt_item_active pb-120 d-flex position-relative">
            <?php if(!empty( $settings['image_2']['url'] )) : ?>
            <span class="log-why-choose-flot-img position-absolute appear_right">
                <img
                src="<?php echo esc_url($settings['image_2']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
            </span>
            <?php endif; ?>

            <div class="log-why-choose-text-wrap-4 pt-35">
                <div class="log-section-title-3 headline-2 pera-content log-text">

                    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                    <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                            <?php if( $settings['sub_title_icon_type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $settings['sub_title_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['list_image']['alt'] ); ?>">
                            <?php endif; ?>
                        <?php endif; ?>

                        <span><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php
                        if($settings['enable_title'] === 'yes') {
                        $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
                            printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                elh_element_kses_basic( $settings['title'] )
                            );
                        }
                    ?>

                    <?php if( $settings['enable_description'] === 'yes' ) : ?>
                    <p class="tx-description">
                        <?php echo elh_element_kses_intermediate($settings['description']); ?>
                    </p>
                    <?php endif; ?>
                </div>

                <?php if( $settings['enable_feature_boxs'] === 'yes' ) : ?>
                <div class="log-why-choose-feature d-flex  mt-25 mb-30">
                    <?php foreach($settings['feature_boxs'] as $list ) : ?>
                    <div class="wc-feature-item-4 d-flex align-items-center wow zoomIn"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <?php if( $list['enable_icon'] === 'yes' ) : ?>
                        <div class="inner-icon d-flex justify-content-center align-items-center">
                            <?php if( $list['type'] === 'icon' ) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['list_title'] )) : ?>
                        <div class="inner-text">
                            <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['list_description'] )) : ?>
                        <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                </div>
                <?php endif; ?>

                <?php if( $settings['enable_progress_box'] === 'yes' ) : ?>
                <div class="log-why-choose-progress">
                    <?php foreach($settings['progress_boxes'] as $list) : ?>
                    <div class="skill-set-percent headline-2">
                        <?php if(!empty( $list['progress_title'] )) : ?>
                        <h4 class="text-uppercase"><?php echo elh_element_kses_intermediate($list['progress_title']); ?></h4>
                        <?php endif; ?>

                        <?php if(!empty( $list['progress_value']['size'] )) : ?>
                        <div class="progress">
                            <div class="progress-bar"
                                data-percent="<?php echo $list['progress_value']['size'] ? esc_attr($list['progress_value']['size']) : ''; ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="log-btn-3 mt-40 text-uppercase">
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                        <span>
                            <?php echo esc_html($settings['button_text']); ?>
                            <?php
                                if(!empty( $settings['enable_button_icon'] === 'yes') ) {
                                    \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                                }
                            ?>
                        </span>
                    </a>
                </div>
                <?php endif; ?>

            </div>
            <div class="log-why-choose-img-wrap-4 d-flex align-items-center">
                <?php if(!empty( $settings['image_3']['url'] )) : ?>
                <div class="why-choose-img-1">
                    <div class="item-img log-image-appear1">
                        <img class="log-img-rvl_1"
                        src="<?php echo esc_url($settings['image_3']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                    </div>
                </div>
                <?php endif; ?>
                <div class="why-choose-img-2">

                    <?php if(!empty( $settings['image_4']['url'] )) : ?>
                    <div class="item-img log-image-appear2">
                        <img class="log-img-rvl_2"
                        src="<?php echo esc_url($settings['image_4']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $settings['image_5']['url'] )) : ?>
                    <div class="item-img log-image-appear3">
                        <img class="log-img-rvl_3"
                        src="<?php echo esc_url($settings['image_5']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_5']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>