<section class="log-counter-testimonial-section pt-130 pb-100 position-relativev tx-section">
    <div class="log-counter-testimonial-content d-flex align-items-end">
        <div class="log-counter-content-6 d-flex position-relative" data-background="<?php echo esc_url($settings['count_bg_image']['url']) ? esc_url($settings['count_bg_image']['url']) : ''; ?>">
            <div class="background_overlay"></div>

            <?php foreach($settings['count_boxs'] as $list ) : ?>
            <div class="counter-item-6">

                <?php if(!empty( $list['count_icon'] )) : ?>
                <div class="item-icon">
                    <?php \Elementor\Icons_Manager::render_icon( $list['count_icon'], [ 'aria-hidden' => 'true' ] );?>
                </div>
                <?php endif; ?>

                <div class="item-text text-uppercase headline-2 pera-content">
                    <?php if(!empty( $list['count_number'] )) : ?>
                    <h3>
                        <span class="counter"><?php echo esc_html($list['count_number']); ?></span><?php echo esc_html($list['count_prefix']); ?>
                    </h3>
                    <?php endif; ?>

                    <?php if(!empty( $list['count_title'] )) : ?>
                    <p><?php echo elh_element_kses_intermediate($list['count_title']); ?></p>
                    <?php endif; ?>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="log-testimonial-wrap-6 position-relative">
            <div class="log-testimonial-slider-wrap-4  position-relative">
                <div class="log-testimonial-slider-4 swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['testimonial_lists'] as $list) : ?>
                        <div class="swiper-slide">
                            <div class="log-testimonial-item-4 justify-content-between d-flex">
                                <div class="log-testimonial-text">
                                    <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                    <div class="quote-icon">
                                        <?php if( $list['type'] === 'quote' ) : ?>
                                            <?php \Elementor\Icons_Manager::render_icon( $list['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( $list['quote_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['quote_image']['url'] ); } ?>">
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['comment'] )) : ?>
                                    <div class="log-testimonial-desc">
                                        <?php echo elh_element_kses_intermediate($list['comment']); ?>
                                    </div>
                                    <?php endif; ?>

                                    <div class="log-testi-author position-relative  headline-2 d-flex justify-content-end">
                                        <div class="inner-text">
                                            <?php if(!empty( $list['name'] )) : ?>
                                            <h3 class="text-uppercase"><?php echo elh_element_kses_intermediate($list['name']); ?></h3>
                                            <?php endif; ?>

                                            <?php if(!empty( $list['designation'] )) : ?>
                                            <span><?php echo elh_element_kses_intermediate($list['designation']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if(!empty( $list['author_image']['url'] )) : ?>
                                <div class="log-testimonial-img position-relative">
                                    <div class="item-img">
                                        <img
                                        src="<?php echo esc_url($list['author_image']['url']); ?>"
                                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['author_image']['url'] ); } ?>">
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if( $settings['enable_slide_pagination'] === 'yes' ) : ?>
            <div class="log-testi-slider-nav-5 position-absolute">
                <div class="log-test-prev-4 testi-nav"><i class="fal fa-long-arrow-up"></i></div>
                <div class="log-test-pagination-4"></div>
                <div class="log-test-next-4 testi-nav"><i class="fal fa-long-arrow-down"></i></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>