<section id="log-about-6" class="log-about-section-6 position-relative pt-130 pb-130 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-about-side-img appear_right position-absolute">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="log-about-content-wrap-6">
        <div class="log-about-content-6 d-flex">
            <div class="log-about-img-wrap-6 d-flex">
                <?php if(!empty( $settings['image_2']['url'] )) : ?>
                <div class="item-img-1">
                    <div class="inner-img img-zoom">
                        <img
                        src="<?php echo esc_url($settings['image_2']['url']); ?>"
                        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
                    </div>
                </div>
                <?php endif; ?>
                <div class="item-img-grp">

                    <?php if(!empty( $settings['image_3']['url'] )) : ?>
                    <div class="item-img-2 log-image-appear2">
                        <img class="log-img-rvl_2"
                            src="<?php echo esc_url($settings['image_3']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
                    </div>
                    <?php endif; ?>

                    <?php if(!empty( $settings['image_4']['url'] )) : ?>
                    <div class="item-img-3 position-relative">
                        <div class="inner-img log-image-appear3">
                            <img class="log-img-rvl_3"
                                src="<?php echo esc_url($settings['image_4']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_4']['url'] ); } ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="log-about-text-wrap-6">
                <div class="log-section-title-5 headline-2 log-text pera-content">

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

                    <?php if( $settings['enable_description'] === 'yes' ) : ?>
                    <p class="tx-description">
                        <?php echo elh_element_kses_intermediate($settings['description']); ?>
                    </p>
                    <?php endif; ?>
                </div>
                <div class="log-about-list-6 dark_ver mt-30 ul-li position-relative">
                    <?php if( $settings['enable_feature_lists'] === 'yes' ) : ?>
                    <ul>
                        <?php foreach($settings['feature_lists'] as $list ) : ?>
                        <li class="wow" data-splitting="">
                            <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] );?>
                            <?php echo elh_element_kses_intermediate( $list['feature_text'] ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if( $settings['enable_feature_lists_2'] === 'yes' ) : ?>
                    <ul class="list-item-2">
                        <?php foreach($settings['feature_lists_2'] as $list ) : ?>
                        <li class="wow" data-splitting="">
                            <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] );?>
                            <?php echo elh_element_kses_intermediate( $list['feature_text'] ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="log-about-btn-grp-6 mt-40 d-flex flex-wrap align-items-center wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                    <?php if( $settings['enable_button'] === 'yes' ) : ?>
                    <div class="log-btn-4 text-uppercase">
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                            target="<?php echo esc_attr($settings['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($settings['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                            <?php echo esc_html($settings['button_text']); ?>
                            <?php
                                if(!empty( $settings['enable_button_icon'] === 'yes') ) {
                                    \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                                }
                            ?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="log-client-list d-flex align-items-center flex-wrap ul-li">

                        <?php if( $settings['enable_client_images'] === 'yes' ) : ?>
                        <ul>
                            <?php foreach ( $settings['client_images'] as $key => $brand ) :
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
                            <li>
                                <img src="<?php echo $brand_image ? esc_url($brand_image) : ''; ?>" alt="<?php echo esc_attr($brand_alt); ?>">
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if( $settings['enable_count_box'] === 'yes' ) : ?>
                        <div class="client-number-text tx-count">
                            <span><?php echo esc_html($settings['count_number'] . $settings['count_prefix']); ?></span>
                            <?php echo elh_element_kses_intermediate( $settings['count_title'] ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>