<div class="fti-services-1-area tx-section m-0">
    <!-- slider -->
    <div class="fti-services-1-slider m-0">
        <div class="swiper-container fix fti_services_1_active">
            <div class="swiper-wrapper">

                <?php foreach($settings['service_lists'] as $list ) : ?>
                <div class="swiper-slide">
                    <div class="fti-services-1-item fix">

                        <?php if(!empty( $settings['image_1']['url'] )) : ?>
                        <img class="fti-services-1-shape-1"
                        src="<?php echo esc_url($settings['image_1']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
                        <?php endif; ?>

                        <?php if(!empty( $settings['image_2']['url'] )) : ?>
                        <img class="fti-services-1-shape-2"
                        src="<?php echo esc_url($settings['image_2']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                        <?php endif; ?>

                        <?php if(!empty( $list['title'] )) : ?>
                        <h5 class="fti-heading-1 title">
                            <a href="<?php echo esc_url($list['button_link']['url']); ?>"
                                target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                <?php echo elh_element_kses_intermediate( $list['title'] ); ?>
                            </a>
                        </h5>
                        <div class="services-1-divider"></div>
                        <?php endif; ?>

                        <?php if(!empty( $list['description'] )) : ?>
                        <p class="fti-para-1-small disc"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                        <?php endif; ?>
                        <div class="img-wrap">
                            <?php if(!empty( $list['service_icon'] )) : ?>
                            <span class="icon-1">
                                <?php \Elementor\Icons_Manager::render_icon( $list['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php if(!empty( $list['image_1']['url'] )) : ?>
                            <a href="<?php echo esc_url($list['button_link']['url']); ?>"
                            target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                            <img
                            src="<?php echo esc_url($list['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

            <!-- navigation -->
            <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
            <div class="fti-services-1-navigation">
                <div class="fti_services_1_prev">
                    <i class="flaticon-right-up"></i>
                </div>
                <div class="fti_services_1_next">
                    <i class="flaticon-right-up"></i>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- btn -->
     <?php if( $settings['enable_button'] === 'yes' ) : ?>
    <div class="container">
        <div class="fti-services-1-btn-wrap">
            <div class="fti-services-1-btn-divider-1 subtitle-line-1"></div>
            <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
            rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-1 tx-button">
                <?php
                    if($settings['enable_button_icon'] === 'yes') {
                        \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );
                    }
                ?>
                <span class="btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
                <?php
                    if($settings['enable_button_icon'] === 'yes') {
                        \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );
                    }
                ?>
            </a>
            <div class="fti-services-1-btn-divider-2 subtitle-line-2"></div>
        </div>
    </div>
    <?php endif; ?>

</div>