<div class="chy-price-2-slider">
    <div class="swiper-container fix chy_price_2_active">
        <div class="swiper-wrapper">

            <?php foreach($settings['pricing_slides'] as $list) :

                if ($list['currency'] === 'custom') {
                    $currency = $list['currency_custom'];
                } else {
                    $currency = self::get_currency_symbol($list['currency']);
                }
            ?>
            <div class="swiper-slide">
                <div class="chy-price-2-item">
                    <div class="img-item-wrap">
                        <?php if(!empty( $list['image_1']['url'] )) : ?>
                        <div class="img-item img-cover">
                            <img src="<?php echo esc_url($list['image_1']['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['image_2']['url'] )) : ?>
                        <div class="img-item img-cover">
                            <img src="<?php echo esc_url($list['image_2']['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['image_3']['url'] )) : ?>
                        <div class="img-item-big img-cover">
                            <img src="<?php echo esc_url($list['image_3']['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['image_4']['url'] )) : ?>
                        <div class="img-item img-cover">
                            <img src="<?php echo esc_url($list['image_4']['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>

                        <?php if(!empty( $list['image_5']['url'] )) : ?>
                        <div class="img-item img-cover">
                            <img src="<?php echo esc_url($list['image_5']['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="content-wrap">
                        <div class="list-wrap">
                            <div class="price-wrap">
                                <?php if(!empty( $list['title'] )) : ?>
                                <h3 class="chy-heading-1 title">
                                    <?php echo elh_element_kses_intermediate($list['title']); ?>
                                </h3>
                                <?php endif; ?>

                                <?php if(!empty( $list['price'] )) : ?>
                                <h4 class="chy-heading-1 price">
                                    <span class="dollar-sine"><?php echo esc_html($currency); ?></span>
                                    <?php echo elh_element_kses_intermediate($list['price']); ?>
                                </h4>
                                <?php endif; ?>
                            </div>

                            <?php if( $settings['enable_feature_list'] === 'yes' ) : ?>
                            <ul class="chy-price-2-list list-unstyled">
                                <?php
                                $list_item = $list['description'];
                                    $list_item = explode("\n", ($list_item));
                                    foreach($list_item as $feature_list):
                                ?>
                                <li class="chy-heading-2">
                                <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php echo wp_kses($feature_list, true)?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>

                            <?php if(!empty( $list['notice_text'] )) : ?>
                            <span class="chy-para-2 month">
                                <?php echo elh_element_kses_intermediate($list['notice_text']); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty( $list['button_text'] )) : ?>
                        <a href="<?php echo esc_url($list['button_link']['url']); ?>" class="price-2-btn">
                            <?php echo elh_element_kses_intermediate($list['button_text']); ?>
                        </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
    <?php if( $settings['enable_pagination'] === 'yes' ) : ?>
    <div class="chy-price-2-slider-btn">
        <div class="chy_price_2_prev">
            <i class="far fa-long-arrow-left"></i>
        </div>
        <div class="chy_price_2_next" >
            <i class="far fa-long-arrow-right"></i>
        </div>
    </div>
    <?php endif; ?>

</div>