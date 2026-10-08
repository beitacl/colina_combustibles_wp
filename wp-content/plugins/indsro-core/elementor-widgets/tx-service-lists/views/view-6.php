<div class="fti-services-2-area tx-section">
    <?php if(!empty( $settings['big_title'] )) : ?>
    <h2 class="highligt-text fti-heading-2"><?php echo elh_element_kses_intermediate( $settings['big_title'] ); ?></h2>
    <?php endif; ?>
    <div class="fti-services-2-wrap">
        <div class="fti-services-2-slider">
            <!-- title -->
            <div class="title-wrap">
                <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                <h5 class="fti-subtitle-3 tx-subTitle">
                    <span class="line subtitle-line-1"></span>
                    <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
                </h5>
                <?php
                endif;
                    if($settings['enable_title'] === 'yes') {
                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-section-title-3 fti-split-text fti-split-in-right-3' );
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
            </div>
            <!-- slider -->
            <div class="swiper-container fix fti_services_2_active">
                <div class="swiper-wrapper">

                    <?php foreach($settings['service_lists'] as $list ) : ?>
                    <div class="swiper-slide">
                        <div class="fti-services-2-item">
                            <?php if(!empty( $list['image_1']['url'] )) : ?>
                            <div class="main-img img-cover">
                                <img src="<?php echo esc_url($list['image_1']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>
                            <div class="content">
                                <?php if(!empty( $list['image_2']['url'] )) : ?>
                                <div class="content-bg">
                                    <img src="<?php echo esc_url($list['image_2']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_2']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $list['service_icon'] )) : ?>
                                <div class="icon-wrap">
                                    <span class="icon-1">
                                        <?php \Elementor\Icons_Manager::render_icon( $list['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                    <div class="divider"></div>
                                </div>
                                <?php endif; ?>
                                <div class="title-wrap">
                                    <?php if(!empty( $list['title'] )) : ?>
                                    <h5 class="fti-heading-2 title"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h5>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['description'] )) : ?>
                                    <p class="fti-para-2 disc"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if(!empty( $list['button_text'] )) : ?>
                                <div class="btn-wrap">
                                    <a class="services-2-btn" href="<?php echo esc_url($list['button_link']['url']); ?>"
                                        target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                        rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                        <span class="btn-text"><?php echo esc_attr($list['button_text']); ?></span>
                                        <?php if(!empty( $list['button_icon'] )) : ?>
                                        <span class="icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
                <div class="fti-services-2-navigation">
                    <div class="fti_services_2_prev">
                        <i class="flaticon-right-arrow"></i>
                    </div>
                    <div class="fti_services_2_next">
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- services end -->