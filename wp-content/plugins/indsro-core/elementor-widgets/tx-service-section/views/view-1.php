<section class="log-project-section-1 position-relative pt-130 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-project-bg position-absolute img-parallax">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>
    <div class="log-section-title-1 headline text-center">
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
    </div>
    <div class="log-project-content-1 mt-60">
        <div class="log-project-area-1 swiper-container">
            <div class="swiper-wrapper">
                <?php foreach($settings['service_slide_boxs'] as $lsit ) : ?>
                <div class="swiper-slide">
                    <div class="log-project-item-1 position-relative" data-cursor-text="<?php echo esc_attr($settings['tooltip_text']); ?>">
                        <?php if(!empty( $lsit['shape_image']['url'] )) : ?>
                        <span class="log-project-shape position-absolute">
                            <img src="<?php echo esc_url($lsit['shape_image']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['shape_image']['url'] ); } ?>">
                        </span>
                        <?php endif; ?>

                        <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                        <div class="item-img">
                            <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <div class="item-text href-underline headline position-absolute">
                            <?php if(!empty( $lsit['service_cat'] )) : ?>
                            <span class="text-uppercase">
                                <a
                                href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                aria-label="name">
                                    <?php echo elh_element_kses_intermediate( $lsit['service_cat'] ); ?>
                                </a>
                            </span>
                            <?php endif; ?>

                            <?php if(!empty( $lsit['title'] )) : ?>
                            <h3 class="project_title">
                                <a
                                href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                aria-label="name">
                                    <?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
                                </a>
                            </h3>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>