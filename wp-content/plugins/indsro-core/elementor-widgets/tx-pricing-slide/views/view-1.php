<div class="swiper chy-price-1-slider">
    <div class="swiper-container chy_price_1_active">
        <div class="swiper-wrapper">
            <?php foreach($settings['pricing_slides'] as $list) :

                if ($list['currency'] === 'custom') {
                    $currency = $list['currency_custom'];
                } else {
                    $currency = self::get_currency_symbol($list['currency']);
                }
            ?>
            <div class="swiper-slide">
                <div class="chy-price-1-slider-item">
                    <div class="left">
                        <div class="chy-price-1-slider-item-img">
                            <?php if(!empty( $list['author_image']['url'] )) : ?>
                            <img src="<?php echo esc_url($list['author_image']['url']); ?>" alt="" />
                            <?php endif; ?>
                            <div class="chy_price_1_next">
                                <i class="fas fa-arrows-alt-h"></i>
                            </div>
                        </div>
                    </div>
                    <div class="transform-orgn">
                        <div class="right">
                            <div class="section-title-wrap mb-25">
                                <?php if(!empty( $list['title'] )) : ?>
                                <h2 class="chy-title-1 has-55 chy-split-in-right chy-split-text">
                                    <?php echo elh_element_kses_intermediate($list['title']); ?>
                                </h2>
                                <?php endif; ?>

                                <?php if(!empty( $list['description'] )) : ?>
                                <p class="chy-section-para-1">
                                    <?php echo elh_element_kses_intermediate($list['description']); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div class="innter-div">
                                <div class="inner-div-left">
                                    <div class="chy-price-1-pricing mb-40">
                                        <?php if(!empty( $list['price'] )) : ?>
                                        <h4 class="chy-heading-1 dollar">
                                            <?php echo esc_html($currency); ?><?php echo esc_html($list['price']); ?>
                                        </h4>
                                        <?php endif; ?>

                                        <?php if(!empty( $list['period'] )) : ?>
                                        <p class="chy-para-1 monthly">
                                            <?php echo elh_element_kses_intermediate($list['period']); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(!empty( $list['button_text'] )) : ?>
                                    <a class="chy-pr-btn-1" href="<?php echo esc_url($list['button_link']['url']); ?>">
                                        <span class="text">
                                            <?php echo elh_element_kses_intermediate($list['button_text']); ?>
                                        </span>
                                        <span class="icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                    </a>
                                    <?php endif; ?>

                                </div>
                                <div class="inner-div-right">
                                    <?php if(!empty( $list['small_image']['url'] )) : ?>
                                    <img src="<?php echo esc_url($list['small_image']['url']); ?>" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if( $settings['enable_pagination'] === 'yes' ) : ?>
    <div class="chy-price-1-pagination"></div>
    <?php endif; ?>
</div>