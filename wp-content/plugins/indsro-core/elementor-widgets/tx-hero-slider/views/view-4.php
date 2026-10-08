<div class="fti-hero-1-area fix">
    <div class="fti-hero-1-slider">
        <div class="swiper-container fti_hero_1_active">
            <div class="swiper-wrapper">

                <!-- item -->
                <?php foreach ( $settings['slides'] as $slide ) : ?>
                <div class="swiper-slide">
                    <div class="fti-hero-1-item">
                        <?php if(!empty( $settings['image_1']['url'] )) : ?>
                        <div class="angle-wrap-left">
                            <img
                            src="<?php echo esc_url($settings['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $settings['image_2']['url'] )) : ?>
                        <div class="angle-wrap-right">
                            <img
                            src="<?php echo esc_url($settings['image_2']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $slide['image_1']['url'] )) : ?>
                        <div class="bg-img">
                            <img
                            src="<?php echo esc_url($slide['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <!-- title -->
                        <div class="container">
                            <div class="fti-hero-1-title-wrap">
                                <?php
                                    $this->add_render_attribute( 'title', 'class', 'tx-title fti-heading-1 has-color-white fti-hero-1-title' );
                                    printf('<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($slide['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        elh_element_kses_basic( $slide['title'] )
                                    );
                                ?>
                                <?php if(!empty( $slide['description'] )) : ?>
                                <p class="fti-para-1-large font-xs-18 has-color-white mt-25 disc tx-description">
                                    <?php echo elh_element_kses_intermediate( $slide['description'] ); ?>
                                </p>
                                <?php endif; ?>

                                <?php if(!empty( $slide['button_text'] )) : ?>
                                <div class="btn-wrap mt-50">
                                    <a href="<?php echo esc_url($slide['button_link']['url']); ?>"
                                    target="<?php echo esc_attr($slide['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                    rel="<?php echo esc_attr($slide['button_link']['nofollow'] ? 'nofollow' : ''); ?>" class="fti-btn-pr-1 tx-button">
                                        <?php \Elementor\Icons_Manager::render_icon( $slide['button_icon'], [ 'class' => 'icon-1', 'aria-hidden' => 'true' ] );?>
                                        <span class="btn-text">
                                            <?php echo esc_html( $slide['button_text'] ); ?>
                                        </span>
                                        <?php \Elementor\Icons_Manager::render_icon( $slide['button_icon'], [ 'class' => 'icon-2', 'aria-hidden' => 'true' ] );?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- content -->
                        <?php if( $slide['enable_author_box'] === 'yes' ) : ?>
                        <div class="fti-hero-1-content">
                            <?php if(!empty( $settings['image_3']['url'] )) : ?>
                            <div class="icon-wrap">
                                <img
                                src="<?php echo esc_url($settings['image_3']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $slide['author_info'] )) : ?>
                            <p class="fti-para-1-large font-xs-18 has-color-white blockquite-text">
                                <?php echo elh_element_kses_intermediate( $slide['author_info'] ); ?>
                            </p>
                            <?php endif; ?>

                            <?php if(!empty( $slide['author_image']['url'] )) : ?>
                            <div class="img-wrap">
                                <img
                                src="<?php echo esc_url($slide['author_image']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['author_image']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- work image -->
                        <div class="fti-hero-1-work">
                            <?php if(!empty( $settings['image_4']['url'] )) : ?>
                            <div class="icon-wrap">
                                <img
                                src="<?php echo esc_url($settings['image_4']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $slide['image_2']['url'] )) : ?>
                            <div class="img-wrap">
                                <img
                                src="<?php echo esc_url($slide['image_2']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_2']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- pagination & navigator -->
            <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
            <div class="fti-hero-1-pagination-slider-btn">
                <div class="fti-hero-1-next">
                    <i class="flaticon-right-arrow"></i>
                </div>
                <div class="fti-hero-1-pagination"></div>
                <div class="fti-hero-1-prev">
                    <i class="flaticon-right-arrow"></i>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>