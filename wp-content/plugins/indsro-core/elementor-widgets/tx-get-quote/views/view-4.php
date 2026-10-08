<section class="log-quote-section-5 position-relative pb-130 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <div class="log-quote-bg position-absolute">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </div>
    <?php endif; ?>

    <?php if(!empty( $settings['image_2']['url'] )) : ?>
    <span class="process-side appear_left position-absolute">
        <img
        src="<?php echo esc_url($settings['image_2']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_2']['url'] ); } ?>">
    </span>
    <?php endif; ?>

    <div class="container">
        <div class="log-quote-content-5 d-flex align-items-end">
            <?php
                if( $settings['enable_tab'] === 'yes' ) :
                $rand = rand(0, 9999);
            ?>
            <div class="log-quote-tab-area-5 d-flex align-items-end">
                <div class="log-quote-tab-btn-5 tx-tab-btn ul-li-block">
                    <ul class="nav nav-tabs" id="log-quote-tab_<?php echo esc_attr($rand); ?>" role="tablist">
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
                                <div class="log-quote-plan headline-2" data-background="<?php echo esc_url($list['tab_title_image']['url']) ? esc_url($list['tab_title_image']['url']) : ''; ?>">
                                    <h3><?php echo elh_element_kses_intermediate($list['tab_title']); ?></h3>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="log-quote-tab-content-5">
                    <div class="tab-content" id="myTabContent_<?php echo esc_attr($rand); ?>">
                        <?php
                            foreach ($settings['tab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                        ?>
                        <div class="tab-pane <?php echo esc_attr($is_active); ?> animated fadeInUp"
                            id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            role="tabpanel"
                            aria-labelledby="pricingTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                            <div class="log-quote-form-5">
                                <?php if(!empty( $list['tab_content_image']['url'] )) : ?>
                                <div class="form-img">
                                    <img
                                    src="<?php echo esc_url($list['tab_content_image']['url']); ?>"
                                    alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['tab_content_image']['url'] ); } ?>">
                                </div>
                                <?php endif; ?>

                                <div class="tx-formWrapper">
                                    <?php echo do_shortcode($list['tab_form_shortcode']); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="log-quote-text-5">
                <div class="log-section-title-4 headline-2 pera-content log-text">
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


                    <?php if( $settings['enable_contact_info'] === 'yes' ) :
                        if($settings['link_type'] === 'email') {
                            $link_url = 'mailto:' . $settings['contact_info_text'];
                        } elseif( $settings['link_type'] === 'phone' ) {
                            $link_url = 'tel:' . $settings['contact_info_text'];
                        } else {
                            $link_url = $settings['contact_info_text'];
                        }
                    ?>
                    <div class="log-about-cta-grp flex-wrap mt-30 d-flex align-items-center wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms">
                        <div class="log-about-cta d-flex ver_3 align-items-center">
                            <?php if(!empty( $settings['contact_info_icon'] )) : ?>
                            <div class="inner-icon d-flex align-items-center justify-content-center">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['contact_info_icon'], [ 'aria-hidden' => 'true' ] );?>
                            </div>
                            <?php endif; ?>

                            <div class="inner-text ver_2">
                                <?php if(!empty( $settings['contact_info_text'] )) : ?>
                                <a href="<?php echo esc_url($link_url); ?>">
                                    <?php echo elh_element_kses_intermediate( $settings['contact_info_text'] ); ?></a>
                                <?php endif; ?>

                                <?php if(!empty( $settings['contact_info_label'] )) : ?>
                                <span><?php echo elh_element_kses_intermediate( $settings['contact_info_label'] ); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>