<section class="log-process-section pt-160 pb-140 position-relative tx-section">

    <?php if( $settings['enable_shape'] === 'yes' ) : ?>
    <div class="log-process-line position-absolute">
        <svg class="log-svg-anim" width="1920" height="353" viewBox="0 0 1920 353" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 345.981C56.1667 356.981 201.9 360.281 343.5 285.481C520.5 191.981 756.5 -43.5187 1026 125.981C1078.5 159.001 1198.6 227.581 1325 139.981C1483 30.4813 1634.5 -108.519 1919 139.981" stroke="#DFDFDF" stroke-width="2" stroke-dasharray="6 6"/>
        </svg>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="log-section-title-1 headline text-center">
            <?php if(!empty( $settings['enable_sub_title'] )) : ?>
            <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
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
        <div class="log-process-content mt-90">
            <div class="row justify-content-center">
                <?php foreach($settings['service_slide_boxs'] as $lsit ) :
                    if($lsit['design_style'] === 'style_2') :
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="log-process-item">
                        <div class="process-text log-text text-center headline pera-content">
                            <?php if(!empty( $lsit['title'] )) : ?>
                            <h3 class="wow" data-splitting="">
                                <a
                                    href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                    target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                    rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                    aria-label="<?php echo esc_html( $lsit['title'] ); ?>">
                                        <?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
                                    </a>
                            </h3>
                            <?php endif; ?>

                            <?php if(!empty( $lsit['description'] )) : ?>
                            <p>
                                <?php echo elh_element_kses_intermediate( $lsit['description'] ); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="process-icon">
                            <div class="item-icon text-center position-relative">

                                <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                                <div class="inner-icon">
                                    <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $lsit['shape_image']['url'] )) : ?>
                                <div class="inner-shape position-absolute">
                                    <img src="<?php echo esc_url($lsit['shape_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['shape_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                            </div>

                            <?php if(!empty( $lsit['count'] )) : ?>
                            <div class="item-serial text-center">
                                <?php echo elh_element_kses_intermediate( $lsit['count'] ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php elseif($lsit['design_style'] === 'style_3') : ?>
                <div class="col-lg-3 col-md-6">
                    <div class="log-process-item">
                        <div class="process-icon">

                            <?php if(!empty( $lsit['count'] )) : ?>
                            <div class="item-serial text-center">
                                <?php echo elh_element_kses_intermediate( $lsit['count'] ); ?>
                            </div>
                            <?php endif; ?>

                            <div class="item-icon text-center position-relative">
                                <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                                <div class="inner-icon">
                                    <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $lsit['shape_image']['url'] )) : ?>
                                <div class="inner-shape position-absolute">
                                    <img src="<?php echo esc_url($lsit['shape_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['shape_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="process-text log-text text-center headline pera-content">
                            <?php if(!empty( $lsit['title'] )) : ?>
                            <h3 class="wow" data-splitting="">
                                <a
                                    href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                    target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                    rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                    aria-label="<?php echo esc_html( $lsit['title'] ); ?>">
                                        <?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
                                    </a>
                            </h3>
                            <?php endif; ?>

                            <?php if(!empty( $lsit['description'] )) : ?>
                            <p>
                                <?php echo elh_element_kses_intermediate( $lsit['description'] ); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <div class="col-lg-3 col-md-6">
                    <div class="log-process-item">
                        <div class="process-text log-text text-center headline pera-content">
                            <?php if(!empty( $lsit['title'] )) : ?>
                            <h3 class="wow" data-splitting="">
                                <a
                                    href="<?php echo esc_url($lsit['button_link']['url']); ?>"
                                    target="<?php echo esc_attr($lsit['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                    rel= "<?php echo esc_attr($lsit['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                                    aria-label="<?php echo esc_html( $lsit['title'] ); ?>">
                                        <?php echo elh_element_kses_intermediate( $lsit['title'] ); ?>
                                    </a>
                            </h3>
                            <?php endif; ?>

                            <?php if(!empty( $lsit['description'] )) : ?>
                            <p>
                                <?php echo elh_element_kses_intermediate( $lsit['description'] ); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="process-icon">
                            <div class="item-icon text-center position-relative">

                                <?php if(!empty( $lsit['service_image']['url'] )) : ?>
                                <div class="inner-icon">
                                    <img src="<?php echo esc_url($lsit['service_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['service_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <?php if(!empty( $lsit['shape_image']['url'] )) : ?>
                                <div class="inner-shape position-absolute">
                                    <img src="<?php echo esc_url($lsit['shape_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $lsit['shape_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                            </div>

                            <?php if(!empty( $lsit['count'] )) : ?>
                            <div class="item-serial text-center">
                                <?php echo elh_element_kses_intermediate( $lsit['count'] ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
    </div>
</section>