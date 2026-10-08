<section class="log-pricing-section-4 txt_item_active position-relative pt-120 pb-1200 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-price-bg position-absolute">
        <img src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="log-section-title-3 text-center headline-2 pera-content log-text">
            <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
            <div class="subtitle text-uppercase wow fadeInRight tx-subTitle"  data-wow-delay="300ms" data-wow-duration="1000ms">
                <?php if( $settings['enable_sub_title_icon'] === 'yes' ) : ?>
                    <?php if( $settings['sub_title_icon_type'] === 'icon' ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( $settings['sub_title_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['list_image']['alt'] ); ?>">
                    <?php endif; ?>
                <?php endif; ?>

                <span><?php echo elh_element_kses_intermediate( $settings['sub_title'] ); ?></span>
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

        <?php if( $settings['enable_pricing_box'] === 'yes' ) : ?>
        <div class="log-price-content-4 mt-50 position-relative">
            <div class="row justify-content-center">
                <?php
                    $i = 1;
                    foreach( $settings['pricing_boxs'] as $list ) :
                    if ($list['currency'] === 'custom') {
                        $currency = $list['currency_custom'];
                    } else {
                        $currency = self::get_currency_symbol($list['currency']);
                    }

                    $anim_class = '';

                    if ($i === 1) {
                        $anim_class = 'appear_left';
                    } elseif ($i === 2) {
                        $anim_class = 'appear_top';
                    } elseif ($i === 3) {
                        $anim_class = 'appear_right';
                    }
                ?>
                <div class="col-lg-4 col-md-6 <?php echo esc_attr($anim_class); ?>">
                    <div class="log-price-item-4 txt_item_active position-relative">
                        <?php if(!empty( $list['pricing_title'] )) : ?>
                        <div class="price-plan-title text-center text-uppercase">
                            <span><?php echo elh_element_kses_intermediate( $list['pricing_title']); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['price_image']['url'] )) : ?>
                        <div class="price-img">
                            <img
                            src="<?php echo esc_url($list['price_image']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['price_image']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>

                        <div class="price-value text-uppercase">
                            <sub><?php echo esc_html($currency); ?></sub><?php echo esc_html($list['price']); ?><sup><?php echo esc_html($list['price_period']); ?></sup>
                        </div>

                        <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                        <div class="price-list ul-li-block">
                            <?php
                                $list_item = $list['pricing_description'];
                                $list_item = explode("\n", ($list_item));
                                foreach($list_item as $feature_list):
                            ?>
                            <li class="chy-heading-2">
                                <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <?php echo wp_kses($feature_list, true)?>
                            </li>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if( $list['enable_button'] === 'yes' ) : ?>
                        <div class="price-btn text-uppercase text-center">
                            <a href="<?php echo esc_url($list['button_link']['url']); ?>"
                            target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                            rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                            aria-label="<?php echo esc_attr( $list['button_text']); ?>">
                                <span><?php echo esc_html( $list['button_text']); ?></span>
                                <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['shape_image']['url'] )) : ?>
                        <div class="price-bottom-img position-absolute">
                            <img
                            src="<?php echo esc_url($list['shape_image']['url']); ?>"
                            alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['shape_image']['url'] ); } ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>