<div class="fti-company-5-left">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="main-img wow fadeInLeft" data-wow-delay="0.2s">
        <img
            src="<?php echo esc_url($settings['image_1']['url']); ?>"
            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="blockquote-box bg-default wow fadeInUp" data-wow-delay="0.3s">
        <div class="fti-blockquote-5-slider">
            <div class="swiper-container fti_blockquote_5_active fix">
                <div class="swiper-wrapper">
                    <!-- item -->
                    <?php foreach($settings['testimonial_lists'] as $list) : ?>
                    <div class="swiper-slide">
                        <div class="fti-blockquote-5-item">
                            <?php if( $list['enable_icon'] === 'yes' ) : ?>
                            <span class="icon">
                                <?php if( $list['type'] === 'quote' ) : ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $list['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $list['quote_image']['url'] ); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['quote_image']['url'] ); } ?>">
                                <?php endif; ?>
                            </span>
                            <?php endif; ?>

                            <?php if(!empty( $list['comment'] )) : ?>
                            <blockquote class="fti-para-4 disc"><?php echo elh_element_kses_intermediate($list['comment']); ?></blockquote>
                            <?php endif; ?>

                            <?php if(!empty( $list['name'] || $list['designation'] )) : ?>
                            <h6 class="fti-para-4 name">
                                <?php echo elh_element_kses_intermediate($list['name']); ?>
                                <?php echo elh_element_kses_intermediate($list['designation']); ?>
                            </h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- slider pagination -->
                <?php if( $settings['enable_slide_pagination'] === 'yes' ) : ?>
                <div class="fti-blockquote-5-pagination"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>