<section class="log-service-testimonial-section-4 position-relative pt-130 tx-section">

    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-ser-test-bg position-absolute img-parallax">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
        <div class="background_overlay"></div>
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="log-service-side-img appear_top position-absolute">
        <img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="log-service-wrap-4 pb-135 position-relative">
        <div class="container">
            <div class="log-service-content-4 position-relative d-flex">
                <div class="log-service-text-4">
                    <div class="log-section-title-3 headline-2 pera-content log-text">
                        <?php if(!empty( $settings['enable_sub_title'] )) : ?>
                        <div class="subtitle text-uppercase wow fadeInRight tx-subTitle" data-wow-delay="300ms" data-wow-duration="1000ms">
                            <span><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></span>
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

                    <?php if( $settings['enable_button'] === 'yes' ) : ?>
                    <div class="log-btn-3 mt-45 text-uppercase wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
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
                <div class="log-service-slider-for swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
                        <div class="swiper-slide">
                            <div class="log-service-item-wrap-4">
                                <div class="log-service-item-4 position-relative" data-background="<?php echo $list['shape_image']['url'] ? esc_url($list['shape_image']['url']) : ''; ?>">

                                    <?php if(!empty( $lsit['service_icon'] )) : ?>
                                    <div class="item-icon position-relative">
                                        <?php \Elementor\Icons_Manager::render_icon( $lsit['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                    <?php endif; ?>

                                    <div class="item-text  headline-2 pera-content">
                                        <?php if(!empty( $lsit['title'] )) : ?>
                                        <h3 class="ser_title href-underline">
                                            <a
                                            href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                            target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                            rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                            aria-label="name">
                                                <?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
                                            </a>
                                        </h3>
                                        <?php endif; ?>

                                        <?php if(!empty( $lsit['description'] )) : ?>
                                        <p>
                                            <?php echo elh_element_kses_intermediate( $lsit['description'] ); ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if(!empty( $lsit['button_text'] )) : ?>
                                        <a class="read_more"
                                            href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                            target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                            rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                            aria-label="name">
                                            <?php \Elementor\Icons_Manager::render_icon( $lsit['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            <?php echo elh_element_kses_intermediate( $lsit['button_text'] ); ?>
                                        </a>
                                        <?php endif; ?>

                                    </div>
                                </div>

                                <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                                <div class="log-service-img-4">
                                    <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
                <div class="log-ser-slider-nav-4 position-absolute d-flex align-items-center justify-content-center">
                    <div class="log-ser-prev-4 d-flex align-items-center justify-content-center"><i class="fal fa-long-arrow-left"></i></div>
                    <div class="log-ser-next-4 d-flex align-items-center justify-content-center"><i class="fal fa-long-arrow-right"></i></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>