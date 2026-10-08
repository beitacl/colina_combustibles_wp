<section class="log-case-study-section pt-120 pb-50 position-relative tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-case-bg img-parallax position-absolute">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="log-section-title-5 headline-2 pera-content">
            <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
            <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                    <?php if( $settings['sub_title_icon_type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $settings['sub_title_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?>
            </div>
            <?php endif; ?>

            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title section_title tx-split-text split-in-right' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>
        </div>
        <div class="log-case-content txt_item_active">
            <div class="row">
                <div class="col-lg-6">
                    <div class="log-case-left-content">

                        <?php if( $settings['enable_feature_boxs'] === 'yes' ) : ?>
                            <?php foreach($settings['feature_boxs'] as $list ) : ?>
                            <div class="log-case-item wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                                <div class="item-img position-relative">
                                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                    <?php if( $list['type'] === 'icon' ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                    <?php endif; ?>
                                <?php endif; ?>

                                    <?php if(!empty( $list['list_cat'] )) : ?>
                                    <span class="case-cate position-absolute">
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_cat'] ); ?>
                                        </a>
                                    </span>
                                    <?php endif; ?>

                                </div>
                                <div class="item-text headline-2 pera-content">
                                    <?php if(!empty( $list['list_title'] )) : ?>
                                    <h3 class="case_title href-underline">
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                                        </a>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['list_description'] )) : ?>
                                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if( $settings['enable_button'] === 'yes' ) : ?>
                        <div class="log-case-more-btn text-uppercase fadeInUp"  data-wow-delay="500ms" data-wow-duration="1000ms">
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                                target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                <span><?php echo esc_html($settings['button_text']); ?></span>
                                <?php
                                    if(!empty( $settings['enable_button_icon'] === 'yes') ) {
                                        \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                                    }
                                ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="log-case-right-content">
                        <?php if( $settings['enable_description'] === 'yes' ) : ?>
                        <div class="log-case-title-text pera-content log-text">
                            <p class="tx-description">
                                <?php echo elh_element_kses_intermediate($settings['description']); ?>
                            </p>
                        </div>
                        <?php endif; ?>

                        <?php if( $settings['enable_feature_boxs_2'] === 'yes' ) : ?>
                            <?php foreach($settings['feature_boxs_2'] as $list ) : ?>
                            <div class="log-case-item wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                                <div class="item-img position-relative">
                                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                    <?php if( $list['type'] === 'icon' ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                    <?php endif; ?>
                                <?php endif; ?>

                                    <?php if(!empty( $list['list_cat'] )) : ?>
                                    <span class="case-cate position-absolute">
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_cat'] ); ?>
                                        </a>
                                    </span>
                                    <?php endif; ?>

                                </div>
                                <div class="item-text headline-2 pera-content">
                                    <?php if(!empty( $list['list_title'] )) : ?>
                                    <h3 class="case_title href-underline">
                                        <a href="<?php echo esc_url($list['link']['url']); ?>">
                                            <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                                        </a>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['list_description'] )) : ?>
                                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>