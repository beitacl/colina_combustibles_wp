<?php
$rand = rand(0, 9999);
?>
<section class="log-feature-tab-section position-relative pt-110 tx-section">
    <?php if(!empty( $settings['image_1']['url'] )) : ?>
    <span class="log-feature-side-img position-absolute img-parallax">
        <img
        src="<?php echo esc_url($settings['image_1']['url']); ?>"
        alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $settings['image_1']['url'] ); } ?>">
    </span>
    <?php endif; ?>
    <div class="container">
        <div class="log-feature-tab-btn-wrap d-flex justify-content-between">
            <div class="log-feature-tab-btn-text">
                <div class="log-section-title-1 headline pera-content wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <?php if( $settings['enable_sub_title'] === 'yes' ) : ?>
                    <div class="subtitle text-uppercase tx-subTitle">
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
                <div class="log-feature-tab-btn mt-40 tx-tab-btn ul-li-block">
                    <ul class="nav nav-tabs" id="log-feature-<?php echo esc_attr($rand); ?>" role="tablist">
                        <?php
                            foreach ($settings['projectTab_lists'] as $id => $list):
                            $is_active = $list['is_active'] == 'yes' ? 'active' : '';
                            $aria_selected = $list['is_active'] == 'yes' ? 'true' : 'false';
                        ?>
                        <li class="nav-item" role="presentation">
                            <div
                            class="nav-link <?php echo esc_attr($is_active); ?>"
                            id="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            type="button"
                            role="tab"
                            aria-controls="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                            aria-selected="<?php echo esc_attr($aria_selected); ?>">
                                <?php \Elementor\Icons_Manager::render_icon( $list['title_icon'], [ 'aria-hidden' => 'true' ] );?>
                                <?php echo elh_element_kses_intermediate($list['tab_title']); ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="log-feature-tab-area">
                <div class="tab-content" id="myTabContent_<?php echo esc_attr($rand); ?>">
                    <?php
                        foreach ($settings['projectTab_lists'] as $id => $list):
                        $is_active = $list['is_active'] == 'yes' ? 'show active' : '';
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($is_active); ?>"
                    id="tab-<?php echo esc_attr($id. '_' .$rand); ?>"
                    role="tabpanel"
                    aria-labelledby="projectTab-<?php echo esc_attr($id. '_' .$rand); ?>">
                        <div class="log-feature-tab-img-text position-relative">.
                            <?php if(!empty( $list['image_1']['url'] )) : ?>
                            <div class="item-img">
                                <img src="<?php echo esc_url($list['image_1']['url']); ?>"
                                alt="<?php if(function_exists('indsro_img_alt_text')) { echo indsro_img_alt_text( $list['image_1']['url'] ); } ?>">
                            </div>
                            <?php endif; ?>
                            <div class="item-text-area d-flex justify-content-between align-items-center headline pera-content ul-li-block">
                                <div class="item-text">
                                    <?php if(!empty( $list['feature_heading'] )) : ?>
                                    <h3>
                                        <?php echo elh_element_kses_intermediate($list['feature_heading']); ?>
                                    </h3>
                                    <?php endif; ?>

                                    <?php if(!empty( $list['tab_content_description'] )) : ?>
                                    <p>
                                        <?php echo elh_element_kses_intermediate($list['tab_content_description']); ?>
                                    </p>
                                    <?php endif; ?>
                                </div>

                                <?php if( $list['enable_feature_lists'] === 'yes' ) : ?>
                                <div class="item-list">
                                    <ul>
                                        <?php
                                            $list_item = $list['tab_content_lists'];
                                            $list_item = explode("\n", ($list_item));
                                            foreach($list_item as $feature_list):
                                        ?>
                                        <li>
                                            <?php \Elementor\Icons_Manager::render_icon( $list['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            <?php echo wp_kses($feature_list, true)?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>