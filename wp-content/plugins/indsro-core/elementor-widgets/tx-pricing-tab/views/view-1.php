<?php
$rand = rand(0, 9999);
?>
<section class="log-pricing-section pt-150 pb-100 tx-section">
    <div class="container">
        <div class="log-pricing-content d-flex align-items-center justify-content-between">
            <div class="log-pricng-tab-btn tx-tab-btn ul-li-block">
                <ul class="nav nav-tabs" id="log-price-<?php echo esc_attr($rand); ?>" role="tablist">
                    <?php
                        foreach ($settings['pricingTab_lists'] as $id => $list):
                        $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                        $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';

                        if ($list['currency'] === 'custom') {
                            $currency = $list['currency_custom'];
                        } else {
                            $currency = self::get_currency_symbol($list['currency']);
                        }
                    ?>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link <?php echo esc_attr($is_active); ?>"
                        id="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        type="button"
                        role="tab"
                        aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                        aria-selected="<?php echo esc_attr($aria_selected); ?>">
                            <div class="log-pricing-plan headline">
                                <div class="plan-price">
                                    <?php echo esc_html($currency . $list['price']); ?><span><?php echo esc_html($list['period']); ?></span>
                                </div>

                                <?php if(!empty( $list['tab_title'] )) : ?>
                                <h3><?php echo elh_element_kses_intermediate($list['tab_title']); ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="log-pricing-tab-content pt-30">
                <div class="tab-content" id="myTabContent_<?php echo esc_attr($rand); ?>">
                    <?php
                        foreach ($settings['pricingTab_lists'] as $id => $list):
                        $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                    ?>
                    <div class="tab-pane animated fadeInUp <?php echo esc_attr($is_active); ?>"
                    id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                    role="tabpanel"
                    aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                        <div class="log-pricing-desc-area">
                            <div class="price-img-desc position-relative">
                                <?php if(!empty( $list['tab_image']['url'] )) : ?>
                                <div class="item-img">
                                    <img src="<?php echo esc_url($list['tab_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['tab_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <?php if( $list['enable_video_button'] === 'yes' ) : ?>
                                <div class="play-icon position-absolute">
                                    <?php if(!empty( $list['video_icon'] )) : ?>
                                    <a class="video_box" href="<?php echo esc_url($list['video_link']['url']); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon( $list['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                    <?php endif; ?>
                                    <span class="video_btn_border border_wrap-1"></span>
                                    <span class="video_btn_border border_wrap-2"></span>
                                    <span class="video_btn_border border_wrap-3"></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="price-text-desc mt-35 d-flex justify-content-between align-items-center ul-li-block">
                                <div class="price-title headline">
                                    <?php if(!empty( $list['price_content_subtitle'] )) : ?>
                                    <span class="text-uppercase"><?php echo elh_element_kses_intermediate($list['price_content_subtitle']); ?></span>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['price_content_title'] )) : ?>
                                    <h3><?php echo elh_element_kses_intermediate($list['price_content_title']); ?></h3>
                                    <?php endif; ?>
                                </div>

                                <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                                <ul>
                                    <?php
                                        $list_item = $list['price_feature_lists'];
                                        $list_item = explode("\n", ($list_item));
                                        foreach($list_item as $feature_list):
                                    ?>
                                    <li>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['price_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        <?php echo wp_kses($feature_list, true)?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>

                                <?php if(!empty( $list['price_content_button_text'] )) : ?>
                                <div class="log-btn-2 text-uppercase">
                                    <a href="<?php echo esc_url($list['price_content_button_link']['url']); ?>"
                                        target="<?php echo esc_attr($list['price_content_button_link']['is_external'] ? '_blank' : '_self'); ?>"
                                        rel="<?php echo esc_attr($list['price_content_button_link']['nofollow'] ? 'nofollow' : ''); ?>">
                                        <?php echo elh_element_kses_intermediate($list['price_content_button_text']); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>