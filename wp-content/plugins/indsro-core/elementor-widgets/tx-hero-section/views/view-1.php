<section id="log-banner-6" class="log-banner-section-6 txt_item_active position-relative">

    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-banner-img-6 img-parallax position-absolute">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="log-banner-image-6 position-absolute ">
        <img src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>


    <?php if(!empty( $settings['image_3']['url'] )) : ?>
    <div class="log-banner-box-6 position-absolute">
        <img src="<?php echo esc_url($settings['image_3']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_4']['url'] )) : ?>
    <div class="log-banner-shape-6 log-circle position-absolute">
        <img src="<?php echo esc_url($settings['image_4']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="log-banner-text-img-6 position-relative">
            <div class="log-banner-text-6 headline-2 pera-content log-text">
                <?php if(!empty( $settings['sub_title'] )) : ?>
                <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                    <?php echo elh_element_kses_intermediate($settings['sub_title']); ?>
                </div>
                <?php endif; ?>

                <?php
                    $this->add_render_attribute( 'title', 'class', 'tx-title banner_title txt-banner-title banner-title-text' );
                    if($settings['enable_title'] === 'yes') {
                        printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            elh_element_kses_basic( $settings['title'] )
                        );
                    }
                ?>
                <?php if(!empty( $settings['description'] )) : ?>
                <p class="tx-description">
                    <?php echo elh_element_kses_intermediate($settings['description']); ?>
                </p>
                <?php endif; ?>

                <?php if( $settings['enable_button'] === 'yes' ) : ?>
                <div class="log-btn-4 text-uppercase wow fadeInUp" data-wow-delay="700ms" data-wow-duration="1000ms">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                        target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                        rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                        <span><?php echo esc_attr($settings['button_text']); ?></span>
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
    </div>
</section>