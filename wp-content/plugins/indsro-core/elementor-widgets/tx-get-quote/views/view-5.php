<section class="log-quote-section-6 position-relative pt-130 pb-130 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <span class="log-quote-side-1 position-absolute appear_right">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <span class="log-quote-side-2 position-absolute appear_left">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <div class="container">
        <div class="log-quote-content-6">
            <div class="row">
                <div class="col-lg-6">
                    <?php
                        if( $settings['enable_tab'] === 'yes' ) :
                        $rand = rand(0, 9999);
                    ?>
                    <div class="log-quote-form-6 position-relative" data-background="<?php echo get_template_directory_uri(  ); ?>/assets/img/bg/pro-bg.webp">
                        <div class="log-quote-form-btn tx-tab-btn ul-li">
                            <ul class="nav nav-tabs" id="request_tab_<?php echo esc_attr($rand); ?>" role="tablist">
                                <?php
                                    foreach ($settings['tab_lists'] as $id => $list):
                                    $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                                    $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
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
                                        <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-content log-quote-tab" id="log-quote-tab_<?php echo esc_attr($rand); ?>">
                            <?php
                                foreach ($settings['tab_lists'] as $id => $list):
                                $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                            ?>
                            <div class="tab-pane <?php echo esc_attr($is_active); ?> animated fadeInRight"
                            id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            role="tabpanel"
                            aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                                <?php echo do_shortcode($list['tab_form_shortcode']); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <div class="log-quote-text-area-6">
                        <div class="log-section-title-5 headline-2 pera-content">

                            <?php if(!empty( $settings['sub_title'] )) : ?>
                            <div class="subtitle text-uppercase wow fadeInRight tx-subTitle" data-wow-delay="300ms" data-wow-duration="1000ms">
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

                            <?php if( $settings['enable_description'] === 'yes' ) : ?>
                            <p class="tx-description">
                                <?php echo elh_element_kses_intermediate($settings['description']); ?>
                            </p>
                            <?php endif; ?>
                        </div>

                        <?php if( $settings['enable_feature_boxs'] === 'yes' ) : ?>
                        <div class="log-quote-feature-area mt-25">
                            <?php foreach($settings['feature_boxs'] as $list ) : ?>
                            <div class="log-quote-feature-item position-relative d-flex top_view align-items-star">
                                <?php if( $list['enable_icon'] === 'yes' ) : ?>
                                 <div class="item-icon">
                                    <?php if( $list['type'] === 'icon' ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $list['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( $list['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $list['list_image']['alt'] ); ?>">
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="item-text headline-2 pera-content">
                                    <?php if(!empty( $list['list_title'] )) : ?>
                                    <h3 class="wow" data-splitting="">
                                        <?php echo elh_element_kses_intermediate( $list['list_title'] ); ?>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['list_description'] )) : ?>
                                    <p><?php echo elh_element_kses_intermediate( $list['list_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>