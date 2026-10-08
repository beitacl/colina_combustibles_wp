<div class="fti-hero-5-area">
    <div class="fti-hero-5-slider">
        <div class="swiper-container fti_hero_5_active">
            <div class="swiper-wrapper">
                <!-- item -->
                <?php foreach ( $settings['slides'] as $slide ) : ?>
                <div class="swiper-slide">
                    <div class="fti-hero-5-item">
                        <?php if( $settings['enable_overley_shape'] === 'yes' ) : ?>
                        <div class="bg-overley-wrap">
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                            <div class="overley-item"></div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $slide['image_1']['url'] )) : ?>
                        <div class="main-bg img-cover">
                            <img
                            src="<?php echo esc_url($slide['image_1']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $slide['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                        <!-- content -->
                        <div class="container fti-container-8">
                            <div class="fti-hero-5-wrap">
                                <?php if(!empty( $slide['sub_title'] )) : ?>
                                <div class="subtitle-wrap">
                                    <h5 class="fti-subtitle-5"><?php echo elh_element_kses_intermediate( $slide['sub_title'] ); ?></h5>
                                </div>
                                <?php endif; ?>

                                <div class="title-wrap">
                                    <?php
                                        $this->add_render_attribute( 'title', 'class', 'tx-title fti-hero-5-title' );
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($slide['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            elh_element_kses_basic( $slide['title'] )
                                        );
                                    ?>
                                </div>

                                <?php if(!empty( $slide['description'] )) : ?>
                                <div class="disc-wrap">
                                    <p class="tx-description fti-para-4 disc">
                                        <?php echo elh_element_kses_intermediate( $slide['description'] ); ?>
                                    </p>
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $slide['button_text'] )) : ?>
                                <div class="btn-wrap">
                                    <a class="fti-btn-pr-6"
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

            <!-- slider navigator and pagination -->
            <?php if( $settings['enable_slider_navigation'] === 'yes' ) : ?>
            <div class="fti-hero-5-navigation-btn">
                <div class="fti-hero-5-prev">
                    <span class="icon-1">
                        <i class="fa-light fa-arrow-left-long"></i>
                    </span>
                </div>
                <div class="fti-hero-5-next">
                    <span class="icon-1">
                        <i class="fa-light fa-arrow-right-long"></i>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if( $settings['enable_slider_pagination'] === 'yes' ) : ?>
            <div class="fti-hero-5-pagination"></div>
            <?php endif; ?>

        </div>
    </div>
</div>