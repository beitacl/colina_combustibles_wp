<div class="fti-project-3-area tx-section">
    <div class="fti-project-3-slider">
        <div class="swiper-container fti_project_3_active fix">
            <div class="swiper-wrapper">
                <?php foreach($settings['service_lists'] as $list ) : ?>
                <div class="swiper-slide">
                    <div class="fti-project-3-item">
                        <?php if(!empty( $list['image_1']['url'] )) : ?>
                        <div class="main-img img-cover">
                            <img
                                src="<?php echo esc_url($list['image_1']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                        <div class="project-content">
                            <?php if(!empty( $list['title'] )) : ?>
                            <h3 class="fti-heading-3 title tx-title"><?php echo elh_element_kses_intermediate( $list['title'] ); ?></h3>
                            <?php endif; ?>

                            <?php if(!empty( $list['button_text'] )) : ?>
                            <a class="project-btn tx-button"
                                href="<?php echo esc_url($list['button_link']['url']); ?>"
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
                </div>
                <?php endforeach; ?>
            </div>

            <!-- slider navigator -->
            <?php if( $settings['enable_slider_nav'] === 'yes' ) : ?>
            <div class="container fti-container-8 project-3-container">
                <div class="fti-project-3-navigation-btn">
                    <div class="fti-project-3-prev">
                        <span class="icon-1">
                            <i class="fa-light fa-arrow-left-long"></i>
                        </span>
                    </div>

                    <div class="fti-project-3-next">
                        <span class="icon-1">
                            <i class="fa-light fa-arrow-right-long"></i>
                        </span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>