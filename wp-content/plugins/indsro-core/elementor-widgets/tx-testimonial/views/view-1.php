<div class="fti-testimonial-4-area bg-default tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container fti-container-3">
        <div class="fti-testimonial-4-wrap">
            <!-- left -->
            <div class="fti-testimonial-4-left">
                <?php if(!empty( $settings['sub_title'] )) : ?>
                <h5 class="fti-heading-3 title"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></h5>
                <?php endif; ?>

                <?php if( $settings['enable_author_box'] === 'yes' ) : ?>
                <div class="customer">
                    <div class="customer-img-wrap">
                        <?php foreach ( $settings['author_images'] as $key => $brand ) :
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
                        <div class="customer-img">
                            <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if(!empty( $settings['author_text'] )) : ?>
                    <h6 class="fti-heading-3 customer-text">
                        <?php echo elh_element_kses_intermediate($settings['author_text']); ?>
                    </h6>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
                <!-- slider -->
            <div class="fti-testimonial-4-slider">
                <div class="swiper-container fti_testimonial_4_active fix">
                    <div class="swiper-wrapper">

                        <?php foreach($settings['testimonial_lists'] as $list) : ?>
                        <div class="swiper-slide">
                            <div class="fti-testimonial-4-item">
                                <?php if(!empty( $list['author_image']['url'] )) : ?>
                                <div class="customer-img">
                                    <img
                                    src="<?php echo esc_url($list['author_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['author_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                                <div class="content">
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
                                    <blockquote class="fti-heading-3 blockquote">
                                        <?php echo elh_element_kses_intermediate($list['comment']); ?>
                                    </blockquote>
                                    <?php endif; ?>

                                    <div class="customer-info">
                                        <?php if(!empty( $list['name'] )) : ?>
                                        <h5 class="name fti-heading-3"><?php echo elh_element_kses_intermediate($list['name']); ?></h5>
                                        <?php endif; ?>

                                        <?php if(!empty( $list['designation'] )) : ?>
                                        <span class="designation"><?php echo elh_element_kses_intermediate($list['designation']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- slider navigation -->
                    <?php if( $settings['enable_slide_pagination'] === 'yes' ) : ?>
                    <div class="fti-testimonial-4-navigation-wrap">
                        <div class="fti-testimonial-4-prev">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </div>
                        <div class="fti-testimonial-4-next">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>