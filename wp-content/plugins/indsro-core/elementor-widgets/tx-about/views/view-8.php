<section class="log-why-choose-section-5 position-relative tx-section m-0">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="wc-shape1 position-absolute appear_left">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="wc-shape2 position-absolute appear_right">
        <img
            src="<?php echo esc_url($settings['image_2']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="log-why-choose-content-5  position-relative">
        <?php if(!empty( $settings['image_3']['url'] )) : ?>
        <div class="log-wc-img1 log-image-appear3 position-absolute">
            <img class="log-img-rvl_3"
            src="<?php echo esc_url($settings['image_3']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
        </div>
        <?php endif; ?>

        <?php if(!empty( $settings['image_4']['url'] )) : ?>
        <div class="log-wc-img2 log-image-appear2 position-absolute">
            <img class="log-img-rvl_2"
            src="<?php echo esc_url($settings['image_4']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
        </div>
        <?php endif; ?>

        <div class="log-why-choose-text-5">
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
            <div class="log-about-list-6 ver_2 mt-30 ul-li position-relative">
                <?php if( $settings['enable_feature_lists'] === 'yes' ) : ?>
                <ul>
                    <?php foreach($settings['feature_lists'] as $list ) : ?>
                    <li class="wow" data-splitting="">
                        <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] );?>
                        <?php echo elh_element_kses_intermediate( $list['feature_text'] ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if( $settings['enable_feature_lists_2'] === 'yes' ) : ?>
                <ul class="list-item-2">
                    <?php foreach($settings['feature_lists_2'] as $list ) : ?>
                    <li class="wow" data-splitting="">
                        <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] );?>
                        <?php echo elh_element_kses_intermediate( $list['feature_text'] ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

            </div>
            <div class="log-about-cta-grp flex-wrap mt-45 d-flex align-items-center wow fadeInUp"  data-wow-delay="500ms" data-wow-duration="1000ms">

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="log-btn-5 text-uppercase">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                        <?php echo esc_html($settings['button_text']); ?>
                        <?php
                            if(!empty( $settings['enable_button_icon'] === 'yes') ) {
                                \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                            }
                        ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if( $settings['enable_contact_info'] === 'yes' ) :
                    if($settings['link_type'] === 'email') {
                        $link_url = 'mailto:' . $settings['contact_info_text'];
                    } elseif( $settings['link_type'] === 'phone' ) {
                        $link_url = 'tel:' . $settings['contact_info_text'];
                    } else {
                        $link_url = $settings['contact_info_text'];
                    }
                ?>
                <div class="log-about-cta d-flex align-items-center">
                    <?php if(!empty( $settings['contact_info_icon'] )) : ?>
                    <div class="inner-icon d-flex align-items-center justify-content-center">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['contact_info_icon'], [ 'aria-hidden' => 'true' ] );?>
                    </div>
                    <?php endif; ?>

                    <div class="inner-text ver_2">
                        <?php if(!empty( $settings['contact_info_label'] )) : ?>
                        <span><?php echo elh_element_kses_intermediate( $settings['contact_info_label'] ); ?></span>
                        <?php endif; ?>

                        <?php if(!empty( $settings['contact_info_text'] )) : ?>
                        <a href="<?php echo esc_url($link_url); ?>">
                            <?php echo elh_element_kses_intermediate( $settings['contact_info_text'] ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>