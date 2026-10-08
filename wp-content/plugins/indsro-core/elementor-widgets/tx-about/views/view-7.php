<section id="log-about-5" class="log-about-section-5 pt-140 pb-100 position-relative">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <span class="about-circle position-absolute appear_bottom">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <span class="about-side-img position-absolute appear_right">
        <img
            src="<?php echo esc_url($settings['image_2']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <div class="log-about-content-5 d-flex">
        <div class="log-about-img-wrap-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="log-about-img-client-5">
                        <?php if(!empty( $settings['image_3']['url'] )) : ?>
                        <div class="client-count">
                            <img
                            src="<?php echo esc_url($settings['image_3']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $settings['image_4']['url'] )) : ?>
                        <div class="item-img-1 log-image-appear1">
                            <img class="log-img-rvl_1"
                                src="<?php echo esc_url($settings['image_4']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="log-about-img-exp-5">
                        <?php if(!empty( $settings['image_5']['url'] )) : ?>
                        <div class="item-img-1 log-image-appear2">
                            <img class="log-img-rvl_2"
                                src="<?php echo esc_url($settings['image_5']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_5']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if( $settings['enable_count_box'] === 'yes' ) : ?>
                        <div class="about-exp position-relative headline-2 headline" data-background="<?php echo esc_url($settings['count_bg_image']['url']) ? esc_url($settings['count_bg_image']['url']) : '' ?>">
                            <h3>
                                <span class="counter"><?php echo esc_html($settings['count_number']); ?></span><?php echo esc_html($settings['count_prefix']); ?>
                            </h3>
                            <?php if(!empty( $settings['count_title'] )) : ?>
                            <p>
                                <?php echo elh_element_kses_intermediate( $settings['count_title'] ); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="log-about-text-5 pt-30">
            <div class="log-section-title-4 headline-2 pera-content log-text">

                <?php if(!empty( $settings['enable_sub_title'] )) : ?>
                <div class="subtitle text-uppercase wow fadeInRight tx-subTitle" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
                </div>
                <?php endif; ?>

                <?php
                    $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
                    if($settings['enable_title'] === 'yes') {
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
            <div class="log-about-feature-5 mt-30 mb-50">
                <?php foreach($settings['feature_boxs'] as $list ) : ?>
                <div class="about-ft-item-5 headline-2 pera-content top_view">

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
                    <h3><?php echo elh_element_kses_intermediate( $list['list_title'] ); ?></h3>
                    <?php endif; ?>

                    <?php if(!empty( $list['list_description'] )) : ?>
                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if( $settings['enable_button'] === 'yes' ) : ?>
            <div class="log-btn-5 text-uppercase top_view">
                <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                    target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                    <span> <?php echo esc_html($settings['button_text']); ?> </span>
                    <?php
                        if(!empty( $settings['enable_button_icon'] === 'yes') ) {
                            \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                        }
                    ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>