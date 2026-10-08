<div class="fti-hero-2-area fix bg-default" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <!-- circle shape  -->
    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="shape-1">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="fti-hero-2-slider">
        <div class="swiper-container fti_hero_2_active">
            <div class="swiper-wrapper">

                <?php foreach ( $settings['slides'] as $slide ) : ?>
                <div class="swiper-slide">
                    <div class="fti-hero-2-item">
                        <?php if(!empty( $slide['image_1']['url'] )) : ?>
                        <div class="main-shape img-cover">
                            <img
                            src="<?php echo esc_url($slide['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <!-- content -->
                        <div class="container fti-container-3">
                            <div class="fti-hero-2-wrap">
                                <div class="fti-hero-2-left">
                                    <?php if(!empty( $slide['sub_title'] )) : ?>
                                    <h5 class="fti-subtitle-3 hero-2-subtitle">
                                        <span class="line has-black"></span>
                                        <?php echo elh_element_kses_intermediate( $slide['sub_title'] ); ?>
                                    </h5>
                                    <?php endif;
                                        $this->add_render_attribute( 'title', 'class', 'tx-title fti-hero-2-title hero-2-title' );
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($slide['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            elh_element_kses_basic( $slide['title'] )
                                        );
                                    ?>

                                    <?php if(!empty( $slide['description'] )) : ?>
                                    <p class="fti-para-2 disc mt-20"><?php echo elh_element_kses_intermediate( $slide['description'] ); ?></p>
                                    <?php endif; ?>

                                    <?php if(!empty( $slide['button_text'] )) : ?>
                                    <div class="btn-wrap">
                                        <a href="<?php echo esc_url($slide['button_link']['url']); ?>"
                                            target="<?php echo esc_attr($slide['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                            rel="<?php echo esc_attr($slide['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-3">
                                            <span class="btn-text"><?php echo esc_html( $slide['button_text'] ); ?></span>

                                            <?php if(!empty( $slide['button_icon'] )) : ?>
                                            <span class="btn-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $slide['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );?>
                                            </span>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="fti-hero-2-right">
                                    <?php if(!empty( $slide['image_2']['url'] )) : ?>
                                    <div class="main-img">
                                        <img
                                        src="<?php echo esc_url($slide['image_2']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_2']['url'] ); } ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $settings['image_3']['url'] )) : ?>
                                    <div class="img-shape-1">
                                        <img
                                        src="<?php echo esc_url($settings['image_3']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>

            </div>

            <!-- pagination & navigator -->
            <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
            <div class="fti-hero-2-pagination-btn">
                <div class="fti-hero-2-pagination"></div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- client logo marquee -->
    <?php if( $settings['enable_brands'] === 'yes' ) : ?>
    <div class="fti-hero-2-marquee-wrap">
        <div class="fti-hero-2-marquee">
            <div class="logo-wrap">
                <?php foreach ( $settings['brands_image'] as $key => $brand ) :
                    if (!empty($brand['url'])) {
                        $brand_image = $brand['url'];
                    }

                    // alt
                    if (!empty($brand['alt'])) {
                        $brand_alt = $brand['alt'];
                    } else {
                        $brand_alt = '';
                    }
                ?>
                <div class="logo">
                    <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>