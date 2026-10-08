<section class="log-request-quote-section-4 position-relative pt-90 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-request-quote-img2 img-zoom item-img position-absolute">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <div class="log-request-quote-img3 img-zoom item-img position-absolute">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="log-request-quote-text-img  position-relative">
            <?php if(!empty( $settings['image_3']['url'] )) : ?>
            <div class="log-request-quote-img1 log-image-appear1 position-absolute item-img">
                <img class="log-img-rvl_1"
                src="<?php echo esc_url($settings['image_3']['url']); ?>"
                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_3']['url'] ); } ?>">
            </div>
            <?php endif; ?>

            <div class="log-request-quote-content-4">
                <div class="log-section-title-3 headline-2 pera-content log-text">

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
                <?php
                    if( $settings['enable_tab'] === 'yes' ) :
                    $rand = rand(0, 9999);
                ?>
                <div class="log-request-quote-form-4">
                    <div class="log-request-quote-btn tx-tab-btn ul-li">
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
                    <div class="tab-content log-request-quote-tab" id="log-request-quote-tab_<?php echo esc_attr($rand); ?>">
                        <?php
                            foreach ($settings['tab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                        ?>
                        <div class="tab-pane <?php echo esc_attr($is_active); ?> animated fadeInRight"
                            id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            role="tabpanel"
                            aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                            <div class="log-request-quote-form-wrap">
                                <?php echo do_shortcode($list['tab_form_shortcode']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>