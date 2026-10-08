<div class="fti-company-3-area bg-default fti-class-add tx-section" data-background="<?php echo $settings['image_1']['url'] ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container fti-container-8">
        <div class="fti-company-3-slider">
            <div class="swiper-container fti_company_3_active fix">
                <div class="swiper-wrapper">

                    <!-- item -->
                    <?php foreach($settings['service_lists'] as $list ) : ?>
                    <div class="swiper-slide">
                        <div class="fti-company-3-item">
                            <?php if(!empty( $list['title'] )) : ?>
                            <h2 class="fti-section-title-4 title fti-split-text fti-split-in-right-4 tx-title">
                                <?php echo elh_element_kses_intermediate( $list['title'] ); ?>
                            </h2>
                            <?php endif; ?>

                            <?php if(!empty( $list['description'] )) : ?>
                            <p class="fti-para-3-small disc tx-description"><?php echo elh_element_kses_intermediate( $list['description'] ); ?></p>
                            <?php endif; ?>

                            <?php if( $list['enable_author_info'] === 'yes' ) : ?>
                            <div class="member">
                                <?php if(!empty( $list['author_image']['url'] )) : ?>
                                <div class="main-img">
                                    <img src="<?php echo esc_url($list['author_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['author_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                                <div class="info">
                                    <?php if(!empty( $list['author_label'] )) : ?>
                                    <span class="fti-para-3-small awrad"><?php echo elh_element_kses_intermediate( $list['author_label'] ); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['author_info'] )) : ?>
                                    <span class="fti-para-3-small awrad-disc">
                                        <?php echo elh_element_kses_intermediate( $list['author_info'] ); ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty( $list['button_text'] )) : ?>
                            <a class="fti-btn-pr-4 tx-button" href="<?php echo esc_url($list['button_link']['url']); ?>"
                                target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                <span class="btn-text"><?php echo esc_attr($list['button_text']); ?></span>
                                <?php if(!empty( $list['button_icon'] )) : ?>
                                <span class="btn-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php endif; ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- pagination & navigator -->
            <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
            <div class="fti-company-3-pagination-btn">
                <div class="fti-company-3-pagination"></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>