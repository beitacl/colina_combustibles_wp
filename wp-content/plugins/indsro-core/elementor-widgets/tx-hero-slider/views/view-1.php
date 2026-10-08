<div class="fti-hero-3-area fix">
    <?php if( $settings['enable_left_side_info'] === 'yes' ) : ?>
    <div class="fti-hero-3-action">
        <?php if( $settings['enable_social_links'] === 'yes' ) : ?>
        <div class="social-media">
            <?php foreach($settings['social_links'] as $list ) : ?>
            <a aria-label="Social Link"
            href="<?php echo esc_url($list['social_link']['url']) ?>"
            target="<?php echo esc_attr( $list['social_link']['is_external'] ? '_blank' : '_self' ); ?>"
            rel="<?php echo esc_attr( $list['social_link']['nofollow'] ? 'nofollow' : '' ); ?>" class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $list['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if( $settings['enable_email_info'] === 'yes' ) :
            if($settings['email_link_type'] === 'email') {
                $link_url = 'mailto:' . $settings['contact_email_info_text'];
            } elseif( $settings['email_link_type'] === 'phone' ) {
                $link_url = 'tel:' . $settings['contact_email_info_text'];
            } else {
                $link_url = $settings['contact_email_info_text'];
            }
        ?>
        <div class="email">
            <?php if(!empty( $settings['contact_email_info_text'] )) : ?>
            <a href="<?php echo esc_url($link_url); ?>">
                <?php echo elh_element_kses_intermediate( $settings['contact_email_info_label'] ); ?>
                <?php echo elh_element_kses_intermediate( $settings['contact_email_info_text'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if( $settings['enable_phone_info'] === 'yes' ) :
            if($settings['link_type'] === 'email') {
                $link_url = 'mailto:' . $settings['contact_info_text'];
            } elseif( $settings['link_type'] === 'phone' ) {
                $link_url = 'tel:' . $settings['contact_info_text'];
            } else {
                $link_url = $settings['contact_info_text'];
            }
        ?>
        <div class="call">
            <?php if(!empty( $settings['contact_info_text'] )) : ?>
            <a href="<?php echo esc_url($link_url); ?>">
                <?php echo elh_element_kses_intermediate($settings['contact_info_label'] ); ?>
                <?php echo elh_element_kses_intermediate($settings['contact_info_text'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- slider  -->
    <div class="fti-hero-3-slider">
        <div class="swiper-container fti_hero_3_active">
            <div class="swiper-wrapper">
                <?php foreach ( $settings['slides'] as $slide ) : ?>
                <div class="swiper-slide">
                    <div class="fti-hero-3-item">

                        <?php if(!empty( $slide['image_1']['url'] )) : ?>
                        <div class="main-bg img-cover">
                            <img
                            src="<?php echo esc_url($slide['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $slide['image_2']['url'] )) : ?>
                        <div class="overlay">
                            <img
                            src="<?php echo esc_url($slide['image_2']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_2']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                        <!-- content -->
                        <div class="container fti-container-7">
                            <div class="fti-hero-3-wrap">
                                <?php if(!empty( $slide['sub_title'] )) : ?>
                                <h5 class="fti-subtitle-4 hero-3-subtitle tx-subTitle"><?php echo elh_element_kses_intermediate( $slide['sub_title'] ); ?></h5>
                                <?php endif; ?>

                                <?php
                                    if (!empty($slide['title'])) {
                                        $this->add_render_attribute('title', 'class', 'tx-title fti-hero-3-title fti-heading-3');
                                        $title = elh_element_kses_intermediate($slide['title']);
                                        $span = '
                                            <span class="title-overley-wrap">
                                                <span class="title-overley"></span>
                                                <span class="title-overley"></span>
                                                <span class="title-overley"></span>
                                                <span class="title-overley"></span>
                                            </span>';
                                        printf(
                                            '<%1$s %2$s>%3$s %4$s</%1$s>',
                                            tag_escape($slide['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            $title,
                                            $span
                                        );
                                    }
                                ?>

                                <?php if(!empty( $slide['description'] )) : ?>
                                <p class="tx-description fti-para-3 disc mt-30">
                                    <?php echo elh_element_kses_intermediate( $slide['description'] ); ?>
                                </p>
                                <?php endif; ?>

                                <?php if(!empty( $slide['button_text'] )) : ?>
                                <div class="btn-wrap">
                                    <a class="fti-btn-pr-4 tx-button"
                                        href="<?php echo esc_url($slide['button_link']['url']); ?>"
                                        target="<?php echo esc_attr($slide['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                        rel="<?php echo esc_attr($slide['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                        <span class="btn-text"><?php echo esc_html( $slide['button_text'] ); ?></span>
                                        <?php if(!empty( $slide['button_icon'] )) : ?>
                                        <span class="btn-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $slide['button_icon'], [ 'aria-hidden' => 'true' ] );?>
                                        </span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
            <!-- slider navigator -->
            <div class="fti-hero-3-navigation-btn">
                <div class="fti-hero-3-prev">
                    <span class="icon-1">
                        <i class="fa-light fa-arrow-left-long"></i>
                    </span>
                </div>
                <div class="fti-hero-3-next">
                    <span class="icon-1">
                        <i class="fa-light fa-arrow-right-long"></i>
                    </span>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>