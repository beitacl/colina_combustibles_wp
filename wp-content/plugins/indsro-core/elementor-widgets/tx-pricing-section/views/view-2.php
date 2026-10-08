<div class="gly-price-4-area fix pt-120 tx-section" data-background="<?php echo esc_url($settings['image_1']['url']) ? esc_url($settings['image_1']['url']) : ''; ?>">
    <div class="container gly-container-3">

        <!-- section-title -->
        <div class="gly-price-4-scn-title mb-50 text-center">
            <?php if(!empty( $settings['enable_sub_title'] )) : ?>
            <h6 class="gly-subtitle-4 tx-subTitle"><?php echo elh_element_kses_intermediate($settings['sub_title']); ?></h6>
            <?php endif; ?>
            <?php
                if($settings['enable_title'] === 'yes') {
                $this->add_render_attribute( 'title', 'class', 'tx-title gly-section-title-3 has-title-4 gly-split-in-down gly-split-text' );
                    printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        elh_element_kses_basic( $settings['title'] )
                    );
                }
            ?>

            <?php if( $settings['enable_description'] === 'yes' ) : ?>
            <p class="gly-para-2 disc has-white wow fadeInUp tx-description">
                <?php echo elh_element_kses_intermediate($settings['description']); ?>
            </p>
            <?php endif; ?>
        </div>

        <?php if($settings['enable_pricing_boxs'] === 'yes' ) : ?>
        <div class="gly-price-4-card-wrap">

            <?php
                foreach( $settings['pricing_boxs'] as $list ) :
                if ($list['currency'] === 'custom') {
                    $currency = $list['currency_custom'];
                } else {
                    $currency = self::get_currency_symbol($list['currency']);
                }
            ?>
            <div class="gly-price-4-card">
                <?php if(!empty( $list['pricing_title'] )) : ?>
                <div class="card-title text-uppercase gly-heading-4 gly-font-700">
                    <span></span>
                    <?php echo elh_element_kses_intermediate( $list['pricing_title']); ?>
                    <span></span>
                </div>
                <?php endif; ?>

                <?php if(!empty( $list['price_image']['url'] )) : ?>
                <div class="card-img img-cover">
                    <img src="<?php echo esc_url($list['price_image']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['price_image']['url'] ); } ?>">
                </div>
                <?php endif; ?>

                <h3 class="card-price gly-heading-4 text-uppercase gly-font-700">
                    <span class="dollor"><?php echo esc_html($currency); ?></span><?php echo elh_element_kses_intermediate( $list['price']); ?>
                    <?php if(!empty( $list['period'] )) : ?>
                    <span class="month"><?php echo elh_element_kses_intermediate( $list['period']); ?></span>
                    <?php endif; ?>
                </h3>

                <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                <ul class="card-list gly-para-3 has-4 mb-35 list-unstyled">
                    <?php foreach( $list['price_feature_lists'] as $f_list ) :
                        $feature_animation = 'wow '. $f_list['feature_animation'] ? 'wow fadeInUp' : '';
                        $feature_animation_delay = 'data-wow-delay="'. $f_list['feature_animation_delay'] . 's"';
                    ?>
                    <li>
                        <?php
                            if( $f_list['enable_feature_icon'] === 'yes' ) {
                                \Elementor\Icons_Manager::render_icon( $f_list['feature_icon'], [ 'aria-hidden' => 'true' ] );
                            }
                        ?>
                        <?php echo elh_element_kses_intermediate($f_list['feature_text']); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if( $list['enable_button'] === 'yes' ) : ?>
                <a aria-label="name" class="card-btn"
                href="<?php echo esc_url($list['button_link']['url']); ?>"
                target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                    <?php echo elh_element_kses_intermediate( $list['button_text']); ?>
                    <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <?php if( $list['enable_button'] === 'yes' ) : ?>
            <div class="gly-price-4-btn">
                <a class="gly-pr-btn-5"
                href="<?php echo esc_url($list['button_link']['url']); ?>"
                target="<?php echo esc_attr($list['button_link']['is_external'] ? '_blank' : '_self'); ?>"
                rel="<?php echo esc_attr($list['button_link']['nofollow'] ? 'nofollow' : ''); ?>"
                >
                    <?php if(!empty( $list['button_text'] )) : ?>
                    <span class="text"><?php echo elh_element_kses_intermediate( $list['button_text']); ?></span>
                    <?php endif; ?>

                    <?php if(!empty( $list['button_icon'] )) : ?>
                    <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="gly-price-4-bg-img">
        <img src="<?php echo esc_url($settings['image_2']['url']); ?>" alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <span class="gly-price-4-bg-shape"></span>
    <span class="gly-price-4-bg-shape-2"> </span>

</div>